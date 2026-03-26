# Web Projesi — 01A Ürün Temeli

Bu çalışma alanı, web uygulaması için içerik, referans site incelemesi hazırlanmıştır.

---

## Cevaplanacak Ana Sorular

1. Bu web uygulaması hangi problemi çözecek?
2. Hedef kullanıcı kim olacak?
3. Kullanıcı neden bu sistemi kullanacak?
4. İlk sürümde hangi temel işi mutlaka yapabilmeli?
5. Başarıyı neye göre ölçeceğiz?

---

## Referans Site İncelemesinden Çıkan Temel Çerçeve

Referans yapı, klasik tam e-ticaret mantığından çok şu modele yakındır:
- sanayi / teknik ürün kataloğu
- ürün listeleme ve detay gösterimi
- hızlı iletişim
- teklif toplama
- güven ve tecrübeye dayalı satış

Bu da projenin ilk omurgasını şu noktaya getirir:

**Katalog + teklif sepeti + teklif yönetimi + admin paneli**

Ayrıca uygulamanın geneli ilk günden itibaren:
- responsive
- modern görünümlü
- masaüstü, tablet ve mobil uyumlu
olacak şekilde tasarlanacaktır.

---

## 1. Bu web uygulaması hangi problemi çözecek?

### İlk net problem tanımı
Bu web uygulaması; sanayi ve teknik ürün arayan müşterilerin, doğru ürünü dağınık iletişim kanalları ve yavaş teklif süreçleriyle aramak yerine, tek bir sistem üzerinden:
- ürünü bulmasını,
- ürün detayını incelemesini,
- bir veya birden fazla ürün için talep oluşturmasını,
- adet belirterek teklif istemesini,
- satıcıya hızlı şekilde ulaşmasını,
- teklif sürecini düzenli ve takip edilebilir biçimde yürütmesini
sağlayacaktır.

### Problemin daha sade ifadesi
**Ana problem:**
Müşteri doğru teknik ürünü hızlı bulmakta ve birden fazla ürün için düzenli teklif almakta zorlanıyor.

### Bu proje neyi iyileştirecek?
- telefon / WhatsApp üzerinden dağınık teklif sürecini toparlayacak
- ürün keşfini hızlandıracak
- ürün bazlı adetli teklif istemeyi kolaylaştıracak
- admin tarafında gelen taleplerin yönetimini düzenleyecek
- ileride perakende satışa açılabilecek bir altyapı oluşturacak

---

## 2. Hedef kullanıcı kim olacak?

### Kavramların net açıklaması
- **B2B (Business to Business):** Bir işletmenin başka bir işletmeye satış yapmasıdır.
- **B2C (Business to Consumer):** Bir işletmenin son kullanıcıya yani bireysel müşteriye satış yapmasıdır.

### “B2B ağırlıklı ama B2C açık” ne demek?
Bu şu anlama gelir:
- Sistemin ana dili ve ana satış mantığı işletmelere göre kurulur.
- Ama bireysel veya küçük ölçekli müşteri tamamen dışlanmaz.
- Yani omurga ticari müşteriye göre kurulur, ancak düşük adetli veya tekil talep bırakmak isteyen son kullanıcı da sistemden yararlanabilir.

### “Tamamen B2B” ile “B2B + perakende birlikte” farkı
**Tamamen B2B modelde:**
- odak işletmelerdir
- teklif ve toplu alım mantığı baskındır
- fiyatlar herkese açık olmayabilir
- müşteri bazlı fiyat yapısı olabilir

**B2B + perakende birlikte modelde:**
- hem işletmeler hem bireysel müşteriler sistemi kullanabilir
- bazı ürünler teklif ile, bazı ürünler doğrudan satış ile ilerleyebilir
- ürün dili ve kullanıcı akışı daha geniş kitleye hitap eder

