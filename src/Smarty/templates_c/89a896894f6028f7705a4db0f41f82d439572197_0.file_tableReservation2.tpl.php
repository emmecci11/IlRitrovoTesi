<?php
/* Smarty version 5.5.1, created on 2025-07-08 00:20:50
  from 'file:tableReservation2.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686c4842f202f8_58323869',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89a896894f6028f7705a4db0f41f82d439572197' => 
    array (
      0 => 'tableReservation2.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_686c4842f202f8_58323869 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Table - Step 2</title>
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
                <div class="step-circle active">2</div>
                <div class="step-line"></div>
                <div class="step-circle">3</div>
            </div> <!-- /.step-indicator-->

            <hr class="step-separator">

            <!-- Selection summary -->
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

            <!-- Restaurant map -->
            <div class="restaurant-map">
                <img src="/IlRitrovo/src/Smarty/assets/images/maps/Tables_map.png" alt="Restaurant Map">
            </div> <!-- /.restaurrant-map-->

            <!-- Table Selection -->
            <form method="post" action="/IlRitrovo/public/Reservation/dataTableReservation" class="booking-form">
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
