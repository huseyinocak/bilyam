# Web Projesi — 01 Modern Web Uygulaması Temelleri

Bu doküman, proje detaylarına girmeden önce modern bir web uygulamasında bulunması gereken temel yapı taşlarını tespit etmek için hazırlanmıştır. Amaç; sonraki teknik kararların, modül planlarının ve görev dökümanlarının üzerine oturacağı sağlam bir çerçeve oluşturmaktır.

---

## 1. Ürün Temeli

Modern bir web uygulaması sadece çalışan sayfalardan ibaret değildir. İyi bir ürün; kullanıcı ihtiyacını çözen, güven veren, sürdürülebilir ve ölçülebilir bir sistemdir.

Temel ürün bileşenleri:

- Net problem tanımı
- Hedef kullanıcı kitlesi
- Ana kullanım senaryoları
- Açık değer önerisi
- Ölçülebilir başarı kriterleri

Bu nedenle geliştirmeye başlamadan önce şu soruların cevabı net olmalıdır:

- Uygulama hangi problemi çözüyor?
- Kimler kullanacak?
- Kullanıcı neden bunu tercih edecek?
- İlk sürümde hangi kritik işleri yapabilmeli?
- Başarı neye göre ölçülecek?

---

## 2. Bilgi Mimarisi ve Modüler Yapı

Modern web uygulamalarında içerik ve işlevler rastgele büyütülmemelidir. Sistem modüllere ayrılmalı ve her modülün sorumluluğu net olmalıdır.

Olması gerekenler:

- Sayfa ve modül hiyerarşisi
- Navigasyon yapısı
- Yetkiye göre görünür alanlar
- Tekrar kullanılabilir bileşen mantığı
- Genişlemeye uygun modüler mimari

Örnek ana modül alanları:

- Kimlik doğrulama ve hesap yönetimi
- Dashboard / ana panel
- İçerik veya veri yönetimi
- Raporlama ve analiz
- Ayarlar ve yönetim alanı
- Bildirim / mesajlaşma / destek alanı

---

## 3. Kullanıcı Deneyimi (UX)

Modern uygulamanın güçlü tarafı yalnızca teknik altyapısı değil, kullanıcı akışlarının sürtünmesiz olmasıdır.

Bulunması gereken UX prensipleri:

- İlk girişte anlaşılır yapı
- Düşük öğrenme eğrisi
- Tutarlı ekran davranışları
- Hızlı geri bildirim
- Boş durumların düzgün ele alınması
- Hata durumlarında yönlendirici mesajlar
- Mobil ve masaüstünde doğal kullanım
- Formlarda kolay veri girişi

İyi UX için dikkat edilmesi gerekenler:

- Kullanıcı bir işlemin sonucunu beklerken sistem durum göstermeli
- Kaydetme, silme, güncelleme gibi işlemlerde açık geri bildirim verilmeli
- Kritik aksiyonlar yanlışlıkla tetiklenmemeli
- Gereksiz tıklama ve adım sayısı azaltılmalı

---

## 4. Arayüz (UI) ve Tasarım Sistemi

Modern web uygulamalarında görsel kalite; güven, kullanılabilirlik ve marka algısı oluşturur. Arayüz estetik olmanın yanında tutarlı olmalıdır.

Bulunması gerekenler:

- Renk sistemi
- Tipografi sistemi
- Boşluk ve grid sistemi
- Buton, input, select, modal, tablo, kart gibi ortak bileşenler
- Durum stilleri (hover, focus, disabled, error, success)
- Dark/light mode ihtiyacı değerlendirmesi
- Responsive tasarım yaklaşımı

Tasarım sisteminin hedefi:

- Her ekranı sıfırdan tasarlamamak
- Tutarlılık sağlamak
- Geliştirmeyi hızlandırmak
- Bakımı kolaylaştırmak

---

## 5. Responsive ve Cihaz Uyumu

Modern web uygulaması farklı ekran boyutlarında çalışmalıdır. Responsive yapı artık opsiyon değil, temel gerekliliktir.

Desteklenmesi gereken başlıklar:

- Mobil görünüm
- Tablet görünüm
- Dizüstü / masaüstü görünüm
- Büyük ekranlar
- Farklı tarayıcı uyumu

Kontrol edilmesi gerekenler:

- Menü davranışı
- Tablo taşmaları
- Formların mobil kullanılabilirliği
- Dokunmatik kullanım kolaylığı
- Görsel ve metin hiyerarşisinin korunması

