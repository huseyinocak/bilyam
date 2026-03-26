# Web Projesi — 07 Veri Yönetimi ve İş Kuralları

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi, arayüz, responsive yapı ve kimlik doğrulama kararlarından sonra, projenin veri yönetimi ve iş kuralları yaklaşımını netleştirmek için hazırlanmıştır. Amaç; sistemde hangi ana verilerin tutulacağını, bunların birbiriyle nasıl ilişkileneceğini, hangi kurallarla doğrulanacağını ve iş akışlarının hangi mantıkla yönetileceğini proje özelinde tanımlamaktır.

Bu bölüm, modern web uygulamalarında veri yönetiminin sadece veri kaydetmek değil; veriyi doğrulamak, ilişkilendirmek, işlemek, merkezi kurallarla yönetmek ve gelecekte raporlanabilir kılmak anlamına geldiği ana çerçeveye dayanır. Bu yaklaşım; veritabanı tasarımı, entity ilişkileri, veri doğrulama kuralları, iş kurallarının merkezi yönetimi, loglama ve veri bütünlüğü gibi başlıkları kapsar. fileciteturn6file0 Ayrıca burada yer alan kararlar; teklif odaklı ürün yapısı, modüler bilgi mimarisi, kullanıcı akışları, UI/UX kararları ve auth yapısı üzerine kurulacaktır. fileciteturn6file2 fileciteturn6file1 fileciteturn6file3 fileciteturn6file4 fileciteturn6file5 fileciteturn6file6

---

## 1. Veri Yönetimi Bu Projede Ne Anlama Geliyor?

Bu projede veri yönetimi; ürünleri, kategorileri, markaları, kullanım alanlarını, teknik özellikleri, teklifleri, müşterileri, admin işlemlerini ve görünürlük ayarlarını sistematik bir yapıda yönetmek anlamına gelir.

Bu proje için iyi veri yönetimi şu sonucu üretmelidir:
- ürün verisi tutarlı kalmalı
- teklif kayıtları takip edilebilir olmalı
- müşteri ve misafir akışları veri seviyesinde ayrışmalı ama çatışmamalı
- admin işlemleri loglanabilir olmalı
- görünürlük ve ayar mantıkları parametrik çalışmalı
- raporlama ve analitik üretimi gelecekte mümkün olmalı

Bu projede veri yönetiminin temel amacı:
**ürün ve teklif omurgasını bozulmadan büyütebilecek, yönetilebilir ve raporlanabilir bir veri sistemi kurmaktır.**

---

## 2. Temel Veri Domainleri

İlk faz için veri mimarisi aşağıdaki temel domainler etrafında kurulmalıdır:

1. **Kullanıcılar ve Kimlik Verileri**
2. **Müşteriler ve Profil Verileri**
3. **Katalog Verileri**
4. **Teklif Verileri**
5. **İçerik ve İletişim Verileri**
6. **Sistem Ayarları ve Görünürlük Parametreleri**
7. **Log ve İz Kayıtları**

### 2.1 Kullanıcılar ve Kimlik Verileri
Bu domain şunları kapsar:
- müşteri kullanıcı hesapları
- admin kullanıcı hesapları
- roller
- izinler
- oturum / doğrulama durumları

### 2.2 Müşteriler ve Profil Verileri
Bu domain şunları kapsar:
- üye müşteri profil bilgileri
- misafir teklif sahipleri
- şirket bilgileri
- iletişim bilgileri
- teklif geçmişi ilişkileri

### 2.3 Katalog Verileri
Bu domain şunları kapsar:
- kategoriler
- markalar
- kullanım alanları
- ürünler
- ürün görselleri
- teknik özellik şablonları
- ürün teknik değerleri
- benzer / ilgili ürün ilişkileri

### 2.4 Teklif Verileri
Bu domain şunları kapsar:
- teklif ana kaydı
- teklif satırları
- teklif durumları
- ürün bazlı admin yanıtları
- teklif notları
- teklif durum geçmişi
- mail gönderim ilişkileri

### 2.5 İçerik ve İletişim Verileri
Bu domain şunları kapsar:
- sabit sayfalar
- iletişim bilgileri
- vitrin blokları
- ana sayfa içerikleri
- e-posta şablonları

