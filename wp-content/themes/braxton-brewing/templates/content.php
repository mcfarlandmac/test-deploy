<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
  <header class="entry-header">
    <div class="featured-image" <?php braxton_brewing_teaser_background($size); ?>></div>
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <div class="entry-meta">
      <span class="author"><span class="icon icon-user"></span> <?php the_author(); ?></span>
    </div>
  </header>
  <div class="col-sm-12 floral-border text-center">
    <span class="icon icon-floral"></span>
  </div>
  <div class="col-sm-10 col-sm-push-1 entry-content">
    <?php the_content(); ?>
  </div>
</article>