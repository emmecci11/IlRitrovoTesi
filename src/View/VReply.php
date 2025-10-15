<?php

namespace View;

use Utility\USmartyConfig;

/**
 * Class View VReply
 * Load all Reply's tpl via Smarty
 */
class VReply {
    /**
     * Function to show reply form
     * 
     * @param int $idReview, ID of the Review to reply
     */
    public function showReplyForm(int $idReview) {
        $smarty = new USmartyConfig();
        $smarty->assign('showReplyForm', $idReview);
        $smarty->display('adminReview.tpl');
    }
}