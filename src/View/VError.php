<?php

namespace View;

use Utility\USmartyConfig;

/**
 * Class View VError
 * Load all Error's tpl via Smarty
 */
class VError {
    /**
     * Function to show Error Page during any operation
     * 
     * @param string $message, the message to show
     */
    public static function showError($message) {
        $smarty = new USmartyConfig();
        $smarty->assign('errorMessage', $message);
        $smarty->display('error.tpl');
    }
}