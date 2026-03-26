# AGENTS.md

## Amaç
Bu repo belge-merkezli geliştirilir. Kod üretmeden, mimari karar almadan, dosya oluşturmadan ve kapsam genişletmeden önce ilgili kaynaklar okunmalı; uygulama, kaynak dokümanlardaki kararlarla uyumlu ilerlemelidir.

---

## Öncelikli Kaynaklar
1. `docs/kaynaklar/` altındaki tüm dokümanlar
2. `docs/external-sources/` altındaki yönlendirici dokümanlar
3. `doc/assets/branding/` altındaki marka varlıkları

Marka dosyaları resmi kaynak kabul edilir.  
UI kararlarında repo içi kaynaklar, dış referanslardan daha önceliklidir.

---

## Belge Önceliği
Bir konuda birden fazla belge veya not varsa şu öncelik sırasını uygula:

1. En güncel netleştirilmiş karar / karar notu
2. İlgili alanın ana dokümanı
3. Genel prensip dokümanı
4. Dış referans / esinlenme kaynağı

### Yorumlama kuralları
- Belgelerle çelişen varsayım yapma.
- Belgede net karar varsa onu uygula.
- Çelişki görürsen en spesifik ve uygulamaya dönük kararı bağlayıcı kabul et.
- Eksik konu varsa mevcut mimariye en uyumlu, sade ve genişleyebilir çözümü seç.
- Gerekirse yeni `.md` dokümanı ekleyerek kararları kayıt altına al.

---

## Zorunlu Kaynak Okuma Sırası
Aşağıdaki dosyalar tam okunmadan geliştirmeye başlama:

1. `docs/kaynaklar/20 Dokümantasyon ve Geliştirme Disiplini.md`
2. `docs/kaynaklar/web_projesi_01_modern_web_uygulamasi_temelleri.md`
3. `docs/kaynaklar/01 Ürün Temeli.md`
4. `docs/kaynaklar/02 Bilgi Mimarisi Ve Modüler Yapı.md`
5. `docs/kaynaklar/03 Kullanıcı Deneyimi (ux).md`
6. `docs/kaynaklar/04 Arayüz (ui) Ve Tasarım Sistemi.md`
7. `docs/kaynaklar/05 Responsive Ve Cihaz Uyumu.md`
8. `docs/kaynaklar/06 Kimlik Doğrulama Ve Yetkilendirme.md`
9. `docs/kaynaklar/07 Veri Yönetimi Ve İş Kuralları.md`

### Bu ilk 9 dosya okunmadan şunları yapma
- route yapısı kurma
- migration / model tasarlama
- auth akışı kurma
- admin operasyonu yazma
- ekran geliştirme
- servis / repository / action ayrımı yapma
- domain davranışı tanımlama

---

## Göreve Göre Ek Okuma

### Katalog / Arama / Listeleme / Ürün Detay
Önce zorunlu 9 dosyayı oku, sonra:
- `docs/kaynaklar/11 Arama, Filtreleme Ve Listeleme Deneyimi.md`
- `docs/kaynaklar/15 Seo Ve Görünürlük.md`

Amaç:
- Public katalog deneyimini doğru kurmak
- Filtre, sıralama, grid/list, ürün detay ve indekslenebilir sayfa yapısını belgeye uygun uygulamak

### Admin / Backoffice / Operasyon
Önce zorunlu 9 dosyayı oku, sonra:
- `docs/kaynaklar/13 Yönetim Paneli ve Operasyonel Kontro.md`
- `docs/kaynaklar/09 Güvenlik.md`
- `docs/kaynaklar/10 Hata Yönetimi Ve Gözlemlenebilirlik.md`

Amaç:
- Admin tarafını yalnızca CRUD gibi değil, operasyonel kontrol yüzeyi olarak ele almak
- Arşiv, durum yönetimi, gözlemlenebilirlik ve güvenlik sınırlarını korumak

### Entegrasyon / Bildirim / Dış Servisler
Önce zorunlu 9 dosyayı oku, sonra:
- `docs/kaynaklar/14 Entegrasyon Ve Genişleyebilirlik.md`
- `docs/kaynaklar/16 Bildirimler ve Kullanıcı Geri Bildirimi.md`
- `docs/kaynaklar/19 Analitik ve Ölçümleme.md`

Amaç:
- Sağlayıcı bağımlılıklarını gevşek bağlı kurmak
- Bildirim ve entegrasyonları değiştirilebilir adapter / servis mantığıyla tasarlamak
- Analitik akışlarını erken ama sade kurgulamak

### Test / Kalite / Performans / Release
Önce zorunlu 9 dosyayı oku, sonra:
- `docs/kaynaklar/17 Test Edilebilirlik ve Kalite Süreci.md`
- `docs/kaynaklar/18 Sürümleme, Ortamlar ve Dağıtım.md`
- `docs/kaynaklar/08 Performans.md`

