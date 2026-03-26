# Web Projesi — 18.4 Release Tag ve Sürümleme Disiplini

Bu karar notu, **Web Projesi — 18 Sürümleme, Ortamlar ve Dağıtım** dokümanındaki **release tag / sürümleme disiplini** alt başlığının temiz ve uygulanabilir nihai halini içerir.

---

## 1. Temel İlke

İlk faz için sürümleme yaklaşımı şu prensibe dayanacaktır:

**Her değişiklik ayrı büyük sürüm gibi ele alınmayacak; ama production’a çıkan her anlamlı yayın izlenebilir, geri dönülebilir ve ekip içinde anlaşılabilir olacaktır.**

Bu nedenle:
- production release’ler tanımsız bırakılmayacak
- kritik yayınlar etiketlenebilir olacak
- yayın geçmişi yalnızca commit geçmişine gömülmeyecek
- hangi değişikliğin hangi yayında çıktığı sonradan anlaşılabilir olacaktır

---

## 2. Sürümleme Bu Projede Ne İşe Yarayacak?

Bu projede sürümleme disiplini şu ihtiyaçlara hizmet edecektir:

- hangi sürümün production’da olduğunu bilmek
- hata geldiğinde hangi release’e bakılacağını anlamak
- rollback kararını hızlandırmak
- büyük/kritik değişiklikleri görünür kılmak
- release checklist ve deployment geçmişini anlamlı hale getirmek

Temel amaç:

**yayınları görünür hale getirmek ve üretimde belirsizliği azaltmaktır.**

---

## 3. İlk Fazda Nasıl Bir Sürümleme Yaklaşımı Kullanılacak?

İlk faz için en doğru denge, ağır release train yapısı değil; **sade ve izlenebilir tag disiplini** kullanmaktır.

### İlk faz kararı
- production’a çıkan anlamlı yayınlar tag’lenebilir olacaktır
- özellikle kritik release’ler açık biçimde sürüm etiketi alacaktır
- küçük iç geliştirmeler her zaman ayrı release etiketi gerektirmeyebilir
- ancak production’a çıkan sürümün ne olduğu belirsiz bırakılmayacaktır

### Neden bu yaklaşım?
Çünkü ilk fazda:
- ekip ve süreç aşırı bürokratik olmamalı
- ama production’da hangi kodun çalıştığı da belirsiz kalmamalı
- rollback ve hata takibi commit aramakla zorlaşmamalıdır

---

## 4. Tag Yapısı Nasıl Olacak?

İlk faz için profesyonel ve sade yaklaşım:

- anlaşılır sürüm etiketleri kullanılacak
- tutarlı tek format korunacak
- ekip içinde herkes aynı mantığı kullanacak

### Önerilen format
- `v0.1.0`
- `v0.1.1`
- `v0.2.0`
- `v1.0.0`

Yani ilk faz için **semver-benzeri** sade bir yapı kullanılacaktır.

### Pratik yorum
- **patch** → hata düzeltmesi, düşük riskli iyileştirme
- **minor** → yeni ama geriye uyumlu özellik grubu
- **major** → büyük kırılım, mimari sıçrama veya ciddi davranış değişikliği

İlk faz gerçekliğinde bu yapı çok katı kurallarla değil, ama tutarlı mantıkla işletilecektir.

---

## 5. Hangi Yayınlar Tag Alacak?

İlk faz için aşağıdaki yayınlar tag almaya uygun kabul edilecektir:

### Tag verilmesi güçlü şekilde önerilen yayınlar
- production’a çıkan anlamlı release’ler
- teklif akışını etkileyen yayınlar
- auth / yetki davranışını etkileyen yayınlar
- admin operasyon akışını etkileyen yayınlar
- migration içeren yayınlar
- mail / event / notification davranışını etkileyen yayınlar
- görünürlük / yayınlama kuralı etkileyen yayınlar

### Tag verilmesi opsiyonel olabilecek değişiklikler
- yalnızca local/staging doğrulama amaçlı iç geliştirmeler
- production’a çıkmayan ara branch durumları
- çok küçük ve tek seferlik düzeltmeler, eğer ayrı production release olarak çıkmadıysa

