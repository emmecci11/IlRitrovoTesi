<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disdici Prenotazione - Il Ritrovo</title>

    <!-- CSS comuni -->
    <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
    <link href="/IlRitrovo/src/Smarty/css/header.css" rel="stylesheet">

    <!-- CSS specifico per questa pagina -->
    <link href="/IlRitrovo/src/Smarty/css/removeReservation.css" rel="stylesheet">
</head>

<body>
    <main class="remove-reservation-container">
        <div class="remove-reservation-card">
            <h2>Conferma disdetta prenotazione</h2>

            <div class="reservation-summary">
                <p><strong>Data:</strong> {$reservationDate}</p>
                <p><strong>Fascia oraria:</strong> {$timeFrame}</p>
                <p><strong>Numero persone:</strong> {$people}</p>
                <p><strong>Commento:</strong> {$comment}</p>
            </div>

            <div class="remove-reservation-actions">
                <a href="/IlRitrovo/public/Reservation/confirmRemoveReservation" 
                   class="btn confirm">Conferma</a>
                <a href="/IlRitrovo/public/User/showProfile" 
                   class="btn cancel">Annulla</a>
            </div>
        </div>
    </main>
</body>
</html>