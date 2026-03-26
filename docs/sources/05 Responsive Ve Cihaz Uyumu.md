# Web Projesi — 05 Responsive ve Cihaz Uyumu

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi ve arayüz kararlarından sonra, projenin farklı cihazlarda nasıl davranacağını netleştirmek için hazırlanmıştır. Amaç; public site, müşteri paneli ve admin panelinin mobil, tablet, dizüstü ve büyük ekranlarda kontrollü, okunabilir ve kullanılabilir bir deneyim sunmasını sağlamaktır.

Bu bölüm, modern web uygulamalarında responsive yapının artık opsiyon değil, temel gereklilik olduğu anlayışına dayanır. Mobil, tablet, masaüstü ve büyük ekran desteği; menü davranışı, tablo taşmaları, form kullanılabilirliği, dokunmatik etkileşim ve görsel hiyerarşinin korunması gibi başlıklar bu proje için de temel kabul edilmiştir. fileciteturn4file0 Ayrıca burada yer alan responsive kararları; teklif odaklı ürün yapısı, 3 katmanlı bilgi mimarisi, UX kararları ve UI sistem yaklaşımı üzerine kurulacaktır. fileciteturn4file2 fileciteturn4file1 fileciteturn4file3 fileciteturn4file4

---

## 1. Responsive Bu Projede Ne Anlama Geliyor?

Bu projede responsive olmak sadece ekran küçülünce kolonların alta inmesi anlamına gelmez. Responsive yaklaşım şu anlama gelir:
- her cihazda okunabilirlik korunmalı
- her cihazda ana aksiyonlar görünür olmalı
- yoğun bilgi uygun sırada sunulmalı
- etkileşim biçimi fare ve dokunmatik kullanıma göre uyarlanmalı
- form ve tablo deneyimi cihaz tipine göre yeniden düşünülmeli

Bu projede responsive yaklaşımın temel amacı:
**teklif oluşturma, ürün keşfi ve panel kullanımını cihaz bağımsız şekilde güçlü tutmaktır.**

---

## 2. Desteklenecek Cihaz Katmanları

Bu proje için responsive kararlar 4 ana cihaz katmanına göre ele alınmalıdır:

1. **Mobil**
2. **Tablet**
3. **Dizüstü / Masaüstü**
4. **Büyük Ekran**

### 2.1 Mobil
Mobil cihazlar ilk faz için kritik önemdedir. Özellikle:
- hızlı ürün arama
- teklif listesine ürün ekleme
- teklif formu doldurma
- iletişim / WhatsApp / telefon aksiyonları
mobilde güçlü çalışmalıdır.

### 2.2 Tablet
Tablet katmanı genelde gözden kaçar; ancak katalog, müşteri paneli ve admin formları için geçiş katmanı olarak önemlidir.

### 2.3 Dizüstü / Masaüstü
En zengin kullanım burada olacaktır. Özellikle:
- katalog filtreleme
- ürün karşılaştırmalı bakış
- admin teklif yönetimi
- dashboard analitik ekranları
masaüstünde tam verim vermelidir.

### 2.4 Büyük Ekran
Büyük ekranlarda içerik fazla yayılmamalı, kontrolsüz boşluk oluşmamalıdır. Maksimum container ve widget genişlikleri düşünülmelidir.

---

## 3. Breakpoint Yaklaşımı

Teknik değerler sonraki teknik dokümanda netleştirilebilir; ancak UX/UI açısından şu mantık benimsenmelidir:

- **Mobil:** tek kolon öncelikli
- **Tablet:** 2 kolon veya sadeleştirilmiş çok kolon
- **Masaüstü:** tam deneyim
- **Büyük ekran:** kontrollü genişleme

### Responsive prensip
Aynı ekran her cihazda sadece küçültülmeyecek; bazı alanlar:
- yeniden sıralanacak
- sadeleşecek
- drawer / sheet mantığına taşınacak
- tablo yerine kart görünümüne dönebilecek

---