### Nihai karar
**Production’a çıkan kritik veya anlamlı her release, izlenebilir sürüm etiketi ile işaretlenecektir.**

---

## 6. “Kritik Release” Nedir?

İlk faz için aşağıdaki değişiklikler kritik release olarak değerlendirilecektir:

- auth ve yetki sistemi değişiklikleri
- teklif oluşturma / teklif durum akışı değişiklikleri
- müşteri paneli sahiplik davranışı değişiklikleri
- admin teklif operasyonu değişiklikleri
- migration veya veri yapısı değişiklikleri
- mail / event / notification zinciri değişiklikleri
- storage / medya erişimi değişiklikleri
- production görünürlüğünü etkileyen önemli SEO / routing / yayınlama değişiklikleri

Bu tür release’lerde:
- tag zorunluluğu çok daha güçlü kabul edilecektir
- release notu beklentisi yükselecektir
- rollback düşüncesi ayrıca gözden geçirilecektir

---

## 7. Release Notu Disiplini Nasıl Olacak?

İlk fazda ağır release note sistemi kurulmayacaktır; ama tamamen notsuz yayın da yapılmayacaktır.

### İlk faz için doğru yaklaşım
Her anlamlı release için kısa bir yayın özeti tutulmalıdır.

Bu özet en az şu sorulara cevap vermelidir:
- ne değişti?
- hangi alan etkilendi?
- riskli taraf var mı?
- migration / env / mail / config etkisi var mı?

### Kısa release note örneği
- teklif akışında misafir ve üye ayrımı güncellendi
- admin teklif detayında not alanı eklendi
- ürün medya yönetiminde yeni varyant akışı açıldı
- migration içeriyor
- staging doğrulandı

### Nihai karar
**İlk fazda release note kısa olabilir; ama anlamsız veya boş olmayacaktır.**

---

## 8. Sürüm ile Ortam İlişkisi Nasıl Yönetilecek?

İlk faz için temel ilke:
- local ve staging’de her an geçici sürümler olabilir
- ama production sürümü belirgin olmalıdır

Bu nedenle:
- production’a çıkan release tag görünür olmalı
- staging’de hangi sürüm test edildiği mümkünse bilinmeli
- production’da çalışan sürüm sonradan commit aramasıyla tahmin edilmemelidir

### Nihai karar
**Production ortamında çalışan sürüm net biçimde izlenebilir olacaktır.**

---

## 9. Rollback ile Tag İlişkisi

Tag disiplini rollback kararını kolaylaştırmalıdır.

### Temel ilke
- rollback gerektiğinde “hangi commit iyiydi?” sorusu karmaşık hale gelmemeli
- son güvenilir release açıkça görülebilmeli
- kritik yayınlar karşılaştırılabilir olmalıdır

### Nihai karar
İlk faz için tag yapısı:
- rollback düşüncesini destekleyecek
- son güvenilir release’i görünür kılacak
- kritik yayınların birbirinden ayrılmasını kolaylaştıracaktır

---

## 10. İlk Faz İçin Nihai Karar

İlk faz için release tag ve sürümleme disiplini şu şekilde kurulacaktır:

- production’a çıkan anlamlı sürümler izlenebilir şekilde etiketlenecektir
- sade semver-benzeri bir sürüm yapısı kullanılacaktır
- kritik release’ler tag + kısa release note ile desteklenecektir
- küçük iç geliştirmeler için gereksiz sürüm bürokrasisi kurulmayacaktır
- production’da hangi sürümün çalıştığı net olacaktır
- tag disiplini rollback ve hata takibini kolaylaştıran pratik bir araç olarak işletilecektir

---

## 11. Uygulama Notu

Bu karar, 18. madde içindeki diğer başlıklarla birlikte düşünülmelidir:
- deployment adım sırası
- staging kullanım seviyesi
- backup ve rollback çerçevesi

Yani sürümleme disiplini, dağıtım sürecinin “hangi yayını ne olarak tanımlıyoruz” tarafını netleştiren görünürlük ve kontrol katmanıdır.

