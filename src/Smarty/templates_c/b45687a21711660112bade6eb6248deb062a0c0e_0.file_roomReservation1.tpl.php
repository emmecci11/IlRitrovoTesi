<?php
/* Smarty version 5.5.1, created on 2025-06-19 17:08:44
  from 'file:roomReservation1.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685427fccecb00_42889530',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b45687a21711660112bade6eb6248deb062a0c0e' => 
    array (
      0 => 'roomReservation1.tpl',
      1 => 1750345696,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:headerUser.tpl' => 1,
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_685427fccecb00_42889530 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/marco/public_html/Progetto/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Room - Step 1</title>
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
                <div class="step-circle active">1</div>
                <div class="step-line"></div>
                <div class="step-circle">2</div>
                <div class="step-line"></div>
                <div class="step-circle">3</div>
                <div class="step-line"></div>
                <div class="step-circle">4</div>
            </div> <!-- /.step-indicator-->

            <hr class="step-separator">

            <!-- Heading -->
            <h2 class="panel-heading">Book a Room with us</h2>

            <!-- Booking Form -->
            <form method="post" action="signupHandler.php" class="booking-form">
                <div class="form-group">
                    <label for="timeframe">Time Frame</label>
                    <select name="timeFrame" id="timeFrame" required>
                        <option value="">-- Select --</option>
                        <option value="lunch" <?php if ($_smarty_tpl->getValue('timeFrame') == 'lunch') {?>selected<?php }?>>Lunch</option>
                        <option value="dinner" <?php if ($_smarty_tpl->getValue('timeFrame') == 'dinner') {?>selected<?php }?>>Dinner</option>
                    </select>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="people">Guests</label>
                    <input type="number" name="people" id="people" min="1" max="100" value="<?php echo (($tmp = $_smarty_tpl->getValue('people') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="reservationDate">Date</label>
                    <input type="date" name="reservationDate" id="reservationDate" value="<?php echo (($tmp = $_smarty_tpl->getValue('reservationDate') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" rows="4" placeholder="Allergies, high chair request, intolerances..."><?php echo (($tmp = $_smarty_tpl->getValue('comment') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
                </div> <!-- /.form-group-->

                <?php if ((true && ($_smarty_tpl->hasVariable('extras') && null !== ($_smarty_tpl->getValue('extras') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('extras')) > 0) {?>
                    <div class="form-group">
                        <label for="extras">Add Extras</label>
                        <div class="extras-list">
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('extras'), 'extra');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('extra')->value) {
$foreach0DoElse = false;
?>
                                <div class="extra-item">
                                    <input type="checkbox" 
                                        id="extra_<?php echo $_smarty_tpl->getValue('extra')->getIdExtra();?>
" 
                                        name="extras[]" 
                                        value="<?php echo $_smarty_tpl->getValue('extra')->getIdExtra();?>
" 
                                        data-price="<?php echo $_smarty_tpl->getValue('extra')->getPriceExtra();?>
" 
                                        <?php if ((true && ($_smarty_tpl->hasVariable('selectedExtras') && null !== ($_smarty_tpl->getValue('selectedExtras') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('in_array')($_smarty_tpl->getValue('extra')->getIdExtra(),$_smarty_tpl->getValue('selectedExtras'))) {?>checked<?php }?>>
                                    <label for="extra_<?php echo $_smarty_tpl->getValue('extra')->getIdExtra();?>
">
                                        <?php echo $_smarty_tpl->getValue('extra')->getNameExtra();?>
 (+€<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('extra')->getPriceExtra(),2,',',' ');?>
)
                                    </label>
                                </div> <!-- /.extra-item-->
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </div> <!-- /.extra-list-->
                    </div> <!-- /.form-group-->

                    <div class="total-extras-box" id="totalExtrasBox">
                        <strong>Totale Extra:</strong> €<span id="extrasTotal">0.00</span>
                    </div> <!-- /.total-extra-box-->
                <?php }?>

                <div class="reservation-form-buttons">
                    <a href="CFrontController.php?controller=CFrontController&task=showHome" class="btn-cancel-step">Back to Home</a>
                    <button type="submit" class="btn-save-step">Next</button>
                </div> <!-- /.reservation-form-buttons -->
            </form>

        </div>  <!--/.panel-->

        <!-- Footer-->
        <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

        <!-- Pezzo JavaScript scritto per permettere alla pagina di aggiornare dinamicamente il totale in base alla selezione degli extra fatta sul
         momento dall'utente, non era possibile eseguire questo comportamento con solo html/tpl senza dover ricaricare la pagina ogni volta, poco user-friendly-->
        <?php echo '<script'; ?>
>
        // Quando tutto il contenuto della pagina è stato caricato...
        document.addEventListener("DOMContentLoaded", function () {

            // Seleziona tutti i checkbox degli extra (quelli con name="extras[]")
            const checkboxes = document.querySelectorAll('input[name="extras[]"]');

            // Seleziona l’elemento dove verrà mostrato il totale (lo span con id="extrasTotal")
            const totalBox = document.getElementById('extrasTotal');

            // Funzione che calcola il totale degli extra selezionati
            function updateTotal() {
                let total = 0; // inizializza il totale a 0

                // Per ogni checkbox...
                checkboxes.forEach(cb => {
                    // ...se è selezionato (checked)...
                    if (cb.checked) {
                        // ...aggiungi il suo prezzo (preso dal data-price) al totale
                        total += parseFloat(cb.dataset.price);
                    }
                });

                // Aggiorna il contenuto dello span con il nuovo totale, formattato con 2 decimali
                totalBox.textContent = total.toFixed(2);
            }

            // Per ogni checkbox, aggiungi un "ascoltatore" che ricalcola il totale ogni volta che cambia
            checkboxes.forEach(cb => {
                cb.addEventListener('change', updateTotal);
            });

            // Calcola subito il totale al primo caricamento della pagina
            updateTotal();
        });
        <?php echo '</script'; ?>
>

    </body>
</html><?php }
}
