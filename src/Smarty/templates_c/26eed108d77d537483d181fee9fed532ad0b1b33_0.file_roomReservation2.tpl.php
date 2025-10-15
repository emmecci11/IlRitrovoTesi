<?php
/* Smarty version 5.5.1, created on 2025-06-21 13:37:18
  from 'file:roomReservation2.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6856996eeef406_23325424',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '26eed108d77d537483d181fee9fed532ad0b1b33' => 
    array (
      0 => 'roomReservation2.tpl',
      1 => 1750505593,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:headerUser.tpl' => 1,
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_6856996eeef406_23325424 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/marco/public_html/Progetto/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Room - Step 2</title>
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
                </div> <!-- /.extras-row-->
                <?php }?>
                <div class="summary-row price-row">
                    <p><strong>Partial Total (so far):</strong> €<?php echo $_smarty_tpl->getValue('totPriceExtra');?>
</p>
                </div> <!-- /.summary-row-->
            </div> <!-- /.reservation-summary-->

            <!-- Mappa del ristorante -->
            <div class="restaurant-map">
                <img src="../assets/images/maps/Rooms_map.png" alt="Restaurant Map">
            </div> <!-- /.restaurrant-map-->

            <!-- Selezione stanza -->
            <form method="post" action="signupHandler.php" class="booking-form">
                <div class="form-group">
                    <label for="room">Select a Room</label>
                    <select name="idRoom" id="idRoom" required>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('availableRooms'), 'room');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('room')->value) {
$foreach1DoElse = false;
?>
                        <option value="<?php echo $_smarty_tpl->getValue('room')['idRoom'];?>
" data-tax="<?php echo $_smarty_tpl->getValue('room')['tax'];?>
"> Room <?php echo $_smarty_tpl->getValue('room')['areaName'];?>
 – Seats: <?php echo $_smarty_tpl->getValue('room')['maxGuests'];?>
 – €<?php echo $_smarty_tpl->getValue('room')['tax'];?>
 </option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div> <!-- /.form-group-->

                <div class="total-extras-box" id="totalExtrasBox">
                    <strong>Total Price:</strong> €<span id="totalPrice"><?php echo $_smarty_tpl->getValue('totPriceExtra');?>
</span>
                </div>

                <div class="reservation-form-buttons">
                    <a href="signupHandler.php" class="btn-cancel-step">Back</a>
                    <button type="submit" class="btn-save-step">Next</button>
                </div> <!--/.reservation-form-buttons-->
            </form>
        </div> <!-- /.panel-->

        <!-- Footer -->
        <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

        <!-- Pezzo JavaScript scritto per permettere alla pagina di aggiornare dinamicamente il totale in base alla selezione della room fatta sul
         momento dall'utente, non era possibile eseguire questo comportamento con solo html/tpl senza dover ricaricare la pagina ogni volta, poco user-friendly-->
        <?php echo '<script'; ?>
>
        // Recupera il menu a tendina delle stanze
        const selectRoom = document.getElementById("idRoom");

        // Recupera lo span dove viene mostrato il prezzo totale
        const priceDisplay = document.getElementById("totalPrice");

        // Legge il prezzo totale calcolato allo step precedente (lo converte in numero)
        const basePrice = parseFloat(priceDisplay.textContent); // Esempio: 50.00

        //Funzione che aggiorna il prezzo totale in base alla stanza selezionata
        function updateTotalPrice() {
            const selectedOption=selectRoom.options[selectRoom.selectedIndex];
            const roomTax=parseFloat(selectedOption.dataset.tax || 0);
            const updatedTotal=basePrice+roomTax;
            priceDisplay.textContent=updatedTotal.toFixed(2);
        }

        //Aggiorna subito il prezzo anche al caricamento iniziale
        updateTotalPrice();

        //E anche ogni volta che si cambia selezione
        selectRoom.addEventListener("change", updateTotalPrice);
        <?php echo '</script'; ?>
>

    </body>
</html><?php }
}
