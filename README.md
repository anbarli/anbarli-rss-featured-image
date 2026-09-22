# Anbarli RSS Featured Image

Add WordPress featured images to RSS feeds as Media RSS `<media:content>` tags. Useful for RSS readers, aggregators, newsletters, and Mailchimp RSS campaigns.

![PHP](https://img.shields.io/badge/PHP-7.4%2B-777bb4)
![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-21759b)
![License](https://img.shields.io/badge/license-MIT-green)

## Why

WordPress RSS feeds do not always expose the post featured image in a way that feed readers, newsletter tools, or content syndication workflows can consume directly. This plugin adds the featured image to each RSS item using the Media RSS standard.

## Example Output

After activation, posts with a featured image include:

```xml
<media:content url="https://example.com/uploads/featured.jpg" medium="image" type="image/jpeg" width="1200" height="630" />
```

You can also enable a classic RSS `<enclosure>` tag for older readers:

```xml
<enclosure url="https://example.com/uploads/featured.jpg" type="image/jpeg" />
```

See [examples/feed-before.xml](examples/feed-before.xml) and [examples/feed-after.xml](examples/feed-after.xml) for a complete before/after feed sample.

## Features

- Adds each post's featured image to RSS 2.0 feed items as `<media:content>`.
- Adds the `xmlns:media="http://search.yahoo.com/mrss/"` namespace automatically.
- Uses the WordPress attachment URL, MIME type, width, and height when available.
- Lets developers change the image size with a filter.
- Supports optional RSS enclosure output for legacy feed consumers.
- Runs without an admin settings page.

## Requirements

- WordPress 5.0 or newer
- PHP 7.4 or newer
- Posts must have featured images assigned
- Theme should support post thumbnails

```php
add_theme_support( 'post-thumbnails' );
```

## Installation

### WordPress Admin Upload

1. Download the repository as a ZIP file.
2. In WordPress, go to **Plugins > Add New > Upload Plugin**.
3. Upload the ZIP file.
4. Activate **Anbarli RSS Featured Image**.
5. Open `https://example.com/feed/` and inspect the RSS source.

### Manual Install

1. Copy this folder to `wp-content/plugins/anbarli-rss-featured-image`.
2. Activate the plugin from the WordPress admin panel.
3. Visit your RSS feed and look for `<media:content>`.

### Git Install

```bash
cd wp-content/plugins
git clone https://github.com/anbarli/anbarli-rss-featured-image.git
```

Then activate the plugin in WordPress.

## Quick Start

Install and activate the plugin. No settings are required.

Check your feed:

```text
https://example.com/feed/
```

Search the feed source for:

```xml
<media:content
```

## Configuration

### Change RSS Image Size

The default image size is `large`. You can change it from your theme or another plugin:

```php
add_filter( 'anbarli_rss_image_size', function ( $size ) {
    return 'full';
} );
```

Supported values include WordPress image sizes such as `thumbnail`, `medium`, `large`, `full`, or any custom image size registered with `add_image_size()`.

### Enable Enclosure Output

By default, the plugin only outputs Media RSS. Enable enclosure output when a feed consumer needs it:

```php
add_filter( 'anbarli_rss_add_enclosure', '__return_true' );
```

## Compatibility Notes

- Media RSS is commonly used by RSS readers, aggregators, and newsletter workflows.
- Some modern readers may still prefer Open Graph image metadata from the article page.
- If a specific reader does not show images, inspect both the RSS output and the article's `og:image` metadata.
- This plugin does not modify post content or add visible HTML to feed descriptions.

## Troubleshooting

### Images do not appear in the feed

- Confirm the post has a featured image.
- Confirm the active theme supports post thumbnails.
- Open the raw RSS source and search for `<media:content>`.
- Clear any page cache, feed cache, or CDN cache.

### The wrong image size appears

Use the `anbarli_rss_image_size` filter and return the image size you want.

### A feed reader still does not show the image

Some readers ignore Media RSS and use Open Graph metadata instead. Add or verify `og:image` tags on the post page with an SEO/Open Graph plugin.

### MIME type is missing

If WordPress cannot return the attachment MIME type, the plugin falls back to `image/jpeg`.

## Roadmap

- Add automated WordPress compatibility tests.
- Add example RSS fixtures for common feed readers.
- Add optional WordPress.org packaging workflow.
- Document compatibility results for Mailchimp, Feedly, Zapier, and popular RSS apps.

## Contributing

Issues and pull requests are welcome. Good first contributions include compatibility reports, documentation improvements, tests, and examples from real RSS clients.

Please read [CONTRIBUTING.md](CONTRIBUTING.md) before opening a pull request.

## Maintainer Notes

See [REPOSITORY_SETUP.md](REPOSITORY_SETUP.md) for recommended GitHub About text, topics, release notes, labels, and starter issues.

## License

MIT. See [LICENSE](LICENSE).