---

## 6. Kimlik Doğrulama ve Yetkilendirme

Neredeyse tüm modern uygulamalarda kullanıcı, rol ve izin yönetimi gerekir.

Temel ihtiyaçlar:

- Kayıt / giriş / çıkış
- Şifre sıfırlama
- E-posta doğrulama
- Oturum yönetimi
- Rol bazlı erişim kontrolü
- Yetki bazlı işlem kısıtları
- Admin ve kullanıcı alanlarının ayrımı
- Gerekirse iki adımlı doğrulama

Düşünülmesi gerekenler:

- Hangi kullanıcı tipleri olacak?
- Hangi rol hangi ekranı görecek?
- Hangi işlem için ek yetki gerekecek?

---

## 7. Veri Yönetimi ve İş Kuralları

Modern bir uygulama sadece veri kaydetmez; veriyi doğrular, işler, ilişkilendirir ve iş kurallarına göre yönetir.

Bulunması gerekenler:

- Veritabanı tasarımı
- Entity ilişkileri
- Veri doğrulama kuralları
- İş kurallarının merkezi yönetimi
- Soft delete / audit ihtiyacı
- Loglama
- Veri bütünlüğü
- Hatalı veri girişine karşı koruma

Dikkat edilmesi gerekenler:

- Her tablo neden var sorusunun cevabı net olmalı
- Alan isimlendirmeleri tutarlı olmalı
- Gelecekte raporlanabilirlik düşünülmeli
- Gereksiz karmaşıklık ilk sürüme yüklenmemeli

---

## 8. Performans

Kullanıcılar yavaş uygulamaları affetmez. Modern uygulama performans odaklı olmalıdır.

Temel başlıklar:

- Hızlı sayfa yüklenmesi
- Verimli sorgular
- Gereksiz veri çekiminin önlenmesi
- Lazy loading / pagination
- Cache stratejileri
- Asset optimizasyonu
- Görsel optimizasyonu
- Kuyruk yapıları gereken yerlerde kullanımı

Özellikle önemli noktalar:

- Büyük listelerde filtreleme ve sayfalama
- N+1 query problemlerinin önlenmesi
- Dashboard gibi yoğun ekranlarda veri yükünün kontrolü

---

## 9. Güvenlik

Modern web uygulamasında güvenlik, sonradan eklenecek bir katman değil; en baştan tasarımın parçası olmalıdır.

Olması gereken güvenlik başlıkları:

- Input validation
- CSRF koruması
- XSS koruması
- SQL injection koruması
- Rate limiting
- Şifrelerin güvenli saklanması
- Hassas verilerin korunması
- Dosya yükleme güvenliği
- Yetki açıklarının önlenmesi
- Güvenli loglama

İleri seviye ihtiyaçlar:

- Activity logs
- Audit trail
- IP / cihaz takibi
- Şüpheli işlem uyarıları

---

## 10. Hata Yönetimi ve Gözlemlenebilirlik

Modern uygulama sadece çalışırken değil, bozulduğunda da kontrollü davranmalıdır.

Bulunması gerekenler:

- Kullanıcı dostu hata mesajları
- Sistem logları
- Exception yönetimi
- Kritik hata bildirim mekanizması
- İşlem geçmişi takibi
- Uygulama sağlık kontrolü mantığı

Amaç:

- Sorunları hızlı tespit etmek
- Kullanıcıyı belirsizlikte bırakmamak
- Geliştirici için hata ayıklamayı kolaylaştırmak

---

## 11. Arama, Filtreleme ve Listeleme Deneyimi

Birçok modern web uygulamasında veri yönetimi merkezî rol oynar. Bu yüzden liste ekranları güçlü olmalıdır.

Olması gerekenler:

- Arama
- Filtreleme
- Sıralama
- Sayfalama
- Toplu işlem desteği
- Dışa aktarma ihtiyacı değerlendirmesi
- Kolon görünürlüğü / tablo kullanım kolaylığı

İyi liste ekranı kriterleri:

- Kullanıcı veriye hızlı ulaşmalı
- Yoğun veride ekran boğulmamalı
- Filtreler anlamlı ve yönetilebilir olmalı

---

## 12. Bildirimler ve Kullanıcı Geri Bildirimi

Kullanıcı sistemde ne olduğunu her zaman anlayabilmelidir.

