<?php get_header(); ?>
        <div class="container">
          <div class="col-md-12 content-area " id="main-column">
            <main id="main" class="site-main" role="main">
              <?php $query = braxton_brewing_retrieve_events(); ?>
              <?php if ($query->have_posts()): ?>
                <div id="infinite-scroll-container">
                <?php while ($query->have_posts()): ?>
                  <?php $query->the_post(); ?>
                  <?php if ($query->current_post % 3 == 0): ?>
                  <div class="row">
                  <?php endif; ?>
                  <?php get_template_part('templates/teaser', 'event'); ?>
                  <?php if ($query->current_post % 3 == 2 || $query->post_count <= $query->current_post): ?>
                  </div>
                  <?php endif; ?>
                <?php endwhile; ?>
                </div>
                <nav class="pager">
                    <div class="more"><?php next_posts_link('Load More'); ?></div>
                </nav>
              <?php else: ?>

              <?php endif; ?>
            </main>
            <div class="text-center" style="padding-top: 30px;"><a href="" id="eventButton" class="btn btn-default">Book an Event</a></div>
						<script type="text/javascript" src="https://gatherhere.com/js/leadform.js" id="gather-loader" data-locationid="s9kbc22c" data-trigger="eventButton"></script>
          </div>
        </div>
<?php get_footer(); ?>