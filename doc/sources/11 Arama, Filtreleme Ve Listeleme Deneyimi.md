# Web Projesi — 11 Arama, Filtreleme ve Listeleme Deneyimi

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi, arayüz, responsive yapı, kimlik doğrulama, veri yönetimi, performans, güvenlik ve hata yönetimi kararlarından sonra, projenin arama, filtreleme ve listeleme yaklaşımını netleştirmek için hazırlanmıştır. Amaç; public katalog, müşteri paneli ve admin panelindeki veri ekranlarının hızlı, anlaşılır, yönetilebilir ve yüksek hacimli veride de sürdürülebilir olmasını proje özelinde tanımlamaktır.

Bu bölüm, modern web uygulamalarında liste ekranlarının yalnızca veri göstermekten ibaret olmadığı; kullanıcıya veriye ulaşma, veriyi daraltma, sıralama, karşılaştırma, işlem yapma ve yoğun içerikte kaybolmadan ilerleme imkânı vermesi gerektiği çerçevesine dayanır. Web Projesi ana çerçevesinde bu başlık; arama, filtreleme, sıralama, sayfalama, toplu işlem desteği, dışa aktarma ihtiyacı değerlendirmesi ve tablo kullanım kolaylığını kapsayan temel alanlardan biri olarak tanımlanmıştır.  Ayrıca bu doküman; teklif odaklı ürün yapısı, bilgi mimarisi kararları, UX/UI prensipleri, responsive davranışlar, auth yapısı, veri modeli, performans ve güvenlik kararları üzerine kurulacaktır. 

---

## 1. Bu Projede Arama, Filtreleme ve Listeleme Ne Anlama Geliyor?

Bu projede arama ve listeleme yalnızca “ürünleri sıralamak” anlamına gelmez. Bu bölüm şu hedefleri birlikte karşılamalıdır:

- kullanıcı doğru ürünü hızlı bulabilmeli
- admin yoğun veri içinde kaybolmadan işlem yapabilmeli
- müşteri teklif geçmişini rahatça takip edebilmeli
- filtreler güçlü ama boğucu olmamalı
- büyük veri setlerinde performans düşmemelidir
- mobil ve masaüstü davranışları bağlama göre değişebilmelidir

Bu projede temel amaç:
**kullanıcının veriye hızlı ulaşmasını, adminin veriyi yönetmesini ve tüm liste ekranlarının sürdürülebilir biçimde büyümesini sağlamaktır.**

---

## 2. Listeleme Alanlarının Türleri

Bu projede arama ve listeleme deneyimi üç ana bağlamda ele alınmalıdır:

1. **Public katalog ve keşif ekranları**
2. **Müşteri paneli liste ekranları**
3. **Admin paneli operasyon ekranları**

### 2.1 Public katalog ve keşif ekranları

Amaç:

- ürün bulmak
- ürünleri daraltmak
- ürünleri karşılaştırmalı olarak taramak
- teklif akışına girmek

### 2.2 Müşteri paneli liste ekranları

Amaç:

- teklif geçmişini görmek
- teklif durumunu anlamak
- belirli bir talebi bulmak
- hızlı tekrar talep oluşturmak

### 2.3 Admin paneli operasyon ekranları

Amaç:

- yoğun veriyi yönetmek
- filtrelemek
- sıralamak
- toplu işlem uygulamak
- kalite ve hata sinyallerini fark etmek

---

## 3. Public Tarafta Arama Yaklaşımı

Bilgi mimarisi dokümanında ilk faz için hem **global arama** hem de **katalog merkezli arama** birlikte kullanılacağı netleşmiştir. Bu iki yapı birbiriyle çakışan değil, birbirini tamamlayan katmanlar olarak düşünülmelidir.&#x20;

### 3.1 Global arama

Global arama:

- header veya hero içinde görünür erişimli olmalıdır
- ürün adı
- ürün kodu
- temel eşleşmeler
  üzerinden hızlı sonuç verebilmelidir

### 3.2 Katalog içi arama

Katalog içi arama:

