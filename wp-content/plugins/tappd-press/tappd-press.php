<?php
/**
 * Plugin Name:     Tappd Press for Business
 * Plugin URI:      https://bluepandastudios.com/wp-plugins/tappd_press_for_business
 * Description:     A plugin to display data from Untappd for Business
 * Author:          Blue Panda Studios
 * Author URI:      https://bluepandastudios.com/
 * Text Domain:     tappd-press-for-business
 * Domain Path:     /languages
 * Version:         0.1.7
 *
 * @package         Tappd_Press_for_Business
 *
 * Tappd Press for Business is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Tappd Press for Business is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tappd Press for Business. If not, see {License URI}.
 */


function tpfb_activate()
{
    update_option("tpfb_api_key", "");
    update_option("tpfb_email_address", "");
}

function tpfb_deactivate()
{
    delete_option("tpfb_api_key");
    delete_option("tpfb_email_address");
    delete_transient('tpfb_api_menu_data');
    delete_transient('tpfb_api_event_data');

}

function tpfb_display_options_form()
{
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options-general.php?page=tpfb" method="post">
            <?php
            wp_nonce_field();
            // output security fields for the registered setting "tpfb_options"
            settings_fields('tpfb_options');
            // output setting sections and their fields
            // (sections are registered for "tpfb", each field is registered to a specific section)
            do_settings_sections('tpfb');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

function tpfb_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <?php
    if (isset($_POST['tpfb_email_address']) && ($_POST['tpfb_api_key'])) {
        //Form data sent
        $tpfb_email_address = sanitize_email($_POST['tpfb_email_address']);
        $tpfb_api_key = sanitize_text_field($_POST['tpfb_api_key']);
        if ( is_email($tpfb_email_address) ) {
            update_option('tpfb_email_address', $tpfb_email_address);
            update_option('tpfb_api_key', $tpfb_api_key);
            delete_transient('tpfb_api_menu_data');
            delete_transient('tpfb_api_event_data');
            ?>
            <div class="updated"><p><strong>Options saved.</strong></p></div>
            <?php
        }
    }
    tpfb_display_options_form();
}

function tpfb_options_page()
{
    add_options_page(
        'Tappd Press for Business Settings',
        'Tappd Press for Business',
        'manage_options',
        'tpfb',
        'tpfb_options_page_html'
    );
}

function tpfb_settings_init()
{
    // register a new setting for "tappd press for business" page
    register_setting('tpfb', 'tpfb_api_key');
    register_setting('tpfb', 'tpfb_email_address');

    // register a new section in the "tappd press for business" page
    add_settings_section(
        'tpfb_settings_section',
        'API Settings',
        'tpfb_settings_section_cb',
        'tpfb'
    );

    add_settings_field(
        'tpfb_email_address',
        'Email Address',
        'tpfb_email_address_cb',
        'tpfb',
        'tpfb_settings_section',
        array('label_for' => 'tpfb_email_address')
    );

    add_settings_field(
        'tpfb_api_key',
        'API Key',
        'tpfb_api_key_cb',
        'tpfb',
        'tpfb_settings_section',
        array('label_for' => 'tpfb_api_key')
    );

}

function tpfb_settings_section_cb()
{
    echo '<p>Below, please enter the email address you use for Untappd for Business along with your
            <em><strong>read-only</strong></em> API key.
            You can find your API key <a href="https://business.untappd.com/api_tokens"
            title="View your Untappd For Business API key" target="blank">here</a></p>';
}

function tpfb_api_key_cb()
{
    // get the value of the setting we've registered with register_setting()
    $tpfb_api_key = esc_attr(get_option('tpfb_api_key'));
    update_option("tpfb_api_key", sanitize_text_field($tpfb_api_key));
    // output the field
    ?>
    <input size=40 type="text" name="tpfb_api_key"
           value="<?= isset($tpfb_api_key) ? esc_attr($tpfb_api_key) : ''; ?>">
    <?php
}

