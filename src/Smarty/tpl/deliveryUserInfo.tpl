{include file='header.tpl'}

<link href="/IlRitrovo/src/Smarty/css/style_delivery.css" rel="stylesheet">

<main id="delivery-wrapper">
    <div class="panel">
        <h1 class="delivery-title">Dove dobbiamo consegnare?</h1>

        <div class="delivery-form-container">
            <form action="/IlRitrovo/public/Delivery/processUserInfo" method="POST">
                
                <div class="split-row">
                    <div class="form-group">
                        <label>Via / Piazza</label>
                        <input type="text" name="userAddress" class="form-input" placeholder="Es. Via Roma" required>
                    </div>
                    <div class="form-group" style="flex: 0 0 100px;">
                        <label>N. Civico</label>
                        <input type="number" name="userNumberAddress" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Quando desideri ricevere l'ordine?</label>
                    <div class="split-row">
                        <input type="date" name="wishedDate" class="form-input" required>
                        
                        <input type="time" name="wishedTime" class="form-input" min="08:00" max="23:00" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Il tuo numero di telefono per la consegna</label>
                    <input type="tel" name="userPhone" class="form-input" placeholder="333..." pattern="[0-9]{10}" title="Inserisci un numero valido a 10 cifre" required>
                </div>

                <button type="submit" class="btn-delivery">RIEPILOGO E PAGAMENTO</button>
            </form>
        </div>
    </div>
</main>

{include file='footerUser.tpl'}