- filtrelerle birlikte çalışmalıdır
- kategori, marka, kullanım alanı, görünüm ve sıralama ile birlikte bağlamsal kullanılmalıdır
- daha derin ve kontrollü keşif sağlamalıdır

### 3.3 Neden iki katman doğru?

- global arama hızlı giriş noktasıdır
- katalog içi arama detaylı daraltma katmanıdır
- teknik ürün dünyasında iki yapı birlikte daha profesyonel deneyim üretir

---

## 4. Public Katalog Filtreleme Yaklaşımı

Bilgi mimarisi tarafında ürün kataloğu için hibrit filtre yapısı kararlaştırılmıştır: üstte hızlı filtre/sıralama/görünüm kontrolleri, solda detaylı filtre alanı; mobilde ise drawer/sheet yaklaşımı kullanılacaktır. UI sisteminde de filtre alanı aynı mantıkla tanımlanmıştır.&#x20;

### 4.1 İlk faz için önerilen katalog filtreleri

- kategori
- marka
- kullanım alanı
- fiyat görünür ürünler için ilgili durum filtresi gerekiyorsa
- stok görünürlüğü veya stok durumu yalnızca mantıklı olan bağlamlarda
- öne çıkan / yeni / uygun ürün mantıkları ileri faza açık bırakılabilir

### 4.2 Teknik özellik bazlı filtreler

Bu proje teknik ürün yapısına sahip olduğu için teknik özellik filtreleri önemlidir.

Ancak ilk faz için en doğru yaklaşım:

- kategoriye bağlı filtrelenebilir teknik alanları kontrollü açmaktır
- her kategori için tüm teknik alanları aynı seviyede filtreye taşımamaktır

Bu yapı, veri yönetimi tarafında tanımlanan kategori bazlı teknik şablon yaklaşımıyla uyumludur.&#x20;

### 4.3 Filtre UX ilkeleri

- filtre sayısı çok artarsa gruplanmalıdır
- filtreler collapse/expand davranışıyla sunulabilir
- seçilen filtreler görünür chip/badge mantığında özetlenmelidir
- “Filtreleri Temizle” aksiyonu her zaman kolay erişilebilir olmalıdır
- sonuç sayısı kullanıcıya görünmelidir

---

## 5. Public Katalog Listeleme Kararları

Responsive ve performans kararlarında katalog için önemli maddeler zaten netleşmiştir:

- mobilde varsayılan görünüm grid olacaktır.
- public katalogda varsayılan sayfa boyutu 10, alternatifler 20 ve 50 olacaktır.
- ürün kartında ürün adı, ürün kodu, marka, kısa teknik özet, varsa kullanım alanı bilgisi ve teklif CTA’sı bulunacaktır.

### 5.1 Görünüm seçenekleri

Katalogda:

- **grid görünüm**
- **liste görünüm**
  sunulacaktır

#### Varsayılan görünüm

- masaüstünde varsayılan: **grid**
- mobilde varsayılan: **grid**

Liste görünümü alternatif olarak desteklenmelidir; çünkü teknik alıcıların bir kısmı daha yoğun bilgiyle tarama yapmak isteyebilir.

### 5.2 Sayfalama davranışı

İlk faz için public tarafta klasik pagination mantığı tercih edilmelidir.

#### Neden infinite scroll değil?

- filtreli teknik kataloglarda konum kaybı yaratabilir
- footer ve diğer bloklara ulaşmayı zorlaştırabilir
- performans ve ölçümleme açısından ilk fazda gereksiz karmaşıklık üretir

Bu nedenle:

- sayfa numaralı pagination
- sayfa boyutu seçimi
- toplam sonuç bilgisi
  ilk faz için en doğru yapıdır

### 5.3 Sıralama seçenekleri

İlk faz için katalog sıralaması şu yapıda olabilir:

- Varsayılan / Önerilen
- Ada göre A-Z
- Ada göre Z-A
- Ürün koduna göre
- En yeni / güncel ürünler (mantıklıysa)

Fiyat temelli sıralama, fiyat görünürlüğü parametrik olduğu için ilk fazda dikkatli ele alınmalı; herkese açık birincil sıralama olmamalıdır.

---

