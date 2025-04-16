<?php
/**
 * Config.
 *
 * The below defines can be used in wp-config.php above the wp-settings.php include.
 *
 * define( 'SJNEWS_API_URL', 'https://sjones.digital/wp-json/wp/v2/posts' );
 * define( 'SJNEWS_API_LIMIT', 3 );
 * define( 'SJNEWS_WIDGET_TITLE', 'Latest Company News' );
 * define( 'SJNEWS_EXTERNAL_LINK_URL', 'https://sjones.digital' );
 * define( 'SJNEWS_EXTERNAL_LINK_TITLE', 'Visit Website' );
 *
 * @package SJNEWS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	'api_url'       => defined( 'SJNEWS_API_URL' ) ? SJNEWS_API_URL : 'https://sjones.digital/wp-json/wp/v2/posts',
	'api_limit'     => defined( 'SJNEWS_API_LIMIT' ) ? SJNEWS_API_LIMIT : 3,
	'widget_title'  => defined( 'SJNEWS_WIDGET_TITLE' ) ? SJNEWS_WIDGET_TITLE : 'Latest Company News',
	'external_link' => [
		'url'   => defined( 'SJNEWS_EXTERNAL_LINK_URL' ) ? SJNEWS_EXTERNAL_LINK_URL : 'https://sjones.digital',
		'title' => defined( 'SJNEWS_EXTERNAL_LINK_TITLE' ) ? SJNEWS_EXTERNAL_LINK_TITLE : 'Visit Website',
	],
];
