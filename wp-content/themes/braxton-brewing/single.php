<?php get_header(); ?>
        <div class="container">
          <div class="col-sm-10 col-sm-push-1 col-md-8 col-md-push-2 content-area" id="main-column">
            <main id="main" class="site-main" role="main">
              <div class="post-container row">
              <?php while (have_posts()): ?>
                <?php the_post(); ?>
                <?php get_template_part('templates/content'); ?>
                <?php if (comments_open() || '0' != get_comments_number()): ?>
                  <div class="comment-container">
                    <h3>Comments</h3>
                    <?php comments_template(); ?>
                  </div>
                <?php endif; ?>
              <?php endwhile; ?>
              </div>
            </main>
          </div>
        </div>
<?php get_footer(); ?>