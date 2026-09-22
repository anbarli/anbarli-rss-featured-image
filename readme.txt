=== Anbarli RSS Featured Image ===
Contributors: anbarli
Tags: rss, rss feed, featured image, media rss, wordpress rss
Requires at least: 5.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: MIT
License URI: https://opensource.org/licenses/MIT

Adds each post's featured image to the WordPress RSS feed as a Media RSS media:content tag.

== Description ==

Anbarli RSS Featured Image is a small WordPress plugin that adds each post's featured image to RSS 2.0 feed items using the Media RSS `media:content` tag.

This is useful for RSS readers, content aggregators, newsletter tools, and Mailchimp RSS campaigns that need a direct image URL in the feed.

Features:

* Adds `media:content` for posts with a featured image.
* Adds the Media RSS namespace automatically.
* Supports configurable image size with a developer filter.
* Supports optional RSS enclosure output.
* Runs without an admin settings page.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/anbarli-rss-featured-image`.
2. Confirm this file exists: `/wp-content/plugins/anbarli-rss-featured-image/anbarli-rss-featured-image.php`.
3. Activate the plugin through the Plugins screen in WordPress.
4. Open your RSS feed, usually `/feed/`.
5. Search the feed source for `media:content`.

== Frequently Asked Questions ==

= Does this plugin require settings? =

No. Activate it and it starts adding featured images to RSS feed items.

= How do I change the image size? =

Use the `anbarli_rss_image_size` filter:

`add_filter( 'anbarli_rss_image_size', fn() => 'full' );`

= Can I add an enclosure tag too? =

Yes. Enable it with:

`add_filter( 'anbarli_rss_add_enclosure', '__return_true' );`

= Why are images missing in a feed reader? =

Confirm that the post has a featured image and that `media:content` appears in the raw feed source. Some readers ignore Media RSS and use Open Graph image metadata from the article page instead.

= WordPress says the plugin file does not exist. What should I check? =

Confirm the plugin is installed at `/wp-content/plugins/anbarli-rss-featured-image/anbarli-rss-featured-image.php`. If the folder was renamed, deleted, or extracted from a ZIP with a suffix such as `-main`, deactivate the missing plugin entry, remove the incomplete folder, upload the full plugin folder again, and activate it.

== Changelog ==

= 1.0.0 =
* Initial release.