function tpfb_email_address_cb()
{
    // get the value of the setting we've registered with register_setting()
    $tpfb_email_address = esc_attr(get_option('tpfb_email_address'));
    update_option("tpfb_email_address", sanitize_email($tpfb_email_address));
    // output the field
    ?>
    <input size=40 type="text" name="tpfb_email_address"
           value="<?= isset($tpfb_email_address) ? esc_attr($tpfb_email_address) : ''; ?>">
    <?php
}

function tpfb_get_api_data($url, $email_address, $api_key)
{

    $curl_session = curl_init();
    curl_setopt($curl_session, CURLOPT_USERPWD, $email_address . ":" . $api_key);

    curl_setopt($curl_session, CURLOPT_URL, esc_url($url));
    curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl_session);
    curl_close($curl_session);
    return sanitize_text_field($data);

}

function tpfb_create_section_html($data, $sections, $timezone)
{
    $output = "";
    if (is_array($sections)) {
        foreach ($data->sections->section as $section) {
            $update_time = new DateTime($section->updated_at);
            $update_time->setTimezone($timezone);
            $output .= '<div class="last_updated">Last updated on ' . $update_time->format("F j, Y @ g:i A" . "\n") . '</div>';
            $output .= '<div class="beer-list">';
            foreach ($section->items as $item) {
                $output .= '<div class="beer-entry">';
                $output .= '<div class="beer-logo"><img src="'. $item->label_image . '" alt="'. "{$item->brewery} {$item->name}" . '"></div>';
                $output .= '<div class="beer-text">';
                $output .= '<div class="beer-name">' . $item->name . '</div>';
                $output .= '<div class="beer-facts"><div class="beer-style">' . $item->style . '</div></div>';
                $output .= '<div class="beer-facts"><div class="beer-abv">' . $item->abv . '% ABV</div><div class="beer-ibu">' . $item->ibu . ' IBU</div></div>';
                $output .= '<div class="beer-facts"><div class="brewery-name"> ' . $item->brewery . '</div><div class="brewery-area"> ' . $item->brewery_location . '</div></div>';
                $output .= '<div class="beer-facts"><div class="beer-description"> ' . $item->description . '</div></div>';
                $output .= '</div>'; #closing for beer-text
                $output .= '</div>'; #closing for beer-entry
            }
            $output .= '</div>'; #closing for beer-list

        }
        return $output;
    } else {
        $section = $data->menu->sections[0];
        $update_time = new DateTime($section->updated_at);
        $update_time->setTimezone($timezone);
        $output .= '<div class="last_updated">Last updated on ' . $update_time->format("F j, Y @ g:i A" . "\n") . '</div>';
        $output .= '<div class="beer-list">';
        foreach ($section->items as $item) {
            $output .= '<div class="beer-entry">';
            $output .= '<div class="beer-logo"><img src="'. $item->label_image . '" alt="'. "{$item->brewery} {$item->name}" . '"></div>';
            $output .= '<div class="beer-text">';
            $output .= '<div class="beer-name">' . $item->name . '</div>';
            $output .= '<div class="beer-facts"><div class="beer-style">' . $item->style . '</div></div>';
            $output .= '<div class="beer-facts"><div class="beer-abv">' . $item->abv . '% ABV</div><div class="beer-ibu">' . $item->ibu . ' IBU</div></div>';
            $output .= '<div class="beer-facts"><div class="brewery-name"> ' . $item->brewery . '</div><div class="brewery-area"> ' . $item->brewery_location . '</div></div>';
            $output .= '<div class="beer-facts"><div class="beer-description"> ' . $item->description . '</div></div>';
            $output .= '</div>'; #closing for beer-text
            $output .= '</div>'; #closing for beer-entry
        }
        $output .= '</div>'; #closing for beer-list

    }
    return $output;
}

function tpfb_create_beer_html($data, $sections)
{
    $local_timezone = new DateTimeZone('America/New_York');
    global $output;
    $output = '<div class="menu_name"><h2>' . $data->menu->name . '</h2>';
    if ($sections == '') {
        $output .= tpfb_create_section_html($data, $sections, $local_timezone);
    } else {
        foreach ($sections->section as $section) {
            $output .= tpfb_create_section_html($data, $section, $local_timezone);
        }
    }
    return $output;
}

