<?php

namespace Controller;

use DateTime;
use Exception;
use Entity\ECreditCard;
use Foundation\FCreditCard;
use Foundation\FPersistentManager;
use View\VCreditCard;
use View\VError;
use Utility\UHTTPMethods;
use Utility\USessions;

/**
 * Class Controller CCreditCard
 * Manages all the Credit Cards' main use cases
 */
class CCreditCard {
    /**
     * Construct
     */
    public function __construct() {
    }

    /**
     * Function to show form to add new Credit Cards from "Profile" page
     */
    public function showAddCreditCardUserProfile() {
        $view=new VCreditCard();
        $view->showAddCreditCardUserProfile();
    }

    /**
     * Function to show form to add new Credit Cards from reservation (step3)
     */
    public function showAddCreditCardStep3() {
        $view=new VCreditCard();
        $view->showAddCreditCardStep3();
    }

    /**
     * Function to add new Credit Cards in db from "Profile" page
     */
    public function checkAddCreditCard() {
        $session=USessions::getIstance();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        $type=UHTTPMethods::post('cardType');
        $number=UHTTPMethods::post('cardNumber');
        $cvv = UHTTPMethods::post('cardCVV');
        $holder=UHTTPMethods::post('cardHolder');
        $expiration=new DateTime(UHTTPMethods::post('expiryDate'));
        $newCreditCard=new ECreditCard(
            null,
            $holder,
            $number,
            $cvv,
            $expiration,
            $type,
            $idUser
        );
        try {
            if($addedCreditCard=FPersistentManager::getInstance()->create($newCreditCard)!== null) {
                header("Location: /IlRitrovo/public/User/showProfile");
                exit;
            }
        } catch (Exception $e) {
            VError::showError($e->getMessage());
        }
    }

    /**
     * Function to add new Credit Cards in db from reservation (step3)
     */
    public function checkAddCreditCardStep3() {
        $session=USessions::getIstance();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        $type=UHTTPMethods::post('cardType');
        $number=UHTTPMethods::post('cardNumber');
        $cvv = UHTTPMethods::post('cardCVV');
        $holder=UHTTPMethods::post('cardHolder');
        $expiration=new DateTime(UHTTPMethods::post('expiryDate'));
        $newCreditCard=new ECreditCard(
            null,
            $holder,
            $number,
            $cvv,
            $expiration,
            $type,
            $idUser
        );
        try {
            if($addedCreditCard=FPersistentManager::getInstance()->create($newCreditCard)!== null) {
                header("Location: /IlRitrovo/public/Reservation/dataRoomReservation");
                exit;
            }  
        } catch (Exception $e) {
            VError::showError($e->getMessage());
        }
    }

    /**
     * Function to delete existing Credit Cards
     * 
     * @param $idCreditCard, the ID of the Credit Card to delete
     */
    public function deleteCreditcard($idCreditCard) {
        if(FPersistentManager::getInstance()->delete($idCreditCard, FCreditCard::class)) {
            header("Location: /IlRitrovo/public/User/showProfile");
            exit;
        }
    }

























































}