# Web Projesi — 16.4 Mikro Metin Standardı

Bu karar notu, **Web Projesi — 16 Bildirimler ve Kullanıcı Geri Bildirimi** dokümanındaki **12.4 Mikro metin standardı** alt başlığının temiz ve uygulanabilir nihai halini içerir.

---

## 1. Temel İlke

Bu projede mikro metinler:
- kısa,
- net,
- yönlendirici,
- güven veren,
- teknik olmayan,
- suçlayıcı olmayan

olmalıdır.

Temel amaç, kullanıcının yalnızca bir mesaj görmesi değil; o mesajı okuyunca **ne olduğunu** ve gerekiyorsa **sonraki adımın ne olduğunu** hemen anlamasıdır.

Bu nedenle mikro metin standardı şu sorulara cevap vermelidir:
- ne oldu?
- neden oldu?
- kullanıcı şimdi ne yapmalı?

Her mesaj bu üç sorunun hepsini cevaplamak zorunda değildir; ancak kritik hata ve uyarı metinlerinde en azından yön duygusu verilmelidir.

---

## 2. Ortak Dil Kararları

### 2.1 Başarı mesajları
Başarı mesajları:
- kısa olmalı
- sonucu net söylemeli
- gereksiz coşku veya pazarlama dili içermemeli

Doğru örnekler:
- “Teklif talebiniz alındı.”
- “Profil bilgileriniz güncellendi.”
- “Ürün arşive gönderildi.”
- “Şifre başarıyla değiştirildi.”

Kaçınılacak yaklaşım:
- “Harika! İşleminiz muhteşem bir şekilde tamamlandı.”
- “Tebrikler, başarıyla kayıt gerçekleştirilmiştir ve sistem tarafından işleme alınmıştır.”

İlke:
**başarı metni kutlama değil, net sonuç bildirimidir.**

### 2.2 Hata mesajları
Hata mesajları:
- kullanıcıyı suçlamamalı
- teknik detay dökmemeli
- mümkünse düzeltilebilir yön vermeli

Doğru örnekler:
- “Lütfen geçerli bir e-posta adresi girin.”
- “Teklif göndermeden önce listenize en az bir ürün ekleyin.”
- “Bu işlem şu anda tamamlanamadı. Lütfen tekrar deneyin.”
- “Görsel yüklenemedi. Desteklenen bir dosya formatı seçin.”

Kaçınılacak yaklaşım:
- “Geçersiz giriş.”
- “Sistem hatası.”
- “Hatalı işlem yaptınız.”
- “Exception oluştu.”

İlke:
**hata mesajı kullanıcıyı durdurur ama onu karanlıkta bırakmaz.**

### 2.3 Uyarı mesajları
Uyarı metinleri:
- riskin ne olduğunu söylemeli
- gereksiz panik üretmemeli
- mümkünse karar öncesi bağlam vermeli

Doğru örnekler:
- “Bu ürün arşive gönderilirse public tarafta görünmez.”
- “Bu işlem geri alınamaz.”
- “E-posta adresinizi doğrulamadan bazı hesap özelliklerini kullanamayabilirsiniz.”

İlke:
**uyarı metni korkutmak için değil, karar kalitesini artırmak için vardır.**

### 2.4 Bilgi mesajları
Bilgi mesajları:
- nötr olmalı
- açıklayıcı olmalı
- gereksiz alarm dili taşımamalı

Doğru örnekler:
- “Teklif yanıtları kayıtlı e-posta adresinize gönderilir.”
- “Bazı alanlar kategoriye göre otomatik değişebilir.”
- “Filtreler yalnızca listelenen sonuçları etkiler.”

---

## 3. Kanal Bazlı Metin Standardı

### 3.1 Toast metinleri
Toast metinleri:
- tek cümlelik olmalı
- hızlı okunmalı
- çoğu durumda nokta ile biten sade yapı kullanmalı

Doğru örnekler:
- “Ürün teklif listenize eklendi.”
- “Profil bilgileriniz güncellendi.”
- “Yeniden gönderim kuyruğa alındı.”

Toast içinde kaçınılacaklar:
- uzun açıklama
- birden fazla mesaj
- aynı anda hem sonuç hem detay hem yönlendirme

### 3.2 Inline form metinleri
Inline mesajlar:
- ilgili alanın hemen yanında görünmeli
- sorunu doğrudan o alan üzerinden anlatmalı
- mümkünse kısa olmalı

