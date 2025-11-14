<?php

namespace Controller;

use DateTime;
use Exception;
use Entity\EPayment;

use Entity\EDeliveryItem;
use Entity\EDeliveryReservation;
use Entity\StatoPagamento;
use Foundation\FCreditCard;
use Foundation\FDeliveryItem;
use Foundation\FDeliveryReservation;
use Foundation\FProduct;
use Foundation\FPersistentManager;
use Foundation\FUser;
use View\VDelivery;
use View\VUser;
use Utility\UHTTPMethods;
use Utility\USessions;

class CDelivery {

    public function __construct() {
        
    }

    /**
     * Function to show Delivery's menù after clicking on "Delivery" in Home Page
     */
    public function showDeliveryReservation() {
        $viewU=new VUser();
        $viewD=new VDelivery();
        $session=USessions::getIstance();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        //Retrive all products form DB, in order to pass the array to the view
        $allProducts=FPersistentManager::getInstance()->readAll(FProduct::class);
        $viewU->showUserHeader($isLogged);
        $viewD->showDeliveryReservation($allProducts);
    }

    /**
     * Function to show user info's form to create a Delivery Reservation
     */
    public function showUserInfo() {
        $viewU=new VUser();
        $viewD=new VDelivery();
        $session=USessions::getIstance();
        $session->startSession();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        $productIds = UHTTPMethods::post('product_ids');
        $quantities = UHTTPMethods::post('quantities'); 
		$subtotal=0;
        //Calcolo il totale dell'ordine
        foreach ($productIds as $id) {
        	$product = FPersistentManager::getInstance()->read($id, FProduct::class);
            $quantity = $quantities[$id];
            $singlePrice = $product->getPriceProduct() * $quantity;
            $subtotal+=$singlePrice;
            }
        $session->setValue('product_ids', $productIds);
        $session->setValue('quantities', $quantities);
		$session->setValue('subtotal', $subtotal);

        $viewU->showUserHeader($isLogged);
        $viewD->showDeliveryUserInfo();
    }

    /**
     * Function to summarize Delivery Reservation choises and show Payment Methodes
     */
public function showPaymentMethod() {
    $viewU = new VUser();
    $viewD = new VDelivery();
    $session = USessions::getIstance();
    $session->startSession();
    // Verifica login utente
    $isLogged = CUser::isLogged();
    if ($isLogged) {
        $idUser = $session->readValue('idUser');
    }
    // Recupero dati dalla POST (inviati dal form utente)
    $phone = UHTTPMethods::post('phone');
    $address = UHTTPMethods::post('address');
    $streetNumber = UHTTPMethods::post('streetNumber');
    $dateTime = UHTTPMethods::post('dateTime');
    // Creo un oggetto EDeliveryReservation con i dati della spedizione
    $deliveryReservation = new EDeliveryReservation(null, $idUser, $phone, $address, (int)$streetNumber, new DateTime($dateTime));
    // Salvo in sessione i dati dell’utente per eventuale conferma successiva
    $session->setValue('deliveryReservation', $deliveryReservation); 
    // Recupero i dati dell'ordine dalla sessione
    $productIds = $session->readValue('product_ids');
    $quantities = $session->readValue('quantities');
    $totalPrice = $session->readValue('subtotal');
    // Ricostruisco i prodotti dal DB
    $orderProducts = [];
    foreach ($productIds as $id) {
        $product = FPersistentManager::getInstance()->read($id, FProduct::class);
        if ($product !== null) {
            $orderProducts[] = $product;  // <-- qui passiamo proprio l'oggetto
        }
    }
    // Recupero le carte di credito dell’utente per mostrarle nel riepilogo/pagamento
    $userCreditCards = FPersistentManager::getInstance()->readCreditCardsByUser($idUser, FCreditCard::class);
    // Passo tutto alla View
    $viewU->showUserHeader($isLogged);
    $viewD->showPaymentMethod($orderProducts, $userCreditCards, $totalPrice);
    }

