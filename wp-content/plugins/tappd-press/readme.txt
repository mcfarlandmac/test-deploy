=== Tappd Press for Business ===
Contributors: bluepandastudios
Donate link: https://bluepandastudios.com/donate/
Tags: untappd, untappd for business
Requires at least: 4.6
Tested up to: 4.7.2
Stable tag: 0.1.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Tappd Press for Business adds shortcodes to display menu data and event data from the Untappd for Business API.

== Description ==

Tappd Press for Business is designed to allow users of Untappd for Business to easily display their menu and event data
via the provided shortcodes. Tappd Press for Business uses the Untappd for Business API to seamlessly integrate your
menu and  event data into your website.

Unlike the standard Untappd for Business Wordpress Plugin, Tappd Press for Business is a standalone plugin. This means
that it doesn't require installing any third-party plugin packs such as JetPack.

Additionally, Tappd Press for Business allows you to display only the sections of your menus you want, as well as
separating your menu and event displays.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/tappd-press` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Enter the email address and read-only API key from your Untappd for Business account in the Settings -> Untappd Press screen to configure the plugin
1. To use the menu shortcode insert the menu shortcode, including a menu id, into a page, post, widget, etc.
  * **Example**: `[tappd-press-menu menu_id=XXXX]` where "XXXX" is the menu id.
1. To use the event shortcode insert the event shorcode, including a location id, into a page, post, widget, etc.
  * **Example**: `[tappd-press-events location_id=XXXX]` where "XXXX" is the location id you want to display events for.

== Frequently asked questions ==

= How do I use the shortcodes? =

This plugin adds two shortcodes, which can be used in pages or posts.

* [tappd-press-menu]
* [tappd-press-events]

The [tappd-press-menu] shortcode takes a menu_id parameter which corresponds to the menu ID of the menu you want to display. By default the menu will show the first section of the menu.
**Example**: `[tappd-press-menu menu_id=XXXX]`

The [tappd-press-events] shortcode takes a location_id parameter which corresponds to the location ID of the venue you want to display events for.
**Example**: `[tappd-press-events location_id=XXXX]`

= The menu has been updated on Untappd, but it hasn't updated on the site. Why not? =
We cache the Untappd API data for fifteen minutes in order to reduce load on the Untappd API servers and to avoid having to load the data with each page load.
To refresh the cache, click **Save Settings** in the Tappd Press for Business settings page. This will refresh the cached data.

= I've entered the email and API key, but I'm still not seeing data! What's wrong? =
A few things to try:

* Double-check that you're using the correct email and API key.
* Ensure that you've enabled the curl extension for PHP installation. If you're not sure how to check / do this, Google is your friend.
* Make sure the menu in question has been published.

== Changelog ==

= 0.1.7 =
Added new FAQs based on user feedback.

= 0.1.6 =
Added support for multiple instances of the menu and event shortcodes.

= 0.1.5 =
Fixed menu repetition error.

= 0.1.4 =
Fixed name of shortcode, it should be [tappd-press-menu] and [tappd-press-events]

= 0.1.3 =
Updated readme / installation / usage instructions

= 0.1.2 =
First public release

= 0.1.0 =
Initial release

