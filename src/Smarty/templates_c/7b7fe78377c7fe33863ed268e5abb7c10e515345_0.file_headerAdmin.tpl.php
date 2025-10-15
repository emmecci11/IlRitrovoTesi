<?php
/* Smarty version 5.5.1, created on 2025-06-26 15:28:38
  from 'file:headerAdmin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685d4b06173794_56852313',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b7fe78377c7fe33863ed268e5abb7c10e515345' => 
    array (
      0 => 'headerAdmin.tpl',
      1 => 1750944498,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685d4b06173794_56852313 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Header - Il Ritrovo (Admin)</title>
    <link href="/IlRitrovo/src/Smarty/css/header.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet" />
  </head>
  <body>
    <header>
      <div class="header-top">
        <div class="logo-area">
          <img src="/IlRitrovo/src/Smarty/assets/images/logo/logo.png" alt="Logo Il Ritrovo" class="logo" />
          <span class="site-name">Il Ritrovo</span>
        </div> <!-- /.logo-area -->

        <nav class="main-nav">
          <ul>
            <li><a href="/IlRitrovo/public/User/showHomePage">Home</a></li>
            <li><a href="/IlRitrovo/public/User/showUsersPage">Users</a></li>
            <li><a href="/IlRitrovo/public/Extra/showExtrasPage">Extras</a></li>
            <li><a href="/IlRitrovo/public/Review/showReviewsPage">Reviews</a></li>
          </ul>
        </nav>

          <div class="user-area">
            <form action="/IlRitrovo/public/User/logout" method="POST" style="margin:0;">
              <button type="submit" class="user-button" aria-label="Logout">Logout</button>
            </form>
          </div>
      </div> <!-- /.header-top -->
    </header>
  </body>
</html><?php }
}