### Bu proje için mevcut karar
Bu proje:
- **ilk aşamada B2B ağırlıklı** olacaktır
- fakat yapısal olarak **B2C / perakende açılımına kapalı olmayacaktır**
- küçük işletmeler ve bireysel kullanıcılar da teklif talebinde bulunabilecektir

### Hedef kullanıcı taslağı
Birincil hedef kullanıcı:
- sanayi işletmeleri
- atölyeler
- bakım / onarım ekipleri
- teknik satın alma yapan firmalar
- toptan veya proje bazlı ürün arayan ticari müşteriler

İkincil hedef kullanıcı:
- küçük işletmeler
- teknik ustalar / servis kullanıcıları
- tekil veya düşük adetli ürün talep etmek isteyen bireysel müşteriler

---

## 3. Kullanıcı neden bu sistemi kullanacak?

### İlk değer önerisi
Kullanıcı bu sistemi şu nedenlerle tercih eder:
- doğru ürüne daha hızlı ulaşır
- ürün adı, kategori, ürün kodu ve kullanım alanı ile arama yapabilir
- birden fazla ürünü tek seferde teklif listesine ekleyebilir
- her ürün için ayrı adet belirtebilir
- dağınık mesajlaşma yerine düzenli teklif süreci yaşar
- güvenilir tedarikçiden dönüş alır
- ister misafir ister üye kullanıcı olarak sistemi kullanabilir
- ileride daha profesyonel sipariş altyapısına bağlanabilecek bir sistem kullanır

### Güçlü değer önerisi cümlesi
**“Doğru teknik ürünü hızlı bul, birden fazla ürün için tek seferde teklif iste, süreci düzenli ve profesyonel şekilde yönet.”**

---

## 4. İlk sürümde hangi temel işi mutlaka yapabilmeli?

### Netleşen ana karar
İlk fazın merkezi **online satış değil, teklif toplama** olacaktır.

### Ancak sistem ileride neyi desteklemeli?
Evet, iki yapı da desteklenebilir:
- teklif toplama modu
- doğrudan perakende satış modu
- hibrit mod

Bu yüzden mimari ilk günden şu mantığı desteklemelidir:
- bazı ürünler teklif ile ilerleyebilir
- bazı ürünler doğrudan satışa açılabilir
- sistem modu ileride panel ayarı veya ürün bazlı parametre ile genişletilebilir

### İlk fazdaki gerçek akış
İlk fazda klasik sepet yerine **teklif sepeti** mantığı olacaktır.

Kullanıcı şunları yapabilmelidir:
1. ürünleri incelemek
2. ürün adı, kategori, ürün kodu ve kullanım alanı ile arama yapmak
3. bir veya birden fazla ürünü teklif listesine eklemek
4. her ürün için adet / miktar belirtmek
5. gerekirse not bırakmak
6. iletişim bilgilerini girerek teklif talebi göndermek
7. misafir kullanıcı olarak teklif talebinde bulunabilmek
8. üye kullanıcı olarak giriş yapıp kendi geçmiş taleplerini görüntüleyebilmek

Admin ise şunları yapabilmelidir:
1. gelen teklif talebini görmek
2. talepteki her ürün satırını ayrı ayrı incelemek
3. her ürün için ayrı fiyat girmek
4. her ürün için açıklama, uygunluk veya termin bilgisi eklemek
5. teklif durumunu yönetmek
6. teklif talebi oluştuğunda bildirim almak

### İlk sürüm için net MVP taslağı
İlk sürüm mutlaka şunları yapabilmeli:
1. ürün ve kategori vitrini sunmalı
2. ürün detaylarını göstermeli
3. ürün adı, kategori, ürün kodu ve kullanım alanı ile arama yapabilmeli
4. kullanıcının birden fazla ürünü teklif listesine eklemesini sağlamalı
5. her ürün için adet girilerek teklif talebi oluşturulabilmeli
6. teklif formu ile müşteri bilgileri toplanabilmeli
7. teklif gönderildiğinde sistemde kayıt oluşmalı
8. admin panelinde ürün, kategori, markalar ve teklifler yönetilebilmeli
9. admin her teklif satırına ayrı fiyat bilgisi girebilmeli
10. admin ve kullanıcı için e-posta bildirim akışı çalışmalı
11. müşteri üyelik sistemi bulunmalı
12. üye kullanıcı kendi teklif geçmişini panelden görüntüleyebilmeli
13. misafir kullanıcı için teklif verme akışı açık kalmalı

