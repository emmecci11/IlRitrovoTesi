<?php
/* Smarty version 5.5.1, created on 2025-06-26 23:54:52
  from 'file:addCreditCardUserProfile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685dc1acbb8162_21992000',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '135d293fd607b87b012e70cabf7d284f03310b30' => 
    array (
      0 => 'addCreditCardUserProfile.tpl',
      1 => 1750974882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685dc1acbb8162_21992000 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Credit Card - Il Ritrovo</title>       
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/loginSignup.css" rel="stylesheet">
        <style>
            body.edit-background {
                background-image: url('/IlRitrovo/src/Smarty/assets/images/backgrounds/addCreditCardUserProfile.png');
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

            .card-form input,
            .card-form select {
                width: 100%;
                padding: 0.6rem;
                margin-bottom: 1.2rem;
                border-radius: 6px;
                border: 1px solid #ccc;
            }

            .card-form button {
                background-color: #ff9f43;
                color: white;
                border: none;
                padding: 0.6rem 1.2rem;
                border-radius: 6px;
                cursor: pointer;
                font-weight: bold;
            }

            .card-form .btn.cancel {
                background-color: #888;
                margin-left: 1rem;
            }

            .form-action-right {
                display: flex;
                justify-content: flex-end;
                margin-top: 1rem;
            }
        </style>
    </head>

    <body class="edit-background">

        <!-- Header incluso tramite View -->

        <div class="modal">
            <div class="modal-content">
                <h2>Add a New Credit Card</h2>
                <form method="post" action="/IlRitrovo/public/CreditCard/checkAddCreditCard" class="card-form">
                    <label for="cardType">Type</label>
                    <select name="cardType" id="cardType" required>
                        <option value="">Select type</option>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allowedTypes'), 'type');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('type')->value) {
$foreach0DoElse = false;
?>
                            <option value="<?php echo $_smarty_tpl->getValue('type');?>
" <?php if ((true && (true && null !== ($_smarty_tpl->getValue('cardData')['type'] ?? null))) && $_smarty_tpl->getValue('cardData')['type'] == $_smarty_tpl->getValue('type')) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('type');?>
</option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>

                    <label for="cardNumber">Number</label>
                    <input type="text" name="cardNumber" id="cardNumber" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" required value="<?php echo (($tmp = $_smarty_tpl->getValue('cardData')['number'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

                    <label for="cardHolder">Holder</label>
                    <input type="text" name="cardHolder" id="cardHolder" required value="<?php echo (($tmp = $_smarty_tpl->getValue('cardData')['holder'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

                    <label for="expiryDate">Expiration Date</label>
                    <input type="date" name="expiryDate" id="expiryDate" required value="<?php echo (($tmp = $_smarty_tpl->getValue('cardData')['expiration'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

                    <label for="cardCVV">CVV</label>
                    <input type="text" name="cardCVV" id="cardCVV" maxlength="4" pattern="^\d{3,4}$" placeholder="3 or 4 digits" required value="<?php echo (($tmp = $_smarty_tpl->getValue('cardData')['cvv'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

                    <div class="form-action-right">
                        <button type="submit" name="save">Save</button>
                    </div>
                </form>
                <p><a href="/IlRitrovo/public/User/showProfile">Back to Profile</a></p>
            </div> <!-- /.modal-content-->
        </div> <!-- /.modal-->
    </body>
</html><?php }
}
