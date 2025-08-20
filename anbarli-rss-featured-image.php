<?php
/**
 * Plugin Name: Anbarlı RSS Featured Image
 * Plugin URI:  https://anbarli.com.tr
 * Description: Yazıların öne çıkarılan görsellerini RSS beslemesine media:content olarak ekler (MRSS). Adds each post's featured image to the RSS feed as media:content.
 * Version:     1.0.0
 * Author:      Gürkan Anbarlı
 * Author URI:  https://anbarli.com.tr
 * Text Domain: anbarli-rss-featured-image
 * Domain Path: /languages
 * Requires PHP: 7.4
 * License:     MIT
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Anbarli_RSS_Featured_Image' ) ) {

    final class Anbarli_RSS_Featured_Image {

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
         * Add Media RSS namespace to the <rss> element.
         * Outputs something like: xmlns:media="http://search.yahoo.com/mrss/"
         */
        public function add_media_namespace() {
            echo 'xmlns:media="http://search.yahoo.com/mrss/"' . "\n";
        }

        /**
         * Output <media:content> for the featured image of each item.
         * Allows overriding the size via the 'anbarli_rss_image_size' filter.
         */
        public function add_featured_image() {
            global $post;

            if ( empty( $post ) || ! isset( $post->ID ) ) {
                return;
            }

            if ( ! has_post_thumbnail( $post->ID ) ) {
                return;
            }

            $size = apply_filters( 'anbarli_rss_image_size', 'large' );
            $thumb_id = get_post_thumbnail_id( $post->ID );

            // Try to get src, width, height via wp_get_attachment_image_src
            $src_data = wp_get_attachment_image_src( $thumb_id, $size );
            $url = is_array( $src_data ) ? $src_data[0] : get_the_post_thumbnail_url( $post->ID, $size );
            $width  = is_array( $src_data ) && isset( $src_data[1] ) ? intval( $src_data[1] ) : 0;
            $height = is_array( $src_data ) && isset( $src_data[2] ) ? intval( $src_data[2] ) : 0;

            if ( empty( $url ) ) {
                return;
            }

            $mime = get_post_mime_type( $thumb_id );
            if ( empty( $mime ) ) {
                // Sensible default if mime type isn't available.
                $mime = 'image/jpeg';
            }

            // Print a <media:content> element per MRSS spec.
            // Example:
            // <media:content url="https://example.com/image.jpg" medium="image" type="image/jpeg" width="1200" height="630" />
            echo sprintf(
                "\t<media:content url=\"%s\" medium=\"image\" type=\"%s\"%s%s />\n",
                esc_url( $url ),
                esc_attr( $mime ),
                $width  ? ' width="' . esc_attr( $width ) . '"' : '',
                $height ? ' height="' . esc_attr( $height ) . '"' : ''
            );

            /**
             * Optional: Also add enclosure for older readers, behind a filter flag.
             * Disabled by default.
             */
            $add_enclosure = apply_filters( 'anbarli_rss_add_enclosure', false );
            if ( $add_enclosure ) {
                echo sprintf( "\t<enclosure url=\"%s\" type=\"%s\" />\n", esc_url( $url ), esc_attr( $mime ) );
            }
        }
    }
}

new Anbarli_RSS_Featured_Image();