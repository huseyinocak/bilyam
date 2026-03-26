# Web Projesi — 10 Hata Yönetimi ve Gözlemlenebilirlik

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi, arayüz, responsive yapı, kimlik doğrulama, veri yönetimi, performans ve güvenlik kararlarından sonra, projenin hata yönetimi ve gözlemlenebilirlik yaklaşımını netleştirmek için hazırlanmıştır. Amaç; uygulamada oluşan hata, istisna, başarısız işlem ve anomali durumlarının hem kullanıcı hem geliştirici hem de operasyon tarafı için kontrollü biçimde ele alınmasını proje özelinde tanımlamaktır.

Bu bölüm, modern web uygulamalarında hata yönetiminin yalnızca exception yakalamak değil; kullanıcıya anlaşılır geri bildirim vermek, sistem logları üretmek, kritik sorunları görünür kılmak, işlem geçmişini izlemek ve uygulama sağlığını takip etmek anlamına geldiği çerçevesine dayanır. Web Projesi ana çerçevesinde bu başlık; kullanıcı dostu hata mesajları, sistem logları, exception yönetimi, kritik hata bildirim mekanizması, işlem geçmişi takibi ve uygulama sağlık kontrolü mantığını kapsayan temel alanlardan biri olarak tanımlanmıştır. fileciteturn9file0 Ayrıca bu doküman; teklif odaklı ürün yapısı, 3 katmanlı bilgi mimarisi, UX/UI kararları, responsive davranışlar, auth yapısı, veri/log mimarisi, performans yaklaşımı ve güvenlik kararları üzerine kurulacaktır. fileciteturn9file2 fileciteturn9file1 fileciteturn9file3 fileciteturn9file4 fileciteturn9file5 fileciteturn9file6 fileciteturn9file7 fileciteturn9file8 fileciteturn9file9

---

## 1. Hata Yönetimi Bu Projede Ne Anlama Geliyor?

Bu projede hata yönetimi sadece “bir şey bozulursa kırmızı mesaj gösterelim” yaklaşımı değildir. Hata yönetimi şu alanları birlikte kapsamalıdır:
- kullanıcıyı belirsizlikte bırakmamak
- başarısız işlemleri anlaşılır şekilde açıklamak
- geliştirici için teşhis edilebilir loglar üretmek
- kritik sorunları operasyon tarafında görünür kılmak
- veri bütünlüğünü bozabilecek hataları güvenli şekilde ele almak
- performans ve güvenlik anomalisini fark edebilmek

Bu projede hata yönetiminin temel amacı:
**uygulama bozulduğunda bile kontrollü davranmak, kullanıcı güvenini korumak ve sorunları hızlı teşhis edilebilir hale getirmektir.**

---

## 2. Gözlemlenebilirlik Bu Projede Ne Anlama Geliyor?

Gözlemlenebilirlik; yalnızca log tutmak değil, sistemin ne durumda olduğunu anlamaya yarayan sinyalleri üretmektir.

Bu proje için gözlemlenebilirlik şu katmanlarda düşünülmelidir:
- uygulama logları
- kritik işlem logları
- güvenlik logları
- performans sinyalleri
- kuyruk / mail / arka plan iş durumu
- admin tarafında operasyonel uyarılar

Bu yaklaşım sayesinde şu sorulara daha hızlı cevap verilebilir:
- neden teklif gönderimi başarısız oldu?
- neden bir ürün formu kaydedilemedi?
- neden admin dashboard yavaşladı?
- neden bir kullanıcı giriş yapamadı?
- hangi işlem ne zaman ve kim tarafından tetiklendi?

---

## 3. Hata Katmanları

Bu proje için hatalar 5 ana katmanda ele alınmalıdır:

1. **Kullanıcıya Gösterilen Hatalar**
2. **Uygulama İstisnaları ve Sistem Hataları**
3. **İş Kuralı Hataları**
4. **Entegrasyon ve Arka Plan İş Hataları**
5. **Operasyonel ve Anomali Sinyalleri**

