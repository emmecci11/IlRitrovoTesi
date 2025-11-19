<link href="/IlRitrovo/src/Smarty/css/style_delivery.css" rel="stylesheet">

<main id="delivery-wrapper">
    <div class="panel">
        <h1 class="delivery-title">Riepilogo e Pagamento</h1>

        <h2 class="section-subtitle">Il tuo Ordine</h2>
        <div class="order-summary-box">
            
            {foreach $reservation->getItems() as $item}
                <div class="summary-item">
                    <span>
                        <strong>{$item->getProduct()->getNameProduct()}</strong> 
                        <span style="color: #888; font-size: 0.9rem;"> (x{$item->getQuantity()})</span>
                    </span>
                    <span>{$item->getSubtotal()|string_format:"%.2f"} €</span>
                </div>
            {/foreach}
            
            <div class="summary-total">
                Totale: <span style="font-size: 1.5rem;">{$reservation->getTotPrice()|string_format:"%.2f"} €</span>
            </div>
        </div>

        <h2 class="section-subtitle">Scegli come pagare</h2>
        
        <form action="/IlRitrovo/public/Delivery/confirmOrder" method="POST">
            
            <div class="cards-container">
                {if $creditCards|@count > 0}
                    {foreach $creditCards as $card}
                        <div class="card-wrapper">
                            <input type="radio" 
                                   name="id_carta_credito" 
                                   id="card_{$card->getIdCreditCard()}" 
                                   value="{$card->getIdCreditCard()}" 
                                   class="card-option" 
                                   required>
                            
                            <label for="card_{$card->getIdCreditCard()}" class="card-label">
                                <div style="font-weight:bold; color:#8b3a3a; text-transform:uppercase; margin-bottom: 5px;">
                                    {$card->getType()}
                                </div>
                                <div style="font-size: 1.1rem; letter-spacing: 2px;">
                                    **** **** **** {$card->getNumber()|substr:-4}
                                </div>
                                <div style="font-size:0.8rem; margin-top:10px; color: #666;">
                                    INTESTATARIO: {$card->getHolder()|upper}
                                </div>
                                <div style="font-size:0.8rem; color: #666;">
                                    SCADENZA: {$card->getExpiration()|date_format:"%m/%y"}
                                </div>
                            </label>
                        </div>
                    {/foreach}
                {else}
                    <div style="text-align: center; width: 100%; padding: 2rem;">
                        <p>Non hai carte di credito salvate.</p>
                        <a href="/IlRitrovo/public/User/showUserProfile" class="btn-delivery" style="background-color: #666; display:inline-block; margin-top:10px;">
                            Vai al Profilo per aggiungere una carta
                        </a>
                    </div>
                {/if}
            </div>

            {if $creditCards|@count > 0}
                <button type="submit" class="btn-delivery">PAGA E CONFERMA ORDINE</button>
            {/if}
        </form>
    </div>
</main>

{include file='footerUser.tpl'}