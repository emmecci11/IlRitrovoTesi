<?php
/* Smarty version 5.5.1, created on 2025-06-25 17:45:39
  from 'file:adminReview.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685c19a393f344_34677230',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65c02e223202556f7b1740dabc665cce47278106' => 
    array (
      0 => 'adminReview.tpl',
      1 => 1750841504,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:footerAdmin.tpl' => 1,
  ),
))) {
function content_685c19a393f344_34677230 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">       
        <title>Reviews - Il Ritrovo</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reviews.css" rel="stylesheet">
    </head>
    <body>
        <div class="page-container">

            <!-- Header incluso tramite View-->

            <!-- Immagine di intestazione -->
            <section class="review-image">
            <img src="/IlRitrovo/src/Smarty/assets/images/home/reviews.jpg" alt="Customer enjoying meal" />
            </section>

            <section>
                <h2>Customer Reviews</h2>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allReviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
                    <div class="review-card">
                        <div class="review-meta">
                            <span><strong><?php echo $_smarty_tpl->getValue('review')->getUsername();?>
</strong> rated <strong><?php echo $_smarty_tpl->getValue('review')->getStars();?>
/5</strong></span>
                            <span class="review-timestamp"><?php echo $_smarty_tpl->getValue('review')->getCreationTime();?>
</span>
                            <p class="review-body"><?php echo $_smarty_tpl->getValue('review')->getBody();?>
</p>
                        </div> <!-- /.review-meta-->
                        <!-- Pulsante elimina recensione -->
                        <form action="/IlRitrovo/public/Review/deleteReview/<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
" method="post">
                            <button type="submit" class="btn delete">Delete Review</button>
                        </form>

                        <?php if ($_smarty_tpl->getValue('review')->getIdReply() === null) {?>
                            <?php if ((true && ($_smarty_tpl->hasVariable('showReplyForm') && null !== ($_smarty_tpl->getValue('showReplyForm') ?? null))) && $_smarty_tpl->getValue('showReplyForm') == $_smarty_tpl->getValue('review')->getIdReview()) {?>
                                <section class="review-box admin-reply-form">
                                    <form action="/IlRitrovo/public/Reply/addReply/<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
" method="post">
                                        <label for="reply-<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
">Write reply:</label>
                                        <textarea id="reply-<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
" name="replyBody" rows="3" required></textarea>
                                        <div class="form-action-right">
                                        <button type="submit" class="btn save">Submit Reply</button>
                                        </div>
                                    </form>
                                </section>
                            <?php } else { ?>
                                <a href="/IlRitrovo/public/Reply/showReplyForm/<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
" class="btn save">Reply</a>
                            <?php }?>
                        <?php } else { ?>
                            <div class="admin-reply">
                                <p><strong>Reply from the restaurant:</strong></p>
                                <p><?php echo $_smarty_tpl->getValue('review')->getReply()->getBody();?>
</p>
                                <form action="/IlRitrovo/public/Review/deleteReply/<?php echo $_smarty_tpl->getValue('review')->getIdReply();?>
" method="post">
                                    <button type="submit" class="btn delete">Delete Reply</button>
                                </form>
                            </div> <!-- /.admin-reply-->
                        <?php }?>
                    </div> <!-- /.review-card-->
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </section>

        </div> <!-- /.page-container -->

        <!-- Footer-->
        <?php $_smarty_tpl->renderSubTemplate('file:footerAdmin.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </body>
</html><?php }
}
