<?php
/* Smarty version 5.5.1, created on 2025-06-27 02:04:48
  from 'file:adminHome.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685de020836a89_37982184',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e0ccdb4be32967a2ff5b087380b47b1b35b664cc' => 
    array (
      0 => 'adminHome.tpl',
      1 => 1750981551,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerAdmin.tpl' => 1,
  ),
))) {
function content_685de020836a89_37982184 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">       
        <title>Home Admin - Il Ritrovo</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
    </head>
    <body>

        <!-- Header incluso tramite View-->

        <!-- Sezione delle prenotazioni dei tavoli-->
        <div class="panel panel-default">
            <div class="panel-heading">Upcoming Tables Reservations</div>
            <div class="panel-body">
                <!-- Container principale per le reservations -->
                <div id="reservationContainer" class="reservation-container">
                    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('comingTableReservations')) > 0) {?>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('comingTableReservations'), 'reservation');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('reservation')->value) {
$foreach0DoElse = false;
?>
                            <!-- Scheda singola della prenotazione -->
                            <div class="reservation-card" id="reservation-<?php echo $_smarty_tpl->getValue('reservation')->getIdReservation();?>
">
                                <div class="reservation-header">
                                    Reservation <?php echo $_smarty_tpl->getValue('reservation')->getIdReservation();?>

                                </div> <!-- /.reservation-header-->
                                <div class="reservation-details">
                                    <div class="reservation-row">
                                        <span><strong>Date:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getReservationDate();?>
</span>
                                        <span><strong>Time Frame:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getReservationTimeFrame();?>
</span>
                                    </div> <!-- /.reservation-row-->
                                    <div class="reservation-row">
                                        <span><strong>Table:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getAreaName();?>
</span>
                                        <span><strong>Guests:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getPeople();?>
 people</span>
                                    </div> <!-- /.reservation-row--> 
                                    <div class="reservation-row">
                                        <span><strong>User:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getUsername();?>
</span>
                                        <span><strong>Comment:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getComment();?>
</span>
                                    </div> <!-- /.reservation-row-->
                                </div> <!-- /.reservation-details-->
                            </div> <!-- /.reservation-card-->
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <?php } else { ?>
                        <p>No upcoming table reservations available.</p>
                    <?php }?>
                </div> <!-- /.reservation-container-->
            </div> <!--/.panel-body-->
        </div> <!-- /.panel panel-default-->

        <!-- Sezione delle prenotazioni delle stanze-->
        <div class="panel panel-default">
            <div class="panel-heading">Upcoming Rooms Reservations</div>
            <div class="panel-body">
                <!-- Container principale per le reservations -->
                <div id="reservationContainer" class="reservation-container">
                    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('comingRoomReservations')) > 0) {?>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('comingRoomReservations'), 'reservation');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('reservation')->value) {
$foreach1DoElse = false;
?>
                            <!-- Scheda singola della prenotazione -->
                            <div class="reservation-card" id="reservation-<?php echo $_smarty_tpl->getValue('reservation')->getIdReservation();?>
">
                                <div class="reservation-header">
                                    Reservation <?php echo $_smarty_tpl->getValue('reservation')->getIdReservation();?>

                                </div> <!-- /.reservation-header-->
                                <div class="reservation-details">
                                    <div class="reservation-row">
                                        <span><strong>Date:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getReservationDate();?>
</span>
                                        <span><strong>Time Frame:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getReservationTimeFrame();?>
</span>
                                    </div> <!-- /.reservation-row-->
                                    <div class="reservation-row">
                                        <span><strong>Room:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getAreaName();?>
</span>
                                        <span><strong>Guests:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getPeople();?>
 people</span>
                                    </div> <!-- /.reservation-row--> 
                                    <div class="reservation-row">
                                        <span><strong>User:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getUsername();?>
</span>
                                        <span><strong>Comment:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getComment();?>
</span>
                                    </div> <!-- /.reservation-row-->
                                    <div class="reservation-row">
                                        <span><strong>Price:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getTotPrice();?>
</span>
                                        <span><strong>Extras</strong>
                                            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('reservation')->getExtras()) > 0) {?>
                                                <ul class="extras-list">
                                                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reservation')->getExtras(), 'extra');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('extra')->value) {
$foreach2DoElse = false;
?>
                                                        <li><?php echo $_smarty_tpl->getValue('extra')->getNameExtra();?>
 - €<?php echo $_smarty_tpl->getValue('extra')->getPriceExtra();?>
</li>
                                                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                                </ul>
                                            <?php } else { ?>
                                                No extra selected
                                            <?php }?>
                                        </span>
                                    </div> <!-- /.reservation-row-->
                                </div> <!-- /.reservation-details-->
                            </div> <!-- /.reservation-card-->
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <?php } else { ?>
                        <p>No upcoming room reservations available.</p>
                    <?php }?>
                </div> <!-- /.reservation-container-->
            </div> <!--/.panel-body-->
        </div> <!-- /.panel panel-default-->

        <!-- Footer-->
        <?php $_smarty_tpl->renderSubTemplate('file:footerAdmin.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </body>
</html><?php }
}
