<?php
/*
Template Name: Facebook Events Page
*/
?>
<?php
$year_range = 1;
 
// automatically adjust date range
// human readable years
$since_date = date('Y-m-d');
$until_date = date('Y-01-01', strtotime('+' . $year_range . ' years'));
 
// unix timestamp years
$since_unix_timestamp = strtotime($since_date);
$until_unix_timestamp = strtotime($until_date);
 
// or you can set a fix date range:
// $since_unix_timestamp = strtotime("2012-01-08");
// $until_unix_timestamp = strtotime("2018-06-28");

$access_token = "440960969599440|Rr3b17rT2fkrcH2kNy8eQLe-H94";

$fields="id,name,description,place,timezone,start_time,end_time,cover";
 
$fb_page_id1 = "BraxtonBrewingCompany";

$json_link1 = "https://graph.facebook.com/v2.7/{$fb_page_id1}/events/attending/?fields={$fields}&access_token={$access_token}&since={$since_unix_timestamp}&until={$until_unix_timestamp}";
 
$json1 = file_get_contents($json_link1);

$obj1 = json_decode($json1, true, 512, JSON_BIGINT_AS_STRING)['data'];

$fb_page_id2 = "BraxtonLabs";

$json_link2 = "https://graph.facebook.com/v2.7/{$fb_page_id2}/events/attending/?fields={$fields}&access_token={$access_token}&since={$since_unix_timestamp}&until={$until_unix_timestamp}";
 
$json2 = file_get_contents($json_link2);

$obj2 = json_decode($json2, true, 512, JSON_BIGINT_AS_STRING)['data'];


$obj = array_merge($obj1, $obj2);

function sortFunction($a,$b){
  if ($a['start_time'] == $b['start_time']) return 0;
  return strtotime($a['start_time']) - strtotime($b['start_time']);
}

usort($obj,"sortFunction");

$event_count = count($obj);
?>

<?php get_header(); ?>
<div class="container">
  <div class="col-md-12 content-area" id="main-column">
    <main id="main" class="site-main" role="main">
      <div id="infinite-scroll-container">
        <?php
          date_default_timezone_set('US/Eastern');
          for ($x = 0; $x < $event_count; $x++) {
            $name = $obj[$x]['name'];
            $pic_big = isset($obj[$x]['cover']['source']) ? $obj[$x]['cover']['source'] : "https://graph.facebook.com/v2.7/{$fb_page_id}/picture?type=large";
            $place_name = isset($obj[$x]['place']['name']) ? $obj[$x]['place']['name'] : "";
            $description_full = isset($obj[$x]['description']) ? $obj[$x]['description'] : "";
            $description = substr($description_full,0, 250);
            $description .= " ...";
            $start_date = date( 'l, M d, Y', strtotime($obj[$x]['start_time']));
            $start_time = date('g:i a', strtotime($obj[$x]['start_time']));
            $end_time = date('g:i a', strtotime($obj[$x]['end_time']));
            $event_id = $obj[$x]['id'];
            $event_link = "https://www.facebook.com/events/{$event_id}";

            if ($x == 0) {
              $html = "<div class='row'>";
            } elseif ($x % 3 == 0) {
              $html .= "<div class='row'>";
            }

            $html .= "<div class='col-md-4 col-sm-6'><article class='teaser event type-event status-publish has-post-thumbnail hentry'><div class='entry-container'>";

            $html .= "<a href={$event_link} target='_blank'><div class='teaser-image' style='background-image:url({$pic_big}); -ms-filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src={$pic_big}, sizingMethod=scale);'></div></a>";

            $html .= "<div class='entry-info'><h3 class='entry-title'><a href={$event_link} rel='bookmark'  target='_blank'>{$name}</a></h3><div class='entry-location'>{$place_name}</div><div class='entry-content'>{$description}</div></div>";

            $html .= "<footer><div class='entry-meta row'><span class='entry-date col-sm-6 col-xs-12'>{$start_date}</span><span class='entry-time col-sm-6 col-xs-12'>{$start_time} - {$end_time}</span></div><div class='row'><a href={$event_link} rel='bookmark'  target='_blank'>Learn More</a></div></footer>";

            $html .= "</div></article></div>";

            if ($x % 3 == 2) {
              $html .= "</div>";
            }
          }

          echo $html;   
        ?>
      </div>
    </main>
    <div class="text-center" style="padding-top: 30px;">
      <a href id="eventButton" class="btn btn-default">Book an Event</a>
    </div>
    <script type="text-javascript" src="https://gatherhere.com/js/leadform.js" id="gather-loader" data-locationid="s9kbc22c" data-trigger="eventButton"></script>
  </div>
</div>
<?php get_footer(); ?>