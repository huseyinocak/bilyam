# Web Projesi — 09 Güvenlik

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi, arayüz, responsive yapı, kimlik doğrulama, veri yönetimi ve performans kararlarından sonra, projenin güvenlik yaklaşımını netleştirmek için hazırlanmıştır. Amaç; public site, müşteri paneli ve admin panelinde veri, erişim, işlem ve iletişim güvenliğini proje özelinde tanımlamaktır.

Bu bölüm, modern web uygulamalarında güvenliğin sonradan eklenen bir katman değil, mimarinin başından itibaren sistemin parçası olması gerektiği anlayışına dayanır. Web Projesi ana çerçevesinde güvenlik; input validation, CSRF, XSS, SQL injection koruması, rate limiting, güvenli parola saklama, hassas verilerin korunması, dosya yükleme güvenliği, yetki açıklarının önlenmesi ve güvenli loglamayı kapsayan temel bir başlık olarak tanımlanmıştır. fileciteturn8file0 Ayrıca bu doküman; teklif odaklı ürün yapısı, 3 katmanlı bilgi mimarisi, UX/UI kararları, responsive davranışlar, auth omurgası, veri yönetimi kuralları ve performans yaklaşımı üzerine kurulacaktır. fileciteturn8file2 fileciteturn8file1 fileciteturn8file3 fileciteturn8file4 fileciteturn8file5 fileciteturn8file6 fileciteturn8file7 fileciteturn8file8

---

## 1. Güvenlik Bu Projede Ne Anlama Geliyor?

Bu projede güvenlik yalnızca şifreleri korumak anlamına gelmez. Güvenlik şu alanların tamamında düşünülmelidir:
- public teklif akışının kötüye kullanımını önlemek
- müşteri verisini korumak
- admin paneli yetkisiz erişime kapatmak
- rol ve izin açıklarını önlemek
- yüklenen dosyaları güvenli yönetmek
- e-posta ve log süreçlerinde hassas bilgiyi sızdırmamak
- veri bütünlüğünü bozan işlem akışlarını engellemek

Bu projede güvenliğin temel amacı:
**kullanıcı deneyimini gereksiz zorlaştırmadan, veri ve işlem güvenliğini baştan güçlü kurmaktır.**

---

## 2. Güvenlik Katmanları

Bu proje için güvenlik 6 ana katmanda düşünülmelidir:

1. **Uygulama Giriş ve Form Güvenliği**
2. **Kimlik Doğrulama ve Oturum Güvenliği**
3. **Yetkilendirme ve Erişim Güvenliği**
4. **Veri ve Dosya Güvenliği**
5. **Operasyonel Güvenlik ve Loglama**
6. **İletişim ve Bildirim Güvenliği**

---

## 3. Public Alan Güvenliği

Public alan anonime açık olsa da tamamen kontrolsüz olmamalıdır.

### 3.1 Public form güvenliği
Özellikle teklif formu ve benzeri alanlarda:
- zorunlu alan validasyonu
- tip / format kontrolü
- uzunluk sınırları
- spam ve kötüye kullanım koruması
- rate limiting
uygulanmalıdır.

### 3.2 Teklif akışı kötüye kullanım önlemleri
Misafir teklif akışı proje için stratejik olarak açık bırakılmıştır. Bu karar ürün temelinde netleşmiştir. fileciteturn8file2 Bu nedenle güvenlikte ek denge gerekir:
- aynı kaynaktan aşırı talep gönderimini sınırlamak
- çok kısa sürede tekrar eden istekleri kontrol etmek
- anormal davranışları loglamak
- gerekiyorsa görünmez bot/spam önlemleri kullanmak

### 3.3 Arama ve filtre alanları
Public arama, filtre ve katalog sorguları da kötüye kullanıma açık olabilir.
Bu yüzden:
- sorgu parametreleri doğrulanmalı
- limitler uygulanmalı
- ağır filtre kombinasyonları kontrollü ele alınmalı

---

## 4. Müşteri Hesabı Güvenliği

### 4.1 Giriş güvenliği
Müşteri girişinde hem e-posta hem telefon esnekliği tanımlanmıştır. Bu karar auth dokümanında netleşmiştir. fileciteturn8file6 Bu yüzden:
- giriş alanı tip güvenliği taşımalı
- brute force riskine karşı rate limiting uygulanmalı
- başarısız giriş denemeleri kontrollü izlenmelidir

