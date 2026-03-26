# Web Projesi — 08 Performans

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi, arayüz, responsive yapı, kimlik doğrulama ve veri yönetimi kararlarından sonra, projenin performans yaklaşımını netleştirmek için hazırlanmıştır. Amaç; public site, müşteri paneli ve admin panelinde hızlı açılış, akıcı etkileşim, verimli veri erişimi ve ölçeklenebilir performans davranışını proje özelinde tanımlamaktır.

Bu bölüm, modern web uygulamalarında performansın yalnızca sunucu hızından ibaret olmadığını; sayfa açılışı, sorgu verimliliği, listeleme davranışı, asset yükü, görsel optimizasyonu, cache kullanımı ve yoğun ekranların kontrollü yüklenmesiyle birlikte ele alınması gerektiği çerçevesine dayanır. Web Projesi ana çerçevesinde performans; hızlı sayfa yüklenmesi, verimli sorgular, gereksiz veri çekiminin önlenmesi, lazy loading / pagination, cache stratejileri, asset ve görsel optimizasyonu ile kuyruk kullanımını kapsayan temel bir başlık olarak tanımlanmıştır. fileciteturn7file0 Ayrıca bu doküman; teklif odaklı ürün yapısı, 3 katmanlı bilgi mimarisi, UX sadeleştirme kararları, UI sistemi, responsive davranışlar, auth yapısı ve veri yönetimi kuralları üzerine kurulacaktır. fileciteturn7file2 fileciteturn7file1 fileciteturn7file3 fileciteturn7file4 fileciteturn7file5 fileciteturn7file6 fileciteturn7file7

---

## 1. Performans Bu Projede Ne Anlama Geliyor?

Bu projede performans yalnızca ana sayfanın hızlı açılması değildir. Performans şu alanlarda hissedilmelidir:
- ürün kataloğunda hızlı gezinme
- ürün detay sayfasında hızlı içerik görünümü
- teklif listesine ürün eklerken akıcı geri bildirim
- teklif formunda gecikmesiz etkileşim
- müşteri panelinde teklif geçmişinin hızlı açılması
- admin dashboard ve liste ekranlarında ağırlaşmayan veri akışı

Bu projede performansın temel amacı:
**kullanıcının bekleme hissini azaltmak, admin operasyonunu yavaşlatmamak ve büyümeye rağmen uygulamayı akıcı tutmaktır.**

---

## 2. Performans Katmanları

Bu proje için performans 5 ana katmanda ele alınmalıdır:

1. **Sunum Katmanı Performansı**
2. **Veri ve Sorgu Performansı**
3. **Etkileşim Performansı**
4. **Medya ve Asset Performansı**
5. **Operasyonel ve Arka Plan Performansı**

### 2.1 Sunum Katmanı Performansı
- ilk açılış hızı
- sayfa geçiş hissi
- layout stabilitesi
- kritik içeriğin hızlı görünmesi

### 2.2 Veri ve Sorgu Performansı
- ürün liste sorguları
- filtreli arama sorguları
- teklif ve dashboard sorguları
- N+1 problemlerinin önlenmesi

### 2.3 Etkileşim Performansı
- teklif listesine ekleme
- filtre değiştirme
- form validasyon geri bildirimi
- Livewire bileşen güncellemeleri

### 2.4 Medya ve Asset Performansı
- görsel boyutları
- lazy loading
- CSS / JS yükü
- ikon ve font kullanımı

### 2.5 Operasyonel ve Arka Plan Performansı
- mail gönderimleri
- log kayıtları
- dashboard veri hazırlığı
- gerektiğinde kuyruklanan işler

---

## 3. Public Site Performans Yaklaşımı

### 3.1 Ana Sayfa
Ana sayfa vitrinsel olsa da ağır olmamalıdır.

İlk faz için kurallar:
- hero alanı ağır medya ile yüklenmemeli
- kategori blokları hızlı görünmeli
- öne çıkan ürünler kontrollü sayıda gelmeli
- marka / kullanım alanı blokları sayfayı boğmamalı
- kritik CTA ve arama alanı ilk açılışta gecikmemelidir

### 3.2 Ürün Kataloğu
Katalog performansı projenin en kritik alanlarından biridir.

