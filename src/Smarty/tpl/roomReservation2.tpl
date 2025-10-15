<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Room - Step 2</title>
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
                </div> <!-- /.extras-row-->
                {/if}
                <div class="summary-row price-row">
                    <p><strong>Partial Total (so far):</strong> €{$totPriceExtra}</p>
                </div> <!-- /.summary-row-->
            </div> <!-- /.reservation-summary-->

            <!-- Restaurant Map -->
            <div class="restaurant-map">
                <img src="/IlRitrovo/src/Smarty/assets/images/maps/Rooms_map.png" alt="Restaurant Map">
            </div> <!-- /.restaurrant-map-->

            <!-- Room Selection -->
            <form method="post" action="/IlRitrovo/public/Reservation/dataRoomReservation" class="booking-form">
                <div class="form-group">
                    <label for="room">Select a Room</label>
                    <select name="idRoom" id="idRoom" required>
                        {foreach from=$availableRooms item=room}
                        <option value="{$room.idRoom}" data-tax="{$room.tax}"> Room {$room.areaName} – Seats: {$room.maxGuests} – €{$room.tax} </option>
                        {/foreach}
                    </select>
                </div> <!-- /.form-group-->

                <div class="total-extras-box" id="totalExtrasBox">
                    <strong>Total Price:</strong> €<span id="totalPrice">{$totPriceExtra}</span>
                </div> <!--  /.total-extra-box-->

                <div class="reservation-form-buttons">
                    <button type="submit" class="btn-save-step">Next</button>
                </div> <!--/.reservation-form-buttons-->
            </form>
        </div> <!-- /.panel-->

        <!-- Footer -->
        {include file='footerUser.tpl'}

        <!-- Pezzo JavaScript scritto per permettere alla pagina di aggiornare dinamicamente il totale in base alla selezione della room fatta sul
         momento dall'utente, non era possibile eseguire questo comportamento con solo html/tpl senza dover ricaricare la pagina ogni volta, poco user-friendly-->
        <script>
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
        </script>
    </body>
</html>