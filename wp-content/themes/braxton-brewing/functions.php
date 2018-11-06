<?php

/**
 * Setup theme and register support wp features.
 */
function braxton_brewing_setup() {
  add_image_size('full', 2280, 9999);
  add_image_size('half', 1110, 9999);
  add_image_size('third', 720, 9999);
  add_image_size('quarter', 524, 9999);

  remove_theme_support('custom-background');
  remove_theme_support('post-formats');
}
add_action('after_setup_theme', 'braxton_brewing_setup', 11);

/**
 * Register widget areas
 */
function braxton_brewing_widgets_init() {
  unregister_sidebar('header-right');
  unregister_sidebar('navbar-right');
  unregister_sidebar('sidebar-left');
  unregister_sidebar('sidebar-right');
  unregister_sidebar('footer-right');
}
add_action('widgets_init', 'braxton_brewing_widgets_init', 11);

/**
 * Enqueue scripts & styles
 */
function braxton_brewing_enqueue_scripts() {
  wp_dequeue_style('bootstrap-style');
  wp_dequeue_script('bootstrap-script');

  wp_enqueue_style('braxton-brewing-bootstrap-style', get_stylesheet_directory_uri() . '/css/vendor/bootstrap/bootstrap.css');
  wp_enqueue_style('braxton-brewing-styles', get_stylesheet_directory_uri() . '/css/styles.css');
  wp_enqueue_script('braxton-brewing-bootstrap-script', get_stylesheet_directory_uri() . '/js/vendor/bootstrap.js');
  wp_enqueue_script('braxton-brewing-script', get_stylesheet_directory_uri() . '/js/global.js');
  wp_enqueue_script('braxton-brewing-custom', get_stylesheet_directory_uri() . '/js/custom.js');

  if (is_page('community') || is_page('drive')) {
    wp_enqueue_script('community', get_stylesheet_directory_uri() . '/js/community.js');
    wp_enqueue_script('braxton-brewing-endless-scroll', get_stylesheet_directory_uri() . '/js/vendor/endless_scroll_min.js');
  }
}
add_action('wp_enqueue_scripts', 'braxton_brewing_enqueue_scripts', 11);

function braxton_brewing_easy_image_gallery_button() {
    add_filter('mce_external_plugins', 'braxton_brewing_add_button');
    add_filter('mce_buttons', 'braxton_brewing_register_button');
}
add_action('init', 'braxton_brewing_easy_image_gallery_button');

function braxton_brewing_add_button($plugin_array) {
    $plugin_array['easy_image_gallery'] = get_stylesheet_directory_uri() . '/js/shortcode.js';
    return $plugin_array;
}

function braxton_brewing_register_button($buttons) {
    array_push($buttons, 'easy_image_gallery');
    return $buttons;
}

function braxton_brewing_load_infinite_scroll($load_infinite_scroll) {
  var_dump('test');
    if(s_page('whats-happening'))
      return true;
    return $load_infinite_scroll;
}
add_filter('infinite_scroll_load_override', 'braxton_brewing_load_infinite_scroll');

/**
 * Add Google Maps Key for Custom Fields
 */
