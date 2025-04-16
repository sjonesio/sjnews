=== SJ News ===

Contributors: sjonesio
Donate link: https://sjones.digital
Tags: dashboard news, welcome news, company news
Tested up to: 6.8
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds your own news feed to the Dashboard of WP Admin. Great for freelancers and agencies.


== Description ==

SJ News adds your own news feed to the Dashboard of WP Admin. It's great for freelancers and agencies who specifically handle maintenance and support as it keeps your clients updated with your latest news and information.

Currently it checks for updates every 15 minutes and caches the results. If there is an error such as if your news website goes down then it won't overwrite the valid cached version.

The API URL must be a valid wp-json URL for your posts, e.g. https://sjones.digital/wp-json/wp/v2/posts

There is no Admin Options page, but you can configure everything from your wp-config.php file by adding the following before:
/* That's all, stop editing! Happy publishing. */

E.g.

define( 'SJNEWS_API_URL', 'https://sjones.digital/wp-json/wp/v2/posts' );
define( 'SJNEWS_API_LIMIT', 3 );
define( 'SJNEWS_WIDGET_TITLE', 'Latest Company News' );
define( 'SJNEWS_EXTERNAL_LINK_URL', 'https://sjones.digital' );
define( 'SJNEWS_EXTERNAL_LINK_TITLE', 'Visit Website' );
/* That's all, stop editing! Happy publishing. */


== Installation ==

If downloading from github then you will need to unzip the file and rename the folder to sjnews before moving it to your plugins directory.


== Changelog ==

= 1.0.0 =

Start of plugin.