### E-posta ve bildirim akışı
Teklif formu gönderildiğinde:
- teklif talebi sistem veritabanına kaydedilecek
- admin tarafında tanımlanacak e-posta adresine teklif talep içeriği gönderilecek
- kullanıcıya da “teklif talebiniz alınmıştır” içerikli onay e-postası gönderilecek
- kullanıcıya gönderilen e-postada talep özeti yer alacak
- teklif yanıtı verildiğinde kullanıcıya ayrıca cevap e-postası gönderilebilecek

Bu nedenle ilk fazda ayrıca şu yapılar gereklidir:
- modern HTML mail şablonları
- admin panelinde mail şablonu / içerik düzenleme alanı
- teklif mail alıcı adresi ayarı
- gönderim ayarları ve temel mail log takibi

### Üyelik yaklaşımı
İlk fazda müşteri üyelik sistemi yer alacaktır.
Ancak teklif vermek için üyelik zorunlu olmayacaktır.
Misafir kullanıcı da teklif talebinde bulunabilecektir.

### Bu karar neden doğru?
Bu yaklaşım şunları sağlar:
- teklif dönüşümünü düşürmeden hızlı talep toplamaya devam eder
- isteyen kullanıcıya hesap oluşturma ve geçmiş taleplerini görme imkanı verir
- ileride favoriler, hızlı tekrar talep ve profil bazlı kolaylıkların önü açılır
- sistemi baştan sağlam ve genişleyebilir kurar

### İlk fazda üyelik sistemi için önerilen kapsam
İlk fazda müşteri tarafında şu üyelik özellikleri olabilir:
- kayıt ol
- giriş yap
- şifremi unuttum
- profil bilgileri
- kişi adı / firma adı / iletişim bilgileri
- geçmiş teklif taleplerini görüntüleme
- teklif detayını görüntüleme
- teklif durumunu görüntüleme

### Veri modeli notu
Bu nedenle teklif kayıt yapısında şu yaklaşım sürdürülmelidir:
- `customer_user_id` nullable olabilir
- misafir tekliflerinde iletişim bilgileri teklif kaydı üzerinde tutulur
- üye kullanıcı tekliflerinde hesap ilişkisi kurulur
- misafir teklifi sonradan üyelikle eşleştirilebilecek altyapı düşünülür

### İleri faz için mimari not
Yönetim panelinde ileride şu mantık tanımlanabilir:
- satış modu = teklif toplama
- satış modu = perakende satış
- satış modu = hibrit

Bu ayar ilk fazda tam açılmasa bile veri modeli ve ürün yapısı bunu destekleyecek şekilde kurgulanmalıdır.

---

## 5. Başarıyı neye göre ölçeceğiz?

### İlk başarı kriteri taslağı
Bu projede ilk faz başarısı en çok şu metriklerle ölçülmelidir:
- aylık teklif talebi sayısı
- teklif sepeti oluşturma sayısı
- teklif formu tamamlama oranı
- ürün detay sayfası görüntüleme sayısı
- arama kullanım oranı
- WhatsApp / telefon / iletişim tıklama oranı
- tekliften satışa dönüşüm oranı
- kayıt olan kullanıcı sayısı
- üye kullanıcı tekrar kullanım oranı
- en çok talep alan ürün ve kategoriler

---

## Arama Yapısı ile İlgili Netleşen Karar

### İlk fazda kullanıcı nasıl arama yapacak?
Kullanıcı ilk fazda şu alanlardan arama yapabilecek:
- ürün adı
- kategori
- ürün kodu
- kullanım alanı

