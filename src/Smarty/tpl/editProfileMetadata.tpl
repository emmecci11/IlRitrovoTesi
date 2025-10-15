<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Your Metadata - Il Ritrovo</title>       
        <!-- Template Stylesheet -->
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/loginSignup.css" rel="stylesheet">
        <style>
            body.edit-background {
                background-image: url('/IlRitrovo/src/Smarty/assets/images/backgrounds/editUserBackground.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }

            .modal-content {
                width: 90%;
                max-width: 650px;  /* aumentato da 400px a 600px */
                padding: 2rem 2.5rem;
                border-radius: 12px;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 0 20px rgba(139, 58, 58, 0.3);
                color: #4a3b2c;
                box-sizing: border-box;
            }
        </style>
    </head>

    <body class="edit-background">

        <!-- Header rendered through the View -->

        <div class="modal">
            <div class="modal-content">
                <h2>Edit Access Data</h2>
                <form method="post" action="/IlRitrovo/public/User/editProfileMetadata">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{$username}" required />
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{$email}" required />
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required />
                    <!-- Password Requirements -->
                    <div id="passwordHelp" class="password-requirements" aria-live="polite">
                        <p>Password must include:</p>
                        <ul>
                            <li id="length" class="invalid">At least 8 characters</li>
                            <li id="uppercase" class="invalid">At least one uppercase letter</li>
                            <li id="lowercase" class="invalid">At least one lowercase letter</li>
                            <li id="number" class="invalid">At least one number</li>
                            <li id="special" class="invalid">At least one special character</li>
                        </ul>
                    </div> <!-- /.password-requirements-->
                    <button type="submit">Save Access Data</button>
                </form>
                <p><a href="/IlRitrovo/public/User/showProfile">Back to Profile</a></p>
            </div> <!-- /.modal-content-->
        </div> <!-- /.modal-->

        <script>
            // Prendo il campo input della password dal DOM tramite il suo id 'password'
            const passwordInput = document.getElementById('password');

            // Prendo i vari elementi della lista dei requisiti password per poterli aggiornare dinamicamente
            const lengthReq = document.getElementById('length');
            const uppercaseReq = document.getElementById('uppercase');
            const lowercaseReq = document.getElementById('lowercase');
            const numberReq = document.getElementById('number');
            const specialReq = document.getElementById('special');

            // Aggiungo un listener che reagisce all'evento 'input' del campo password, cioè ogni volta che l'utente digita qualcosa
            passwordInput.addEventListener('input', () => {
            // Prendo il valore corrente digitato nella password
            const val = passwordInput.value;

            // Controllo se la lunghezza è almeno 8 caratteri
            if (val.length >= 8) {
                // Se la condizione è soddisfatta, aggiungo la classe 'valid' e rimuovo 'invalid'
                lengthReq.classList.add('valid');
                lengthReq.classList.remove('invalid');
            } else {
                // Altrimenti faccio l'opposto
                lengthReq.classList.add('invalid');
                lengthReq.classList.remove('valid');
            }

            // Controllo se la password contiene almeno una lettera maiuscola usando una regex
            if (/[A-Z]/.test(val)) {
                uppercaseReq.classList.add('valid');
                uppercaseReq.classList.remove('invalid');
            } else {
                uppercaseReq.classList.add('invalid');
                uppercaseReq.classList.remove('valid');
            }

            // Controllo se la password contiene almeno una lettera minuscola
            if (/[a-z]/.test(val)) {
                lowercaseReq.classList.add('valid');
                lowercaseReq.classList.remove('invalid');
            } else {
                lowercaseReq.classList.add('invalid');
                lowercaseReq.classList.remove('valid');
            }

            // Controllo se la password contiene almeno un numero
            if (/\d/.test(val)) {
                numberReq.classList.add('valid');
                numberReq.classList.remove('invalid');
            } else {
                numberReq.classList.add('invalid');
                numberReq.classList.remove('valid');
            }

            // Controllo se la password contiene almeno un carattere speciale (non alfanumerico)
            if (/[^a-zA-Z0-9]/.test(val)) {
                specialReq.classList.add('valid');
                specialReq.classList.remove('invalid');
            } else {
                specialReq.classList.add('invalid');
                specialReq.classList.remove('valid');
            }
            });
        </script>
    </body>
</html>