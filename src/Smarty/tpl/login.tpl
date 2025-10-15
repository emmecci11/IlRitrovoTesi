<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Il Ritrovo</title>
    <link href="/IlRitrovo/src/Smarty/css/loginSignup.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet" />
    </head>
    <body>

        <div class="modal">
            <div class="modal-content">
                <h2>Login</h2>
                <form action="/IlRitrovo/public/User/checkLogin" method="POST">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required />
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required />
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            🙈
                        </button>
                    </div> <!-- /.password-wrapper-->
                    <button type="submit">Login</button>
                </form>
                <p>Don't have an account? <a href="/IlRitrovo/public/User/showSignUpForm">Sign up here</a></p>
            </div> <!-- /.modal-content-->
        </div> <!-- /.modal-->

        <script> // Per mostrare e nascondere la password
            // Definizione della funzione che verrà chiamata quando l'utente clicca sull'icona per mostrare/nascondere la password
            function togglePassword() {
                // Recupera il campo input della password tramite il suo ID
                const passwordInput = document.getElementById('password');
                // Recupera il pulsante o elemento che l’utente clicca per attivare la funzione (deve avere la classe 'toggle-password')
                const toggleBtn = document.querySelector('.toggle-password');
                // Verifica se il campo password è attualmente di tipo 'password'
                const isPassword = passwordInput.type === 'password';
                // Se il campo è di tipo 'password', cambia in 'text' (per mostrare la password),
                // altrimenti torna a 'password' (per nasconderla)
                passwordInput.type = isPassword ? 'text' : 'password';
                // Cambia il contenuto testuale (in questo caso un'emoji) del pulsante per indicare lo stato attuale
                // 🐵 = password visibile, 🙈 = password nascosta
                toggleBtn.textContent = isPassword ? '🐵' : '🙈';
            }
        </script>
    </body>
</html>