<div class="col-md-12">
  <article id="post-<?php the_ID(); ?>" <?php post_class('teaser  teaser-wide'); ?>>
    <div class="entry-container row">
      <div class="col-sm-6 teaser-image-col">
        <a href="<?php the_permalink(); ?>"><?php braxton_brewing_the_teaser_image(); ?></a>
      </div>
      <div class="col-sm-6">
        <div class="entry-info">
          <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
          <div class="entry-meta">
            <span class="author"><span class="icon icon-user"></span> <?php the_author(); ?></span>
          </div>
        </div>
        <div class="entry">
        <?php the_advanced_excerpt('length=30&use_words=1&no_custom=1&add_link=0&exclude_tags=img'); ?>
        </div>
        <footer>
          <a href="<?php the_permalink(); ?>" rel="bookmark">Read More &rsaquo;</a>
        </footer>
      </div>
    </div>
  </article>
</div>