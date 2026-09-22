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
 *
 * @package Anbarli_RSS_Featured_Image
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'ANBARLI_RSS_FEATURED_IMAGE_FILE' ) ) {
	define( 'ANBARLI_RSS_FEATURED_IMAGE_FILE', __FILE__ );
}

require_once __DIR__ . '/includes/class-anbarli-rss-featured-image.php';

new Anbarli_RSS_Featured_Image();
