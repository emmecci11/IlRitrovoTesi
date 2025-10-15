<?php
/* Smarty version 5.5.1, created on 2025-07-08 00:22:15
  from 'file:emailRooms.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686c4897ec4002_56745458',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '27e7f9df76403af2dd13d82f1c50453bda2cfb0a' => 
    array (
      0 => 'emailRooms.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686c4897ec4002_56745458 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8" />
    <title>Room Reservation Confirmation - Il Ritrovo</title>
    <style>
      body {
        margin: 0;
        font-family: 'Open Sans', sans-serif;
        background-color: #fdfaf5;
        color: #4a3b2c;
        line-height: 1.6;
        padding: 2rem 1rem;
      }
      h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        margin-bottom: 1rem;
        border-bottom: 2px dashed #c7b299;
        padding-bottom: 0.5rem;
      }
      ul {
        list-style-type: none;
        padding-left: 0;
      }
      li {
        margin-bottom: 0.8rem;
      }
      p {
        font-size: 1.05rem;
        margin-bottom: 1rem;
        color: #4a3b2c;
        max-width: 65ch;
        line-height: 1.6;
      }
    </style>
  </head>
  <body>
    <main>
      <h2>Great News! Your Room is Booked</h2>
      <p>Thank you for booking with <strong>Il Ritrovo</strong>!</p>
      <ul>
        <li><strong>Date:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('data')['Date'], ENT_QUOTES, 'UTF-8', true);?>
</li>
        <li><strong>Time Frame:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('data')['TimeFrame'], ENT_QUOTES, 'UTF-8', true);?>
</li>
        <li><strong>People:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('data')['People'], ENT_QUOTES, 'UTF-8', true);?>
</li>
        <li><strong>Your Room:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('data')['SelectedRoom'], ENT_QUOTES, 'UTF-8', true);?>
</li>
        <?php if ($_smarty_tpl->getValue('data')['Comment'] != '') {?>
          <li><strong>Commento:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('data')['Comment'], ENT_QUOTES, 'UTF-8', true);?>
</li>
        <?php }?>
      </ul>
      <p>If you need to cancel your reservation, please contact us by phone or reply to this email at your earliest convenience.</p>
      <p>We look forward to welcoming you soon!🎉</p>
    </main>
  </body>
</html><?php }
}