Kurallar:
- varsayılan olarak sayfalama kullanılmalı
- filtreli aramalar kontrollü sorgu mantığıyla çalışmalı
- gereksiz kolonlar ve ilişkiler her sorguda çekilmemeli
- liste ve grid görünümü performansı bozmayacak ortak veri setinden beslenmeli
- ilk yükte gereksiz veri değil, kullanıcı için görünür veri öncelikli gelmelidir

### 3.3 Ürün Detay
Ürün detay sayfasında performans için:
- ana ürün bilgisi öncelikli yüklenmeli
- görseller optimize edilmeli
- benzer ve ilgili ürün blokları kontrollü sayıda gelmeli
- teknik tablo çok büyükse yine de taranabilir performansta sunulmalıdır

Bu sayfada ilk görünümde ana ürün bilgisi ve teklif CTA öncelikli olduğu için bu alanların hızlı görünmesi UX ile de doğrudan ilişkilidir. Ürün detay yerleşimi ve CTA önceliği bilgi mimarisi kararlarında netleşmiştir. fileciteturn7file1

---

## 4. Teklif Akışı Performansı

Bu proje teklif odaklı olduğu için performansın en çok hissedileceği alanlardan biri teklif sürecidir. Teklif listesi mantığı ve ürün ekleme geri bildirimi UX kararlarında çok katmanlı ama hafif olacak şekilde tanımlanmıştır. fileciteturn7file3

### 4.1 Teklif listesine ürün ekleme
Kurallar:
- aksiyon gecikmeli hissettirmemeli
- sayaç anında güncellenmeli
- toast / mini panel geri bildirimi hızlı görünmeli
- aynı aksiyon tekrarlandığında gereksiz ağır istekler oluşmamalı

### 4.2 Teklif listesi ekranı
- satırlar kontrollü sayıda ve optimize görünmeli
- miktar güncellemeleri ağır tam sayfa yenilemesi gibi hissettirmemeli
- silme / düzenleme aksiyonları hızlı çalışmalı

### 4.3 Teklif formu
Tek adımlı teklif formu kararı UX tarafında netleşmiştir. fileciteturn7file3 Bu nedenle performans için:
- istemci ve sunucu validasyonu dengeli çalışmalı
- gereksiz step yükü olmamalı
- gönderim sonrası onay ekranı hızlı gelmeli
- mail gönderimi kullanıcıyı bekletmemelidir

### 4.4 Mail ve bildirim akışı
Teklif alındı ve teklif cevabı e-postaları ürün temelinde zorunlu akış olarak tanımlanmıştır. fileciteturn7file2turn7file6 Performans için bu gönderimler:
- mümkün olduğunda kuyruk mantığıyla çalışmalı
- kullanıcı ana işlemi tamamladıktan sonra arka planda ilerlemelidir

---

## 5. Customer Panel Performans Yaklaşımı

Customer panel ilk fazda teklif geçmişi, durum takibi ve hızlı tekrar talep için kullanılacaktır. fileciteturn7file1turn7file2

Kurallar:
- dashboard ilk açılışta kritik kartlar hızlı görünmeli
- teklif geçmişi sayfalı veya kontrollü listelenmeli
- teklif detayında ürün satırları ağır tabloya dönüşmemeli
- hızlı tekrar talep akışı gereksiz bekleme üretmemeli
- profil ve şirket bilgisi formları hafif çalışmalıdır

### KPI kartları
Mobilde alt alta dizilme kararı responsive dokümanda netleşmiştir. fileciteturn7file5 Bu nedenle veri çekimi de:
- ilk 2-4 kritik kartı hızlı üretmeye
- ikincil bilgileri daha sonra yüklemeye
uygun düşünülmelidir.

---

## 6. Admin Panel Performans Yaklaşımı

Admin panelde performans sadece hız değil, operasyon akıcılığıdır.

### 6.1 Dashboard
Admin dashboard; teklif talepleri, ürün/kategori/marka sayıları, trend bilgileri ve grafikler içerir. Bu yapı bilgi mimarisi ve UI dokümanlarında netleşmiştir. fileciteturn7file1turn7file4

