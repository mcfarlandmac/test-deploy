<?php get_header(); ?>         
        <main id="main" class="site-main" role="main">
          <div class="post-container row">
          <?php while (have_posts()): ?>
            <?php the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
              <header class="entry-header">
                <?php if (has_post_video()): ?>
                <?php the_post_video(); ?>
                <?php else: ?>
                <div class="featured-image" <?php braxton_brewing_teaser_background($size); ?>></div>
                <?php endif; ?>
                <div class="goldbox">
                  <div class="container">
                    <div class="row">
                      <div class="col-sm-12 col-md-5 title">
                      	<div>
	                        <h1 class="entry-title"><?php the_title(); ?></h1>
	                        <div class="entry-meta">
	                          <div class="profile-title text-center"><?php the_field('title'); ?></div>
	                        </div>
                      	</div>
                      </div>
                      <div class="col-sm-12 col-md-7 entry-content">
                        <?php the_content(); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </header>
            </article>
          <?php endwhile; ?>
          </div>
        </main>
<?php get_footer(); ?>