Bulunması gerekenler:

- Toast / alert mesajları
- Başarılı işlem bildirimleri
- Hata bildirimleri
- Uyarı ve onay diyalogları
- Gerekirse e-posta bildirimleri
- Gerekirse uygulama içi bildirim merkezi

---

## 13. Yönetim Paneli ve Operasyonel Kontrol

Birçok web uygulamasında, son kullanıcı arayüzü kadar önemli olan bir alan da yönetim tarafıdır.

Yönetim panelinde düşünülecek başlıklar:

- Kullanıcı yönetimi
- Rol / izin yönetimi
- İçerik / veri moderasyonu
- Sistem ayarları
- Raporlama
- Destek / talepler yönetimi
- Log ve hareket geçmişi

---

## 14. Entegrasyon ve Genişleyebilirlik

Modern uygulamalar çoğu zaman tek başına yaşamaz; başka servislerle konuşur.

Düşünülmesi gerekenler:

- E-posta servisi
- SMS / doğrulama servisleri
- Ödeme sistemleri
- Harita / konum servisleri
- Dosya saklama servisleri
- Harici API entegrasyonları
- Webhook altyapısı

Genişleyebilirlik için:

- Sıkı bağlı yapıdan kaçınılmalı
- Servis katmanları net kurulmalı
- Entegrasyon noktaları soyutlanmalı

---

## 15. SEO ve Görünürlük (Gerekliyse)

Her projede şart değildir; ancak herkese açık sayfalar varsa önemlidir.

Düşünülmesi gerekenler:

- SEO uyumlu sayfa yapısı
- Meta title / description
- Open Graph alanları
- Sitemap
- Performans ve Core Web Vitals
- Semantik HTML

Not: Admin paneli veya kapalı sistemlerde SEO öncelikli olmayabilir.

---

## 16. Erişilebilirlik (Accessibility)

Modern ürün kalitesinin önemli bir parçası erişilebilirliktir.

Temel gereklilikler:

- Klavye ile kullanım
- Yeterli kontrast
- Form etiketleri
- Ekran okuyucu dostu yapı
- Focus durumlarının belirgin olması
- Anlamlı ikon ve buton açıklamaları

---

## 17. Test Edilebilirlik ve Kalite Süreci

Uygulama büyüdükçe kalite kontrol manuel ilerleyemez. Bu yüzden modern bir projede test yaklaşımı baştan düşünülmelidir.

Bulunması gerekenler:

- Temel test stratejisi
- Kritik akışlar için otomasyon
- Form ve iş kuralları için doğrulama testleri
- Kod standardı
- Lint / static analysis yaklaşımı
- Review süreci

---

## 18. Sürümleme, Ortamlar ve Dağıtım

Profesyonel projelerde geliştirme süreci kadar yayınlama süreci de planlı olmalıdır.

Olması gerekenler:

- Local / development ortamı
- Test / staging ortamı
- Production ortamı
- Environment değişken yönetimi
- Yedekleme yaklaşımı
- Deployment planı
- Geri dönüş / rollback mantığı

---

## 19. Analitik ve Ölçümleme

Modern uygulamalarda kararlar sezgiyle değil veriyle desteklenmelidir.

Düşünülmesi gerekenler:

- Kullanıcı davranışı analizi
- Dönüşüm noktaları
- Hangi ekranların yoğun kullanıldığı
- Hangi işlemlerde kullanıcıların takıldığı
- Operasyonel metrikler

---

## 20. Dokümantasyon ve Geliştirme Disiplini

Sağlam bir proje sadece kodla değil, doğru dokümantasyonla büyür.

Bulunması gerekenler:

- Proje amacı ve kapsam dokümanı
- Mimari doküman
- Veritabanı notları
- UI/UX kararları
- Görev ve sprint yapısı
- Kod standartları
- Kurulum adımları
- Ortam değişkenleri açıklamaları

Bu proje özelinde ayrıca şu disiplinler önemlidir:

- VS Code odaklı geliştirme akışı
- Codex’e uygun görev bazlı dökümanlar
- Kaynaklar klasöründe parça parça ama birbiriyle bağlantılı belgeler

---

## Durum

Bu doküman proje detayına girmeden önce, modern web uygulaması için gerekli ortak çerçeveyi oluşturur. Sonraki belgeler bu çerçeveyi proje özelinde somutlaştıracaktır.

