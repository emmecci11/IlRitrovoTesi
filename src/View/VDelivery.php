<?php

namespace View;

use Entity\EProduct;
use Entity\EDeliveryItem;
use Entity\EDeliveryReservation;
use Smarty\Smarty;
use Utility\USessions;
use Utility\USmartyConfig;

class VDelivery {

    public function showDeliveryReservation(array $allProducts) {
        $smarty=new USmartyConfig();
        $smarty->assign('allProducts', $allProducts);
        $smarty->display('deliveryReservationMenu.tpl');
    }

    public function showDeliveryUserInfo() {
        $smarty=new USmartyConfig();
        $smarty->display('deliveryUserInfo.tpl');
    }

    public function showPaymentMethod(array $orderProducts, array $userCreditCards, float $totalPrice) {
        $smarty = new USmartyConfig();
        $session = USessions::getIstance();
        $quantities = $session->readValue('quantities');

        $smarty->assign('orderProducts', $orderProducts);
        $smarty->assign('userCreditCards', $userCreditCards);
        $smarty->assign('totalPrice', $totalPrice);
        $smarty->assign('quantities', $quantities);

        $smarty->display('deliveryPaymentMethodAndSummarize.tpl');
    }

    public function confirmedOrder() {
        $smarty=new USmartyConfig();
        $smarty->display('confirmedOrder.tpl');
    }
}