<?php

namespace Controller;

use DateTime;
use Exception;
use Entity\EProduct;
use Entity\EUser;
use Entity\Role;
use Foundation\FCreditCard;
use Foundation\FDeliveryItem;
use Foundation\FDeliveryReservation;
use Foundation\FPersistentManager;
use Foundation\FProduct;
use Foundation\FReply;
use Foundation\FReservation;
use Foundation\FReview;
use Foundation\FUser;
use Controller\CDelivery;
use View\VError;
use View\VUser;
use Utility\UCookies;
use Utility\UHTTPMethods;
use Utility\USessions;

/**
 * Class UserController
 *
 * Manages all of a user's main use cases
 */
class CUser {
    /**
     * Constructor
     */
    public function __construct() {
    }

    /**
     * Function to check if a user is logged
     * 
     * @return bool $identifier, true if user is logged, false otherwise
     */
    static function isLogged() {
        $identifier=false;
        $session=USessions::getIstance();
        if($session->isSessionSet()) {
            if($session->isSessionNone()) {
                $session->startSession();
            }
        }
        if($session->isValueSet('idUser')) {
            $identifier=true;
        }
        return($identifier);
    }

    /**
     * Function to show login page with forms. Sets a test cookie to check if the user's cookies are enabled
     */
    public function showLoginForm() {
        $view = new VUser();
        setcookie('cookie_test', '1', time() + 7200, '/');
        $view->showLoginForm();
    }

    /**
     * Function to show signup page with forms. Sets a test cookie to check if the user's cookies are enabled
     */
    public function showSignUpForm() {
        $view=new VUser();
        setcookie('cookie_test', '1', time() + 7200, '/');
        $view->showSignUpForm();
    }

    /**
     * Function to logout the user and redirect to home page
     */
    public function logout() {
        $session=USessions::getIstance();
        $session->startSession();
        $session->stopSession();
        setcookie("PHPSESSID", "");
        header("Location: /IlRitrovo/public/User/showHomePage");
        exit;
    }
    

    /**
     * Function to show logged user's "Profile" page
     */
    public function showProfile() {
        $view=new VUser();
        $session=USessions::getIstance();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        $user=FPersistentManager::getInstance()->read($idUser, FUser::class);
        $username=$user->getUsername();
        $email=$user->getEmail();
        $name=$user->getName();
        $surname=$user->getSurname();
        $birthDate=$user->getBirthdate();
        $phone=$user->getPhone();
        $edit_section="";
        $userCreditCards=FPersistentManager::getInstance()->readCreditCardsByUser($idUser, FCreditCard::class);
        $userPastReservations=FPersistentManager::getInstance()->readPastReservationsByUserId($idUser, FReservation::class);
        $userFutureReservations=FPersistentManager::getInstance()->readFutureReservationsByUserId($idUser, FReservation::class);
        $deliveryReservations=FPersistentManager::getInstance()->readCompleteDeliveryReservationsByUser($idUser);
        $userReview=FPersistentManager::getInstance()->readReviewByUserId($idUser, FReview::class);
        if($userReview!==null && $userReview->getIdReply()!==null) {
            $reply=FPersistentManager::getInstance()->read($userReview->getIdReply(), FReply::class);
            $userReview->setReply($reply);
        }
        $view->showUserHeader($isLogged);
        $view->showProfile($username, $email, $name, $surname, $birthDate, $phone, $edit_section, $userCreditCards, $userPastReservations, $userFutureReservations, $deliveryReservations, $userReview);
    }

    /**
     * Function to show the form to edit the Profile's data
     */
    public function showEditProfileData() {
        $view=new VUser();
        $view->showEditProfileData();
    }

    /**
     * Function to edit user's data
     */
    public function editProfileData() {
        $session=USessions::getIstance();
        $session->startSession();
        $idUser=$session->readValue('idUser');
        $user=FPersistentManager::getInstance()->read($idUser, FUser::class);
        $user->setName(UHTTPMethods::post('name'));
        $user->setSurname(UHTTPMethods::post('surname'));
        $user->setBirthDate(new DateTime(UHTTPMethods::post('birthDate')));
        $user->setPhone(UHTTPMethods::post('phone'));
        try {
            $updated=FPersistentManager::getInstance()->updateProfileData($user);
            if($updated) {
                header("Location: /IlRitrovo/public/User/showProfile");
                exit;
            }
        } catch (Exception $e) {
            VError::showError($e->getMessage());
            exit;
        }
    }

    /**
     * Function to show the form to edit user's metadata
     */
    public function showEditProfileMetadata() {
        $view=new VUser();
        $view->showEditProfileMetadata();
    }

    /**
     * Function to edit user's metadata 
     */
    public function editProfileMetadata() {
        $session=USessions::getIstance();
        $session->startSession();
        $idUser=$session->readValue('idUser');
        $user=FPersistentManager::getInstance()->read($idUser, FUser::class);
        $user->setUsername(UHTTPMethods::post('username'));
        $user->setEmail(UHTTPMethods::post('email'));
        $user->setPassword(UHTTPMethods::post('password'));
        try {
            $updated=FPersistentManager::getInstance()->updateProfileMetadata($user);
            if($updated) {
                header("Location: /IlRitrovo/public/User/showProfile");
                exit;
            } 
        } catch (Exception $e) {
            VError::showError($e->getMessage());
            exit;
        }
    }

