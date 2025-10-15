<?php
/* Smarty version 5.5.1, created on 2025-06-24 00:06:15
  from 'file:headerAdmin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6859cfd7c853e7_43577723',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04fd19a2ba7141f5f6025a45b3d3ee43e269b3bc' => 
    array (
      0 => 'headerAdmin.tpl',
      1 => 1750716066,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6859cfd7c853e7_43577723 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/marco/public_html/Progetto/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Header - Il Ritrovo (Admin)</title>
    <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/header.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet" />
  </head>
  <body>

    <header>
      <div class="header-top">
        <div class="logo-area">
          <img src="../assets/images/logo/logo.png" alt="Logo Il Ritrovo" class="logo" />
          <span class="site-name">Il Ritrovo</span>
        </div> <!-- /.logo-area-->

        <nav class="main-nav">
          <ul>
            <li><a href="CFrontController.php?controller=CReview&task=showAdminHomePage">Home</a></li>
            <li><a href="CFrontController.php?controller=CReview&task=showUsersPage">Users</a></li>
            <li><a href="CFrontController.php?controller=CReview&task=showExtrasPage">Extras</a></li>
            <li><a href="CFrontController.php?controller=CReview&task=showAdminReviewsPage">Reviews</a></li>
          </ul>
        </nav>

        <!-- Pulsante utente (sfera) -->
        <button class="user-button" aria-label="User menu"></button>

        <!-- Dropdown utente -->
        <div class="user-dropdown hidden" id="userDropdown"></div>

      </div> <!-- /.header-top-->
    </header>

    <?php $_smarty_tpl->assign('adminLoggedInJs', false, false, NULL);?>
    <?php if ((true && ($_smarty_tpl->hasVariable('admin') && null !== ($_smarty_tpl->getValue('admin') ?? null)))) {?>
      <?php $_smarty_tpl->assign('adminLoggedInJs', true, false, NULL);?>
    <?php }?>

    
    <?php echo '<script'; ?>
>
      const adminLoggedIn = <?php echo json_encode($_smarty_tpl->getValue('adminLoggedInJs'));?>
;

      const userButton = document.querySelector('.user-button');
      const dropdown = document.getElementById('userDropdown');

      userButton.addEventListener('click', e => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
        updateDropdownContent();
      });

      document.addEventListener('click', e => {
        if (!dropdown.contains(e.target) && !userButton.contains(e.target)) {
          dropdown.classList.add('hidden');
        }
      });

      function updateDropdownContent() {
        if (adminLoggedIn) {
          dropdown.innerHTML = `
            <a href="CFrontController.php?controller=CUser&task=logout">Logout</a>
          `;
        } else {
          dropdown.innerHTML = `
            <span style="padding: 10px; display: block; color: #666;">Non sei loggato</span>
          `;
        }
      }
    <?php echo '</script'; ?>
>
    

  </body>
</html><?php }
}
