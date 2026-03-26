# Web Projesi — 14 Entegrasyon ve Genişleyebilirlik

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi, arayüz, responsive yapı, kimlik doğrulama, veri yönetimi, performans, güvenlik, hata yönetimi, arama/filtreleme/listeleme ve yönetim paneli kararlarından sonra, projenin **entegrasyon ve genişleyebilirlik** yaklaşımını netleştirmek için hazırlanmıştır.

Amaç; sistemin bugün ihtiyaç duyduğu servis bağlantılarını doğru şekilde tanımlamak, gelecekte eklenecek harici servisler için kırılgan olmayan bir yapı kurmak ve projenin ilk fazını gereksiz karmaşıklığa boğmadan ölçeklenebilir bir teknik omurga oluşturmaktır.

---

## 0. Bu Bölümde Kararlar Nasıl Verilecek?

Bu bölümde kararlar yalnızca “hangi servisi bağlarız” seviyesinde verilmeyecektir. Tüm alt kararlar aşağıdaki eksenlerle birlikte değerlendirilecektir:

1. **İş ihtiyacı**
2. **Operasyonel gereklilik**
3. **Mimari sürdürülebilirlik**
4. **Güvenlik ve hata toleransı**
5. **İlk faz / sonraki faz dengesi**

### 0.1 Temel ilke

Bu projede entegrasyon yaklaşımı şu prensibe dayanacaktır:

**Harici servisler uygulamanın çekirdeğini ele geçirmemeli; uygulama kendi domain mantığını koruyarak servislerle konuşmalıdır.**

Bu nedenle:
- iş kuralları doğrudan üçüncü parti servis mantığına bağlanmayacak
- servis bağımlılıkları soyut katmanlarla yönetilecek
- kritik akışlarda servis arızası tüm uygulamayı felç etmemeli
- mümkün olan yerlerde değiştirilebilir entegrasyon yapısı kurulacaktır

### 0.2 İlk faz ilkesi

İlk fazda sadece gerçek değer üreten entegrasyonlar alınacaktır.

Yani bir entegrasyon:
- teklif akışını
- admin operasyonunu
- müşteri iletişimini
- medya yönetimini
- ölçümlemeyi

anlamlı biçimde güçlendirmiyorsa ilk faza yüklenmeyecektir.

---

## 1. Entegrasyon Bu Projede Ne Anlama Geliyor?

Bu projede entegrasyon, yalnızca dış API bağlamak değildir. Entegrasyon şu katmanları kapsar:

- e-posta gönderim altyapısı
- dosya / medya saklama altyapısı
- analitik ve ölçümleme araçları
- iletişim kanalları
- gelecekte ödeme / ERP / CRM / kargo / SMS gibi sistemlere açılabilecek bağlantı noktaları

Bu projede entegrasyonun temel amacı:

**çekirdek ürün akışını bozmadan, sistemi daha işlevsel, daha görünür ve geleceğe daha hazır hale getirmektir.**

---

## 2. Genişleyebilirlik Bu Projede Ne Anlama Geliyor?

Bu projede genişleyebilirlik, ilk günden yüzlerce entegrasyon kurmak değil; bugünkü kararların yarın sistemi kilitlememesidir.

Bu nedenle genişleyebilir yapı şu sonuçları üretmelidir:
- yeni servisler sonradan eklenebilir olmalı
- mevcut servis değişirse tüm iş mantığı yeniden yazılmamalı
- ürün modeli teklif odaklı olsa da hibrit satış moduna açılabilmeli
- admin panel yeni modüllerle büyürken bilgi mimarisi dağılmamalı
- entegrasyon hataları izlenebilir ve yönetilebilir olmalı

---

## 3. Entegrasyon Katmanları

Bu proje için entegrasyonlar 5 ana katmanda düşünülmelidir:

1. **Zorunlu operasyon entegrasyonları**
2. **İletişim ve bildirim entegrasyonları**
3. **Medya ve içerik entegrasyonları**
4. **Analitik ve ölçümleme entegrasyonları**
5. **Geleceğe açık ticari / kurumsal entegrasyonlar**