## 6. Ürün Kartı ve Liste Satırı Davranışı

UI dokümanında ürün kartı içeriği netleşmiştir. Bu dokümanda listeleme bağlamında davranışını tanımlayacağız.&#x20;

### 6.1 Grid kart davranışı

Grid görünümde kart:

- hızlı taramaya uygun olmalı
- görsel + kimlik bilgisi + CTA dengesini korumalı
- teknik özeti en fazla 2 satır göstermelidir
- kullanım alanı bilgisi varsa badge olarak sunulmalıdır

### 6.2 Liste görünümü davranışı

Liste görünümü daha yoğun veri sunabilir:

- ürün görseli küçük/orta boy
- ürün adı
- ürün kodu
- marka
- daha okunur teknik özet
- teklif listesine ekle butonu
- detay butonu

### 6.3 Durum göstergeleri

Bazı ürünlerde aşağıdaki göstergeler yer alabilir:

- teklif alınabilir
- öne çıkan ürün
- fiyat görünür / görünmez bağlama göre işaretlenebilir ama sade tutulmalıdır

---

## 7. Müşteri Paneli Listeleme Yaklaşımı

Müşteri paneli tarafında ana liste ekranı “Tekliflerim” alanıdır. Bilgi mimarisi ve UX tarafında bu alanın temel rolü netleşmiştir.&#x20;

### 7.1 Tekliflerim listesi

Gösterilmesi gereken temel alanlar:

- teklif numarası
- tarih
- durum
- ürün sayısı
- toplam satır adedi
- detay aksiyonu

### 7.2 Filtreleme önerisi

İlk faz için müşteri panelinde filtreler sade tutulmalıdır:

- teklif durumu
- tarih aralığı (gerekirse temel düzeyde)
- teklif numarası ile arama

### 7.3 Listeleme davranışı

- masaüstünde tablo uygun
- mobilde kart/section fallback uygun
- durum rozetleri görünür ve anlaşılır olmalı
- tekrar talep oluşturma aksiyonu erişilebilir olmalı

### 7.4 Varsayılan sıralama

En doğru yaklaşım:

- **en güncel teklif en üstte**

Bu, müşteri paneli kullanım amacına en uygun sıralamadır.

---

## 8. Admin Paneli Listeleme Yaklaşımı

Admin tarafında liste ekranları operasyonel merkezdir. Bilgi mimarisi ve admin UX tarafında bu alanların önemi netleşmiştir.&#x20;

### 8.1 İlk fazda kritik admin listeleri

- teklif talepleri listesi
- ürün listesi
- kategori listesi
- marka listesi
- kullanım alanları listesi
- müşteri listesi
- admin kullanıcı listesi
- log listeleri
- e-posta logları

### 8.2 Ortak tablo ilkeleri

Admin listelerinde:

- arama alanı görünür olmalı
- filtreler anlamlı gruplanmalı
- kolonlar aşırı kalabalık olmamalı
- satır aksiyonları hızlı olmalı
- sayfalama ve sayfa boyutu seçimi bulunmalı
- boş durumlar yönlendirici olmalı

### 8.3 Varsayılan sayfa boyutu

Performans dokümanında admin listeleri için varsayılan 20, alternatifler 40, 50 ve 100 olarak kararlaştırılmıştır.&#x20;

### 8.4 Varsayılan sıralama mantığı

- teklifler: en güncel / en son gelen üstte
- ürünler: yönetim ihtiyacına göre ada veya son güncellenme tarihine göre düşünülebilir
- loglar: en yeni üstte
- müşteriler: en son etkileşim veya son kayıt tarihi bağlama göre değerlendirilebilir

İlk faz için en güvenli yaklaşım:

- operasyon listelerinde recency-first
- katalog listelerinde yönetilebilir sabit sıralama + kullanıcı override

---

## 9. Admin Teklif Listesi İçin Özel Kararlar

Teklifler bu projenin operasyonel omurgasıdır. Bu yüzden admin teklif listesi özel düşünülmelidir.

### 9.1 Gösterilmesi gereken temel sütunlar

