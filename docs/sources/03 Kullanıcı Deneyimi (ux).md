# Web Projesi — 03 Kullanıcı Deneyimi (UX)

Bu doküman, ürün temeli ve bilgi mimarisi kararlarından sonra, projenin kullanıcı deneyimi yaklaşımını netleştirmek için hazırlanmıştır. Amaç; public site, müşteri paneli ve admin panelinde kullanıcı akışlarını sürtünmesiz, anlaşılır, hızlı ve güven veren hale getirecek UX prensiplerini proje özelinde tanımlamaktır.

Bu bölüm, modern web uygulamalarında kullanıcı deneyiminin yalnızca estetik değil; akış, geri bildirim, tutarlılık, hız ve kullanım kolaylığı ile ilgili olduğunu kabul eden temel çerçeveye dayanır. Özellikle ilk girişte anlaşılır yapı, tutarlı ekran davranışları, hızlı geri bildirim ve mobil/masaüstü doğal kullanım ilkeleri bu proje için de temel alınacaktır. fileciteturn2file0 Ayrıca burada tanımlanan UX kararları, teklif odaklı ürün yapısı ve 3 katmanlı bilgi mimarisi üzerine kurulacaktır. fileciteturn2file1 fileciteturn2file2

---

## 1. UX Bu Projede Ne Anlama Geliyor?

Bu projede iyi UX, sadece güzel arayüz anlamına gelmez. İyi UX şu sonucu üretmelidir:
- kullanıcı ne yapacağını hızlı anlar
- aradığı ürüne az adımda ulaşır
- teklif sürecinde kafa karışıklığı yaşamaz
- sistemin ne yaptığını her adımda anlar
- hata yaptığında yönlendirilir
- mobilde de masaüstünde de doğal hisseder
- üyelik opsiyonel olsa bile sistemden rahatça faydalanır

Bu projede UX’in temel görevi:
**ürün keşfini hızlandırmak, teklif sürecini kolaylaştırmak ve güven duygusunu artırmaktır.**

---

## 2. UX Ana Prensipleri

İlk faz için UX kararları aşağıdaki prensiplere dayanmalıdır:

### 2.1 Hızlı Anlaşılabilirlik
Kullanıcı siteye girdiğinde birkaç saniye içinde şunu anlamalıdır:
- bu site ne satıyor
- ürünlere nasıl ulaşırım
- teklif nasıl alınır
- giriş yapmadan da talep bırakabilir miyim

### 2.2 Az Adımda İlerleme
Özellikle teklif akışında gereksiz adımlar azaltılmalıdır.
Kullanıcı:
- ürünü bulmalı
- teklif listesine eklemeli
- bilgilerini bırakmalı
- talebi tamamlamalı

Bu akış mümkün olan en az sürtünmeyle çalışmalıdır.

### 2.3 Güven Veren Deneyim
Teknik ürün ve teklif odaklı yapılarda güven duygusu kritik önemdedir.
Bu nedenle UX içinde şu sinyaller görünür olmalıdır:
- açık iletişim
- net süreç anlatımı
- boş vaat yerine somut süreç
- teklif sonrası ne olacağının açıklığı
- ürün kimliğinin net sunulması

### 2.4 Tutarlı Davranış
Benzer aksiyonlar her yerde benzer şekilde çalışmalıdır.
Örnek:
- tüm “Teklif Listesine Ekle” aksiyonları aynı dil ve mantıkta olmalı
- form hata gösterimleri her ekranda benzer çalışmalı
- durum rozetleri aynı sistematikle ilerlemeli

### 2.5 Mobil Doğallık
Mobil kullanım masaüstünden kırpılmış versiyon gibi durmamalıdır.
Mobilde:
- menü erişimi kolay olmalı
- arama görünür olmalı
- CTA’lar kaybolmamalı
- formlar kısa ve rahat doldurulmalı
- teknik tablo ve yoğun bilgiler yönetilebilir sunulmalı

---

## 3. Public Site UX Yaklaşımı

Public site, teklif dönüşümünün başladığı alandır. Bu yüzden UX burada hem keşif hem yönlendirme odaklı olmalıdır.

### 3.1 İlk İzlenim
İlk ekran kullanıcıya şunları hızlıca vermelidir:
- ne sunduğumuz
- hangi ürün gruplarının olduğu
- nasıl teklif alınacağı
- ürün aramaya / kategori keşfine nasıl başlanacağı

Bu nedenle hero alanı sadece dekoratif değil, yönlendirici olmalıdır.

### 3.2 Keşif Mantığı
Bu projede keşif üç ana yoldan ilerlemelidir:
1. global arama
2. kategori keşfi
3. katalog filtreleme

