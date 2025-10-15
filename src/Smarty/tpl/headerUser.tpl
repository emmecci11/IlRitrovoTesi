<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/IlRitrovo/src/Smarty/css/header.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Playfair+Display&display=swap" rel="stylesheet" />
  </head>
  <body>
    <header>
      <div class="header-top">
        <!-- Logo e nome del sito -->
        <div class="logo-area">
          <img src="/IlRitrovo/src/Smarty/assets/images/logo/logo.png" alt="Il Ritrovo Logo" class="logo" />
          <span class="site-name">Il Ritrovo</span>
        </div> <!-- /.logo-area-->

        <!-- Barra di navigazione -->
        <nav class="main-nav">
          <ul>
            <li><a href="/IlRitrovo/public/User/showHomePage">Home</a></li>
            <li><a href="/IlRitrovo/public/User/showRoomsPage">Rooms</a></li>
            <li><a href="/IlRitrovo/public/User/showMenuPage">Menu</a></li>
            <li><a href="/IlRitrovo/public/Review/showReviewsPage">Reviews</a></li>
          </ul>
        </nav>

        <!-- Pulsanti utente -->
        <div class="user-area">
          {if $isLogged}
            <a href="/IlRitrovo/public/User/showProfile" class="user-button">Profile</a>
            <a href="/IlRitrovo/public/User/logout" class="user-button" id="logout-button">Logout</a>
          {else}
            <a href="/IlRitrovo/public/User/showLoginForm" class="user-button">Login</a>
            <a href="/IlRitrovo/public/User/showSignUpForm" class="user-button">Sign up</a>
          {/if}
        </div> <!-- /.user-area-->
      </div> <!-- /.header-top-->

      <!-- Popup logout -->
      <div id="logout-popup" style="display:none; position:fixed; top:20px; right:20px; background-color:#8b3a3a; color:white; padding:15px 25px; border-radius:8px; box-shadow:0 4px 8px rgba(0,0,0,0.2); font-family:Arial,sans-serif; font-size:16px; z-index:9999; opacity:0; transition:opacity 0.5s ease;">
      </div> <!-- /.logout-popup-->

      <script>
        (function() {
          document.addEventListener('DOMContentLoaded', () => {

            const logoutBtn = document.getElementById('logout-button');
            const popup = document.getElementById('logout-popup');

            if (!logoutBtn || !popup) return;

            logoutBtn.addEventListener('click', function(e) {
              e.preventDefault();

              popup.textContent = 'Operation completed successfully!';
              popup.style.display = 'block';

              requestAnimationFrame(() => {
                popup.style.opacity = '1'; // Appare con effetto fade-in
              });

              setTimeout(() => {
                popup.style.opacity = '0'; // Inizia a scomparire

                setTimeout(() => {
                  popup.style.display = 'none';

                  window.location.href = logoutBtn.href;
                }, 500); // Attende la fine della transizione
              }, 2000); // Attende 2 secondi prima di iniziare il fade-out
            });
          });
        })();
      </script>
    </header>
  </body>
</html>