## 4. Public Site Responsive Yaklaşımı

### 4.1 Header
#### Masaüstü
- tam navigasyon görünür
- global arama görünür
- teklif listesi göstergesi görünür
- giriş / hesap alanı görünür

#### Mobil
- hamburger menü
- kompakt logo
- görünür arama erişimi
- teklif listesi göstergesi
- gerekirse hesap ikonu

### 4.2 Hero Alanı
#### Masaüstü
- güçlü başlık
- kısa açıklama
- arama alanı
- iki CTA
- destekleyici görsel alan

#### Mobil
- başlık daha kısa
- açıklama sadeleşmiş
- arama tam genişlikte veya rahat erişimli
- CTA’lar alt alta veya iki dengeli buton halinde
- gereksiz dekoratif alanlar azaltılmış

### 4.3 Kategori Blokları
#### Masaüstü
- 4 kolonlu kategori grid

#### Tablet
- 2 kolon

#### Mobil
- 1 kolon veya bağlama göre 2 kolon
- görsel oranı hafif düşürülmeli
- bilgi alanı görünür kalmalı

### 4.4 Ürün Kataloğu
#### Masaüstü
- hibrit filtre yapısı
- üst bar + sol filtre paneli
- grid / liste geçişi

#### Tablet
- filtre paneli daraltılmış veya kısmen collapsible olabilir
- liste alanı daha baskın olabilir

#### Mobil
- filtreler sheet / drawer içinde açılmalı
- üstte arama + sıralama + filtre çağrısı görünür olmalı
- ürün kartları okunur, sıkışmayan düzende ilerlemeli

### 4.5 Ürün Detay
#### Masaüstü
- sol görsel
- orta bilgi alanı
- sağ aksiyon bloğu

#### Tablet
- iki kolonlu sadeleştirilmiş yapı düşünülebilir
- aksiyon bloğu daha kompakt hale getirilebilir

#### Mobil
- tek kolon
- görsel
- ürün kimliği bilgileri
- kısa teknik özet
- sticky CTA bar
- detay teknik tablo alt bölümde

### 4.6 Teklif Sepeti ve Teklif Formu
#### Mobil öncelik
Bu alanlar mobilde özellikle temiz çalışmalıdır.

Kurallar:
- satırlar sıkışmamalı
- adet alanı rahat kullanılmalı
- sil / düzenle aksiyonları yanlış tıklanmayacak şekilde yerleşmeli
- form alanları kısa ve net olmalı
- CTA ekranın altında kaybolmamalı

---

## 5. Customer Panel Responsive Yaklaşımı

Customer panel responsive davranışı masaüstü küçültmesi gibi görünmemelidir.

### 5.1 Dashboard
#### Masaüstü
- üstte KPI kartları
- altta teklif listesi + hızlı aksiyon alanı

#### Tablet
- KPI kartları 2’li dizilebilir
- liste ve yardımcı bloklar yeniden sıralanabilir

#### Mobil
- KPI kartları alt alta veya yatay scroll ile sunulabilir
- son teklifler kart görünümüne dönebilir
- hızlı tekrar talep aksiyonu görünür kalmalı
- son giriş tarihi ve profil tamamlama ikincil seviyede sunulmalı

### 5.2 Tekliflerim Listesi
#### Masaüstü
- tablo görünümü uygun

#### Mobil
- tablo yerine kart görünümü veya responsive satır blokları daha doğru olur
- teklif numarası, tarih, durum ve detay aksiyonu hızlı görünmelidir

### 5.3 Teklif Detay
#### Mobilde kritik karar
- ürün satırları dar tablo gibi görünmemeli
- her satır kart / section mantığıyla gösterilebilir
- fiyat, termin ve açıklama daha okunur sırada sunulmalıdır

### 5.4 Profil / Şirket Bilgileri
- form alanları mobilde tam genişlik
- iki kolonlu alanlar tek kolona düşmeli
- opsiyonel alanlar açıkça ayrılmalı

---

## 6. Admin Panel Responsive Yaklaşımı