### 2.6 Sistem Ayarları ve Görünürlük Parametreleri
Bu domain şunları kapsar:
- genel site ayarları
- satış modu
- fiyat görünürlüğü
- stok görünürlüğü
- mail alıcıları
- tema / dark mode tercihleri

### 2.7 Log ve İz Kayıtları
Bu domain şunları kapsar:
- admin işlem logları
- mail logları
- teklif durum değişiklik logları
- auth / oturum logları
- kritik hata / audit izleri

---

## 3. Temel Entity Yapısı

İlk faz için ana entity’ler aşağıdaki gibi düşünülmelidir:

### 3.1 User
Amaç:
- kimlik doğrulama ve hesap yönetimi

Alt tipler:
- müşteri kullanıcı
- admin kullanıcı

Temel alan örnekleri:
- id
- name
- email
- phone
- password
- email_verified_at
- is_active
- last_login_at
- created_at / updated_at

### 3.2 Customer Profile
Amaç:
- müşteri hesap bilgilerini iş profiliyle zenginleştirmek

Temel alan örnekleri:
- user_id
- company_name
- tax_office / tax_number (ileri faz açık)
- contact_name
- address (ileri faz açık)
- notes (admin içi olabilir)

### 3.3 Admin Profile
Amaç:
- admin kullanıcıya ait operasyonel meta bilgiler

Temel alan örnekleri:
- user_id
- role_id
- is_super_admin
- invited_by
- last_login_ip

### 3.4 Category
Temel alan örnekleri:
- parent_id
- name
- slug
- description
- sort_order
- is_active
- seo_title / seo_description
- price_visibility_override
- stock_visibility_override

### 3.5 Brand
Temel alan örnekleri:
- name
- slug
- description
- logo_path
- sort_order
- is_active

### 3.6 Use Case (Kullanım Alanı)
Temel alan örnekleri:
- name
- slug
- description
- sort_order
- is_active
- parent_id (ileri faza açık)

### 3.7 Product
Bu proje için en kritik entity’lerden biridir.

Temel alan örnekleri:
- category_id
- brand_id
- name
- slug
- product_code
- short_description
- description
- is_active
- is_featured
- is_quotable
- is_sellable_future_ready
- price_visibility_override
- stock_visibility_override
- meta_title / meta_description

### 3.8 Product Image
Temel alan örnekleri:
- product_id
- image_path
- alt_text
- sort_order
- is_primary

### 3.9 Technical Specification Template
Temel alan örnekleri:
- category_id
- name
- description
- is_active
- sort_order

### 3.10 Technical Specification Field
Temel alan örnekleri:
- template_id
- label
- field_key
- field_type
- is_required
- is_filterable
- show_in_listing
- show_in_detail
- unit
- sort_order
- placeholder

### 3.11 Product Technical Value
Temel alan örnekleri:
- product_id
- template_field_id
- value_text
- value_number
- value_boolean
- value_json

Not: veri tipi seçimleri teknik tasarımda netleşebilir; mantık olarak alan tanımı ile alan değeri ayrılmalıdır.

### 3.12 Product ↔ Use Case Relation
- many-to-many ilişki
- bir ürün birden fazla kullanım alanına bağlanabilir
- bir kullanım alanı birçok üründe kullanılabilir

### 3.13 Product Relation
Benzer ve ilgili ürünler için ayrı ilişki mantığı önerilir.

Önerilen alanlar:
- source_product_id
- target_product_id
- relation_type (`similar`, `related`)
- sort_order

Bu yaklaşım benzer ve ilgili ürünleri ayrı mantıkta yönetmeyi kolaylaştırır.

### 3.14 Quote Request
Teklif ana kaydıdır.

Temel alan örnekleri:
- customer_user_id (nullable)
- guest_name
- guest_email
- guest_phone
- guest_company_name
- quote_number
- status
- source_channel
- customer_note
- admin_note_summary
- submitted_at
- responded_at

### 3.15 Quote Item
Teklif satırlarını tutar.

Temel alan örnekleri:
- quote_request_id
- product_id
- requested_quantity
- line_note
- sort_order

### 3.16 Quote Response Item
Admin’in ürün bazlı dönüşünü tutar.

Temel alan örnekleri:
- quote_item_id
- offered_price
- currency
- lead_time_text
- admin_note
- availability_note
- responded_by
- responded_at

