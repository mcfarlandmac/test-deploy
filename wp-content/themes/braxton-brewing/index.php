<?php get_header(); ?>
        <div class="container">
          <div class="col-md-12 content-area" id="main-column">
            <main id="main" class="site-main" role="main">
              <?php if (have_posts()): ?>
                <div id="infinite-scroll-container">
                <?php global $wp_query; ?>
                <?php while (have_posts()): ?>
                  <?php the_post(); ?>
                  <?php if ($wp_query->current_post % 3 == 1 || $wp_query->current_post == 0): ?>
                  <div class="row">
                  <?php endif; ?>
                  <?php if ($wp_query->current_post == 0): ?>
                  <?php get_template_part('templates/teaser', 'post-wide'); ?>
                  <?php else: ?>
                  <?php get_template_part('templates/teaser', 'post'); ?>
                  <?php endif; ?>
                  <?php if ($wp_query->current_post % 3 == 0 || $wp_query->post_count <= $wp_query->current_post): ?>
                  </div>
                  <?php endif; ?>
                <?php endwhile; ?>
                </div>
                <nav class="pager">
                  <div class="more"><?php next_posts_link('Load More'); ?></div>
                </nav>
              <?php else: ?>
                <?php get_template_part('no-results', 'index'); ?>
              <?php endif; ?>
            </main>
          </div>
        </div>
<?php get_footer(); ?>