Performans kuralları:
- KPI kartları tek sorgu yağmuruna dönüşmemeli
- dönem seçici (günlük/haftalık/aylık/yıllık) değiştiğinde grafikler optimize güncellenmeli
- admin ilk açılışta tüm ağır raporlar aynı anda yüklenmemeli
- gerekirse bazı widget’lar lazy load mantığıyla yüklenebilir

### 6.2 Liste ekranları
Özellikle:
- ürün listesi
- teklif listesi
- müşteri listesi
- log listeleri

şu kurallarla çalışmalıdır:
- sayfalama zorunlu olmalı
- filtreleme indeks dostu düşünülmeli
- sıralama maliyetleri kontrol edilmeli
- toplu işlemler performansı bozmayacak şekilde kurgulanmalı

### 6.3 Ürün formu
Admin ürün formu sekmeli/adım adım yapı ile kurgulanmıştır. fileciteturn7file3 Performans için:
- tüm adımların en başta ağır şekilde yüklenmesi gerekmez
- teknik özellik alanları kategori seçimine göre yüklenebilir
- medya işlemleri ve önizlemeler kontrollü olmalıdır

### 6.4 Mobil admin kapsamı
Mobilde admin için temel izleme ve hafif düzenleme öncelikli olacağı responsive dokümanda netleşmiştir. fileciteturn7file5 Bu yüzden mobil admin performans hedefi:
- dashboard özetleri hızlı
- temel teklif detayları okunur
- hafif aksiyonlar gecikmesiz
olmalıdır

---

## 7. Veri ve Sorgu Performansı İlkeleri

Bu başlık veri yönetimi dokümanıyla doğrudan ilişkilidir. Entity ve ilişki netliği 07. dokümanda tanımlanmıştır. fileciteturn7file7

### 7.1 Sorgu ilkeleri
- N+1 query önlenmeli
- gerekli olmayan kolonlar seçilmemeli
- eager loading bilinçli kullanılmalı
- büyük dataset tek seferde çekilmemeli
- filtre ve sıralama alanları indeks stratejisiyle düşünülmeli

### 7.2 Sayfalama
İlk faz için büyük listelerde varsayılan yaklaşım:
- sayfalama zorunlu
- gerektiğinde “load more” ikinci faz opsiyonu
- admin tarafında tablo bazlı pagination
- public tarafta SEO/UX dengesine göre pagination

### 7.3 İlişki yoğunluğu
Özellikle şu alanlarda dikkat gerekir:
- ürün + marka + kategori + kullanım alanı + görseller
- teklif + satırlar + ürün + cevap satırları
- dashboard + özet + trend + grafik verileri

Bu yapılarda tek endpoint / tek sorgu içine her şeyi doldurma yaklaşımından kaçınılmalıdır.

---

## 8. Cache Yaklaşımı

İlk fazda her şeyi cache’lemek gerekmese de doğru alanlarda kontrollü cache kullanılmalıdır.

### Cache için uygun alanlar
- kategori listeleri
- aktif marka listeleri
- kullanım alanı listeleri
- ana sayfa vitrin blokları
- genel ayarlar
- nadir değişen public meta veriler

### Cache için dikkat
- teklif ve müşteri özel verilerde agresif cache dikkatli kullanılmalı
- admin canlı operasyon ekranlarında stale veri riskine dikkat edilmeli
- cache invalidation kuralları basit ve öngörülebilir olmalıdır

---

## 9. Medya ve Asset Optimizasyonu

### 9.1 Görseller
İlk faz için:
- farklı boyut varyantları düşünülmeli
- gereksiz büyük orijinal görseller public tarafta doğrudan sunulmamalı
- lazy loading kullanılmalı
- ana görseller optimize edilmeli

### 9.2 CSS / JS yükü
Livewire kullanımı proje için güçlü aday olarak değerlendirilmiştir. fileciteturn7file4 Bu nedenle performans için:
- gereksiz frontend bağımlılığı artırılmamalı
- sayfa başına sadece gerekli asset yükü düşünülmeli
- ağır plugin bağımlılıklarından kaçınılmalı

### 9.3 İkon ve fontlar
- ikon sistemi ortaklaştırılmalı
- fazla farklı font ailesi kullanılmamalı
- font yükü kontrol altında tutulmalı

---

## 10. Livewire Performans İlkeleri

