<?php
/* Smarty version 5.5.1, created on 2025-06-26 16:48:08
  from 'file:adminUsers.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685d5da8510c43_85948512',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb31bb8222616f26d47c09f9a4cd69d3c1313607' => 
    array (
      0 => 'adminUsers.tpl',
      1 => 1750949282,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerAdmin.tpl' => 1,
  ),
))) {
function content_685d5da8510c43_85948512 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">       
        <title>Users - Il Ritrovo</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/admin.css" rel="stylesheet">
    </head>
    <body>
        
        <!-- Header incluso tramite View-->

        <!--Utenti bloccati-->
        <div class="panel panel-default">
            <div class="panel-heading">Blocked Users</div>
            <div class="panel-body">
                <!-- Container principale per i profili bannati -->
                <div id="bannedProfileContainer" class="banned-profile-container">
                    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('blocked_user')) > 0) {?>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('blocked_user'), 'user');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('user')->value) {
$foreach0DoElse = false;
?>
                            <div class="profile-card" id="banned-profile-<?php echo $_smarty_tpl->getValue('user')->getIdUser();?>
">
                                <h3 class="username"><?php echo $_smarty_tpl->getValue('user')->getUsername();?>
</h3>
                                <p class="name"><strong>Name: </strong><?php echo $_smarty_tpl->getValue('user')->getName();?>
</p>
                                <p class="surname"><strong>Surname: </strong> <?php echo $_smarty_tpl->getValue('user')->getSurname();?>
</p>
                                <p class="email"><strong>Email: </strong> <?php echo $_smarty_tpl->getValue('user')->getEmail();?>
</p>
                                <p class="birthDate"><strong>Birth Date: </strong> <?php echo $_smarty_tpl->getValue('user')->getBirthDate();?>
</p>
                                <p class="phone"><strong>Phone: </strong> <?php echo $_smarty_tpl->getValue('user')->getPhone();?>
</p>
                                <div class="action-buttons">
                                        <form action="/IlRitrovo/public/User/unbanUser/<?php echo $_smarty_tpl->getValue('user')->getIdUser();?>
" method="post">
                                            <input type="hidden" name="userId" value="<?php echo $_smarty_tpl->getValue('user')->getIdUser();?>
">
                                            <button type="submit" name="action" title="Unban this user" value="unban" class="unban-user">Unban</button>
                                        </form>
                                </div> <!--/.buttons-->
                            </div> <!--/.profile-card-->
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <?php } else { ?>
                        <p>There aren't blocked users. </p>
                    <?php }?>
                </div> <!--/.profile-container-->
            </div> <!--/.panel-body-->
        </div> <!--/.panel-default-->

        <!--Utenti -->
        <div class="panel panel-default">
            <div class="panel-heading">Users</div>
            <div class="panel-body">
                <!-- Container principale per i profili -->
                <div id="profileContainer" class="profile-container">
                    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('allUsers')) > 0) {?>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allUsers'), 'user');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('user')->value) {
$foreach1DoElse = false;
?>
                            <div class="profile-card" id="profile-<?php echo $_smarty_tpl->getValue('user')->getIdUser();?>
">
                                <h3 class="username"><?php echo $_smarty_tpl->getValue('user')->getUsername();?>
</h3>
                                <p class="name"><strong>Name: </strong><?php echo $_smarty_tpl->getValue('user')->getName();?>
</p>
                                <p class="surname"><strong>Surname: </strong> <?php echo $_smarty_tpl->getValue('user')->getSurname();?>
</p>
                                <p class="email"><strong>Email: </strong> <?php echo $_smarty_tpl->getValue('user')->getEmail();?>
</p>
                                <p class="birthDate"><strong>Birth Date: </strong> <?php echo $_smarty_tpl->getValue('user')->getBirthDate();?>
</p>
                                <p class="phone"><strong>Phone: </strong> <?php echo $_smarty_tpl->getValue('user')->getPhone();?>
</p>
                                <div class="action-buttons">
                                    <form action="/IlRitrovo/public/User/banUser/<?php echo $_smarty_tpl->getValue('user')->getIdUser();?>
" method="post">
                                        <input type="hidden" name="userId" value="<?php echo $_smarty_tpl->getValue('user')->getIdUser();?>
">
                                        <button type="submit" name="action" title="Ban this user" value="ban" class="ban-user">Ban</button>
                                    </form>
                                </div> <!--/.buttons-->
                            </div> <!--/.profile-card-->
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <?php } else { ?>
                        <p>There aren't users available. </p>
                    <?php }?>
                </div> <!--/.profile-container-->
            </div> <!--/.panel-body-->
        </div> <!--/.panel-default-->

        <!-- Footer -->
        <?php $_smarty_tpl->renderSubTemplate('file:footerAdmin.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </body>
</html><?php }
}