- teklif numarası
- müşteri adı / firma adı
- kullanıcı tipi (misafir / üye)
- tarih
- durum
- ürün sayısı
- son işlem / güncelleme
- aksiyonlar

### 9.2 Önerilen filtreler

- durum
- kullanıcı tipi
- tarih aralığı
- teklif numarası
- müşteri adı / firma adı

### 9.3 Hızlı aksiyonlar

Liste düzeyinde bağlama göre:

- detaya git
- durumu güncelle
- not ekle
- mail durumu gör

İlk fazda aşırı sayıda satır içi aksiyon olmamalı; aksi halde tablo boğulur.

---

## 10. Admin Ürün Listesi İçin Özel Kararlar

Ürün listesi, katalog kalitesini ve veri yönetimini doğrudan etkiler.

### 10.1 Gösterilmesi gereken temel sütunlar

- ürün adı
- ürün kodu
- kategori
- marka
- aktif / pasif durumu
- arşiv durumu gerekiyorsa bağlamsal görünümde
- fiyat / stok görünürlüğü özeti
- son güncellenme tarihi
- aksiyonlar

### 10.2 Önerilen filtreler

- kategori
- marka
- aktif/pasif
- arşiv durumu
- teklif alınabilir durumu
- ürün kodu araması
- ürün adı araması

### 10.3 Liste UX ilkesi

Ürün listesi kalite yönetimi ekranı gibi de davranmalıdır.
Örneğin:

- ana görseli yok
- teknik alanı eksik
- görünürlük parametresi çelişkili

bu tip kalite sinyalleri satır bazında hafif işaretlerle sunulabilir.

Bu yaklaşım hata/gözlemlenebilirlik dokümanındaki operasyonel kalite sinyalleri mantığıyla da uyumludur.&#x20;

---

## 11. Toplu İşlem (Bulk Action) Yaklaşımı

Web Projesi ana çerçevesinde toplu işlem desteği değerlendirilmesi gereken alanlardan biridir. Ancak ilk fazda aşırı geniş bir bulk action seti yerine kontrollü yaklaşım daha doğrudur.

### 11.1 İlk faz için uygun toplu işlemler

#### Admin ürün listesi

- toplu pasife alma
- toplu aktife alma
- toplu arşive gönderme
- kategori / marka gibi yapısal bulk edit ilk fazda dikkatli değerlendirilmeli

#### Admin teklif listesi

- toplu status değişimi ilk fazda riskli olabilir
- toplu arşiv / kapatma ilk fazda dikkatle düşünülmelidir

En doğru yaklaşım:

- ürün tarafında sınırlı bulk action
- teklif tarafında daha kontrollü bireysel operasyon

### 11.2 Güvenlik ve doğrulama

Bulk işlemler:

- yetki kontrolünden geçmeli
- onay gerektirmeli
- audit log bırakmalıdır

Bu güvenlik yaklaşımı 09. güvenlik dokümanıyla uyumludur.&#x20;

---

## 12. Kolon Görünürlüğü ve Tablo Özelleştirme

İlk faz için çok gelişmiş kolon özelleştirme şart değildir; ancak admin tarafında büyümeye açık düşünülmelidir.

### İlk faz yaklaşımı

- kritik sütunlar sabit gelir
- bazı listelerde sınırlı kolon gizleme/gösterme ileri faz için açık bırakılır
- ilk fazda tabloyu aşırı özelleştirilebilir yapmak yerine doğru başlangıç kolon seti seçilmelidir

Bu, hem geliştirme maliyetini hem kullanıcı karmaşasını azaltır.

---

## 13. Dışa Aktarma (Export) İhtiyacı

Ana çerçevede export değerlendirilmesi gereken alanlardan biri olarak tanımlanmıştır.  Bu proje için ilk fazda export zorunlu değildir; ancak bazı ekranlar için ileride değerli olabilir.

### İlk faz yaklaşımı

- export özelliği ilk faz MVP için zorunlu kabul edilmeyebilir
- ancak özellikle teklif listeleri ve müşteri listeleri için ikinci faz adayı olarak düşünülmelidir

### Neden ilk fazda bekleyebilir?

