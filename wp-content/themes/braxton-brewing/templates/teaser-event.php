<div class="col-md-4 col-sm-6">
  <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
    <div class="entry-container">
      <a href="<?php the_permalink(); ?>"><?php braxton_brewing_the_teaser_image(); ?></a>
      <div class="entry-info">
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <div class="entry-location"><?php the_field('location'); ?></div>
        <div class="entry-content"><?php the_excerpt(); ?></div>
      </div>
      <footer>
        <div class="entry-meta row">
          <span class="entry-date col-sm-6 col-xs-12"><?php braxton_brewing_get_event_date(); ?></span>
          <span class="entry-time col-sm-6 col-xs-12"><?php braxton_brewing_get_event_time(); ?></span>
        </div>
        <div class="row">
          <a href="<?php the_permalink(); ?>" rel="bookmark">Learn More &rsaquo;</a>
        </div>
      </footer>
    </div>
  </article>
</div>