Amaç:
- Başlangıçtan itibaren testlenebilir yapı kurmak
- Ortam, yayın ve release disiplinini erkenden hesaba katmak
- Erken optimizasyon yapmadan performans risklerini kontrol altında tutmak

### Her büyük geliştirme öncesi son çapraz kontrol
Aşağıdaki dosyaları tekrar tara:
- `docs/kaynaklar/09 Güvenlik.md`
- `docs/kaynaklar/10 Hata Yönetimi Ve Gözlemlenebilirlik.md`
- `docs/kaynaklar/08 Performans.md`

---

## Çalışma Kuralları
- Kod üretmeden önce ilgili dokümanları oku.
- Dokümanlarla çelişen varsayım yapma.
- Eksik konu varsa mevcut mimariye en uyumlu çözümü seç.
- UI kararlarında repo kaynakları, dış referanslardan daha önceliklidir.
- Dış kaynaktan alınan ürün/kategori verilerini doğrudan view içine gömme.
- Veri modeli seed/import edilebilir yapıda kurulsun.
- Marka dosyalarını resmi kaynak kabul et.

---

## Uygulama Prensipleri
- İlk faz / MVP sınırını koru.
- Hacky çözüm üretme.
- Public site, customer panel ve admin paneli tek ürün mimarisi içinde düşün.
- Teklif akışını sıradan sepet mantığına indirgeme.
- Misafir kullanıcı deneyimini ihmal etme.
- Güvenlik, hata yönetimi, performans, SEO ve analitiği sonradan eklenecek detaylar gibi değil, mimarinin doğal parçaları gibi ele al.
- UI geliştirirken sadece mutlu akışı değil; loading, empty, validation, disabled, success, error ve responsive durumları da birlikte düşün.
- Kod yazarken framework’e uygun ol ama framework merkezli değil, ürün merkezli düşün.

---

## Dış Kaynak Kullanımı
- `https://toptanbilya.com/urunler` kategori, ürün kartı, ürün kısa bilgi, görsel ve teklif akışı için referans kaynaktır.
- Bu kaynak demo/reference veri yapısı için kullanılabilir.
- Nihai domain modeli projedeki kaynak dokümanlara uygun genişletilmelidir.

### Görsel esinlenme yaklaşımı
Verilen referanslar birlikte değerlendirildiğinde en doğru yaklaşım şudur:

-  public tarafta genel görsel dil ve modern tema yaklaşımı için Amerce (https://tfamerce.vercel.app/home-construction.html) theme'si esinleme kaynağı olarak kullanılacaktır.r 
- Kategori sunum mantığında Toptanbilya ana sayfasındaki “Geniş Ürün Kategorilerimiz” bölümüne benzer kart/grid yaklaşımı görsel ve yapısal esinleme olarak esas alınacaktır.
- admin panelde ise Velzon (https://themesbrand.com/velzon/html/master/) theme'si esinleme kaynağı olarak kullanılacaktır.

### Dış kaynak kullanım sınırları
- Dış kaynaklardan birebir kopya yapı kurma.
- Dış referansları ürün kararının yerine koyma.
- Görsel esinlenmeyi repo içi tasarım sistemi ve UX kararlarıyla uyumlu hale getir.
- Dış kaynaktan gelen içerikleri normalize etmeden domain modeline gömme.

---

## Çalışma Akışı
Her görevde şu sırayla ilerle:

1. İlgili kaynakları oku
2. Uygulanacak kararları çıkar
3. Etkilenecek modül ve dosyaları belirle
4. Kapsam dışı bırakılacakları netleştir
5. Sonra kod yaz
6. Kod sonrası belge uyum kontrolü yap

### Her görev başında içsel kontrol listesi
- Okunan ilgili kaynaklar neler?
- Bu görevde bağlayıcı kararlar neler?
- Hangi modüller / dosyalar etkilenecek?
- Kapsam dışında ne bırakılıyor?
- Uygulama yaklaşımı nedir?
- Belgeye aykırı bir karar var mı?

---

## Beklenen Geliştirme Disiplini
- Küçük ve kontrollü commitler
- Tek sorumluluklu değişiklikler
- Mevcut yapıyı bozmadan ilerleme
- Gerekirse yeni md dokümanı ekleyerek kararları kayıt altına alma

Ek olarak:
- Büyük değişiklikleri tek committe yığma
- Gereksiz yeniden adlandırma / geniş çaplı refactor yapma
- Belge gerektirmeyen soyutlama ekleme
- İlk faz için gereksiz karmaşıklık üretme

---

## Hızlı Özet

### Tam okuma
`20 → 01 Modern → 01 Ürün Temeli → 02 → 03 → 04 → 05 → 06 → 07`

### Göreve göre
- katalog: `11 → 15`
- admin: `13 → 09 → 10`
- entegrasyon: `14 → 16 → 19`
- kalite / release: `17 → 18 → 08`

### Her büyük geliştirme öncesi final kontrol
`09 → 10 → 08`