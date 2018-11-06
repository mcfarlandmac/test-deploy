<?php get_header(); ?>
  <div class="container">
    <div class="col-sm-10 col-sm-push-1 col-md-8 col-md-push-2 content-area" id="main-column">
      <main id="main" class="site-main" role="main">
        <?php while (have_posts()): ?>
          <?php the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
              <h1 class="entry-title"><?php the_title(); ?></h1>
              <div class="featured-image" <?php braxton_brewing_teaser_background($size); ?>></div>
              <div class="entry-meta event-meta row text-center">
                <div class="col-sm-6 event-date">
                  <div>
                    <span class="entry-date"><?php braxton_brewing_get_event_date(); ?> <?php braxton_brewing_get_event_time(); ?></span>
                  </div>
                </div>
                <div class="col-sm-6 event-location">
                  <div>
                    <span class="entry-location"><?php the_field('location'); ?></span>
                  </div>
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