- önce veri doğruluğu ve operasyon akışı oturmalıdır
- export erken açıldığında biçim ve güvenlik ihtiyaçları artar
- ilk fazda listeleme ve filtreleme kalitesine öncelik vermek daha doğrudur

---

## 14. Responsive Listeleme Davranışı

Responsive dokümanda liste ekranlarının cihaz bazlı yeniden düşünülmesi gerektiği netleşmiştir. Özellikle müşteri paneli ve admin tarafında bazı tablolar kart fallback’e dönebilecektir.&#x20;

### 14.1 Public katalog

- mobilde grid öncelikli
- filtreler drawer/sheet içinde
- sayfa boyutu seçimi mobilde sade konumda

### 14.2 Müşteri paneli listeleri

- mobilde tablo yerine kart düzeni
- teklif numarası, durum, tarih ve detay aksiyonu öncelikli

### 14.3 Admin listeleri

- mobilde tam tablo verim beklenmez
- kritik listeler dar ekranlarda yatay scroll veya dar kart fallback ile yönetilebilir
- admin mobil kapsamı temel izleme ve hafif düzenleme ile sınırlı kalacaktır.

---

## 15. Netleşen Bildirim ve Geri Bildirim Kararları

### 15.1 Toast mesajlarının konumu ve davranışı
İlk faz için en doğru yaklaşım, toast mesajlarını:
- **masaüstünde sağ üst köşede**
- **mobilde üst güvenli alanda, ekranı kapatmayan kompakt yapıda**
göstermektir.

#### Davranış ilkeleri
- aynı anda ekranda en fazla sınırlı sayıda toast görünmelidir
- kısa süreli başarı toast’ları otomatik kapanabilir
- kritik olmayan bilgi toast’ları kullanıcı akışını bloklamamalıdır
- hata toast’ları gerekiyorsa biraz daha uzun görünür kalabilir
- kritik hata ve kritik uyarılar sadece toast ile geçiştirilmemelidir

#### Neden bu yaklaşım doğru?
- modern arayüzlerde alışılmış davranışla uyumludur
- CTA alanlarını ve alt sticky yapıları daha az bozar
- mobilde alt CTA ile çakışma riskini azaltır
- hem public hem customer hem admin tarafında tutarlı bir sistem kurar

### 15.2 Müşteri panelinde bildirim merkezi
İlk fazda müşteri panelinde **ayrı bir bildirim merkezi olmayacaktır**.

#### Neden bu karar doğru?
- ilk faz kapsamını gereksiz büyütmez
- müşteri panelini daha sade tutar
- zaten kritik bilgiler rozet, kart, durum alanı ve e-posta ile yeterince taşınabilir
- ürünün temel değerini bozmadan ilerlemeyi sağlar

#### İlk fazda kullanılacak alternatif yapı
- teklif durum rozetleri
- panel dashboard kartları
- ilgili sayfa içi bilgi/uyarı blokları
- e-posta bildirimleri

Bu, ilk faz için en dengeli çözümdür. Ayrı bildirim merkezi ikinci faza açık bırakılacaktır.

### 15.3 Admin dashboard’da operasyon uyarılarının görünürlüğü
İlk fazda admin dashboard’daki operasyon uyarıları **yüksek görünür ama kontrollü öncelikte** olmalıdır.

#### En doğru görünürlük modeli
Dashboard’da üç seviyeli yapı önerilir:

**1. Üst seviye kritik sinyaller**
- başarısız mail gönderimi sayısı
- başarısız queue job sayısı
- son 24 saatte kritik hata sayısı
- anormal başarısız login denemeleri

Bu alanlar özet kart veya dikkat çekici küçük uyarı kartları ile görünür olabilir.

**2. Orta seviye operasyon uyarıları**
- eksik teknik alanı olan ürünler
- ana görseli olmayan ürünler
- uzun süredir cevaplanmamış teklifler
- sistem ayarı / mail ayarı kaynaklı son hata uyarıları

Bunlar dashboard’da uyarı paneli veya görev listesi benzeri blokta gösterilebilir.

