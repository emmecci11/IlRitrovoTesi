<?php

namespace Controller;

use Entity\EExtra;
use Foundation\FExtra;
use Foundation\FPersistentManager;
use View\VExtra;
use View\VUser;
use Utility\UHTTPMethods;
use Utility\USessions;

/**
 * Class Controller CExtra
 * Manages all the Extra's CRUD operation use cases
 */
class CExtra {
    /**
     * Function to show the "Extras" page to the admin
     */
    public function showExtrasPage() {
        $viewU=new VUser();
        $viewE=new VExtra();
        $session=USessions::getIstance();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        $allExtras=FPersistentManager::getInstance()->readAll(FExtra::class);
        $viewU->showAdminHeader($isLogged);
        $viewE->showExtrasPage($allExtras);
    }

    /**
     * Function to create a new Extra
     */
    public function addExtra() {
        $nameExtra=UHTTPMethods::post('name');
        $priceExtra=UHTTPMethods::post('price');
        $newExtra=new EExtra(
            null,
            $nameExtra,
            $priceExtra
        );
        $addedExtra=FPersistentManager::getInstance()->create($newExtra);
        if($addedExtra!=null) {
            header("Location: /IlRitrovo/public/Extra/showExtrasPage");
            exit;
        }
    }

    /**
     * Function to delete an existing Extra
     * 
     * @param int $idExtra, ID of the extra to delete
     */
    public function deleteExtra($idExtra) {
        $deletedExtra=FPersistentManager::getInstance()->delete($idExtra, FExtra::class);
        if($deletedExtra===true) {
            header("Location: /IlRitrovo/public/Extra/showExtrasPage");
            exit;
        }
    }

    /**
     * Function to show form for edit an existing Extra
     * 
     * @param int $idExtra, ID of the Extra to edit
     */
    public function showEditExtra($idExtra) {
        $view=new VExtra();
        $extra=FPersistentManager::getInstance()->read($idExtra, FExtra::class);
        $view->showEditExtraPage($extra);
    }

    /**
     * Function to edit an extra
     * 
     * @param int $idExtra, ID of the Extra to edit
     */
    public function saveEditExtra($idExtra) {
        $view=new VExtra();
        $newNameExtra=UHTTPMethods::post('name');
        $newPriceExtra=UHTTPMethods::post('price');
        $oldExtra=FPersistentManager::getInstance()->read($idExtra, FExtra::class);
        $oldExtra->setNameExtra($newNameExtra);
        $oldExtra->setPriceExtra($newPriceExtra);
        $editedExtra=FPersistentManager::getInstance()->update($oldExtra);
        if($editedExtra===true) {
            header("Location: /IlRitrovo/public/Extra/showExtrasPage");
            exit;
        }
    }
}