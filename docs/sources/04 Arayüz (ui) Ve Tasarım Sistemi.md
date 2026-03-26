# Web Projesi — 04 Arayüz (UI) ve Tasarım Sistemi

Bu doküman, ürün temeli, bilgi mimarisi ve kullanıcı deneyimi kararlarından sonra, projenin görsel dilini ve tasarım sistemi yaklaşımını netleştirmek için hazırlanmıştır. Amaç; public site, müşteri paneli ve admin panelinde tekrar kullanılabilir, tutarlı, modern ve markaya uygun bir arayüz sistemi tanımlamaktır.

Bu bölüm, modern web uygulamalarında UI ve tasarım sisteminin; renk, tipografi, boşluk, grid, ortak bileşenler, durum stilleri ve responsive yaklaşım üzerine kurulması gerektiğini kabul eden ana çerçeveye dayanır. fileciteturn3file0 Ayrıca burada tanımlanan UI kararları, teklif odaklı ürün yapısı, 3 katmanlı bilgi mimarisi ve önceki UX kararları üzerine inşa edilecektir. fileciteturn3file2 fileciteturn3file1 fileciteturn3file3

---

## 1. UI ve Tasarım Sistemi Bu Projede Ne Anlama Geliyor?

Bu projede tasarım sistemi, sadece birkaç renk ve buton stili belirlemek değildir. Asıl hedef şudur:
- her ekranın sıfırdan tasarlanmaması
- public site, customer panel ve admin panel arasında kontrollü tutarlılık kurulması
- geliştirmenin hızlanması
- Codex ile üretilecek arayüzlerin ortak bir dilde ilerlemesi
- bakım ve genişletme maliyetinin düşmesi

Bu projede iyi UI şu sonucu üretmelidir:
- modern ve güven veren görünüm
- teknik ürün dünyasına uygun ciddiyet
- anlaşılır görsel hiyerarşi
- teklif odaklı CTA’ların güçlü görünmesi
- yoğun veri alanlarında düzen hissi

---

## 2. Tasarım Sistemi Katmanları

Bu proje için tasarım sistemi 4 ana katmanda düşünülmelidir:

1. **Foundation (Temel Görsel Kurallar)**
2. **Components (Bileşenler)**
3. **Patterns (Kullanım Kalıpları)**
4. **Layouts (Sayfa Yerleşimleri)**

### 2.1 Foundation
Bu katman şunları kapsar:
- renk sistemi
- tipografi sistemi
- boşluk sistemi
- radius / border sistemi
- gölge sistemi
- ikon yaklaşımı
- grid / container mantığı

### 2.2 Components
Tekrar kullanılabilir UI parçaları:
- butonlar
- input alanları
- select / checkbox / radio
- kartlar
- badge / rozetler
- tablolar
- modal / drawer / sheet yapıları
- breadcrumb
- pagination
- tabs / accordion
- toast / alert

### 2.3 Patterns
Tekrar eden deneyim kalıpları:
- arama + filtre alanı
- teklif listesine ekleme akışı
- boş durum kartları
- form section düzeni
- dashboard KPI satırı
- ürün kartı
- ürün detay hero alanı

### 2.4 Layouts
Sayfa iskeletleri:
- public ana sayfa düzeni
- katalog düzeni
- ürün detay düzeni
- müşteri panel düzeni
- admin dashboard düzeni
- admin form düzeni

---

## 3. Görsel Dil Yaklaşımı

Bu projede görsel dil iki uç arasında dengede olmalıdır:
- fazla kurumsal ve soğuk olmamalı
- fazla oyuncak / dekoratif de olmamalı

### Görsel karakter
Önerilen görsel karakter:
- temiz
- modern
- güven veren
- düzenli
- okunaklı
- teknik ürünlere uygun
- gereksiz efektlerden uzak

### Public site için görsel yaklaşım
Public tarafta:
- vitrinsel ama abartısız
- güçlü başlıklar
- temiz kategori kartları
- net CTA’lar
- ferah boşluk kullanımı
- ürün ve teklif aksiyonunu öne çıkaran yapı

### Customer panel için görsel yaklaşım
Customer panel:
- sıcak ama profesyonel
- özet kart + liste dengesi
- rahat okunur durum rozetleri
- kullanıcıyı boğmayan veri yoğunluğu