### Kullanım alanı ile arama ne demek?
Bu, ürünün hangi kullanım senaryosu için arandığına göre yapılan aramadır.

Örnek:
- konkasör için rulman
- tarım makinesi için kayış
- elektrik motoru için rulman

Bu özellik ilk faz kapsamına alınacaktır.

### Kullanım alanı araması için best practice yaklaşım
En doğru yaklaşım **hibrit modeldir**:
- ana yapı: admin tanımlı kullanım alanı etiketleri
- destekleyici yapı: açıklama / içerik alanlarında serbest metin

### Neden bu model?
Sadece serbest metin kullanılırsa veri dağılır, filtreleme zorlaşır ve aynı anlam için farklı yazımlar oluşur.
Sadece sabit yapı kullanılırsa esneklik azalır.
Bu nedenle etiket tabanlı ana yapı ve destekleyici serbest metin en doğru çözümdür.

### Admin veri modeli önerisi — Kullanım Alanları
**Kullanım Alanları modülü**
- kullanım alanı adı
- slug
- açıklama
- aktif / pasif durumu
- sıralama
- ileride üst kullanım alanı desteğine açık yapı

**Ürün - kullanım alanı ilişkisi**
- bir ürün birden fazla kullanım alanına bağlanabilir
- bir kullanım alanı birçok üründe kullanılabilir
- yani burada many-to-many ilişki kullanılmalıdır

### Admin ekran davranışı
- kullanım alanları ayrı bir yönetim ekranından tanımlanır
- ürün formunda çoklu seçim ile bağlanır
- gerekirse hızlı arama / autocomplete desteği eklenebilir

### Sonuç
İlk faz için kullanım alanı araması:
- admin tanımlı etiket mantığı ile çalışacak
- veri tutarlılığı için bu yapı esas alınacak
- serbest metin destekleyici içerik olarak kalacak

---

## Teknik Özellik Yapısı ile İlgili Netleşen Karar

### Teknik özellik alanları için best practice yaklaşım
En doğru yaklaşım:
- **kategoriye göre şablonlu teknik özellik yapısı**
- gerektiğinde sınırlı ek serbest alan desteği

### Neden tamamen serbest yapı doğru değil?
Tam serbest yapı kısa vadede kolay görünür ama uzun vadede veri kalitesini bozar:
- aynı özellik farklı isimlerle girilir
- filtreleme zorlaşır
- karşılaştırma yapılamaz
- admin panelinde kargaşa oluşur

### Neden kategori bazlı şablon doğru?
Çünkü her ürün türünün ihtiyaç duyduğu teknik alan farklıdır.

Örnek:
- rulmanda: iç çap, dış çap, genişlik, seri
- kayışta: uzunluk, profil, tip
- filtrede: uyumlu model, ölçü, marka

### Admin veri modeli önerisi — Teknik Özellik Şablonları
Önerilen yapı üç katmanlıdır:

**1. Teknik özellik şablonları**
- şablon adı
- bağlı kategori
- aktif / pasif durumu
- sıralama
- açıklama

**2. Şablon alanları**
Her şablon içinde alanlar tanımlanır:
- alan etiketi
- sistem anahtarı / kodu
- alan tipi
- zorunlu mu
- filtrelenebilir mi
- listede gösterilsin mi
- ürün detayında gösterilsin mi
- sıralama
- birim bilgisi
- yardımcı açıklama / placeholder

**Alan tipi örnekleri**
- text
- number
- select
- multi-select
- boolean
- textarea

**3. Ürün teknik değerleri**
- ürün hangi şablona bağlıysa o şablon alanlarının değerleri ürün üzerinde saklanır
- alan tanımı ile alan değeri birbirinden ayrılır

### Admin ekran davranışı
- önce kategori seçilir
- kategoriye bağlı teknik şablon otomatik gelir
- admin alanları doldurur
- gerekirse sınırlı ek özellik alanı ekleyebilir

