# Web Projesi — Analiz Dokümanı

## 1. Projenin Özeti

Web Projesi, teknik ürünler için kurgulanan, **B2B ağırlıklı fakat B2C’ye kapalı olmayan**, ilk fazda **doğrudan satıştan çok teklif toplama** mantığıyla çalışan modern bir web uygulamasıdır. Framework olarak laravel kullanılacak olup veritabanı olarak ise mysql veritabanı kullanılacaktır.

Projenin çekirdeği şudur:

- kullanıcı ürünleri keşfeder,
- bir veya birden fazla ürünü teklif listesine ekler,
- ürün bazında adet girer,
- iletişim bilgileriyle teklif talebini gönderir,
- admin tarafı her ürün satırını ayrı değerlendirir,
- teklif yanıtı kontrollü biçimde kullanıcıya iletilir.

Dolayısıyla proje klasik sepet-sipariş mantığıyla değil, **katalog + teklif listesi + teklif operasyonu + müşteri paneli + admin paneli** omurgasıyla tanımlanmalıdır. 

---

## 2. Ürün Vizyonu ve İş Problemi

### 4.1 Çözülen temel problem

Bu proje, teknik ürün arayan kullanıcıların dağınık iletişim kanalları, yavaş teklif süreçleri ve düzensiz ürün keşfi nedeniyle yaşadığı sürtünmeyi azaltmayı hedefler.

Bugünkü problemin özeti:

- doğru ürünü bulmak zor,
- birden fazla ürün için düzenli teklif istemek zor,
- ürün bazlı adetli talep toplamak düzensiz,
- admin tarafında talepleri takip etmek dağınık,
- teklif süreci kurumsal ve izlenebilir değil.

### 4.2 Ürün vaadi

Projenin temel değer önerisi şu eksende şekillenir:

**Doğru teknik ürünü hızlı bul, birden fazla ürün için tek seferde teklif iste, süreci düzenli ve profesyonel biçimde yönet.**

### 4.3 İlk faz iş modeli

İlk fazın merkezi iş modeli **teklif toplama** olacaktır. Ancak mimari, gelecekte:

- teklif odaklı,
- doğrudan satış odaklı,
- hibrit model

gibi yapıları destekleyebilecek esneklikte kurulmalıdır.

Bu yüzden bazı ürünlerin ileride satılabilir hale gelmesi, fiyat ve stok görünürlüğünün parametrik yönetimi ve hibrit ürün davranışları için teknik zemin ilk fazda düşünülmelidir.

---

## 3. Hedef Kullanıcılar

### 5.1 Birincil hedef kitle

- sanayi işletmeleri
- atölyeler
- teknik satın alma birimleri
- bakım / onarım ekipleri
- proje bazlı veya toplu ürün arayan işletmeler

### 5.2 İkincil hedef kitle

- küçük işletmeler
- teknik servis kullanıcıları
- düşük adetli ürün talep eden bireysel müşteriler

### 5.3 Ürün yaklaşımı

Sistem dili ve omurgası ticari müşteriyi önceler; ancak bireysel kullanıcıyı sistem dışına itmez. Bu nedenle proje **B2B ağırlıklı, B2C açık** modelle tanımlanmalıdır.

---

## 4. Proje Kapsamı ve MVP Çerçevesi

