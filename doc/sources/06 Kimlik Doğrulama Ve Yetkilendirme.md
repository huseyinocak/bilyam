# Web Projesi — 06 Kimlik Doğrulama ve Yetkilendirme

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi, arayüz ve responsive kararlarından sonra, projenin kimlik doğrulama ve yetkilendirme yaklaşımını netleştirmek için hazırlanmıştır. Amaç; misafir kullanıcı, üye müşteri, admin ve süper admin gibi aktörlerin sisteme nasıl erişeceğini, hangi ekranları göreceğini, hangi işlemleri yapabileceğini ve hangi güvenlik sınırlarının uygulanacağını proje özelinde tanımlamaktır.

Bu bölüm, modern web uygulamalarında kayıt/giriş/çıkış, şifre sıfırlama, e-posta doğrulama, oturum yönetimi, rol bazlı erişim kontrolü ve admin-kullanıcı alanı ayrımının temel gereklilik olduğu ana çerçeveye dayanır. fileciteturn5file0 Ayrıca burada yer alan kararlar; teklif odaklı, üyeliğin opsiyonel ama faydalı olduğu ürün yapısı, 3 katmanlı bilgi mimarisi, UX kararları ve responsive panel yaklaşımı üzerine kurulacaktır. fileciteturn5file2 fileciteturn5file1 fileciteturn5file3 fileciteturn5file5

---

## 1. Kimlik Doğrulama Bu Projede Ne Anlama Geliyor?

Bu projede kimlik doğrulama tek tip bir kullanıcı giriş sistemi değildir. Çünkü sistem aynı anda şu yapıların hepsini desteklemektedir:
- misafir kullanıcı ile teklif bırakma
- müşteri üyeliği ile teklif geçmişi takibi
- admin panel erişimi
- rol ve yetki bazlı operasyon yönetimi

Bu nedenle auth yapısı şu dengeyi kurmalıdır:
- teklif dönüşümünü düşürmeyecek kadar esnek
- admin ve operasyon tarafını koruyacak kadar güvenli
- müşteri üyeliğine anlam katacak kadar işlevsel
- ileride genişlemeye açık kadar düzenli

---

## 2. Kullanıcı Tipleri

Bu proje için auth ve yetkilendirme yapısı en az 4 temel aktör üzerinden düşünülmelidir:

1. **Misafir Kullanıcı**
2. **Üye Müşteri**
3. **Admin / Operasyon Kullanıcısı**
4. **Süper Admin**

### 2.1 Misafir Kullanıcı
Misafir kullanıcı:
- public siteyi gezebilir
- ürün arayabilir
- ürün detayını görebilir
- teklif listesi oluşturabilir
- teklif talebi bırakabilir

Ancak:
- müşteri paneline erişemez
- teklif geçmişini panelden göremez
- sadece e-posta üzerinden dönüş alır

### 2.2 Üye Müşteri
Üye müşteri:
- public alanın tüm imkanlarını kullanabilir
- müşteri paneline erişebilir
- teklif geçmişini görebilir
- teklif detayını görebilir
- hızlı tekrar talep oluşturabilir
- profil ve şirket bilgisini düzenleyebilir

### 2.3 Admin / Operasyon Kullanıcısı
Admin / operasyon kullanıcısı:
- admin paneline erişebilir
- rolüne bağlı modülleri kullanabilir
- teklifleri inceleyebilir
- teklif durumu güncelleyebilir
- ürün ve içerik yönetimi yapabilir

### 2.4 Süper Admin
Süper admin:
- tüm admin modüllerine erişebilir
- rol ve izinleri yönetebilir
- sistem ayarlarını düzenleyebilir
- diğer admin kullanıcıları yönetebilir

---

## 3. Temel Auth Yaklaşımı

### 3.1 Misafir teklif akışı korunacak
Bu proje için en kritik karar zaten netleşmiştir:
- teklif vermek için üyelik zorunlu olmayacaktır

Bu karar ürün tarafında merkezi önemdedir. Çünkü teklif dönüşümünü artırır ve giriş bariyerini düşürür. fileciteturn5file2

### 3.2 Üyelik yine de ilk fazda olacaktır
Misafir teklif akışı açık kalırken müşteri üyeliği de ilk fazda yer alacaktır.

Bu yapı şu faydaları sağlar:
- kullanıcı tekrar geldiğinde teklif geçmişini görebilir
- hızlı tekrar talep kullanabilir
- hesap bazlı deneyim oluşur
- ileride favoriler, kayıtlı şirket verileri ve daha gelişmiş müşteri alanları açılabilir

### 3.3 En doğru ürün dengesi
Bu nedenle auth yaklaşımı şu cümleyle özetlenebilir:

**“Üyelik fayda sağlar ama teklif için kapı bekçisi olmaz.”**

