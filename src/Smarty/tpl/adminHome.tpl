<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">       
        <title>Home Admin - Il Ritrovo</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
    </head>
    <body>

        <!-- Header rendered through the View -->

        <!-- Section Table Reservation -->
        <div class="panel panel-default">
            <div class="panel-heading">Tables Reservations</div>
            <div class="panel-body">
                <!-- Reservation Base Container -->
                <div id="reservationContainer" class="reservation-container">
                    {if $comingTableReservations|@count > 0}
                        {foreach from=$comingTableReservations item=reservation}
                            <!-- Single Reservation Card -->
                            <div class="reservation-card" id="reservation-{$reservation->getIdReservation()}">
                                <div class="reservation-header">
                                    Reservation {$reservation->getIdReservation()}
                                </div> <!-- /.reservation-header-->
                                <div class="reservation-details">
                                    <div class="reservation-row">
                                        <span><strong>Date:</strong> {$reservation->getReservationDate()}</span>
                                        <span><strong>Time Frame:</strong> {$reservation->getReservationTimeFrame()}</span>
                                    </div> <!-- /.reservation-row-->
                                    <div class="reservation-row">
                                        <span><strong>Table:</strong> {$reservation->getAreaName()}</span>
                                        <span><strong>Guests:</strong> {$reservation->getPeople()} people</span>
                                    </div> <!-- /.reservation-row--> 
                                    <div class="reservation-row">
                                        <span><strong>User:</strong> {$reservation->getUsername()}</span>
                                        <span><strong>Comment:</strong> {$reservation->getComment()}</span>
                                    </div> <!-- /.reservation-row-->
                                </div> <!-- /.reservation-details-->
                            </div> <!-- /.reservation-card-->
                        {/foreach}
                    {else}
                        <p>No upcoming table reservations available.</p>
                    {/if}
                </div> <!-- /.reservation-container-->
            </div> <!--/.panel-body-->
        </div> <!-- /.panel panel-default-->

        <!-- Section Room Reservation -->
        <div class="panel panel-default">
            <div class="panel-heading">Rooms Reservations</div>
            <div class="panel-body">
                <!-- Reservation Base Container -->
                <div id="reservationContainer" class="reservation-container">
                    {if $comingRoomReservations|@count > 0}
                        {foreach from=$comingRoomReservations item=reservation}
                            <!-- Single Reservation Card -->
                            <div class="reservation-card" id="reservation-{$reservation->getIdReservation()}">
                                <div class="reservation-header">
                                    Reservation {$reservation->getIdReservation()}
                                </div> <!-- /.reservation-header-->
                                <div class="reservation-details">
                                    <div class="reservation-row">
                                        <span><strong>Date:</strong> {$reservation->getReservationDate()}</span>
                                        <span><strong>Time Frame:</strong> {$reservation->getReservationTimeFrame()}</span>
                                    </div> <!-- /.reservation-row-->
                                    <div class="reservation-row">
                                        <span><strong>Room:</strong> {$reservation->getAreaName()}</span>
                                        <span><strong>Guests:</strong> {$reservation->getPeople()} people</span>
                                    </div> <!-- /.reservation-row--> 
                                    <div class="reservation-row">
                                        <span><strong>User:</strong> {$reservation->getUsername()}</span>
                                        <span><strong>Comment:</strong> {$reservation->getComment()}</span>
                                    </div> <!-- /.reservation-row-->
                                    <div class="reservation-row">
                                        <span><strong>Price:</strong> {$reservation->getTotPrice()}</span>
                                        <span><strong>Extras</strong>
                                            {if $reservation->getExtras()|@count > 0}
                                                <ul class="extras-list">
                                                    {foreach from=$reservation->getExtras() item=extra}
                                                        <li>{$extra->getNameExtra()} - €{$extra->getPriceExtra()}</li>
                                                    {/foreach}
                                                </ul>
                                            {else}
                                                No extra selected
                                            {/if}
                                        </span>
                                    </div> <!-- /.reservation-row-->
                                </div> <!-- /.reservation-details-->
                            </div> <!-- /.reservation-card-->
                        {/foreach}
                    {else}
                        <p>No upcoming room reservations available.</p>
                    {/if}
                </div> <!-- /.reservation-container-->
            </div> <!--/.panel-body-->
        </div> <!-- /.panel panel-default-->

        <!-- Footer-->
        {include file='footerAdmin.tpl'}
    </body>
</html>