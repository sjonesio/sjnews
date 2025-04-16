<?php
/**
 * Dashboard Widget output.
 *
 * @package SJNEWS
 */

namespace SJNEWS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Dashboard
 *
 * Outputs the Dashboard Widget in WP Admin.
 */
class Dashboard {

	/**
	 * Configuration array.
	 *
	 * @var array
	 */
	protected $config;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->config = include SJNEWS_PLUGIN_DIR . 'config.php';

		add_action( 'wp_dashboard_setup', array( $this, 'sjnews_add_dashboard_widget' ) );
	}

	/**
	 * Register the Dashboard Widget.
	 */
	public function sjnews_add_dashboard_widget() {
		$title = isset( $this->config['widget_title'] ) ? esc_html( $this->config['widget_title'] ) : '';

		wp_add_dashboard_widget(
			'sjnews_dashboard_widget',
			esc_html( $title ),
			array( $this, 'sjnews_output_dashboard_widget' )
		);
	}

	/**
	 * Output the Dashboard Widget contents.
	 */
	public function sjnews_output_dashboard_widget() {
		$articles = Articles::sjnews_get_articles();

		// If no articles found.
		if ( empty( $articles ) ) {
			echo '<p>' . esc_html__( 'No articles found.', 'sjnews' ) . '</p>';
			return;
		}

		// Loop through articles and output.
		echo '<ul class="sjnews__article-items">';
		foreach ( $articles as $article ) {
			$title = isset( $article['title']->rendered ) ? esc_html( $article['title']->rendered ) : '';
			$link  = isset( $article['link'] ) ? esc_url( $article['link'] ) : '#';
			$date  = isset( $article['date'] ) ? esc_html( gmdate( 'F j, Y', strtotime( $article['date'] ) ) ) : '';

			echo '<li>';
			echo '<a href="' . esc_url( $link ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $title ) . '</a>';
			if ( $date ) {
				echo '<br /><small>' . esc_html( $date ) . '</small>';
			}
			echo '</li>';
		}
		echo '</ul>';

		// Add a button and link below articles as a CTA.
		$external_link  = isset( $this->config['external_link']['url'] ) ? esc_url( $this->config['external_link']['url'] ) : '';
		$external_title = isset( $this->config['external_link']['title'] ) ? esc_html( $this->config['external_link']['title'] ) : '';

		if ( ! empty( $external_link ) && ! empty( $external_title ) ) {
			echo '<p>
					<a href="' . esc_url( $external_link ) . '" class="button button-primary" target="_blank" rel="noopener noreferrer">'
						. esc_html( $external_title ) . '<span class="screen-reader-text"> (opens in a new tab)</span>
					</a>
				 </p>';
		}
	}
}