### 4.2 Parola güvenliği
- güvenli hashleme kullanılmalı
- minimum parola kuralları olmalı
- sıfırlama tokenları güvenli ve süre sınırlı olmalı
- parolalar asla log veya e-posta içinde açık tutulmamalıdır

### 4.3 E-posta doğrulama
E-posta doğrulama zorunlu, ama teklif akışını engellemeyecek şekilde tasarlanmıştır. fileciteturn8file6 Bu yüzden:
- doğrulama tokenları güvenli olmalı
- tekrar gönderim suistimal edilmemeli
- doğrulanmamış hesapların yetkileri net sınırlandırılmalıdır

### 4.4 Hesap sahipliği
Bir müşteri yalnızca kendi tekliflerini ve profilini görebilmelidir. Bu sahiplik kontrolü bilgi mimarisi ve auth tarafında netleşmiştir. fileciteturn8file1turn8file6 Güvenlik açısından:
- route seviyesinde koruma
- kaynak seviyesinde sahiplik kontrolü
- ID tahminiyle erişim riskine karşı koruma
uygulanmalıdır.

---

## 5. Admin Panel Güvenliği

Admin alanı müşteri alanından net ayrılmalıdır. Bu karar auth tarafında netleşmiştir. fileciteturn8file6

### 5.1 Ayrı admin giriş alanı
- ayrı route grubu
- ayrı guard / koruma mantığı
- public giriş ekranından ayrışan admin login deneyimi

### 5.2 Güçlü temel güvenlik katmanı
İlk faz için en doğru yaklaşım auth dokümanında şöyle netleşmiştir:
- standart güçlü auth tek başına yeterli kabul edilmeyecek
- ama 2FA ilk fazda zorunlu olmayacak
- bunun yerine güçlü temel güvenlik katmanı kurulacaktır. fileciteturn8file6

Bu kapsamda:
- güçlü parola kuralları
- admin giriş logları
- kritik işlem logları
- rol ve izin kontrolü
- onay gerektiren kritik işlemler
uygulanmalıdır.

### 5.3 Admin işlem korumaları
Özellikle şu işlemler daha sıkı korunmalıdır:
- admin kullanıcı oluşturma
- rol / izin değiştirme
- sistem ayarı güncelleme
- ürün arşive gönderme
- arşivden hard delete
- e-posta şablonu değiştirme
- görünürlük ayarlarını değiştirme

Bu işlemler için ilk fazda minimum güvenlik seti:
- yetki kontrolü
- onay modalı
- audit/log kaydı

---

## 6. Yetkilendirme Güvenliği

Rol ve izin yapısı 5 rolle başlayacak şekilde netleşmiştir: Super Admin, Admin, Operasyon, İçerik Yöneticisi ve Müşteri. fileciteturn8file6

### 6.1 Rol bazlı güvenlik
- rol yalnızca menü görünürlüğü değil, işlem yetkisini de belirlemelidir
- gizlenen buton güvenlik sayılmamalıdır
- backend seviyesinde izin kontrolü zorunlu olmalıdır

### 6.2 İşlem bazlı izinler
Özellikle:
- products.create/update/delete
- quotes.reply
- settings.manage
- users.manage
- content.manage

gibi izinler backend düzeyinde doğrulanmalıdır.

### 6.3 Sahiplik ve kaynak kontrolü
Müşteri tarafında sahiplik, admin tarafında rol/izin, public tarafta ise erişim seviyesi açıkça ayrılmalıdır.

---

## 7. Girdi Güvenliği ve Uygulama Savunmaları

### 7.1 Input validation
Tüm girişler güvenilmez kabul edilmelidir.
Bu nedenle:
- istek verileri sunucu tarafında doğrulanmalı
- alan türleri, uzunluklar, zorunluluklar kontrol edilmeli
- beklenmeyen alanlar ve payload’lar sınırlanmalıdır

### 7.2 XSS koruması
Özellikle şu alanlarda dikkat gerekir:
- ürün açıklamaları
- sabit sayfa içerikleri
- mail şablonları
- admin notları
- müşteri notları

Kural:
- çıktı güvenli render edilmelidir
- HTML desteklenen alanlar çok kontrollü olmalıdır
- rich text alanlarında sanitization düşünülmelidir

