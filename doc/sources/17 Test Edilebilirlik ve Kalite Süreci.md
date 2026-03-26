# Web Projesi — 17.4 Release Checklist ve Staging Yaklaşımı

Bu karar notu, **Web Projesi — 17 Test Edilebilirlik ve Kalite Süreci** dokümanındaki **11.4 Release kalite kontrolü** alt başlığının temiz ve uygulanabilir nihai halini içerir.

---

## 1. Temel İlke

Bu projede release süreci yalnızca kodun merge edilmesi anlamına gelmeyecektir.

Yayına çıkmadan önce şu soruların cevabı net olmalıdır:
- kritik akışlar gerçekten çalışıyor mu?
- yetki ve sahiplik sınırları korunuyor mu?
- teklif ve admin operasyonları beklenen sonucu üretiyor mu?
- mail, bildirim ve hata davranışları bozulmuş olabilir mi?
- bu değişiklik production’da gereksiz risk oluşturuyor mu?

İlk faz için amaç ağır release prosedürü değil; **kısa ama gerçek riskleri yakalayan bir yayın öncesi kalite kontrol hattı** kurmaktır.

---

## 2. İlk Fazda Release Checklist Zorunlu mu?

Evet.

İlk faz için release checklist **zorunlu** kabul edilecektir.

Ancak bu checklist uzun ve bürokratik olmayacaktır. Amaç:
- unutulabilecek kritik kontrolleri görünür kılmak
- merge sonrası ama production öncesi son güvenlik katmanını sağlamak
- özellikle teklif, auth, yetki ve admin operasyonu gibi pahalı kırılmaları son aşamada tekrar gözden geçirmektir

### Nihai karar
**İlk fazda her production release öncesinde kısa ama zorunlu bir release checklist uygulanacaktır.**

---

## 3. Staging İlk Fazda Zorunlu mu, Opsiyonel mi?

İlk faz için profesyonel karar şudur:

**Staging çok güçlü şekilde önerilir; ancak mutlak zorunlu altyapı koşulu olarak değil, kritik release’lerde devreye alınacak kalite katmanı olarak konumlandırılır.**

Bu kararın nedeni:
- ilk fazda ekip ve operasyon yükü gereksiz ağırlaştırılmamalı
- her küçük değişiklik için tam staging prosedürü şart koşmak geliştirme hızını düşürebilir
- ancak auth, teklif akışı, admin operasyonu, mail davranışı veya veri/migration etkisi taşıyan değişikliklerde staging doğrulaması çok değerlidir

### Nihai karar
- küçük ve düşük riskli değişikliklerde staging **opsiyonel** olabilir
- kritik akış etkileyen release’lerde staging doğrulaması **güçlü şekilde beklenen standart** olacaktır
- ilk faz ilerledikçe staging, giderek daha merkezi kalite katmanına dönüştürülebilir

Yani ilk faz için en doğru denge:
**staging tamamen yok sayılmayacak, ama her değişiklik için katı zorunluluk da olmayacaktır.**

---

## 4. Release Öncesi Minimum Checklist

İlk faz için release öncesi minimum checklist şu olacaktır:

- [ ] İlgili kritik testler geçti
- [ ] Lint / format temiz
- [ ] Kırmızı seviyede static analysis sorunu yok
- [ ] Auth / yetki / sahiplik etkisi gözden geçirildi
- [ ] Teklif oluşturma akışı kontrol edildi
- [ ] Admin teklif operasyonunda ilgili değişiklikler kontrol edildi
- [ ] Gerekliyse mail / event / bildirim davranışı kontrol edildi
- [ ] Gerekliyse migration / veri etkisi gözden geçirildi
- [ ] Kritik boş durum / hata mesajları bozulmadı
- [ ] Mobilde kritik akış en az temel seviyede kontrol edildi

Bu liste ilk faz için minimum çekirdektir. Amaç, yayın öncesi pahalı regressions riskini son kez görünür kılmaktır.

---

## 5. Kritik Release’lerde Ek Kontroller

