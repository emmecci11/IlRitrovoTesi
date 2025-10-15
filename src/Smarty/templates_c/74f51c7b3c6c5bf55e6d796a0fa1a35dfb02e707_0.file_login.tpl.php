<?php
/* Smarty version 5.5.1, created on 2025-06-24 15:18:04
  from 'file:login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685aa58cc20c48_66804783',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '74f51c7b3c6c5bf55e6d796a0fa1a35dfb02e707' => 
    array (
      0 => 'login.tpl',
      1 => 1750758544,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685aa58cc20c48_66804783 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/ilRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Il Ritrovo</title>
    <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/loginSignup.css"
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet" />
    </head>
    <body>
        
        <!-- Header incluso tramite View-->

        <div class="modal">
            <div class="modal-content">
                <h2>Login</h2>
                <form action="signupHandler.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required />

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required />

                    <button type="submit">Login</button>
                </form>
                <p>Don't have an account? <a href="CFrontController.php?controller=CUser&task=showSignupPage">Sign up here</a></p>
            </div> <!-- /.modal-content-->
        </div> <!-- /.modal-->
        
    </body>
</html><?php }
}