---

## 4. Müşteri Auth Akışları

### 4.1 Kayıt Ol
İlk fazda müşteri kayıt ekranı bulunacaktır.

Temel alanlar:
- ad soyad
- e-posta
- telefon
- şifre
- firma adı (opsiyonel)
- KVKK / kullanım onayı

### 4.2 Giriş Yap
Müşteri giriş ekranı sade ve hızlı olmalıdır.

Temel davranış:
- e-posta + şifre ile giriş
- şifremi unuttum bağlantısı
- kayıt ol yönlendirmesi

### 4.3 Şifremi Unuttum
İlk faz için standart şifre sıfırlama akışı gereklidir.

### 4.4 E-posta Doğrulama
Bu karar da netleşmiştir:
- e-posta doğrulama zorunlu olacaktır
- ancak doğrulama tamamlanana kadar teklif verme engellenmeyecektir

Bu yaklaşım güvenlik ile dönüşüm arasında doğru denge kurar. fileciteturn5file2

### 4.5 Çıkış Yap
Hem müşteri paneli hem admin panelde güvenli çıkış akışı bulunmalıdır.

---

## 5. Müşteri Paneli Erişim Kuralları

Müşteri paneli yalnızca giriş yapan müşteri kullanıcıya açık olacaktır.

### Panelde erişilecek ana alanlar
- panel ana sayfa
- tekliflerim
- teklif detay
- hızlı tekrar talep
- profil bilgileri
- şirket bilgileri
- hesap ayarları

### Erişim mantığı
Bir müşteri yalnızca:
- kendi hesabına ait teklifleri görebilir
- kendi profil bilgilerini düzenleyebilir
- kendi panel alanına erişebilir

Başka müşterilerin verilerine erişim kesinlikle mümkün olmamalıdır.

---

## 6. Teklif ve Auth İlişkisi

Bu proje için teklif akışının auth ile ilişkisi özel olarak tanımlanmalıdır.

### 6.1 Misafir teklif
Misafir kullanıcı:
- teklif listesi oluşturabilir
- teklif formunu doldurabilir
- talebi gönderebilir

Teklif kaydında müşteri hesabı zorunlu olmayacaktır.

### 6.2 Üye teklif
Giriş yapmış kullanıcı:
- teklif bırakabilir
- bıraktığı teklif kendi hesap geçmişine bağlanır
- panelden takip edebilir

### 6.3 Veri modeli yaklaşımı
Bu karar daha önce ürün temeli tarafında netleşmiştir:
- teklif kaydında `customer_user_id` nullable olabilir
- misafir tekliflerde iletişim bilgileri kayıt üzerinde tutulur
- üye tekliflerde hesap ilişkisi kurulur
- gerekirse misafir geçmişi sonradan hesaba eşleştirilebilir

Bu model hem esnek hem ölçeklenebilir bir auth ilişkisi sağlar. fileciteturn5file2

---

## 7. Admin Auth Yaklaşımı

Admin tarafı müşteri auth’ından net biçimde ayrılmalıdır.

### 7.1 Ayrı alan
Admin panel ayrı erişim alanı olmalıdır:
- farklı route grubu
- farklı yetki koruması
- müşteri alanından ayrışan oturum mantığı

### 7.2 Admin giriş ekranı
Admin girişi:
- public / müşteri login akışından ayrılmalıdır
- daha sade ve güvenlik odaklı olmalıdır

### 7.3 Neden ayrı düşünülmeli?
Bu ayrım:
- güvenlik netliği sağlar
- yanlış erişim riskini azaltır
- yönetim panelinin kullanıcı alanından zihinsel olarak ayrılmasını sağlar
- operasyon tarafında profesyonel yapı kurar

---

## 8. Rol ve Yetki Modeli

İlk faz için karmaşık ama gereksiz bir RBAC sistemi değil, güçlü ama yönetilebilir bir rol modeli tercih edilmelidir.

### 8.1 Önerilen ilk faz rolleri
- **Super Admin**
- **Admin**
- **Operasyon**
- **İçerik Yöneticisi**
- **Müşteri**

### 8.2 Rol mantığı
#### Super Admin
- tüm modüller
- tüm ayarlar
- kullanıcı / rol yönetimi

#### Admin
- çoğu operasyon ve katalog modülü
- teklif yönetimi
- müşteri yönetimi
- içerik yönetimi
- sınırlı sistem ayarları

#### Operasyon
- teklif talepleri
- müşteri kayıtları
- teklif durumu güncelleme
- admin notları

#### İçerik Yöneticisi
- sayfa içerikleri
- vitrin alanları
- medya yönetimi
- e-posta şablonlarının uygun kısmı

#### Müşteri
- yalnızca kendi panel alanı

