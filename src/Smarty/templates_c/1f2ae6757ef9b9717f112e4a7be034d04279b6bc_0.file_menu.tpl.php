<?php
/* Smarty version 5.5.1, created on 2025-07-08 00:30:38
  from 'file:menu.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686c4a8edb3773_83526971',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f2ae6757ef9b9717f112e4a7be034d04279b6bc' => 
    array (
      0 => 'menu.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_686c4a8edb3773_83526971 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu - Il Ritrovo</title>
    <link rel="stylesheet" href="/IlRitrovo/src/Smarty/css/styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Open+Sans&display=swap" rel="stylesheet">
    <style>
      .menu-image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 10px;
        vertical-align: middle;
      }
      li {
        display: flex;
        align-items: center;
        margin-bottom: 0.8rem;
      }
      li strong {
        flex-grow: 1;
      }
      .price {
        margin-left: auto;
        font-weight: bold;
        color: #8b3a3a;
      }
    </style>
  </head>

  <body>

    <!-- Header rendered through the View -->

    <main>
      <section>
        <h2>Appetizers </h2>
        <ul>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/platter.jpg" alt="Ritrovo Platter" class="menu-image" />
            <strong>Ritrovo Platter</strong> Cured meats, cheeses, and jams <span class="price"> €10</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/mixed_bruschetta.jpg" alt="Mixed Bruschetta" class="menu-image" />
            <strong>Mixed Bruschetta</strong> Made with local products <span class="price"> €6</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/grandmas_meatballs.jpg" alt="Grandma’s Meatballs" class="menu-image" />
            <strong>Grandma’s Meatballs</strong> In tomato sauce or baked <span class="price"> €8</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/zucchini_flan.jpg" alt="Zucchini flan" class="menu-image" />
            <strong>Zucchini flan</strong> With melted parmesan <span class="price"> €7</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/battered_zucchini_flowers.jpg" alt="Battered Zucchini Flowers" class="menu-image" />
            <strong>Battered Zucchini Flowers</strong> <span class="price"> €7</span>
          </li>
        </ul>
      </section>

      <section>
        <h2>Main Courses </h2>
        <ul>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/tagliatelle_with_ragu.jpg" alt="Tagliatelle with Ragù" class="menu-image" />
            <strong>Tagliatelle with Ragù</strong> Fresh pasta <span class="price"> €12</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/gnocchi_with_arugula_pesto.jpg" alt="Gnocchi with Arugula Pesto" class="menu-image" />
            <strong>Gnocchi with Arugula Pesto</strong> <span class="price"> €11</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/vegetarian_lasagna.jpg" alt="Vegetarian Lasagna" class="menu-image" />
            <strong>Vegetarian Lasagna</strong> <span class="price"> €10</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/porcini_mushroom_risotto.jpg" alt="Porcini Mushroom Risotto" class="menu-image" />
            <strong>Porcini Mushroom Risotto</strong> <span class="price"> €13</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/legumes_and_cereal_soup.jpg" alt="Legumes and Cereal Soup" class="menu-image" />
            <strong>Legumes and Cereal Soup</strong> <span class="price"> €9</span>
          </li>
        </ul>
      </section>

      <section>
        <h2>Second Courses </h2>
        <ul>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/beef_tagliata.jpg" alt="Beef Tagliata" class="menu-image" />
            <strong>Beef Tagliata</strong> With arugula and parmesan <span class="price"> €18</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/hunter_style_chicken.jpg" alt="Hunter-style Chicken" class="menu-image" />
            <strong>Hunter-style Chicken</strong> <span class="price"> €14</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/eggplant_parmesan.jpg" alt="Eggplant Parmesan" class="menu-image" />
            <strong>Eggplant Parmesan</strong> <span class="price"> €12</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/grilled_seitan.jpg" alt="Grilled Seitan" class="menu-image" />
            <strong>Grilled Seitan</strong> Vegan option <span class="price"> €13</span>
          </li>
        </ul>
      </section>

      <section>
      <h2>Sides </h2>
      <ul>
          <li>
          <img src="/IlRitrovo/src/Smarty/assets/images/menu/grilled_vegetables.jpg" alt="Grilled Vegetables" class="menu-image" />
          <strong>Grilled Vegetables</strong> <span class="price"> €5</span>
          </li>
          <li>
          <img src="/IlRitrovo/src/Smarty/assets/images/menu/rustic_oven_roasted_potatoes.jpg" alt="Rustic Oven-Roasted Potatoes" class="menu-image" />
          <strong>Rustic Oven-Roasted Potatoes</strong> <span class="price"> €4</span>
          </li>
          <li>
          <img src="/IlRitrovo/src/Smarty/assets/images/menu/farmer's_salad.jpg" alt="Farmer’s Salad" class="menu-image" />
          <strong>Farmer’s Salad</strong> <span class="price"> €4</span>
          </li>
          <li>
          <img src="/IlRitrovo/src/Smarty/assets/images/menu/sauteed_spinach.jpg" alt="Sautéed Spinach" class="menu-image" />
          <strong>Sautéed Spinach</strong> <span class="price"> €5</span>
          </li>
      </ul>
      </section>

      <section>
        <h2>House Desserts </h2>
        <ul>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/il_ritrovo_tiramisu.jpg" alt="Il Ritrovo Tiramisu" class="menu-image" />
            <strong>Il Ritrovo Tiramisu</strong> <span class="price"> €6</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/chocolate_cake.jpg" alt="Chocolate Cake" class="menu-image" />
            <strong>Chocolate Cake</strong> <span class="price"> €6</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/berry_panna_cotta.jpg" alt="Berry Panna Cotta" class="menu-image" />
            <strong>Berry Panna Cotta</strong> <span class="price"> €5</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/apricot_tart.jpg" alt="Apricot Tart" class="menu-image" />
            <strong>Apricot Tart</strong> <span class="price"> €5</span>
          </li>
          <li>
            <img src="/IlRitrovo/src/Smarty/assets/images/menu/artisanal_ice_cream.jpg" alt="Artisanal Ice Cream" class="menu-image" />
            <strong>Artisanal Ice Cream</strong> Vanilla, chocolate, pistachio <span class="price"> €4</span>
          </li>
        </ul>
      </section>

      <section class="fixed-menu">
        <h2>Fixed Menu 🍽️</h2>
        <p>Ideal for events, private parties, or large groups.</p>
        <ul>
          <li><strong>Appetizer:</strong> Ritrovo Platter</li>
          <li><strong>Main Course:</strong> Tagliatelle with Ragù</li>
          <li><strong>Second Course:</strong> Hunter-style Chicken with side dish</li>
          <li><strong>Dessert:</strong> Il Ritrovo Tiramisu</li>
          <li><strong>Drink:</strong> 1/2 water, 1 glass of wine</li>
        </ul>
        <p class="fixed-price">Price per person: <strong>€50</strong></p>
      </section>

      <section class="wines">
        <h2>Wines & Drinks </h2>
        <p>Discover our <a href="/IlRitrovo/src/Smarty/assets/pdf/Il_Ritrovo_Wine_List.pdf" download>Wine List</a> featuring a curated selection of local and national labels.</p>
      </section>
    </main>

    <!-- Footer -->
    <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
  </body>
</html><?php }
}
