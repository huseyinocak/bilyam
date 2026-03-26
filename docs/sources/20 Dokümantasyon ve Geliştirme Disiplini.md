# Web Projesi — 20.4 Doküman Güncelleme ve Kaynak Doğruluk Disiplini

Bu karar notu, **Web Projesi — 20 Dokümantasyon ve Geliştirme Disiplini** dokümanındaki **doküman güncelleme ve kaynak doğruluk disiplini** alt başlığının, bu proje özelindeki **bulutta çalışan Codex + çoklu ajan + yaşayan Kaynaklar klasörü** modeline göre temiz ve uygulanabilir nihai halini içerir.

---

## 1. Temel İlke

Bu projede doküman doğruluğu şu prensibe dayanacaktır:

**Karar değişebilir; ama kaynak belirsiz kalmayacaktır.**

Yani bir karar güncellendiğinde:
- yeni doğru bilgi hızlıca doğru belgeye işlenecek
- eski bilgi sistem içinde “yanlış ama hâlâ duruyor” halinde bırakılmayacak
- çoklu ajan veya geliştirici farklı belgelerden farklı gerçeklik okumayacaktır

Temel amaç:

**Kaynaklar klasörünü yaşayan ama güvenilir bilgi sistemi olarak tutmaktır.**

---

## 2. Bu Başlık Neden Kritik?

Bu proje için 01–20 ana dokümanlar, karar notları ve teknik referanslar birlikte çalışıyor. Eğer güncelleme disiplini net olmazsa şu riskler ortaya çıkar:

- ana doküman eski kalır, karar notu yeni olur
- teknik referans belge güncellenmez ve Codex eski teknik varsayımla plan çıkarır
- aynı konu için iki farklı “doğru” oluşur
- çoklu ajan aynı işi iki farklı kaynaktan okuyup çelişkili uygular
- sohbet içinde alınan yeni karar kaynağa işlenmez ve kaybolur

Bu nedenle doküman güncelleme disiplini, yalnızca yazı düzeni değil; doğrudan **mimari doğruluk ve implementasyon güvenliği** konusudur.

---

## 3. Bir Karar Değiştiğinde Hangi Belge Önce Güncellenecek?

İlk faz için profesyonel karar şudur:

### 3.1 Önce en dar ve en güncel karar kaynağı güncellenir
Bir karar değiştiğinde ilk güncellenecek belge:
- eğer konu zaten bir **karar notu** ile sabitlenmişse → **önce karar notu**
- eğer konu yalnızca ana dokümanda yaşıyorsa → **önce ana doküman**
- eğer teknik uygulama etkisi varsa → sonra ilgili **teknik referans belge**

### 3.2 Sonra üst seviye kaynağa geri işlenir
Karar notu güncellendiyse:
- bağlı olduğu ana doküman ilk uygun noktada bu yeni kararla hizalanmalıdır

Teknik referans belgeyi etkiliyorsa:
- teknik referans da yeni karara göre güncellenmelidir

### 3.3 Nihai karar
İlk güncelleme her zaman **en güncel uygulama kararının yaşadığı belgeye** yapılacaktır.

Yani:
- uygulama kararını taşıyan belge önce
- çerçeveyi taşıyan belge sonra
- teknik yansıma gerekiyorsa teknik referans en son

güncellenecektir.

---

## 4. Ana Doküman ile Karar Notu Çakışırsa Hangisi Kaynak Kabul Edilecek?

İlk faz için kaynak öncelik sırası nettir:

1. **En güncel ilgili karar notu**
2. **Bağlı olduğu ana doküman**
3. **Teknik referans belge**

### 4.1 Neden karar notu önde?
Çünkü karar notları:
- daha dar kapsamlıdır
- daha somut uygulama kararı taşır
- sohbet içinde netleştirilen son kararı sabitler
- yorum alanını azaltır

### 4.2 Bu ana dokümanı önemsiz mi yapar?
Hayır.
Ana doküman:
- çerçeve kaynaktır
- konunun büyük resmi ve ilke setini taşır
- karar notuna bağlam verir

Ama alt konuda netleşmiş uygulama kararı varsa, **karar notu önceliklidir.**

### 4.3 Nihai karar
Ana doküman ile karar notu çakışırsa:
- **karar notu geçerli kaynak kabul edilecektir**
- ana doküman ise ilk fırsatta bu karara göre güncellenecektir

---

## 5. Teknik Referans Belge ile Ana Kaynak Çakışırsa Ne Olacak?

Teknik referans belgeler ana strateji kaynağı değildir; yardımcı uygulama kaynağıdır.

Bu nedenle:
- teknik referans belge karar değiştiremez
- yalnızca kararı uygulama seviyesinde netleştirir

### Öncelik kuralı
- karar notu > ana doküman > teknik referans belge

### Uygulama ilkesi
Eğer teknik referans:
- karar notuna aykırıysa → teknik referans güncellenir
- ana dokümana aykırıysa → teknik referans güncellenir
- ama teknik referans uygulamada eksik bilgi taşıyorsa → destekleyici olarak genişletilebilir

### Nihai karar
**Teknik referans belge asla birincil kaynak yerine geçmeyecektir.**

---

## 6. Doküman Güncelleme Sırası Standardı

İlk faz için standart güncelleme sırası şu olacaktır:

