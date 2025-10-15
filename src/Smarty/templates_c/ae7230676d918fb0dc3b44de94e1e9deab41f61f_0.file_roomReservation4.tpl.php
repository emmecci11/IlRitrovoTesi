<?php
/* Smarty version 5.5.1, created on 2025-07-08 00:22:11
  from 'file:roomReservation4.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686c489343f340_84642202',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae7230676d918fb0dc3b44de94e1e9deab41f61f' => 
    array (
      0 => 'roomReservation4.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_686c489343f340_84642202 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Room - Step 4</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reservation.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
    </head>
    <body>

        <!-- Header rendered through the View -->

        <div class="panel">

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step-circle">1</div>
                <div class="step-line"></div>
                <div class="step-circle">2</div>
                <div class="step-line"></div>
                <div class="step-circle">3</div>
                <div class="step-line"></div>
                <div class="step-circle active">4</div>
            </div>

            <hr class="step-separator">

            <!-- Email confirmation message -->
            <div class="confirmation-notice" style="margin-bottom: 1.5rem; padding: 1rem; background-color: rgba(139, 58, 58, 0.1); border-left: 4px solid #8b3a3a; color: #8b3a3a; font-weight: 600; backdrop-filter: blur(4px); border-radius: 4px;">
                You will receive a confirmation email shortly with the details of your booking.
            </div>

            <!-- Selection Summary -->
            <div class="reservation-summary">
                <div class="summary-row">
                    <p><strong>Time Frame:</strong> <?php echo $_smarty_tpl->getValue('timeFrame');?>
</p>
                    <p><strong>Guests:</strong> <?php echo $_smarty_tpl->getValue('people');?>
</p>
                </div> <!-- /.summary-row-->
                <div class="summary-row">
                    <p><strong>Date:</strong> <?php echo $_smarty_tpl->getValue('reservationDate');?>
</p>
                    <p><strong>Comment:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('comment') ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p>
                </div> <!-- /.summary-row-->
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
                </div> <!-- /.summary-row-->
                <?php }?>
                <div class="summary-row room-row">
                    <p><strong>Room Selected:</strong> <?php echo $_smarty_tpl->getValue('selectedRoom')->getAreaName();?>
 – €<?php echo $_smarty_tpl->getValue('selectedRoom')->getTax();?>
</p>
                </div> <!-- /.summary-row-->
                <div class="summary-row price-row">
                    <p><strong>Total Price to Pay:</strong> €<?php echo $_smarty_tpl->getValue('totalPrice');?>
</p>
                </div> <!-- /.summary-row-->
            </div> <!-- /.reservation-summary-->

            <!-- Selected Payment Method -->
            <div class="summary-row" style="display: inline-block; margin-left: 30px;">
                <div class="summary-title">
                    <p><strong>Selected Payment Method:</strong></p>
                </div>
                <div class="credit-card" style="margin-left: 0; margin-right: auto;">
                    <div class="card-header <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('regex_replace')(mb_strtolower((string) $_smarty_tpl->getValue('selectedCard')->getType(), 'UTF-8'),'/[^a-z]/','');?>
">
                        <?php echo $_smarty_tpl->getValue('selectedCard')->getType();?>

                    </div> <!-- /.card-header-->
                    <div class="card-body">
                        <ul>
                            <li><strong>Number:</strong> **** **** **** <?php echo substr((string) $_smarty_tpl->getValue('selectedCard')->getNumber(), (int) -4);?>
</li>
                            <li><strong>Holder:</strong> <?php echo $_smarty_tpl->getValue('selectedCard')->getHolder();?>
</li>
                            <li><strong>Expiration:</strong> <?php echo $_smarty_tpl->getValue('selectedCard')->getExpiration();?>
</li>
                        </ul>
                    </div> <!-- /.card-body-->
                </div> <!-- /.credit-card-compact-->
            </div> <!-- /.summary-row-->

            <!-- Navigation Buttons -->
            <form action="/IlRitrovo/public/Reservation/checkPayment" method="post">
                <input type="hidden" name="selectedCardId" value="<?php echo $_smarty_tpl->getValue('selectedCard')->getIdCreditCard();?>
">
                <div class="reservation-form-buttons">
                    <button type="submit" class="btn-save-step">Confirm </button>
                </div> <!-- /.reservation-form-buttons-->
            </form>
        </div> <!--  /.panel-->

        <!-- Footer -->
        <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </body>
</html><?php }
}