Bunlara ek olarak:
- kullanım alanına göre keşif
- marka üzerinden keşif
- benzer / ilgili ürün akışları
kullanıcıya yardımcı katmanlar olacaktır.

### 3.3 Teklif UX’i
Teklif akışı kullanıcıyı ürkütmemeli, e-ticaret benzeri rahatlık hissi vermelidir.
Bu nedenle:
- teklif listesi mantığı tanıdık olmalı
- ürün ekleme sonrası net geri bildirim verilmeli
- adet düzenleme kolay olmalı
- misafir kullanıcı akışı zorlaştırılmamalı
- teklif formu gereksiz uzun olmamalı

### 3.4 İçerik Tonu
Public tarafta dil:
- sade
- net
- güven veren
- teknik ama boğucu olmayan
olmalıdır.

---

## 4. Müşteri Paneli UX Yaklaşımı

Müşteri paneli ilk fazda hafif ama gerçekten faydalı olmalıdır. Kullanıcıya “üye olmanın avantajı” hissettirilmelidir.

### 4.1 Ana Amaç
Müşteri paneli şu işleri kolaylaştırmalıdır:
- mevcut teklifleri takip etmek
- geçmiş teklifleri görmek
- tekrar talep oluşturmak
- profil ve şirket bilgisini düzenlemek

### 4.2 Panel Dili
Müşteri paneli:
- fazla kurumsal ve soğuk olmamalı
- çok yoğun tablo hissi vermemeli
- özet kart + aksiyon + liste dengesiyle ilerlemeli

### 4.3 Durum Takibi
Teklif durumu kullanıcı tarafından kolay okunmalıdır.
Durumlar karmaşık olmamalı ve rozetlerle hızlı algılanmalıdır.

Örnek durum mantığı:
- Alındı
- İnceleniyor
- Cevaplandı
- Güncelleme Bekliyor
- Kapatıldı

### 4.4 Hızlı Tekrar Talep
Bu modül panelin en güçlü UX avantajlarından biri olmalıdır.
Kullanıcı eski tekliften tekrar başlarken her şeyi sıfırdan girmemelidir.

---

## 5. Admin Panel UX Yaklaşımı

Admin panelde UX sadece güzel görünüm değil, operasyon hızıdır.

### 5.1 Operasyon Önceliği
Admin ilk bakışta şu soruların cevabını görmelidir:
- bugün kaç talep geldi
- hangileri bekliyor
- hangilerine dönüş yapılmış
- hangi alanlarda eksik veri var
- hangi işler aksiyon gerektiriyor

### 5.2 Yoğunluğu Yönetme
Admin panelde fazla yoğun bilgi, yanlış UX üretir. Bu yüzden:
- üstte KPI kartları
- ortada grafik / özet
- altta detay listeleri
mantığı korunmalıdır.

### 5.3 Form Deneyimi
Admin tarafında ürün ekleme / düzenleme formları:
- uzun ama yönetilebilir olmalı
- bölüm section yapısıyla ayrılmalı
- kaydetme kaygısı yaratmamalı
- hata alanları açık işaretlenmeli
- otomatik taslak / ileride saklama mantığı sonraya bırakılabilir ama düşünülmeye açık olmalı

---

## 6. Temel UX Kararları

### 6.1 Formlar Kısa ve Anlaşılır Olmalı
Özellikle public teklif formu minimum alan mantığıyla çalışmalıdır.
Zorunlu olmayan bilgi ilk fazda istenmemelidir.

### 6.2 Geri Bildirim Her Adımda Görünür Olmalı
Kullanıcı şu an ne oldu sorusunu sormamalıdır.
Bu yüzden:
- ürün eklendi bildirimi
- teklif gönderildi onayı
- hata mesajı
- mail gönderimi bilgisi
- durum güncellemesi
net olmalıdır.

### 6.3 Boş Durumlar Tasarlanmalı
Örnek boş durumlar:
- teklif listesi boş
- hiç teklif geçmişi yok
- arama sonucu yok
- kategori altında ürün yok
- admin dashboard’da veri yok

Bu alanlar sadece “boş” bırakılmamalı; yönlendirici mikro metin ve CTA içermelidir.

### 6.4 Hata Deneyimi İnsanî Olmalı
Hatalar teknik ve soğuk dille sunulmamalıdır.
Kullanıcıya:
- neyin yanlış olduğu
- nasıl düzelteceği
- tekrar ne yapabileceği
anlatılmalıdır.

### 6.5 Kritik Aksiyonlar Korunmalı
Özellikle admin tarafında:
- silme
- pasife alma
- yayından kaldırma
- teklif durumunu kapatma

aksiyonları doğrulama gerektirmelidir.

---

## 7. Bu Projede UX Açısından Özel Dikkat Gerektiren Noktalar

