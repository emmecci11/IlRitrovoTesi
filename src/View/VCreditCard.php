<?php

namespace View;

use Utility\USmartyConfig;

/**
 * Class View VCreditCard
 * Load all CreditCards' tpl via Smarty
 */
class VCreditCard {
    /**
     * Function to show new Credit Card form from user profile
     */
    public function showAddCreditCardUserProfile() {
        $smarty = new USmartyConfig();
        $allowedTypes=['Visa', 'Mastercard', 'American Express', 'Maestro', 'V-Pay', 'PagoBANCOMAT'];
        $smarty->assign('allowedTypes', $allowedTypes);
        $smarty->display('addCreditCardUserProfile.tpl');
    }

    /**
     * Function to show new Credit Card form from step 3 reservation
     */
    public function showAddCreditCardStep3() {
        $smarty = new USmartyConfig();
        $allowedTypes=['Visa', 'Mastercard', 'American Express', 'Maestro', 'V-Pay', 'PagoBANCOMAT'];
        $smarty->assign('allowedTypes', $allowedTypes);
        $smarty->display('addCreditCardStep3.tpl');
    }
}