Admin panel çoğunlukla masaüstü ağırlıklı kullanılacaktır; ancak tablet ve dar ekranlarda da yönetilebilir olmalıdır.

### 6.1 Sidebar
#### Masaüstü
- gruplu sidebar görünür

#### Tablet / Mobil
- drawer sidebar
- grup başlıkları collapse olabilir
- aktif ekran takibi net olmalı

### 6.2 Dashboard
#### Masaüstü
- çok kartlı KPI satırları
- grafik alanları
- tablo / liste blokları

#### Tablet
- KPI kartları daha az kolonla akmalı
- grafikler alt alta geçebilir

#### Mobil
- tam admin verim beklenmez; ama temel izleme mümkün olmalı
- kritik KPI kartları öncelikli görünmeli
- grafikler sadeleştirilmeli
- tablo blokları kart / dar liste yapısına dönüşebilir

### 6.3 Ürün Formları
Sekmeli yapı responsive’e yardımcı olacaktır.

#### Mobil / Tablet notu
- sekmeler yatay taşma üretmemeli
- stepper / scrollable tab mantığı düşünülebilir
- form alanları tek kolon akmalı
- veri kaybı olmamalı

### 6.4 Tablolar
Admin tarafında büyük tablolar kaçınılmaz olabilir.

Best practice:
- masaüstünde tam tablo
- dar ekranlarda yatay scroll kabul edilebilir
- ama kritik alanlar görünür kalmalı
- bazı liste türlerinde kart fallback düşünülebilir

---

## 7. Dokunmatik Kullanım İlkeleri

Responsive sadece görünüm değil, etkileşim de demektir.

Bu projede dokunmatik kullanım için dikkat edilmesi gerekenler:
- tıklanabilir alanlar yeterli büyüklükte olmalı
- icon button’lar çok küçük olmamalı
- sil / kaldır gibi riskli aksiyonlar birbirine çok yakın olmamalı
- dropdown / select alanları dokunmatik kullanımda rahat açılmalı
- sticky CTA’lar parmak erişimine uygun konumda olmalı

---

## 8. Responsive İçerik Hiyerarşisi

Her cihazda aynı bilgi aynı öncelikte gösterilmemelidir.

### 8.1 Mobilde öncelikli bilgiler
- ürün adı
- ürün kodu
- teklif CTA
- teklif durumu
- temel kimlik bilgisi
- kritik özet metrikler

### 8.2 Daha aşağı taşınabilecek bilgiler
- uzun açıklamalar
- detay teknik tablolar
- ikincil istatistikler
- destekleyici yardımcı içerikler

### 8.3 Neden önemli?
Mobil ekranda her şeyi aynı anda göstermeye çalışmak UX’i bozar. Önceliklendirme gerekir.

---

## 9. Tarayıcı ve Uyum Notları

İlk faz için hedef yaklaşım:
- modern tarayıcılarda sorunsuz çalışma
- Chrome, Edge, Safari ve Firefox üzerinde temel uyum
- kritik aksiyonlarda tarayıcı farkı nedeniyle kırılma olmaması

Özellikle test edilmesi gereken alanlar:
- sticky CTA davranışı
- drawer / sheet açılımları
- form validasyon görünümleri
- tablo yatay taşma alanları
- dark mode geçişi

---

## 10. Responsive Test Kontrol Alanları

İlk fazda test edilirken aşağıdaki ekranlar mutlaka çoklu cihaz mantığıyla kontrol edilmelidir:
- ana sayfa
- ürün kataloğu
- ürün detay sayfası
- teklif sepeti
- teklif formu
- müşteri panel dashboard’ı
- teklif listesi
- teklif detay ekranı
- admin dashboard
- admin ürün formu

---

## 11. Responsive İçin Netleşen Proje Kararları

