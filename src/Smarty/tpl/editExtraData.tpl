<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Extra - Il Ritrovo</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/loginSignup.css" rel="stylesheet">
        <style>
            body.edit-background {
                background-image: url('/IlRitrovo/src/Smarty/assets/images/backgrounds/editExtraBackground.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }

            .modal-content {
                width: 90%;
                max-width: 650px;
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
        <div class="modal">

            <!-- Header rendered through the View -->

            <div class="modal-content">
                <h2>Edit Extra</h2>
                <form method="POST" action="/IlRitrovo/public/Extra/saveEditExtra/{$extra->getIdExtra()}">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{$extra->getNameExtra()}" required>
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" value="{$extra->getPriceExtra()}" step="0.01" required>
                    <button type="submit">Save Changes</button>
                    <a href="/IlRitrovo/public/Extra/showExtrasPage" style="text-align: center; display: block; margin-top: 1rem;">Back to Extras</a>
                </form>
            </div> <!--  /.modal-content-->
        </div> <!-- /.modal-->
    </body>
</html>