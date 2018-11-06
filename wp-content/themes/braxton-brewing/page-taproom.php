<?php
/*
Template Name: Taproom Page
*/
?>
<?php get_header(); ?>
        <div class="container">
          <div class="col-md-12 content-area" id="main-column">
            <main id="main" class="site-main" role="main">
              <div class="taproom-top-container">
                <div class="taproom-top-text">
                  <h1>The Taproom</h1>
                  <p>Welcome to the Taproom of the Future! Our Taproom, located at 27 W 7th Street in Covington, Kentucky was designed and built to remind us every day where we came from - the Midwestern Garage. You see, we view the garage as the icon of American Innovation, and to honor that notion we’ve built a space that’s open to the community. We open at 8am to welcome the startup community to use the fastest internet in the world, our projector screen, and white boards painted on the walls. But don’t worry, the space is all about fun as well! With a 1,000 square-foot garage in the middle of the taproom, we’ve built the perfect meeting or event space for groups from 10-60! So stop in for a pint, tour our facility, and Lift One to Life with us in our garage!</p>
                </div>
                <div class="taproom-top-button-container">
                  <div class="taproom-top-button">
                    <a href="" id="eventButton" class="btn btn-lg">Book an Event</a>
                    <script type="text/javascript" src="https://gatherhere.com/js/leadform.js" id="gather-loader" data-locationid="s9kbc22c" data-trigger="eventButton"></script>
                  </div>
                </div>
              </div>
              <ul class="beer-header-nav">
                <li class="beer-header-nav-category"><a href="?cat=1" class="<?php if (!get_query_var('cat') || get_query_var('cat') == 1) { echo 'active'; } ?>">360 Tour</a></li>
                <li class="beer-header-nav-category"><a href="?cat=2" class="<?php if (get_query_var('cat') == 2) { echo 'active'; } ?>">Gallery</a></li>
                <!-- <li class="beer-header-nav-category"><a href="?cat=3" class="<?php if (get_query_var('cat') == 3) { echo 'active'; } ?>">Restaurant Partners</a></li> -->
              </ul>
              <?php if (get_query_var('cat') == 1 || !get_query_var('cat')) { ?>
                <iframe src="https://www.google.com/maps/embed?pb=!1m0!3m2!1sen!2sus!4v1436201406021!6m8!1m7!1sF3lo-WdAZjAAAAQfDRgbeg!2m2!1d39.083102!2d-84.510955!3f241.96!4f0!5f0.7820865974627469" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
              <?php } elseif (get_query_var('cat') == 2) { ?>
                <?php while (have_posts()): ?>
                  <?php the_post(); ?>
                  <?php get_template_part('templates/content', 'page-taproom'); ?>
                <?php endwhile; ?>
              <?php } else { ?>
                <h1>Partners</h1>
              <?php } ?>
              <div class="taproom-bottom-container">
                <div class="taproom-bottom-text">
                  <h1>Food Options</h1>
                  <p>Braxton Brewing is committed to producing and serving the best craft beer possible. As such, we do not serve food in our taproom. Rather, we have partnered with restaurants to deliver any food you may wish. Many of those menus can be viewed below, and of course if you’d rather bring your own food in - feel free to do so!</p>
                  <div class="food-option-menus">
                    <?php $query = braxton_brewing_retrieve_food_menus(); ?>
                    <?php if ($query->have_posts()): ?>
                      <div id="infinite-scroll-container">
                      <?php while ($query->have_posts()): ?>
                        <?php $query->the_post(); ?>
                        <?php if ($query->current_post % 4 == 0): ?>
                        <div class="row">
                        <?php endif; ?>
                        <?php get_template_part('templates/teaser', 'food-menu'); ?>
                        <?php if ($query->current_post % 4 == 3 || $query->post_count <= $query->current_post): ?>
                        </div>
                        <?php endif; ?>
                      <?php endwhile; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </main>
          </div>
        </div>
<?php get_footer(); ?>