# Production Release Checklist

## Ortam
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL` dogru alan adina ayarlandi
- MySQL baglantisi dogrulandi
- SMTP bilgileri gercek servis ile guncellendi

## Laravel Komutlari
- `composer install --no-dev --optimize-autoloader`
- `npm install && npm run build`
- `php artisan key:generate`
- `php artisan storage:link`
- `php artisan migrate --force`
- `php artisan db:seed --force`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`

## Queue ve Mail
- `QUEUE_CONNECTION=database`
- worker ayaga kaldirildi
- test mail gonderimi dogrulandi
- `failed_jobs` kontrol akisi hazir

## SEO
- `/robots.txt` aciliyor
- `/sitemap.xml` aciliyor
- public sayfalarda canonical var
- admin/account/auth alanlari `noindex`

## Medya
- `storage` symlink aktif
- urun ana gorseli gorunuyor
- galeri gorselleri yuklenebiliyor

## Operasyon
- admin login calisiyor
- teklif olusturma calisiyor
- admin teklif yanitlayabiliyor
- mail log veya SMTP tarafinda kuyruk isleniyor
- activity log veri uretiyor

## Son Kontrol
- `php artisan test`
- `npm run build`
- ana sayfa, urun listeleme, urun detay, teklif listesi, admin panel manuel smoke test
