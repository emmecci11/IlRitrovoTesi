<?php
/* Smarty version 5.5.1, created on 2025-07-08 00:14:26
  from 'file:userProfile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686c46c2b74531_89493028',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e1407615e843fef7a1dc12ad1215fc52044c3253' => 
    array (
      0 => 'userProfile.tpl',
      1 => 1751918213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_686c46c2b74531_89493028 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Profile - Il Ritrovo</title>       
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/user.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reviews.css" rel="stylesheet">
    </head>

    <body style="background-color: #f8f1e8;">

        <!-- Header rendered through the View -->

        <!-- Profile -->
        <div class="panel panel-default">
            <div class="panel-heading">User Profile</div>
            <div class="panel-body">
                <div class="profile-container">
                    <!-- Profile Image -->
                    <div class="profile-image-section">
                        <img src="/IlRitrovo/src/Smarty/assets/images/logo/user.jpg" alt="Test User" class="profile-img current">
                    </div> <!-- /.profile-image-section-->
                    <!-- Metadata Section -->
                    <div class="profile-info-section">
                        <!-- Username -->
                        <div class="username-header">
                            <h3><strong>Username: </strong><?php echo $_smarty_tpl->getValue('username');?>
</h3>
                        </div> <!-- /.username-header-->
                        <!-- Group 1: Username + Email and Password -->
                        <div class="user-info-group">
                            <div class="credentials-row">
                                <div class="credential-item"><strong>Email: </strong><?php echo $_smarty_tpl->getValue('email');?>
</div>
                                <div class="credential-item"><strong>Password: </strong>********</div>
                            </div> <!-- /.credentials-row -->
                            <div class="form-action-right">
                                <a href="/IlRitrovo/public/User/showEditProfileMetadata" class="btn edit">Edit</a>
                            </div> <!-- /.form-action-right -->
                        </div> <!-- /.user-info-group -->
                        <hr class="separator">
                        <!-- Group 2: Personal Data -->
                        <div class="user-info-group">
                            <div class="personal-data-row">
                                <div class="personal-item"><strong>Name:</strong> <?php echo $_smarty_tpl->getValue('name');?>
</div>
                                <div class="personal-item"><strong>Surname:</strong> <?php echo $_smarty_tpl->getValue('surname');?>
</div>
                            </div> <!-- /.personal-data-row -->
                            <div class="personal-data-row">
                                <div class="personal-item"><strong>Birth Date:</strong> <?php echo $_smarty_tpl->getValue('birthdate');?>
</div>
                                <div class="personal-item"><strong>Phone:</strong> <?php echo $_smarty_tpl->getValue('phone');?>
</div>
                            </div> <!-- /.personal-data-row -->
                            <div class="form-action-right">
                                <a href="/IlRitrovo/public/User/showEditProfileData" class="btn edit">Edit</a>
                            </div> <!-- /.form-action-right -->
                        </div> <!-- /.user-info-group -->
                    </div> <!-- /.profile-info-section-->
                </div> <!-- /.profile-container -->
            </div> <!-- /.panel-body -->
        </div> <!-- /.panel panel-default -->

        <!-- Cards -->
        <div class="panel">
            <div class="panel-heading">My Credit Cards</div>
            <div class="card-row">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('cards'), 'card');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('card')->value) {
$foreach0DoElse = false;
?>
                    <?php $_smarty_tpl->assign('cardClass', $_smarty_tpl->getSmarty()->getModifierCallback('regex_replace')(mb_strtolower((string) $_smarty_tpl->getValue('card')->getType(), 'UTF-8'),'/[^a-z]/',''), false, NULL);?>
                    <div class="credit-card">
                        <div class="card-header <?php echo $_smarty_tpl->getValue('cardClass');?>
"><?php echo $_smarty_tpl->getValue('card')->getType();?>
</div>
                        <div class="card-body">
                            <ul>
                                <li><strong>Number:</strong> **** **** **** <?php echo substr((string) $_smarty_tpl->getValue('card')->getNumber(), (int) -4);?>
</li>
                                <li><strong>Holder:</strong> <?php echo $_smarty_tpl->getValue('card')->getHolder();?>
</li>
                                <li><strong>Expiration:</strong> <?php echo $_smarty_tpl->getValue('card')->getExpiration();?>
</li>
                            </ul>
                            <div class="form-action-right">
                                <a href="/IlRitrovo/public/CreditCard/deleteCreditCard/<?php echo $_smarty_tpl->getValue('card')->getIdCreditCard();?>
" class="btn delete"> Delete </a>
                            </div>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                <!-- Add card button linking to separate page -->
                <div class="credit-card add-card-btn" title="Aggiungi nuova carta">
                    <a href="/IlRitrovo/public/CreditCard/showAddCreditCardUserProfile" class="card-header"
                    style="text-align:center; font-size:2.5rem; cursor:pointer; user-select:none; color:#ff9f43;">+ </a>
                </div> <!-- /.credit-card add-card-btn-->
            </div> <!-- /.card-row-->
        </div> <!-- /.panel-->

        <!-- FUTURE Reservations-->
        <div class="panel">
            <div class="panel-heading">My Future Reservations</div>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('futureReservations'), 'reservation');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('reservation')->value) {
$foreach1DoElse = false;
?>
                <div class="reservation-card">
                    <ul>
                        <li><strong>Type:</strong>
                            <?php if ($_smarty_tpl->getValue('reservation')->getIdRoom() !== null) {?>
                                Room
                            <?php } elseif ($_smarty_tpl->getValue('reservation')->getIdTable() !== null) {?>
                                Table
                            <?php } else { ?>
                                Unknown
                            <?php }?>
                        </li>
                        <li><strong>Guests:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getPeople();?>
</li>
                        <li><strong>Reservation Date:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getReservationDate();?>
</li>
                        <li><strong>Time Frame:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getReservationTimeFrame();?>
</li>
                        <li><strong>Status:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getState();?>
</li>
                        <li><strong>Notes:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getComment();?>
</li>
                        <li><strong>Extras:</strong>
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
                                No
                            <?php }?>
                        </li>
                        <li><strong>Total Amount:</strong> €<?php echo $_smarty_tpl->getValue('reservation')->getTotPrice();?>
</li>
                    </ul>
                </div> <!-- /.reservation-card-->
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div> <!-- /.panel-->

        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('pastReservations')) > 0) {?>
            <!-- PAST Reservations-->
            <div class="panel">
                <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                    <span>My Past Reservations</span>
                </div> <!-- /.panel-heading-->
                <div class="panel" style="background-color: #f8f1e8;">
                    <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>My Review</span>
                    </div> <!-- /.panel-heading-->
                    <?php if ($_smarty_tpl->getValue('review') === null) {?>
                        <div class="review-form">
                            <form action="/IlRitrovo/public/Review/checkAddReview" method="post">
                                <label for="stars">Rating:</label>
                                <div class="rating-stars">
                                    <?php
$_smarty_tpl->assign('i', null);$_smarty_tpl->tpl_vars['i']->step = -1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 1+1 - (5) : 5-(1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 5, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                                        <input type="radio" name="stars" id="star<?php echo $_smarty_tpl->getValue('i');?>
" value="<?php echo $_smarty_tpl->getValue('i');?>
" required>
                                        <label for="star<?php echo $_smarty_tpl->getValue('i');?>
">★</label>
                                    <?php }
}
?>
                                </div> <!-- /.rating-stars-->
                                <label for="body">Your Review:</label>
                                <textarea name="body" rows="4" required><?php echo (($tmp = $_smarty_tpl->getValue('body') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
                                <div class="form-action-right">
                                    <button type="submit" class="btn save">Submit</button>
                                </div> <!-- /.form-action-right-->
                            </form>
                        </div> <!-- /.review-form-->
                    <?php } else { ?>
                        <div class="review-form">
                            <div class="existing-review">
                                <p><strong>Rating:</strong> <?php echo $_smarty_tpl->getValue('review')->getStars();?>
 / 5</p>
                                <p><strong>Review:</strong> <?php echo $_smarty_tpl->getValue('review')->getBody();?>
</p>
                                <div class="form-action-right">
                                    <a href="/IlRitrovo/public/Review/deleteReview/<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
" class="btn delete">Delete</a>
                                </div> <!-- /.form-action-right-->
                            </div> <!-- /.esisting-review-->
                            <?php if ($_smarty_tpl->getValue('review')->getReply() !== null) {?>
                                <div class="admin-reply" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #c7b299;">
                                    <p><strong>Reply from the restaurant:</strong></p>
                                    <p><?php echo $_smarty_tpl->getValue('review')->getReply()->getBody();?>
</p>
                                </div> <!-- /.admin-reply-->
                            <?php }?>
                        </div> <!-- /.review-form-->
                    <?php }?>
                </div> <!-- /.panel-->
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('pastReservations'), 'reservation');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('reservation')->value) {
$foreach3DoElse = false;
?>
                    <div class="reservation-card">
                        <ul>
                            <li><strong>Type:</strong>
                                <?php if ($_smarty_tpl->getValue('reservation')->getIdRoom() !== null) {?>
                                    Room
                                <?php } elseif ($_smarty_tpl->getValue('reservation')->getIdTable() !== null) {?>
                                    Table
                                <?php } else { ?>
                                    Unknown
                                <?php }?>
                            </li>
                            <li><strong>Guests:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getPeople();?>
</li>
                            <li><strong>Reservation Date:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getReservationDate();?>
</li>
                            <li><strong>Time Frame:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getReservationTimeFrame();?>
</li>
                            <li><strong>Status:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getState();?>
</li>
                            <li><strong>Notes:</strong> <?php echo $_smarty_tpl->getValue('reservation')->getComment();?>
</li>
                            <li><strong>Extras:</strong>
                                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('reservation')->getExtras()) > 0) {?>
                                    <ul class="extras-list">
                                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reservation')->getExtras(), 'extra');
$foreach4DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('extra')->value) {
$foreach4DoElse = false;
?>
                                            <li><?php echo $_smarty_tpl->getValue('extra')->getNameExtra();?>
 - €<?php echo $_smarty_tpl->getValue('extra')->getPriceExtra();?>
</li>
                                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                    </ul>
                                <?php } else { ?>
                                    No
                                <?php }?>
                            </li>
                            <li><strong>Total Amount:</strong> €<?php echo $_smarty_tpl->getValue('reservation')->getTotPrice();?>
</li>
                        </ul>
                    </div> <!-- /.reservation-card-->
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div> <!-- /.panel-->
        <?php }?>

        <!-- Footer-->
        <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </body>
</html><?php }
}