### 3.1 Kullanıcıya Gösterilen Hatalar
Örnekler:
- form validasyon hataları
- giriş yapılamaması
- boş teklif listesiyle gönderim denemesi
- geçersiz dosya yükleme
- erişim reddi

### 3.2 Uygulama İstisnaları ve Sistem Hataları
Örnekler:
- beklenmeyen exception
- veritabanı bağlantı sorunu
- queue problemi
- mail gönderim hatası
- dosya işleme hatası

### 3.3 İş Kuralı Hataları
Örnekler:
- tüm satırlar cevaplanmadan teklifi “Cevaplandı” yapmaya çalışma
- pasif ürün için yanlış akış başlatılması
- arşiv dışından hard delete denemesi
- görünürlük override mantığının hatalı kullanımı

### 3.4 Entegrasyon ve Arka Plan İş Hataları
Örnekler:
- mail sağlayıcı hatası
- Analytics veri çekim sorunu
- görsel işleme başarısızlığı
- queue job başarısızlığı

### 3.5 Operasyonel ve Anomali Sinyalleri
Örnekler:
- anormal hata artışı
- ardışık başarısız login denemeleri
- çok sayıda başarısız teklif gönderimi
- dashboard veri kaynağında gecikme

---

## 4. Kullanıcıya Gösterilen Hata Deneyimi

UX dokümanında hata deneyiminin insanî ve yönlendirici olması gerektiği netleşmiştir. Kullanıcıya neyin yanlış olduğu, nasıl düzelteceği ve ne yapabileceği anlatılmalıdır. fileciteturn9file3

### 4.1 Hata dili
Kullanıcıya gösterilen hata mesajları:
- sade
- teknik jargon içermeyen
- suçlayıcı olmayan
- çözüm odaklı
olmalıdır.

### 4.2 Public tarafta hata örnekleri
- “Teklif talebinizi şu anda gönderemedik. Lütfen bilgilerinizi kontrol edip tekrar deneyin.”
- “Lütfen teklif listesine en az bir ürün ekleyin.”
- “Girdiğiniz e-posta adresi geçerli görünmüyor.”

### 4.3 Customer panel hata örnekleri
- “Teklif detayına şu anda ulaşılamıyor. Lütfen biraz sonra tekrar deneyin.”
- “Profil bilgileriniz kaydedilemedi. Eksik alanları kontrol edin.”

### 4.4 Admin panel hata örnekleri
Admin tarafında hata mesajı biraz daha açıklayıcı olabilir; ancak yine de ham exception metni gösterilmemelidir.

Örnek:
- “Ürün kaydedilemedi. Teknik özellik alanlarında eksik veya geçersiz veri olabilir.”

### 4.5 Ortak UX kuralı
- toast sadece hafif durumlar için kullanılmalı
- kritik hata durumlarında inline mesaj veya sayfa içi uyarı daha doğru olabilir
- form hataları alan bazında gösterilmelidir
- tam sayfa kırılma yerine kontrollü fallback tercih edilmelidir

---

## 5. Hata Sınıflandırma Yaklaşımı

İlk faz için hatalar minimum şu mantıkla sınıflandırılmalıdır:

### 5.1 Validation Error
- kullanıcı girdisi hatalı
- alan bazlı geri bildirim verilir

### 5.2 Authorization Error
- kullanıcı ilgili işlemi yapmaya yetkili değil
- güvenli ve kısa mesaj gösterilir
- detay loglanır

### 5.3 Not Found Error
- istenen kayıt bulunamadı
- müşteri sahip olmadığı kayda erişmeye çalıştıysa güvenli davranılır

### 5.4 Business Rule Error
- işlem teknik olarak mümkün ama iş kuralına aykırı

Örnek:
- tüm satırlar cevaplanmadan “Cevaplandı” yapma denemesi, veri kurallarında netleşen bir iş kuralıdır. fileciteturn9file7

