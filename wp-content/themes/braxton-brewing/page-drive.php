<?php
/*
Template Name: Braxton Drive
*/
?>
<?php get_header(); ?>

  <main id="main" class="site-main" role="main">
    <div class="trophy-header" style="width:100%;margin-top:-160px;">
      <img src="/wp-content/uploads/2016/08/lex_drive_hero.jpg" style="width:100%;">
      <!--<h1><img src="/wp-content/uploads/2016/06/7f5e0707-f040-4b93-b267-60a5242265a0.png" style="width:400px; max-width:90%; margin:0 5%;"></h1>-->
    </div>
      <div class="trophy-section" style="padding-bottom:80px; padding-top:80px; text-align:center; font-size:20px;">
        <div class="container">
          <div class="row">
            <div class="col-md-6 hide-title">
              <?php while (have_posts()): ?>
                  <?php the_post(); ?>
                  <?php get_template_part('templates/content', 'page'); ?>
                <?php endwhile; ?>
                <br>
            </div>
            <div class="col-md-6">
            	<iframe src="https://player.vimeo.com/video/137834795?title=0&byline=0&portrait=0" width="100%" height="300" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
      <div style="background:#fff; padding-top:80px; padding-bottom: 80px;">
      <h2 style="display: block; clear:both; background-image:url(/wp-content/uploads/2016/05/slanted-bg.png); background-repeat:no-repeat; height: 120px; width: 500px; max-width:95%; margin:10px auto; line-height:120px;text-align:center;color:#fff;">Upcoming Events in Lexington</h2>
        <div class="drive-section drive-partners">
          <div class="drive-partner" style="background-image:url(https://scontent-yyz1-1.xx.fbcdn.net/t31.0-8/11148664_10153122728754585_6409665873591799962_o.jpg);">
            <a href="https://www.facebook.com/events/578660995639960/">Lexington Launch Party at Pazzo's, 8/24</a>
          </div>
          <div class="drive-partner" style="background-image:url(https://farm6.static.flickr.com/5680/22707377258_5a1e8b2312.jpg);">
            <a href="https://www.facebook.com/events/673186466164682/">Hopcat Pint Night, 8/25</a>
          </div>
          <div class="drive-partner" style="background-image:url(http://gallivant.com/p/2013/01/beer-trappe-1.jpg);">
            <a href="https://www.facebook.com/events/1054152077965538/">Pint Night at the Beer Trappe, 9/1</a>
          </div>
          <div class="drive-partner" style="background-image:url(http://www.lexbeerscene.com/images/LFA-Pics/Home-Pic.jpg);">
            <a href="https://www.facebook.com/events/673186466164682/">2016 Fest of Ales, 9/2</a>
          </div>
          <div class="drive-partner" style="background-image:url(https://s3-media2.fl.yelpcdn.com/bphoto/Qpxu5BmKGlGo1uUi7DkoYg/348s.jpg);">
            <a href="https://www.facebook.com/events/844085902395743/">Mellow Mushroom Pint Night, 9/8</a>
          </div>
          <div class="drive-partner" style="background-image:url(http://universityinnky.com/uinnsite/wp-content/uploads/2016/03/keeneland-racing.jpg);">
            <a href="https://www.facebook.com/events/1611093689188243/">Keeneland Kickoff Tailgate, 10/7</a>
          </div>
        </div>
      </div>
      <div>
        <a href="https://twitter.com/home?status=Let's%20%23LiftOneToLife%20Lexington!%20%40BraxtonBrewCo%20is%20heading%20to%20the%20heart%20of%20the%20Bluegrass!%20">
          <img src="/wp-content/uploads/2016/08/snap-share-win.jpg" style="width:100%;" target="_blank">
        </a>
      </div>
      <div id="social-scroller-container" style="margin:0;">
        <?php braxton_brewing_social_scroller(); ?>
      </div>
      <div class="trophy-section" style="padding-top:80px; padding-bottom: 80px;">
        <h2 style="display: block; clear:both; background-image:url(/wp-content/uploads/2016/05/slanted-bg.png); background-repeat:no-repeat; height: 120px; width: 500px; max-width:95%; margin:10px auto; line-height:120px;text-align:center;color:#fff;">Want to Sell Braxton?</h2>
        <?php echo do_shortcode( '[contact-form-7 id="5003" title="Seller Inquiry Form"]' ); ?>
      </div>>
  </main>

<?php get_footer(); ?>