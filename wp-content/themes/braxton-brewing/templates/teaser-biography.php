<div class="col-sm-6 col-md-3">
  <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
    <div class="entry-container">
      <a href="<?php the_permalink(); ?>">
        <?php $image = get_field('headshot'); ?>
        <img class="profile-image center-block img-circle" src="<?php print $image['url']; ?>" title="<?php print $image['title']; ?>" alt="<?php print $image['alt']; ?>" />
      </a>
      <div class="entry-info">
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <div class="profile-title text-center"><?php the_field('title'); ?></div>
      </div>
      <footer>
        <a href="<?php the_permalink(); ?>" rel="bookmark">Read Bio &rsaquo;</a>
      </footer>
    </div>
  </article>
</div>