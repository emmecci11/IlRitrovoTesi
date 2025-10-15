<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Room - Step 1</title>
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
                <div class="step-line"></div>
                <div class="step-circle">4</div>
            </div> <!-- /.step-indicator-->

            <hr class="step-separator">

            <!-- Heading -->
            <h2 class="panel-heading">Book a Room with us!</h2>

            <!-- Booking Form -->
            <form action="/IlRitrovo/public/Reservation/showValidRooms" method="POST" class="booking-form">
                <div class="form-group">
                    <label for="timeframe">Time Frame</label>
                    <select name="timeFrame" id="timeFrame" required>
                        <option value="">-- Select --</option>
                        <option value="lunch" {if $timeFrame == 'lunch'}selected{/if}>Lunch</option>
                        <option value="dinner" {if $timeFrame == 'dinner'}selected{/if}>Dinner</option>
                    </select>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="people">Guests</label>
                    <input type="number" name="people" id="people" min="1" max="100" value="{$people|default:''}" required>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="reservationDate">Date</label>
                    <input type="date" name="reservationDate" id="reservationDate"
                            value="{$reservationDate|default:''}"
                            min="{$smarty.now|date_format:"%Y-%m-%d"}"
                            required>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" rows="4" placeholder="Allergies, high chair request, intolerances...">{$comment|default:''}</textarea>
                </div> <!-- /.form-group-->

                {if isset($extras) && $extras|@count > 0}
                    <div class="form-group">
                        <label for="extras">Add Extras</label>
                        <div class="extras-list">
                            {foreach from=$extras item=extra}
                                <div class="extra-item">
                                    <input type="checkbox" 
                                        id="extra_{$extra->getIdExtra()}" 
                                        name="extras[]" 
                                        value="{$extra->getIdExtra()}" 
                                        data-price="{$extra->getPriceExtra()}" 
                                        class="hidden-checkbox"
                                        {if isset($selectedExtras) && in_array($extra->getIdExtra(), $selectedExtras)}checked{/if}>

                                    <label class="custom-extra-label" for="extra_{$extra->getIdExtra()}">
                                        {$extra->getNameExtra()} (+€{$extra->getPriceExtra()|number_format:2:',':' '})
                                    </label>
                                </div> <!-- /.extra-item-->
                            {/foreach}
                        </div> <!-- /.extra-list-->
                    </div> <!-- /.form-group-->

                    <div class="total-extras-box" id="totalExtrasBox">
                        <strong>Totale Extra:</strong> €<span id="extrasTotal">0.00</span>
                    </div> <!-- /.total-extra-box-->
                {/if}

                <div class="reservation-form-buttons">
                    <button type="submit" class="btn-save-step">Next</button>
                </div> <!-- /.reservation-form-buttons -->
            </form>

        </div>  <!--/.panel-->

        <!-- Footer-->
        {include file='footerUser.tpl'}

        <!-- Pezzo JavaScript scritto per permettere alla pagina di aggiornare dinamicamente il totale in base alla selezione degli extra fatta sul
         momento dall'utente, non era possibile eseguire questo comportamento con solo html/tpl senza dover ricaricare la pagina ogni volta, poco user-friendly-->
        <script>
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
        </script>
    </body>
</html>