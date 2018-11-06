<?php get_header(); ?>

<div class="container">
  <div class="col-md-12 content-area" id="main-column">
    <main id="main" class="site-main" role="main">
      <ul class="beer-header-nav">
        <?php

        $taxonomies = get_object_taxonomies( array( "post_type" => "beer" ) );
        foreach( $taxonomies as $key => $taxonomy ) {
          $terms = get_terms( $taxonomy );
          foreach ( $terms as $term ) {
            if ( $term->parent == 50 ) { // Beer Categories is ID 50
              $klass = ( (get_query_var('cat') == $term->term_id) || (!get_query_var('cat') && $term->term_id == 51) ) ? "active" : "";
              echo '<li class="beer-header-nav-category"><a href="?cat='.$term->term_id.'" class="'.$klass.'">'.$term->name.'</a></li>';
            } 
          }
        }
          
        ?>
      </ul>

      <?php if (!get_query_var('cat') || get_query_var('cat') == 51): ?>
        <div style="padding-left:40px; padding-bottom:40px; color:#555;">Available Year Round</div>
      <?php endif; ?>

      <?php $query = braxton_brewing_retrieve_beers(); ?>
      <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): ?>
          <?php $query->the_post(); ?>
          <?php if ($query->current_post % 4 == 0): ?>
          <div class="row">
          <?php endif; ?>
          <?php get_template_part('templates/teaser', 'beer'); ?>
          <?php if ($query->current_post % 4 == 3 || $query->post_count < $query->current_post + 1): ?>
          </div>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </main>
  </div>
</div>

<?php get_footer(); ?>