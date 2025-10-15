<?php
/* Smarty version 5.5.1, created on 2025-07-08 00:20:53
  from 'file:tableReservation3.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686c4845e771b4_21627853',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12e8c4ee8d302bd744276b71bc7e39cab13acaa3' => 
    array (
      0 => 'tableReservation3.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_686c4845e771b4_21627853 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Table - Step 3</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reservation.css" rel="stylesheet">
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
                <div class="step-circle active">3</div>
            </div> <!-- /.step-indicator-->

            <hr class="step-separator">

            <!-- Email confirmation message -->
            <div class="confirmation-notice" style="max-width: 950px; margin: 0 auto 1.5rem auto; padding: 1rem; background-color: rgba(139, 58, 58, 0.1); border-left: 4px solid #8b3a3a; color: #8b3a3a; font-weight: 600; backdrop-filter: blur(4px); border-radius: 4px;">
                You will receive a confirmation email shortly with the details of your booking.
            </div>

            <!-- Selection Summary -->
            <div class="reservation-summary">
                <div class="summary-row">
                    <p><strong>Time Frame:</strong> <?php echo $_smarty_tpl->getValue('timeFrame');?>
</p>
                    <p><strong>Guests:</strong> <?php echo $_smarty_tpl->getValue('people');?>
</p>
                </div> <!-- /summary-row-->
                <div class="summary-row">
                    <p><strong>Date:</strong> <?php echo $_smarty_tpl->getValue('reservationDate');?>
</p>
                    <p><strong>Comment:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('comment') ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p>
                </div> <!-- /.summary-row-->
                <div class="summary-row">
                    <p><strong>Selected Table:</strong> <?php echo $_smarty_tpl->getValue('idTable');?>
</p>
                </div> <!-- /.summary-row-->
            </div> <!-- /.reservation-summary-->

            <!-- Navigation Button -->
            <form method="post" action="/IlRitrovo/public/Reservation/checkTableReservation" class="booking-form">
                <div class="reservation-form-buttons">
                    <button type="submit" class="btn-save-step">Confirm</button>
                </div> <!-- /.reservation-form-buttons-->
            </form>
        </div> <!-- /.panel-->

        <!-- Footer -->
        <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </body>
</html><?php }
}
