<?php

namespace View;

use Utility\USmartyConfig;

/**
 * Class View VEmail
 * Load all Email's tpl via Smarty
 */
class VEmail {
    /**
     * Function to show email tables tpl
     * 
     * @param array $data, informations to send
     */
    public function showTablesEmail(array $data) {
        $smarty = new USmartyConfig();
        $smarty->assign('data', $data);
        return $smarty->fetch('emailTables.tpl');
    }

    /**
     * Function to show email rooms tpl
     * 
     * @param array $data, informations to send
     */
    public function showRoomsEmail(array $data) {
        $smarty = new USmartyConfig();
        $smarty->assign('data', $data);
        return $smarty->fetch('emailRooms.tpl');
    }
}