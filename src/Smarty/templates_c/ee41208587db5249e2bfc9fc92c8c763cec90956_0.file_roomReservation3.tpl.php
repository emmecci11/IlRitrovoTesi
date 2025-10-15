<?php
/* Smarty version 5.5.1, created on 2025-06-23 16:19:18
  from 'file:roomReservation3.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68596266b4ce19_16959727',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ee41208587db5249e2bfc9fc92c8c763cec90956' => 
    array (
      0 => 'roomReservation3.tpl',
      1 => 1750688285,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:headerUser.tpl' => 1,
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_68596266b4ce19_16959727 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/marco/public_html/Progetto/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Room - Step 3</title>
        <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/reservation.css" rel="stylesheet">
        <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
        <style>
            .credit-card.selected {
                border: 2px solid #28a745;
                background-color: #e6ffe6;
            }
        </style>
    </head>
    <body>
        <?php $_smarty_tpl->renderSubTemplate('file:headerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

        <div class="panel">

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step-circle">1</div>
                <div class="step-line"></div>
                <div class="step-circle">2</div>
                <div class="step-line"></div>
                <div class="step-circle active">3</div>
                <div class="step-line"></div>
                <div class="step-circle">4</div>
            </div>

            <hr class="step-separator">

            <!-- Riepilogo scelte -->
            <div class="reservation-summary">
                <div class="summary-row">
                    <p><strong>Time Frame:</strong> <?php echo $_smarty_tpl->getValue('timeFrame');?>
</p>
                    <p><strong>Guests:</strong> <?php echo $_smarty_tpl->getValue('people');?>
</p>
                </div>
                <div class="summary-row">
                    <p><strong>Date:</strong> <?php echo $_smarty_tpl->getValue('reservationDate');?>
</p>
                    <p><strong>Comment:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('comment') ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p>
                </div>
                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('extras')) > 0) {?>
                <div class="summary-row extras-row">
                    <p class="summary-title"><strong>Extras Selected:</strong></p>
                    <ul class="extras-list">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('extras'), 'extra');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('extra')->value) {
$foreach0DoElse = false;
?>
                            <li><?php echo $_smarty_tpl->getValue('extra')->getNameExtra();?>
 – €<?php echo $_smarty_tpl->getValue('extra')->getPriceExtra();?>
</li>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </ul>
                </div>
                <?php }?>
                <div class="summary-row room-row">
                    <p><strong>Room Selected:</strong> <?php echo $_smarty_tpl->getValue('selectedRoom')->getAreaName();?>
 – €<?php echo $_smarty_tpl->getValue('selectedRoom')->getTax();?>
</p>
                </div>
                <div class="summary-row price-row">
                    <p><strong>Total Price to Pay:</strong> €<?php echo $_smarty_tpl->getValue('totalPrice');?>
</p>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="panel">
                <div class="panel-heading">Choose a Payment Method</div>
                <div class="card-row">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('userCreditCards'), 'card');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('card')->value) {
$foreach1DoElse = false;
?>
                        <?php $_smarty_tpl->assign('cardClass', $_smarty_tpl->getSmarty()->getModifierCallback('regex_replace')(mb_strtolower((string) $_smarty_tpl->getValue('card')->getType(), 'UTF-8'),'/[^a-z]/',''), false, NULL);?>
                        <div class="credit-card <?php if ($_smarty_tpl->getValue('card')->getIdCreditCard() == $_smarty_tpl->getValue('selectedCardId')) {?>selected<?php }?>">
                            <div class="card-header <?php echo $_smarty_tpl->getValue('cardClass');?>
"><?php echo $_smarty_tpl->getValue('card')->getType();?>
</div>
                            <div class="card-body">
                                <ul>
                                    <li><strong>Number:</strong> **** **** **** <?php echo substr((string) $_smarty_tpl->getValue('card')->getNumber(), (int) -4);?>
</li>
                                    <li><strong>Holder:</strong> <?php echo $_smarty_tpl->getValue('card')->getHolder();?>
</li>
                                    <li><strong>Expiration:</strong> <?php echo $_smarty_tpl->getValue('card')->getExpiration();?>
</li>
                                </ul>
                                <button type="button" class="btn save" onclick="selectCard(<?php echo $_smarty_tpl->getValue('card')->getIdCreditCard();?>
, this)">Select Card</button>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <div class="credit-card add-card-btn" onclick="location.href='CFrontController.php?controller=CCreditCard&task=showAddForm'" title="Add new card">
                        <div class="card-header" style="text-align:center; font-size:2.5rem; cursor:pointer; user-select:none; color:#ff9f43;">+</div>
                    </div>
                </div>

                <?php if ($_smarty_tpl->getValue('showForm')) {?>
                    <form method="post" action="<?php echo $_smarty_tpl->getValue('formAction');?>
" class="card-form">
                        <label for="cardType">Type</label>
                        <select name="cardType" id="cardType" required>
                            <option value="">Select type</option>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allowedTypes'), 'type');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('type')->value) {
$foreach2DoElse = false;
?>
                                <option value="<?php echo $_smarty_tpl->getValue('type');?>
" <?php if ($_smarty_tpl->getValue('cardData')['type'] == $_smarty_tpl->getValue('type')) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('type');?>
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
                        <label for="expiryDate">Expiration (MM/AA)</label>
                        <input type="text" name="expiryDate" id="expiryDate" maxlength="5" placeholder="MM/AA" required value="<?php echo (($tmp = $_smarty_tpl->getValue('cardData')['expiration'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                        <div class="form-action-right">
                            <button type="submit" name="save" class="btn save">Save</button>
                        </div>
                    </form>
                <?php }?>
            </div>

            <!-- Bottoni di navigazione -->
            <form method="post" action="signupHandler.php">
                <input type="hidden" name="selectedCardId" id="selectedCardId" value="<?php echo $_smarty_tpl->getValue('selectedCardId');?>
">
                <div class="reservation-form-buttons">
                    <button type="button" class="btn-cancel-step" onclick="location.href='CFrontController.php?controller=CReservation&task=roomReservationStepTwo'">Back</button>
                    <button type="submit" class="btn-save-step">Next</button>
                </div>
            </form>

        </div>

        <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

        <!-- JavaScript per selezione carta -->
        <?php echo '<script'; ?>
>
            function selectCard(cardId, button) {
                document.getElementById('selectedCardId').value = cardId;
                document.querySelectorAll('.credit-card').forEach(card => {
                    card.classList.remove('selected');
                });
                const cardDiv = button.closest('.credit-card');
                if (cardDiv) {
                    cardDiv.classList.add('selected');
                }
            }
        <?php echo '</script'; ?>
>
    </body>
</html>
<?php }
}
