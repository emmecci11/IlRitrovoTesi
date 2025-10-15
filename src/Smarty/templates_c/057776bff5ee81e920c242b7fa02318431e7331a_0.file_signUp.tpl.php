<?php
/* Smarty version 5.5.1, created on 2025-07-08 00:17:51
  from 'file:signUp.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686c478f2dc899_15448550',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '057776bff5ee81e920c242b7fa02318431e7331a' => 
    array (
      0 => 'signUp.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686c478f2dc899_15448550 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up - Il Ritrovo</title>
    <link href="/IlRitrovo/src/Smarty/css/loginSignup.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet" />
    </head>
    <body>

        <!-- Header rendered through the View -->

        <div class="modal" role="dialog" aria-labelledby="signup-title" aria-modal="true">
            <div class="modal-content">
                <h2 id="signup-title">Create your account</h2>
                <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                    <div class="form-error"><?php echo $_smarty_tpl->getValue('error');?>
</div>
                <?php }?>
                <form action="/IlRitrovo/public/User/checkRegister" method="POST">
                    <label for="username">Username</label>
                    <input
                    type="text"
                    id="username"
                    name="username"
                    required
                    minlength="3"
                    maxlength="20"
                    pattern="^[a-zA-Z0-9_]{3,20}$"
                    title="Username must be 3-20 characters, letters, numbers and underscore only"
                    autocomplete="username"
                    />
                    <label for="email">Email</label>
                    <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    autocomplete="email"
                    />
                    <label for="name">Name</label>
                    <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    autocomplete="given-name"
                    />
                    <label for="surname">Surname</label>
                    <input
                    type="text"
                    id="surname"
                    name="surname"
                    required
                    autocomplete="family-name"
                    />
                    <label for="birthDate">Birth Date</label>
                    <input
                    type="date"
                    id="birthDate"
                    name="birthDate"
                    required
                    max="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%Y-%m-%d");?>
"
                    autocomplete="bday"
                    />
                    <label for="phone">Phone</label>
                    <input
                    type="tel"
                    id="phone"
                    name="phone"
                    pattern="^\+?\d{8,15}$"
                    placeholder="+391234567890"
                    required
                    title="Phone number must contain 8 to 15 digits, may start with +"
                    autocomplete="tel"
                    />
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        minlength="8"
                        aria-describedby="passwordHelp"
                        autocomplete="new-password"
                        />
                        <button type="button" class="toggle-password" onclick="togglePassword()">🙈</button>
                    </div> <!-- /.password-wrapper-->
                    <div id="passwordHelp" class="password-requirements" aria-live="polite">
                        <p>Password must include:</p>
                        <ul>
                            <li id="length" class="invalid">At least 8 characters</li>
                            <li id="uppercase" class="invalid">At least one uppercase letter</li>
                            <li id="lowercase" class="invalid">At least one lowercase letter</li>
                            <li id="number" class="invalid">At least one number</li>
                            <li id="special" class="invalid">At least one special character</li>
                        </ul>
                    </div> <!-- /.password requirements-->

                    <button type="submit">Sign Up</button>
                </form>
                <p>
                    Already have an account? <a href="/IlRitrovo/public/User/showLoginForm">Login here</a>.
                </p>
            </div> <!-- /.modal-content-->
        </div> <!-- /.modal-->

        <?php echo '<script'; ?>
>
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
        <?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
> //Per mostrare e nascondere la password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = '🐵';  // cambio icona quando la password è visibile
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = '🙈';  // icona occhiolino quando nascosta
            }
        }
        <?php echo '</script'; ?>
>
    </body>
</html><?php }
}
