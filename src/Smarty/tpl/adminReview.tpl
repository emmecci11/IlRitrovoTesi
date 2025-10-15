<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">       
        <title>Reviews - Il Ritrovo</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
        <link href="/IlRitrovo/src/Smarty/css/reviews.css" rel="stylesheet">
    </head>
    <body>
        <div class="page-container">

            <!-- Header rendered through the View -->

            <!-- Header image -->
            <section class="review-image">
            <img src="/IlRitrovo/src/Smarty/assets/images/home/reviews.jpg" alt="Customer enjoying meal" />
            </section>

            <section>
                <h2>Customer Reviews</h2>
                {foreach from=$allReviews item=review}
                    <div class="review-card">
                        <div class="review-meta">
                            <span><strong>{$review->getUsername()}</strong> rated <strong>{$review->getStars()}/5</strong></span>
                            <span class="review-timestamp">{$review->getCreationTime()}</span>
                        </div> <!-- /.review-meta-->
                        <p class="review-body">{$review->getBody()}</p>
                        <!-- Button Delete Review -->
                        <form action="/IlRitrovo/public/Review/deleteReview/{$review->getIdReview()}" method="post">
                            <button type="submit" class="btn delete">Delete Review</button>
                        </form>
                        {if $review->getIdReply() === null}
                            {if isset($showReplyForm) && $showReplyForm == $review->getIdReview()}
                                <section class="review-box admin-reply-form">
                                    <form action="/IlRitrovo/public/Reply/addReply/{$review->getIdReview()}" method="post">
                                        <label for="reply-{$review->getIdReview()}">Write reply:</label>
                                        <textarea id="reply-{$review->getIdReview()}" name="replyBody" rows="3" required></textarea>
                                        <div class="form-action-right">
                                        <button type="submit" class="btn save">Submit Reply</button>
                                        </div>
                                    </form>
                                </section>
                            {else}
                                <a href="/IlRitrovo/public/Reply/showReplyForm/{$review->getIdReview()}" class="btn save">Reply</a>
                            {/if}
                        {else}
                            <div class="admin-reply">
                                <p><strong>Reply from the restaurant:</strong></p>
                                <p>{$review->getReply()->getBody()}</p>
                            </div> <!-- /.admin-reply-->
                        {/if}
                    </div> <!-- /.review-card-->
                {/foreach}
            </section>

        </div> <!-- /.page-container -->

        <!-- Footer-->
        {include file='footerAdmin.tpl'}
    </body>
</html>