function my_acf_google_map_api( $api ){
  $api['key'] = 'AIzaSyAMkyKz9biFUMUMLpV70Qlor8IwBfbo6sk';
  return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/**
 * Determine if taproom is open
 */
function is_taproom_open() {

  date_default_timezone_set('US/Eastern');
  $day    = date('w');
  $hour   = date('G');

  if ($day == '1') {
    // Monday
    return false;
  }
  elseif ($day == '2' || $day == '3') {
    // Tuesday or Wednesday
    if ($hour >= 8 && $hour < 22) {
      return true;
    } else {
      return false;
    }
  }
  elseif ($day == '4') {
    // Thursday
    if ($hour >= 8 && $hour < 24) {
      return true;
    } else {
      return false;
    }
  }
  elseif ($day == '5') {
    // Friday
    if ($hour >= 8) {
      return true;
    } else {
      return false;
    }
  }
  elseif ($day == '6') {
    // Saturday
    if ($hour < 1 || $hour >= 12) {
      return true;
    } else {
      return false;
    }
  }
  else {
    // Sunday
    if ($hour < 1 || ($hour >= 12 && $hour < 20)) {
      return true;
    } else {
      return false;
    }
  }
}

/**
 * Retrieves all beers
 */
function braxton_brewing_retrieve_beers() {
  global $wp_query;

  $cats = get_query_var('cat') ? get_query_var('cat') : 51;
  $args = array(
    'post_type' => 'beer',
    'orderby' => 'menu_order title',
    'order' => 'ASC',
    'tax_query' => array(
      array(
        'taxonomy' => 'category',
        'field'    => 'category_id',
        'terms'    => array( $cats ),
      ),
    ),
  );

  $wp_query = new WP_Query($args);

  return $wp_query;
}

/**
 * Retrieves all beers
 */
function braxton_brewing_retrieve_food_menus() {
  global $wp_query;

  $args = array(
    'post_type' => 'food_menu',
    'orderby' => 'menu_order title',
    'order' => 'ASC',
  );

  $wp_query = new WP_Query($args);

  return $wp_query;
}

/**
 * Retrieves all biographies
 */
function braxton_brewing_retrieve_biographies() {
  global $wp_query;

  $args = array(
    'post_type' => 'biography',
    'posts_per_page' => 50,
    'orderby' => 'menu_order title',
    'order' => 'ASC',
  );

  $wp_query = new WP_Query($args);

  return $wp_query;
}

/**
 * Retrieve all events
 */
function braxton_brewing_retrieve_events() {
  global $wp_query;
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;

  $args = array(
    'post_type' => 'event',
    'posts_per_page' => 12,
    'paged' => $paged,
    'meta_query' => array(
      array(
        'key' => 'start_date',
        'value' => time(),
        'compare' => '>=',
      ),
      array(
        'key' => 'featured',
      )
    )
  );

  add_filter('posts_orderby', 'braxton_brewing_events_orderby');
  $wp_query = new WP_Query($args);
  remove_filter('posts_orderby', 'braxton_brewing_events_orderby');

  return $wp_query;
}

/**
 * Filter for adding a custom sortby on events
 */
function braxton_brewing_events_orderby($query) {
  return "CASE WHEN mt1.meta_value = 'yes' THEN '1'
               WHEN mt1.meta_value = 'no' THEN '2'
               ELSE mt1.meta_value END ASC, wp_postmeta.meta_value ASC";
}

/**
 * Retrieve all categories
 */
function braxton_brewing_get_category() {
  $categories = array();
  foreach (get_the_category() as $category) {
    $categories[] = $category->name;
  }
  print implode(', ', $categories);
}

/**
 * Retrieves teaser image
 */
function braxton_brewing_the_teaser_image() {
  if ($thumbnail_id = get_post_thumbnail_id()) {
    $image_url = wp_get_attachment_image_src($thumbnail_id, 'third');
    print '<div class="teaser-image" style="background-image:url(' . $image_url[0] . '); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=' . $image_url[0] . ', sizingMethod=scale);"></div>';
  }
}

/**
 * Retreives the beer image
 */
function braxton_brewing_the_beer_image() {
  if ($thumbnail_id = get_post_thumbnail_id()) {
    $image_url = wp_get_attachment_image_src($thumbnail_id, 'third');
    print '<img src="' . $image_url[0] . '"/>';
  }
}


/**
 * Retrieves the event date
 */
function braxton_brewing_get_event_date() {
  date_default_timezone_set('UTC');
  print date('M j, Y', get_field('start_date'));
}

/**
 * Retrieves the event time
 */
function braxton_brewing_get_event_time() {
  date_default_timezone_set('US/Eastern');
  $start_date = get_field('start_date');
  $end_date = get_field('end_date');

  $output = '';
  if (date('a', $start_date) != date('a', $end_date)) {
    $output = date('g:i a e', $start_date) . ' - ' . date('g:i a e', $end_date);
  } else {
    $output = date('g:i e', $start_date) . ' - ' . date('g:i a e', $end_date);
  }
  print $output;
}

/**
 * Shortcode callback for retreiving the latest post
 */
function braxton_brewing_get_latest_post() {
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 1,
  );
  $latest_post = new WP_Query($args);

  $content = '';
  if ($latest_post->have_posts()) {
    while ($latest_post->have_posts()) {
      $latest_post->the_post();
      global $post;
      ob_start();
      get_template_part('templates/teaser', 'latest-post');
      $content = ob_get_contents();
      ob_end_clean();
    }
  }
  wp_reset_postdata();

  return $content;
}
add_shortcode('latest_post', 'braxton_brewing_get_latest_post');

