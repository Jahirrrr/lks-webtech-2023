=== Custom Login ===
Contributors: BinaryMoon
Tags: customise, customize, login, customisation, customization, admin
Requires at least: 4.7
Tested up to: 6.2.0
Stable Tag: 2.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Customise the WordPress login box quickly and easily

== Description ==

A simple way to customise the login screen on your WordPress install. There are a number of advantages to using this plugin:

1. Using a plugin means the changes stay when you upgrade
1. It's an easy way to add a little polish to your freelance web design jobs

There is a flickr group for showing off your custom logins, or for getting inspiration for your own creations. You can see it on flickr - http://www.flickr.com/groups/bm-custom-login/

If you're in the market for a WordPress theme then you could check out my Premium GPL WordPress themes site here: http://prothemedesign.com/

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the entire contents of the zip file to your plugin directory '/wp-content/plugins/'
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Create a background image and then upload that to your website as well
1. Go to the plugins options page in the WordPress admin ('Settings' -> 'Custom Login') and enter the url for you login background image
1. Change the colors as you desire
1. Press save
1. Bask in the glory of your beautiful new login screen

== Changelog ==

= 2.3.2 - 14th July 2021 =
* Fix errant comma that caused a 500 error on some servers.

= 2.3.1 - 13th July 2021 =
* Fix PHP error for missing settings.

= 2.3 - 3rd January 2021 =
* Display the 'powered by' text underneath the login form to ensure it is visible. It can be targetted with css using `.cl-powered-by`.

= 2.2.5 - 17th June 2020 =
* Fix implode parameter order.

= 2.2.4 - 5th March 2020 =
* Update CSSTidy to latest version.

= 2.2.3 - August 23rd 2019 =
* Switch to submit_button function for settings form.

= 2.2.2 - April 23rd 2019 =
* Replace deprecated filter.
* Update coding standards.

= 2.2.1 - December 1st 2017 =
* Remove text shadow on login button so that it's more consistently readable.
* Make it clearer what the text link colour changes.
* Change CSS label to match the core customizer label.
* Remove CSS vendor prefixes that are no longer needed.

= 2.2 - November 30th 2017 =
* Fix default colour values so that the default button works properly
* Fix PHP 7 warnings in CSSTidy
* Sanitize more things for extra security

= 2.1 =
* Make translations work properly. Improve coding standards (again :))

= 2.0 =
* Fix coding standards and improve security

= 1.9 =
* Update the localization strings so that the new language pack system will be able to translate the plugin

= 1.8.2 =
* Stop color picker from being loaded on every page in the admin - thanks to mgsisk for the report and code fix

= 1.8.1 =
* Update CSS Tidy files to latest version

= 1.8 =
* New Feature: Custom CSS - now you can edit everything! :)

= 1.7.4 =
* make link colour affect login button to ensure things remain harmonious

= 1.7.3 =
* improve sanitization/ security throughout

= 1.7.2 =
* encode footer html properly so that html actually works - and is safe

= 1.7.1 =
* make plugin path more flexible for people who move wp-content directory

= 1.7 =
* improve security, and massively improve the admin page

= 1.6.5 =
* add a shadow colour option, improve login url support, change admin footer text

= 1.6 =
* Add a background image for the main body of the site

= 1.5.1 =
* Some tweaks to the login layout

= 1.5 =
* A total rewrite with a new options screen, and a redesigned page login layout

= 1.4 =
* Old old old, needs updating