    /**
     * Function to Confirme the Delivery Reservation, verify Payment and redirect user to Home Page
     */
    public function showConfirmedOrder() {
        $viewU = new VUser();
        $viewD = new VDelivery();
        $session = USessions::getIstance();
        $session->startSession();
        $isLogged = CUser::isLogged();
        if ($isLogged) {
            $idUser = $session->readValue('idUser');
        }
        $deliveryReservation = $session->readValue('deliveryReservation');
        $reservationId = FPersistentManager::getInstance()->create($deliveryReservation);
        $productIds = $session->readValue('product_ids');
        $quantities = $session->readValue('quantities');
        $subtotal = $session->readValue('subtotal');
        $selectedCardId = UHTTPMethods::post('selectedCardId');
        foreach ($productIds as $idProduct) {
            $product = FPersistentManager::getInstance()->read($idProduct, FProduct::class);
            if ($product !== null) {
                $quantity = $quantities[$idProduct];
                $price = $product->getPriceProduct();
                $totalItem = $price * $quantity;
                $deliveryItem = new EDeliveryItem(
                    null,                   // id
                    $reservationId,          // id prenotazione
                    $idProduct,              // id prodotto
                    $quantity,
                    $totalItem
                );
                FPersistentManager::getInstance()->create($deliveryItem);
            }
        }
        $payment = new EPayment(
            null,
            $selectedCardId,
            $reservationId,
            $subtotal,
            new DateTime(),
            StatoPagamento::COMPLETATO
        );
        FPersistentManager::getInstance()->create($payment);
        $session->deleteValue('product_ids');
        $session->deleteValue('quantities');
        $session->deleteValue('subtotal');
        $session->deleteValue('deliveryReservation');
        $viewU->showUserHeader($isLogged);
        $viewD->confirmedOrder();
    }

    /**
     * Function to show get a delivery order, getting a format to send for a tpl model (email and reservations)
     */
    public static function getDeliveryReservationModel(): array {
        // === DELIVERY ORDERS ===
        $session = USessions::getIstance();
        $idUser = $session->readValue('idUser');
        $userDeliveryReservations = FPersistentManager::getInstance()->readAllDeliveryByUser($idUser, FDeliveryReservation::class) ?? [];
        $deliveryData = [];
        foreach ($userDeliveryReservations as $delivery) {
            $idDeliveryReservation = $delivery->getIdDeliveryReservation();
            // Leggi tutti gli item associati
            $items = FPersistentManager::getInstance()->readAllItemsByReservation($idDeliveryReservation, FDeliveryItem::class) ?? [];
            $total = 0.0;
            $itemDetails = [];
            foreach ($items as $item) {
                // Sicurezza: assicurati che l'item abbia getIdProduct() e getSubtotal()
                $idProduct = $item->getIdProduct();
                if ($idProduct === null) continue;
                // Recupera prodotto (può essere null, gestirlo)
                $product = FPersistentManager::getInstance()->read($idProduct, FProduct::class);
                if ($product === null) {
                    // prodotto non trovato: salta o aggiungi un placeholder
                    $nameProduct = "Unknown product (id: $idProduct)";
                    $priceProduct = 0.0;
                } else {
                    $nameProduct = $product->getNameProduct();
                    // Normalizza eventuali stringhe con virgola
                    $priceProduct = (float) str_replace(',', '.', $product->getPriceProduct());
                }
                $quantity = intval($item->getQuantity());
                // Normalizza subtotal letto dall'item (evita stringhe con virgola)
                $subtotal = (float) str_replace(',', '.', $item->getSubtotal());
                // Somma correttamente
                $total += $subtotal;
                $itemDetails[] = [
                    'name' => $nameProduct,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                    'unit_price' => $priceProduct
                ];
            }
            $deliveryData[] = [
                'userPhone' => $delivery->getUserPhone(),
                'userAddress' => $delivery->getUserAddress(),
                'userNumberAddress' => $delivery->getUserNumberAddress(),
                'wishedTime' => $delivery->getWishedTime(),
                'items' => $itemDetails,
                'total' => $total
            ];
        }
        return $deliveryData;
    }
}