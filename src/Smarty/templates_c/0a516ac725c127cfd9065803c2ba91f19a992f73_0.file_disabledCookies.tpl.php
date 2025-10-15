<?php
/* Smarty version 5.5.1, created on 2025-06-29 19:39:18
  from 'file:disabledCookies.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68617a460dd108_84683671',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a516ac725c127cfd9065803c2ba91f19a992f73' => 
    array (
      0 => 'disabledCookies.tpl',
      1 => 1751218638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68617a460dd108_84683671 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookies Disabled</title>
    <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
    <style>
        /* Class for highlighted text like buttons */
        .highlighted-text {
            font-weight: bold;
            color: #8b3a3a; /* same color as buttons */
        }
    </style>
</head>
<body>
    <main>
        <section>
            <h1 style="color: #8b3a3a;">Cookies Are Disabled 🍪</h1>
            <p><strong style="color: #8b3a3a;">To use this website, you must enable cookies in your browser.</strong></p>
            <p>If cookies are disabled, <strong style="color: #8b3a3a;">you will not be able to login, sign up, or access essential features of the application.</strong></p>

            <h3>How to enable cookies in major browsers:</h3>
            <ul>
                <li><strong>Chrome:</strong> Settings → Privacy and security → Cookies and other site data → Allow all cookies.</li>
                <li><strong>Firefox:</strong> Settings → Privacy & Security → Cookies and Site Data → Allow all cookies.</li>
                <li><strong>Safari:</strong> Preferences → Privacy → Advanced Settings → Uncheck “Block all cookies.”</li>
                <li><strong>Edge:</strong> Settings → Cookies and site permissions → Manage and delete cookies → Enable cookies.</li>
            </ul>

            <p>After enabling cookies, you can log in or sign up simply using the buttons at the top, without needing to reload the page.</p>
        </section>
    </main>
</body>
</html><?php }
}
