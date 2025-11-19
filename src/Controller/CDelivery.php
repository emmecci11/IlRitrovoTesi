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
     * Function to process POST request. Starting PRG pattern to avoid douplicated objects in RAM.
     */
    public function processMenu() {
        // --- CORREZIONE 1: Gestione Sessione ---
        $session = USessions::getIstance();
        $session->startSession();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        // Legge i dati in arrivo usando UHTTPMethods
        $quantita_ricevute = UHTTPMethods::post('quantita');
        // Inizializza un array vuoto per il carrello
        $cart = ['items' => [], 'total' => 0.0];
        // --- CORREZIONE 2: Uso del PersistentManager ---
        // Otteniamo l'istanza del PM (il nostro "Chef")
        $pm = FPersistentManager::getInstance();
        // Loop su tutti gli idProdotti ricevuti nel POST
        foreach ($quantita_ricevute as $idProdotto => $quantita) {
            if ((int)$quantita > 0) {
                // Usiamo il PM per caricare il prodotto
                $productObject = $pm->read((int)$idProdotto, FProduct::class);
                if ($productObject !== null) {
                    $subtotale = $productObject->getPriceProduct() * (int)$quantita;
                    $cart['total'] += $subtotale;
                    $cart['items'][] = [
                        'id_prodotto' => (int)$idProdotto,
                        'nome_prodotto' => $productObject->getNameProduct(),
                        'quantita' => (int)$quantita,
                        'subtotale' => $subtotale
                    ];
                }
            }
        }
        // Salva l'intero array del carrello nella sessione
        $session->setValue('cart', $cart); 
        // Utilizza il redirect HTTP 302 (URL pulito corretto)
        header("Location: /IlRitrovo/public/Delivery/showUserInfoPage");
        exit;
    }

    /**
     * Function to show the user's profile page after successfully completing the delivery process.
     */
    public function showUserInfoPage() {
        $viewU=new VUser();
        $viewD=new VDelivery();
        $session = USessions::getIstance();
        // Check if the user is logged in
        if ($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        } else {
            header("Location: /IlRitrovo/public/User/showUserLogin"); exit;
        }
        // Retrieve the cart from session
        $cart = $session->readValue('cart');
        // Check if the cart is empty and redirect to showDeliveryReservation if true
        if (empty($cart['items'])) {
            header("Location: /IlRitrovo/public/Delivery/showDeliveryReservation"); exit;
        }
        // Display user's profile page
        $viewU->showUserHeader($isLogged);
        $viewD->showUserInfoPage();
    }

    public function processUserInfo() {
        // Ottieni l'istanza della sessione
        $session = USessions::getIstance();
        // Avvia la sessione se necessario
        if ($session->isSessionNone()) {
            $session->startSession();
        }
        // Leggere i dati dalla Sessione
        $idUser = $session->readValue('idUser');
        $cart = $session->readValue('cart');
        // Leggere i Dati dal POST
        $userPhone = UHTTPMethods::post('userPhone');
        $userAddress = UHTTPMethods::post('userAddress');
        $userNumberAddress = (int)UHTTPMethods::post('userNumberAddress');
        // Idratare l'Utente via PM
        $pm = FPersistentManager::getInstance();
        $userObject = $pm->read($idUser, \Foundation\FUser::class);
        // Costruire il "Padre" (in RAM)
        $reservationObject = new EDeliveryReservation(
            null,
            $userObject,
            $userPhone,
            $userAddress,
            $userNumberAddress,
            new DateTime(),
            []
        );
        // Costruire i "Figli" (in RAM)
        foreach ($cart['items'] as $item) {
            $productObject = $pm->read((int)$item['id_prodotto'], \Foundation\FProduct::class);
            $itemObject = new EDeliveryItem(
                null,
                $reservationObject,
                $productObject,
                (int)$item['quantita']
            );
            // "Cucire" il figlio al padre
            $reservationObject->addItem($itemObject);
        }
        // Salvare in Sessione l'intero $reservationObject
        $session->setValue('reservation_in_progress', $reservationObject);
        // PRG (Redirect)
        header("Location: /IlRitrovo/public/Delivery/showPaymentPage");
        exit;
    }

    public function showPaymentPage() {

        $viewU=new VUser();
        $viewD=new VDelivery();
        $session = USessions::getIstance();
        // Check if the user is logged in
        if ($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }  
        // Controllo Sicurezza 1 (Login)
        if (!isset($idUser)) {
            header("Location: /IlRitrovo/public/User/login"); 
            exit;
        }
        // Carica Dati 1 (Ordine)
        $reservationObject = $session->readValue('reservation_in_progress');
        // Controllo Sicurezza 2 (Flusso)
        if ($reservationObject === null) {
            header("Location: /IlRitrovo/public/Delivery/showDeliveryReservation");
            exit;
        }
        // Carica Dati 2 (Carte di credito)
        $pm = FPersistentManager::getInstance();
        $creditCards = $pm->readCreditCardsByUser($idUser, \Foundation\FCreditCard::class);
        // Mostra la Vista
        $viewU->showUserHeader($isLogged);
        $viewD->showDeliveryPayment($reservationObject, $creditCards);
    }

    public function confirmOrder() {
        
        $session = USessions::getIstance();
        // Avvia la sessione se necessario
        if ($session->isSessionNone()) {
            $session->startSession();
        }
        $idUser = $session->readValue('idUser');
        $reservationObject = $session->readValue('reservation_in_progress');
        // Se non sei loggato o non hai un ordine in corso, vai via
        if (!isset($idUser) || !isset($reservationObject)) {
            header("Location: /IlRitrovo/public/User/showUserLogin");
            exit;
        }      
        // Leggo l'ID della carta credito dal POST
        $idCreditCard = (int)UHTTPMethods::post('id_carta_credito');       
        // Ottenere il PM
        $pm = FPersistentManager::getInstance();       
        // Salvare la Prenotazione (Padre e Figli)
        $newReservationId = $pm->create($reservationObject);        
        // Calcolare il Totale
        $total = 0.0;
        foreach ($reservationObject->getItems() as $item) {
            $total += $item->getSubtotal();
        }
        // Creare e Salvare il Pagamento
        $paymentObject = new EPayment(
            null, 
            $idCreditCard, 
            $newReservationId, 
            $total, 
            new DateTime(), 
            StatoPagamento::COMPLETATO // <-- CORREZIONE 3: (necessita 'use Entity\StatoPagamento;')
        );
        $pm->create($paymentObject);
        // Pulire la Sessione
        $session->deleteValue('reservation_in_progress');
        $session->deleteValue('cart');
        // PRG (Redirect)
        header("Location: /IlRitrovo/public/User/showHomePage");
        exit;
    }
}