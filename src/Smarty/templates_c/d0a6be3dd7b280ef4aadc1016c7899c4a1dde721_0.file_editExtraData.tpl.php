<?php
/* Smarty version 5.5.1, created on 2025-06-26 18:17:59
  from 'file:editExtraData.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685d72b7d27859_04737815',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0a6be3dd7b280ef4aadc1016c7899c4a1dde721' => 
    array (
      0 => 'editExtraData.tpl',
      1 => 1750954629,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685d72b7d27859_04737815 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Extra - Il Ritrovo</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/loginSignup.css" rel="stylesheet">
        <style>
            body.edit-background {
                background-image: url('/IlRitrovo/src/Smarty/assets/images/backgrounds/editExtraBackground.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }

            .modal-content {
                width: 90%;
                max-width: 650px;
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
        <div class="modal">

            <!-- Header incluso tramite View-->

            <div class="modal-content">
                <h2>Edit Extra</h2>

                <form method="POST" action="/IlRitrovo/public/Extra/saveEditExtra/<?php echo $_smarty_tpl->getValue('extra')->getIdExtra();?>
">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $_smarty_tpl->getValue('extra')->getNameExtra();?>
" required>

                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="<?php echo $_smarty_tpl->getValue('extra')->getPriceExtra();?>
" step="0.01" required>

                    <button type="submit">Save Changes</button>
                    <a href="/IlRitrovo/public/Extra/showExtrasPage" style="text-align: center; display: block; margin-top: 1rem;">Back to Extras</a>
                </form>
            </div>
        </div>
    </body>
</html><?php }
}
