<?php

namespace View;

use Entity\ECreditCard;
use Entity\EReservation;
use Entity\ERoom;
use Utility\USmartyConfig;

/**
 * Class View VReservation
 * Load all Reservation's tpl via Smarty
 */
class VReservation {
    /**
     * Function to show Reservation form
     */
    public function showTableForm() {
        $smarty = new USmartyConfig();
        $smarty->display('tableReservation1.tpl');
    }
    
    /**
     * Function to show summary and all available tables
     * 
     * @param string $timeFrame
     * @param int $people
     * @param string $reservationDate
     * @param string $comment
     * @param array $availableTables
     */
    public function showSummaryAndAvailableTables(string $timeFrame, int $people, string $reservationDate, string $comment, array $availableTables) {
        $smarty = new USmartyConfig();
        $smarty->assign('timeFrame', $timeFrame);
        $smarty->assign('people', $people);
        $smarty->assign('reservationDate', $reservationDate);
        $smarty->assign('comment', $comment);
        $smarty->assign('availableTables', $availableTables);
        $smarty->display('tableReservation2.tpl');
    }
    
    /**
     * Function to show full summary Page
     * 
     * @param string $timeFrame
     * @param int $people
     * @param string $reservationDate
     * @param string $comment
     * @param int $idTable
     */
    public function showFullSummary(string $timeFrame, int $people, string $reservationDate, string $comment, int $idTable) {
        $smarty = new USmartyConfig();
        $smarty->assign('timeFrame', $timeFrame);
        $smarty->assign('people', $people);
        $smarty->assign('reservationDate', $reservationDate);
        $smarty->assign('comment', $comment);
        $smarty->assign('idTable', $idTable);
        $smarty->display('tableReservation3.tpl');
    }

    /**
     * Function to show Reservation Room form's with associated extras to select
     * 
     * @param array $allExtras
     */
    public function showRoomForm(array $allExtras) {
        $smarty = new USmartyConfig();
        $smarty->assign('extras', $allExtras);
        $smarty->display('roomReservation1.tpl');
    }

    /**
     * Function to show summary and all available Rooms
     * 
     * @param string $timeFrame
     * @param int $people
     * @param string $reservationDate
     * @param string $comment
     * @param array $selectedExtras
     * @param $totPriceExtra
     * @param array $availableRooms
     */
    public function showSummaryAndAvailableRooms(string $timeFrame, int $people, string $reservationDate, string $comment, array $selectedExtras, float $totPriceExtra, array $availableRooms, ) {
        $smarty = new USmartyConfig();
        $smarty->assign('timeFrame', $timeFrame);
        $smarty->assign('people', $people);
        $smarty->assign('reservationDate', $reservationDate);
        $smarty->assign('comment', $comment);
        $smarty->assign('extras', $selectedExtras);
        $smarty->assign('totPriceExtra', $totPriceExtra);
        $smarty->assign('availableRooms', $availableRooms);
        $smarty->display('roomReservation2.tpl');
    }

    /**
     * Function to show summary and available payment methods
     * 
     * @param string $timeFrame
     * @param int $people
     * @param string $reservationDate
     * @param string $comment
     * @param array $selectedExtras
     * @param ERoom $selectedRoom
     * @param float $extraAndRoomPrice
     * @param array $userCreditCards
     */
    public function showSummaryAndPaymentMethods( string $timeFrame, int $people, string $reservationDate, string $comment, array $selectedExtras, ERoom $selectedRoom, float $extraAndRoomPrice, array $userCreditCards) {
        $smarty = new USmartyConfig();
        $smarty->assign('timeFrame', $timeFrame);
        $smarty->assign('people', $people);
        $smarty->assign('reservationDate', $reservationDate);
        $smarty->assign('comment', $comment);
        $smarty->assign('extras', $selectedExtras);
        $smarty->assign('selectedRoom', $selectedRoom);
        $smarty->assign('totalPrice', $extraAndRoomPrice);
        $smarty->assign('userCreditCards', $userCreditCards);
        $smarty->display('roomReservation3.tpl');
    }

    /**
     * Function to show full summary include selected payment method
     * 
     * @param string $timeFrame
     * @param int $people
     * @param string $reservationDate
     * @param string $comment
     * @param array $selectedExtras
     * @param ERoom $selectedRoom
     * @param float $extraAndRoomPrice
     * @param ECreditCard $selectedCreditCard
     */
    public function showSummaryRoomAndPaymentMethodes(string $timeFrame, int $people, string $reservationDate, string $comment, array $selectedExtras, ERoom $selectedRoom, float $extraAndRoomPrice, ECreditCard $selectedCard) {
    $smarty = new USmartyConfig();
    $smarty->assign('timeFrame', $timeFrame);
    $smarty->assign('people', $people);
    $smarty->assign('reservationDate', $reservationDate);
    $smarty->assign('comment', $comment);
    $smarty->assign('extras', $selectedExtras);
    $smarty->assign('selectedRoom', $selectedRoom);
    $smarty->assign('totalPrice', $extraAndRoomPrice);
    $smarty->assign('selectedCard', $selectedCard);
    $smarty->display('roomReservation4.tpl');
    }

    /**
     * Function to show a Reservatio summary's in order to dimiss it
     * 
     * @param string $reservationDate
     * @param string $timeFrame
     * @param int $people
     * @param string $comment
     */
    public function showRemoveReservation(string $reservationDate, string $timeFrame, int $people, string $comment) {
        $smarty = new USmartyConfig();
        $smarty->assign('reservationDate', $reservationDate);
        $smarty->assign('timeFrame', $timeFrame);
        $smarty->assign('people', $people);
        $smarty->assign('comment', $comment);
        $smarty->display('removeReservation.tpl');

    }
    
}