### 7.3 SQL injection koruması
- framework’ün güvenli sorgu imkanları kullanılmalı
- raw query kullanımı dikkatle sınırlandırılmalı
- filtre ve sıralama alanlarında whitelist mantığı düşünülmelidir

### 7.4 CSRF koruması
Form tabanlı Laravel uygulamasında CSRF koruması temel güvenlik katmanı olarak aktif olmalıdır.

### 7.5 Rate limiting
Aşağıdaki alanlarda rate limiting düşünülmelidir:
- login
- şifre sıfırlama
- e-posta doğrulama tekrar gönderimi
- teklif formu gönderimi
- kritik public arama uçları gerekiyorsa

---

## 8. Dosya ve Medya Güvenliği

Bu proje çoklu ürün görselleri ve medya yönetimi içerdiği için dosya güvenliği önemlidir. Ürünlerde çoklu görsel yapısı ve ana görsel seçimi ilk fazda netleşmiştir. fileciteturn8file2turn8file7

### 8.1 Dosya yükleme kuralları
- izin verilen dosya tipleri whitelist ile sınırlandırılmalı
- MIME ve uzantı kontrolü birlikte düşünülmeli
- dosya boyutu limiti olmalı
- tehlikeli dosya türleri engellenmeli

### 8.2 Dosya adı ve saklama
- kullanıcıdan gelen ham dosya adıyla doğrudan depolama yapılmamalı
- benzersiz güvenli dosya adı üretilmeli
- depolama yolu kontrollü olmalıdır

### 8.3 Görsel işleme
Performans dokümanında görseller için optimize ve gerekiyorsa yeniden boyutlandırma yaklaşımı netleşmiştir. fileciteturn8file8 Güvenlik açısından da:
- yüklenen görseller işlenmeden public erişime açılmamalı
- metadata ve boyut kontrolleri yapılmalıdır

---

## 9. Veri Güvenliği ve Gizlilik

### 9.1 Hassas veriler
Bu projede hassas sayılabilecek veriler:
- müşteri iletişim bilgileri
- teklif detayları
- admin notları
- auth verileri
- e-posta logları

### 9.2 Veri minimizasyonu
İlk faz için gerekmeyen hassas veri toplanmamalıdır.
Bu prensip hem güvenlik hem uyumluluk için önemlidir.

### 9.3 Loglarda veri sızıntısı önleme
- parola asla loglanmamalı
- tokenlar loglarda açık görünmemeli
- hassas içerik gerekiyorsa maskelenmelidir
- mail hata logları içinde gereksiz veri sızmamalıdır

### 9.4 Misafir teklif ile hesap eşleşmesi
Misafir tekliflerin sonradan hesapla otomatik eşleşmesi veri yönetimi tarafında netleşmiştir. fileciteturn8file7 Güvenlik açısından bu süreçte:
- eşleşme kriteri kontrollü olmalı
- birincil kriter e-posta olmalı
- çakışmalı durumlar loglanmalı
- yanlış eşleşme riski azaltılmalıdır

---

## 10. İşlem Güvenliği ve Kritik Aksiyonlar

Veri yönetimi tarafında ürün yaşam döngüsü aktif, pasif, arşivlenmiş ve kalıcı silinmiş olarak düşünülmüştür. Hard delete yalnızca arşiv alanından yapılabilecektir. Bu karar veri dokümanında netleşmiştir. fileciteturn8file7 Güvenlik açısından bu çok değerlidir.

### 10.1 Kritik aksiyonlar için koruma
Aşağıdaki işlemler doğrulama/onay gerektirmelidir:
- ürünü pasife alma
- ürünü arşive gönderme
- arşivden kalıcı silme
- teklif durumunu iptal etme
- görünürlük ayarlarını değiştirme
- kullanıcı rolü değiştirme
- sistem ayarı güncelleme

### 10.2 Neden?
- yanlış tıklama riskini azaltır
- operasyonel güvenlik sağlar
- audit takibini kolaylaştırır

---

## 11. E-posta ve Bildirim Güvenliği

Bu projede teklif alındı ve teklif cevabı e-postaları temel akışın parçasıdır. fileciteturn8file2turn8file6 Bu yüzden:
- e-posta şablonları kontrollü yönetilmeli
- şablonlarda güvenli içerik kullanımı sağlanmalı
- kullanıcıya gereksiz hassas veri mail ile gönderilmemeli
- mail logları maskeleme ve hata kontrolüyle tutulmalıdır