### 5.5 System Error
- beklenmeyen sunucu / entegrasyon / altyapı hatası
- kullanıcıya genel kontrollü mesaj gösterilir
- detay sistem loguna gider

---

## 6. Loglama Katmanları

Veri ve güvenlik dokümanlarında kritik işlemler için log ve audit ihtiyacı netleşmiştir. Güvenlik tarafında kritik olaylar için orta-yüksek detay log tutulması kararlaştırılmıştır. fileciteturn9file7 fileciteturn9file9 Bu dokümanda bunları hata ve gözlemlenebilirlik bakışıyla gruplayacağız.

### 6.1 Uygulama Logları
- exception logları
- hata detayları
- stack trace (sadece güvenli geliştirici ortamında veya hata izleme sisteminde)
- request bağlamı

### 6.2 İşlem Logları
- teklif durumu değişimleri
- ürün arşivleme / pasife alma / silme
- görünürlük ayarı değişiklikleri
- e-posta şablonu güncellemeleri

### 6.3 Güvenlik Logları
- admin girişleri
- başarısız admin giriş denemeleri
- rol / izin değişiklikleri
- hassas ayar değişiklikleri

### 6.4 Entegrasyon Logları
- mail gönderim sonucu
- queue job hata bilgisi
- görsel işleme başarısı/başarısızlığı
- üçüncü taraf servis çağrı sorunları

### 6.5 Performans ve Anomali Logları
- yavaş sorgular
- ağır sayfalar
- başarısız tekrarlayan işlemler
- sıra dışı istek yoğunluğu

---

## 7. Log İçeriği İlkeleri

Log tutmak kadar log içeriğini güvenli ve anlamlı tutmak da önemlidir.

### 7.1 Tutulması gereken bağlam
Kritik olaylarda mümkün olduğunca şu alanlar bulunmalıdır:
- actor_user_id
- actor_role
- action
- subject_type
- subject_id
- timestamp
- ip_address
- user_agent özeti
- route / ekran bağlamı
- sınırlı meta veri

### 7.2 Tutulmaması gerekenler
Güvenlik dokümanında açıkça netleştiği gibi şu veriler logda açık tutulmamalıdır:
- parola
- açık token
- gereksiz hassas kişisel veri
- maskelemesiz gizli alanlar fileciteturn9file9

### 7.3 Üretim ve geliştirme ayrımı
- local/dev ortamında daha detaylı debug bilgisi olabilir
- production ortamında kullanıcıya debug bilgisi gösterilmez
- prod logları kontrollü, temiz ve maskeleme ilkeleriyle tutulur

---

## 8. Kritik İşlem Gözlemlenebilirliği

Bu projede bazı akışlar iş açısından kritik kabul edilmelidir.

### 8.1 Kritik kullanıcı akışları
- teklif listesine ürün ekleme
- teklif formu gönderme
- teklif cevabı oluşturma
- müşteri girişi
- admin girişi
- ürün kaydetme / güncelleme

### 8.2 Bu akışlarda ne izlenmeli?
- başarılı mı başarısız mı
- başarısızsa hangi katmanda kırıldı
- kullanıcıya ne gösterildi
- sistemde hangi log bırakıldı
- tekrar denendi mi

### 8.3 Neden önemli?
Bu yaklaşım hem hata ayıklamayı hem ürün iyileştirmeyi kolaylaştırır. Örneğin teklif gönderim oranı düşerse bunun UX mi, validation mı, mail mi, performans mı kaynaklı olduğunu anlamak kolaylaşır.

---

## 9. Hata Durumunda Fallback Davranışları

Modern uygulama “bir şey patladı” hissi vermemelidir. Kontrollü fallback gerekir.

### 9.1 Public alan fallback’leri
- ürün bloklarından biri yüklenmezse sayfa bütünü çökmez
- benzer / ilgili ürün yoksa boş durum CTA’ları gösterilir
- teklif formu başarısız olursa kullanıcı girdiği veriyi mümkün olduğunca kaybetmez