Bu yapı sayesinde bir teklif içindeki her ürün satırına ayrı dönüş yapılabilir. Bu ihtiyaç ürün temeli tarafında açıkça tanımlanmıştır. fileciteturn6file2

### 3.17 Quote Status History
Temel alan örnekleri:
- quote_request_id
- old_status
- new_status
- changed_by
- change_note
- created_at

### 3.18 Email Template
Temel alan örnekleri:
- key
- name
- subject_template
- html_body
- is_active

### 3.19 Email Log
Temel alan örnekleri:
- template_key
- related_type
- related_id
- to_email
- subject
- status
- sent_at
- error_message

### 3.20 Setting
Temel alan örnekleri:
- group
- key
- value
- type
- is_public

### 3.21 Activity Log / Audit Log
Temel alan örnekleri:
- actor_user_id
- actor_role
- action
- subject_type
- subject_id
- meta_json
- ip_address
- created_at

---

## 4. Temel İlişki Mantığı

Bu projede ilişkiler rastgele kurulmayacak; domain mantığıyla yönetilecektir.

### Öne çıkan ilişkiler
- Category 1 → N Product
- Brand 1 → N Product
- Category 1 → N Technical Specification Template
- Template 1 → N Template Field
- Product 1 → N Product Image
- Product N ↔ N Use Case
- Product 1 → N Product Technical Value
- Quote Request 1 → N Quote Item
- Quote Item 1 → 0..1 Quote Response Item (ilk fazda tek nihai cevap mantığı)
- Quote Request 1 → N Quote Status History
- User 1 → 0..1 Customer Profile
- User 1 → 0..1 Admin Profile

### Neden önemli?
Bu ilişki netliği:
- Eloquent tarafında temiz modelleme sağlar
- sorgu mantığını sadeleştirir
- veri bütünlüğünü artırır
- raporlamayı kolaylaştırır

---

## 5. Veri Doğrulama İlkeleri

Veri doğrulama hem public hem admin tarafta ayrı ciddiyetle ele alınmalıdır.

### 5.1 Public doğrulama
Örnekler:
- teklif formunda zorunlu alan kontrolü
- e-posta format doğrulaması
- telefon formatı için temel kontrol
- adet alanında pozitif sayı kontrolü
- boş teklif listesi ile form gönderimini engelleme

### 5.2 Müşteri panel doğrulama
Örnekler:
- profil güncellemede alan tipleri
- şirket bilgisi alanlarında uzunluk ve biçim kontrolleri
- şifre değiştirme kuralları

### 5.3 Admin doğrulama
Örnekler:
- kategori adı benzersizliği
- marka adı / slug benzersizliği
- ürün kodu benzersizliği
- teknik alan anahtarı tutarlılığı
- ürün görseli yükleme kuralları
- ilişki seçimlerinin geçerliliği

### 5.4 Neden merkezi olmalı?
Best practice olarak validasyon kuralları ekrana dağılmamalı; uygulama mantığında merkezi ve tekrar kullanılabilir biçimde yönetilmelidir.

---

## 6. İş Kuralları — Ürün ve Katalog

### 6.1 Ürün aktif/pasif mantığı
- pasif ürün public tarafta görünmez
- admin geçmiş kayıtlarda izleyebilir

### 6.2 Kategori aktif/pasif mantığı
- pasif kategori vitrinden kalkar
- alt ürünlerin public görünürlüğü ayrıca iş kuralıyla ele alınmalıdır

### 6.3 Marka aktif/pasif mantığı
- pasif marka filtrelerde ve public alanlarda görünmez
- ilişkili ürünler veri olarak korunabilir

### 6.4 Ürün kodu benzersizliği
İlk faz için ürün kodu benzersiz kabul edilmelidir.

### 6.5 Ana görsel kuralı
- her üründe bir adet `is_primary = true` ana görsel mantığı olmalıdır
- birden fazla ana görsel olamaz

### 6.6 Teknik özellik şablonu kuralı
- ürünün kategorisi değişirse teknik şablon uyumu yeniden kontrol edilmelidir
- kategori bazlı şablon yapısı veri tutarlılığı için zorunludur. Bu ihtiyaç ürün temeli tarafında netleşmiştir. fileciteturn6file2

