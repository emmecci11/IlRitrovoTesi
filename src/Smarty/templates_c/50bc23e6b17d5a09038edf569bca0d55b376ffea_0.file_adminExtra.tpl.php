<?php
/* Smarty version 5.5.1, created on 2025-06-26 18:21:18
  from 'file:adminExtra.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685d737e035421_31253007',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50bc23e6b17d5a09038edf569bca0d55b376ffea' => 
    array (
      0 => 'adminExtra.tpl',
      1 => 1750954853,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerAdmin.tpl' => 1,
  ),
))) {
function content_685d737e035421_31253007 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">       
        <title>Extras - Il Ritrovo</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/extra.css" rel="stylesheet">
    </head>
    <body>

        <!-- Header incluso tramite View-->

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Extras</h3>
            </div> <!--/.panel-heading-->
            <div class="panel-body">
                <!-- Lista degli extra esistenti -->
                <div class="extra-list">
                    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('allExtras')) > 0) {?>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allExtras'), 'extra');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('extra')->value) {
$foreach0DoElse = false;
?>
                        <div class="extra-item">
                            <div class="extra-info">
                                <strong>Name:</strong> <span><?php echo $_smarty_tpl->getValue('extra')->getNameExtra();?>
</span>
                                <strong>Price:</strong> <span><?php echo $_smarty_tpl->getValue('extra')->getPriceExtra();?>
 €</span>

                                <div class="extra-actions">
                                    <a href="/IlRitrovo/public/Extra/showEditExtra/<?php echo $_smarty_tpl->getValue('extra')->getIdExtra();?>
" class="edit-btn-circle">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <form method="POST" action="/IlRitrovo/public/Extra/deleteExtra/<?php echo $_smarty_tpl->getValue('extra')->getIdExtra();?>
">
                                        <button class="delete-btn"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <?php } else { ?>
                        <p>No extras available at the moment.</p>
                    <?php }?>
                </div> <!--/.extra-list-->
                <!-- Form per aggiungere un nuovo extra -->
                <div class="extra-form-container" <?php if ($_smarty_tpl->getValue('show_extra_form')) {?>style="display: block;"<?php } else { ?>style="display: none;"<?php }?>>
                    <form action="/IlRitrovo/public/Extra/addExtra" method="POST" id="add-extra-form">
                        <label for="name">Extra Name:</label>
                        <input type="text" id="name" name="name" required><br><br>
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" step="0.01" required><br><br>
                        <button type="submit">Add Extra</button>                  
                    </form>
                </div>
            </div> <!--/.panel-body-->
        </div> <!--/.panel-default-->

        <!-- Footer -->
        <?php $_smarty_tpl->renderSubTemplate('file:footerAdmin.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </body>
</html><?php }
}