### 8.3 Yetki yapısı
Rol yapısına ek olarak işlem bazlı izinler desteklenmelidir.

Örnek izinler:
- products.view
- products.create
- products.update
- products.delete
- quotes.view
- quotes.reply
- users.manage
- settings.manage
- content.manage

Bu yapı ilk fazda tam abartılmadan ama ölçeklenebilir kurulmalıdır.

---

## 9. Yetki Sınırları ve Koruma İlkeleri

### 9.1 Public alan
Public alan anonime açıktır; ama sadece public içeriğe erişim vardır.

### 9.2 Customer alanı
Customer alanı auth gerektirir ve sahiplik kontrolü gerektirir.

### 9.3 Admin alanı
Admin alanı auth + rol + izin kontrolü gerektirir.

### 9.4 Kritik işlem korumaları
Özellikle şu işlemler ek koruma mantığıyla düşünülmelidir:
- admin kullanıcı oluşturma
- rol / izin değiştirme
- sistem ayarı güncelleme
- ürün silme
- teklif iptal / kapatma
- görünürlük / yayın durumlarını değiştirme

İlk fazda bunlar için en azından:
- yetki kontrolü
- onay modalı
- log kaydı
uygulanmalıdır.

---

## 10. Oturum ve Güvenlik Davranışları

### 10.1 Oturum yönetimi
İlk faz için düşünülmesi gerekenler:
- güvenli giriş / çıkış
- “beni hatırla” ihtiyacı dikkatli değerlendirilir
- uzun süre pasif kalınca oturum davranışı net olmalı

### 10.2 Şifre güvenliği
- güvenli hashleme
- minimum şifre kuralları
- sıfırlama akışı

### 10.3 Doğrulama ve log
- e-posta doğrulama durumu
- admin giriş logları
- kritik işlem logları

### 10.4 İki adımlı doğrulama
İlk faz için zorunlu değildir; ancak özellikle admin tarafı için ikinci faz adayı olarak düşünülmelidir.

---

## 11. Auth UX İlkeleri

Kimlik doğrulama ekranları güvenli olduğu kadar akıcı da olmalıdır.

### 11.1 Müşteri auth ekranları
- sade
- kısa
- güven veren
- anlaşılır hata mesajları içeren
- misafir akışıyla çatışmayan

### 11.2 Admin auth ekranı
- daha sade
- dikkat dağıtmayan
- güvenlik hissi veren
- public vitrinden ayrışan

### 11.3 Yönlendirme mantığı
- müşteri giriş sonrası customer panel ana sayfasına yönlenmeli
- admin giriş sonrası dashboard’a yönlenmeli
- misafir teklif sonrası uygun yerde üyelik avantajı sunulabilir ama zorlanmamalı

---

## 12. E-posta Doğrulama ve Bildirim İlişkisi

Bu projede auth ile e-posta akışları ilişkilidir.

### İlk fazda gerekli auth e-postaları
- kayıt / doğrulama e-postası
- şifre sıfırlama e-postası
- teklif alındı e-postası
- teklif cevabı e-postası

Bu nedenle auth yapısı e-posta altyapısıyla uyumlu kurulmalıdır. Bu ihtiyaç ürün temeli tarafında da netleşmiştir. fileciteturn5file2

---

## 13. Livewire ile Uyum Notu

UI ve etkileşim kararlarında Livewire’ın proje için güçlü bir aday olduğu değerlendirilmiştir. Auth ve yetkilendirme tarafında da bu katkı devam eder. fileciteturn5file4

Özellikle uygun alanlar:
- login / register formları
- e-posta doğrulama bilgilendirme ekranları
- şifre sıfırlama formları
- müşteri paneli hesap ayarları
- admin kullanıcı yönetimi ekranları
- rol / izin yönetimi etkileşimleri

Ancak auth ve yetki kararları framework bağımsız mantıkta tanımlanmalı; Livewire sadece uygulama katmanında kolaylaştırıcı olarak düşünülmelidir.

---

## 14. Netleşen Auth ve Yetki Kararları

### 14.1 Müşteri giriş yöntemi
İlk fazda müşteri girişinde **hem e-posta hem telefon numarası** kullanılabilecektir.

#### UX yaklaşımı
Giriş alanında kullanıcıyı yönlendiren tek alan mantığı önerilir:
- placeholder: **E-posta adresiniz veya telefon numaranız**

Bu yaklaşım:
- kullanıcıya esneklik verir
- tekrar girişte sürtünmeyi azaltır
- modern giriş deneyimine daha yakındır

### 14.2 “Beni hatırla” davranışı
İlk fazda **Beni hatırla** seçeneği açık olacaktır.

#### Neden doğru?
- müşteri paneline tekrar erişimi kolaylaştırır
- kullanıcıyı tekrar tekrar giriş zorunluluğundan kurtarır
- özellikle teklif geçmişi takibi yapan kullanıcı için pratiklik sağlar