### Admin panel için görsel yaklaşım
Admin panel:
- operasyonel
- düzenli
- analitik odaklı
- bilgi hiyerarşisi güçlü
- kart, tablo ve grafiklerin dengeli kullanıldığı yapı

---

## 4. Renk Sistemi

Bu aşamada nihai marka paleti ayrı bir dokümanda netleştirilebilir; ancak UI sistemi için şimdiden renk rolleri tanımlanmalıdır.

### 4.1 Renkler isimle değil rolle tanımlanmalı
Best practice açısından renk sistemi doğrudan “mor”, “yeşil”, “gri” diye değil, kullanım rolüne göre tanımlanmalıdır.

Önerilen rol tabanlı yapı:
- **Primary**
- **Secondary**
- **Accent**
- **Success**
- **Warning**
- **Danger**
- **Info**
- **Surface**
- **Background**
- **Border**
- **Text Primary**
- **Text Secondary**
- **Text Muted**

### 4.2 Kullanım mantığı
- **Primary:** ana CTA’lar, aktif durumlar, vurgu alanları
- **Secondary:** ikincil aksiyonlar ve destekleyici vurgu
- **Accent:** küçük dikkat çekici alanlar
- **Success:** başarılı işlem ve olumlu durumlar
- **Warning:** dikkat gerektiren ama kritik olmayan durumlar
- **Danger:** iptal, silme, kritik hata
- **Info:** bilgilendirici alanlar

### 4.3 UI notu
Public, customer ve admin tarafında aynı temel renk token sistemi kullanılmalı; ancak ton yoğunluğu alan bazında farklılaştırılabilir.

Örnek:
- public tarafta primary daha görünür ve CTA odaklı olabilir
- admin tarafta aynı renk ailesi daha kontrollü ve operasyonel kullanılabilir

---

## 5. Tipografi Sistemi

Tipografi bu projede güven ve okunabilirlik üretecek ana katmanlardan biridir.

### 5.1 Hedef
- başlıklar güçlü ama kaba olmamalı
- metinler rahat okunmalı
- teknik bilgi alanları sıkışık hissettirmemeli
- dashboard ve tablo ekranlarında okunabilirlik korunmalı

### 5.2 Tipografi yapısı
Önerilen seviye mantığı:
- Display
- H1
- H2
- H3
- H4
- Body Large
- Body
- Body Small
- Caption
- Label

### 5.3 Kullanım prensibi
- public ana sayfada daha güçlü başlık ölçeği
- ürün detay ve katalogda dengeli başlık + bilgi hiyerarşisi
- admin ve panel tarafında daha kompakt ama okunabilir metin yapısı

### 5.4 Teknik veri alanları
Ürün kodu, teknik değer, tablo başlığı gibi alanlarda:
- düzenli hizalama
- monospaced font zorunlu değil
- ama daha mekanik ve taranabilir görünüm düşünülebilir

---

## 6. Boşluk, Grid ve Container Sistemi

Tutarlı UI’nin en kritik parçalarından biri boşluk sistemidir.

### 6.1 Boşluk sistemi
Arayüz rastgele margin/padding ile değil, token mantığıyla ilerlemelidir.

Önerilen yaklaşım:
- küçük boşluk
- orta boşluk
- büyük boşluk
- section arası daha büyük boşluk

Geliştirme tarafında bu değerler tasarım token mantığında sabitlenmelidir.

### 6.2 Grid yaklaşımı
#### Public site
- geniş container
- section bazlı nefes alan yapı
- kart grid’leri
- hero ve kategori bloklarında güçlü görsel hiyerarşi

#### Customer panel
- 12 kolon mantığı korunabilir
- kart + tablo + yan blok dengesi

#### Admin panel
- dashboard için widget grid mantığı
- form sayfalarında section container yapısı
- tablo ekranlarında tam genişlik alanlar

---

## 7. Köşe Yuvarlaklığı, Border ve Gölge Sistemi

### 7.1 Radius
Bu projede radius sistemi modern ama kontrollü olmalıdır.

Öneri:
- küçük radius: input, küçük badge
- orta radius: kartlar, butonlar
- büyük radius: hero arama kutusu, öne çıkan panel veya drawer yüzeyleri

### 7.2 Border
Border kullanımı hafif ve düzen hissi üreten yapıda olmalıdır.
Çok koyu veya ağır border sisteminden kaçınılmalıdır.

