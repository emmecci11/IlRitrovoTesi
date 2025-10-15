<?php
/* Smarty version 5.5.1, created on 2025-06-22 17:04:31
  from 'file:review.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68581b7f61a6c1_49631235',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c87d30f4456ccaf01f1561698e107ef6bfb3f22' => 
    array (
      0 => 'review.tpl',
      1 => 1750604660,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:headerUser.tpl' => 1,
    'file:footerUser.tpl' => 1,
  ),
))) {
function content_68581b7f61a6c1_49631235 (\Smarty\Template $_smarty_tpl) {
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
      <?php $_smarty_tpl->renderSubTemplate('file:headerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

      <!-- Immagine di intestazione -->
      <section class="review-image">
        <img src="../assets/images/home/reviews.jpg" alt="Customer enjoying meal" />
      </section>

      <!-- Sezione recensione personale -->
      <?php if ((true && ($_smarty_tpl->hasVariable('loggedUser') && null !== ($_smarty_tpl->getValue('loggedUser') ?? null)))) {?>
        <section class="review-box">
          <?php if ($_smarty_tpl->getValue('userReview') === null) {?>
            <h2>Leave your review</h2>
            <form action="CFrontController.php?controller=CReview&task=checkAddReview" method="post">
              <label for="stars">Rating:</label>
                <div class="rating-stars">
                  <?php
$_smarty_tpl->assign('i', null);$_smarty_tpl->tpl_vars['i']->step = -1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 1+1 - (5) : 5-(1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 5, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                    <input type="radio" name="stars" id="star<?php echo $_smarty_tpl->getValue('i');?>
" value="<?php echo $_smarty_tpl->getValue('stars');?>
" required>
                    <label for="star<?php echo $_smarty_tpl->getValue('i');?>
">★</label>
                  <?php }
}
?>
                </div> <!-- /.rating-stars-->
              <label for="body">Your Review:</label>
              <textarea name="body" value="$body" rows="4" required></textarea>
              <div class="form-action-right">
                <button type="submit" class="btn save">Submit</button>
              </div> <!-- /.form-action-right-->
            </form>
          <?php } else { ?>
            <h2>Your Review</h2>
            <div class="existing-review">
              <p><strong>Rating:</strong> <?php echo $_smarty_tpl->getValue('review')->getStars();?>
 / 5</p>
              <p><strong>Review:</strong> <?php echo $_smarty_tpl->getValue('review')->getBody();?>
</p>
              <div class="form-action-right">
                <a href="CFrontController.php?controller=CReview&task=deleteReview&idReview=<?php echo $_smarty_tpl->getValue('review')->getIdReview();?>
" class="btn delete">Delete</a>
              </div> <!-- /.form-action-right-->
            </div> <!-- /.existing-review-->
          <?php }?>
        </section>
      <?php }?>

      <!-- Sezione tutte le recensioni -->
      <section>
        <h2>What our customers say</h2>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allReviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
          <div class="review-card">
            <div class="review-meta">
              <span><strong><?php echo $_smarty_tpl->getValue('review')->getUsername();?>
</strong> rated 
                <strong><?php echo $_smarty_tpl->getValue('review')->getStars();?>
/5</strong>
              </span>
              <span class="review-timestamp"><?php echo $_smarty_tpl->getValue('review')->getCreationTime();?>
</span>
            </div> <!-- /.review-meta-->
            <p class="review-body"><?php echo $_smarty_tpl->getValue('review')->getBody();?>
</p>
            <?php if ($_smarty_tpl->getValue('review')->getIdReply() !== null) {?>
              <div class="admin-reply">
                <p><strong>Reply from the restaurant:</strong></p>
                <p><?php echo $_smarty_tpl->getValue('review')->getIdReply()->getBody();?>
</p>
              </div> <!-- /.admin-reply-->
            <?php }?>
          </div> <!-- /.review-card-->
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </section>
    </div> <!-- /.page-container -->

    <!-- Footer-->
    <?php $_smarty_tpl->renderSubTemplate('file:footerUser.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
  </body>
</html><?php }
}
