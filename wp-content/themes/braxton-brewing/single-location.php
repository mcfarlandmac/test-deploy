<?php get_header(); ?>
  <?php $post_location_id = get_the_ID(); ?>
  <div class="container location-page">
    <?php while (have_posts()): ?>
      <?php the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="row">
          <div class="location-logo">
            <?php $logo = get_field('logo'); ?>
            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
          </div>
        </div>
        <div class="location-container">
          <?php $heroImg = get_field('hero_image'); ?>
          <div class="row location-hero" style="background-image: url(<?php echo $heroImg['url']; ?>);">
          </div>
          <div class="row">
            <div class="col-md-4">
	      <?php if($post_location_id == 6173): ?>
                <div class="location-widget">
                  <h3>Hours</h3>
                  <div class="hours-row">
                    <span class="hours-day">Mon</span>
                    <span class="hours-open">Closed</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Tue</span>
                    <span class="hours-open">8am - 10pm</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Wed</span>
                    <span class="hours-open">8am - 10pm</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Thu</span>
                    <span class="hours-open">8am - 12am</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Fri</span>
                    <span class="hours-open">8am - 1am</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Sat</span>
                    <span class="hours-open">12pm - 1am</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Sun</span>
                    <span class="hours-open">12pm - 8pm</span>
                  </div>
                </div>
                <div class="taproom-top-button">
                  <a href="" id="eventButton" class="btn btn-lg">Book an Event</a>
                  <script type="text/javascript" src="https://gatherhere.com/js/leadform.js" id="gather-loader" data-locationid="s9kbc22c" data-trigger="eventButton"></script>
                </div>
              <?php elseif ($post_location_id == 6178): ?>
		<div class="location-widget">
                  <h3>Hours</h3>
                  <div class="hours-row">
                    <span class="hours-day">Mon</span>
                    <span class="hours-open">11am - 10pm</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Tue</span>
                    <span class="hours-open">11am - 10pm</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Wed</span>
                    <span class="hours-open">11am - 10pm</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Thu</span>
                    <span class="hours-open">11am - 11pm</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Fri</span>
                    <span class="hours-open">11am - 12am</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Sat</span>
                    <span class="hours-open">11am - 12am</span>
                  </div>
                  <div class="hours-row">
                    <span class="hours-day">Sun</span>
                    <span class="hours-open">11am - 9pm</span>
                  </div>
                </div>
                <div class="social-network social-circle">
                  <a href="https://facebook.com/BraxtonLabs" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                  <a href="https://twitter.com/braxtonlabs" class="icoTwitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                  <a href="https://instagram.com/braxtonbrewco/" class="icoInstagram" title="Instagram" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>
              <?php endif; ?>
            </div>
            <div class="col-md-8">
              <h3>About <?php the_title(); ?></h3>
              <div class="location-content">
                <?php the_content(); ?>
              </div>
              <?php if($post_location_id == 6173): ?>
                <ul class="beer-header-nav taproom-view-options">
                  <li class="beer-header-nav-category"><a href="javascript:void(0)" data-view="beer-menu" class="active">Beer Menu</a></li>
                  <li class="beer-header-nav-category"><a href="javascript:void(0)" data-view="food-options">Food Options</a></li>
                  <li class="beer-header-nav-category"><a href="javascript:void(0)" data-view="taproom-360">360 Tour</a></li>
                </ul>
                <div class="beer-menu">
                  <div id="menu-container"></div>
                  <?php 
                  // get_beer_menu();
                  get_beer_menu($post_location_id);
                  ?>
                </div>
                <div class="food-options">
                  <div class="taproom-bottom-text">
                    <p>Braxton Brewing is committed to producing and serving the best craft beer possible. As such, we do not serve food in our taproom. Rather, we have partnered with restaurants to deliver any food you may wish. Many of those menus can be viewed below, and of course if you’d rather bring your own food in - feel free to do so!</p>
                    <div class="food-options-menus">
                      <div id="infinite-scroll-container">
                        <div class="row">
                          <div class="col-md-3 col-sm-6">
                            <a href=<?php bloginfo('url'); echo '/wp-content/uploads/2016/09/jjmenu.jpg'?> target="_blank">
                              <img src=<?php bloginfo('url'); echo '/wp-content/uploads/2016/09/jjLogoLarge.png'?> />
                            </a>
                          </div>
                          <div class="col-md-3 col-sm-6">
                            <a href=<?php bloginfo('url'); echo '/wp-content/uploads/2015/07/Carry-out-PDF-2014.pdf'?> target="_blank">
                              <img src=<?php bloginfo('url'); echo '/wp-content/uploads/2015/07/StrongsPizza.jpg'?> />
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="taproom-360">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m0!3m2!1sen!2sus!4v1436201406021!6m8!1m7!1sF3lo-WdAZjAAAAQfDRgbeg!2m2!1d39.083102!2d-84.510955!3f241.96!4f0!5f0.7820865974627469" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
              <?php elseif ($post_location_id == 6178): ?>

                <div class="beer-menu">
                  <h2>Current Beer Menu</h2>
                  <div id="menu-container"></div>
                  <?php 
                  // get_beer_menu();
                  get_beer_menu($post_location_id);
                  ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
<?php get_footer(); ?>