### 7.3 Gölge
Gölge sistemi abartılı olmamalıdır.
Önerilen yaklaşım:
- public tarafta hafif derinlik veren kart gölgeleri
- customer panelde sade gölge / yüzey ayrımı
- admin panelde minimal, okunabilirliği bozmayan gölgeler

---

## 8. Bileşen Sistemi

### 8.1 Buton Sistemi
İlk fazda minimum şu buton tipleri tanımlanmalıdır:
- Primary Button
- Secondary Button
- Ghost Button
- Danger Button
- Icon Button
- Link Button

Durumlar:
- default
- hover
- focus
- active
- disabled
- loading

### 8.2 Form Alanları
Gerekli alanlar:
- text input
- textarea
- select
- multi-select
- checkbox
- radio
- switch
- number input
- search input

Hepsinde ortak davranışlar tanımlanmalıdır:
- label
- helper text
- error text
- required işareti
- disabled görünüm

### 8.3 Kart Sistemi
Bu projede kartlar çok önemli olacaktır.
Tanımlanması gereken kart tipleri:
- kategori kartı
- ürün kartı
- KPI kartı
- bilgi kartı
- boş durum kartı
- hızlı aksiyon kartı

### 8.4 Badge / Rozet Sistemi
Rozetler şu alanlarda yoğun kullanılacaktır:
- teklif durumları
- aktif / pasif durumları
- ürün etiketleri
- kullanım alanı tag’leri

### 8.5 Tablo Sistemi
Özellikle admin ve müşteri panelde kritik olacaktır.
Düşünülmesi gerekenler:
- yoğun satır yapısı
- okunur başlıklar
- satır aksiyonları
- responsive fallback
- boş durum
- loading durumu

### 8.6 Modal / Drawer / Sheet
İlk fazda şu kalıplar desteklenmelidir:
- onay modalları
- hızlı görünüm drawer’ları
- mobil filtre sheet’leri
- mini teklif listesi drawer’ı

---

## 9. Proje Genelinde Kullanılacak UI Kalıpları

### 9.1 Arama Alanı
- global arama
- katalog içi arama
- admin tablo araması

Hepsi aynı bileşen ailesinden gelmeli; sadece bağlamına göre ölçeklenmelidir.

### 9.2 Filtre Alanı
- masaüstünde sol panel + üst bar hibriti
- mobilde sheet / drawer
- filtreleri temizle alanı görünür olmalı

### 9.3 KPI Kart Satırı
Hem customer hem admin panelde ortak mantıkta ama farklı yoğunlukta kullanılmalıdır.

### 9.4 Form Section Yapısı
Özellikle admin ürün formlarında:
- section başlığı
- kısa yardımcı metin
- alan grubu
- inline validasyon
- alt aksiyonlar

### 9.5 Boş Durum Blokları
Her boş durumun:
- başlığı
- kısa açıklaması
- yönlendirici CTA’sı
- gerekiyorsa ikonu
olmalıdır.

---

## 10. Responsive UI Yaklaşımı

Bu bölüm responsive başlığına daha sonra detaylı girilecektir; ancak UI sistemi açısından şimdiden bazı kararlar alınmalıdır.

### 10.1 Public taraf
- hero alanı mobilde sadeleşmeli
- kategori kartları mobilde tek kolon / iki kolon dengesiyle ilerlemeli
- global arama mobilde tam genişliğe açılabilmeli
- sticky teklif CTA’lar görünür kalmalı

### 10.2 Customer panel
- KPI kartları alt alta kırılabilmeli
- tablo yerine kart görünümü fallback düşünülebilir
- hızlı tekrar talep aksiyonları kaybolmamalı

### 10.3 Admin panel
- sidebar mobilde drawer’a dönüşmeli
- büyük tablolar yatay kaydırma veya alternatif görünümle yönetilmeli
- uzun formlar section section okunabilir kalmalı

---

## 11. Dark Mode Konusu

İlk aşamada dark mode zorunlu kabul edilmemişti; ancak proje kapsamı açısından değerlendirildiğinde, bu özellik doğru mimariyle kurulursa ilk faza alınabilir.

### Güncel karar
**Dark mode ilk faz kapsamına alınacaktır.**

### Bu karar neden yönetilebilir?
Eğer tasarım sistemi baştan token mantığında kurulursa dark mode sonradan eklenen bir yama gibi değil, sistemin doğal uzantısı olur.

