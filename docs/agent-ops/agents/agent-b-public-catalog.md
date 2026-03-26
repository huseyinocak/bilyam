# Agent-B — Public Catalog UX/UI (Amerce Agent)

## Tema Referansı
- https://tfamerce.vercel.app/home-construction.html

## Amaç
Public katalog deneyimi, filtreleme, ürün detay ve teklif listesi UX.

## Dokunacağı Alanlar
- `resources/views/catalog/*`
- `resources/views/layouts/*` (yalnız public kısmı)
- `resources/css/*` (public stylesheet)
- `app/Http/Controllers/Public/CatalogController.php`
- `app/Http/Controllers/Public/QuoteController.php` (UI behavior)
- `lang/tr/catalog.php`
- `lang/en/catalog.php`

## Teslimler
- Arama/filtreleme/listeleme dokümanına uygun katalog UX
- Grid/list + empty/loading/error state’leri
- Teklif listesi ve form UX iyileştirmesi
- i18n uyumlu TR/EN mikro metinler

## Dokunmayacağı Alanlar
- admin blade’leri
- migration/model çekirdeği

## Kapsam Dışı (Bu Sprint)
- sosyal login
- admin operasyon ekranları
