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

    public function showUserInfoPage() {
        $smarty=new USmartyConfig();
        $smarty->display('deliveryUserInfo.tpl');
    }

    public function showDeliveryPayment($reservation, array $creditCards) {
        $smarty = new USmartyConfig();
        $smarty->assign('reservation', $reservation);
        $smarty->assign('creditCards', $creditCards);

        $smarty->display('deliveryPayment.tpl');
    }

    public function confirmedOrder() {
        $smarty=new USmartyConfig();
        $smarty->display('confirmedOrder.tpl');
    }
}