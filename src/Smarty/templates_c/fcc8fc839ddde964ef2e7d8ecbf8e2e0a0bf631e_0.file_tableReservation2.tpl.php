<?php
/* Smarty version 5.5.1, created on 2025-06-19 11:36:29
  from 'file:tableReservation2.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6853da1dc8a016_54836630',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fcc8fc839ddde964ef2e7d8ecbf8e2e0a0bf631e' => 
    array (
      0 => 'tableReservation2.tpl',
      1 => 1750325682,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:headerUser.tpl' => 1,
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_6853da1dc8a016_54836630 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/marco/public_html/Progetto/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Table - Step 2</title>
        <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/reservation.css" rel="stylesheet">
    </head>
    <body>
        <!-- Header -->
        <?php $_smarty_tpl->renderSubTemplate('file:headerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

        <div class="panel">

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step-circle">1</div>
                <div class="step-line"></div>
                <div class="step-circle active">2</div>
                <div class="step-line"></div>
                <div class="step-circle">3</div>
            </div>

            <hr class="step-separator">

            <!-- Riepilogo scelte -->
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
            </div> <!-- /.reservation-summary-->

            <!-- Mappa del ristorante -->
            <div class="restaurant-map">
                <img src="../assets/images/maps/Tables_map.png" alt="Restaurant Map">
            </div> <!-- /.restaurrant-map-->

            <!-- Selezione tavolo -->
            <form method="post" action="signupHandler.php" class="booking-form">
                <div class="form-group">
                    <label for="table">Select a Table</label>
                    <select name="idTable" id="table" required>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('availableTables'), 'table');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('table')->value) {
$foreach0DoElse = false;
?>
                            <option value="<?php echo $_smarty_tpl->getValue('table')['idTable'];?>
">Table <?php echo $_smarty_tpl->getValue('table')['areaName'];?>
 – Seats: <?php echo $_smarty_tpl->getValue('table')['maxGuests'];?>
</option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div> <!-- /.form-group-->

                <div class="reservation-form-buttons">
                    <a href="CFrontController.php?controller=CReservation&task=tableReservationStepOne" class="btn-cancel-step">Back</a>
                    <button type="submit" class="btn-save-step">Next</button>
                </div> <!--/.reservation-form-buttons-->
            </form>
        </div> <!-- /.panel-->

        <!-- Footer -->
        <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    </body>
</html><?php }
}