Aşağıdaki değişikliklerde ek release dikkati gerekecektir:
- auth ve yetkilendirme değişiklikleri
- teklif oluşturma veya teklif durum akışı değişiklikleri
- admin teklif operasyonu değişiklikleri
- mail / event / notification davranışı değişiklikleri
- migration veya veri yapısı etkileri
- görünürlük / yayınlama kuralları değişiklikleri

Bu tür release’lerde mümkünse şunlar da yapılmalıdır:
- staging doğrulaması
- örnek gerçekçi veriyle kısa smoke test
- rollback düşüncesinin önceden netleştirilmesi
- log/hata görünürlüğünün takip edilmesi

---

## 6. Staging’de Ne Doğrulanmalı?

Staging kullanılıyorsa ilk faz için her şeyi test etmeye çalışmak yerine kritik akışlara odaklanılmalıdır.

### Staging’de minimum doğrulama alanları
- public tarafta ürün → teklif listesi → teklif gönderim akışı
- misafir teklif ve üye teklif davranışı
- müşteri panelinde teklif listeleme ve detay erişimi
- admin panelde teklif liste / detay / durum güncelleme akışı
- gerekiyorsa mail tetikleme davranışı
- kritik hata, boş durum ve uyarı mesajlarının görünürlüğü

### İlke
Staging, production’a en yakın ortamda “çekirdek davranış doğru mu?” sorusunu cevaplamak için vardır; her pikseli tekrar test etmek için değil.

---

## 7. Release Sonrası İlk Kontrol Yaklaşımı

İlk faz için yayın sonrası kısa bir ilk kontrol yaklaşımı da tanımlanmalıdır.

### Release sonrası ilk kontrol alanları
- ana sayfa ve temel public akışlar açılıyor mu?
- teklif oluşturma davranışı çalışıyor mu?
- admin giriş ve temel admin akışı çalışıyor mu?
- kritik hata/log sinyali oluştu mu?
- mail / bildirim zincirinde beklenmedik bir sorun var mı?

### Neden gerekli?
Bazı hatalar test ve staging’den geçse bile production konfigürasyonu veya çevresel farklar nedeniyle ancak yayından sonra görünür olabilir.

### Nihai karar
İlk fazda release sonrası kısa bir **post-release smoke kontrolü** profesyonel standart olarak kabul edilecektir.

---

## 8. Rollback Düşüncesi

İlk fazda tam gelişmiş deployment otomasyonu olmasa bile kritik release’lerde geri dönüş düşüncesi bulunmalıdır.

### Temel yaklaşım
- veri etkileyen değişikliklerde geri dönüş riski önceden düşünülmeli
- migration içeren değişikliklerde özellikle dikkatli olunmalı
- yüksek riskli release’lerde “sorun çıkarsa ilk müdahale ne olacak?” sorusunun cevabı önceden bilinmelidir

Bu bölüm ilk fazda ayrıntılı release engineering sürecine dönüşmeyecek; ancak “yayınladık, sorun çıkarsa bakarız” yaklaşımı da benimsenmeyecektir.

---

## 9. İlk Faz İçin Nihai Karar

İlk faz için release checklist ve staging yaklaşımı şu şekilde kurulacaktır:

- production release öncesi kısa ama zorunlu bir checklist uygulanacaktır
- staging ilk fazda mutlak zorunlu olmayacaktır
- ancak kritik akış etkileyen değişikliklerde staging güçlü şekilde beklenen kalite katmanı olacaktır
- teklif, auth, admin operasyonu, mail ve migration etkisi taşıyan release’lerde ek dikkat gösterilecektir
- release sonrası kısa smoke kontrolü profesyonel standart olarak uygulanacaktır
- rollback düşüncesi özellikle veri ve kritik akış değişikliklerinde önceden ele alınacaktır

---

## 10. Uygulama Notu

Bu karar, 17. madde içindeki diğer kalite kararlarıyla birlikte çalışmalıdır:
- minimum zorunlu test senaryoları
- feature / unit test dengesi
- merge öncesi kalite kapıları

Yani release checklist ve staging yaklaşımı, kalite sürecinin son halkasıdır; merge sonrası güven varsayımını körleştirmeden production riskini düşüren pratik savunma katmanıdır.