Public ve müşteri tarafı theme [https://tfamerce.vercel.app/home-construction.html](https://tfamerce.vercel.app/home-construction.html) adresindeki themedan esinlenecek. Admin tarafı ise [https://themesbrand.com/velzon/html/master/index.html](https://themesbrand.com/velzon/html/master/index.html) adresindeki admin themesinden esinlenecek. Sistemin mutlaka yapabilmesi gerekenler şunlardır:

### 6.1 Public taraf

- ürün ve kategori vitrini sunmak
- ürün detaylarını göstermek
- ürün adı, kategori, ürün kodu ve kullanım alanı ile arama yapmak
- kullanıcıya birden fazla ürünü teklif listesine ekleme imkânı vermek
- her ürün için adet girilmesini sağlamak
- teklif talep formu ile iletişim bilgisi toplamak
- misafir kullanıcı akışını açık tutmak

### 6.2 Müşteri tarafı

- üyelik oluşturma
- giriş / çıkış / şifre sıfırlama
- e-posta doğrulama
- teklif geçmişini görüntüleme
- teklif detayını görme
- hızlı tekrar talep oluşturma
- profil ve şirket bilgilerini yönetme

### 6.3 Admin tarafı

- teklif taleplerini listeleme ve yönetme
- her teklif satırına ayrı fiyat / termin / açıklama girebilme
- teklif durumunu yönetme
- ürün, kategori, marka ve kullanım alanı yönetimi
- teknik özellik şablonları yönetimi
- içerik, medya, e-posta şablonları ve temel ayarlar yönetimi
- analitik özetleri ve operasyonel sinyalleri dashboard’da görebilme

### 6.4 İletişim akışları

- teklif alındı e-postası
- admin’e yeni teklif bildirimi
- teklif cevabı e-postası
- kayıt / e-posta doğrulama e-postası
- şifre sıfırlama e-postası

---

## 5. Bilgi Mimarisi ve Alan Ayrımı

Proje üç ana alanda kurgulanmalıdır:

### 7.1 Public Site

Giriş yapmadan erişilen, ürün keşfi ve teklif üretiminin başladığı vitrin alanıdır.

Ana amaçları:

- ürün keşfi
- kategori gezinme
- marka güveni oluşturma
- kullanım alanına göre keşif
- teklif listesi oluşturma
- misafir teklif bırakma

### 7.2 Customer Panel

Giriş yapmış müşterilerin kullandığı kişisel alandır.

Ana amaçları:

- teklif geçmişi takibi
- teklif detayına erişim
- hızlı tekrar talep
- profil ve şirket bilgileri yönetimi
- üyeliğin değerini görünür kılma

### 7.3 Admin Panel

Operasyon, katalog, müşteri, içerik ve sistem yönetiminin merkezidir.

Ana amaçları:

- teklif operasyonunu yönetmek
- katalog kalitesini korumak
- müşteri verisini incelemek
- vitrin ve içerik alanlarını yönetmek
- ayar, log ve görünürlük kontrolü sağlamak

---

## 6. Navigasyon ve Modül Yapısı

### 8.1 Public Site ana navigasyonu

İlk faz için önerilen ana yapı:

- Ana Sayfa
- Ürünler
- Kategoriler
- Kurumsal
- İletişim
- Teklif Listem
- Giriş Yap / Kayıt Ol

Markalar ve kullanım alanları üst menüde ayrı ana başlık olarak değil, katalog içinde güçlü keşif ve filtre katmanı olarak konumlanmalıdır.

### 8.2 Customer Panel modülleri

- Panel Ana Sayfa
- Tekliflerim
- Hızlı Tekrar Talep
- Profil Bilgilerim
- Şirket Bilgilerim
- Hesap Ayarları

Müşteri paneli ilk ekranda doğrudan listeye değil, özet kartlar ve hızlı aksiyonlar içeren bir panel ana sayfasına açılmalıdır.

### 8.3 Admin Panel modülleri

Admin menüsü grup bazlı sidebar ile çalışmalıdır.

Ana grup yapısı:

- Operasyon
- Katalog
- Müşteriler
- İçerik
- Sistem

İlk faz modülleri:

**Operasyon**

- Dashboard
- Teklif Talepleri
- Müşteriler

**Katalog**

- Ürünler
- Kategoriler
- Markalar
- Kullanım Alanları
- Teknik Özellik Şablonları

**İçerik**

- İçerik Yönetimi
- Ana Sayfa / Vitrin
- Medya Yönetimi
- E-posta Şablonları

**Sistem**

- Genel Ayarlar
- Form ve Talep Ayarları
- Yönetici Kullanıcılar
- Rol / İzin Yönetimi
- Loglar
- Sistem Araçları

---

## 7. UX Stratejisi

Projenin UX yaklaşımı üç temel hedefe dayanır:

1. Ürün keşfini hızlandırmak
2. Teklif sürecini kolaylaştırmak
3. Güven hissini artırmak

### 9.1 Temel UX prensipleri

- hızlı anlaşılabilirlik
- az adımda ilerleme
- güven veren deneyim
- tutarlı davranış
- mobil doğallık
- her adımda net geri bildirim

### 9.2 Public UX yaklaşımı

Public alanda kullanıcı üç ana yoldan ürün keşfetmelidir:

- global arama
- kategori keşfi
- katalog içi filtreleme

Buna marka, kullanım alanı ve ilgili ürünler gibi destekleyici katmanlar eşlik etmelidir.

Teklif akışı e-ticaret benzeri rahatlık hissi vermeli; ama bunun bir sipariş değil teklif süreci olduğu dil ve etkileşim katmanında açık biçimde anlaşılmalıdır.

### 9.3 Müşteri paneli UX yaklaşımı

Panel:

- hafif ama faydalı,
- özet kart + aksiyon + liste dengesi kuran,
- kullanıcıya üyeliğin değerini hissettiren,
- teklif durumu takibini kolaylaştıran

bir yapıda olmalıdır.

### 9.4 Admin panel UX yaklaşımı

Admin UX’in ana hedefi estetikten çok operasyon hızıdır. Bu yüzden:

- üstte KPI kartları,
- ortada grafik ve durum özetleri,
- altta operasyon listeleri

mantığı korunmalıdır.

Uzun admin formları section yapısıyla bölünmeli, kritik aksiyonlar korunmalı ve yoğun veride bilişsel yük azaltılmalıdır.

---

## 8. UI ve Tasarım Sistemi

Tasarım sistemi, üç alan arasında kontrollü tutarlılık kuran ortak bir dil olmalıdır.

### 10.1 Katmanlar

- Foundation
- Components
- Patterns
- Layouts

### 10.2 Görsel dil

Genel karakter şu dengede kurulmalıdır:

- modern,
- temiz,
- güven veren,
- teknik ürün dünyasına uygun,
- gereksiz efektten uzak,
- okunabilir ve düzenli

### 10.3 Referans yaklaşımı

Public tarafta Amerce benzeri çağdaş ve ferah vitrin dili; admin tarafta Velzon benzeri operasyonel ve analitik düzen yaklaşımı referans alınmalıdır. Ancak bu referanslar doğrudan kopya değil, tasarım yönü veren ilham kaynakları olarak değerlendirilmelidir.

### 10.4 Tasarım sistemi ihtiyaçları

- rol tabanlı renk sistemi
- tutarlı tipografi ölçeği
- boşluk ve grid token’ları
- kart, tablo, rozet, modal, drawer, form alanı, toast ve pagination bileşen ailesi
- durum stilleri
- light/dark tema desteği

### 10.5 Dark mode kararı

Dark mode ilk faza alınacaktır. Bu nedenle tema yapısı sabit renklerle değil, token tabanlı kurulmalıdır.

---

## 9. Responsive ve Cihaz Uyumu

Responsive yaklaşım yalnızca ekran küçültme değil, bağlama göre yeniden kurgulama olarak ele alınmalıdır.

### 11.1 Hedef cihaz katmanları

- Mobil
- Tablet
- Dizüstü / Masaüstü
- Büyük ekran

### 11.2 Temel responsive ilkeler

- mobilde tek kolon önceliği
- tablette sadeleştirilmiş çok kolon
- masaüstünde tam deneyim
- büyük ekranda kontrollü genişleme

### 11.3 Public responsive kararları

- mobilde hamburger menü
- görünür arama erişimi
- teklif listesi göstergesi korunmalı
- kategori kartları cihaz kırılımına göre 1/2/4 kolon düzeninde ilerlemeli
- filtreler masaüstünde sol panel + üst bar hibriti, mobilde drawer/sheet mantığıyla açılmalı
- ürün detay mobilde tek kolon ve sticky CTA bar ile ilerlemeli

### 11.4 Customer panel responsive kararları

- KPI kartları mobilde alt alta veya yatay akışla sunulabilir
- teklif listesi mobilde tablo değil kart fallback ile çalışmalıdır
- teklif detay satırları mobilde okunur section yapısına dönmelidir

### 11.5 Admin responsive kararları

Admin kullanım odağı masaüstüdür; ancak tablet ve dar ekranlarda temel operasyon yapılabilir olmalıdır.

- sidebar mobilde drawer’a dönüşmeli
- büyük tablolar yatay kaydırma veya alternatif görünümle yönetilmeli
- uzun formlar tek kolon section yapısına kırılmalıdır

---

## 10. Kimlik Doğrulama ve Yetkilendirme

### 12.1 Kullanıcı tipleri

- Misafir Kullanıcı
- Üye Müşteri
- Admin / Operasyon Kullanıcısı
- Süper Admin

### 12.2 Temel ürün dengesi

Bu projenin auth yaklaşımı şu cümleyle özetlenir:

**Üyelik fayda sağlar ama teklif için kapı bekçisi olmaz.**

Yani misafir teklif akışı açık kalacak; ancak üyelik sistemi ilk fazda gerçek değer üretecek şekilde kurulacaktır.

### 12.3 Müşteri auth kapsamı

- kayıt ol
- giriş yap
- şifre sıfırlama
- e-posta doğrulama
- güvenli çıkış

E-posta doğrulama zorunlu olacak; ancak doğrulama tamamlanmadan teklif verme engellenmeyecektir.

### 12.4 Admin auth yaklaşımı

Admin alanı müşteri alanından net biçimde ayrılmalıdır:

- ayrı route grubu
- ayrı giriş ekranı
- rol ve izin tabanlı koruma
- kritik işlemlerde ilave güvenlik ve loglama

### 12.5 Rol modeli

İlk faz için önerilen roller:

- Super Admin
- Admin
- Operasyon
- İçerik Yöneticisi
- Müşteri

Rol yapısına ek olarak işlem bazlı izinler backend seviyesinde doğrulanmalıdır.

---

## 11. Veri Yönetimi ve İş Kuralları

Veri modeli, ürün ve teklif omurgasını bozulmadan büyütebilecek şekilde kurulmalıdır.

### 13.1 Ana domainler

- Kullanıcılar ve kimlik verileri
- Müşteri profilleri
- Katalog verileri
- Teklif verileri
- İçerik ve iletişim verileri
- Sistem ayarları ve görünürlük parametreleri
- Log ve audit kayıtları

### 13.2 Katalog veri modeli

Temel varlıklar:

- Category
- Brand
- Use Case
- Product
- Product Image
- Technical Specification Template
- Technical Specification Field
- Product Technical Value
- Product Relation

### 13.3 Teklif veri modeli

Temel varlıklar:

- Quote Request
- Quote Item
- Quote Response Item
- Quote Status History

Teklif kaydında `customer_user_id` nullable olmalıdır. Böylece misafir teklifleri de desteklenir.

### 13.4 İş kuralı özetleri

- ürün kodu ilk fazda benzersiz olmalı
- ana görsel tek olmalı
- ürün–kullanım alanı ilişkisi many-to-many olmalı
- teknik özellik yapısı kategori bazlı şablonla ilerlemeli
- fiyat ve stok görünürlüğü parametrik yönetilmeli
- teklif “Cevaplandı” durumuna ancak gerekli satır bazlı yanıt mantığı tamamlandığında geçebilmelidir
- arşiv ve hard delete akışları ayrılmalıdır

---

## 12. Arama, Filtreleme ve Listeleme Stratejisi

### 14.1 Public arama yaklaşımı

İlk fazda hem:

- global arama,
- hem katalog içi arama

birlikte bulunacaktır.

Global arama hızlı giriş noktası, katalog içi arama ise bağlamsal ve filtrelerle çalışan derinleşme katmanıdır.

### 14.2 Arama alanları

İlk fazda kullanıcı şu alanlarda arama yapabilmelidir:

- ürün adı
- kategori
- ürün kodu
- kullanım alanı

### 14.3 Filtreleme yaklaşımı

İlk faz için temel katalog filtreleri:

- kategori
- marka
- kullanım alanı
- bağlama göre görünürlükle ilişkili ek filtreler
- kategoriye bağlı kontrollü teknik özellik filtreleri

### 14.4 Listeleme kararları

- katalogda varsayılan görünüm grid
- liste görünümü desteklenecek
- public katalogda klasik pagination kullanılacak
- infinite scroll ilk faza alınmayacak
- public sayfa boyutu: varsayılan 10, alternatif 20 ve 50
- admin listelerinde varsayılan sayfa boyutu 20; alternatif 40, 50 ve 100

### 14.5 Müşteri paneli listeleme

Tekliflerim ekranı sade filtrelerle çalışmalıdır:

- teklif durumu
- tarih aralığı
- teklif numarası araması

Varsayılan sıralama en güncel teklif üstte olacak şekilde kurulmalıdır.

### 14.6 Admin listeleme

Operasyon listelerinde recency-first yaklaşımı benimsenmelidir. Özellikle teklif, log ve müşteri listeleri yoğun veri içinde hızlı aksiyon üretmelidir.

---

## 13. Performans Yaklaşımı

Performans yalnızca sayfa açılışı değil; teklif akışındaki anlık hissi, admin operasyon hızını ve veri ekranlarındaki akıcılığı kapsar.

### 15.1 Kritik performans alanları

- ürün kataloğu
- ürün detay sayfası
- teklif listesine ürün ekleme
- teklif formu gönderimi
- müşteri paneli teklif geçmişi
- admin dashboard ve operasyon listeleri

### 15.2 Temel ilkeler

- gereksiz veri çekimi önlenmeli
- sayfalama zorunlu kullanılmalı
- N+1 sorgulardan kaçınılmalı
- büyük dashboard blokları kontrollü yüklenmeli
- mail ve arka plan işlemleri kullanıcıyı bekletmemeli
- görseller optimize edilmeli
- liste ekranları aynı veri setinden farklı görünüm üretebilmelidir

### 15.3 Teklif akışı performansı

Ürün ekleme, sayaç güncelleme, mini teklif paneli geri bildirimi ve form gönderimi gecikmeli hissettirmemelidir. Mail gönderimi mümkün olduğunda kuyruk tabanlı ilerlemelidir.

---

## 14. Güvenlik Yaklaşımı

Güvenlik proje sonunda eklenecek bir katman değil, en baştan tasarımın parçası olarak ele alınmalıdır.

### 16.1 Güvenlik hedefleri

- misafir teklif akışının kötüye kullanımını önlemek
- müşteri verisini korumak
- admin panelini ayrı ve güçlü korumak
- rol ve izin açıklarını kapatmak
- dosya ve medya güvenliğini sağlamak
- log ve bildirim akışlarında hassas veri sızıntısını önlemek

### 16.2 Temel güvenlik katmanları

- input validation
- CSRF koruması
- XSS koruması
- SQL injection koruması
- rate limiting
- güvenli parola saklama
- dosya yükleme güvenliği
- sahiplik kontrolü
- rol/izin backend doğrulaması
- güvenli loglama

### 16.3 Misafir teklif akışı güvenliği

Misafir teklif stratejik olarak açık tutulduğu için:

- rate limiting,
- spam önlemleri,
- anomali loglaması,
- tekrar eden istek kontrolü

özellikle önemlidir.

### 16.4 Admin güvenliği

İlk fazda 2FA zorunlu değildir; ancak güçlü parola, giriş logları, kritik işlem logları ve yetki kontrollü kritik aksiyon yapısı zorunlu kabul edilmelidir.

---

## 15. Hata Yönetimi ve Gözlemlenebilirlik

Uygulama bozulduğunda da kontrollü davranmalıdır.

### 17.1 Hata katmanları

- kullanıcıya gösterilen hatalar
- uygulama istisnaları
- iş kuralı hataları
- entegrasyon ve arka plan iş hataları
- operasyonel ve anomali sinyalleri

### 17.2 Hata dili

Mesajlar:

- sade,
- teknik jargon içermeyen,
- suçlayıcı olmayan,
- çözüm yönü veren

bir yapıda olmalıdır.

### 17.3 Loglama katmanları

- uygulama logları
- işlem logları
- güvenlik logları
- entegrasyon logları
- performans ve anomali logları

### 17.4 Gözlemlenebilirlik hedefi

Sistem şu sorulara cevap verebilmelidir:

- teklif neden gönderilemedi?
- mail neden başarısız oldu?
- hangi admin hangi işlemi yaptı?
- hangi akışta hata oranı arttı?
- staging ve production davranışları nerede ayrışıyor?

---

## 16. Bildirimler ve Kullanıcı Geri Bildirimi

Bildirim yapısı, kullanıcının sistemle olan güven ilişkisini doğrudan etkiler.

### 18.1 Kanal dağılımı

İlk fazda geri bildirim ve bildirim kanalları şunlardan oluşmalıdır:

- toast
- inline form hataları
- alert / banner
- modal doğrulamaları
- e-posta bildirimleri

### 18.2 Mikro metin standardı

Tüm metinler şu özellikleri taşımalıdır:

- kısa
- net
- yönlendirici
- güven veren
- teknik olmayan
- suçlayıcı olmayan

Başarı mesajı kutlama değil sonuç bildirimi olmalıdır. Hata mesajı kullanıcıyı karanlıkta bırakmamalıdır. Uyarı metni korkutmak yerine karar kalitesini artırmalıdır.

### 18.3 Kanal bazlı ton

- public tarafta sade ve güven veren,
- müşteri panelinde süreç odaklı,
- admin panelde kısa ve operasyonel

ton kullanılmalıdır.

### 18.4 E-posta kapsamı

İlk fazda yalnızca kritik e-posta akışları zorunlu tutulmalı; gereksiz bildirim şişkinliğinden kaçınılmalıdır.

---

## 17. Yönetim Paneli ve Operasyonel Kontrol

Admin panel yalnızca CRUD ekranları toplamı değildir; sistemin operasyon merkezi olarak düşünülmelidir.

### 19.1 Temel roller

Admin panel şu beş rolü birlikte taşır:

- Operasyon Merkezi
- Katalog Yönetim Merkezi
- Müşteri ve Teklif Takip Merkezi
- İçerik ve Vitrin Yönetim Alanı
- Sistem Kontrol ve İzleme Alanı

### 19.2 Dashboard yaklaşımı

Dashboard ilk bakışta şu soruları cevaplamalıdır:

- bugün kaç teklif geldi?
- hangileri bekliyor?
- hangileri cevaplandı?
- hangi kayıtlar aksiyon bekliyor?
- katalogda eksik veri var mı?
- son operasyon hareketleri neler?

İlk faz dashboard bileşenleri:

- toplam teklif sayısı
- bekleyen teklif sayısı
- cevaplanan teklif sayısı
- bugün gelen talepler
- son 7 gün teklif grafiği
- teklif durum dağılımı
- son teklif hareketleri
- dikkat gerektiren işler
- kalite / eksik veri uyarıları

### 19.3 Teklif operasyonu

Admin teklif listesi ilk fazın merkez modülüdür. Liste ve detay ekranları kullanıcı tipi, durum, tarih ve firma adı gibi bağlamlarla filtrelenebilmelidir.

### 19.4 Katalog kalite sinyalleri

Admin panel sadece veri girişi değil, veri kalitesi görünürlüğü de üretmelidir. Örneğin:

- ana görsel eksik
- teknik alan eksik
- kullanım alanı boş
- görünürlük parametresi çelişkili

---

## 18. Entegrasyon ve Genişleyebilirlik

Entegrasyon yaklaşımı, üçüncü taraf servislerin uygulamanın çekirdeğini ele geçirmesine izin vermemelidir.

### 20.1 İlk fazta zorunlu entegrasyonlar

- e-posta gönderim altyapısı
- medya saklama altyapısı
- temel analitik altyapısı

### 20.2 E-posta entegrasyonu

İlk fazta:

- tek provider ile başlanacak
- queue tabanlı çalışacak
- retry desteklenecek
- başarısız gönderimler görünür olacak
- admin yeniden gönderim aksiyonu bulunacak
- provider bağımlılığı uygulamaya sert gömülmeyecek

### 20.3 Medya yaklaşımı

İlk faz için:

- local storage kullanılacak
- fakat storage driver bağımsız mimari korunacak
- orijinal dosya saklanacak
- thumb / medium / large preset mantığında kontrollü varyantlar üretilecek
- URL üretimi merkezi medya servisi üzerinden yönetilecek

### 20.4 Genişleyebilirlik yönleri

İleri faza açık ama ilk fazda tam açılmayacak alanlar:

- cloud storage
- SMS / WhatsApp entegrasyonu
- ödeme sistemleri
- ERP / CRM entegrasyonları
- webhook ve harici sistem haberleşmeleri

---

## 19. SEO ve Görünürlük

SEO yaklaşımı katalog bulunabilirliği ağırlıklı olmalıdır; yapay anahtar kelime doldurma veya gereksiz içerik şişkinliği hedeflenmemelidir.

### 21.1 İndeks önceliği olan sayfalar

- ana sayfa
- kategori sayfaları
- ürün detay sayfaları
- kurumsal sayfalar
- gerçekten anlamlıysa marka sayfaları

### 21.2 SEO’ya kapalı veya düşük öncelikli alanlar

- müşteri paneli
- admin paneli
- giriş/kayıt akışlarının çoğu
- teklif listesi ve teklif formu iç ekranları
- filtre kombinasyonlarının türev URL’leri

### 21.3 SEO omurgası

- temiz URL ve slug yapısı
- meta title / description
- Open Graph temeli
- sitemap
- robots kontrolü
- canonical mantığı
- semantik HTML
- mobil uyum ve performans

### 21.4 Teknik ürün SEO yaklaşımı

Bu alanda kullanıcıların çoğu şu kalıplarla arama yapar:

- ürün adı
- ürün kodu
- kategori
- marka + ürün tipi
- kullanım alanı

Dolayısıyla ürün adı, ürün kodu, teknik özet, kategori bağı ve kullanım alanı bilgisi hem UX hem SEO açısından güçlü biçimde görünür olmalıdır.

---

## 20. Test, Kalite ve Release Disiplini

### 22.1 Kalite yaklaşımı

İlk faz için hedef ağır bürokrasi değil; pahalı kırılmaları yakalayan kontrollü kalite hattıdır.

### 22.2 Release checklist kararı

Her production release öncesinde kısa ama zorunlu bir release checklist uygulanmalıdır.

Minimum kontroller:

- ilgili kritik testler geçti
- lint / format temiz
- kırmızı seviyede static analysis sorunu yok
- auth / yetki / sahiplik etkisi gözden geçirildi
- teklif oluşturma akışı kontrol edildi
- admin teklif operasyonu kontrol edildi
- gerekiyorsa mail / event / bildirim davranışı kontrol edildi
- gerekiyorsa migration / veri etkisi incelendi
- kritik hata ve boş durum metinleri bozulmadı
- mobilde kritik akış temel seviyede kontrol edildi

### 22.3 Staging yaklaşımı

Staging ilk faz için mutlak her değişiklikte zorunlu değil; ancak kritik release’lerde güçlü biçimde beklenen kalite katmanıdır.

Özellikle şu değişikliklerde staging doğrulaması önerilmekten çok standart kabul edilmelidir:

- auth / yetki değişiklikleri
- teklif akışı değişiklikleri
- admin teklif operasyonu değişiklikleri
- migration ve veri yapısı değişiklikleri
- mail / event / bildirim değişiklikleri

### 22.4 Post-release smoke kontrolü

Yayın sonrası kısa smoke kontrolü profesyonel standart kabul edilmelidir.

---

## 21. Sürümleme, Ortamlar ve Dağıtım

### 23.1 Ortam yaklaşımı

- Local / Development
- Staging
- Production

Production ortamında hangi sürümün çalıştığı hiçbir zaman belirsiz kalmamalıdır.

### 23.2 Tag disiplini

İlk faz için sade ama izlenebilir, semver-benzeri tag yapısı kullanılmalıdır:

- v0.1.0
- v0.1.1
- v0.2.0
- v1.0.0

Production’a çıkan kritik veya anlamlı her release izlenebilir tag ile işaretlenmelidir.

### 23.3 Release note yaklaşımı

İlk fazta ağır release note sistemi kurulmayacaktır; ancak anlamlı her production yayını için kısa, net ve risk odaklı bir yayın özeti tutulmalıdır.

### 23.4 Rollback ilkesi

Tag disiplini rollback kararını kolaylaştırmalıdır. Son güvenilir release görünür olmalı, kritik yayınlar birbirinden net ayrılmalıdır.

---

## 22. Analitik ve Ölçümleme

Analitik yaklaşımı ilk fazta **tek analitik ekosistem** üzerinden kurulacaktır.

### 24.1 Temel ilkeler

- tek ana analitik omurga
- production ve staging ayrımı net
- event isimleri snake\_case ve davranış odaklı
- parametreler az, anlamlı ve gizlilik uyumlu
- event sözlüğü yazılı ve görünür
- dashboard’a bağlanan event’ler sınırlı ve belgeli

### 24.2 Dashboard’a beslenen çekirdek event’ler

Örnek ilk faz event seti:

- `quote_form_submitted`
- `quote_form_submit_failed`
- `quote_item_added`
- `search_performed`
- `search_no_result`
- `product_detail_viewed`
- `category_selected`

### 24.3 GA / admin dashboard ilişkisi

Google Analytics bağlantısı ilk fazta kurulacak; admin dashboard’a ise tam analitik ekranı değil, karar üretmeye yardımcı özet metrikler yansıtılacaktır.

---

## 23. Dokümantasyon ve Geliştirme Disiplini

Bu proje dokümanları yaşayan ama güvenilir bir kaynak sistemi gibi çalışmalıdır.

### 25.1 Temel ilke

**Karar değişebilir; ama kaynak belirsiz kalmayacaktır.**

### 25.2 Güncelleme sırası

Bir karar değiştiğinde:

1. önce kararın yaşadığı en dar ve güncel kaynak güncellenir,
2. sonra üst çerçeve hizalanır,
3. gerekiyorsa teknik referans güncellenir.

---

## 24. Projenin Nihai Stratejik Çerçevesi

Bu proje için tekilleştirilmiş nihai çerçeve şu şekilde özetlenebilir:

### 26.1 Ürün seviyesi

- proje B2B ağırlıklı, B2C açık yapıdadır
- ilk faz teklif toplama merkezlidir
- üyelik faydalıdır ama teklif için zorunlu değildir
- katalog keşfi ve teklif operasyonu projenin omurgasıdır

### 26.2 Deneyim seviyesi

- public tarafta hızlı keşif ve düşük sürtünmeli teklif akışı hedeflenir
- müşteri panelinde teklif takibi ve tekrar talep değeri üretilir
- admin panelde operasyon hızı ve görünürlük önceliklidir

### 26.3 Mimari seviyesi

- modüler yapı kurulmalıdır
- veri modeli teklif ve katalog omurgasını uzun vadeli taşımalıdır
- görünürlük, satış modu ve teknik özellik yapıları parametrik düşünülmelidir
- üçüncü taraf servisler çekirdeği ele geçirmemelidir

### 26.4 Operasyon seviyesi

- admin dashboard gerçek operasyon sorularına cevap vermelidir
- mail, log, hata ve kalite sinyalleri görünür olmalıdır
- release, staging ve tag disiplini izlenebilir olmalıdır

### 26.5 Disiplin seviyesi

- tek analitik ekosistem kurulmalıdır
- dokümantasyon yaşayan ama güvenilir tutulmalıdır
- karar notları bağlayıcı uygulama kaynağı olarak işletilmelidir
- çoklu ajanlı geliştirme için kaynak çelişkisi bırakılmamalıdır

---

## 25. Sonuç

Web Projesi, teknik ürün kataloğunu güçlü bir teklif operasyonuyla birleştiren; public site, müşteri paneli ve admin paneli arasında dengeli sorumluluk dağıtan; ürün, tasarım, veri, güvenlik, performans, analitik ve teslim disiplinini birlikte ele alan bir yapı olarak tanımlanmalıdır.

