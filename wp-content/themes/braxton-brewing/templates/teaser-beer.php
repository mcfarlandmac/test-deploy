<div class="col-md-3 col-sm-6">
  <article id="post-<?php the_ID(); ?>" <?php post_class('teaser'); ?>>
    <div class="entry-container">
      <?php if (get_field('on_tap')) { ?>
      	<div class="on-tap"></div>
      <?php } ?>
      <a href="<?php the_permalink(); ?>"><?php braxton_brewing_the_beer_image(); ?></a>
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
      <div class="entry-info">
        <p><?php the_excerpt(); ?></p>
      </div>
      <footer>
        <a href="<?php the_permalink(); ?>" rel="bookmark">Learn More &rsaquo;</a>
      </footer>
    </div>
  </article>
</div>