# Production Kurulum Rehberi

## Ortam Dosyasi
- `.env.production.example` dosyasini baz alin.
- SMTP bilgilerini gercek servis saglayiciniz ile doldurun.
- `APP_URL`, `DB_*`, `MAIL_*` ve `ADMIN_NOTIFICATION_EMAIL` alanlarini ortama gore guncelleyin.

## Uygulama Kurulumu
1. `composer install --no-dev --optimize-autoloader`
2. `npm install && npm run build`
3. `php artisan key:generate`
4. `php artisan storage:link`
5. `php artisan migrate --force`
6. `php artisan db:seed --force`
7. `php artisan config:cache`
8. `php artisan route:cache`
9. `php artisan view:cache`

## Queue Worker
Veritabanı kuyrugu kullaniliyor.

Onerilen komut:

```bash
php artisan queue:work --queue=default --sleep=3 --tries=3 --timeout=120
```

Uzun sureli calisma icin process manager kullanin.

## Mail
- `MAIL_MAILER=smtp`
- `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_SCHEME`
- gonderici icin `MAIL_FROM_ADDRESS` ve `MAIL_FROM_NAME`

## Son Kontrol
- `robots.txt` ve `sitemap.xml` dogrulayin
- admin ve account alanlarinin `noindex` oldugunu kontrol edin
- teklif mail akisini log veya SMTP ile test edin