### 7.1 Teklif Listesi Sepet Gibi Hissettirmeli Ama Sipariş Gibi Karışmamalı
Kullanıcı tanıdık bir akış görmeli, ama bunun teklif süreci olduğunu da net anlamalıdır.
Bu nedenle metinlerde ve butonlarda dil dikkatli seçilmelidir.

Örnek:
- “Sepete Ekle” yerine “Teklif Listesine Ekle”
- “Siparişi Tamamla” yerine “Teklif Talebini Gönder”

### 7.2 Teknik Bilgi Yoğunluğu Dengelemeli
Teknik ürünlerde çok bilgi gerekir; ancak sayfa boğulmamalıdır.
Bu nedenle:
- üstte kısa özet
- altta detay tablo
- etiket / badge / section mantığı
kullanılmalıdır.

### 7.3 Misafir ve Üye Akışları Çatışmamalı
Misafir kullanıcı sistemden dışlanmamalı.
Ama üyelik avantajı da görünür olmalıdır.

### 7.4 Responsive UX Sadece Daraltma Olmamalı
Aynı ekran küçültülmüş gibi görünmemeli; mobil davranış gerçekten yeniden düşünülmelidir.

---

## 8. UX İçin Proje Genelinde Kullanılacak Ortak Kalıplar

İlk fazda aşağıdaki ortak deneyim kalıpları benimsenmelidir:
- toast bildirimleri
- inline form hata mesajları
- durum rozetleri
- loading state’ler
- skeleton / loading placeholder alanları
- boş durum kartları
- onay modal’ları
- sticky mobil CTA’lar
- drawer / sheet yapıları
- breadcrumb kullanımı

Bu ortak kalıplar public, customer ve admin tarafında tutarlı bir deneyim oluşturacaktır.

---

## 9. UX Başarı Ölçütleri

UX başarısını sadece görsel kaliteyle ölçmemek gerekir. İlk faz için UX kalitesi şu sinyallerle değerlendirilebilir:
- teklif formu tamamlama oranı
- teklif listesine ürün ekleme oranı
- aramadan ürün detayına geçiş oranı
- müşteri paneline giriş yapan kullanıcıların tekrar kullanım oranı
- mobil kullanıcıların teklif tamamlama oranı
- hata sonrası form terk oranı
- benzer / ilgili ürünlerden etkileşim oranı

---

## 10. Netleşen UX Kararları

### 10.1 Public teklif formu akışı
İlk fazda public teklif formu **tek adımlı** olacaktır.

#### Neden tek adımlı yapı daha doğru?
- teklif akışını uzatmaz
- misafir kullanıcıyı yormaz
- mobilde daha rahat tamamlanır
- ilk faz için dönüşüm oranını korur

Ancak tek adımlı form şu prensiplere göre kurgulanmalıdır:
- gereksiz alan içermemeli
- teklif listesi özeti formun üstünde veya yanında görünmeli
- zorunlu ve opsiyonel alan ayrımı net olmalı
- gönderim sonrası güçlü onay durumu gösterilmelidir

### 10.2 Teklif listesine ürün eklenince geri bildirim nasıl olmalı?
Ürün teklif listesine eklendiğinde kullanıcıya sadece küçük bir toast göstermek yeterli değildir. En doğru UX, **çok katmanlı ama rahatsız etmeyen geri bildirim** yaklaşımıdır.

#### Önerilen geri bildirim modeli
1. **Anlık toast bildirimi**
   - örnek mantık: “Ürün teklif listenize eklendi.”

2. **Teklif listesi göstergesinde anlık sayaç güncellemesi**
   - header / mini teklif listesi sayısı artmalı

3. **Hızlı aksiyon alanı**
   Ürün eklendikten sonra kullanıcıya iki net yön sunulmalıdır:
   - **Ürünleri İncelemeye Devam Et**
   - **Teklif Talebine Geç**

4. **Mini teklif paneli / drawer özeti**
   - eklenen ürün kısa özet olarak görülebilir
   - kullanıcı isterse oradan teklif listesine gidebilir

#### Neden bu model en doğru?
- kullanıcı ne olduğunu hemen anlar
- mevcut akıştan kopmaz
- ister keşfe devam eder, ister hemen dönüşüm adımına geçer
- modern e-ticaret hissini teklif akışına uyarlamış olur

### 10.3 Teklif durum rozetleri
Teklif durumları fazla karmaşık olmamalı; hem kullanıcı hem admin tarafında kolay anlaşılmalıdır.

#### İlk faz için önerilen rozet durumları
1. **Alındı**
2. **İnceleniyor**
3. **Cevaplandı**
4. **Ek Bilgi Bekleniyor**
5. **Tamamlandı**
6. **İptal Edildi**

