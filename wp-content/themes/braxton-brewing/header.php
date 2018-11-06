<?php
/**
 * The theme header
 */
?>
<!DOCTYPE html>
<!-- [if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!-- [if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!-- [if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!-- [if gt IE 8]> <html class="no-js" <?php language_attributes(); ?>> <![endif]-->
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:image" content="http://www.braxtonbrewing.com/wp-content/themes/braxton-brewing/images/braxton-social-share.jpg" />

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link type="text/css" rel="stylesheet" href="http://fast.fonts.net/cssapi/0ba8a695-6662-4f5f-a4dd-d01be72fbb02.css"/>

    <!--wordpress head-->
    <?php wp_head(); ?>
    <script src="https://use.fontawesome.com/44c84edb25.js"></script>
  </head>
  <body <?php body_class(); ?>>
    <div id="navigation-wrap">
      <span class="glyphicon glyphicon-remove toggle-menu"></span>
      <nav role="navigation">
        <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?>
      </nav>
    </div>
    <div id="header-wrap">
      <header role="banner" class="gradient-header">
        <div class="container">
          <div class="row row-with-vspace site-branding">
            <div class="col-xs-10 col-sm-9 col-md-2 site-title">
              <h1 class="site-title-heading">
                <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"></a>
              </h1>
            </div>
            <div class="col-lg-10 col-md-10 hidden-sm hidden-xs">
                <div class="collapse navbar-collapse" id="horizontal-menu">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="/our-beers">OUR BEERS</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">LOCATIONS <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="/locations/the-taproom" style="padding-left:25px !important;">THE TAPROOM</a></li>
                        <li><a href="/locations/braxton-labs">BRAXTON LABS</a></li>
                        <li><a href="/locations/the-loft-private-event-space">THE LOFT</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ABOUT <span class="caret"></span></a>
                			<ul class="dropdown-menu">
                				<li><a href="/about" style="padding-left:25px !important;">OUR STORY</a></li>
                        <li><a href="http://www.starter-coffee.com" target="_blank">STARTER COFFEE</a></li>
                        <li><a href="/videos">VIDEOS</a></li>
                        <li><a href="/community">GALLERY</a></li>
                			</ul>
                		</li>
                    <li><a href="/the-team">THE TEAM</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">EVENTS <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="/whats-happening" style="padding-left:25px !important;">BRAXTON EVENTS</a></li>
                        <li><a href="/locations/the-loft-private-event-space">BOOK AN EVENT</a></li>
                      </ul>
                    </li>
                    <li><a href="/blog">BLOG</a></li>
                    <li><a href="http://store.braxtonbrewing.com">STORE</a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
            </div>
            <div class="col-xs-2 col-sm-3 hidden-md hidden-lg page-header-top-right">
              <ul>
                <li><a class="toggle-menu">Menu<span class="icon icon-menu"></span></a></li>
              </ul>
            </div>
          </div><!--.site-branding-->
          <div class="sr-only">
            <a href="#content" title="<?php esc_attr_e('Skip to content', 'bootstrap-basic'); ?>"><?php _e('Skip to content', 'bootstrap-basic'); ?></a>
          </div>
        </div>
      </header>
    </div>
    <div class="page-container">

      <?php do_action('before'); ?>

      <?php if (get_post_type() == 'location'): ?>
        <div id="content" class="row-with-vspace site-content" style="background-color:rgba(23,23,23,1);">
      <?php else : ?>
        <div id="content" class="row-with-vspace site-content" style="<?php if (is_page('the-taproom') || is_page('drive') || is_page('trophy-grants') || get_post_type() == 'beer') { echo 'background-color:#E3E3E1;'; } ?>">
      <?php endif; ?>