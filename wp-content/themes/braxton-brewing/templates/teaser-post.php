<div class="col-md-4 col-sm-6">
  <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
    <div class="entry-container">
      <a href="<?php the_permalink(); ?>"><?php braxton_brewing_the_teaser_image(); ?></a>
      <div class="entry-info">
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <div class="entry-meta">
          <span class="author"><span class="icon icon-user"></span> <?php the_author(); ?></span>
        </div>
      </div>
      <footer>
        <a href="<?php the_permalink(); ?>" rel="bookmark">Read More &rsaquo;</a>
      </footer>
    </div>
  </article>
</div>