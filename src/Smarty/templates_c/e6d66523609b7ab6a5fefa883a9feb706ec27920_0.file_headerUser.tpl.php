<?php
/* Smarty version 5.5.1, created on 2025-06-24 12:12:31
  from 'file:headerUser.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685a7a0fcff0a3_80221150',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6d66523609b7ab6a5fefa883a9feb706ec27920' => 
    array (
      0 => 'headerUser.tpl',
      1 => 1750759908,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685a7a0fcff0a3_80221150 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/marco/public_html/Progetto/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Header - Il Ritrovo</title>
    <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/header.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet" />
  </head>
  <body>
    <header>
      <div class="header-top">
        <!-- Logo e nome del sito -->
        <div class="logo-area">
          <img src="../assets/images/logo/logo.png" alt="Il Ritrovo Logo" class="logo" />
          <span class="site-name">Il Ritrovo</span>
        </div> <!-- /.logo-area-->

        <!-- Barra di navigazione -->
        <nav class="main-nav">
          <ul>
            <li><a href="CFrontController.php?controller=CUser&task=showHomePage">Home</a></li>
            <li><a href="CFrontController.php?controller=CFUser&task=showRoomsPage">Rooms</a></li>
            <li><a href="CFrontController.php?controller=CUser&task=showMenuPage">Menu</a></li>
            <li><a href="CFrontController.php?controller=CReview&task=showReviewsPage">Reviews</a></li>
          </ul>
        </nav>

        <!-- Pulsanti utente -->
        <div class="user-area">
          <?php if ($_smarty_tpl->getValue('isLogged')) {?>
            <a href="CFrontController.php?controller=CUser&task=showProfile" class="user-button">Profile</a>
            <a href="signupHandler.php" class="user-button">Logout</a>
          <?php } else { ?>
            <a href="signupHandler.php" class="user-button">Login</a>
            <a href="signupHandler.php" class="user-button">Sign up</a>
          <?php }?>
        </div> <!-- /.user-area-->
      </div> <!-- /.header-top-->
    </header>
  </body>
</html><?php }
}
