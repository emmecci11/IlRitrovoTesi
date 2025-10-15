<!DOCTYPE html>
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
                    <p><strong>Time Frame:</strong> {$timeFrame}</p>
                    <p><strong>Guests:</strong> {$people}</p>
                </div> <!-- /.summary-row-->
                <div class="summary-row">
                    <p><strong>Date:</strong> {$reservationDate}</p>
                    <p><strong>Comment:</strong> {$comment|default:'—'}</p>
                </div> <!-- /.summary-row-->
                {if $extras|@count > 0}
                <div class="summary-row extras-row">
                    <p class="summary-title"><strong>Extras Selected:</strong></p>
                    <ul class="extras-list">
                        {foreach from=$extras item=extra}
                            <li>{$extra->getNameExtra()} – €{$extra->getPriceExtra()}</li>
                        {/foreach}
                    </ul>
                </div> <!-- /.summary-row extras-row-->
                {/if}
                <div class="summary-row room-row">
                    <p><strong>Room Selected:</strong> {$selectedRoom->getAreaName()} – €{$selectedRoom->getTax()}</p>
                </div> <!-- /.summary-row room-row-->
                <div class="summary-row price-row">
                    <p><strong>Total Price to Pay:</strong> €{$totalPrice}</p>
                </div> <!-- /.summary-row price-row-->
            </div> <!-- /.reservation-summary-->

            <!-- Payment Methods -->
            <div class="panel">
                <div class="panel-heading">Choose a Payment Method</div>
                <div class="card-row">
                    {foreach from=$userCreditCards item=card}
                        {assign var=cardClass value=$card->getType()|lower|regex_replace:'/[^a-z]/':''}
                        <div class="credit-card {if $card->getIdCreditCard() == $selectedCardId}selected{/if}">
                            <div class="card-header {$cardClass}">{$card->getType()}</div>
                            <div class="card-body">
                                <ul>
                                    <li><strong>Number:</strong> **** **** **** {$card->getNumber()|substr:-4}</li>
                                    <li><strong>Holder:</strong> {$card->getHolder()}</li>
                                    <li><strong>Expiration:</strong> {$card->getExpiration()}</li>
                                </ul>
                                <button type="button" class="btn save" onclick="selectCard('{$card->getIdCreditCard()}', this)">Select Card</button>
                            </div> <!-- /.card-body-->
                        </div> <!-- /.credit-card-->
                    {/foreach}

                    <!-- Button Add New Card -->
                    <div class="credit-card add-card-btn" title="Aggiungi nuova carta">
                        <a href="/IlRitrovo/public/CreditCard/showAddCreditCardStep3" class="card-header"
                        style="text-align:center; font-size:2.5rem; cursor:pointer; user-select:none; color:#ff9f43; display:block;">+</a>
                    </div> <!-- /.credit-card add-card-btn -->
                </div> <!-- /.card-row-->
            </div> <!-- /.panel-->

            <!-- Navigation Button -->
            <form action="/IlRitrovo/public/Reservation/showSummaryRoomAndPaymentForm" method="POST">
                <input type="hidden" name="selectedCardId" id="selectedCardId" value="{$selectedCardId}">
                <div class="reservation-form-buttons">
                    <button type="submit" class="btn-save-step">Next</button>
                </div> <!-- /.reservation-form-buttons-->
            </form>
        </div> <!-- /.panel-->

        <!-- Footer -->
        {include file='footerUser.tpl'}

        <!-- JavaScript per selezione carta -->
        <script>
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
        </script>
        <!-- Javascript che si assicura che l'utente abbia selezionato una carta -->
        <script>
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
        </script>
    </body>
</html>