### Sonuç
İlk faz için teknik özellik yapısı:
- kategori bazlı şablonlu kurulacak
- gerektiğinde sınırlı ek serbest alan desteği verilecek

---

## Fiyat ve Stok Görünürlüğü İçin Karar Çerçevesi

### Fiyat görünürlüğü
İlk fazda teklif odaklı yapı nedeniyle fiyat varsayılan olarak gösterilmeyecektir.

Ancak yapı parametrik olacaktır.
Önerilen profesyonel yaklaşım üç seviyeli görünürlük modelidir:
1. genel sistem ayarı
2. kategori bazlı ayar
3. ürün bazlı ayar

### Neden üç seviyeli yapı daha doğru?
- bazı kategoriler tamamen teklife açık olabilir
- bazı kategorilerde fiyat gösterilmek istenebilir
- bazı özel ürünlerde kategori ayarından bağımsız davranmak gerekebilir

Bu nedenle önerilen mantık şudur:
- sistem genel varsayılanı belirler
- kategori bu varsayılanı ezebilir
- ürün ise son seviyede özel karar verebilir

### İlk faz önerisi
- genel varsayılan: fiyat gösterme = false
- kategori bazlı override: desteklenecek
- ürün bazlı override: desteklenecek

### Stok görünürlüğü
Stok bilgisi için de aynı çok seviyeli yapı önerilir:
- genel sistem ayarı
- kategori bazlı ayar
- ürün bazlı ayar

Bu yaklaşım gelecekte esneklik sağlar ve en profesyonel seçenektir.

---

## Admin Panelinde İlk Günden Olması Gereken Yönetim Alanları

Aşağıdaki yapı ilk faz için kapsamlı öneri olarak belirlenmiştir:

### 1. Dashboard
- toplam ürün sayısı
- toplam kategori sayısı
- toplam marka sayısı
- toplam teklif talebi sayısı
- toplam üye müşteri sayısı
- bekleyen teklif talepleri
- cevaplanan teklifler
- bugün gelen talepler
- son 7 gün teklif grafiği
- son 30 gün teklif grafiği
- en çok teklif alan ürünler
- en çok teklif alan kategoriler
- en çok görüntülenen ürünler
- trafik kaynakları özeti
- cihaz kırılımı özeti
- son eklenen ürünler
- son teklif hareketleri
- teklif durum dağılımı grafiği
- hızlı işlem kartları
- admin için yapılacaklar / dikkat gerektiren işler alanı
- kritik bildirim kutusu
- eksik içerik / eksik veri uyarıları

### 2. Yönetici kullanıcılar
- admin kullanıcı listesi
- kullanıcı ekleme / düzenleme
- rol atama
- aktif / pasif durumu
- son giriş tarihi
- son işlem bilgisi
- parola yenileme / davet akışı
- kullanıcı bazlı yetki istisnaları
- hesap güvenlik durumu

### 3. Rol ve izin yönetimi
- rol tanımları
- ekran bazlı yetkiler
- işlem bazlı yetkiler
- görüntüleme / ekleme / düzenleme / silme / yayınlama / teklif cevaplama ayrımları
- hassas ayarlar için ek yetki seviyesi

### 4. Kategoriler
- kategori listesi
- ana kategori / alt kategori yapısı
- sıralama
- aktif / pasif durumu
- SEO alanları
- kategori görünürlük ayarları
- kategori bazlı fiyat / stok görünürlüğü parametreleri

### 5. Markalar
- marka listesi
- marka logosu
- aktif / pasif durumu
- açıklama alanı
- sıralama
- marka görünürlük durumu

### 6. Kullanım Alanları
- kullanım alanı listesi
- ad
- açıklama
- aktif / pasif
- sıralama
- ürünlerle ilişkilendirme mantığı

