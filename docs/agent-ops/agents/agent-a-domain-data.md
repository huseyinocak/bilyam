# Agent-A — Domain & Data Backbone

## Amaç
Veri modeli, migration, seed/import ve iş kuralları çekirdeğini üretmek.

## Dokunacağı Alanlar
- `database/migrations/*`
- `app/Models/*`
- `database/seeders/*`
- `app/Console/Commands/*`
- `database/data/*`

## Teslimler
- Ürün-kategori-marka-teklif ilişkilerinin nihai hale getirilmesi
- Parametrik görünürlük kural motoru (ürün/kategori/marka override düzeni)
- Toptanbilya import akışının sağlamlaştırılması (normalize + idempotent)
- MySQL index/constraint optimizasyonları

## Dokunmayacağı Alanlar
- `resources/views/*`
- `routes/web.php` (UI akış route’ları)
- admin/public blade katmanı

## Kapsam Dışı (Bu Sprint)
- UI ve görsel kararlar
- customer/admin ekran bileşenleri
