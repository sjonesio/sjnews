<?php
/**
 * Get and cache articles.
 *
 * @package SJNEWS
 */

namespace SJNEWS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Articles
 *
 * Gets and caches the articles from the set Rest API url.
 */
class Articles {

	/**
	 * Configuration array.
	 *
	 * @var array
	 */
	protected static $config;

	/**
	 * Constructor.
	 */
	public function __construct() {
		self::$config = include SJNEWS_PLUGIN_DIR . 'class-config.php';
	}

	/**
	 * Cache articles in transients.
	 *
	 * @return array
	 */
	public static function sjnews_get_articles() {

		// Load the config file if not already.
		if ( empty( self::$config ) ) {
			new self();
		}

		$api_url   = isset( self::$config['api_url'] ) ? esc_url( self::$config['api_url'] ) : '';
		$api_limit = isset( self::$config['api_limit'] ) ? intval( self::$config['api_limit'] ) : '';

		$articles_url = add_query_arg( array( 'per_page' => $api_limit ), $api_url );

		$cache_key = 'sjnews_api_' . md5( $articles_url );
		$cached    = get_transient( $cache_key );

		if ( $cached ) {
			return $cached;
		}

		// If no cached version exists, get articles from the API.
		$articles = self::sjnews_get_articles_from_api( $articles_url );

		// If getting articles failed, don't cache.
		if ( empty( $articles ) ) {
			return array();
		}

		// Get only required article fields: title, date, and link.
		$articles_clean = array_map(
			function( $article ) {
				return [
					'title' => isset( $article->title ) ? $article->title : '',
					'date'  => isset( $article->date ) ? $article->date : '',
					'link'  => isset( $article->link ) ? $article->link : '',
				];
			},
			$articles
		);

		// If successful then cache the articles for 15 minutes.
		set_transient( $cache_key, $articles_clean, 15 * MINUTE_IN_SECONDS );

		return $articles_clean;
	}

	/**
	 * Get articles from the API URL provided.
	 *
	 * @param string $articles_url The Articles API URL.
	 * @return array
	 */
	private static function sjnews_get_articles_from_api( $articles_url ) {

		// Check if the Articles URL is valid.
		if ( ! filter_var( $articles_url, FILTER_VALIDATE_URL ) ) {
			return array();
		}

		$response = wp_remote_get( $articles_url );

		// If getting articles failed, don't cache.
		if ( is_wp_error( $response ) ) {
			return array();
		}

		$news     = wp_remote_retrieve_body( $response );
		$articles = json_decode( $news );

		// Check if articles are empty or not a valid array.
		if ( empty( $articles ) || ! is_array( $articles ) ) {
			return array();
		}

		return $articles;
	}

}