### 6.7 Kullanım alanı ilişkisi
- kullanım alanı etiketi opsiyonel olabilir
- varsa filtre ve aramada kullanılabilir
- public kartta varsa gösterilebilir, yoksa zorunlu alan gibi davranmamalıdır. Bu karar UI sisteminde de netleşmiştir. fileciteturn6file4

---

## 7. İş Kuralları — Teklif Akışı

### 7.1 Teklif oluşturma kuralı
- boş teklif listesi ile teklif oluşturulamaz
- her teklif satırında geçerli ürün ve pozitif adet olmalıdır

### 7.2 Misafir teklif kuralı
- misafir teklif için hesap zorunlu değildir
- ancak iletişim bilgileri zorunludur

### 7.3 Üye teklif kuralı
- giriş yapmış kullanıcı teklif verirse teklif kendi hesabına bağlanır

### 7.4 Durum akışı kuralı
İlk faz için teklif durumları UX tarafında şu şekilde netleşmiştir:
- Alındı
- İnceleniyor
- Cevaplandı
- Ek Bilgi Bekleniyor
- Tamamlandı
- İptal Edildi fileciteturn6file3

İş kuralı olarak:
- her durum geçişi loglanmalıdır
- kritik geçişler yetkili kullanıcı gerektirir
- gerekirse bazı durum geçişleri kısıtlanabilir

### 7.5 Admin ürün bazlı cevap kuralı
- admin her teklif satırına ayrı cevap verebilir
- ama teklifi “Cevaplandı” durumuna almak için minimum veri şartı tanımlanmalıdır

Önerilen minimum şart:
- en az bir satır için geçerli admin cevabı bulunmalı
- ideal olarak tüm aktif satırlar cevaplanmış olmalıdır

Bu kuralı daha katı veya esnek hale getirme kararı sonraki detay aşamada netleştirilebilir.

### 7.6 Misafir teklif sonrası üyelik önerisi
Bu kural auth tarafında netleşmiştir:
- teklif öncesi kullanıcı zorlanmayacak
- başarı ekranı ve e-posta içinde üyelik önerisi sunulacaktır. fileciteturn6file6

---

## 8. İş Kuralları — Fiyat ve Stok Görünürlüğü

Bu proje için fiyat ve stok görünürlüğü parametrik yapıdadır. Bu karar ürün temeli tarafında netleşmiştir. fileciteturn6file2

### Önerilen öncelik sırası
1. ürün bazlı override
2. kategori bazlı override
3. genel sistem varsayılanı

### Neden bu sıra?
Çünkü en özel karar ürün seviyesindedir.

### Kural mantığı
- ürün özel karar verirse o uygulanır
- ürün boşsa kategoriye bakılır
- kategori boşsa genel sistem ayarı uygulanır

Aynı mantık hem fiyat hem stok görünürlüğünde kullanılmalıdır.

---

## 9. Soft Delete, Arşiv ve Kayıt Koruma

İlk fazda her veri fiziksel silinmemelidir.

### Soft delete düşünülebilecek alanlar
- ürünler
- kategoriler
- markalar
- kullanım alanları
- e-posta şablonları
- admin kullanıcılar

### Neden?
- yanlış silme riskini azaltır
- geçmiş teklif kayıtlarıyla veri ilişkisini korur
- raporlama ve geri alma imkanı sağlar

### Not
Teklif kayıtları ve teklif geçmişi gibi iş kayıtları için sert silme çok dikkatli ele alınmalıdır; çoğu durumda arşiv / pasif mantığı daha doğrudur.

---

## 10. Audit ve Loglama İlkeleri

### 10.1 Loglanması önerilen kritik işlemler
- admin girişleri
- rol / izin değişiklikleri
- ürün oluşturma / güncelleme / silme
- teklif durumu değişimleri
- fiyat görünürlüğü değişimleri
- stok görünürlüğü değişimleri
- e-posta şablonu değişimleri
- sistem ayarı değişimleri

### 10.2 Neden önemli?
- hata ayıklama
- operasyon takibi
- güvenlik
- sorumluluk izleme

### 10.3 Audit seviyesi
İlk fazda tam enterprise audit zorunlu değildir; ama kritik operasyonlar için yeterli iz bırakılmalıdır.

---

## 11. Raporlanabilirlik ve Geleceğe Açıklık

