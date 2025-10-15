<?php
/* Smarty version 5.5.1, created on 2025-06-29 18:28:31
  from 'file:login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686169aff05ec2_32867342',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a9cf9abbe3b545d30fee2e06380374ba38758cc' => 
    array (
      0 => 'login.tpl',
      1 => 1751214463,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686169aff05ec2_32867342 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Il Ritrovo</title>
    <link href="/IlRitrovo/src/Smarty/css/loginSignup.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet" />
    </head>
    <body>

        <div class="modal">
            <div class="modal-content">
                <h2>Login</h2>
                <form action="/IlRitrovo/public/User/checkLogin" method="POST">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required />

                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required />
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            🙈
                        </button>
                    </div>

                    <button type="submit">Login</button>
                </form>
                <p>Don't have an account? <a href="/IlRitrovo/public/User/showSignUpForm">Sign up here</a></p>
            </div> <!-- /.modal-content-->
        </div> <!-- /.modal-->

        <?php echo '<script'; ?>
> //Per mostrare e nascondere la password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.querySelector('.toggle-password');
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleBtn.textContent = isPassword ? '🐵' : '🙈';
        }
        <?php echo '</script'; ?>
>
        
    </body>
</html><?php }
}