### 3.1 Zorunlu operasyon entegrasyonları
İlk fazda gerçekten çalışması gereken altyapılar:
- mail gönderimi
- medya saklama
- temel sistem log ve hata görünürlüğü

### 3.2 İletişim ve bildirim entegrasyonları
- e-posta akışları
- ileride SMS
- ileride WhatsApp / mesaj tabanlı bilgilendirme

### 3.3 Medya ve içerik entegrasyonları
- ürün görselleri
- banner görselleri
- optimize medya sunumu

### 3.4 Analitik ve ölçümleme entegrasyonları
- temel web analitiği
- olay bazlı ölçümleme
- ileride dönüşüm ve olay bazlı gelişmiş araçlar

### 3.5 Geleceğe açık ticari / kurumsal entegrasyonlar
- ödeme sistemleri
- ERP
- CRM
- kargo / lojistik
- stok / fiyat senkronizasyonu
- webhook tabanlı dış sistem haberleşmeleri

---

## 4. İlk Fazda Zorunlu Kabul Edilecek Entegrasyonlar

İlk faz için profesyonel olarak en doğru minimum set aşağıdaki gibidir:

### 4.1 E-posta gönderim entegrasyonu
Bu proje için e-posta entegrasyonu ilk fazda zorunludur.

Çünkü:
- teklif alındı e-postası gönderilecek
- admin bildirim e-postası gönderilecek
- teklif cevabı e-postası gönderilecek
- auth akışlarında doğrulama ve şifre sıfırlama e-postaları kullanılacak

### 4.2 Medya saklama entegrasyonu
Ürün ve vitrin tarafı görsel odaklı olduğu için medya yönetimi ilk fazda gerçek ihtiyaçtır.

Bu nedenle sistem:
- ürün görsellerini
- banner / vitrin görsellerini
- logo / favicon gibi medya dosyalarını

güvenli ve düzenli biçimde saklayabilmelidir.

### 4.3 Analitik entegrasyonu
İlk fazda en az temel düzeyde analitik kurulmalıdır.

Çünkü başarı takibinde şu sinyaller değerlidir:
- teklif formu tamamlama oranı
- ürün detay görüntüleme
- arama kullanım oranı
- tekliften satışa dönüşüm potansiyeli
- en çok ilgi gören ürün / kategori

---

## 5. E-posta Entegrasyon Yaklaşımı

E-posta bu projenin çekirdek operasyon entegrasyonudur.

### 5.1 E-posta kullanım alanları
İlk fazda e-posta şu akışlarda kullanılacaktır:
- teklif alındı bildirimi
- admin yeni teklif bildirimi
- teklif cevabı bildirimi
- kayıt doğrulama
- şifre sıfırlama

### 5.2 Mimari yaklaşım
E-posta gönderimi doğrudan her ekrana gömülmemelidir.

En doğru yapı:
- iş olayı oluşur
- uygulama bunu domain / application katmanında işler
- mail gönderimi ayrı servis katmanından yürür
- queue ile asenkron ilerler

Bu projede e-posta mantığı uygulamanın kendi notification / mail orchestration katmanında toplanmalıdır. Böylece controller, admin ekranı veya form submit akışı doğrudan provider detayına bağımlı hale gelmez.

### 5.3 Sağlayıcı yaklaşımı
İlk fazda **tek provider** kullanılacaktır.

Bu, ilk faz için en doğru dengedir çünkü:
- operasyonel karmaşıklığı artırmaz
- yapılandırma ve test maliyetini düşürür
- hata ayıklamayı kolaylaştırır
- ilk faz için yeterli teslim hızını korur

Ancak mimari olarak provider bağımlılığı sert gömülmeyecektir. Yani:
- uygulama kendi mail service sözleşmesini tanımlar
- seçilen provider bunun bir implementasyonu olur
- ileride provider değişimi veya ikinci sağlayıcı ekleme ihtimali korunur