    /**
     * Function to validate the data inserted by user, error page or cookie enablement page if they are disabled
     * Redirect the new User to the home page
     * 
     * @throws Exception if something goes wrong like existing username or email
     */
    public function checkRegister() {
        $view=new VUser();
        $session=USessions::getIstance();
        if (!UCookies::isSet('cookie_test')) {
            $view->showUserHeader(false);
            $view->showDisabledCookies();
            exit;
        }
        $newUser=new EUser(
            null,
            null,
            UHTTPMethods::post('username'),
            UHTTPMethods::post('email'),
            UHTTPMethods::post('password'),
            UHTTPMethods::post('name'),
            UHTTPMethods::post('surname'),
            new DateTime(UHTTPMethods::post('birthDate')),
            UHTTPMethods::post('phone'),
            Role::UTENTE,
            false
        );
        try {
            FPersistentManager::getInstance()->create($newUser);
        } catch (Exception $e) {
            VError::showError($e->getMessage());
            exit;
        }
        $session->startSession();
        $session->setValue('idUser', $newUser->getIdUser());
        $session->setValue('triggerPopup', true);
        setcookie('cookie_test', '', time() - 7200, '/');
        header("Location: /IlRitrovo/public/User/showHomePage");
        exit;
    }

    /**
     * Function to validate the data inserted by user, error page or cookie enablement page if they are disabled
     * If registered, the user will be logged
     */
    public function checkLogin() {
    $view=new VUser();
    $session=USessions::getIstance();
    if (!UCookies::isSet('cookie_test')) {
        $view->showUserHeader(false);
        $view->showDisabledCookies();
        exit;
    }
    if($session->isSessionNone()) {
        $session->startSession();
    }
    try {
        $checkUser=FPersistentManager::getInstance()->readUserByEmail(UHTTPMethods::post('email'), FUser::class);
    } catch (Exception $e) {
        VError::showError($e->getMessage());
        exit;
    }
    $checkPassword=$checkUser->getPassword();
    if(password_verify(UHTTPMethods::post('password'), $checkPassword)) {
        if($checkUser->isAdmin()) {
            $session->startSession();
            $session->setValue('idUser', $checkUser->getIdUser());
            }
        if($checkUser->getBan()===1) {
            VError::showError('Sei bannato, non puoi accedere a questa applicazione');
            exit;
            }
        } else {
            VError::showError('Invalid Password, please retry');
            exit;
        }
    $session->startSession();
    $session->setValue('idUser', $checkUser->getIdUser());
    $session->setValue('triggerPopup', true);
    setcookie('cookie_test', '', time() - 7200, '/');
    header("Location: /IlRitrovo/public/User/showHomePage");
    exit;
    }


    /**
     * Function to show user's home page, if they are admin or user, accordingly
     */
    public static function showHomePage() {
        $view=new VUser();
        $session=USessions::getIstance();
        if($session->isSessionNone()) {
            $session->startSession();
        }
        $trigger=false;
        if($session->isValueSet('triggerPopup') && $session->readValue('triggerPopup')===true) {
            $trigger=true;
            $session->deleteValue('triggerPopup');
        }
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
            $user=FPersistentManager::getInstance()->read($idUser, FUser::class);
            if($user->isUser() && $user->getBan()===0) {
                $view->showUserHeader($isLogged);
                $view->showLoggedUserHomePage($isLogged, $trigger);
            }
            elseif($user->isAdmin()) {
                $view->showAdminHeader($isLogged);
                list($comingTableReservations, $comingRoomReservations)=CReservation::getStructuredReservationsForAdmin();
                $view->showLoggedAdminHomePage($isLogged, $comingTableReservations, $comingRoomReservations);
            }
        } else {
            $view->showUserHeader($isLogged);
            $view->showUserHomePage($isLogged);
        }
    }

    /**
     * Function to show "Menu" page
     */
    public function showMenuPage() {
        $view=new VUser();
        $session=USessions::getIstance();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        $view->showUserHeader($isLogged);
        $view->showMenuPage();
    }

    /**
     * Function to show "Rooms" page
     */
    public function showRoomsPage() {
        $view=new VUser();
        $session=USessions::getIstance();
        if($isLogged=CUser::isLogged()) {
            $idUser=$session->readValue('idUser');
        }
        $view->showUserHeader($isLogged);
        $view->showRoomsPage();
    }

    /**
     * Function to show "User" page to the admin
     */
    public function showUsersPage() {
        $view = new VUser();
        $session = USessions::getIstance();
        if ($isLogged = CUser::isLogged()) {
            $idUser = $session->readValue('idUser');
        }
        $allUsersRaw = FPersistentManager::getInstance()->readAll(FUser::class);
        $allUsers = [];
        $blocked_user = [];
        foreach ($allUsersRaw as $user) {
            if ($user->isAdmin()) {
                continue;
            }
            if ($user->getBan() === 1) {
                $blocked_user[] = $user;
            } else {
                $allUsers[] = $user;
            }
        }
        $view->showAdminHeader($isLogged);
        $view->showUsersPage($blocked_user, $allUsers);
    }

    /**
     * Function to ban a User
     */
    public function banUser() {
        $idUserToBan=UHTTPMethods::post('userId');
        $userToBan=FPersistentManager::getInstance()->read($idUserToBan, FUser::class);
        $userToBan->setBan(true);
        $bannedUser=FPersistentManager::getInstance()->update($userToBan);
        if($bannedUser) {
            header("Location: /IlRitrovo/public/User/showUsersPage");
            exit;
        }

    }

    /**
     * Function to unban a User
     */
    public function unbanUser() {
        $idUserToUnban=UHTTPMethods::post('userId');
        $userToUnban=FPersistentManager::getInstance()->read($idUserToUnban, FUser::class);
        $userToUnban->setBan(false);
        $unbannedUser=FPersistentManager::getInstance()->update($userToUnban);
        if($unbannedUser) {
            header("Location: /IlRitrovo/public/User/showUsersPage");
            exit;
        }
    }
}