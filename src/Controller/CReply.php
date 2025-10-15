<?php
namespace Controller;

use DateTime;
use Entity\EReply;
use Foundation\FPersistentManager;
use Foundation\FReview;
use View\VReview;
use Utility\UHTTPMethods;
use Utility\USessions;

/**
 * Class Controller CReply
 * Manages all Reply's main use cases
 */
class CReply {
    /**
     * Constructor
     */
    public function __construct() {
    }

    /**
     * Function to show Reply form
     * 
     * @param $idReview, ID of the Review to answer
     */
    public function showReplyForm($idReview) {
        CReview::showReviewsPage($idReview);
    }

    /**
     * Function to validate and create a new reply
     * 
     * @param $idReview, ID of the Review to answer
     */
    public function addReply($idReview) {
        $view=new VReview();
        $session=USessions::getIstance();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        $body=UHTTPMethods::post('replyBody');
        $newReply=new EReply(
            null,
            new DateTime(),
            $body
        );
        $idReply=FPersistentManager::getInstance()->create($newReply);
        if($idReply!==null) {
            $review=FPersistentManager::getInstance()->read($idReview, FReview::class);
            $review->setIdReply($idReply);
            FPersistentManager::getInstance()->update($review);
            header("Location: /IlRitrovo/public/Review/showReviewsPage");
            exit;
        }
    }
}
    