### 5.4 Fallback yaklaşımı
İlk fazda **fallback mantığı gerekli kabul edilecektir.**

Burada en doğru yaklaşım, aynı anda çoklu aktif sağlayıcı karmaşası kurmak değil; kontrollü fallback akışı tanımlamaktır.

Profesyonel ilk faz kararı:
- ana sağlayıcı tek provider olacaktır
- gönderim başarısız olursa job retry akışı çalışacaktır
- belirli hata eşiklerinden sonra kayıt başarısız mail olarak işaretlenecektir
- sistem bu başarısızlığı loglayacak ve admin görünürlüğüne taşıyacaktır
- mimari düzeyde secondary provider’a geçişe uygun sözleşme korunacaktır

Yani ilk faz fallback çözümü:
- **önce retry + kuyruk dayanıklılığı**
- **sonra admin görünürlüğü + yeniden gönderim**
- **ileride gerekirse ikinci provider desteğine açık soyut yapı**

Bu yaklaşım, ilk faz için fazla ağır olmayan ama operasyonel riski de küçümsemeyen en doğru dengedir.

### 5.5 Admin tarafı ihtiyaçları
Admin panelde e-posta tarafında en az şu kontroller olmalıdır:
- şablon yönetimi
- bildirim alıcıları ayarı
- temel gönderim durumu takibi
- başarısız gönderim görünürlüğü
- yeniden gönderim aksiyonu

### 5.6 Yeniden gönderim aksiyonu
İlk fazda admin tarafında **yeniden gönderim aksiyonu olacaktır.**

Ancak bu aksiyon kontrolsüz olmamalıdır.

Doğru UX ve operasyon kurgusu:
- başarısız mail kayıtları listelenebilir veya ilgili detay ekranında görülebilir olmalı
- yeniden gönderim sadece yetkili admin tarafından yapılmalı
- yeniden gönderim aksiyonu işlem loguna yazılmalı
- aynı bildirimin peş peşe yanlışlıkla spamlenmesini önlemek için kısa süreli guard düşünülmeli

### 5.7 İlk faz kararı
İlk fazda e-posta altyapısı:
- zorunlu olacak
- tek provider ile başlayacak
- queue tabanlı çalışacak
- retry destekleyecek
- admin yeniden gönderim aksiyonu içerecek
- provider bağımlılığı uygulama içine sert gömülmeyecektir

---

## 6. Medya ve Dosya Saklama Yaklaşımı

Bu projede görseller sadece içerik değil, katalog deneyiminin parçasıdır.

### 6.1 İlk faz medya ihtiyaçları
- ürün ana görseli
- ürün galeri görselleri
- kategori görselleri gerekiyorsa
- vitrin banner görselleri
- marka logoları
- site görselleri

### 6.2 Depolama kararı
İlk fazda medya dosyaları, hosting sağlayıcısının sunduğu **local depolama alanında** saklanacaktır.

Bu karar ilk faz için doğrudur çünkü:
- kurulum ve operasyon maliyetini azaltır
- ilk faz geliştirme hızını düşürmez
- ürün ve vitrin görselleri için yeterli başlangıç çözümü sağlar
- gereksiz erken cloud karmaşıklığını önler

### 6.3 Mimari yaklaşım
Depolama ilk fazda local olsa da uygulama tek bir fiziksel dosya mantığına kilitlenmemelidir.

En doğru yaklaşım:
- uygulama kendi medya yönetim servisini tanımlar
- dosya yükleme, taşıma, silme, URL üretme ve erişim mantığı bu servis üzerinden yürür
- altta local storage kullanılır
- ileride cloud storage’a geçiş için storage driver bağımsızlığı korunur

Yani ilk fazda local kullanım olacak; fakat kod yapısı “yalnızca local varmış” gibi dağınık kurulmayacaktır.

