<?php
/* Smarty version 5.5.1, created on 2025-06-23 14:07:33
  from 'file:adminReview.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68594385d3d868_74921883',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd08afada00e5240eae26017088d94b0058707f3e' => 
    array (
      0 => 'adminReview.tpl',
      1 => 1750609721,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:headerAdmin.tpl' => 1,
    'file:footerAdmin.tpl' => 1,
  ),
))) {
function content_68594385d3d868_74921883 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/marco/public_html/Progetto/IlRitrovo/src/Smarty/tpl';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">       
        <title>Reviews - Il Ritrovo</title>
        <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/~marco/Progetto/IlRitrovo/src/Smarty/css/reviews.css" rel="stylesheet">
    </head>
    <body>
        <div class="page-container">

            <!-- Header -->
            <?php $_smarty_tpl->renderSubTemplate('file:headerAdmin.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

            <!-- Immagine di intestazione -->
            <section class="review-image">
            <img src="../assets/images/home/reviews.jpg" alt="Customer enjoying meal" />
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
                        <form action="CFrontController.php?controller=CReview&task=deleteReview&idReview=<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
" method="post" onsubmit="return confirm('Are you sure you want to delete this review?');">
                            <button type="submit" class="btn delete">Delete Review</button>
                        </form>

                        <?php if ($_smarty_tpl->getValue('review')->getIdReply() === null) {?>
                            <?php if ((true && ($_smarty_tpl->hasVariable('showReplyForm') && null !== ($_smarty_tpl->getValue('showReplyForm') ?? null))) && $_smarty_tpl->getValue('showReplyForm') == $_smarty_tpl->getValue('review')->getIdReview()) {?>
                                <section class="review-box admin-reply-form">
                                    <form action="CFrontController.php?controller=CReply&task=addReply&idReview=<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
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
                                <a href="CFrontController.php?controller=CReply&task=showReplyForm=<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
" class="btn save">Reply</a>
                            <?php }?>
                        <?php } else { ?>
                            <div class="admin-reply">
                                <p><strong>Reply from the restaurant:</strong></p>
                                <p><?php echo $_smarty_tpl->getValue('review')->getReply()->getBody();?>
</p>
                                <form action="CFrontController.php?controller=CReview&task=deleteReply&idReply=<?php echo $_smarty_tpl->getValue('review')->getIdReply();?>
" method="post" onsubmit="return confirm('Are you sure you want to delete this reply?');">
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
