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
                max-width: 700px;
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
                <h2>Edit Personal Data</h2>
                <form method="post" action="/IlRitrovo/public/User/editProfileData">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{$name}" required />
                    <label for="surname">Surname</label>
                    <input type="text" id="surname" name="surname" value="{$surname}" required />
                    <label for="birthDate">Birth Date</label>
                    <input type="date" id="birthDate" name="birthDate" value="{$birthDate}" required />
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" value="{$phone}" required />
                    <button type="submit">Save Personal Data</button>
                </form>
                <p><a href="/IlRitrovo/public/User/showProfile">Back to Profile</a></p>
            </div> <!-- /.modal-content-->
        </div> <!-- /.modal-->
    </body>
</html>