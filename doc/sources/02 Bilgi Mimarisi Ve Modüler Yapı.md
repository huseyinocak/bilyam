# Web Projesi — 02 Bilgi Mimarisi ve Modüler Yapı

Bu doküman, ürün temeli kararlarından sonra sistemin bilgi mimarisini ve modüler yapısını netleştirmek için hazırlanmıştır. Amaç; kullanıcı tarafı, müşteri paneli ve admin panelinin sınırlarını belirlemek, modül sorumluluklarını ayırmak ve sonraki teknik mimari kararlar için düzenli bir iskelet oluşturmaktır.

Bu bölüm, modern web uygulamasında bilgi mimarisi ve modüler yapı ihtiyacını tanımlayan ana çerçeveye dayanır. Ayrıca burada yer alan kararlar, 01A Ürün Temeli çalışmasında netleşen teklif odaklı, B2B ağırlıklı ama B2C’ye açık ürün yaklaşımını esas alır.

---

## 1. Bilgi Mimarisi Neden Kritik?

Bu projede sistem sadece sayfalardan oluşmayacaktır. Ürün kataloğu, teklif sepeti, müşteri üyeliği, teklif yönetimi, içerik alanları ve admin operasyonları birlikte çalışacaktır. Bu nedenle bilgi mimarisi baştan temiz kurulmazsa ileride:
- ekranlar dağınık büyür
- route yapısı karmaşıklaşır
- yetkiler kontrolsüz yayılır
- admin paneli hantallaşır
- müşteri deneyimi tutarsızlaşır

Bu yüzden modüller, kullanıcı tipleri ve ekran alanları erken aşamada net tanımlanmalıdır.

---

## 2. Üst Seviye Alan Ayrımı

Bu projede bilgi mimarisi 3 ana alana ayrılmalıdır:

1. **Public Site (Genel Kullanıcı Alanı)**
2. **Customer Panel (Müşteri Paneli)**
3. **Admin Panel (Yönetim Alanı)**

Bu ayrım hem UX hem güvenlik hem de kod organizasyonu açısından en doğru yaklaşımdır.

### 2.1 Public Site
Bu alan giriş yapmadan erişilebilen vitrindir.

Ana amacı:
- ürün keşfi
- kategori gezinme
- marka görünürlüğü
- kullanım alanına göre keşif
- teklif sepeti oluşturma
- misafir teklif talebi bırakma
- kurumsal güven oluşturma

### 2.2 Customer Panel
Bu alan üye müşterilerin giriş yaptıktan sonra eriştiği kişisel alandır.

Ana amacı:
- teklif geçmişini görmek
- teklif durumlarını takip etmek
- profil ve şirket bilgisini yönetmek
- hızlı tekrar talep oluşturmak
- gelecekte ek müşteri özelliklerine zemin hazırlamak

### 2.3 Admin Panel
Bu alan yöneticilerin ve operasyon ekibinin kullandığı arka ofistir.

Ana amacı:
- ürün ve kategori yönetimi
- marka ve kullanım alanı yönetimi
- teknik özellik şablonları yönetimi
- teklif taleplerini yönetmek
- müşteri kayıtlarını incelemek
- içerik, ayarlar, mail şablonları ve logları yönetmek

---

## 3. Ana Navigasyon Katmanları

### 3.1 Public Site Ana Navigasyonu
İlk faz için public site üst navigasyonunda şu alanlar önerilir:
- Ana Sayfa
- Ürünler
- Kategoriler
- Kurumsal
- İletişim
- Teklif Listem
- Giriş Yap / Kayıt Ol

#### Neden “Markalar” ve “Kullanım Alanları” üst menüde ayrı başlık değil?
Best practice açısından ilk faz için en doğru yaklaşım, üst menüyü gereksiz kalabalıklaştırmamaktır.

Bu nedenle:
- **Markalar** ve **Kullanım Alanları** bağımsız ana menü başlığı olarak üst seviyede yer almayacaktır
- bunlar ürün kataloğu deneyimi içinde güçlü filtre / keşif alanları olarak konumlanacaktır
- ana sayfada öne çıkan bloklar olarak gösterilebilir
- gerektiğinde kendi liste sayfaları yine olabilir, ancak ana navigasyonun birinci katmanını kalabalıklaştırmamalıdır

