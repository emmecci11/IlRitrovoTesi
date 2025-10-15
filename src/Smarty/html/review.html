<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews - Il Ritrovo</title>
    <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
    <link href="/IlRitrovo/src/Smarty/css/reviews.css" rel="stylesheet">
  </head>
  <body>
    <div class="page-container">
      
      <!-- Header rendered through the View -->

      <!-- Review message -->
      <div class="review-reminder" style="background-color: #fff; border: 1px solid #8b3a3a; padding: 1rem 1.5rem; margin-bottom: 2rem; border-radius: 6px; font-family: 'Open Sans', sans-serif; color: #4a3b2c; white-space: nowrap;">
        Remember, you can <span style="color: #8b3a3a; font-weight: 600;">leave a review</span> in your "<span style="color: #8b3a3a; font-weight: 600;">Profile</span>" after your visit. Thank you!
      </div>

      <!-- Header image -->
      <section class="review-image">
        <img src="/IlRitrovo/src/Smarty/assets/images/home/reviews.jpg" alt="Customer enjoying meal" />
      </section>

      <!-- Personal Review Section -->
      {if isset($loggedUser)}
        <section class="review-box">
          {if $userReview === null}
            <h2>Leave your review</h2>
            <form action="/IlRitrovo/public/Review/checkAddReview" method="post">
              <label for="stars">Rating:</label>
                <div class="rating-stars">
                  {for $i=5 to 1 step -1}
                    <input type="radio" name="stars" id="star{$i}" value="{$i}" required>
                    <label for="star{$i}">★</label>
                  {/for}
                </div> <!-- /.rating-stars-->
              <label for="body">Your Review:</label>
              <textarea name="body" rows="4" required>{$body|default:''|escape}</textarea>
              <div class="form-action-right">
                <button type="submit" class="btn save">Submit</button>
              </div> <!-- /.form-action-right-->
            </form>
          {else}
            <h2>Your Review</h2>
            <div class="existing-review">
              <p><strong>Rating:</strong> {$review->getStars()} / 5</p>
              <p><strong>Review:</strong> {$review->getBody()}</p>
              <div class="form-action-right">
                <a href="/IlRitrovo/public/Review/deleteReview/{$review->getIdReview()}" class="btn delete">Delete</a>
              </div> <!-- /.form-action-right-->
            </div> <!-- /.existing-review-->
          {/if}
        </section>
      {/if}

      <!-- All Reviews Section -->
      <section>
        <h2>What our customers say</h2>
        {foreach from=$allReviews item=review}
          <div class="review-card">
            <div class="review-meta">
              <span><strong>{$review->getUsername()}</strong> rated 
                <strong>{$review->getStars()}/5</strong>
              </span>
              <span class="review-timestamp">{$review->getCreationTime()}</span>
            </div> <!-- /.review-meta-->
            <p class="review-body">{$review->getBody()}</p>
            {if $review->getReply() !== null}
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
    {include file='footerUser.tpl'}
  </body>
</html>