### 11.1 Hesap oluşturma önerisi güvenliği
Misafir teklif sonrası başarı ekranı ve e-postada üyelik önerisi sunulacaktır. fileciteturn8file6 Bu akışta:
- öneri manipülatif olmamalı
- yanlış hesap bağlama riski üretmemeli
- doğrulama ve hesap eşleştirme kontrollü ilerlemelidir

---

## 12. Loglama, Audit ve Güvenlik İzleri

Veri dokümanında kritik işlemler için log ve audit ihtiyacı netleşmiştir. fileciteturn8file7 Güvenlik tarafında ilk faz için minimum iz seviyesi şu olmalıdır:
- admin giriş logları
- başarısız kritik erişim denemeleri
- rol / izin değişiklikleri
- ürün arşivleme / silme işlemleri
- teklif durum değişimleri
- sistem ayarı değişiklikleri
- e-posta şablonu değişiklikleri

### Neden önemli?
- olay analizi
- güvenlik incelemesi
- operasyon sorumluluğu
- hata ve istismar tespiti

---

## 13. Güvenlik ve Performans Dengesi

Güvenlik performansı öldürmemeli; performans da güvenliği zayıflatmamalıdır.

Bu proje için doğru denge:
- güçlü backend validasyonu
- seçici rate limiting
- kontrollü loglama
- queue ile mail/bildirim işlerinin ana akışı yavaşlatmaması
- gereksiz ağır güvenlik katmanlarıyla ilk fazı kilitlememek

Bu yaklaşım performans dokümanındaki “algılanan hız” önceliğiyle de uyumludur. fileciteturn8file8

---

## 14. Livewire ve Güvenlik Notu

Bu proje için Livewire güçlü aday olarak değerlendirilmiştir. UI ve performans dokümanlarında bu karar netleşmiştir. fileciteturn8file4turn8file8 Güvenlik açısından bu şu anlama gelir:
- Livewire bileşenleri de backend güvenlik kurallarına tabi olmalıdır
- yalnızca UI’da buton gizlemek yeterli değildir
- her action server-side yetki ve validasyon kontrolünden geçmelidir
- state manipülasyonuna karşı domain kuralları backend’de korunmalıdır

---

## 15. Netleşen Güvenlik Kararları

### 15.1 Public teklif formunda spam / bot koruması
İlk faz için en doğru yaklaşım, **çok katmanlı ama kullanıcıyı yormayan hafif koruma seti** kullanmaktır.

#### Önerilen güvenlik seti
1. sunucu tarafı güçlü validasyon
2. rate limiting
3. görünmez bot / spam koruması
4. honeypot benzeri pasif alan yaklaşımı
5. anormal davranış loglama

#### Neden bu yaklaşım en doğru?
- kullanıcıya agresif captcha baskısı yaratmaz
- misafir teklif akışını bozmaz
- bot ve spam riskine karşı ilk faz için yeterli koruma sağlar
- ileride gerektiğinde daha ağır katman eklemeye açıktır

#### Sonuç
İlk fazda doğrudan rahatsız edici klasik captcha ile başlamaktansa:
- görünmez / düşük sürtünmeli koruma
- rate limit
- honeypot
kombinasyonu daha doğru olacaktır.

### 15.2 Admin panelde IP / cihaz bazlı ekstra koruma
Best practice açısından ilk faz için önerim:
- **IP kısıtı veya cihaz whitelist zorunlu yapılmamalıdır**
- ancak admin girişleri ve kritik davranışlar detaylı loglanmalıdır

#### Neden?
- ilk faz operasyon esnekliğini gereksiz kısıtlamaz
- değişken çalışma ortamlarında admin erişimini zorlaştırmaz
- buna rağmen log ve anomali takibi ile güvenlik seviyesi korunur

#### İlk faz için daha doğru güvenlik yaklaşımı
- ayrı admin giriş alanı
- güçlü parola kuralları
- rate limiting
- oturum güvenliği
- giriş ve kritik işlem logları
- gerektiğinde ikinci fazda IP/cipher/device güvenliğine açılan zemin

#### Sonuç
İlk fazda **IP/cihaz bazlı zorunlu kısıt yok**; ama güçlü temel güvenlik + log izleme var.

### 15.3 Dosya yükleme formatı ve maksimum boyut
İlk faz için dosya yükleme güvenliğinde kontrollü ve sade bir set ile başlanmalıdır.

