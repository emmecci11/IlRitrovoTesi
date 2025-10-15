<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Book a Table - Step 1</title>
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
            </div> <!-- /.step-indicator-->

            <hr class="step-separator">

            <!-- Heading -->
            <h2 class="panel-heading">Book a Table with us</h2>

            <!-- Booking Form -->
            <form method="post" action="/IlRitrovo/public/Reservation/showValidTable" class="booking-form">
                <div class="form-group">
                    <label for="timeFrame">Time Frame</label>
                    <select name="timeFrame" id="timeFrame" required>
                        <option value="">-- Select --</option>
                        <option value="lunch" {if $timeFrame == 'lunch'}selected{/if}>Lunch</option>
                        <option value="dinner" {if $timeFrame == 'dinner'}selected{/if}>Dinner</option>
                    </select>
                </div> <!-- /.form-group-->

                <div class="form-group">
                    <label for="people">Guests</label>
                    <input type="number" name="people" id="people" min="1" max="20" value="{$people|default:''}" required>
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

                <div class="reservation-form-buttons">
                    <button type="submit" class="btn-save-step">Next</button>
                </div> <!-- /.reservtion-form-buttons-->
            </form>

        </div>  <!--/.panel-->

        <!-- Footer-->
        {include file='footerUser.tpl'}
    </body>
</html>