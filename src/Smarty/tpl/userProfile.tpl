<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Profile - Il Ritrovo</title>       
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reviews.css" rel="stylesheet">
    </head>

    <body style="background-color: #f8f1e8;">

        <!-- Header rendered through the View -->

        <!-- Profile -->
        <div class="panel panel-default">
            <div class="panel-heading">User Profile</div>
            <div class="panel-body">
                <div class="profile-container">
                    <!-- Profile Image -->
                    <div class="profile-image-section">
                        <img src="/IlRitrovo/src/Smarty/assets/images/logo/user.jpg" alt="Test User" class="profile-img current">
                    </div> <!-- /.profile-image-section-->
                    <!-- Metadata Section -->
                    <div class="profile-info-section">
                        <!-- Username -->
                        <div class="username-header">
                            <h3><strong>Username: </strong>{$username}</h3>
                        </div> <!-- /.username-header-->
                        <!-- Group 1: Username + Email and Password -->
                        <div class="user-info-group">
                            <div class="credentials-row">
                                <div class="credential-item"><strong>Email: </strong>{$email}</div>
                                <div class="credential-item"><strong>Password: </strong>********</div>
                            </div> <!-- /.credentials-row -->
                            <div class="form-action-right">
                                <a href="/IlRitrovo/public/User/showEditProfileMetadata" class="btn edit">Edit</a>
                            </div> <!-- /.form-action-right -->
                        </div> <!-- /.user-info-group -->
                        <hr class="separator">
                        <!-- Group 2: Personal Data -->
                        <div class="user-info-group">
                            <div class="personal-data-row">
                                <div class="personal-item"><strong>Name:</strong> {$name}</div>
                                <div class="personal-item"><strong>Surname:</strong> {$surname}</div>
                            </div> <!-- /.personal-data-row -->
                            <div class="personal-data-row">
                                <div class="personal-item"><strong>Birth Date:</strong> {$birthdate}</div>
                                <div class="personal-item"><strong>Phone:</strong> {$phone}</div>
                            </div> <!-- /.personal-data-row -->
                            <div class="form-action-right">
                                <a href="/IlRitrovo/public/User/showEditProfileData" class="btn edit">Edit</a>
                            </div> <!-- /.form-action-right -->
                        </div> <!-- /.user-info-group -->
                    </div> <!-- /.profile-info-section-->
                </div> <!-- /.profile-container -->
            </div> <!-- /.panel-body -->
        </div> <!-- /.panel panel-default -->

        <!-- Cards -->
        <div class="panel">
            <div class="panel-heading">My Credit Cards</div>
            <div class="card-row">
                {foreach from=$cards item=card}
                    {assign var=cardClass value=$card->getType()|lower|regex_replace:'/[^a-z]/':''}
                    <div class="credit-card">
                        <div class="card-header {$cardClass}">{$card->getType()}</div>
                        <div class="card-body">
                            <ul>
                                <li><strong>Number:</strong> **** **** **** {$card->getNumber()|substr:-4}</li>
                                <li><strong>Holder:</strong> {$card->getHolder()}</li>
                                <li><strong>Expiration:</strong> {$card->getExpiration()}</li>
                            </ul>
                            <div class="form-action-right">
                                <a href="/IlRitrovo/public/CreditCard/deleteCreditCard/{$card->getIdCreditCard()}" class="btn delete"> Delete </a>
                            </div>
                        </div>
                    </div>
                {/foreach}
                <!-- Add card button linking to separate page -->
                <div class="credit-card add-card-btn" title="Aggiungi nuova carta">
                    <a href="/IlRitrovo/public/CreditCard/showAddCreditCardUserProfile" class="card-header"
                    style="text-align:center; font-size:2.5rem; cursor:pointer; user-select:none; color:#ff9f43;">+ </a>
                </div> <!-- /.credit-card add-card-btn-->
            </div> <!-- /.card-row-->
        </div> <!-- /.panel-->

        <!-- FUTURE Reservations-->
        <div class="panel">
            <div class="panel-heading">My Future Reservations</div>
            {foreach from=$futureReservations item=reservation}
                <div class="reservation-card">
                    <ul>
                        <li><strong>Type:</strong>
                            {if $reservation->getIdRoom() !== null}
                                Room
                            {elseif $reservation->getIdTable() !== null}
                                Table
                            {else}
                                Unknown
                            {/if}
                        </li>
                        <li><strong>Guests:</strong> {$reservation->getPeople()}</li>
                        <li><strong>Reservation Date:</strong> {$reservation->getReservationDate()}</li>
                        <li><strong>Time Frame:</strong> {$reservation->getReservationTimeFrame()}</li>
                        <li><strong>Status:</strong> {$reservation->getState()}</li>
                        <li><strong>Notes:</strong> {$reservation->getComment()}</li>
                        <li><strong>Extras:</strong>
                            {if $reservation->getExtras()|@count > 0}
                                <ul class="extras-list">
                                    {foreach from=$reservation->getExtras() item=extra}
                                        <li>{$extra->getNameExtra()} - €{$extra->getPriceExtra()}</li>
                                    {/foreach}
                                </ul>
                            {else}
                                No
                            {/if}
                        </li>
                        <li><strong>Total Amount:</strong> €{$reservation->getTotPrice()}</li>
                    </ul>

                    <!-- Pulsante Disdici -->
                    <div class="reservation-actions" style="text-align:right; margin-top:10px;">
                        <a href="/IlRitrovo/public/Reservation/showRemoveReservation/{$reservation->getIdReservation()}"
                            class="cancel-btn"
                            style="background-color:#dc3545; color:#fff; padding:8px 16px; border-radius:8px; text-decoration:none; font-weight:bold; transition:background-color 0.2s;">
                            Disdici
                        </a>
                    </div>
                </div> <!-- /.reservation-card-->
            {/foreach}
        </div> <!-- /.panel-->

        {if $pastReservations|@count > 0}
            <!-- PAST Reservations-->
            <div class="panel">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>My Past Reservations</span>
                </div> <!-- /.panel-heading-->
                <div class="panel" style="background-color: #f8f1e8;">
                    <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>My Review</span>
                    </div> <!-- /.panel-heading-->
                    {if $review === null}
                        <div class="review-form">
                            <form action="/IlRitrovo/public/Review/checkAddReview" method="post">
                                <label for="stars">Rating:</label>
                                <div class="rating-stars">
                                    {for $i=5 to 1 step -1}
                                        <input type="radio" name="stars" id="star{$i}" value="{$i}" required>
                                        <label for="star{$i}">★</label>
                                    {/for}
                                </div> <!-- /.rating-stars-->
                                <label for="body">Your Review:</label>
                                <textarea name="body" rows="4" required>{$body|default:''}</textarea>
                                <div class="form-action-right">
                                    <button type="submit" class="btn save">Submit</button>
                                </div> <!-- /.form-action-right-->
                            </form>
                        </div> <!-- /.review-form-->
                    {else}
                        <div class="review-form">
                            <div class="existing-review">
                                <p><strong>Rating:</strong> {$review->getStars()} / 5</p>
                                <p><strong>Review:</strong> {$review->getBody()}</p>
                                <div class="form-action-right">
                                    <a href="/IlRitrovo/public/Review/deleteReview/{$review->getIdReview()}" class="btn delete">Delete</a>
                                </div> <!-- /.form-action-right-->
                            </div> <!-- /.esisting-review-->
                            {if $review->getReply() !== null}
                                <div class="admin-reply" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #c7b299;">
                                    <p><strong>Reply from the restaurant:</strong></p>
                                    <p>{$review->getReply()->getBody()}</p>
                                </div> <!-- /.admin-reply-->
                            {/if}
                        </div> <!-- /.review-form-->
                    {/if}
                </div> <!-- /.panel-->
                {foreach from=$pastReservations item=reservation}
                    <div class="reservation-card">
                        <ul>
                            <li><strong>Type:</strong>
                                {if $reservation->getIdRoom() !== null}
                                    Room
                                {elseif $reservation->getIdTable() !== null}
                                    Table
                                {else}
                                    Unknown
                                {/if}
                            </li>
                            <li><strong>Guests:</strong> {$reservation->getPeople()}</li>
                            <li><strong>Reservation Date:</strong> {$reservation->getReservationDate()}</li>
                            <li><strong>Time Frame:</strong> {$reservation->getReservationTimeFrame()}</li>
                            <li><strong>Status:</strong> {$reservation->getState()}</li>
                            <li><strong>Notes:</strong> {$reservation->getComment()}</li>
                            <li><strong>Extras:</strong>
                                {if $reservation->getExtras()|@count > 0}
                                    <ul class="extras-list">
                                        {foreach from=$reservation->getExtras() item=extra}
                                            <li>{$extra->getNameExtra()} - €{$extra->getPriceExtra()}</li>
                                        {/foreach}
                                    </ul>
                                {else}
                                    No
                                {/if}
                            </li>
                            <li><strong>Total Amount:</strong> €{$reservation->getTotPrice()}</li>
                        </ul>
                    </div> <!-- /.reservation-card-->
                {/foreach}
            </div> <!-- /.panel-->
        {/if}

        <!-- Footer-->
        {include file='footerUser.tpl'}
    </body>
</html>