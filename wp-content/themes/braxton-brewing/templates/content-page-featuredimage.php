<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title text-center page-title"><?php the_title(); ?></h1>
  </header>
  <div class="container">
	  <div class="entry-content">
	    <?php the_content(); ?>
	    <div class="clearfix"></div>
	  </div>
  </div>
</article>