Bu aşamada mevcut kararlarla uyumlu olarak şu responsive kabuller netleşmiştir:
- public tarafta global arama mobilde görünür erişimli olacak
- ürün kataloğunda hibrit filtre yapısı mobilde drawer / sheet’e dönüşecek
- ürün detayda mobil sticky teklif CTA kullanılacak
- kategori kartları masaüstünde 4 kolon olacak
- ürün kartlarında teknik özet 2 satır ile sınırlanacak
- customer panel kartları mobilde sadeleşecek ama aksiyonlar kaybolmayacak
- admin panel sidebar mobilde drawer mantığına dönüşecek
- dark mode light/dark token yapısıyla responsive sistemin parçası olacak

---

## 12. Netleşen Responsive Kararlar

### 12.1 Mobilde kategori kartları
UI/UX ve responsive açısından en doğru yaklaşım, mobilde kategori kartlarını **2 kolon** başlatmaktır.

#### Neden 2 kolon daha doğru?
- kategori keşfini hızlandırır
- kullanıcıya bir bakışta daha fazla seçenek gösterir
- görsel ağırlıklı kategori kartlarında modern his verir
- teknik ürün projelerinde ana keşif akışını gereksiz uzatmaz

#### Dikkat edilmesi gereken nokta
2 kolon yapıda kart içeriği sıkışmamalıdır. Bu nedenle:
- mobilde görsel oranı kontrollü düşürülmeli
- başlık 2 satırı geçmemeli
- kısa açıklama çok kısa tutulmalı veya bazı kırılımlarda sadeleştirilebilmelidir

#### İstisna notu
Çok dar ekranlarda veya çok uzun kategori isimlerinde tasarım gerektiğinde 1 kolona düşebilir; ancak temel mobil yaklaşım 2 kolon olacaktır.

### 12.2 Mobil ürün kataloğunda varsayılan görünüm
Mobil ürün kataloğunda varsayılan görünüm **grid** olacaktır.

Bu karar:
- vitrinsel keşfi güçlendirir
- modern mobil e-ticaret davranışına daha yakındır
- kullanıcıya daha fazla ürünü tarama imkanı verir

Liste görünümü alternatif olarak desteklenebilir; ancak varsayılan grid kalmalıdır.

### 12.3 Müşteri panelinde mobil KPI kartları
UI/UX ve responsive açısından en doğru yaklaşım, mobilde KPI kartlarını **alt alta** göstermektir.

#### Neden yatay scroll değil?
Yatay scroll KPI alanlarında bazen şık görünse de:
- bilgi kaçırılmasına neden olabilir
- ilk bakışta tüm durumu göstermeyebilir
- kullanıcıyı ekstra kaydırma davranışına zorlar

#### Neden alt alta daha doğru?
- tüm kritik bilgiler görünür olur
- mobilde okunabilirlik artar
- durum takibi daha net olur
- erişilebilirlik açısından daha güvenlidir

#### Uygulama notu
Kartlar alt alta dizilirken:
- yükseklikleri çok büyümemeli
- başlık + sayı + kısa alt bilgi dengesi korunmalı
- ilk 2-4 kritik kart daha üstte yer almalıdır

### 12.4 Admin panelde mobil kapsam
UI/UX açısından en doğru yaklaşım, admin panelde mobilde **temel izleme ve hafif düzenleme** öncelikli olmaktır.

#### Bu karar neden doğru?
Admin panelin doğası gereği:
- yoğun tablo kullanımı
- çok alanlı formlar
- toplu yönetim işlemleri
- detaylı operasyon akışları
çoğunlukla masaüstünde daha verimli yürütülür.

Bu nedenle mobilde hedef şu olmalıdır:
- dashboard izleme
- kritik teklif takibi
- temel durum güncelleme
- hafif içerik / veri düzenleme
- hızlı aksiyonlar

#### Mobilde öncelikli desteklenecek admin işlemleri
- dashboard özetlerini görmek
- teklif detayını görüntülemek
- teklif durumunu güncellemek
- kısa not eklemek
- temel ürün / içerik alanlarını hafifçe düzenlemek