Veri yapısı ilk fazda gereksiz şişirilmemeli; ancak gelecekte şu sorulara cevap verebilecek kadar düzenli olmalıdır:
- en çok teklif alan ürünler hangileri?
- hangi kategoriler daha çok talep görüyor?
- misafir mi üyeli kullanıcı mı daha çok dönüşüm sağlıyor?
- hangi ürünlerde cevap süresi uzun?
- hangi admin ne kadar teklif işledi?
- hangi kullanım alanları daha çok ilgi görüyor?

Bu nedenle:
- durum kayıtları
- tarih alanları
- ilişki netlikleri
- log yapısı
başından düşünülmelidir.

---

## 12. Laravel ve Livewire ile Uyum Notu

Bu proje için Laravel temel yapı, Livewire ise etkileşimli arayüz katmanı olarak güçlü aday kabul edilmiştir. Bu karar UI tarafında netleşmiştir. fileciteturn6file4

Veri yönetimi açısından bu şu anlama gelir:
- veri ve iş kuralları Laravel tarafında merkezi yönetilmelidir
- Livewire bileşenleri doğrudan dağınık iş kuralı barındırmamalıdır
- validasyon, domain kuralları ve veri bütünlüğü uygulama katmanında korunmalıdır

Bu yaklaşım:
- tekrar kullanılabilirlik sağlar
- test edilebilirliği artırır
- UI değişse bile iş mantığını korur

---

## 13. Netleşen Veri ve İş Kuralı Kararları

### 13.1 Teklif numarası üretimi
Teklif numarası örnek olarak yıl + sıra numarası gibi tahmin edilebilir bir yapıda olmayacaktır.

#### Güncel karar
- teklif numarası **benzersiz** olacak
- uzunluğu **12 karakter** olacak
- tahmin edilmesi zor bir yapıda üretilecektir

#### Neden bu yaklaşım doğru?
- daha modern ve güvenli görünür
- kullanıcıya paylaşılabilir bir referans kodu verir
- sıralı / tahmin edilebilir yapıdan kaçınır
- dış iletişimde kullanılabilir ama iç id mantığına bağımlı kalmaz

#### Teknik not
Bu değer:
- veritabanı birincil anahtarı yerine ayrı bir business reference alanı olmalıdır
- benzersizlik veritabanı seviyesinde garanti edilmelidir

### 13.2 Ürün silme davranışı
İlk fazda ürünler doğrudan hard delete ile silinmeyecektir.

#### Güncel karar
Arşive gönderilmeden yapılabilecek işlemler:
- **pasife alma**
- **arşive gönderme**

Gerçek silme davranışı:
- **sadece arşiv alanından hard delete yapılabilecektir**

#### Neden bu yaklaşım en doğru?
- veri kaybı riskini azaltır
- teklif geçmişi ve katalog ilişkilerini korur
- yanlışlıkla ürün silinmesini önler
- operasyon tarafında daha güvenli bir akış sağlar

#### Önerilen ürün yaşam döngüsü mantığı
- aktif
- pasif
- arşivlenmiş
- arşivden kalıcı silinmiş

Bu yaklaşım kategori, marka ve benzeri katalog verilerine de gerektiğinde uyarlanabilir.

### 13.3 Teklifin “Cevaplandı” durumuna geçme kuralı
İlk fazda teklif bir bütün olarak cevaplanmış sayılabilmesi için **tüm satırların cevaplanmış olması** gerekecektir.

#### Güncel karar
- kısmi cevap mümkün olsa bile teklif durumu resmi olarak **Cevaplandı** seviyesine geçmeyecek
- “Cevaplandı” durumu için tüm satırlar yanıtlanmış olmalıdır

#### Neden bu yaklaşım doğru?
- müşteri deneyiminde netlik sağlar
- teklif bütünlüğünü korur
- yarım cevapların yanlış algılanmasını önler
- operasyon tarafında daha tutarlı durum yönetimi sağlar

#### Not
İleride ihtiyaç olursa “Kısmi Cevaplandı” gibi ek bir durum düşünülebilir; ancak ilk fazda süreç sade tutulmalıdır.

### 13.4 Misafir teklif ile sonradan açılan hesabın eşleşmesi
Misafir teklif ile sonradan açılan müşteri hesabı **otomatik eşleşecektir**.