#### Önerilen başlangıç formatları
- **jpg / jpeg**
- **png**
- **webp**

#### Neden bu set doğru?
- ürün görselleri için yeterlidir
- güvenlik ve işleme akışı daha öngörülebilir olur
- SVG gibi riskli veya daha dikkat isteyen formatlarla ilk fazda karmaşıklık artmaz

#### Maksimum dosya boyutu önerisi
- tekil dosya için başlangıç limiti: **5 MB**

#### Neden 5 MB?
- ürün görselleri için çoğu durumda yeterlidir
- aşırı büyük dosyaların performans ve depolama yükünü sınırlar
- kullanıcı tarafında da makul bir deneyim sunar

#### Ek güvenlik kuralları
- MIME + uzantı birlikte kontrol edilmeli
- dosya adı güvenli biçimde yeniden üretilmeli
- görsel işleme / yeniden boyutlandırma hattından geçmeden public kullanıma açılmamalı

### 15.4 Kalıcı silme işlemlerinde ek güvenlik adımı
Evet, kalıcı silme işlemleri için **ek güvenlik adımı** olmalıdır.

#### En doğru ilk faz yaklaşımı
Arşiv alanından hard delete yapılırken şu set önerilir:
1. yetki kontrolü
2. açık onay modalı
3. ikinci doğrulama metni / onay ifadesi
4. audit log kaydı

#### Önerilen UX davranışı
Kullanıcıdan örneğin:
- “SİL” yazması
- veya kayıt adını / ürün kodunu onaylaması

istenebilir.

#### Neden bu doğru?
- yanlışlıkla kalıcı silmeyi ciddi biçimde azaltır
- silme işlemini bilinçli eyleme dönüştürür
- ilk faz için yeterince güvenlidir
- 2FA kadar ağır değildir ama çok daha güçlü koruma sağlar

### 15.5 Güvenlik loglarının ayrıntı seviyesi
İlk faz için en doğru yaklaşım, **kritik işlemler için orta-yüksek detaylı güvenlik loglaması** yapmaktır.

#### Neleri loglamalıyız?
- admin girişleri
- başarısız admin giriş denemeleri
- rol / izin değişiklikleri
- sistem ayarı değişiklikleri
- ürün arşivleme ve hard delete işlemleri
- teklif durum değişiklikleri
- e-posta şablonu değişiklikleri
- hassas görünürlük ayarı değişiklikleri

#### Log detay seviyesi
İlk faz için şu bilgiler çoğu kritik olayda tutulmalıdır:
- actor_user_id
- actor_role
- action
- subject_type
- subject_id
- timestamp
- ip_address
- mümkünse user_agent özeti
- gerekli durumlarda sınırlı meta bilgisi

#### Neleri loglamamalıyız?
- parola
- açık token
- gereksiz hassas kişisel veri
- maskelenmeden tam gizli alanlar

#### Neden bu seviye doğru?
- güvenlik incelemesi için yeterlidir
- aşırı log maliyetine girmez
- ilk faz için audit ihtiyacını karşılar
- olay analizi ve operasyon sorumluluğu için güçlü temel sağlar

---

## 16. Ön Sonuç

Bu aşamada güvenlik omurgası şu prensiplere dayanır:
- güvenlik sistemin başından tasarımın parçası olmalı
- public akışlarda kötüye kullanım koruması düşünülmeli
- müşteri ve admin alanları net ayrılmalı
- rol/izin kontrolleri backend düzeyinde uygulanmalı
- dosya ve medya yüklemeleri kontrollü olmalı
- hassas veri ve loglar dikkatli yönetilmeli
- kritik aksiyonlar onay ve audit ile korunmalı
- spam koruması kullanıcıyı yormayan çok katmanlı hafif modelle başlamalı
- admin güvenliğinde ilk fazda güçlü temel koruma ve log izleme tercih edilmeli
- kalıcı silme işlemleri ek doğrulama adımıyla korunmalı
- güvenlik logları kritik olaylar için orta-yüksek detayda tutulmalı
- güvenlik ile kullanıcı deneyimi dengede tutulmalı

Bu doküman, sonraki aşamada Laravel middleware yapısı, güvenlik kontrolleri, rate limiting kuralları, upload güvenliği ve audit/log güvenliğinin teknik seviyede netleştirilmesi için temel olacaktır.