### 7. Ürünler
- ürün listesi
- ürün adı
- ürün kodu / SKU
- kategori
- marka
- açıklama
- kısa açıklama
- çoklu görsel yükleme
- ana görsel seçimi
- teknik özellikler
- kullanım alanı etiketleri
- aktif / pasif
- öne çıkan ürün
- teklif alınabilir durumu
- ileride satışa açılabilir durumu
- ürün bazlı fiyat görünürlüğü ayarı
- ürün bazlı stok görünürlüğü ayarı
- SEO alanları

### 8. Teknik özellik şablonları
- şablon listesi
- kategori bağlantısı
- alan tanımları
- alan tipleri
- zorunluluk ve görünürlük ayarları
- sıralama

### 9. Teklif talepleri
- gelen teklif listesi
- teklif detay ekranı
- müşteri bilgileri
- teklif satırları
- her satır için adet
- her satır için admin fiyat girişi
- not / termin / açıklama
- teklif durumu
- teklif geçmişi
- e-posta gönderim durumu
- teklif iç yazışma / admin notları

### 10. Müşteriler
- üye müşteri listesi
- misafir talep sahipleri
- iletişim bilgileri
- firma bilgileri
- geçmiş talepler
- müşteri notları
- müşteri etiketleri
- teklif geçmişi özeti

### 11. İçerik ve iletişim yönetimi
- iletişim bilgileri
- telefon
- WhatsApp
- e-posta
- adres
- kurumsal içerikler
- sayfa içerikleri
- sabit metin alanları

### 12. Ana sayfa / vitrin yönetimi
- banner alanları
- öne çıkan kategoriler
- öne çıkan ürünler
- vitrin blok sıraları
- ana sayfa duyuru alanları

### 13. Form ve talep ayarları
- teklif form alanları
- zorunlu alanlar
- KVKK / onay alanları
- bildirim ayarları
- teklif yönlendirme e-postası
- misafir talep ayarları

### 14. Medya yönetimi
- ürün görselleri
- banner görselleri
- dosya yükleme / silme
- medya klasörleme mantığı

### 15. E-posta şablonları
- teklif alındı mail şablonu
- admin bildirim mail şablonu
- teklif cevabı mail şablonu
- HTML mail editörü
- konu başlığı şablonları
- gönderici adı ve gönderici mail ayarları

### 16. Genel ayarlar
- site adı
- logo / favicon
- mail ayarları
- sosyal medya linkleri
- temel SEO ayarları
- satış modu ayar altyapısı
- genel fiyat görünürlüğü ayarı
- genel stok görünürlüğü ayarı
- Google Analytics bağlantı / izleme notları

### 17. Loglar
- admin işlem logları
- teklif durum değişiklik logları
- hata kayıtları
- mail gönderim logları
- oturum / güvenlik logları

### 18. Sistem / operasyon yardımcı alanları
- bakım modu
- önbellek temizleme gibi operasyonel araçlar
- temel sistem sağlık durumu özeti
- sıraya alınmış işler / kuyruk durumu izleme için alan

---

## İlk Faz İçin Önerilen Minimum Admin Kapsamı

İlk fazı gereksiz büyütmeden ama sağlam kurmak için minimum kapsam şu olabilir:
1. Dashboard
2. Yönetici kullanıcılar
3. Rol / izin yönetimi
4. Kategoriler
5. Markalar
6. Kullanım Alanları
7. Ürünler
8. Teknik özellik şablonları
9. Teklif talepleri
10. Müşteriler
11. İçerik / iletişim yönetimi
12. Form ve talep ayarları
13. Medya yönetimi
14. E-posta şablonları
15. Genel ayarlar
16. Loglar

---

## Netleşen Açık Kararlar

