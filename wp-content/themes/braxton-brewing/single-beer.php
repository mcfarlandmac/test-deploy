<?php get_header(); ?>
        <div class="container">
          <div class="col-sm-10 col-sm-push-1 col-md-8 col-md-push-2 content-area" id="main-column">
            <main id="main" class="site-main" role="main">
              <?php while (have_posts()): ?>
                <?php the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                  <header class="entry-header"><br><br>
                    <div class="featured-image" <?php braxton_brewing_teaser_background($size); ?>></div>
                    <div class="entry-stats">
                      <div class="entry-stat">
                        <div class="cog-container cog-<?php the_ID(); ?>"><?php the_field('abv'); ?>%</div>
                        <div class="entry-stat-description">ABV</div>
                      </div>
                      <div class="entry-stat">
                        <div class="cog-container cog-<?php the_ID(); ?>"><?php the_field('ibu'); ?></div>
                        <div class="entry-stat-description">IBU</div>
                      </div>
                      <div class="entry-stat">
                        <div class="cog-container cog-<?php the_ID(); ?>"><?php the_field('srm'); ?></div>
                        <div class="entry-stat-description">SRM</div>
                      </div>
                  </div>
                  </header>
                  <div class="entry-content row">
                    <div class="col-sm-10 col-sm-push-1 col-md-8 col-md-push-2">
                      <?php the_content(); ?>
                    </div>
                    <div class="col-sm-12 floral-border text-center">
                      <span class="icon icon-floral"></span>
                    </div>
                  </div>
                </article>
              <?php endwhile; ?>
            </main>
          </div>
        </div>
<?php get_footer(); ?>