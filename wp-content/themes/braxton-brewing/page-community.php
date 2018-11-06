<?php get_header(); ?>
        <div class="container">
          <br><br>
          <div class="col-md-12 content-area" id="main-column">
            <main id="main" class="site-main" role="main">
              <?php while (have_posts()): ?>
                <?php the_post(); ?>
                <?php get_template_part('templates/content', 'page'); ?>
              <?php endwhile; ?>
            </main>
          </div>
        </div>
        <div id="social-scroller-container">
          <?php braxton_brewing_social_scroller(); ?>
        </div>
        <div id="signup-form-container" class="row">
          <div class="text-center col-md-4 col-md-offset-4">
            <form action="//braxtonbrewing.us3.list-manage.com/subscribe/post?u=7c8a74d940a5fbccccdb3d44e&amp;id=878dd0b5b0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
              <div class="form-directions">
                <label for="mce-EMAIL">Subscribe to our mailing list</label>
              </div>
              <div class="input-group">
                <input type="email" value="" name="EMAIL" class="email form-control" id="mce-EMAIL" placeholder="email address" required>
                <div style="position: absolute; left: -5000px;"><input type="text" name="b_7c8a74d940a5fbccccdb3d44e_878dd0b5b0" tabindex="-1" value=""></div>
                <span class="input-group-btn">
                  <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default">
                </span>
              </div>
            </form>
          </div>
        </div>
<?php get_footer(); ?>