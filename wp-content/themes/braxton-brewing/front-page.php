<?php get_header(); ?>
        <div class="content-area" id="main-column">
          <main id="main" class="site-main" role="main">
            <?php while (have_posts()): ?>
              <?php the_post(); ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                  <h1 class="entry-title text-center page-title"><?php the_title(); ?></h1>
                </header>
                <div class="entry-content">
                  <?php if (have_rows('banners')): ?>
                  <div id="braxton-carousel-home" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                      <?php
                        $count = 0;
                        while (have_rows('banners')):
                          $count++;
                          the_row();
                          $image = get_sub_field('image');

                          $classes = array('item');
                          if ($count == 1) $classes[] = 'active';
                      ?>
                      <div class="<?php print implode(' ', $classes); ?>">
                        <?php if (get_sub_field('link')): ?>
                        <a href="<?php print get_sub_field('link'); ?>">
                          <img class="alignnone size-full" src="<?php print $image['url']; ?>" alt="<?php print $image['alt'] ?>" width="1170" height="353" />
                        </a>
                        <?php else: ?>
                        <img class="alignnone size-full" src="<?php print $image['url']; ?>" alt="<?php print $image['alt'] ?>" width="1170" height="353" />
                        <?php endif; ?>
                      </div>
                      <?php endwhile; ?>
                    </div>
                    <?php if ($count > 1): ?>
                    <a class="left carousel-control" href="#braxton-carousel-home" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#braxton-carousel-home" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <?php endif; ?>
                  </div>
                  <?php endif; ?>
                  <div class="paperbox">
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-12 col-md-push-1 col-md-10 col-lg-push-2 col-lg-8 text-left">
                          <p>THE GARAGE IS THE MOTHER OF INVENTION. <br>AND AROUND HERE, WE RESPECT OUR MOTHERS.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="locations-wrapper">
                    <div class="home-location">
                      <a href="/?location=the-taproom">THE TAPROOM</a>
                    </div>
                    <div class="home-location" id="labs">
                      <a href="/?location=braxton-labs">BRAXTON LABS</a>
                    </div>
                  </div>
                  <div class="container" id="home-features">
                    <div class="row double">
                      <div class="col-sm-4 ad">
                        <?php $ad2_image = get_field('image_2'); ?>
                        <a href="<?php the_field('link_2'); ?>">
                          <img class="alignnone size-full" src="<?php print $ad2_image['url']; ?>" alt="<?php print $ad2_image['alt'] ?>" width="390" height="600" />
                        </a>
                      </div>
                      <div class="col-sm-8">
                        <div class="row">
                          <div class="col-sm-6 ad">
                            <?php $ad3_image = get_field('image_3'); ?>
                            <a href="<?php the_field('link_3'); ?>">
                              <img class="alignnone size-full" src="<?php print $ad3_image['url']; ?>" alt="<?php print $ad3_image['alt'] ?>" width="780" height="300" />
                            </a>
                          </div>
                          <div class="col-sm-6 subscribe-front">
                            <div id="subscribe-wrap">
                              <form action="//braxtonbrewing.us3.list-manage.com/subscribe/post?u=7c8a74d940a5fbccccdb3d44e&amp;id=878dd0b5b0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div class="form-directions">
                                  <label for="mce-EMAIL">Subscribe to our mailing list</label>
                                </div>
                                <div class="input-group">
                                  <input type="email" value="" name="EMAIL" class="email form-control" id="mce-EMAIL" placeholder="email address" required>
                                  <div style="position: absolute; left: -5000px;"><input type="text" name="b_7c8a74d940a5fbccccdb3d44e_878dd0b5b0" tabindex="-1" value=""></div>
                                  <span class="input-group-btn">
                                    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default">
                                  </span>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 twitter"><?php print braxton_brewing_get_latest_tweet(); ?></div>
                          <div class="col-sm-6 blog-post"><?php print braxton_brewing_get_latest_post(); ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </article>
            <?php endwhile; ?>
          </main>
          <div class="text-center" style="padding-top: 30px;"><a href="" id="eventButton" class="btn btn-default">Book an Event</a></div>
					<script type="text/javascript" src="https://gatherhere.com/js/leadform.js" id="gather-loader" data-locationid="s9kbc22c" data-trigger="eventButton"></script>
        </div>
<?php get_footer(); ?>