### 14.3 Admin tarafında ek güvenlik katmanı
Best practice açısından benim önerim:
- ilk fazda **standart güçlü auth + ek temel güvenlik önlemleri** uygulanmalıdır
- ancak tam iki adımlı doğrulama zorunluluğu ilk faz için şart değildir

#### İlk faz için önerilen admin güvenlik seti
1. güçlü parola kuralları
2. ayrı admin giriş ekranı
3. rol ve yetki kontrolü
4. kritik işlemler için onay adımı
5. admin giriş ve kritik işlem logları
6. oturum güvenliği ve çıkış davranışının net olması

#### Neden bu yaklaşım en doğru?
- projeyi gereksiz ağırlaştırmaz
- güvenliği ciddiye alır
- ilk fazı geciktirmez
- ikinci fazda 2FA eklemeye uygun kalır

#### Sonuç
İlk faz için:
- **standart güçlü auth tek başına yeterli kabul edilmeyecek**
- ama **2FA zorunlu da yapılmayacak**
- bunun yerine güçlü temel güvenlik katmanı kurulacaktır

### 14.4 Rol modeli
İlk fazda rol modeli şu 5 rolle başlayacaktır:
- Super Admin
- Admin
- Operasyon
- İçerik Yöneticisi
- Müşteri

Bu yapı ilk faz için yeterince güçlü ve yönetilebilir kabul edilmiştir.

### 14.5 Misafir teklif sonrası hesap oluşturma önerisi
Bu konuda en doğru modern yaklaşım, kullanıcıyı teklif öncesinde zorlamadan, teklif sonrası doğru anlarda hesap avantajını sunmaktır.

#### Zorunlu gösterim noktası
Misafir teklif sonrası kullanıcıya gönderilen **bilgilendirme e-postasında** hesap oluşturma önerisi yer alacaktır.

#### Bunun dışında önerilen en doğru gösterim noktaları
**1. Teklif gönderim başarı ekranı / onay ekranı**
Kullanıcı teklif formunu gönderdikten sonra gösterilen başarı ekranında:
- teklifiniz alındı mesajı
- e-posta bilgilendirmesi notu
- hesap oluşturmanın avantajlarını anlatan kısa blok
- net CTA: **Hesap Oluştur ve Tekliflerini Takip Et**

Bu, en güçlü ve en doğal noktadır.

**2. Teklif cevap e-postası içinde ikincil öneri**
Kullanıcı misafir olarak kaldıysa, teklif cevap e-postasında da hafif bir üyelik önerisi bulunabilir.
Ama ana odak yine teklif bilgisi olmalıdır; üyelik çağrısı baskın olmamalıdır.

**3. Public login/register alanlarında “misafir teklifin var mı?” desteği**
İleriye açık yapı olarak, giriş / kayıt ekranında misafir teklifini hesabına bağlamaya yönelik yardımcı metin düşünülebilir. Bu ilk fazda zorunlu değildir; ama sistem dili buna kapalı olmamalıdır.

#### Neden bu noktalar en doğru?
- kullanıcıyı teklif öncesinde yormaz
- teklif gönderme motivasyonunu bozmaz
- teklif sonrası en yüksek ilgiyi yakalar
- üyeliği gerçek faydayla ilişkilendirir

#### Kaçınılması gerekenler
- teklif öncesi agresif üyelik pop-up’ı
- teklif listesini tamamlamadan üyeliğe zorlayan akış
- başarı ekranını reklam alanına çeviren aşırı üyelik baskısı

---

## 15. Ön Sonuç

Bu aşamada önerilen auth ve yetkilendirme omurgası şu prensiplere dayanır:
- teklif için üyelik zorunlu olmamalı
- müşteri üyeliği yine de ilk fazda yer almalı
- müşteri ve admin auth alanları net ayrılmalı
- rol ve izin yapısı güçlü ama yönetilebilir kurulmalı
- müşteri sadece kendi verisine erişebilmeli
- admin işlemleri rol ve yetki ile sınırlandırılmalı
- e-posta doğrulama zorunlu olmalı ama dönüşümü öldürmemeli
- müşteri girişinde e-posta veya telefon esnekliği sunulmalı
- “beni hatırla” ilk fazda desteklenmeli
- admin tarafında güçlü temel güvenlik katmanı kurulmalı
- misafir kullanıcıya üyelik önerisi teklif sonrası doğru anlarda sunulmalı
- güvenlik ile kullanım kolaylığı dengede tutulmalı

Bu doküman, sonraki aşamada Laravel auth mimarisi, rol/izin tabloları, middleware yapısı ve kullanıcı akışlarının teknik seviyede netleştirilmesi için temel olacaktır.