Bu nedenle:
- renk sistemi role / token bazlı tanımlanmalıdır
- surface, background, text, border ve state renkleri light/dark karşılıklarıyla düşünülmelidir
- bileşenler sabit renklerle değil tema token’larıyla çalışmalıdır

### UX notu
Dark mode özellikle şu alanlarda fayda sağlar:
- admin panel uzun kullanım senaryoları
- müşteri panelinde gece kullanım rahatlığı
- modern ürün algısı

### Uygulama notu
İlk fazda dark mode alınacaksa:
- public site
- customer panel
- admin panel
üçünde de temel uyum sağlanmalıdır
- ancak öncelik her zaman light theme kalitesini korumak olmalıdır

## 12. Netleşen UI Kararları

### 12.1 Referans theme kullanımı
Bu projede Amerce ve Velzon referansları yön belirleyen zorunlu template’ler değildir. Bunlar yalnızca:
- görsel ilham
- düzen yaklaşımı
- modern UI/UX referansı
olarak kullanılacaktır.

Bu nedenle proje kendi tasarım sistemini kuracaktır; referanslar sadece karar destekleyici görsel kaynak olarak değerlendirilecektir.

### 12.2 Marka renk paleti yaklaşımı
Renk paleti bu aşamada ilk öneri olarak netleştirilecektir ve gerekirse sonraki revizelerle iyileştirilecektir.

#### Güncel karar
Önerilen ilk renk paleti yönü **uygun bulunmuştur** ve proje için başlangıç paleti olarak kabul edilmiştir.

#### Önerilen ilk palet yaklaşımı
İlk öneri, modern ve güven veren bir yapı için şu dengeyi kurmalıdır:
- güçlü ama agresif olmayan bir **primary** rengi
- teklif ve dönüşüm alanlarını destekleyen canlı ama kontrollü bir **accent** rengi
- ferah yüzeyler için açık **background / surface** tonları
- admin ve panel tarafında okunabilirlik için temiz **text** ve **border** tonları
- durumlar için net **success / warning / danger / info** renkleri

#### Önerilen palet yönü
İlk önerilen yön şu karakteri taşır:
- primary: mor / indigo ekseninde modern ve güçlü bir ton
- accent: teal / yeşil ekseninde canlı bir destek tonu
- background: çok açık gri / soğuk beyaz
- text: koyu gri / füme

Bu yaklaşım:
- modern görünür
- Amerce ve Velzon tarzı temiz dijital hissi destekler
- public CTA’larda güçlü görünür
- admin tarafta da ciddiyetini korur

### 12.3 Kategori kartları
Kategori kartları **hem görsel odaklı hem bilgi destekli** olacaktır.

#### En doğru yaklaşım
Teknik ürün projelerinde kategori kartı yalnızca büyük görselden oluşmamalıdır; ama sadece metin bloğu da olmamalıdır.

Bu nedenle önerilen yapı:
- kategori görseli veya temsili görsel alan
- kategori başlığı
- kısa açıklama
- gerekirse ürün alt grubu / örnek ürün bilgisi
- incele / görüntüle aksiyonu

Bu yapı Toptanbilya’daki kategori keşif mantığını daha modern ve daha kontrollü hale getirir.

#### Görsel alan oranı kararı
UI/UX ve responsive açıdan en doğru yaklaşım, kategori kartında **orta-yüksek görsel ağırlık** kullanmaktır.

Önerilen oran mantığı:
- masaüstünde kartın yaklaşık **%55 - %60** bölümü görsel / görsel yüzey hissi taşımalı
- kalan alan bilgi ve CTA için kullanılmalıdır
- mobilde ise kart yüksekliği kontrol edilerek görsel oranı biraz düşürülebilir

#### Neden bu oran doğru?
- kategori keşfini hızlandırır
- teknik ürün dünyasında sadece metinle soğuklaşmayı önler
- bilgi alanını öldürmeden görsel çekicilik sağlar
- responsive kırılımlarda kartın fazla uzamasını engeller

#### Responsive notu
- masaüstünde 3 veya 4 kolonlu grid içinde güçlü görünür
- tablette 2 kolon
- mobilde 1 veya 2 kolon davranışı bağlama göre değerlendirilebilir
- mobilde görsel alan çok büyütülmemeli, bilgi alanı görünür kalmalıdır

### 12.4 Ürün kartlarında ilk görünümde yer alacak bilgiler
Mevcut referans yapıda ürün kartları temel olarak şu yapıyı gösteriyor:
- ürün adı
- kısa teknik özet
- fiyat
- detay
- teklif iste aksiyonu

