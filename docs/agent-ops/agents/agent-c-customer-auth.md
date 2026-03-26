# Agent-C — Customer Panel & Auth

## Amaç
Müşteri paneli, kullanıcı sahiplik kuralları ve sosyal login (yalnız müşteri).

## Dokunacağı Alanlar
- `routes/web.php` (customer panel route grubu)
- `app/Http/Controllers/Customer/*`
- `resources/views/customer/*`
- `app/Models/User.php`
- auth config / social login entegrasyon dosyaları

## Teslimler
- Tekliflerim + teklif detayı + profil/şirket bilgisi
- Müşteri tarafı sosyal login entegrasyonu
- Misafir/üye akış ayrımının netleşmesi
- Yetki/sahiplik testleri

## Dokunmayacağı Alanlar
- admin UI
- importer
- katalog migration/model altyapısı

## Kapsam Dışı (Bu Sprint)
- admin kullanıcı lifecycle yönetimi