### 6.4 Görsel varyantları nasıl yönetilecek?
Bu başlıkta en doğru ilk faz kararı, sınırsız varyant üretmek değil; kontrollü ve ihtiyaç odaklı preset mantığı kullanmaktır.

Profesyonel öneri:
- orijinal dosya saklanır
- ihtiyaç duyulan yerler için sınırlı sayıda türev varyant üretilir
- varyantlar ekran ihtiyacına göre preset mantığıyla tanımlanır

İlk faz için yeterli varyant seti:
- **thumb** → liste ve küçük kart alanları
- **medium** → ürün kartı, admin önizleme, standart grid alanları
- **large** → ürün detay / geniş vitrin kullanımı

Ek ilkeler:
- dosya formatı ve kalite optimizasyonu uygulanmalı
- orantı bozulmamalı
- gereksiz varyant patlaması önlenmeli
- yalnızca gerçekten kullanılan preset’ler üretilmeli

Bu yaklaşımın avantajı:
- performansı destekler
- görsel kalitesini korur
- front-end tarafında öngörülebilir kullanım sağlar
- ileride CDN/cloud yapısına geçişi zorlaştırmaz

### 6.5 Medya URL ve erişim mantığı nasıl soyutlanacak?
Sadece dosya yolunu doğrudan her yerde kullanmak ilk bakışta kolay görünür; ama uzun vadede kırılgandır.

En doğru yaklaşım:
- veritabanında ham public URL değil, medya kaydının kendi referansı ve göreli dosya yolu tutulur
- URL üretimi uygulamanın media service / presenter katmanında yapılır
- böylece base path, host değişimi, CDN geçişi, signed URL veya farklı disk yapıları sonradan merkezi olarak yönetilebilir

İlk faz için önerilen veri yaklaşımı:
- medya tablosunda veya ilgili kayıt yapısında
  - storage disk
  - relative path
  - original file name
  - mime type
  - file size
  - variant bilgileri
  - alt text / title gibi içerik alanları
  tutulmalıdır

Bu yapıda veritabanına sadece “tam URL” yazmak yerine kontrollü medya metadatası saklanır.

### 6.6 İlk faz kararı
İlk faz için medya altyapısı:
- local storage ile çalışacak
- media service üzerinden yönetilecek
- orijinal dosyayı saklayacak
- thumb / medium / large preset varyantları üretecek
- veritabanında tam URL yerine relative path + metadata mantığı kullanacak
- ileride cloud storage’a geçişi kapatmayacaktır

---

## 7. Analitik ve Ölçümleme Yaklaşımı

Bu projede analitik “olursa iyi olur” seviyesinde değildir; ürün kararlarını destekleyen yapıdır.

### 7.1 Analitik için temel strateji
İlk fazda en doğru denge:
- temel web analitiği kurulmalı
- olay bazlı ölçümleme kritik akışlara odaklanmalı
- zengin metrik üretilmeli
- ancak event kalabalığıyla uygulama ve raporlama boğulmamalıdır

Bu nedenle ilk faz analitik yaklaşımı iki katmanda kurulmalıdır:
1. **temel sayfa ve ekran ölçümleme**
2. **kritik davranış ve dönüşüm event’leri**

### 7.2 İlk fazda zorunlu sayfa ve ekran ölçümleri
- ana sayfa görüntüleme
- kategori liste sayfası görüntüleme
- ürün liste sayfası görüntüleme
- ürün detay görüntüleme
- teklif sepeti / teklif listesi görüntüleme
- teklif formu görüntüleme
- iletişim sayfası görüntüleme

### 7.3 İlk fazda zorunlu davranış event seti
İlk faz için zengin ama yönetilebilir çekirdek event seti aşağıdaki gibi olmalıdır:

#### Keşif ve gezinme event’leri
- search_performed
- search_no_result
- filter_applied
- sort_changed
- category_selected
- product_card_clicked
- product_detail_viewed