Bu proje teklif odaklı olduğu için ürün kartı ilk görünümünde önerilen bilgi seti şu olmalıdır:
1. ürün görseli
2. ürün adı
3. ürün kodu
4. marka
5. kısa teknik özet
6. kullanım alanı etiketi veya kısa kullanım alanı bilgisi
7. fiyat bilgisi yalnızca görünürlük parametresi açıksa
8. ana CTA: **Teklif Listesine Ekle**
9. ikincil CTA: **Detay**

#### Neden bu yapı en doğru?
- teknik alıcı için ürün kimliği hızlı anlaşılır
- kart aşırı kalabalık olmaz
- teklif akışı kart seviyesinde görünür olur
- marka ve ürün kodu profesyonel algıyı güçlendirir

#### Görsel yoğunluk notu
Kart içinde tüm bilgileri tam uzunlukta vermek yerine:
- ürün adı öncelikli
- ürün kodu + marka ikincil satır
- teknik özet kısa tek / çift satır
- kullanım alanı badge mantığında
olmalıdır.

#### Kullanım alanı badge kararı
Kullanım alanı badge’i **zorunlu sabit alan** olmayacaktır.

En doğru yaklaşım:
- kullanım alanı bilgisi **varsa gösterilir**
- yoksa kart boş veya dengesiz görünmeyecek şekilde bu alan baskı oluşturmaz

Bu yaklaşım veri esnekliğini korur ve kart düzenini gereksiz zorlamaz.

### 12.5 Admin dashboard kart yoğunluğu
Admin dashboard kartları **bilgi açısından zengin ama görsel olarak sade** olmalıdır.

#### En doğru denge
- tek kart içinde gereğinden fazla metin olmamalı
- ama sadece büyük sayı gösteren aşırı boş kartlar da yeterli değildir
- kısa başlık + güçlü sayı + küçük yardımcı metin / trend bilgisi en doğru dengidir

#### Mini trend bilgisi kararı
Evet, admin dashboard KPI kartlarında **mini trend bilgisi** gösterilmelidir.

Örnek:
- önceki döneme göre artış / azalış
- küçük yüzde farkı
- yukarı / aşağı yön göstergesi
- kısa dönem karşılaştırması

#### Neden bu bilgi faydalı?
- tek sayı yerine bağlam sunar
- karar vermeyi kolaylaştırır
- kartı aşırı karmaşıklaştırmadan daha akıllı hale getirir
- Velzon benzeri analitik hissi destekler

#### Sonuç
Admin dashboard kartları:
- yoğun veri verebilir
- ancak çok katmanlı, sıkışık ve karmaşık görünmemelidir
- ilk bakışta anlaşılır, ikinci bakışta detay sunan yapıda olmalıdır
- mini trend bilgisi kontrollü biçimde kullanılmalıdır

### 12.6 Müşteri panel kart dili ile admin kart dili farkı
Müşteri panel kart dili, admin panelden **belirgin ama kontrollü şekilde farklılaşmalıdır**.

#### Müşteri panel kartları
- daha sıcak
- daha yönlendirici
- aksiyon odaklı
- daha sade açıklamalı
- kullanıcıya güven ve takip hissi veren yapı

#### Customer panel kartlarında ikon kullanımı kararı
UI/UX ve responsive açısından en doğru yaklaşım, **hafif-orta seviyede ikon kullanımıdır**.

Bu şu anlama gelir:
- her kartta büyük dekoratif ikon kullanılmamalı
- ama önemli kartlarda küçük / orta boy destekleyici ikon kullanılabilir
- ikon, bilgiyi açıklayan yardımcı unsur olmalı; kartın ana içeriğinin önüne geçmemelidir

#### Neden bu seviye doğru?
- mobilde alanı verimli kullanır
- kartları daha hızlı taranabilir hale getirir
- modern görünüm sağlar
- abartılı ikon kullanımıyla oluşabilecek oyuncak hissini önler

#### Admin panel kartları
- daha analitik
- daha kompakt
- daha operasyonel
- karşılaştırma ve takip odaklı

#### Sonuç
İki alan aynı tasarım sisteminden beslenecek; ancak:
- müşteri panelde kartlar daha kullanıcı dostu ve rahat
- admin panelde kartlar daha yönetim ve operasyon odaklı olacaktır
- customer panelde ikon kullanımı kontrollü ve destekleyici seviyede kalacaktır