UX tarafında boş durum CTA’larının yönlendirici olması kararlaştırılmıştır. fileciteturn9file3 Bu hata fallback yaklaşımıyla uyumludur.

### 9.2 Customer panel fallback’leri
- teklif listesi çekilemezse boş beyaz ekran yerine hata kartı gösterilir
- ikincil widget’lar çökse bile temel teklif listesi çalışmaya devam eder

### 9.3 Admin panel fallback’leri
- ağır grafik yüklenmezse KPI kartları yine görünür kalmalı
- sekmeli ürün formunun bir bölümü hata verirse tüm form deneyimi çökmemeli
- kritik işlemlerde başarısızlık net ve geri alınabilir anlatılmalıdır

---

## 10. Admin Dashboard’da Operasyonel Görünürlük

Bilgi mimarisi ve UI dokümanlarında admin dashboard’ın önce aksiyon gerektiren teklif metriklerini göstermesi kararlaştırılmıştır. fileciteturn9file1 fileciteturn9file4 Hata ve gözlemlenebilirlik açısından dashboard’da ayrıca şu sinyaller düşünülebilir:
- başarısız son mail gönderimleri özeti
- son başarısız queue işleri sayısı
- kritik veri eksikliği uyarıları
- anormal giriş denemesi özeti (güvenlik tarafı için)

Bu sinyaller ilk fazda tam bir NOC paneline dönmemeli; ama operasyonel farkındalık üretmelidir.

---

## 11. Queue, Mail ve Arka Plan İş Hataları

Performans dokümanında teklif alındı / teklif cevabı e-postaları ve görsel işleme gibi işlerin mümkün olduğunca kuyrukta çalışması kararlaştırılmıştır. fileciteturn9file8 Hata yönetimi açısından bu şu anlama gelir:

### 11.1 Kuyruk işi başarısız olursa
- job başarısızlığı loglanmalı
- ilgili kayıtla ilişkilendirilebilmeli
- gerektiğinde manuel tekrar denenebilir yapı düşünülmelidir

### 11.2 Mail gönderimi başarısız olursa
- kullanıcı ana akışını bloklamamalı
- sistem logu oluşmalı
- admin için görünür bir iz bırakılmalı
- gerekiyorsa yeniden gönderim aksiyonu admin tarafında düşünülebilir

### 11.3 Görsel işleme başarısız olursa
- hatalı dosya kullanıcıya anlamlı mesajla dönmeli
- yarım kayıt veya bozuk medya ilişkisi oluşmamalıdır

---

## 12. Health Check ve Sistem Durumu

İlk fazda tam kapsamlı observability platformu şart değildir; ancak temel sağlık kontrolü yaklaşımı düşünülmelidir.

### İlk faz için önerilen sağlık sinyalleri
- uygulama çalışıyor mu
- veritabanı erişimi var mı
- kuyruk işleniyor mu
- mail altyapısı temel olarak ayakta mı
- cache katmanı çalışıyor mu

### Nerede kullanılabilir?
- sistem araçları alanında özet bilgi
- operasyon / bakım ekranında sade sağlık durumu

Bu, bilgi mimarisinde tanımlanan “Sistem Araçları” alanıyla da uyumludur. fileciteturn9file1

---

## 13. Livewire ve Hata Yönetimi Notu

UI ve performans dokümanlarında Livewire’ın kontrollü ve güçlü kullanım alanları netleşmiştir. fileciteturn9file4 fileciteturn9file8 Bu projede hata yönetimi açısından:
- Livewire bileşenleri kullanıcıya hızlı ama kontrollü hata geri bildirimi vermelidir
- server-side validation ana kaynak olmalıdır
- Livewire state hataları kullanıcıya ham teknik içerikle gösterilmemelidir
- küçük istemci destekleri olsa bile asıl doğruluk backend’de korunmalıdır

