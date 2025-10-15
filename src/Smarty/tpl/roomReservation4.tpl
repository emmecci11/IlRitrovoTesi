<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Room - Step 4</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reservation.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
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
                <div class="step-circle">3</div>
                <div class="step-line"></div>
                <div class="step-circle active">4</div>
            </div>

            <hr class="step-separator">

            <!-- Email confirmation message -->
            <div class="confirmation-notice" style="margin-bottom: 1.5rem; padding: 1rem; background-color: rgba(139, 58, 58, 0.1); border-left: 4px solid #8b3a3a; color: #8b3a3a; font-weight: 600; backdrop-filter: blur(4px); border-radius: 4px;">
                You will receive a confirmation email shortly with the details of your booking.
            </div>

            <!-- Selection Summary -->
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
                </div> <!-- /.summary-row-->
                {/if}
                <div class="summary-row room-row">
                    <p><strong>Room Selected:</strong> {$selectedRoom->getAreaName()} – €{$selectedRoom->getTax()}</p>
                </div> <!-- /.summary-row-->
                <div class="summary-row price-row">
                    <p><strong>Total Price to Pay:</strong> €{$totalPrice}</p>
                </div> <!-- /.summary-row-->
            </div> <!-- /.reservation-summary-->

            <!-- Selected Payment Method -->
            <div class="summary-row" style="display: inline-block; margin-left: 30px;">
                <div class="summary-title">
                    <p><strong>Selected Payment Method:</strong></p>
                </div>
                <div class="credit-card" style="margin-left: 0; margin-right: auto;">
                    <div class="card-header {$selectedCard->getType()|lower|regex_replace:'/[^a-z]/':''}">
                        {$selectedCard->getType()}
                    </div> <!-- /.card-header-->
                    <div class="card-body">
                        <ul>
                            <li><strong>Number:</strong> **** **** **** {$selectedCard->getNumber()|substr:-4}</li>
                            <li><strong>Holder:</strong> {$selectedCard->getHolder()}</li>
                            <li><strong>Expiration:</strong> {$selectedCard->getExpiration()}</li>
                        </ul>
                    </div> <!-- /.card-body-->
                </div> <!-- /.credit-card-compact-->
            </div> <!-- /.summary-row-->

            <!-- Navigation Buttons -->
            <form action="/IlRitrovo/public/Reservation/checkPayment" method="post">
                <input type="hidden" name="selectedCardId" value="{$selectedCard->getIdCreditCard()}">
                <div class="reservation-form-buttons">
                    <button type="submit" class="btn-save-step">Confirm </button>
                </div> <!-- /.reservation-form-buttons-->
            </form>
        </div> <!--  /.panel-->

        <!-- Footer -->
        {include file='footerUser.tpl'}
    </body>
</html>