### Senaryo A — Var olan alt karar değişti
1. ilgili karar notunu güncelle
2. bağlı ana dokümanı hizala
3. etkileniyorsa teknik referansı güncelle
4. görev paketlerini gerekiyorsa yeni karara göre düzelt

### Senaryo B — Yeni alt karar netleşti
1. yeni karar notunu oluştur
2. bağlı ana dokümana referans veya özet uyumunu işle
3. gerekiyorsa teknik referans belge ihtiyacını değerlendir

### Senaryo C — Sadece teknik uygulama netleşti
1. teknik referans belgeyi güncelle
2. ana strateji veya karar değişmiyorsa ana dokümana dokunma
3. ama teknik netleşme karar etkisi yaratıyorsa bunu karar notuna taşı

### Nihai karar
Her güncelleme aynı disiplinle ilerleyecektir:
- önce kararın yaşadığı katman
- sonra üst çerçeve
- sonra teknik yansıma

---

## 7. Sohbette Alınan Yeni Kararlar Ne Zaman Kaynağa İşlenecek?

Bu başlık çok kritiktir. Çünkü bu projede kararlar çoğu zaman sohbetle netleşmektedir.

### İlk faz için doğru yaklaşım
Sohbette şu seviyede netleşen her karar kaynağa işlenmelidir:
- uygulamayı etkileyen karar
- tekrar referans alınacak karar
- modül sınırı veya davranış değiştiren karar
- Codex’in gelecekte yanlış yorumlayabileceği karar

### Kaynağa işlenmeden bırakılabilecekler
- geçici düşünceler
- henüz karara bağlanmamış alternatifler
- kısa ömürlü tartışmalar
- yalnızca estetik yorum seviyesinde kalan küçük notlar

### Nihai karar
**Sohbet içinde kalıcı değer taşıyan kararlar, mümkün olan en kısa sürede ilgili kaynağa işlenecektir.**

---

## 8. Kaynak Doğruluğu Nasıl Korunacak?

İlk faz için kaynak doğruluğu şu kurallarla korunacaktır:

### 8.1 Tek kaynak ilkesi
Aynı kararın birincil kaynağı tek olacaktır.

### 8.2 Çelişki bırakmama ilkesi
Çakışan iki belge uzun süre birlikte bırakılmayacaktır.

### 8.3 Tarihsel kalıntı üretmeme ilkesi
Eski kararlar yeni doğru ile çelişecek şekilde görünür bırakılmayacaktır.

### 8.4 Referans açıklığı
Her karar notu hangi ana dokümana bağlı olduğunu açık söyleyecektir.

### 8.5 Teknik netlik
Teknik referans belgeler, ana kararlarla aynı dili kullanacaktır.

### Nihai karar
Kaynak doğruluğu, belge sayısını azaltarak değil; **öncelik sırası + güncelleme disiplini + çelişki temizliği** ile korunacaktır.

---

## 9. Codex ve Çoklu Ajan Açısından Kaynak Doğruluk Standardı

Bu proje özelinde en önemli konu şudur:

Codex ve çoklu ajan sistemi, eski ve yeni kararları aynı anda okuyup yanlış plan çıkarmamalıdır.

Bu nedenle:
- en güncel karar notu hızlı görünür olmalı
- ana doküman gecikmeli güncellense bile karar notu bağlayıcı kabul edilmeli
- teknik referanslar karara ters düşmemeli
- görev paketleri gerekiyorsa yeni kaynağa göre revize edilmelidir

### Nihai karar
Çoklu ajanlı Codex sistemi için:
- **güncel karar notu bağlayıcı uygulama kaynağı** olacaktır
- ana doküman stratejik kaynak olmaya devam edecektir
- teknik referanslar destekleyici ama ikincil kalacaktır

---

## 10. Doküman Güncelleme İçin Pratik Kural Seti

İlk faz için pratik kural seti şu olacaktır:

- yeni karar çıktıysa önce ilgili karar notuna işle
- karar notu yoksa önce ana dokümanı güncelle
- teknik uygulama etkileniyorsa ilgili teknik referansı hizala
- çelişen eski metni bırakma
- aynı konu için yeni belge açmadan önce mevcut belgeyi genişletme ihtimalini kontrol et
- görev paketlerini gerekiyorsa yeni kaynağa göre düzelt

---

## 11. İlk Faz İçin Nihai Karar

İlk faz için doküman güncelleme ve kaynak doğruluk disiplini şu şekilde kurulacaktır:

- karar değiştiğinde önce kararın yaşadığı belge güncellenecektir
- karar notu ile ana doküman çakışırsa karar notu geçerli kaynak kabul edilecektir
- teknik referans belgeler destekleyici olacak, ana karar kaynağının yerine geçmeyecektir
- sohbet içinde kalıcı kararlar mümkün olan en kısa sürede ilgili kaynağa işlenecektir
- çelişen belge bırakılmayacak; kaynaklar hiyerarşik öncelikle hizalanacaktır
- çoklu ajanlı Codex sistemi için en güncel karar notu uygulama seviyesinde bağlayıcı kaynak olacaktır

---

## 12. Uygulama Notu

Bu karar, 20. madde içindeki diğer başlıklarla birlikte düşünülmelidir:
- kaynak klasörü standardı
- Codex bulut çoklu ajan görev standardı
- teknik referans belgelerinin minimum seti

Yani bu disiplin, yalnızca belge güncelleme kuralı değil; projenin bilgi güvenliğini ve çoklu ajan yorum tutarlılığını koruyan ana çalışma standardıdır.

