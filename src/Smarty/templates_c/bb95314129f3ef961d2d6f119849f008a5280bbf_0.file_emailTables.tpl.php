<?php
/* Smarty version 5.5.1, created on 2025-07-14 20:28:37
  from 'file:emailTables.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68754c550601a5_86635969',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb95314129f3ef961d2d6f119849f008a5280bbf' => 
    array (
      0 => 'emailTables.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68754c550601a5_86635969 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8" />
    <title>Table Reservation Confirmation - Il Ritrovo</title>
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
      <h2>Great News! Your Table is Booked</h2>
      <p>Thank you for booking with <strong>Il Ritrovo</strong>!</p>
      <ul>
        <li><strong>Date:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('data')['Date'], ENT_QUOTES, 'UTF-8', true);?>
</li>
        <li><strong>Time Frame:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('data')['TimeFrame'], ENT_QUOTES, 'UTF-8', true);?>
</li>
        <li><strong>People:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('data')['People'], ENT_QUOTES, 'UTF-8', true);?>
</li>
        <li><strong>Your Table:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('data')['SelectedTable'], ENT_QUOTES, 'UTF-8', true);?>
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