function tpfb_create_event_html($data){
    $local_timezone = new DateTimeZone('America/New_York');
    global $output;
    $output = '<div class="last-updated"><h2></h2>';
    $update_time = new DateTime($data->updated_at);
    $update_time->setTimezone($local_timezone);
    $output .= '<div class="last_updated">Updated ' . $update_time->format('F j \a\t g:iA T' . "\n") . '</div>';
    $output .= '<div class="event-list">';

    foreach ( $data->events as $event ){
        if ( strtotime($event->start_time) > strtotime('now')){
            $start_time = new DateTime($event->start_time);
            $end_time = new DateTime($event->end_time);
            $start_time->setTimezone($local_timezone);
            $end_time->setTimezone($local_timezone);
            $output .= '<div class="event-entry">';
            $output .= '<div class="event-title">' . $event->name . "</div>";
            $output .= '<div class="event-date-and-time">';
            $output .= '<div class="event-date">' . $start_time->format("l, F j, Y") . '</div>';
            $output .= '<div class="event-time">' . $start_time->format("g:i A") . ' - ' . $end_time->format("g:i A"). "</div>";
            $output .= '</div>';
            $output .= '<div class="event-description">' . $event->description . '</div>';
            $output .= '</div>';
        }
    }
    $output .= '</div>';
    return $output;
}

function tpfb_get_beer_menu_data($atts)
{
    $args = shortcode_atts(array(
        'menu_id' => null,
        'sections' => null
    ), $atts);

    # Set some variables
    $api_url_base = 'https://business.untappd.com';
    $api_version_base = '/api/v1';
    $email_address = sanitize_email(get_option('tpfb_email_address'));
    $api_key = sanitize_text_field(get_option('tpfb_api_key'));
    $url = esc_url($api_url_base . $api_version_base . '/menus/' . $args['menu_id'] . '?full=true');


    # Get our cached api data, if it exists, if not, call our get_api_data function to get it, then store it in cache
    if ( false === ( $data = get_transient( 'tpfb_api_menu_data' . $args['menu_id'] ) ) ) {
        // this code runs when there is no valid transient set
        $data = tpfb_get_api_data($url, $email_address, $api_key);
        set_transient( 'tpfb_api_menu_data' . $args['menu_id'], $data, 15 * MINUTE_IN_SECONDS);
    }

    if ($data) {
        $json_data = json_decode($data);
        $output = tpfb_create_beer_html($json_data, $args['sections']);
    } else {
        $output = "<h4>Sorry, we're having trouble loading information from untappd.com at the moment.</h4><br>";
    }
    return wp_kses_post($output);
}

function tpfb_get_event_data($atts){
    $args = shortcode_atts(array(
        'location_id' => null
    ), $atts);
    $api_url_base = 'https://business.untappd.com';
    $api_version_base = '/api/v1';
    $email_address = sanitize_email(get_option('tpfb_email_address'));
    $api_key = sanitize_text_field(get_option('tpfb_api_key'));
    $url = esc_url($api_url_base . $api_version_base . '/locations/' . $args['location_id'] . '/events');

    # Get our cached api data, if it exists, if not, call our tpfb_get_api_data function to get it, then store it in cache
    if ( false === ( $data = get_transient( 'tpfb_api_event_data' . $args['location_id']) ) ) {
        $data = tpfb_get_api_data($url, $email_address, $api_key);
        set_transient( 'tpfb_api_event_data' . $args['location_id'], $data, 15 * MINUTE_IN_SECONDS );
    }

    if ($data) {
        $json_data = json_decode($data);
        $output = tpfb_create_event_html($json_data);
    } else {
        $output = "<h4>Sorry, we're having trouble loading information from untappd.com at the moment.</h4><br>";
    }
    return wp_kses_post($output);
}

register_activation_hook(__FILE__, 'tpfb_activate');

add_action('admin_init', 'tpfb_settings_init');
add_action('admin_menu', 'tpfb_options_page');

add_shortcode('tappd-press-menu', 'tpfb_get_beer_menu_data');
add_shortcode('tappd-press-events', 'tpfb_get_event_data');

