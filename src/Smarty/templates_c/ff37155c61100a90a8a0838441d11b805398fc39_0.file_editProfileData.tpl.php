<?php
/* Smarty version 5.5.1, created on 2025-06-27 13:46:40
  from 'file:editProfileData.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685e84a08da594_62145025',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff37155c61100a90a8a0838441d11b805398fc39' => 
    array (
      0 => 'editProfileData.tpl',
      1 => 1750941554,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685e84a08da594_62145025 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Your Metadata - Il Ritrovo</title>       
        <!-- Template Stylesheet -->
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/loginSignup.css" rel="stylesheet">
        <style>
            body.edit-background {
                background-image: url('/IlRitrovo/src/Smarty/assets/images/backgrounds/editUserBackground.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }

            .modal-content {
                width: 90%;
                max-width: 700px;
                padding: 2rem 2.5rem;
                border-radius: 12px;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 0 20px rgba(139, 58, 58, 0.3);
                color: #4a3b2c;
                box-sizing: border-box;
            }
        </style>
    </head>

    <body class="edit-background">

        <!-- Header incluso tramite View-->
         
        <div class="modal">
            <div class="modal-content">
                <h2>Edit Personal Data</h2>
                <form method="post" action="/IlRitrovo/public/User/editProfileData">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $_smarty_tpl->getValue('name');?>
" required />

                    <label for="surname">Surname</label>
                    <input type="text" id="surname" name="surname" value="<?php echo $_smarty_tpl->getValue('surname');?>
" required />

                    <label for="birthDate">Birth Date</label>
                    <input type="date" id="birthDate" name="birthDate" value="<?php echo $_smarty_tpl->getValue('birthDate');?>
" required />

                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $_smarty_tpl->getValue('phone');?>
" required />

                    <button type="submit">Save Personal Data</button>
                </form>
                <p><a href="/IlRitrovo/public/User/showProfile">Back to Profile</a></p>
            </div>
        </div>
    </body>
</html><?php }
}
