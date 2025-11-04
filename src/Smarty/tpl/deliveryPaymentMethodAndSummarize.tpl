<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riepilogo Ordine - Il Ritrovo</title>       
    <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
    <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
    <style>
        .summary-container {
            background-color: #fff;
            border-radius: 12px;
            padding: 25px;
            margin: 30px auto;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #8b3a3a;
            margin-bottom: 25px;
        }
        .order-summary {
            margin-bottom: 30px;
        }
        .order-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-summary th, .order-summary td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .order-summary th {
            background-color: #f4e3d7;
            color: #5a2c2c;
        }
        .total-price {
            text-align: right;
            font-size: 1.2rem;
            font-weight: bold;
            color: #8b3a3a;
            margin-top: 10px;
        }
        .credit-card {
            background-color: #fafafa;
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 15px;
            margin: 10px;
            flex: 1 1 30%;
            transition: all 0.2s ease;
        }
        .credit-card:hover {
            border-color: #8b3a3a;
        }
        .credit-card.selected {
            border-color: #8b3a3a;
            background-color: #fbeae4;
        }
        .card-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .btn-confirm {
            background-color: #8b3a3a;
            color: #fff;
            margin-top: 20px;
            display: block;
            width: 250px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body style="background-color: #f8f1e8;">

    <div class="summary-container">
        <h2>Riepilogo dell'Ordine</h2>

        <!-- Riepilogo Prodotti -->
        <div class="order-summary">
            <table>
                <thead>
                    <tr>
                        <th>Prodotto</th>
                        <th>Quantità</th>
                        <th>Prezzo Unitario</th>
                        <th>Totale</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$orderProducts item=product}
                        {assign var=id value=$product->getIdProduct()}
                        {assign var=qty value=$quantities[$id]|default:0}
                        <tr>
                            <td>{$product->getNameProduct()}</td>
                            <td>{$qty}</td>
                            <td>€{$product->getPriceProduct()}</td>
                            <td>€{math equation="x * y" x=$product->getPriceProduct() y=$qty format="%.2f"}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
            <div class="total-price">Totale: €{$totalPrice}</div>
        </div>

        <!-- Metodi di Pagamento -->
        <div class="panel">
            <div class="panel-heading">Scegli un Metodo di Pagamento</div>
            <div class="card-row">
                {foreach from=$userCreditCards item=card}
                    {assign var=cardClass value=$card->getType()|lower|regex_replace:'/[^a-z]/':''}
                    <div class="credit-card" data-id="{$card->getIdCreditCard()}">
                        <div class="card-header {$cardClass}">{$card->getType()}</div>
                        <div class="card-body">
                            <ul>
                                <li><strong>Numero:</strong> **** **** **** {$card->getNumber()|substr:-4}</li>
                                <li><strong>Titolare:</strong> {$card->getHolder()}</li>
                                <li><strong>Scadenza:</strong> {$card->getExpiration()}</li>
                            </ul>
                            <button type="button" class="btn save select-card-btn">Seleziona Carta</button>
                        </div>
                    </div>
                {/foreach}

                <!-- Aggiungi nuova carta -->
                <div class="credit-card add-card-btn" title="Aggiungi nuova carta">
                    <a href="/IlRitrovo/public/CreditCard/showAddCreditCardStep3" class="card-header"
                    style="text-align:center; font-size:2.5rem; cursor:pointer; user-select:none; color:#ff9f43; display:block;">+</a>
                </div>
            </div>
        </div>

        <form id="confirmOrderForm" action="/IlRitrovo/public/Delivery/confirmOrder" method="POST">
            <input type="hidden" id="selectedCardId" name="selectedCardId" value="">
            <button type="submit" class="btn btn-confirm">Conferma Ordine</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const cards = document.querySelectorAll(".credit-card");
            const selectedCardInput = document.getElementById("selectedCardId");

            cards.forEach(card => {
                const btn = card.querySelector(".select-card-btn");
                if (btn) {
                    btn.addEventListener("click", () => {
                        cards.forEach(c => c.classList.remove("selected"));
                        card.classList.add("selected");
                        selectedCardInput.value = card.getAttribute("data-id");
                    });
                }
            });

            document.getElementById("confirmOrderForm").addEventListener("submit", (e) => {
                if (!selectedCardInput.value) {
                    e.preventDefault();
                    alert("Seleziona una carta di credito per procedere al pagamento.");
                }
            });
        });
    </script>

    {include file='footerUser.tpl'}
</body>
</html>