Bu yaklaşım:
- üst menüyü daha sade tutar
- kullanıcı karar yükünü azaltır
- katalog odaklı yapıyı güçlendirir
- mobil navigasyonda daha temiz görünüm sağlar

### 3.2 Customer Panel Navigasyonu
İlk faz için müşteri panelinde şu menü yapısı önerilir:
- Panel Ana Sayfa
- Tekliflerim
- Hızlı Tekrar Talep
- Profil Bilgilerim
- Şirket Bilgilerim
- Hesap Ayarları

Not: Teklif detayları ayrı route olarak çalışsa da menü mantığında “Tekliflerim” altında konumlanmalıdır.

#### İlk ekran kararı
Müşteri panelinde giriş sonrası direkt teklif listesine düşmek yerine ayrı bir **Panel Ana Sayfa** olacaktır.

Bu panelde modern ve özet bir görünüm sunulmalıdır:
- geçmiş tekliflerim özeti
- bekleyen tekliflerim
- cevaplanan tekliflerim
- son giriş tarihi
- hızlı tekrar talep kısayolu
- profil tamamlama durumu

Bu yaklaşım üyeliğin değerini artırır ve paneli daha profesyonel hissettirir.

### 3.3 Admin Panel Navigasyonu
İlk faz için admin panel ana navigasyon yapısı şu şekilde önerilir:
- Dashboard
- Teklif Talepleri
- Ürünler
- Kategoriler
- Markalar
- Kullanım Alanları
- Teknik Özellik Şablonları
- Müşteriler
- İçerik Yönetimi
- Ana Sayfa / Vitrin
- Form ve Talep Ayarları
- E-posta Şablonları
- Medya Yönetimi
- Genel Ayarlar
- Loglar
- Sistem Araçları

#### Sidebar kararı
Admin panelde **gruplu sidebar yapısı** kullanılacaktır.

Önerilen grup mantığı:
- Operasyon
- Katalog
- Müşteriler
- İçerik
- Sistem

Bu yaklaşım tek düz listeye göre daha profesyonel, ölçeklenebilir ve kullanımı daha rahattır.

---

## 4. Public Site Modül Yapısı

Public site, sadece vitrinden ibaret düşünülmemelidir. Bu alan teklif üretiminin başlangıç noktasıdır.

### 4.1 Ana Sayfa Modülü
Amaç:
- güven oluşturmak
- öne çıkan ürünleri ve kategorileri göstermek
- teklif akışına yönlendirmek
- marka ve kullanım alanı keşfini kolaylaştırmak

İçerikler:
- hero alanı
- öne çıkan kategoriler
- öne çıkan ürünler
- markalar
- kullanım alanları blokları
- teklif CTA alanları
- kurumsal güven blokları

### 4.2 Ürün Kataloğu Modülü
Amaç:
- ürün keşfini ve filtrelemeyi sağlamak

Alt parçalar:
- ürün listeleme
- kategori filtreleme
- marka filtreleme
- kullanım alanı filtreleme
- ürün kodu arama
- ürün adı arama
- sıralama
- sayfalama
- katalog içi detaylı filtreleme

### Arama yaklaşımı kararı
İlk fazda hem **global arama** hem de **katalog merkezli arama** birlikte kullanılacaktır.

#### Neden iki yapı birlikte olabilir?
Evet, iki yapının birlikte olması sorun değildir; doğru kurgulanırsa bu daha güçlü bir UX sağlar.

**Global arama ne işe yarar?**
- kullanıcıya her yerden hızlı erişim verir
- üst bölümde modern ve görünür bir giriş noktası oluşturur
- ürün adı, ürün kodu ve temel eşleşmeler için hızlı keşif sağlar

**Katalog merkezli arama ne işe yarar?**
- filtrelerle birlikte derinleşen arama sağlar
- kategori, marka ve kullanım alanı bağlamında daha kontrollü sonuç üretir
- teknik ürünlerde daha profesyonel kullanım sunar

#### En doğru model
Bu projede önerilen model:
- header bölümünde modern bir **global arama alanı** bulunur
- ürün kataloğu sayfasında ise filtrelerle çalışan daha detaylı **katalog içi arama** yer alır

