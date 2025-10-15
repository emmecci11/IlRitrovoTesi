<?php

namespace View;

use Entity\EExtra;
use Utility\USmartyConfig;

/**
 * Class View VExtra
 * Load all Extra's tpl via Smarty
 */
class VExtra {
    /**
     * Function to show extra's page
     * 
     * @param array $allExtras, array that contain all the extras
     */
    public function showExtrasPage(array $allExtras) {
        $smarty = new USmartyConfig();
        $smarty->assign('allExtras', $allExtras);
        $smarty->assign('show_extra_form', true);
        $smarty->display('adminExtra.tpl');
    }

    /**
     * Function to show Extra's edit page
     * 
     * @param EExtra $extra, the Extra to edit
     */
    public function showEditExtraPage(EExtra $extra) {
        $smarty = new USmartyConfig();
        $smarty->assign('extra', $extra);
        $smarty->display('editExtraData.tpl');
    }
}

