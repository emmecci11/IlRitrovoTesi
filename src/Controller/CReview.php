<?php

namespace Controller;

use DateTime;
use Exception;
use Entity\EReview;
use Foundation\FPersistentManager;
use Foundation\FReply;
use Foundation\FReview;
use Foundation\FUser;
use View\VError;
use View\VReview;
use View\VUser;
use Utility\UHTTPMethods;
use Utility\USessions;


/**
 * Class Controller CReview
 * Manages all the Review's main use cases
 */
class CReview {
    /**
     * Constructor
     */
    public function __construct() {
    }
    /**
     * Function to create a Review (need past Reservation)
     */
    public function checkAddReview() {
        $session=USessions::getIstance();
        $session->startSession();
        $idUser=$session->readValue('idUser');
        $newReview=new EReview(
            $idUser,
            null,
            UHTTPMethods::post('stars'),
            UHTTPMethods::post('body'),
            new DateTime(),
            null
        );
        $pastUserReservation=CReservation::getPastReservations();
        try {
            if(!empty($pastUserReservation)){
                FPersistentManager::getInstance()->create($newReview);
                header("Location: /IlRitrovo/public/User/showProfile");
                exit;
            } else {
                VError::showError('Non puoi scrivere una recensione se non hai una prenotazione passata');
            }
        } catch (Exception $e) {
            VError::showError($e->getMessage());
        }
    }

    /**
     * Function to delete a review
     * 
     * @param $idReview taken from the HTTP request
     * @return bool true if success, false otherwise
     */
    public function deleteReview($idReview) {
        $session=USessions::getIstance();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        $user=FPersistentManager::getInstance()->read($idUser, FUser::class);
        $deleted=FPersistentManager::getInstance()->delete($idReview, FReview::class);
        if($deleted && $user->isUser()) {
            header("Location: /IlRitrovo/public/User/showProfile");
            exit;
        }
        elseif($deleted && $user->isAdmin()) {
            header("Location: /IlRitrovo/public/Review/showReviewsPage");
            exit;
        }
        elseif(!$deleted) {
            VError::showError('Error during the operation, please retry');
        }
    }

    /**
     * Function to show users' "Reviews" page, if they are admin or user, accordingly
     * 
     * @param int|null $showReplyForm, to show Reply form if user is admin
     */
    public static function showReviewsPage(?int $showReplyForm=null) {
        $viewU = new VUser();
        $viewR = new VReview();
        $session = USessions::getIstance();
        $isLogged = CUser::isLogged();
        if ($isLogged) {
            $idUser = $session->readValue('idUser');
            $user = FPersistentManager::getInstance()->read($idUser, FUser::class);
        }else {
            $user = null;
        }
        $allReviews = FPersistentManager::getInstance()->readAll(FReview::class);
        foreach ($allReviews as $review) {
            $idReviewUser = $review->getIdUser();
            $reviewUser = FPersistentManager::getInstance()->read($idReviewUser, FUser::class);
            if ($reviewUser !== null) {
                $review->setUsername($reviewUser->getUsername());
            }else {
                $review->setUsername('Unknown User');
            }
            $idReply=$review->getIdReply();
            if($idReply!==null) {
                $reply=FPersistentManager::getInstance()->read($idReply, FReply::class);
                $review->setReply($reply);
            }
        }
        if ($user !== null && $user->isAdmin()) {
            $viewU->showAdminHeader($isLogged);
            $viewR->showReviewsAdminPage($allReviews, $showReplyForm);
        }elseif ($user !== null) {
            $viewU->showUserHeader($isLogged);
            $viewR->showReviewsUserPage($allReviews);
        }else {
            $viewU->showUserHeader($isLogged);
            $viewR->showReviewsUserPage($allReviews);
            }
    }
}