#### Mobilde ikinci planda kalabilecek işlemler
- uzun ürün formu düzenleme
- yoğun tablo operasyonları
- kapsamlı toplu işlemler
- derin ayar yönetimi

Bu nedenle responsive hedef:
- mobilde yönetilebilir admin deneyimi
- masaüstünde tam verimli operasyon deneyimi
şeklinde kurulmalıdır.

### 12.5 Responsive test yaklaşımı
Responsive test süreci rastgele yapılmamalıdır. Minimum referans genişlikleri ve senaryo bazlı test akışı tanımlanmalıdır.

#### Önerilen minimum genişlik referansları
- **360px** → küçük mobil
- **390px** → modern mobil referans
- **430px** → büyük mobil
- **768px** → tablet dikey
- **1024px** → tablet yatay / küçük laptop geçişi
- **1280px** → standart masaüstü
- **1440px** → geniş masaüstü

#### Neden bu set doğru?
- küçük mobil kırılmaları yakalar
- güncel telefon genişliklerini temsil eder
- tablet geçişlerini kapsar
- masaüstü ve geniş ekran düzenini kontrol eder

### 12.6 Test süreçleri için önerilen kalite yaklaşımı
Responsive test sadece sayfa açıp bakmakla sınırlı olmamalıdır. Şu test katmanları düşünülmelidir:

#### A. Görsel düzen testi
- kolon kırılmaları
- taşma kontrolü
- kart yükseklik dengesi
- CTA görünürlüğü
- sticky alan davranışı

#### B. Etkileşim testi
- menü açılıp kapanması
- filtre drawer / sheet davranışı
- teklif listesine ekleme akışı
- form doldurma kolaylığı
- tablo / kart dönüşümü

#### C. İçerik testi
- uzun başlıklar
- uzun ürün isimleri
- boş durum ekranları
- hata mesajları
- badge / rozet taşmaları

#### D. Tema testi
- light mode
- dark mode
- tema geçişi sonrası kontrast ve görünürlük

#### E. Operasyon testi
- public tarafta teklif akışı
- müşteri panelinde teklif görüntüleme
- admin panelde temel izleme / hafif düzenleme

### 12.7 Kritik ekranlar için test önceliği
İlk fazda en sık test edilmesi gereken ekranlar:
1. Ana sayfa
2. Kategori grid alanı
3. Ürün kataloğu
4. Ürün detay sayfası
5. Teklif listesi
6. Teklif formu
7. Müşteri panel dashboard’ı
8. Tekliflerim listesi
9. Teklif detay ekranı
10. Admin dashboard
11. Admin teklif detay ekranı
12. Admin ürün formu

---

## 13. Ön Sonuç

Bu aşamada responsive ve cihaz uyumu omurgası şu prensiplere dayanır:
- responsive yaklaşım yeniden sıralama ve yeniden düşünme mantığıyla ele alınmalı
- public, customer ve admin alanları aynı şekilde değil, bağlamına göre uyarlanmalı
- mobilde CTA görünürlüğü korunmalı
- filtre, tablo ve yoğun içerik alanları alternatif davranışla yönetilmeli
- ürün keşfi ve teklif akışı mobilde bozulmamalı
- admin panel dar ekranlarda yönetilebilir ama kontrollü sadeleşmiş çalışmalı
- dokunmatik kullanım ayrı bir kalite kriteri olarak ele alınmalı
- mobilde kategori kartları temel olarak 2 kolon yaklaşımıyla ilerlemeli
- mobil katalog varsayılan görünümü grid olmalı
- müşteri panel KPI kartları mobilde alt alta dizilmeli
- admin panel mobilde temel izleme ve hafif düzenleme önceliğiyle tasarlanmalı
- responsive test süreci ekran genişliği + etkileşim + içerik + tema + operasyon katmanlarında ele alınmalı

Bu doküman, sonraki aşamada breakpoint stratejisi, bileşen responsive davranışları ve cihaz bazlı ekran kararlarını daha teknik seviyede netleştirmek için temel olacaktır.

