<?php
/* Smarty version 5.5.1, created on 2025-07-08 00:22:03
  from 'file:roomReservation3.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686c488bac2844_51323337',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70e4a2d806b2f0ab581df4ae8febf4780c349513' => 
    array (
      0 => 'roomReservation3.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_686c488bac2844_51323337 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Room - Step 3</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reservation.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
        <style>
            .credit-card.selected {
                border: 2px solid #28a745;
                background-color: #e6ffe6;
            }
        </style>
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
                <div class="step-line"></div>
                <div class="step-circle">4</div>
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
                </div> <!-- /.summary-row extras-row-->
                <?php }?>
                <div class="summary-row room-row">
                    <p><strong>Room Selected:</strong> <?php echo $_smarty_tpl->getValue('selectedRoom')->getAreaName();?>
 – €<?php echo $_smarty_tpl->getValue('selectedRoom')->getTax();?>
</p>
                </div> <!-- /.summary-row room-row-->
                <div class="summary-row price-row">
                    <p><strong>Total Price to Pay:</strong> €<?php echo $_smarty_tpl->getValue('totalPrice');?>
</p>
                </div> <!-- /.summary-row price-row-->
            </div> <!-- /.reservation-summary-->

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
                                <button type="button" class="btn save" onclick="selectCard('<?php echo $_smarty_tpl->getValue('card')->getIdCreditCard();?>
', this)">Select Card</button>
                            </div> <!-- /.card-body-->
                        </div> <!-- /.credit-card-->
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

                    <!-- Button Add New Card -->
                    <div class="credit-card add-card-btn" title="Aggiungi nuova carta">
                        <a href="/IlRitrovo/public/CreditCard/showAddCreditCardStep3" class="card-header"
                        style="text-align:center; font-size:2.5rem; cursor:pointer; user-select:none; color:#ff9f43; display:block;">+</a>
                    </div> <!-- /.credit-card add-card-btn -->
                </div> <!-- /.card-row-->
            </div> <!-- /.panel-->

            <!-- Navigation Button -->
            <form action="/IlRitrovo/public/Reservation/showSummaryRoomAndPaymentForm" method="POST">
                <input type="hidden" name="selectedCardId" id="selectedCardId" value="<?php echo $_smarty_tpl->getValue('selectedCardId');?>
">
                <div class="reservation-form-buttons">
                    <button type="submit" class="btn-save-step">Next</button>
                </div> <!-- /.reservation-form-buttons-->
            </form>
        </div> <!-- /.panel-->

        <!-- Footer -->
        <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

        <!-- JavaScript per selezione carta -->
        <?php echo '<script'; ?>
>
        // Funzione per selezionare una carta di credito quando si clicca sul relativo bottone
        function selectCard(cardId, button) {
            
            // Imposta il valore nascosto dell'input con id 'selectedCardId' con l'id della carta selezionata
            document.getElementById('selectedCardId').value = cardId;
            
            // Rimuove la classe 'selected' da tutte le carte di credito per deselezionarle visivamente
            document.querySelectorAll('.credit-card').forEach(card => {
            card.classList.remove('selected');
            });
            
            // Trova l'elemento più vicino (genitore) al bottone che ha la classe 'credit-card'
            const cardDiv = button.closest('.credit-card');
            
            // Se l'elemento esiste (sicuro che il bottone è dentro una carta)
            if (cardDiv) {
            // Aggiunge la classe 'selected' per evidenziare visivamente la carta selezionata
            cardDiv.classList.add('selected');
            }
        }
        <?php echo '</script'; ?>
>
        <!-- Javascript che si assicura che l'utente abbia selezionato una carta -->
        <?php echo '<script'; ?>
>
        // Al momento dell'invio del form per la conferma della prenotazione (specificato dall'action)
        document.querySelector('form[action="/IlRitrovo/public/Reservation/showSummaryRoomAndPaymentForm"]').addEventListener('submit', function(event) {
            
            // Recupera il valore dell'input nascosto che contiene l'id della carta selezionata
            const selectedCardId = document.getElementById('selectedCardId').value;
            
            // Se non è stata selezionata nessuna carta (campo vuoto)
            if (!selectedCardId) {
            
            // Blocca l'invio del form per evitare che proceda senza carta selezionata
            event.preventDefault();
            
            // Mostra un messaggio d'alert per avvisare l'utente che deve scegliere una carta
            alert('Please select a credit card before proceeding.');
            }
        });
        <?php echo '</script'; ?>
>
    </body>
</html><?php }
}
