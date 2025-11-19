<link href="/IlRitrovo/src/Smarty/css/style_delivery.css" rel="stylesheet">

<main id="delivery-wrapper">
    <div class="panel">
        <h1 class="delivery-title">Delivery Menu</h1>

        <form id="menuForm" action="/IlRitrovo/public/Delivery/processMenu" method="POST">
            
            <h2 class="section-subtitle">Pizze</h2>
            <div class="menu-grid">
                {foreach $allProducts as $product}
                    {if $product->getProductType() == 'PIZZA'}
                        <div class="product-card">
                            <span class="product-name">{$product->getNameProduct()}</span>
                            <span class="product-type">{$product->getProductType()}</span>
                            <div class="product-price">{$product->getPriceProduct()|string_format:"%.2f"} €</div>
                            
                            <label>Quantità:</label>
                            <input type="number" 
                                   name="quantita[{$product->getIdProduct()}]" 
                                   class="qty-input" 
                                   value="0" min="0" max="10">
                        </div>
                    {/if}
                {/foreach}
            </div>

            <h2 class="section-subtitle">Bibite</h2>
            <div class="menu-grid">
                {foreach $allProducts as $product}
                    {if $product->getProductType() == 'BIBITA'}
                        <div class="product-card">
                            <span class="product-name">{$product->getNameProduct()}</span>
                            <div class="product-price">{$product->getPriceProduct()|string_format:"%.2f"} €</div>
                            
                            <input type="number" 
                                   name="quantita[{$product->getIdProduct()}]" 
                                   class="qty-input" 
                                   value="0" min="0" max="10">
                        </div>
                    {/if}
                {/foreach}
            </div>

            <button type="submit" class="btn-delivery">AVANTI</button>
        </form>
    </div>


    <script>
    document.getElementById('menuForm').addEventListener('submit', function(event) {
        // 1. Prendo tutti gli input delle quantità
        const inputs = document.querySelectorAll('.qty-input');
        let totalQuantity = 0;

        // 2. Sommo i valori
        inputs.forEach(function(input) {
            // Converto il valore in intero (o 0 se vuoto)
            const val = parseInt(input.value) || 0;
            totalQuantity += val;
        });

        // 3. Se il totale è 0, blocco l'invio e mostro l'avviso
        if (totalQuantity === 0) {
            event.preventDefault(); // Ferma il POST
            alert("Per favore, seleziona almeno un prodotto o una bibita per continuare! 🍕🥤");
        }
    });
    </script>

</main>

{include file='footerUser.tpl'}