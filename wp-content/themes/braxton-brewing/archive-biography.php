<?php get_header(); ?>
        <div class="container">
          <div class="col-md-12 content-area" id="main-column">
            <main id="main" class="site-main" role="main">
              <?php $query = braxton_brewing_retrieve_biographies(); ?>
              <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()): ?>
                  <?php $query->the_post(); ?>
                  <?php if ($query->current_post % 4 == 0): ?>
                  <div class="row biography-list">
                  <?php endif; ?>
                  <?php get_template_part('templates/teaser', 'biography'); ?>
                  <?php if ((($query->current_post + 1) % 4 == 0) || $query->post_count < $query->current_post + 1): ?>
                  </div>
                  <?php endif; ?>
                <?php endwhile; ?>
              <?php endif; ?>
            </main>
          </div>
        </div>
<?php get_footer(); ?>