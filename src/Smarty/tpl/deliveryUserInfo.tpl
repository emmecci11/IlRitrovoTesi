<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Consegna - Il Ritrovo</title>       
    <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
    <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
    <style>
        .delivery-info {
            background-color: #fff;
            border-radius: 12px;
            padding: 25px;
            margin: 30px auto;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #8b3a3a;
            margin-bottom: 25px;
        }

        form .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #444;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        .error-message {
            color: #b22222;
            font-weight: bold;
            margin-top: 5px;
            display: none;
        }

        .btn-next {
            display: block;
            margin: 25px auto 0;
            padding: 12px 28px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            background-color: #8b3a3a;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-next:hover {
            background-color: #a54b4b;
        }
    </style>
</head>

<body style="background-color: #f8f1e8;">

    <!-- Header (renderizzato dalla View) -->

    <div class="delivery-info">
        <h2>Informazioni per la Consegna</h2>

        <form id="userInfoForm" action="/IlRitrovo/public/Delivery/showPaymentMethod" method="POST">
            <div class="form-group">
                <label for="phone">Numero di Telefono:</label>
                <input type="tel" id="phone" name="phone" placeholder="Es. 3401234567" required pattern="[0-9]{10}">
                <span class="error-message" id="phoneError"></span>
            </div>

            <div class="form-group">
                <label for="address">Indirizzo:</label>
                <input type="text" id="address" name="address" placeholder="Es. Via Roma" required>
                <span class="error-message" id="addressError"></span>
            </div>

            <div class="form-group">
                <label for="streetNumber">Numero Civico:</label>
                <input type="text" id="streetNumber" name="streetNumber" placeholder="Es. 24" required>
                <span class="error-message" id="streetNumberError"></span>
            </div>

            <div class="form-group">
                <label for="dateTime">Data e Ora di Consegna:</label>
                <input type="datetime-local" id="dateTime" name="dateTime" required>
                <span class="error-message" id="dateTimeError"></span>
            </div>

            <button type="submit" class="btn-next">Riepilogo e Pagamento</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("userInfoForm");
            const fields = [
                { id: "phone", regex: /^\d{10}$/, msg: "Il numero di telefono deve avere 10 cifre." },
                { id: "address", regex: /.+/, msg: "L'indirizzo non può essere vuoto." },
                { id: "streetNumber", regex: /.+/, msg: "Il numero civico non può essere vuoto." },
                { id: "dateTime", regex: /.+/, msg: "Inserisci data e ora di consegna." }
            ];

            form.addEventListener("submit", (e) => {
                let valid = true;
                fields.forEach(f => {
                    const input = document.getElementById(f.id);
                    const error = document.getElementById(f.id + "Error");
                    if (!f.regex.test(input.value.trim())) {
                        error.textContent = f.msg;
                        error.style.display = "block";
                        valid = false;
                    } else {
                        error.style.display = "none";
                    }
                });
                if (!valid) {
                    e.preventDefault();
                    window.scrollTo({ top: 0, behavior: "smooth" });
                }
            });

            // Evita l'inserimento di caratteri non numerici nel telefono
            document.getElementById("phone").addEventListener("input", (e) => {
                e.target.value = e.target.value.replace(/\D/g, "");
            });
        });
    </script>

    {include file='footerUser.tpl'}
</body>
</html>