/**
 * Shortcode callback for retreiving the latest tweet
 */
function braxton_brewing_get_latest_tweet() {
  $args = array(
    'post_type' => 'tweet',
    'posts_per_page' => 1,
  );
  $latest_tweet = new WP_Query($args);

  $content = '';
  if ($latest_tweet->have_posts()) {
    while ($latest_tweet->have_posts()) {
      $latest_tweet->the_post();
      global $post;
      ob_start();
      get_template_part('templates/teaser', 'latest-tweet');
      $content = ob_get_contents();
      ob_end_clean();
    }
  }
  wp_reset_postdata();

  return $content;
}
add_shortcode('latest_tweet', 'braxton_brewing_get_latest_tweet');

/**
 * Helper for formatting links and twitter users to real links
 */
function braxton_brewing_format_tweet($content) {
  $content = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $content);
  $content = preg_replace('/@([a-z0-9_]+)/i', '<a href="https://twitter.com/$1" target="_blank">@$1</a>', $content);
  return $content;
}

/**
 * Helper method for getting a posts featured image with optional size
 */
function braxton_brewing_get_image($size = '') {
  $attachment_id = get_post_thumbnail_id($post->id);

  if ($size) {
    $image = wp_get_attachment_image($attachment_id, $size);
  } else {
    $image = wp_get_attachment_image($attachment_id);
  }
  print $image;
}

/**
 * Social scroller
 */
function braxton_brewing_social_scroller() {
  wp_reset_postdata();

  $args = array(
    'post_type' => array('tweet', 'instagram'),
    'posts_per_page' => 90,
  );
  $results = new WP_Query($args);

  $social_items = array();
  if ($results->have_posts()) {
    while ($results->have_posts()) {
      $results->the_post();
      global $post;
      $type = get_post_type($post);

      if ($type == 'instagram') {
        $instagram =  '<div class="social-item instagram">' .
                        get_the_post_thumbnail() .
                      '</div>';
        $social_items[] = $instagram;
      } else {
        $tweet =  '<div class="social-item tweet">' .
                    '<div class="tweet-text">' . braxton_brewing_twitterify() . '</div>' .
                    '<a href="https://twitter.com/BraxtonBrewCo" target="_blank" class="tweet-braxton">@BraxtonBrewCo</a>' .
                  '</div>';
        $social_items[] = $tweet;
      }
    }
  }
  wp_reset_postdata();
  shuffle($social_items);
  $social_items = array_chunk($social_items, 30);

  $content = '';
  foreach ($social_items as $key => $items) {
    $content .= '<div id="s' . $key . '" class="social-scroller">';
    foreach ($items as $item) {
      $content .= $item;
    }
    $content .= '</div>';
  }

  print $content;
}

function braxton_brewing_twitterify() {
  $text = get_the_content();
  $text = preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" target=\"_blank\">$3</a>", $text);
  $text = preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" target=\"_blank\">$3</a>", $text);
  $text = preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);
  $text = preg_replace("/@(\w+)/", '<a href="http://www.twitter.com/$1" target="_blank">@$1</a>', $text);
  $text = preg_replace("/\#(\w+)/", '<a href="http://search.twitter.com/search?q=$1" target="_blank">#$1</a>', $text);
  return $text;
}

/**
 * Retrieves teaser image
 */
function braxton_brewing_teaser_background($size = '') {
  if ($thumbnail_id = get_post_thumbnail_id()) {
    $image_url = wp_get_attachment_image_src($thumbnail_id, $size);
    print 'style="background-image:url(' . $image_url[0] . '); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=' . $image_url[0] . ', sizingMethod=scale);"';
  }
}

function get_beer_menu($id) {
  if ($id == 6173) {
    $menuId = 6236;
  } elseif ($id == 6178) {
    $menuId = 6237;
  }

  echo get_post($menuId)->post_content;
}