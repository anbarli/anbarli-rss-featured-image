# Anbarlı RSS Featured Image

WordPress eklentisi: Yazıların öne çıkarılan görsellerini RSS beslemesine **Media RSS (MRSS)** biçiminde `<media:content>` etiketi olarak ekler. Böylece uyumlu RSS okuyucuları görselleri doğrudan besleme içinde gösterebilir.

> **Uyum**: PHP 7.4+ ve WordPress 5.0+ (tested on PHP 7.4.33).

## ✨ Özellikler

- Her RSS öğesine (`<item>`) yazının öne çıkarılan görselini MRSS ile ekler
- Görsel boyutu (`thumbnail`, `medium`, `large`, `full` vs.) filtre ile değiştirilebilir
- İsteğe bağlı olarak `enclosure` etiketi de eklenebilir (varsayılan: kapalı)

## 📦 Kurulum

1. Depoyu indirin veya ZIP olarak kaydedin.
2. Klasör adının `anbarli-rss-featured-image` olduğundan emin olun.
3. Klasörü `wp-content/plugins/` içine kopyalayın.
4. WordPress yönetim panelinden **Eklentiler → Anbarlı RSS Featured Image** eklentisini etkinleştirin.

## 🔧 Kullanım

Eklentiyi etkinleştirdikten sonra, sitenizin RSS beslemesinde (ör. `https://alanadiniz.com/feed/`) her yazı için `<media:content>` etiketi otomatik olarak görünecektir.

Örnek çıktı:

```xml
<media:content url="https://alanadiniz.com/uploads/2025/08/featured.jpg" medium="image" type="image/jpeg" width="1200" height="630" />
```

## 🧩 Geliştirici Kancaları (Filters)

- `anbarli_rss_image_size` — RSS'e eklenecek görselin boyutunu ayarlayın.
  ```php
  // functions.php
  add_filter('anbarli_rss_image_size', function ($size) {
      return 'full'; // 'thumbnail' | 'medium' | 'large' | 'full' | custom image size
  });
  ```

- `anbarli_rss_add_enclosure` — Uyum için `enclosure` etiketi de eklemek isterseniz:
  ```php
  add_filter('anbarli_rss_add_enclosure', '__return_true');
  ```

## 🧪 Test / Doğrulama

- Beslemenizi açın: `https://siteadresiniz.com/feed/`
- Kaynak görünümünde `<media:content>` öğesini kontrol edin.
- Birden fazla görsel boyutu için özel resim boyutu tanımlıysa (`add_image_size`), `anbarli_rss_image_size` ile onu da kullanabilirsiniz.

## ❓ SSS

**S: Tüm yazılar için görsel çıkmıyor.**
- Yazının gerçekten **öne çıkarılan görseli** var mı?
- `functions.php` içinde `post-thumbnails` desteği açık mı?
  ```php
  add_theme_support('post-thumbnails');
  ```

**S: MIME türü yanlış görünüyor.**
- WordPress veya barındırıcınız, görsel MIME türünü doğru dönmeyebilir. Eklenti varsayılan olarak `image/jpeg` kullanır; çoğu istemci için yeterlidir.

---

## 🇬🇧 English

A tiny WordPress plugin that adds each post’s Featured Image to your RSS feed as a **Media RSS (MRSS)** `<media:content>` tag. Compatible readers can display images inline in feed entries.

### Features
- Adds `<media:content>` for each `<item>` if a Featured Image exists
- Configurable image size via `anbarli_rss_image_size` filter
- Optional `enclosure` tag via `anbarli_rss_add_enclosure` filter (disabled by default)

### Installation
1. Download or clone this repository.
2. Ensure the folder name is `anbarli-rss-featured-image`.
3. Copy it under `wp-content/plugins/`.
4. Activate the plugin from the WordPress admin panel.

### Filters
```php
add_filter('anbarli_rss_image_size', fn($size) => 'full');
add_filter('anbarli_rss_add_enclosure', '__return_true');
```

### Requirements
- PHP 7.4+
- WordPress 5.0+

### License
MIT