---

## 14. Hata Yönetimi ve Güvenlik İlişkisi

Bazı hata durumları aynı zamanda güvenlik sinyali olabilir.

Örnek:
- çok sayıda başarısız login
- tekrar eden geçersiz form denemeleri
- beklenmeyen parametre kombinasyonları
- erişim reddi sayısında anormal artış

Bu nedenle hata ve güvenlik logları tamamen kopuk düşünülmemelidir; belirli olaylar iki alanı da beslemelidir.

---

## 15. Hata Yönetimi ve Performans İlişkisi

Bazı performans sorunları aslında hata yönetimi sinyalidir.

Örnek:
- çok yavaş sorgular
- timeout’a yaklaşan işlemler
- peş peşe başarısız kuyruk işleri
- ağır bileşen güncellemeleri

Performans dokümanında ölçülmesi gereken alanlar tanımlanmıştır. fileciteturn9file8 Bu dokümanda bunların hata gözlemlenebilirliği için de sinyal olduğu kabul edilmelidir.

---

## 16. Netleşen Hata Yönetimi ve Gözlemlenebilirlik Kararları

### 16.1 Genel sistem hatası mesajlarının tonu
Genel sistem hatası mesajlarında en doğru yaklaşım:
- **sakin**
- **kısa**
- **suçlayıcı olmayan**
- **yönlendirici**
- **gereksiz teknik detay içermeyen**

tondur.

#### Önerilen dil karakteri
Kullanıcıya verilen genel hata mesajları:
- panik üretmemeli
- teknik stack trace göstermemeli
- ne yapabileceğini söylemeli
- güven hissini korumalı

#### Örnek mantık
- “Şu anda işleminizi tamamlayamadık. Lütfen biraz sonra tekrar deneyin.”
- “Beklenmeyen bir sorun oluştu. Bilgileriniz kaydedilmediyse tekrar deneyebilirsiniz.”
- “Şu anda bu içeriğe ulaşılamıyor. Biraz sonra yeniden deneyin.”

#### Neden bu ton en doğru?
- kullanıcıyı suçlamaz
- güven kaybını azaltır
- teknik ekibe ait detayı kullanıcıya yüklemez
- modern ve profesyonel deneyime uygundur

### 16.2 Admin dashboard’da ilk fazda görünür olacak operasyonel hata sinyalleri
İlk fazda admin dashboard’da hata sinyalleri **geniş ama kontrollü** bir set olarak görünmelidir.

#### Önerilen görünür sinyaller
1. **Başarısız mail gönderimi sayısı**
2. **Başarısız queue job sayısı**
3. **Son 24 saatte kritik hata sayısı**
4. **Anormal başarısız login denemesi özeti**
5. **Tekrar eden teklif gönderim hataları**
6. **Eksik veri / bozuk içerik uyarıları**
   - ana görseli olmayan ürün
   - aktif ama eksik teknik alanı olan ürün
   - görünür ama bozuk ilişkiye sahip kayıt
7. **Sistem ayarı / mail ayarı kaynaklı son hata uyarıları**
8. **Cache / queue / mail sağlık özeti**
9. **Uzun süredir cevaplanmamış teklif uyarıları**
10. **Arşiv / silme işlemlerinde son başarısızlıklar**

#### Nasıl gösterilmeli?
- hepsi ana dashboard’ı boğan kırmızı alarm listesi gibi olmamalı
- özet kart + uyarı paneli + gerektiğinde detay bağlantısı şeklinde sunulmalı
- kritik olanlar daha görünür, düşük öncelikliler daha sade gösterilmelidir

#### Neden bu yaklaşım doğru?
- sadece teknik hata değil, operasyonel kalite sorunu da görünür olur
- admin gerçekten aksiyon alabilir
- hata görünürlüğü ürün ve operasyon kalitesini artırır