1. Ürünlerde fiyat ilk fazda varsayılan olarak gizli olacak
2. Fiyat görünürlüğü parametrik olacak
3. Stok görünürlüğü parametrik olacak
4. Fiyat ve stok görünürlüğü için genel + kategori + ürün bazlı çok seviyeli yapı kurulacak
5. Teklif cevabı müşteriye e-posta olarak gönderilecek
6. Teklif talebi misafir kullanıcıya açık olacak
7. Teklif için üyelik ilk fazda zorunlu olmayacak
8. Müşteri üyelik sistemi ilk fazda yer alacak
9. Üye kullanıcı kendi teklif geçmişini görüntüleyebilecek
10. Marka yönetimi ilk fazda kesin gerekli olacak
11. Ürünlerde çoklu görsel yapısı olacak
12. Ana görsel seçimi yapılabilecek
13. Teknik özellik tablosu ilk fazda olacak
14. Teknik özellik yapısı kategori bazlı şablonlu kurulacak
15. Aramada kullanım alanı ilk faz kapsamına dahil olacak
16. Kullanım alanı araması admin tanımlı etiket mantığı ile çalışacak
17. Uygulamanın geneli responsive olacak
18. HTML mail şablonları ve bunların yönetim alanı olacak
19. Dashboard ilk fazda operasyonel + analitik özetler içerecek
20. Google Analytics ilk faz kapsamına dahil olacak

---

## Netleşen Ek Kararlar

### Müşteri paneli ilk faz kapsamı
Müşteri paneli ilk fazda sadece temel hesap alanı olmayacak; kontrollü ama faydalı bir kapsamla sunulacaktır.

İlk fazda müşteri panelinde şu alanlar yer alacaktır:
- teklif geçmişi
- teklif detay görüntüleme
- teklif durumu / durum rozeti
- profil bilgileri
- şirket bilgileri alanı
- hızlı tekrar talep oluşturma

#### Profil notu
Şirket bilgileri alanı bulunacaktır; ancak bu alan zorunlu olmayacaktır.
Yani kullanıcı ister bireysel, ister kurumsal profil mantığında ilerleyebilecektir.

### Üyelikte e-posta doğrulama
İlk fazda üyelikte **e-posta doğrulama zorunlu** olacaktır.

Ancak önemli karar:
- kullanıcı doğrulama yapana kadar teklif talebi oluşturması engellenmeyecektir

Bu yaklaşım şu dengeyi sağlar:
- kullanıcı deneyimi bozulmaz
- kayıt süreci gereksiz sertleşmez
- sistemde doğrulanmış hesap mantığı korunur

### Teklif yanıtı gösterim modeli
Teklif yanıtı iletiminde çift yapı olacaktır:

**Üye kullanıcılar için:**
- e-posta bildirimi
- panel içi durum rozeti / durum görünürlüğü
- teklif detay ekranında yanıt bilgileri

**Misafir kullanıcılar için:**
- sadece e-posta ile iletim

Bu yaklaşım üyeliği zorunlu kılmadan üyeliğe anlamlı avantaj kazandırır.

### Google Analytics verisinin dashboard’a yansıması — best practice kararı
Best practice açısından ilk faz için en doğru yaklaşım:
- **Google Analytics’i doğrudan detaylı raporlama ekranı gibi admin paneline kopyalamamak**
- bunun yerine admin dashboard’da **işe yarayan özet metrik kartları** göstermek
- detay analiz ihtiyacı için gerektiğinde GA tarafına yönlenmek

#### Neden bu yaklaşım daha doğru?
- admin panel gereksiz karmaşık hale gelmez
- bakım maliyeti düşer
- ürün dashboard’ı operasyonel odağını kaybetmez
- karar vermeyi hızlandıran metrikler öne çıkar
- detay analitik işi analitik aracında kalır

#### İlk faz için önerilen GA özetleri
Admin dashboard’da şu özet metrikler gösterilebilir:
- toplam ziyaretçi
- toplam oturum
- en çok görüntülenen sayfalar
- en çok görüntülenen ürünler
- trafik kaynakları özeti
- cihaz kırılımı
- teklif dönüşümüne yardımcı olabilecek temel etkileşim metrikleri

#### Sonuç
İlk faz için:
- Google Analytics bağlantısı kurulacak
- admin dashboard’a **özet / basit metrikler** yansıtılacak
- detaylı analiz Google Analytics tarafında takip edilecek

---

