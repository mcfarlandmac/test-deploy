<?php
/*
Template Name: Page with Featured Image
*/
?>
<?php get_header(); ?>         
        <main id="main" class="site-main" role="main">
          <div class="post-container">
          <?php while (have_posts()): ?>
            <?php the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
              <header class="entry-header">
                <?php if (has_post_video()): ?>
                <?php the_post_video(); ?>
                <?php else: ?>
                <div class="featured-image" <?php braxton_brewing_teaser_background($size); ?>></div>
                <?php endif; ?>
              </header>
              <?php get_template_part('templates/content', 'page-featuredimage'); ?>
            </article>
          <?php endwhile; ?>
          </div>
        </main>
<?php get_footer(); ?>