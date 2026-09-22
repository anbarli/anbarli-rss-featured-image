<?php
/**
 * Plugin Name: Anbarli RSS Featured Image
 * Plugin URI:  https://anbarli.com.tr
 * Description: Adds each post's featured image to the WordPress RSS feed as a Media RSS media:content tag.
 * Version:     1.0.0
 * Author:      Gurkan Anbarli
 * Author URI:  https://anbarli.com.tr
 * Text Domain: anbarli-rss-featured-image
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Anbarli_RSS_Featured_Image' ) ) {
	/**
	 * Adds WordPress featured images to RSS feeds as Media RSS elements.
	 */
	final class Anbarli_RSS_Featured_Image {
		/**
		 * Register WordPress hooks.
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'load_textdomain' ) );
			add_action( 'rss2_ns', array( $this, 'add_media_namespace' ) );
			add_action( 'rss2_item', array( $this, 'add_featured_image' ) );
		}

		/**
		 * Load translations, if available.
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'anbarli-rss-featured-image', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Add the Media RSS namespace to the RSS element.
		 */
		public function add_media_namespace() {
			echo 'xmlns:media="http://search.yahoo.com/mrss/"' . "\n";
		}

		/**
		 * Output a media:content element for the current post featured image.
		 */
		public function add_featured_image() {
			global $post;

			if ( empty( $post ) || ! isset( $post->ID ) || ! has_post_thumbnail( $post->ID ) ) {
				return;
			}

			/**
			 * Filters the image size used in RSS media:content output.
			 *
			 * @param string $size WordPress image size name.
			 */
			$size     = apply_filters( 'anbarli_rss_image_size', 'large' );
			$thumb_id = get_post_thumbnail_id( $post->ID );
			$src_data = wp_get_attachment_image_src( $thumb_id, $size );

			$url    = is_array( $src_data ) ? $src_data[0] : get_the_post_thumbnail_url( $post->ID, $size );
			$width  = is_array( $src_data ) && isset( $src_data[1] ) ? (int) $src_data[1] : 0;
			$height = is_array( $src_data ) && isset( $src_data[2] ) ? (int) $src_data[2] : 0;

			if ( empty( $url ) ) {
				return;
			}

			$mime = get_post_mime_type( $thumb_id );
			if ( empty( $mime ) ) {
				$mime = 'image/jpeg';
			}

			printf(
				"\t<media:content url=\"%s\" medium=\"image\" type=\"%s\"%s%s />\n",
				esc_url( $url ),
				esc_attr( $mime ),
				$width ? ' width="' . esc_attr( $width ) . '"' : '',
				$height ? ' height="' . esc_attr( $height ) . '"' : ''
			);

			/**
			 * Filters whether an RSS enclosure tag should also be added.
			 *
			 * @param bool $add_enclosure Whether to print an enclosure element.
			 */
			$add_enclosure = apply_filters( 'anbarli_rss_add_enclosure', false );
			if ( $add_enclosure ) {
				printf( "\t<enclosure url=\"%s\" type=\"%s\" />\n", esc_url( $url ), esc_attr( $mime ) );
			}
		}
	}
}

new Anbarli_RSS_Featured_Image();