#### Teklif dönüşüm event’leri
- quote_item_added
- quote_item_removed
- quote_list_viewed
- quote_form_started
- quote_form_submitted
- quote_form_submit_failed
- quote_success_viewed

#### İletişim ve niyet event’leri
- contact_cta_clicked
- phone_cta_clicked
- email_cta_clicked
- whatsapp_cta_clicked
- company_info_viewed

#### Hesap ve güven event’leri
- register_started
- register_completed
- login_completed
- password_reset_requested
- email_verification_completed

#### İçerik ve vitrin event’leri
- hero_cta_clicked
- featured_category_clicked
- featured_product_clicked
- campaign_banner_clicked

### 7.4 Event tasarım ilkeleri
Event yapısı gereksiz veri şişkinliği üretmemelidir.

Bu yüzden:
- event isimleri tutarlı ve düz olmalı
- aynı davranış farklı isimlerle tekrar edilmemeli
- hassas veri event payload içine yazılmamalı
- event parametreleri raporlamaya gerçekten yarayan alanlarla sınırlı tutulmalı

İlk faz için örnek faydalı parametreler:
- page_type
- product_id
- category_id
- brand_id
- search_term_length
- result_count
- user_type (guest / authenticated)
- quote_item_count
- form_step
- error_type

### 7.5 İlk fazda izlenmesi gereken ana metrikler
İlk faz dashboard ve ürün değerlendirme açısından şu metrikler en değerlileri olacaktır:
- teklif formu başlatma oranı
- teklif formu tamamlama oranı
- ürün detaydan teklife ekleme oranı
- arama kullanım oranı
- arama sonuçsuz kalma oranı
- kategori bazlı ilgi yoğunluğu
- en çok görüntülenen ürünler
- en çok teklife eklenen ürünler
- CTA tıklama oranları
- misafir / üye dönüşüm farkı

### 7.6 Admin dashboard’a hangi metrikler yansıyacak?
Admin panel tam bir analitik ekranına dönüşmemelidir. İlk fazda admin tarafına sadece operasyonel değeri yüksek özetler yansıtılmalıdır.

İlk faz için admin dashboard’a yansıyabilecek anlamlı metrikler:
- son 7 gün teklif sayısı
- teklif formu gönderim trendi
- en çok ilgi gören kategoriler
- en çok görüntülenen ürünler
- en çok teklife eklenen ürünler
- arama kullanım sayısı
- sonuçsuz arama sayısı

Bu metrikler destekleyici blok olarak kullanılmalı; ayrı BI sistemi gibi kurgulanmamalıdır.

### 7.7 Araç seçimi ilkesi
İlk faz için en doğru denge:
- ana web analitiği için tek temel araç
- gerektiğinde olay takibi için aynı ekosistem içinde kalmak
- ek araçları ilk fazda çoğaltmamak

Yani ilk faz için profesyonel karar:
- temel analitik tek ekosistem üzerinden ilerlemeli
- ek tag / marketing tool kalabalığı ilk faza alınmamalı
- event tasarımı ileride gelişmiş ölçümlemeye açılacak şekilde temiz kurulmalıdır

---

## 8. Webhook ve Olay Tabanlı Genişleme Yaklaşımı

Bu proje ilk fazda yoğun webhook mimarisi gerektirmeyebilir; ancak geleceğe açık bir olay mantığı düşünülmelidir.

### 8.1 Neden önemli?
Çünkü ileride şu ihtiyaçlar çıkabilir:
- teklif oluşturulunca CRM’e bildirim
- müşteri oluşunca dış sisteme veri aktarımı
- ürün güncellenince başka sisteme senkron
- sipariş / ödeme / kargo durumlarında dış haberleşme

### 8.2 İlk faz için doğru karar
İlk fazda tam webhook platformu kurmak gerekli değildir.

Ancak **çekirdek domain event seti** şimdiden tanımlanmalıdır.

Bu event’ler ilk fazda öncelikle:
- iç iş akışlarını düzenlemek
- notification / mail / log akışlarını ayrıştırmak
- ileride dış entegrasyonlara zemin hazırlamak