Bu proje için Livewire güçlü adaydır; ancak yanlış kullanım performans maliyeti üretebilir. UI dokümanında Livewire’ın etkileşimli Blade katmanı olarak kullanılması önerilmiştir. fileciteturn7file4

### Önerilen yaklaşım
- her küçük şey için ayrı ağır Livewire bileşeni üretmemek
- state’i gereksiz büyütmemek
- büyük listelerde dikkatli davranmak
- form ve etkileşimli panellerde Livewire’ı güçlü tarafları için kullanmak
- küçük istemci tarafı davranışlarda Alpine ile desteklemek

### Livewire için uygun alanlar
- teklif listesi etkileşimleri
- teklif formu validasyon geri bildirimi
- müşteri panel kartları ve listeleri
- admin ürün formu adımları
- dashboard filtre / dönem seçici

### Livewire için dikkat edilmesi gereken alanlar
- çok büyük tablolar
- aşırı sık güncellenen ağır bileşenler
- her etkileşimde büyük veri payload’ı taşıyan yapılar

---

## 11. Kuyruk ve Arka Plan İşleri

İlk fazda aşağıdaki işler mümkün olduğunda kuyruk mantığıyla düşünülmelidir:
- teklif alındı e-postası
- teklif cevabı e-postası
- admin bildirim e-postaları
- ağır loglama / rapor hazırlığı (gerektiğinde)
- görsel işleme / yeniden boyutlandırma

### Neden?
- kullanıcıyı bekletmez
- ana akışı hızlandırır
- yoğunluk anlarında sistemi daha dengeli tutar

---

## 12. Performans Ölçümleme ve Takip

Performans yalnızca hissiyatla yönetilmemelidir. Ölçülmesi gerekir.

İlk faz için takip edilmesi önerilen alanlar:
- ana sayfa ilk açılış süresi
- ürün kataloğu yanıt süresi
- ürün detay açılış hissi
- teklif listesine ekleme aksiyon süresi
- teklif formu gönderim süresi
- admin dashboard yüklenme süresi
- en yavaş sorgular
- en ağır sayfalar

### Google Analytics ve performans
GA tarafı daha çok davranışsal ölçüm verir; performans ölçümü için uygulama logları ve teknik izleme ayrıca düşünülmelidir. Ürün tarafında GA’nın admin dashboard’a özet metrik olarak yansıması kararı daha önce netleşmiştir. fileciteturn7file2

---

## 13. Netleşen Performans Kararları

### 13.1 Public katalogda varsayılan sayfa başına ürün sayısı
İlk faz için public katalogda varsayılan ürün sayısı **10** olacaktır.

#### Sayfa boyutu seçenekleri
UI/UX açısından en doğru yaklaşım:
- varsayılan: **10**
- alternatifler: **20**, **50**

#### Neden bu seçim doğru?
- teknik ürün kartları görsel + bilgi + CTA içerdiği için ilk yükte 10 ürün daha dengeli görünür
- mobil ve orta cihazlarda ilk yük hissini hafif tutar
- kullanıcıya daha fazla görmek isterse kontrollü seçenek sunar
- 10 / 20 / 50 dizilimi zihinsel olarak temiz ve anlaşılırdır

#### UX notu
Sayfa boyutu seçici:
- katalog üst araç çubuğunda yer almalı
- filtre ve sıralama alanını boğmamalı
- mobilde drawer / sheet içinde gösterilebilir

### 13.2 Admin liste ekranlarında varsayılan sayfa başına kayıt sayısı
İlk faz için admin liste ekranlarında varsayılan kayıt sayısı **20** olacaktır.

#### Sayfa boyutu seçenekleri
UI/UX açısından önerilen yapı:
- varsayılan: **20**
- alternatifler: **40**, **50**, **100**

#### Neden bu seçim doğru?
- admin kullanıcılar public kullanıcıya göre daha yoğun veriyle çalışır
- 20 kayıt ilk yükte yeterli bağlam verir
- 40 / 50 / 100 seçenekleri farklı operasyon ihtiyacını karşılar
- performans ve verimlilik arasında iyi denge kurar

### 13.3 Ana sayfa bloklarının yüklenmesi
İlk fazda ana sayfa bloklarının tamamı aynı anda agresif şekilde yüklenmeyecektir.

