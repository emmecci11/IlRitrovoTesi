<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fattura</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        .invoice-details {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .invoice-details th,
        .invoice-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color: #343a40;
        }
        .invoice-details th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
    </style>
</head>
<body>

<h1>Fattura</h1>

<table class="invoice-details">
    <tr>
        <th>Prezzo Totale:</th>
        <td>€ {$totPrice}</td>
    </tr>
</table>

<div class="footer">
    <p>Questo è una fattura generata automaticamente.</p>
    <p>Per ulteriori informazioni contattare il cliente.</p>
</div>

</body>
</html>