#### Güncel karar
Eğer kullanıcı:
- teklif verirken kullandığı e-posta / telefon bilgileriyle
- daha sonra hesap açarsa
uygun kurallar dahilinde geçmiş teklifleri hesabına otomatik bağlanabilir.

#### Neden bu yaklaşım doğru?
- kullanıcı için güçlü değer üretir
- teklif geçmişi kaybolmaz
- üyelik avantajı gerçek hale gelir
- manuel operasyon ihtiyacını azaltır

#### Dikkat notu
Otomatik eşleşme kontrollü yapılmalıdır.
En güvenli yaklaşım:
- birincil eşleşme e-posta üzerinden
- gerekiyorsa telefon destekleyici alan
- çakışmalı durumlarda sistem log tutmalı veya inceleme bayrağı koyabilmelidir

### 13.5 Ayarlar için veri modeli yaklaşımı
Burada en doğru best practice yaklaşımı **hibrit ayar modeli** olacaktır.

#### Neden tüm ayarlar saf key-value olmamalı?
Tamamen key-value yapısı başlangıçta kolay görünür; ancak zamanla:
- tip kontrolü zorlaşır
- ilişkili veri kümeleri dağılır
- validasyon karmaşıklaşır
- yönetim paneli kirlenir
- “settings çöplüğü” oluşur

#### Neden her şeyi ayrı tabloya da bölmemeliyiz?
Çünkü bu da ilk fazda gereksiz karmaşıklık üretir.
Bazı ayarlar için key-value mantığı hâlâ çok uygundur.

#### En doğru model
**1. Basit global ayarlar için key-value / typed setting yapısı**
Örnek:
- site adı
- mail gönderen adı
- genel iletişim e-postası
- dark mode varsayılanı
- genel fiyat görünürlüğü varsayılanı
- genel stok görünürlüğü varsayılanı

Bu ayarlar için:
- group
- key
- value
- type
- is_public
mantığı yeterlidir

**2. Yapısal ve ilişkili ayarlar için ayrı yapılandırma tabloları veya domain tabloları**
Örnek:
- e-posta şablonları
- rol / izin tanımları
- teknik özellik şablonları
- vitrin blokları
- dönemsel dashboard tercihi gibi kullanıcıya özel tercihler

**3. Kullanıcıya özel tercihler için ayrı preference yapısı**
Örnek:
- theme tercihi
- dashboard görünüm tercihi
- dil / görünüm tercihleri (ileri faz)

#### Sonuç
Yani önerilen yaklaşım:
- **basit global ayarlar = typed key-value**
- **ilişkili / yapısal ayarlar = ayrı tablo / domain modeli**
- **kullanıcı bazlı tercihler = ayrı preference yapısı**

Bu, hem esnekliği hem temizliği koruyan en sağlıklı çözümdür.

---

## 14. Ön Sonuç

Bu aşamada veri yönetimi ve iş kuralları omurgası şu prensiplere dayanır:
- veri domain bazlı düşünülmeli
- entity ilişkileri baştan net kurulmalı
- katalog ve teklif yapısı ayrı ama bağlı çalışmalı
- misafir ve üye teklif akışları veri seviyesinde birlikte desteklenmeli
- ürün teknik verisi şablonlu yapıyla yönetilmeli
- görünürlük kuralları parametrik ve çok seviyeli olmalı
- kritik işlemler loglanmalı
- veri modeli gelecekte raporlanabilirliği desteklemeli
- iş kuralları UI katmanına dağılmadan merkezi yönetilmelidir
- teklif numarası 12 karakterli benzersiz business reference olarak üretilmelidir
- ürün silme doğrudan değil, pasife alma / arşivleme mantığıyla yönetilmelidir
- hard delete yalnızca arşiv alanından yapılabilmelidir
- teklifin cevaplandı durumuna geçmesi için tüm satırlar cevaplanmış olmalıdır
- misafir teklif ile sonradan açılan hesap uygun kurallarla otomatik eşleşebilmelidir
- ayarlar key-value çöplüğüne dönüşmeyecek hibrit modelle yönetilmelidir

Bu doküman, sonraki aşamada veritabanı taslağı, Laravel model ilişkileri, service/domain kuralları ve yönetim akışlarının teknik seviyede netleştirilmesi için temel olacaktır.

