<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delivery Menu - Il Ritrovo</title>       
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reviews.css" rel="stylesheet">
        <style>
            .delivery-menu {
                background-color: #fff;
                border-radius: 12px;
                padding: 20px;
                margin: 30px auto;
                width: 80%;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            .product-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid #ddd;
                padding: 10px 0;
            }
            .product-info {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .quantity-controls {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .quantity-controls button {
                background-color: #8b3a3a;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 5px 10px;
                cursor: pointer;
            }
            .quantity-controls input {
                width: 40px;
                text-align: center;
            }
            .btn-next {
                display: block;
                margin: 20px auto;
                padding: 12px 24px;
                font-weight: bold;
                border: none;
                border-radius: 8px;
                background-color: #8b3a3a;
                color: #fff;
                cursor: pointer;
                transition: background-color 0.2s;
            }
            .btn-next:hover {
                background-color: #a54b4b;
            }
            .error-message {
                color: #b22222;
                text-align: center;
                font-weight: bold;
                display: none;
                margin-top: 10px;
            }
        </style>
    </head>

    <body style="background-color: #f8f1e8;">

        <!-- Header rendered through the View -->

        <div class="delivery-menu">
            <h2 style="text-align:center; color:#8b3a3a;">Delivery Menu</h2>

            <form id="deliveryForm" action="/IlRitrovo/public/Delivery/showUserInfo" method="POST">
                {foreach from=$allProducts item=product}
                    <div class="product-item">
                        <div class="product-info">
                            <input type="checkbox" name="product_ids[]" value="{$product->getIdProduct()}" class="product-checkbox">
                            <span><strong>{$product->getNameProduct()}</strong> - €{$product->getPriceProduct()}</span>
                        </div>

                        <div class="quantity-controls">
                            <button type="button" class="decrease">-</button>
                            <input type="number" name="quantities[{$product->getIdProduct()}]" value="0" min="0" disabled>
                            <button type="button" class="increase">+</button>
                        </div>
                    </div>
                {/foreach}

                <p class="error-message" id="errorMsg">⚠️ Attenzione: assicurati di selezionare almeno un prodotto e che ciascuno abbia una quantità maggiore di zero.</p>

                <button type="submit" class="btn-next">Avanti</button>
            </form>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const form = document.getElementById("deliveryForm");
                const errorMsg = document.getElementById("errorMsg");

                document.querySelectorAll(".product-item").forEach(item => {
                    const checkbox = item.querySelector(".product-checkbox");
                    const input = item.querySelector("input[type='number']");
                    const dec = item.querySelector(".decrease");
                    const inc = item.querySelector(".increase");

                    // Abilita/disabilita quantità in base alla selezione
                    checkbox.addEventListener("change", () => {
                        input.disabled = !checkbox.checked;
                        if (!checkbox.checked) input.value = 0;
                    });

                    dec.addEventListener("click", () => {
                        let val = parseInt(input.value);
                        if (val > 0) input.value = val - 1;
                    });

                    inc.addEventListener("click", () => {
                        input.value = parseInt(input.value) + 1;
                        if (!checkbox.checked) checkbox.checked = true;
                        input.disabled = false;
                    });
                });

                // Validazione prima dell'invio
                form.addEventListener("submit", (e) => {
                    let valid = true;
                    let selected = 0;
                    errorMsg.style.display = "none";

                    document.querySelectorAll(".product-item").forEach(item => {
                        const checkbox = item.querySelector(".product-checkbox");
                        const quantity = parseInt(item.querySelector("input[type='number']").value);

                        if (checkbox.checked) {
                            selected++;
                            if (quantity === 0) valid = false;
                        }
                    });

                    // Nessun prodotto selezionato
                    if (selected === 0) {
                        valid = false;
                    }

                    if (!valid) {
                        e.preventDefault();
                        errorMsg.style.display = "block";
                        window.scrollTo({ top: 0, behavior: "smooth" });
                    }
                });
            });
        </script>

        {include file='footerUser.tpl'}
    </body>
</html>