için kullanılacaktır.

Yani event tasarımı ilk fazda sadece teorik hazırlık olmayacak; uygulama içinde gerçek değer üretecektir.

### 8.3 İlk fazda tanımlanması gereken çekirdek event’ler
Bu proje için ilk fazda aşağıdaki çekirdek olaylar yeterli ve doğrudur:
- quote_submitted
- quote_submission_failed
- quote_replied
- quote_status_changed
- customer_registered
- customer_verified
- password_reset_requested
- product_created
- product_updated
- product_archived
- media_uploaded
- media_deleted
- admin_login_succeeded
- admin_critical_action_performed

### 8.4 Event’lerin kullanım amacı
Bu event’ler ilk fazda şu alanlarda kullanılmalıdır:
- e-posta / bildirim tetikleme
- audit log ve işlem geçmişi
- hata ve retry akışları
- ileride webhook yayınlama için temel referans noktası

### 8.5 Webhook hazırlık seviyesi
İlk faz için doğru seviye:
- domain event mantığı kurulmalı
- event isimlendirme ve payload standardı net olmalı
- olay işleyicileri modüler tutulmalı
- dış sistemlere webhook yayınlama mekanizması tam açılmayabilir
- ancak ileride eklenecek webhook publisher için mimari sınır korunmalıdır

Yani bu event’ler yalnızca iç kullanım için değil, **dış entegrasyon potansiyeli gözetilerek** kurgulanacaktır.

Bu karar mimari olarak en sağlıklı dengedir; çünkü ilk fazı gereksiz karmaşıklaştırmaz ama ileride CRM, ERP, ödeme veya özel entegrasyon eklenmesini kolaylaştırır.

---

## 9. Geleceğe Açık Ticari Entegrasyonlar

İlk faz teklif odaklıdır; ancak yapı hibrit modele açık kalmalıdır.

### 9.1 Ödeme sistemleri
İlk fazda zorunlu değildir.
Ancak gelecekte bazı ürünler doğrudan satışa açılırsa ödeme entegrasyonu gündeme gelebilir.

### 9.2 ERP / stok / fiyat senkronizasyonu
İlk fazda zorunlu değildir.
Ancak katalog büyür ve operasyon ağırlaşırsa ERP veya dış stok/fiyat kaynağı entegrasyonu değerli olabilir.

### 9.3 CRM entegrasyonu
İlk fazda şart değildir.
Ancak teklif yoğunluğu arttığında müşteri ve satış süreci yönetimi için dış CRM bağlantısı değer üretebilir.

### 9.4 SMS / WhatsApp entegrasyonu
İlk fazda destekleyici olabilir ama zorunlu değildir.
E-posta ana kanal olarak yeterlidir; hızlı bildirim katmanı sonraki fazda açılabilir.

---

## 10. Entegrasyon Güvenliği ve Hata Toleransı

Harici servisler entegrasyon faydası kadar risk de taşır.

### 10.1 Güvenlik ilkeleri
- API anahtarları güvenli saklanmalı
- servis sırları kod içine gömülmemeli
- yetkisiz endpoint kullanımı önlenmeli
- harici servis hataları kullanıcıya ham biçimde yansımamalı

### 10.2 Hata toleransı ilkeleri
- mail servisi başarısız olursa teklif kaydı kaybolmamalı
- medya işlemi başarısız olursa yarım veri oluşmamalı
- analitik servis çalışmasa da ana kullanıcı akışı devam etmeli
- tekrar denenebilir işler loglanmalı

### 10.3 Gözlemlenebilirlik
- entegrasyon başarısızlıkları loglanmalı
- kritik servis durumları admin tarafından izlenebilir olmalı
- manuel müdahale gerektiren durumlar görünür kalmalıdır

---

## 11. Mimari Soyutlama İlkesi

Bu projede entegrasyon katmanları doğrudan controller veya UI bileşenleri içine dağılmamalıdır.

