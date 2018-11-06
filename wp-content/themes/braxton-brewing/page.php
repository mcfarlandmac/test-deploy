<?php get_header(); ?>
        <div class="container">
          <div class="col-md-12 content-area" id="main-column">
            <main id="main" class="site-main" role="main">
              <?php while (have_posts()): ?>
                <?php the_post(); ?>
                <?php get_template_part('templates/content', 'page'); ?>
              <?php endwhile; ?>
            </main>
          </div>
        </div>
<?php get_footer(); ?>