**3. Alt seviye detay sinyaller**
- arşiv / silme başarısızlıkları
- bozuk ilişki kayıtları
- daha düşük öncelikli kalite uyarıları

Bunlar detay ekranına bağlantı veren sade bir liste halinde bulunabilir.

#### Neden bu model doğru?
- dashboard alarm duvarına dönüşmez
- admin ilk bakışta neye müdahale edeceğini anlar
- hata, kalite ve operasyon sinyalleri birlikte ama düzenli görünür

### 15.4 Export işlemi geri bildirimi
Export ilk fazda yer alacağı için kullanıcıya verilecek geri bildirim de net olmalıdır.

#### En doğru ilk faz yaklaşımı
Export başlatıldığında:
- kısa bir loading durumu gösterilmeli
- ardından işlem başarılıysa toast + sayfa içi kısa onay bilgisi verilebilmelidir

#### Önerilen metin mantığı
- “Dışa aktarma hazırlanıyor...”
- “Dosya başarıyla oluşturuldu.”
- “Dışa aktarma işlemi tamamlanamadı. Lütfen filtrelerinizi kontrol edip tekrar deneyin.”

#### UX notu
İlk fazda export işlemi çok uzun süren asenkron rapor üretimine dönüşmüyorsa:
- buton içi loading
- kısa durum mesajı
- dosya indirme başladığında başarı geri bildirimi

yeterli olacaktır.

Eğer filtre çok geniş ve işlem gecikecekse ileride kuyruklu export yapısı düşünülebilir; ama ilk fazda sade kalmak daha doğrudur.

### 15.5 E-posta bildirimlerinde zorunlu ve opsiyonel mesajlar
İlk faz için e-posta bildirimleri iki seviyede düşünülmelidir.

#### Zorunlu e-postalar
Aşağıdaki e-postalar ilk fazda zorunlu kabul edilmelidir:
- teklif alındı e-postası
- admin’e yeni teklif bildirimi
- teklif cevabı e-postası
- kayıt / e-posta doğrulama e-postası
- şifre sıfırlama e-postası

#### Opsiyonel / ileri faza açık e-postalar
Aşağıdaki mesajlar ilk fazda zorunlu değildir:
- profil güncelleme bilgilendirme e-postası
- her teklif durum geçişi için ayrı e-posta
- düşük öncelikli hatırlatma mailleri
- kampanya / pazarlama e-postaları
- sistemsel özet veya rapor mailleri

#### Neden bu ayrım doğru?
- ilk fazda e-posta kanalını kritik akışlar için temiz tutar
- kullanıcıyı gereksiz mail yüküyle boğmaz
- operasyonel değeri yüksek mesajları önceliklendirir

---

## 16. Ön Sonuç

Bu aşamada bildirimler ve kullanıcı geri bildirimi omurgası şu prensiplere dayanır:
- sistem kullanıcıya ne olduğunu her adımda anlaşılır şekilde söylemelidir
- toast, inline hata, alert, modal ve e-posta birbirinin yerine değil, doğru bağlamlarda kullanılmalıdır
- toast mesajları masaüstünde sağ üstte, mobilde üst güvenli alanda kompakt şekilde görünmelidir
- public tarafta hafif ama görünür geri bildirim kullanılmalıdır
- müşteri panelinde güven ve takip hissi güçlenmelidir
- müşteri panelinde ayrı bildirim merkezi ilk fazda yer almayacaktır
- admin panelde bildirimler operasyon görünürlüğü üretmelidir
- admin dashboard’daki operasyon uyarıları yüksek görünür ama kontrollü öncelikte sunulmalıdır
- export işlemlerinde loading + kısa sonuç geri bildirimi verilmelidir
- e-posta bildirimleri ilk fazda kritik kanal olarak çalışmalıdır
- zorunlu ve opsiyonel e-posta akışları ayrıştırılmalıdır
- güvenlik, hata yönetimi ve performans kararları bildirim dilini doğrudan etkilemelidir

Bu doküman, sonraki aşamada Laravel event/notification yapısı, mail şablonları, toast/alert bileşen sistemi ve admin operasyon uyarılarının teknik seviyede netleştirilmesi için temel olacaktır.