#### Neden bu yapı doğru?
- kısa ve anlaşılırdır
- kullanıcıyı teknik terimle boğmaz
- süreç akışını net gösterir
- admin tarafında da operasyonel olarak yeterlidir

#### UX notu
- rozetler renk + ikon + kısa metin ile desteklenmelidir
- sadece renge bağımlı olmamalıdır
- müşteri paneli ve admin panelde aynı mantıkta kullanılmalıdır

### 10.4 Public tarafta boş sonuç / boş liste ekranları
Buradaki soru, kullanıcı bir işlem yaptığında karşısına hiç sonuç çıkmayan ekranlarda nasıl yönlendirileceğidir.

Örnek boş durumlar:
- arama sonucu bulunamadı
- filtre sonrası ürün çıkmadı
- teklif listesi boş
- ilgili / benzer ürün bulunamadı

#### Best practice yaklaşımı
Boş durum ekranı sadece “sonuç yok” dememelidir. Kullanıcıya ne yapabileceğini göstermelidir.

#### Önerilen CTA mantıkları
**Arama sonucu yoksa:**
- **Tüm Ürünleri Gör**
- **Kategorilere Göz At**
- **Teklif Talebi Oluştur**

**Filtre sonucu yoksa:**
- **Filtreleri Temizle**
- **Tüm Ürünlere Dön**

**Teklif listesi boşsa:**
- **Ürünleri İncelemeye Başla**
- **Kategorilere Git**

**Benzer / ilgili ürün yoksa:**
- **Tüm Ürünleri Gör**
- **Kullanım Alanlarına Göz At**

#### Neden bu önemli?
İyi UX’te boş ekran son değil, yeni başlangıç noktası olmalıdır. Kullanıcı asla çıkmaz sokağa girmiş gibi hissetmemelidir.

### 10.5 Admin ürün ekleme / düzenleme deneyimi
İlk fazda admin ürün formu **sekmeli / adım adım ilerleyen yapı** ile tasarlanacaktır.

#### Neden tek uzun sayfa yerine bu model?
- yoğun veri girişinde bilişsel yükü azaltır
- teknik ürün formunu daha yönetilebilir hale getirir
- hata kontrolünü kolaylaştırır
- kaybolma hissini azaltır
- modern admin UX’e daha uygundur

#### Önerilen form adımları
1. **Temel Bilgiler**
   - ürün adı
   - ürün kodu
   - kategori
   - marka
   - aktif / pasif

2. **Görseller**
   - çoklu görsel yükleme
   - ana görsel seçimi

3. **Teknik Özellikler**
   - kategoriye bağlı şablon alanları

4. **Kullanım Alanları ve İlişkiler**
   - kullanım alanı etiketleri
   - benzer / ilgili ürün ilişkileri gerekirse sonraya açık yapı

5. **Görünürlük ve Ayarlar**
   - fiyat görünürlüğü
   - stok görünürlüğü
   - teklif alınabilir durumu
   - öne çıkan ürün

6. **Açıklama ve SEO**
   - kısa açıklama
   - açıklama
   - SEO alanları

#### Gezinme davranışı
- admin önceki adıma dönebilmelidir
- sonraki adıma geçtiğinde girilen veriler kaybolmamalıdır
- sekmeler arasında geçiş kontrollü ama esnek olmalıdır
- son kaydetme öncesinde genel bir özet ekranı opsiyonel olarak değerlendirilebilir

#### UX notu
Bu yapı tam bir “wizard” gibi katı olmak zorunda değildir. En doğru yaklaşım:
- sekmeli bölümleme
- ilerleme mantığı
- veri kaybı olmaması
- gerektiğinde adımlar arasında geri dönüş serbestliği

---

## 11. Ön Sonuç

Bu aşamada önerilen UX omurgası şu prensiplere dayanır:
- kullanıcı ne yapacağını hızlı anlamalı
- ürün keşfi sürtünmesiz olmalı
- teklif süreci minimum adımla ilerlemeli
- misafir ve üye akışları birlikte ama net çalışmalı
- geri bildirimler görünür olmalı
- admin panel operasyon hızını desteklemeli
- mobil deneyim ayrı düşünülmeli
- ortak UI davranış kalıpları proje genelinde tutarlı olmalı
- public teklif formu tek adımlı olmalı
- ürün teklif listesine eklendiğinde çok katmanlı ama hafif geri bildirim verilmelidir
- teklif durum rozetleri sade ve anlaşılır olmalıdır
- boş durum ekranları yönlendirici CTA’lar içermelidir
- admin ürün formu sekmeli ve veri kaybetmeyen yapı ile ilerlemelidir

Bu doküman, sonraki aşamada UI sistemi, ekran davranışları, form akışları ve bileşen kararlarını netleştirmek için temel olacaktır.