Doğru örnekler:
- “Bu alan zorunludur.”
- “Lütfen geçerli bir telefon numarası girin.”
- “Adet 1’den küçük olamaz.”

### 3.3 Banner / bilgi kutusu metinleri
Banner metinleri:
- biraz daha açıklayıcı olabilir
- kısa başlık + açıklama + gerekirse aksiyon içerebilir

Doğru örnek yapı:
- Başlık: “E-posta doğrulaması bekleniyor”
- Açıklama: “Hesabınızı doğruladıktan sonra bazı işlemleri daha kolay tamamlayabilirsiniz.”
- Aksiyon: “Doğrulama e-postasını yeniden gönder”

### 3.4 Modal metinleri
Modal metinleri:
- işlem sonucunu açıkça söylemeli
- soru cümlesi veya net uyarı ile başlamalı
- buton metinleri belirsiz olmamalı

Doğru örnek:
- Başlık: “Bu ürünü arşive göndermek istiyor musunuz?”
- Açıklama: “Arşive alınan ürün public tarafta görünmez.”
- Butonlar: “Arşive gönder” / “Vazgeç”

Kaçınılacak buton metinleri:
- “Tamam”
- “Evet”
- “Onayla”

İlke:
**buton metni, yapılacak gerçek aksiyonu söylemelidir.**

---

## 4. Public, Müşteri Paneli ve Admin İçin Ton Farkı

### 4.1 Public taraf
Ton:
- sade
- güven veren
- teknik olmayan
- nazik ve hızlı

### 4.2 Müşteri paneli
Ton:
- biraz daha bağlamsal
- takip hissi veren
- süreç odaklı

### 4.3 Admin paneli
Ton:
- net
- operasyonel
- kısa ama anlamlı
- gereksiz yumuşatmadan kaçınan

Ancak üç alanda da ortak kural aynıdır:
- kaba dil yok
- suçlayıcı dil yok
- ham teknik hata yok
- belirsiz sonuç yok

---

## 5. Buton Metinleri ile Geri Bildirim Metinlerinin Uyumu

Buton metni ile işlem sonrası geri bildirim birbiriyle tutarlı olmalıdır.

Örnek:
- Buton: “Teklif Gönder”
- Başarı mesajı: “Teklif talebiniz alındı.”

- Buton: “Ürünü Arşive Gönder”
- Başarı mesajı: “Ürün arşive gönderildi.”

- Buton: “Doğrulama E-postasını Yeniden Gönder”
- Toast: “Doğrulama e-postası yeniden gönderildi.”

İlke:
**kullanıcı tıkladığı şey ile sistemin söylediği sonucu zihninde eşleştirebilmelidir.**

---

## 6. Yasaklı ve Kaçınılacak Dil Kalıpları

İlk faz için aşağıdaki dil kalıplarından kaçınılacaktır:
- aşırı pazarlama dili
- aşırı teknik terimler
- suçlayıcı kullanıcı dili
- belirsiz genel hata ifadeleri
- fazla uzun cümleler
- aynı mesaj içinde birden fazla farklı ton

Kaçınılacak örnekler:
- “Beklenmeyen bir hata oluştu, lütfen sistem yöneticinizle iletişime geçin.”
- “Validation failed.”
- “İşlem başarısız.”
- “Something went wrong.”
- “Mükemmel! Harika bir seçim yaptınız!”

---

## 7. İlk Faz İçin Nihai Karar

İlk faz mikro metin standardı şu şekilde uygulanacaktır:
- başarı mesajları kısa ve sonuç odaklı olacak
- hata mesajları yönlendirici olacak
- uyarılar riskin ne olduğunu açıkça söyleyecek
- bilgi mesajları nötr kalacak
- toast, inline, banner ve modal için ayrı yazım disiplini kullanılacak
- buton metinleri ile işlem sonrası mesajlar birbiriyle tutarlı olacak
- public, müşteri paneli ve admin tarafında ton farkı olsa da ortak dil omurgası korunacaktır

---

## 8. Uygulama Notu

Bu karar, 16. madde içindeki diğer alt başlıklarla birlikte çalışmalıdır:
- public teklif akışında güven verici ve baskısız iletişim
- müşteri panelinde süreç netliği
- admin panelde operasyonel açıklık

Yani mikro metin standardı tek başına ayrı bir copy guide değil; tüm geri bildirim katmanlarının ortak yazım omurgasıdır.

