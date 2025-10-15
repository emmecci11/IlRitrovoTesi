<?php
/* Smarty version 5.5.1, created on 2025-07-08 00:19:32
  from 'file:tableReservation1.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686c47f47b81d4_06489212',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf158d9c7ca21e5f08c643c42984ba1af80b110b' => 
    array (
      0 => 'tableReservation1.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_686c47f47b81d4_06489212 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Table - Step 1</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reservation.css" rel="stylesheet">
    </head>
    <body>

    <!-- Header rendered through the View -->
        
        <div class="panel">

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step-circle active">1</div>
                <div class="step-line"></div>
                <div class="step-circle">2</div>
                <div class="step-line"></div>
                <div class="step-circle">3</div>
            </div> <!-- /.step-indicator-->

            <hr class="step-separator">

            <!-- Heading -->
            <h2 class="panel-heading">Book a Table with us</h2>

            <!-- Booking Form -->
            <form method="post" action="/IlRitrovo/public/Reservation/showValidTable" class="booking-form">
                <div class="form-group">
                    <label for="timeFrame">Time Frame</label>
                    <select name="timeFrame" id="timeFrame" required>
                        <option value="">-- Select --</option>
                        <option value="lunch" <?php if ($_smarty_tpl->getValue('timeFrame') == 'lunch') {?>selected<?php }?>>Lunch</option>
                        <option value="dinner" <?php if ($_smarty_tpl->getValue('timeFrame') == 'dinner') {?>selected<?php }?>>Dinner</option>
                    </select>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="people">Guests</label>
                    <input type="number" name="people" id="people" min="1" max="20" value="<?php echo (($tmp = $_smarty_tpl->getValue('people') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="reservationDate">Date</label>
                    <input type="date" name="reservationDate" id="reservationDate"
                            value="<?php echo (($tmp = $_smarty_tpl->getValue('reservationDate') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"
                            min="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%Y-%m-%d");?>
"
                    required>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" rows="4" placeholder="Allergies, high chair request, intolerances..."><?php echo (($tmp = $_smarty_tpl->getValue('comment') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
                </div> <!-- /.form-group-->

                <div class="reservation-form-buttons">
                    <button type="submit" class="btn-save-step">Next</button>
                </div> <!-- /.reservtion-form-buttons-->
            </form>

        </div>  <!--/.panel-->

        <!-- Footer-->
        <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </body>
</html><?php }
}
