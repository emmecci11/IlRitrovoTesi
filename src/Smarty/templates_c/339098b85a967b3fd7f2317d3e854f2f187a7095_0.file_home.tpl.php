<?php
/* Smarty version 5.5.1, created on 2025-06-23 23:49:29
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6859cbe92dfb46_89989886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '339098b85a967b3fd7f2317d3e854f2f187a7095' => 
    array (
      0 => 'home.tpl',
      1 => 1750715365,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_6859cbe92dfb46_89989886 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/marco/public_html/Progetto/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">     
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Il Ritrovo – Home</title>  
      <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
      <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/home.css" rel="stylesheet">
  </head>
  <body>
    

    <!-- Booking Section -->
    <section class="booking">
      <div class="booking-content">
          <h1><span class="highlight">Where flavours meet</span></h1>
          <br><p><strong>Have an unforgettable experience with your family.</strong></p>
          <p><strong>Enjoy our carefully crafted dishes made from the freshest local ingredients.</strong></p>
          <p><strong>Relax in a warm and inviting atmosphere, perfect for any occasion.</strong></p>
          <div class="booking-buttons">
            <a href="CFrontController.php?controller=CReservation&task=showTableForm" class="btn">Book Table</a>
            <a href="CFrontController.php?controller=CReservation&task=showRoomForm" class="btn">Book Room</a>
          </div> <!-- /.booking-buttons-->
      </div> <!-- /.booking-content-->
      <div class="rhombus-wrapper">
          <div class="rhombus small rhombus-1"><img src="../assets/images/menu/chocolate_cake.jpg" alt="Chocolate cake"></div>
          <div class="rhombus small rhombus-2"><img src="../assets/images/home/interior.jpg" alt="Interior"></div>
          <div class="rhombus large rhombus-3"><img src="../assets/images/home/location.jpg" alt="Exterior"></div>
          <div class="rhombus small rhombus-4"><img src="../assets/images/home/bar.jpg" alt="Bar"></div>
          <div class="rhombus small rhombus-5"><img src="../assets/images/menu/mixed_bruschetta.jpg" alt="Mixed bruschetta"></div>
      </div> <!-- /.rhombus-wrapper-->
    </section>

    <!-- Rooms Section -->
    <section class="event-section rooms-section">
      <div class="content-wrapper">
        <!-- IMAGE ON THE LEFT -->
        <div class="image-column">
          <img src="../assets/images/home/event.jpg" alt="Rustic and elegant event room" class="framed-image">
        </div> <!-- /.image-column-->
        <!-- TEXT ON THE RIGHT -->
        <div class="content-column">
          <button class="tag-btn">OUR ROOMS</button>
          <h1>Spaces that make your <strong>Moments Special</strong></h1>
          <p>
            Whether you're celebrating a wedding, a birthday, or hosting a business dinner, our rustic and elegant rooms offer the perfect atmosphere for every special event. Step into the warmth of Il Ritrovo.
          </p>
          <ul class="features">
            <li><strong>🎉 Private rooms for any kind of event</strong></li>
            <li><strong>🌿 Rustic charm and modern comfort</strong></li>
            <li><strong>🍷 Custom menus and wine selection</strong></li>
            <li><strong>🎶 Live music and personalized decorations</strong></li>
          </ul>
          <div class="booking-buttons">
            <a href="CFrontController.php?controller=CFrontController&task=showRooms" class="btn">Discover our rooms →</a>
          </div> <!-- /.booking-buttons-->
        </div> <!-- /.content-column-->
      </div> <!-- /.content-wrapper-->
    </section>

    <!-- Menu Section-->
    <section class="menu-section rooms-section">
      <div class="content-column">
        <button class="tag-btn">OUR MENU</button>
        <h1>Authentic Flavors <strong>Served with Heart</strong></h1>
        <p>
          From rustic starters to refined main courses, our menu celebrates seasonal ingredients and traditional flavors with a touch of creativity. Ideal for business dinners, family events, or just a cozy evening.
        </p>
        <ul class="features">
          <li><strong>✓ Handpicked local produce</strong></li>
          <li><strong>✓ Vegetarian & vegan options</strong></li>
          <li><strong>✓ Curated wine pairings</strong></li>
          <li><strong>✓ Seasonal tasting menu</strong></li>
        </ul>
        <a href="CFrontController.php?controller=CFrontController&task=showMenu" class="btn">Explore the menu →</a>
      </div> <!-- /.content-column-->
      <div class="image-column">
        <img src="../assets/images/home/menu.jpg" alt="Menu preview" class="framed-image">
      </div> <!-- /.image-column-->
    </section>

    <!-- Footer-->
    <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
  </body>
</html><?php }
}