Bu iki yapı birbiriyle çakışmaz; tam tersine biri hızlı giriş, diğeri detaylı keşif katmanı olur.

### 4.3 Ürün Detay Modülü
Amaç:
- ürün hakkında yeterli karar bilgisi vermek
- teklif sepetine ekleme aksiyonunu öne çıkarmak

İçerikler:
- ürün adı
- ürün kodu
- marka
- kategori
- çoklu görseller
- ana görsel
- teknik özellik tablosu
- kullanım alanları
- fiyat / stok görünürlüğü parametreye bağlı alanlar
- teklif listesine ekle butonu

### 4.4 Teklif Sepeti Modülü
Amaç:
- birden fazla ürün için tek talepte teklif toplamak

Özellikler:
- ürün satırları
- adet alanı
- satır notu
- satır silme / güncelleme
- toplam talep özeti
- misafir veya üye akışına yönlendirme

### Teklif sepeti davranışı kararı
İlk faz için en doğru yaklaşım **kalıcı mini teklif sepeti + tam teklif sepeti sayfası** birlikte kullanmaktır.

#### Neden?
Sadece ayrı bir teklif sepeti sayfası kullanılırsa kullanıcı sepetinde ürün olup olmadığını her zaman fark etmeyebilir.
Sadece mini sepet ile kalınırsa da düzenleme ve detay kontrolü yetersiz kalır.

Bu nedenle önerilen UX modeli:
- header veya uygun bir alanda teklif listesi göstergesi bulunur
- kullanıcı eklediği ürün sayısını anlık görür
- mini panel / drawer mantığı ile hızlı özet açılabilir
- detaylı düzenleme ise tam teklif sepeti sayfasında yapılır

Bu model:
- modern görünür
- dönüşümü destekler
- kullanıcıya kontrol hissi verir
- mobilde de iyi çalışır

### 4.5 Teklif Talep Formu Modülü
Amaç:
- kullanıcı bilgilerini toplamak
- teklif talebini tamamlamak

Alan mantığı:
- ad soyad
- e-posta
- telefon
- firma adı (opsiyonel)
- not alanı
- KVKK / onay alanları

### 4.6 Kurumsal İçerik Modülü
Alanlar:
- hakkımızda
- hizmet yaklaşımı
- satış / teslimat bilgileri
- iletişim
- sabit sayfalar

---

## 5. Customer Panel Modül Yapısı

Customer panel ilk fazda hafif ama anlamlı olmalıdır. Gereksiz şişmemeli, ama üyeliğin faydasını hissettirmelidir.

### 5.1 Panel Ana Sayfa
Gösterilebilecek özetler:
- son teklifler
- bekleyen teklifler
- cevaplanan teklifler
- hızlı tekrar talep aksiyonları
- profil tamamlama durumu

### 5.2 Tekliflerim Modülü
Amaç:
- kullanıcının tüm teklif geçmişini listelemek

Liste içeriği:
- teklif numarası
- tarih
- teklif durumu
- ürün sayısı
- toplam satır adedi
- detay bağlantısı

### 5.3 Teklif Detay Modülü
Amaç:
- teklifin ürün bazlı durumunu göstermek

İçerikler:
- teklif genel bilgisi
- teklif satırları
- her ürün için adet
- admin cevabı varsa fiyat / açıklama / termin
- durum geçmişi
- mail gönderim bilgisi özeti gerekiyorsa ileride eklenebilir

### 5.4 Hızlı Tekrar Talep Modülü
Amaç:
- geçmiş bir tekliften hızlı yeni talep oluşturmak

Yaklaşım:
- eski talebin ürün satırlarını yeni teklif sepetine aktarma
- adetleri düzenleyebilme
- yeniden talep oluşturma

### 5.5 Profil ve Şirket Bilgileri Modülü
Alanlar:
- ad soyad
- e-posta
- telefon
- firma adı
- vergi bilgileri (ileri faz için opsiyonel)
- adres bilgileri (ileri faz için opsiyonel)

İlk faz notu:
- şirket bilgisi zorunlu değildir
- bireysel kullanıcı deneyimi de desteklenir

### 5.6 Hesap Ayarları Modülü
- şifre değiştirme
- e-posta doğrulama durumu
- temel hesap ayarları

---

## 6. Admin Panel Modül Yapısı