### En doğru yaklaşım
- uygulama kendi servis sözleşmelerini tanımlar
- provider / driver implementasyonları ayrı tutulur
- iş akışı uygulama katmanında kalır
- harici sağlayıcı sadece taşıyıcı rol üstlenir

Bu yaklaşım şu avantajları sağlar:
- servis değiştirmek kolaylaşır
- test edilebilirlik artar
- vendor lock-in riski azalır
- hata yönetimi merkezi olur

---

## 12. İlk Faz İçin En Doğru Denge

İlk faz için profesyonel denge şu olacaktır:

### İlk faza alınacaklar
- e-posta entegrasyonu
- medya saklama altyapısı
- temel analitik entegrasyonu
- entegrasyon logları ve hata görünürlüğü için temel yapı
- admin yeniden gönderim aksiyonu
- domain event tabanlı iç iş akışı omurgası

### Altyapısı hazırlanıp tam açılmayacaklar
- secondary provider’a uygun mail soyutlaması
- webhook publisher katmanı
- gelecekte ödeme / ERP / CRM entegrasyonuna açık veri ve servis sınırları

### Sonraki faza bırakılabilecekler
- gerçek ikinci mail provider devreye alma
- ödeme entegrasyonu
- SMS / WhatsApp entegrasyonu
- ERP / CRM tam senkronizasyonu
- ileri seviye pazarlama / tag yönetimi katmanları

---

## 13. İlk Faz İçin Netleşmesi Gereken Kararlar

Bu bölümde ana kararlar netleştirilmiştir.

### 13.1 E-posta sağlayıcı yaklaşımı
- ilk fazda tek provider kullanılacak
- retry + queue tabanlı fallback mantığı olacak
- secondary provider’a uygun soyut yapı korunacak
- admin tarafında yeniden gönderim aksiyonu olacak

### 13.2 Medya depolama yaklaşımı
- ilk fazda hosting altyapısındaki local storage kullanılacak
- media service ile depolama mantığı soyutlanacak
- thumb / medium / large preset varyantları üretilecek
- veritabanında tam URL yerine relative path + metadata yapısı tutulacak

### 13.3 Analitik kapsamı
- temel web analitiği tek ekosistem üzerinden kurulacak
- zengin ama kontrollü bir event seti kullanılacak
- kritik odak teklif dönüşümü, arama davranışı, ürün ilgisi ve CTA etkileşimleri olacak
- admin dashboard’a yalnızca operasyonel değeri yüksek özet metrikler yansıyacak

### 13.4 Domain event ve webhook hazırlığı
- ilk fazda çekirdek domain event seti tanımlanacak
- event’ler iç iş akışı, mail, log ve hata akışında gerçek kullanım görecek
- tam webhook yayını ilk fazda zorunlu olmayacak
- event tasarımı dış entegrasyon potansiyeli gözetilerek yapılacak

---

## 14. Sonuç

İlk faz için entegrasyon ve genişleyebilirlik yaklaşımı şu omurgaya dayanacaktır:
- entegrasyonlar çekirdek iş akışını destekleyecek ama iş mantığını ele geçirmeyecek
- ilk fazda yalnızca gerçek değer üreten servisler alınacak
- e-posta, medya ve temel analitik ilk fazın gerçek ihtiyaçları olacak
- sistem provider bağımsız düşünülerek büyümeye açık kurulacak
- gelecekte ödeme, ERP, CRM ve webhook tabanlı genişlemeye uygun sınırlar korunacaktır

---

## 15. Sohbette Netleştirilecek Sonraki Alt Başlıklar

Bu dokümanı birlikte geliştirirken sonraki aşamada şunları detaylandırabiliriz:
1. Mail retry ve admin yeniden gönderim UX akışı
2. Medya tablo tasarımı ve dosya isimlendirme standardı
3. Analitik event naming convention ve payload standardı
4. Domain event sözleşmeleri ve handler ayrımı
5. Sonraki faz entegrasyon yol haritası

