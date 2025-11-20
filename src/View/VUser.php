<?php

namespace View;

use Entity\EReview;
use Utility\USmartyConfig;

/**
 * Class View VUser
 * Load all User's tpl via Smarty
 */
class VUser {
    /**
     * Function to show User's header, logged or unlogged accordly
     * 
     * @param bool $isLogged
     */
    public function showUserHeader(bool $isLogged) {
        $smarty = new USmartyConfig();
        $smarty->assign('isLogged', $isLogged);
        $smarty->display('headerUser.tpl');
    }

    /**
     * Function to show admin's header
     * 
     * @param bool $isLogged
     */
    public function showAdminHeader(bool $isLogged) {
        $smarty = new USmartyConfig();
        $smarty->assign('isLogged', $isLogged);
        $smarty->display('headerAdmin.tpl');
    }

    /**
     * Function to show logged user home page
     * 
     * @param bool $isLogged
     * @param bool $triggerPopup, show success operation true or false accordly
     */
    public function showLoggedUserHomePage(bool $isLogged, bool $triggerPopup=false) {
        $smarty = new USmartyConfig();
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('triggerPopup', $triggerPopup);
        $smarty->display('home.tpl');
    }

    /**
     * Function to show logged admin home page
     * 
     * @param bool $isLogged
     * @param array $comingTableReservations
     * @param array $comingRoomReservations
     */
    public function showLoggedAdminHomePage(bool $isLogged, array $comingTableReservations, array $comingRoomReservations) {
        $smarty = new USmartyConfig();
        $smarty->assign('isLogged', $isLogged);
        $smarty->assign('comingTableReservations', $comingTableReservations);
        $smarty->assign('comingRoomReservations', $comingRoomReservations);
        $smarty->display('adminHome.tpl');
    }

    /**
     * Function to show non unlogged user home page
     * 
     * @param bool $triggerPopup
     */
    public function showUserHomePage(bool $triggerPopup=false) {
        $smarty = new USmartyConfig();
        $smarty->assign('triggerPopup', $triggerPopup);
        $smarty->display('home.tpl');
    }

    /**
     * Function to show login page
     */
    public function showLoginForm() {
        $smarty = new USmartyConfig();
        $smarty->display("login.tpl");
    }

    /**
     * Function to show signup page with forms
     */
    public function showSignUpForm() {
        $smarty = new USmartyConfig();
        $smarty->display("signUp.tpl");
    }

    /**
     * Function to show user's info profile
     * 
     * @param string $username
     * @param string $email
     * @param string $name
     * @param string $username
     * @param string $birthDate
     * @param string $phone
     * @param string $editSection (for tpl, need for showing or not edit section)
     * @param array $userCreditcards
     * @param array $userPastReservations
     * @param array $userFutureReservations
     * @param array $deliveryReservations
     * @param null|EReview $userReview
     */
    public function showProfile(string $username, string $email, string $name, string $surname, string $birthDate, string $phone, string $edit_section, array $userCreditCards,array $userPastReservations, array $userFutureReservations, array $deliveryReservations, ?EReview $userReview) {
        $smarty = new USmartyConfig();
        $smarty->assign('username', $username);
        $smarty->assign('email', $email);
        $smarty->assign('name', $name);
        $smarty->assign('surname', $surname);
        $smarty->assign('birthdate', $birthDate);
        $smarty->assign('phone', $phone);
        $smarty->assign('edit_section', $edit_section);
        $smarty->assign('cards', $userCreditCards);
        $smarty->assign('pastReservations', $userPastReservations);
        $smarty->assign('futureReservations', $userFutureReservations);
        $smarty->assign('deliveryReservations', $deliveryReservations);
        $smarty->assign('review', $userReview);
        $smarty->display('userProfile.tpl');
    }

    /**
     * Function to show edit forms to edit personal data
     */
    public function showEditProfileData() {
        $smarty = new USmartyConfig();
        $smarty->display('editProfileData.tpl');
    }

    /**
     * Function to show edit forms to edit metadata: email, username and password
     */
    public function showEditProfileMetadata() {
        $smarty = new USmartyConfig();
        $smarty->display('editProfileMetadata.tpl');
    }

    /**
     * Function to show disabled cookies warning
     */
    public function showDisabledCookies() {
        $smarty = new USmartyConfig();
        $smarty->display('disabledCookies.tpl');
    }

    /**
     * Function to show menu page
     */
    public function showMenuPage() {
        $smarty = new USmartyConfig();
        $smarty->display('menu.tpl');
    }

    /**
     * Function to show Rooms page
     */
    public function showRoomsPage() {
        $smarty = new USmartyConfig();
        $smarty->display('rooms.tpl');
    }

    /**
     * Function to show User's Page for admin
     * 
     * @param array $blocked_user
     * @param array $allUsers
     */
    public function showUsersPage(array $blocked_user, array $allUsers) {
        $smarty = new USmartyConfig();
        $smarty->assign('blocked_user', $blocked_user);
        $smarty->assign('allUsers', $allUsers);
        $smarty->display('adminUsers.tpl');
    }
}