Admin panel modülleri operasyonel yoğunluğa göre gruplanmalıdır.

### 6.1 Operasyon Modülleri
- Dashboard
- Teklif Talepleri
- Müşteriler

### 6.2 Katalog Modülleri
- Ürünler
- Kategoriler
- Markalar
- Kullanım Alanları
- Teknik Özellik Şablonları

### 6.3 İçerik Modülleri
- İçerik Yönetimi
- Ana Sayfa / Vitrin
- Medya Yönetimi
- E-posta Şablonları

### 6.4 Sistem Modülleri
- Genel Ayarlar
- Form ve Talep Ayarları
- Yönetici Kullanıcılar
- Rol / İzin Yönetimi
- Loglar
- Sistem Araçları

Bu gruplanma, menü kalabalığını azaltır ve yönetim tarafında bilişsel yükü düşürür.

---

## 7. Yetki ve Görünürlük Katmanları

Bilgi mimarisi sadece modül listesinden ibaret değildir; kim neyi görecek sorusu da netleşmelidir.

### 7.1 Public Kullanıcı
- katalogu görür
- ürün detayını görür
- teklif sepeti oluşturur
- misafir teklif bırakabilir
- kayıt olabilir

### 7.2 Üye Müşteri
- public alan erişimlerine ek olarak
- müşteri paneline erişir
- teklif geçmişini görür
- teklif detayını görür
- profilini günceller
- hızlı tekrar talep oluşturur

### 7.3 Admin / Operasyon Kullanıcısı
- admin paneline erişir
- yetkisine göre modül bazlı işlem yapar

### 7.4 Süper Admin
- tüm modüllere erişir
- sistem ayarlarını yönetir
- rol ve izinleri yönetir

---

## 8. Route ve URL Mantığı İçin Üst Seviye Öneri

Teknik detaya tam girmeden, bilgi mimarisi açısından route ayrımı baştan temiz tutulmalıdır.

Önerilen mantık:
- `/` → public site
- `/products` → ürün kataloğu
- `/products/{slug}` → ürün detay
- `/categories/{slug}` → kategori görünümü
- `/brands/{slug}` → marka görünümü
- `/use-cases/{slug}` → kullanım alanı görünümü
- `/quote-cart` → teklif sepeti
- `/quote-request` → teklif formu
- `/login`, `/register` → müşteri auth
- `/account/...` → müşteri paneli
- `/admin/...` → admin paneli

Bu ayrım hem kullanıcı zihni hem Laravel route organizasyonu için doğrudur.

---

## 9. Modüler Geliştirme Mantığı

Bu projede modülerlik sadece klasör düzeni değil, geliştirme disiplini anlamına da gelmelidir.

Her modül için mümkün olduğunca şu parçalar net olmalıdır:
- amaç
- ana ekranlar
- veri yapıları
- yetkiler
- kullanıcı akışları
- admin akışları
- validasyon kuralları
- gelecekte genişleme alanı

İlk fazda modül bazlı geliştirme sırası önerisi:
1. Auth ve kullanıcı temeli
2. Katalog yapısı
3. Ürün detay
4. Teklif sepeti
5. Teklif talep akışı
6. Admin teklif yönetimi
7. Müşteri paneli
8. İçerik / ayarlar / mail şablonları
9. Analitik ve operasyon iyileştirmeleri

---

## 10. Ana Sayfa Blok Sırası İçin Karar