## 13. Netleşen Ek UI Kararları

### 13.1 Dark mode davranışı
İlk fazda en doğru yaklaşım:
- önce kullanıcının **sistem temasını otomatik algılamak**
- ardından kullanıcıya **manuel override** hakkı vermektir

Bu model en iyi UX yaklaşımı([laravel.com](https://laravel.com/docs/12.x/starter-kits?utm_source=chatgpt.com))duğu temayı görür
- kullanıcı isterse kendi tercihini uygular
- sistem akıllı ama baskıcı olmayan davranış gösterir

#### Tercih saklama yaklaşımı
Best practice olarak tema tercihi ilk fazda şu şekilde saklanmalıdır:
- **öncelikli olarak tarayıcıda** tutulmalıdır
- örneğin localStorage benzeri istemci tarafı saklama mantığı uygundur
- kullanıcı giriş yaptıysa ileride bu tercih hesap bazlı da saklanabilir

İlk faz için en pratik ve doğru yaklaşım:
- sistem tercihini algıla
- kullanıcı override ederse tarayıcıda sakla
- sonraki ziyaretlerde önce kaydedilmiş kullanıcı tercihini uygula

### 13.2 Kategori kartları masaüstü grid yapısı
Masaüstünde kategori grid yapısı **4 kolon** olacaktır.

Bu karar:
- kategori çeşitliliğini daha verimli gösterir
- Amerce benzeri modern vitrin hissini destekler
- Toptanbilya mantığındaki kategori keşfini daha düzenli hale getirir
- yeterli genişlikte bilgi alanını koruduğu sürece güçlü bir masaüstü deneyimi sağlar

### 13.3 Ürün kartlarında teknik özet uzunluğu
UI/UX ve responsive açısından en doğru yaklaşım, teknik özeti **maksimum 2 satır** ile sınırlandırmaktır.

#### Neden 2 satır daha doğru?
- 1 satır teknik ürünlerde çoğu zaman yetersiz kalır
- 3+ satır kart yüksekliğini bozup grid dengesini kırar
- 2 satır, bilgi ile düzen arasında en iyi dengeyi sunar

Bu nedenle:
- masaüstünde 2 satır clamp
- mobilde de mümkünse 2 satır clamp
- devamı için detay sayfasına yönlendirme
önerilir

### 13.4 Customer panel kart ikon stili
Esinlenilen theme yaklaşımı ve proje karakteri dikkate alındığında en doğru seçenek:
- **line tabanlı veya hafif duotone dokunuşlu sade ikon stili**

#### Neden filled ikon değil?
Filled ikonlar müşteri panelini gereğinden fazla ağır ve bazen daha eski hissettirebilir.

#### Neden tamamen düz line ikon tek başına yetmeyebilir?
Tamamen çok ince line ikonlar bazı kartlarda fazla zayıf kalabilir.

#### En doğru denge
- temel stil: sade line ikon
- gerektiğinde hafif renk dolgulu arka plan veya yumuşak duotone hissi
- ikon, kartın önüne geçmeden destekleyici rol oynar

Bu yaklaşım:
- modern görünür
- mobilde okunaklıdır
- Amerce ve Velzon’dan gelen temiz dijital dili bozmadan destekler

### 13.5 Admin KPI kartlarında trend karşılaştırması davranışı
Trend karşılaştırması **bağlama göre değişken** olmalıdır.

#### Önerilen UX modeli
Dashboard üst bölümünde veya grafik alanına yakın yerde bir dönem seçici bulunabilir:
- Günlük
- Haftalık
- Aylık
- Yıllık

Bu seçim değiştiğinde:
- grafikler güncellenir
- KPI kartlarındaki trend karşılaştırmaları da aynı bağlama uyum sağlar

#### Neden bu model doğru?
- kullanıcı tek sabit pencereye mahkum kalmaz
- admin daha doğru bağlamda yorum yapar
- kısa ve uzun dönem kıyaslamaları aynı ekran mantığında yönetilebilir

#### UI notu
Bu buton grubu:
- segmented control / pill switch mantığında olabilir
- dashboard içinde görünür ama kalabalık yaratmayacak yerde konumlanmalıdır

### 13.6 Livewire kullanımı hakkında karar önerisi
Laravel ile yüksek uyum, Blade tabanlı geliştirme ve etkileşimli panel/form ihtiyacı nedeniyle **Livewire bu proje için güçlü bir adaydır**. Laravel’in güncel starter kit dokümantasyonu Livewire seçeneğini resmi başlangıç yolu olarak sunuyor; ayrıca Livewire dinamik ve reaktif arayüzleri PHP ve Blade ile kurmayı özellikle öne çıkarıyor. ([laravel.com](https://laravel.com/docs/12.x/starter-kits?utm_source=chatgpt.com))

#### Bu projede Livewire’ın güçlü olacağı alanlar
- müşteri auth ve hesap ekranları
- teklif listesi / teklif formu etkileşimleri
- müşteri paneli kartları ve liste etkileşimleri
- admin dashboard widget’ları
- admin ürün ekleme / düzenleme formları
- filtre / tablo / modal / drawer etkileşimleri

#### Neden katkı sağlar?
- Laravel ile doğal uyum sağlar ([livewire.laravel.com](https://livewire.laravel.com/docs/4.x/installation?utm_source=chatgpt.com))
- PHP/Blade ağırlıklı ilerleyerek frontend karmaşıklığını azaltabilir ([livewire.laravel.com](https://livewire.laravel.com/docs/4.x/quickstart?utm_source=chatgpt.com))
- form validasyonu, state yönetimi ve bileşen yaklaşımı bu tip panel ağırlıklı projelerde verimlidir ([livewire.laravel.com](https://livewire.laravel.com/docs/4.x/forms?utm_source=chatgpt.com))

#### Dikkat edilmesi gereken nokta
Benim önerim, Livewire’ı her şeyi kapsayan tek araç gibi değil, **etkileşimli Blade katmanı** olarak kullanmaktır.

Yani en sağlıklı yaklaşım:
- genel uygulama yapısı Laravel + Blade temelli kurulur
- etkileşimli alanlarda Livewire kullanılır
- küçük istemci tarafı davranışlar için gerekirse Alpine desteklenir; Livewire dokümantasyonu da bu kombinasyonu açıkça destekliyor. ([livewire.laravel.com](https://livewire.laravel.com/?utm_source=chatgpt.com))

#### Sonuç önerim
Evet, **Livewire projeye katkı sağlar**.
Özellikle bu projede Vue/React gibi daha ağır bir SPA katmanına girmeden:
- modern etkileşim
- güçlü admin deneyimi
- hızlı geliştirme
- Laravel ile doğal bütünleşme
elde etmek açısından mantıklı bir tercihtir. ([laravel.com](https://laravel.com/docs/12.x/starter-kits?utm_source=chatgpt.com))

---

## 14. Ön Sonuç

Bu aşamada önerilen UI ve tasarım sistemi omurgası şu prensiplere dayanır:
- tasarım sistemi token mantığında kurulmalı
- renkler rol bazlı tanımlanmalı
- tipografi okunabilirlik ve güven üretmeli
- boşluk ve grid sistemi tutarlı olmalı
- kart, form, tablo ve rozet sistemleri tekrar kullanılabilir olmalı
- public, customer ve admin tarafı aynı çekirdek sistemden beslenmeli
- ama bağlama göre yoğunluk ve vurgu farklılaşabilmeli
- dark mode ilk faz kapsamına alınmalı ve sistem tercihi + kullanıcı override mantığıyla çalışmalı
- responsive davranış UI sisteminin parçası olarak düşünülmeli
- referans theme’lar yalnızca görsel esinleme kaynağı olarak kullanılmalı
- kategori kartları görsel + bilgi dengesiyle tasarlanmalı
- masaüstünde kategori grid yapısı 4 kolon olmalı
- ürün kartları teknik kimlik + teklif aksiyonu dengesini korumalı
- teknik özet 2 satırla sınırlandırılmalı
- kullanım alanı badge’i varsa gösterilmeli
- admin dashboard kartları bilgi açısından zengin ama görsel olarak sade kalmalı
- mini trend bilgisi ve dönem seçimi desteklenmeli
- müşteri panel kart dili admin’den kontrollü şekilde ayrışmalı
- customer panel ikonları sade line / hafif duotone yaklaşımında olmalı
- Livewire proje için güçlü ve uygun bir etkileşim katmanı adayıdır

Bu doküman, sonraki aşamada gerçek bileşen dili, ekran taslakları ve UI kit kararlarını netleştirmek için temel olacaktır.