### 16.3 Mail / queue başarısızlıklarında yeniden deneme aksiyonu
İlk fazda mail / queue başarısızlıkları için **manuel yeniden deneme aksiyonu** sunulmayacaktır.

#### Güncel karar
- başarısızlıklar loglanacaktır
- sistemde görünür hale getirilecektir
- admin bunları dashboard / ilgili alanlardan görebilecektir
- ancak ilk fazda ayrı bir “yeniden dene” operasyonu açılmayacaktır

#### Neden bu yaklaşım doğru?
- ilk faz operasyon karmaşıklığını azaltır
- yeniden deneme akışı için ek edge case yükü oluşturmaz
- buna rağmen hata görünürlüğü korunur

### 16.4 Harici hata izleme servisi kullanımı
Best practice açısından benim önerim:
- ilk fazda **yalnızca düz uygulama loglarıyla yetinmemek**
- buna ek olarak **harici bir hata izleme / exception takip servisi** de düşünmektir

#### Neden bu doğru?
- production hatalarını daha hızlı fark etmeyi sağlar
- stack trace ve bağlamı daha temiz takip etmeyi kolaylaştırır
- tekrarlayan hataları gruplayabilir
- kritik sorunların görünürlüğünü artırır

#### En doğru ilk faz yaklaşımı
- uygulama içi loglar temel kaynak olmaya devam eder
- kritik exception ve sistem hataları için harici izleme servisi entegre edilir
- bu servis güvenlik logunun yerine değil, hata görünürlüğü için ek katman olarak düşünülür

#### Sonuç
İlk faz için:
- **uygulama logları + harici hata izleme servisi** birlikte düşünülmelidir

### 16.5 Health check alanı
Health check yaklaşımı ilk fazda **admin içinde görünür bir modül / ekran** olarak yer alacaktır.

#### Neden görünür modül olmalı?
- operasyon ekibi sistem durumunu hızlı görebilir
- sorun çıktığında ilk teşhis kolaylaşır
- queue, mail, database, cache gibi temel sinyaller bir yerde toplanır
- sistem araçları alanına anlamlı içerik kazandırır

#### İlk faz için önerilen sağlık göstergeleri
- uygulama durumu
- veritabanı erişimi
- queue durumu
- mail altyapısı durumu
- cache durumu
- son kritik hata özeti

#### UX notu
Bu alan tam teknik debug ekranı gibi olmamalıdır.
İlk fazda:
- sade
- özet
- renk / durum rozetli
- gerektiğinde detay bağlantılı
bir operasyon ekranı gibi davranmalıdır.

---

## 17. Ön Sonuç

Bu aşamada hata yönetimi ve gözlemlenebilirlik omurgası şu prensiplere dayanır:
- hata yönetimi kullanıcı mesajı + sistem logu + operasyon görünürlüğü birlikte düşünülmeli
- kullanıcıya teknik detay değil, açıklayıcı ve yönlendirici geri bildirim verilmeli
- genel sistem hata dili sakin, profesyonel ve çözüm odaklı olmalı
- kritik akışlar log ve sinyallerle izlenebilir olmalı
- güvenlik ve performans olayları hata yönetimiyle ilişkili ele alınmalı
- admin dashboard’da hata sinyalleri geniş ama kontrollü görünür olmalı
- mail ve queue başarısızlıkları ilk fazda loglanmalı ve görünür olmalı, ancak yeniden deneme aksiyonu sonraya bırakılmalı
- uygulama loglarına ek olarak harici hata izleme servisi düşünülmeli
- health check alanı admin içinde görünür modül olarak yer almalı
- kuyruk, mail ve arka plan işleri iz bırakmalı
- uygulama bozulduğunda kontrollü fallback davranışı üretmelidir

Bu doküman, sonraki aşamada Laravel exception handling, log kanalları, queue failure yönetimi, health check yaklaşımı ve harici hata izleme entegrasyonlarının teknik seviyede netleştirilmesi için temel olacaktır.