Verilen referanslar birlikte değerlendirildiğinde en doğru yaklaşım şudur:
- public tarafta genel görsel dil ve modern vitrin yaklaşımı için Amerce benzeri temiz ve çağdaş bir sunum dili **görsel esinleme kaynağı** olarak değerlendirilecektir *(https://tfamerce.vercel.app/home-construction.html)*
- kategori sunum mantığında ise Toptanbilya ana sayfasındaki “Geniş Ürün Kategorilerimiz” bölümüne benzer kart/grid yaklaşımı **görsel ve yapısal esinleme** olarak esas alınacaktır *(https://toptanbilya.com/)*
- admin panelde ise Velzon Analytics benzeri kart + grafik + özet metrik yaklaşımı **görsel esinleme kaynağı** olarak kullanılacaktır *(https://themesbrand.com/velzon/html/master/dashboard-analytics.html)*

### Önemli not
Bu theme ve sayfalar, projenin yönünü belirleyen zorunlu kalıplar değildir. Sadece görsel ilham, düzen yaklaşımı ve UI/UX referansı olarak değerlendirilecektir.

### Bu karar neden doğru?
Amerce benzeri yaklaşım güçlü hero alanı, modern vitrin dili ve temiz blok yapısı sağlar. Toptanbilya’daki kategori bölümü ise teknik ürün dünyasında daha doğrudan, anlaşılır ve keşfi hızlandıran kategori kart yapısı sunar. Velzon Analytics yaklaşımı da yönetim tarafında metrik kartları, grafikler ve analitik özet paneller için güçlü bir admin referansı verir.

### Önerilen ana sayfa blok sırası
İlk faz için en doğru ana sayfa akışı aşağıdaki gibi olmalıdır:

1. **Hero / Üst Vitrin Alanı**
   - güçlü başlık
   - kısa değer önerisi
   - ana CTA: Ürünleri İncele
   - ikincil CTA: Teklif Al
   - global arama alanı

2. **Hızlı Güven / Servis Şeridi**
   - geniş ürün çeşitliliği
   - hızlı teklif
   - güvenilir tedarik
   - hızlı dönüş / teslimat

3. **Geniş Ürün Kategorilerimiz**
   - Toptanbilya benzeri kart/grid mantığı
   - görsel + başlık + kısa açıklama + incele bağlantısı
   - bu blok ana keşif omurgası olacaktır

4. **Öne Çıkan Ürünler**
   - vitrinsel ürün kartları
   - teklif listesine ekleme aksiyonu
   - marka / ürün kodu / kısa teknik bilgi

5. **Kullanım Alanına Göre Keşfet**
   - etiket / kart mantığında kullanım alanları
   - örnek: konkasör, tarım makineleri, elektrik motorları vb.

6. **Marka Alanı**
   - güven veren marka logoları veya marka kartları
   - kataloğa giriş destekleyici blok

7. **Teklif Süreci Nasıl İşler?**
   - 3 veya 4 adımlı basit akış
   - ürün seç
   - teklif listene ekle
   - talebi gönder
   - dönüş al

8. **Neden Bizi Tercih Etmelisiniz?**
   - güven blokları
   - kalite
   - ürün çeşitliliği
   - hızlı geri dönüş
   - sektörel deneyim

9. **Kurumsal / Hakkımızda Kısa Alan**
   - kısa tanıtım metni
   - kurumsal sayfaya yönlendirme

10. **İletişim + Hızlı Teklif CTA Alanı**
   - telefon
   - WhatsApp
   - e-posta
   - hızlı teklif çağrısı

11. **Footer**
   - kurumsal linkler
   - iletişim
   - hesap bağlantıları
   - yasal metinler

### Neden bu sıra en doğru?
Bu akışta kullanıcı önce ne sunduğunu anlar, sonra güven hisseder, ardından kategoriler üzerinden keşfe girer. Teknik ürün projelerinde kategori tabanlı keşif çoğu zaman ürün vitrini kadar hatta daha kritik olduğundan kategori alanı hero sonrası erken konumlanmalıdır. Öne çıkan ürünler ve kullanım alanları ise kategori keşfini derinleştirir. Süreç anlatımı ve güven blokları da teklif dönüşümünü destekler.

---

## 11. Netleşen Ek Karar

### Ürün kataloğunda filtre yapısı
İlk faz için ürün kataloğunda **hibrit filtre yapısı** kullanılacaktır.

#### Bunun anlamı
- üst tarafta hızlı filtre / sıralama / görünüm kontrol alanı bulunur
- sol tarafta daha detaylı filtre paneli yer alır
- mobilde bu filtreler drawer / sheet mantığıyla açılabilir

#### Neden hibrit yapı en doğru seçenek?
Teknik ürün projelerinde kullanıcıların bir kısmı hızlı daraltma isterken, bir kısmı detaylı filtrelerle çalışır. Sadece üst bar kullanılırsa derin filtreleme zayıflar. Sadece sol panel kullanılırsa özellikle mobil ve hızlı kullanım tarafı ağırlaşır.

Bu nedenle hibrit model:
- masaüstünde güçlü keşif sağlar
- mobilde kontrollü sadeleşir
- modern görünür
- teknik ürün kataloglarına daha uygundur

---

## 12. Netleşen Ek Karar

### Ürün detay sayfasında teklif CTA yerleşimi
İlk faz için en doğru yaklaşım, **iki kolonlu ürün detay düzeni + sağ tarafta aksiyon odaklı teklif alanı + mobilde sticky CTA** modelidir.

#### Önerilen masaüstü düzeni
**Sol blok:**
- ana görsel
- görsel galerisi / küçük görseller

**Orta / ana bilgi bloğu:**
- ürün adı
- ürün kodu
- marka
- kategori
- kullanım alanı etiketleri
- kısa açıklama
- görünürse fiyat / stok bilgisi

**Sağ aksiyon bloğu:**
- adet seçimi
- teklif listesine ekle butonu
- hızlı iletişim yardımcı aksiyonu
- kısa güven mesajları
- paylaşım / favori gibi alanlar ileri faza bırakılabilir

#### Neden sağ blokta CTA daha doğru?
Teklif odaklı ürünlerde kullanıcı ürün bilgisini inceledikten sonra ana aksiyonu net ve sabit bir yerde görmelidir. Sağ blok bu yüzden en güçlü yerdir:
- aksiyon görünürlüğü artar
- bilgi ve aksiyon ayrışır
- masaüstünde profesyonel görünür
- teknik ürün sayfalarında daha kontrollü deneyim sağlar

#### Mobil davranış
Mobilde ayrı bir yaklaşım gereklidir:
- sayfa içinde ürün bilgileri ve teknik özet normal akışta görünür
- alt kısımda **sticky CTA bar** bulunur
- bu alanda en azından “Teklif Listesine Ekle” aksiyonu sabit görünür
- gerekirse adet seçimi butona basınca sheet / drawer ile açılabilir

Bu yaklaşım mobil dönüşüm için en doğru çözümlerden biridir.

#### Teknik özellik tablosu nerede olmalı?
Teknik özellik tablosu ürün üst bilgisinin içinde sıkıştırılmamalıdır.

En doğru yerleşim:
- üst bölümde kısa teknik özet verilebilir
- detaylı teknik özellik tablosu ise alt bölümde sekme / akordeon / bölüm yapısı içinde yer almalıdır

Önerilen sıralama:
1. üst bölümde temel ürün bilgisi + CTA
2. hemen altında kısa açıklama
3. ardından teknik özellikler bölümü
4. gerekiyorsa kullanım alanı / benzer ürün / ilgili ürün alanları

#### Marka / ürün kodu / kullanım alanı nasıl gösterilmeli?
Best practice açısından ürün kimliği üst alanda net görünmelidir.

Önerilen gösterim:
- ürün adı ana başlık
- ürün kodu ve marka başlığın hemen altında veya yanında ikincil bilgi olarak
- kategori breadcrumb ile desteklenebilir
- kullanım alanları ise badge / tag mantığında gösterilmelidir

Bu yapı:
- teknik alıcı için gerekli kimlik bilgisini hızlı verir
- sayfayı yormaz
- kullanım alanlarını daha taranabilir hale getirir

#### Önerilen ürün detay sayfası akışı
1. breadcrumb
2. ürün ana alanı
   - görseller
   - ürün bilgileri
   - sağ aksiyon bloğu
3. kısa açıklama
4. teknik özellik tablosu
5. kullanım alanları
6. benzer / ilgili ürünler
7. alt CTA veya iletişim destek bloğu

#### Sonuç
İlk faz için ürün detay sayfasında:
- masaüstünde sağ aksiyon bloğu kullanılacak
- mobilde sticky teklif CTA olacak
- teknik özellik tablosu alt bölümde konumlanacak
- marka, ürün kodu ve kullanım alanı üst bilgi alanında temiz ve taranabilir şekilde gösterilecek

---

## 13. Netleşen Ek Kararlar

### Mobil menü ve mobil arama davranışı
İlk faz için mobil tarafta en doğru yaklaşım, **drawer tabanlı menü + görünür mobil arama + teklif listesi göstergesi** modelidir.

#### Önerilen mobil header davranışı
Mobil üst alanda şu yapı yer almalıdır:
- hamburger menü
- logo
- arama ikonu veya görünür kompakt arama alanı
- teklif listesi göstergesi
- gerekirse hesap ikonu

#### Menü davranışı
Mobil menü tam ekran veya güçlü bir drawer yapısıyla açılmalıdır.

Menü içinde sıralama şu mantıkla önerilir:
1. Ana Sayfa
2. Ürünler
3. Kategoriler
4. Kurumsal
5. İletişim
6. Teklif Listem
7. Giriş Yap / Kayıt Ol veya Hesabım

#### Mobil arama davranışı
Mobil arama gizli ve zor bulunan bir yapı olmamalıdır.

En doğru model:
- header’da arama erişimi görünür olur
- tıklandığında genişleyen arama alanı veya full-width arama katmanı açılır
- kullanıcı ürün adı, ürün kodu ve temel eşleşmelerle hızlı sonuç görebilir
- detaylı filtre ihtiyacı için katalog sayfasına yönlenebilir

#### Neden bu yaklaşım en doğru?
- mobilde ekran alanı korunur
- arama gizlenmez
- teklif listesi farkındalığı devam eder
- teknik ürün arayan kullanıcı hızlı giriş yapabilir
- menü ve arama birbirini boğmaz

### Customer panel dashboard’ında ilk açılışta gösterilecek kartlar
İlk faz için müşteri panel dashboard’ı sade ama faydalı olmalıdır.

#### İlk açılışta önerilen kart sırası
1. **Bekleyen Tekliflerim**
2. **Cevaplanan Tekliflerim**
3. **Toplam Teklif Geçmişim**
4. **Son Teklif Talebim**
5. **Hızlı Tekrar Talep**
6. **Profil / Şirket Bilgisi Tamamlama Durumu**
7. **Son Giriş Tarihi**

#### Neden bu sıra?
Kullanıcının ilk ihtiyacı aktif süreçleri görmek olduğundan bekleyen ve cevaplanan teklifler en üstte yer almalıdır. Geçmiş ve son talep bilgileri ikinci seviyede gelir. Hızlı tekrar talep ve profil tamamlama ise kullanım kolaylığını artıran destekleyici alanlardır.

#### Görsel öneri
- üst sırada 3 veya 4 özet KPI kartı
- altında son teklifler listesi / tablo
- yanında hızlı aksiyon kartı
- daha altta profil tamamlama ve son giriş bilgisi

### Admin dashboard’da ilk sırada yer alması gereken kartlar
Admin panelde ilk görünüm hem operasyonel önceliği hem görsel dengeyi korumalıdır.

#### İlk sıra için önerilen kartlar
1. **Bekleyen Teklif Talepleri**
2. **Bugün Gelen Talepler**
3. **Cevaplanan Teklifler**
4. **Toplam Teklif Sayısı**

#### İkinci sıra için önerilen kartlar
- toplam ürün sayısı
- toplam kategori sayısı
- toplam marka sayısı
- toplam üye müşteri sayısı

#### Üçüncü sıra için önerilen görsel alanlar
- son 7 gün teklif grafiği
- son 30 gün teklif grafiği
- teklif durum dağılımı grafiği

#### Sonraki alanlar
- en çok teklif alan ürünler
- en çok teklif alan kategoriler
- en çok görüntülenen ürünler
- trafik kaynakları özeti
- cihaz kırılımı
- son teklif hareketleri
- eksik veri / kritik uyarılar

#### Neden bu sıralama en doğru?
Admin tarafında ilk bakışta aksiyon gerektiren veriler görünmelidir. Bu yüzden teklif operasyonu en üste alınır. Envanter ve sistem büyüklüğü ikinci sırada gelir. Grafikler ise karar destek katmanı olarak bunların altında konumlanır.

### Katalog liste görünümü
İlk fazda katalogda **grid / liste geçişi** desteklenecektir.

#### Neden tek tip yerine geçiş desteklenmeli?
- bazı kullanıcılar görsel odaklı keşif ister
- bazı kullanıcılar daha yoğun teknik veri görmek ister
- teknik ürünlerde liste görünümü çoğu zaman verimlidir
- vitrinsel keşif için ise grid daha güçlüdür

Bu nedenle iki görünüm birlikte desteklenmelidir.

#### Önerilen varsayılan görünüm
Varsayılan görünüm **grid** olabilir.
Çünkü ilk karşılaşmada daha modern ve taranabilir görünür. Ancak kullanıcı isterse liste görünümüne geçebilmelidir.

### Ürün detay altında benzer ve ilgili ürün gösterimi
İlk fazda ürün detay altında **hem benzer ürünler hem ilgili ürünler** gösterilecektir.

#### Sıralama
1. **Benzer Ürünler**
2. **İlgili Ürünler**

Bu sıralama doğrudur çünkü kullanıcı önce alternatif eşdeğer ürünleri, sonra tamamlayıcı veya bağlantılı ürünleri görmek ister.

#### Ürün sayısı önerisi
UI/UX açısından ilk görünümde her blok için **8 ürün** gösterilmesi en dengeli yaklaşımdır.

Neden 8?
- masaüstünde 4x2 veya uygun grid ile dengeli görünür
- mobilde aşırı uzamaz
- yeterli çeşit hissi verir
- performans ve dikkat dağınıklığı açısından kontrollüdür

#### Tümünü göster aksiyonu
Her iki blokta da:
- “Tümünü Göster” bağlantısı / butonu yer almalıdır
- kullanıcı ilgili liste sayfasına veya filtrelenmiş ürün görünümüne yönlenebilir

---

## 14. Ön Sonuç

Bu aşamada önerilen bilgi mimarisi şu omurgaya dayanır:
- public site = keşif ve teklif üretimi
- customer panel = teklif takibi ve hesap kolaylığı
- admin panel = operasyon ve içerik yönetimi
- katalog, teklif ve yönetim alanları net ayrılır
- route yapısı baştan domain mantığında temiz kurulur
- modüller sorumluluklarına göre gruplanır
- yetki katmanları erken aşamada tanımlanır
- public üst menü sade tutulur
- global arama ve katalog içi arama birlikte çalışır
- teklif sepeti mini sepet + tam sayfa modeliyle ilerler
- admin panel gruplu sidebar ile kurgulanır
- müşteri paneli girişte özet dashboard sunar
- ana sayfa blok sırası kategori keşfi ve teklif dönüşümü odaklı kurulur
- referans theme’lar yalnızca görsel esinleme kaynağı olarak değerlendirilir
- ürün kataloğunda hibrit filtre yapısı tercih edilir
- ürün detay sayfasında sağ aksiyon bloğu ve mobil sticky CTA yaklaşımı benimsenir
- mobil menü drawer mantığında, mobil arama görünür erişimle kurgulanır
- customer panel dashboard’ı süreç odaklı kartlar içerir
- admin dashboard’ı önce aksiyon gerektiren teklif metriklerini gösterir
- katalogda grid / liste geçişi desteklenir
- ürün detay altında önce benzer, sonra ilgili ürünler gösterilir

Bu doküman, sonraki aşamada Laravel tarafındaki modül, klasör, route ve panel mimarisini netleştirmek için temel olacaktır.

Bu aşamada önerilen bilgi mimarisi şu omurgaya dayanır:
- public site = keşif ve teklif üretimi
- customer panel = teklif takibi ve hesap kolaylığı
- admin panel = operasyon ve içerik yönetimi
- katalog, teklif ve yönetim alanları net ayrılır
- route yapısı baştan domain mantığında temiz kurulur
- modüller sorumluluklarına göre gruplanır
- yetki katmanları erken aşamada tanımlanır
- public üst menü sade tutulur
- global arama ve katalog içi arama birlikte çalışır
- teklif sepeti mini sepet + tam sayfa modeliyle ilerler
- admin panel gruplu sidebar ile kurgulanır
- müşteri paneli girişte özet dashboard sunar
- ana sayfa blok sırası kategori keşfi ve teklif dönüşümü odaklı kurulur
- referans theme’lar yalnızca görsel esinleme kaynağı olarak değerlendirilir ve ilgili bağlantılar dokümanda belirtilir
- ürün kataloğunda hibrit filtre yapısı tercih edilir
- ürün detay sayfasında sağ aksiyon bloğu ve mobil sticky CTA yaklaşımı benimsenir

Bu doküman, sonraki aşamada Laravel tarafındaki modül, klasör, route ve panel mimarisini netleştirmek için temel olacaktır.