#### Güncel karar
Ana sayfada bazı bölümler **lazy load** mantığıyla yüklenecektir.

#### En doğru yükleme önceliği
İlk açılışta öncelikli alanlar:
1. header
2. hero alanı
3. arama alanı
4. hızlı güven / servis şeridi
5. geniş ürün kategorileri

Daha sonra lazy load edilebilecek alanlar:
- öne çıkan ürünler
- kullanım alanına göre keşfet
- marka blokları
- süreç anlatımı
- kurumsal / destekleyici bloklar

#### Neden bu model doğru?
- ilk hissedilen hız artar
- kullanıcıya kritik içeriği hemen gösterir
- sayfa ağırlaşmasını azaltır
- scroll bazlı keşif mantığıyla uyumludur

### 13.4 Teklif listesine ekleme işlemi nasıl çalışmalı?
Bu işlem için en doğru performans yaklaşımı:
- **hibrit hafif istemci desteği + Livewire senkronizasyonu**

#### Neden tam Livewire tek başına değil?
Tamamen sunucu roundtrip hissi veren yapı, ürün listeleme ve detay ekranlarında tekrar eden “teklif listesine ekle” aksiyonunda gereksiz gecikme hissi oluşturabilir.

#### Neden hibrit model daha doğru?
- kullanıcı geri bildirimi anında görünür
- sayaç hızlı güncellenir
- mini panel / toast daha akıcı hissedilir
- Livewire veya backend tarafı nihai senkronizasyon ve kalıcılığı yönetir

#### Önerilen model
- istemci tarafında hafif anlık UI güncellemesi
- kısa süre içinde backend / Livewire senkronizasyonu
- hata olursa kullanıcıya temiz geri bildirim

Bu model özellikle teklif listesi gibi sık tekrarlanan küçük aksiyonlarda en iyi hissedilen performansı üretir.

### 13.5 İlk faz için cache yaklaşımı
İlk faz için cache kullanımı **seçici ve orta seviyede** olmalıdır.

#### Neden agresif cache değil?
- admin ve teklif akışında stale veri riski oluşturabilir
- invalidation karmaşıklığını erken artırabilir
- gereksiz karmaşa yaratabilir

#### Neden hiç cache’siz de olmamalı?
- kategori, marka ve kullanım alanı gibi nadir değişen veriler gereksiz yere sürekli yeniden üretilmemelidir
- ana sayfa vitrin blokları ve genel ayarlar cache için uygundur

#### İlk faz için önerilen cache kapsamı
Cache’e uygun alanlar:
- aktif kategori listeleri
- aktif marka listeleri
- aktif kullanım alanları
- genel ayarlar
- ana sayfa vitrin blokları
- nadir değişen public yapı verileri

Cache konusunda dikkatli olunacak alanlar:
- teklif verileri
- müşteriye özel veriler
- admin canlı operasyon ekranları
- sık değişen sayaçlar

#### Sonuç
İlk faz için en doğru yaklaşım:
- **agresif olmayan, seçici, öngörülebilir cache kullanımı**

---

## 14. Ön Sonuç

Bu aşamada performans omurgası şu prensiplere dayanır:
- performans yalnızca sunucu hızı değil, algılanan hız olarak da ele alınmalı
- katalog, teklif akışı ve dashboard ekranları öncelikli optimize edilmeli
- büyük listelerde sayfalama ve sorgu disiplini zorunlu olmalı
- public katalogda varsayılan 10 ürün, admin listelerde varsayılan 20 kayıt yaklaşımı kullanılmalı
- ana sayfa blokları öncelik sırasına göre kısmen lazy load edilmelidir
- teklif listesine ekleme aksiyonu hibrit hafif istemci desteğiyle akıcı hale getirilmelidir
- medya ve asset yükü kontrollü tutulmalı
- mail ve benzeri işler mümkün olduğunca kuyrukta çalışmalı
- Livewire güçlü ama kontrollü kullanılmalı
- cache seçici ve öngörülebilir uygulanmalı
- performans ölçülmeli ve izlenmelidir

Bu doküman, sonraki aşamada Laravel sorgu stratejileri, indeksleme planı, cache katmanı, queue kullanımı ve Livewire etkileşim performansının daha teknik seviyede netleştirilmesi için temel olacaktır.

