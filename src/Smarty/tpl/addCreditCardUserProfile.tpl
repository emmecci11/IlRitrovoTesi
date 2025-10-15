<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Credit Card - Il Ritrovo</title>       
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/loginSignup.css" rel="stylesheet">
        <style>
            body.edit-background {
                background-image: url('/IlRitrovo/src/Smarty/assets/images/backgrounds/addCreditCardUserProfile.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }

            .modal-content {
                width: 90%;
                max-width: 700px;
                padding: 2rem 2.5rem;
                border-radius: 12px;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 0 20px rgba(139, 58, 58, 0.3);
                color: #4a3b2c;
                box-sizing: border-box;
            }

            .card-form input,
            .card-form select {
                width: 100%;
                padding: 0.6rem;
                margin-bottom: 1.2rem;
                border-radius: 6px;
                border: 1px solid #ccc;
            }

            .card-form button {
                background-color: #ff9f43;
                color: white;
                border: none;
                padding: 0.6rem 1.2rem;
                border-radius: 6px;
                cursor: pointer;
                font-weight: bold;
            }

            .card-form .btn.cancel {
                background-color: #888;
                margin-left: 1rem;
            }

            .form-action-right {
                display: flex;
                justify-content: flex-end;
                margin-top: 1rem;
            }
        </style>
    </head>

    <body class="edit-background">

        <!-- Header rendered through the View -->

        <div class="modal">
            <div class="modal-content">
                <h2>Add a New Credit Card</h2>
                <form method="post" action="/IlRitrovo/public/CreditCard/checkAddCreditCard" class="card-form">
                    <label for="cardType">Type</label>
                    <select name="cardType" id="cardType" required>
                        <option value="">Select type</option>
                        {foreach from=$allowedTypes item=type}
                            <option value="{$type}" {if isset($cardData.type) and $cardData.type == $type}selected{/if}>{$type}</option>
                        {/foreach}
                    </select>

                    <label for="cardNumber">Number</label>
                    <input type="text" name="cardNumber" id="cardNumber" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" required value="{$cardData.number|default:''}">

                    <label for="cardHolder">Holder</label>
                    <input type="text" name="cardHolder" id="cardHolder" required value="{$cardData.holder|default:''}">

                    <label for="expiryDate">Expiration Date</label>
                    <input type="date" name="expiryDate" id="expiryDate" required value="{$cardData.expiration|default:''}">

                    <label for="cardCVV">CVV</label>
                    <input type="text" name="cardCVV" id="cardCVV" maxlength="4" pattern="^\d{ldelim}3,4{rdelim}$" placeholder="3 or 4 digits" required value="{$cardData.cvv|default:''}">

                    <div class="form-action-right">
                        <button type="submit" name="save">Save</button>
                    </div>
                </form>
                <p><a href="/IlRitrovo/public/User/showProfile">Back to Profile</a></p>
            </div> <!-- /.modal-content-->
        </div> <!-- /.modal-->
    </body>
</html>