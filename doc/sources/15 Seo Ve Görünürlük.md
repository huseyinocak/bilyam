# Web Projesi — 15 SEO ve Görünürlük

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi, arayüz, responsive yapı, kimlik doğrulama, veri yönetimi, performans, güvenlik, hata yönetimi, arama/filtreleme/listeleme, yönetim paneli ve entegrasyon kararlarından sonra, projenin **SEO ve görünürlük** yaklaşımını netleştirmek için hazırlanmıştır.

Amaç; public tarafta yer alan sayfaların arama motorları ve paylaşım yüzeyleri açısından doğru yapılandırılmasını sağlamak, teknik ürün odaklı katalog yapısının bulunabilirliğini artırmak ve ilk fazda SEO’yu gereksiz içerik şişkinliğine dönüştürmeden profesyonel bir görünürlük omurgası kurmaktır.

---

## 0. Bu Bölümde Kararlar Nasıl Verilecek?

Bu bölümde kararlar yalnızca “Google’da çıksın” seviyesinde verilmeyecektir. Tüm alt kararlar aşağıdaki 5 eksen birlikte değerlendirilerek verilecektir:

1. **Gerçek aranabilir içerik değeri**
2. **Kullanıcı niyeti ve teknik ürün arama davranışı**
3. **UI/UX ve içerik okunabilirliği**
4. **Teknik uygulanabilirlik ve sürdürülebilir mimari**
5. **İlk faz / sonraki faz dengesi**

### 0.1 Temel ilke

Bu projede SEO yaklaşımı şu prensibe dayanacaktır:

**SEO, yapay anahtar kelime doldurma değil; doğru sayfayı, doğru niyetle, doğru yapıda görünür hale getirme işidir.**

Bu nedenle:
- SEO kararları içerik kalitesini bozmayacak
- katalog yapısı kullanıcı aramasıyla uyumlu kurulacak
- teknik meta alanları zorunlu ama yönetilebilir olacak
- arama motoru görünürlüğü ile kullanıcı deneyimi birbirine karşıt düşünülmeyecek

### 0.2 İlk faz ilkesi

İlk fazda yalnızca gerçek değer üreten SEO katmanları alınacaktır.

Yani ilk fazda:
- indekslenmeye değer public sayfalar optimize edilecek
- ürün, kategori ve kurumsal sayfa omurgası düzgün kurulacak
- teknik SEO temelleri atılacak
- ama ağır içerik operasyonu veya gereksiz SEO otomasyonları ilk faza yüklenmeyecektir

---

## 1. SEO ve Görünürlük Bu Projede Ne Anlama Geliyor?

Bu projede SEO yalnızca blog açmak veya meta description yazmak değildir. SEO ve görünürlük şu alanları kapsar:

- ürün ve kategori sayfalarının bulunabilirliği
- teknik ürün aramalarına uygun bilgi mimarisi
- arama motorlarının sayfaları doğru okuyabilmesi
- sosyal paylaşım önizlemelerinin kontrollü görünmesi
- marka görünürlüğünün public tarafta güven verici olması

Bu projede SEO’nun temel amacı:

**teklif odaklı teknik ürün yapısını doğru kullanıcıyla buluşturmak ve public sayfaları arama motorları için temiz, anlaşılır ve güvenilir hale getirmektir.**

---

## 2. Bu Projede SEO Kapsamına Girecek Sayfalar

SEO önceliği yalnızca public tarafta olan ve indekslenmesi değerli sayfalar için düşünülmelidir.

### 2.1 İlk fazda SEO önceliği olan sayfalar
- ana sayfa
- kategori sayfaları
- ürün detay sayfaları
- marka sayfaları gerekiyorsa
- kurumsal içerik sayfaları
- iletişim sayfası

### 2.2 SEO önceliği düşük veya kapalı kalması gereken alanlar
- müşteri paneli
- admin paneli
- giriş / kayıt akışlarının çoğu
- teklif sepeti / teklif formu iç ekranları
- filtre kombinasyonlarıyla oluşan ince türev sayfalar

### 2.3 İndeksleme ilkesi
Bu projede indislenmesi gereken ile yalnızca erişilebilir olan sayfalar karıştırılmamalıdır.

Her public sayfa indekslenmek zorunda değildir. İlk faz için indeks mantığı kontrollü kurulmalıdır.

---

## 3. Teknik Ürün Dünyasında SEO Yaklaşımı

Bu proje genel içerik sitesi değil, teknik ürün ve teklif odaklı bir yapıdır. Bu nedenle SEO yaklaşımı da buna uygun olmalıdır.

### 3.1 Kullanıcı nasıl arama yapar?
Bu alanda kullanıcılar çoğu zaman şu yollarla arama yapar:
- ürün adı ile
- ürün kodu / model kodu ile
- kategori adı ile
- marka + ürün tipi kombinasyonuyla
- kullanım alanı / uygulama amacı ile

### 3.2 Bu neyi değiştirir?
Bu yüzden SEO yapısında şu alanlar önem kazanır:
- ürün adı netliği
- ürün kodu görünürlüğü
- kategori hiyerarşisinin temizliği
- teknik özelliklerin anlamlı sunumu
- benzer ürün ilişkilerinin kontrollü kullanımı

### 3.3 İlk faz için doğru yaklaşım
İlk fazda SEO, içerik pazarlama ağırlıklı değil; **katalog bulunabilirliği ağırlıklı** ilerlemelidir.

Yani önce:
- ürün
- kategori
- marka
- kurumsal güven sayfaları

güçlü kurulmalı; ağır blog / rehber / içerik marketing yapısı sonraki faza bırakılabilir.

---

## 4. URL ve Sayfa Yapısı Yaklaşımı

SEO açısından URL yapısı sade, öngörülebilir ve insan tarafından okunabilir olmalıdır.

### 4.1 İlk faz URL ilkeleri
- kısa ve anlamlı slug yapısı
- gereksiz parametre kalabalığı olmamalı
- kategori ve ürün yapısı tutarlı olmalı
- Türkçe karakter ve özel karakter dönüşümleri kontrollü olmalı
- canonical ihtiyacı doğuracak gereksiz çoğaltılmış URL’lerden kaçınılmalı

### 4.2 Sayfa türlerine göre yaklaşım
Örnek mantık:
- kategori sayfaları için temiz kategorik slug
- ürün detay sayfaları için ürün adı veya ürün adı + kod dengesi
- kurumsal sayfalarda sade ve kalıcı path yapısı

### 4.3 Filtre URL yaklaşımı
Arama ve filtreleme deneyimi güçlü olsa da her filtre kombinasyonu indekslenmemelidir.

İlk faz için en doğru denge:
- filtre kombinasyonları kullanıcı deneyimi için çalışır
- ancak indekslenebilir SEO sayfasına otomatik dönüşmez
- değerli landing yapıları gerekiyorsa bilinçli olarak ayrı sayfa mantığıyla üretilir

---

## 5. Meta Alanları ve Sayfa Başlıkları

Meta alanları bu projede zorunlu ama yönetilebilir düzeyde ele alınmalıdır.

### 5.1 İlk fazda zorunlu alanlar
- meta title
- meta description
- page title / H1 uyumu
- Open Graph title
- Open Graph description
- Open Graph image

### 5.2 Ürün ve kategori tarafında yaklaşım
En doğru yapı:
- manuel alan girişi desteklenir
- ama sistem makul fallback üretebilir
- boş bırakıldığında kalitesiz veya kopya meta üretimi olmamalıdır

### 5.3 Fallback mantığı
İlk faz için best practice yaklaşım:
- ürünlerde title için ürün adı + marka / kategori bağlamı gerekirse kullanılabilir
- kategori title için kategori adı + marka vaadi / sektör bağlamı düşünülebilir
- description tarafında kısa, okunabilir, spam olmayan otomatik fallback mantığı kurulabilir

### 5.4 Yönetim paneli ilişkisi
Admin panelde ürün, kategori, marka ve kurumsal sayfalar için temel SEO alanları bulunmalıdır. Ancak ilk fazda admin kullanıcıyı onlarca SEO alanıyla boğmak doğru değildir.

---

## 6. İçerik ve Sayfa İçi Anlam Katmanı

SEO yalnızca meta alanıyla çözülmez. Sayfanın kendi içeriği de okunabilir ve anlamlı olmalıdır.

### 6.1 Ürün detay sayfalarında önemli alanlar
- net ürün adı
- ürün kodu
- kısa açıklama
- anlamlı teknik özellik sunumu
- kategori / marka bağlamı
- teklif CTA’sı ile çatışmayan açıklayıcı içerik

### 6.2 Kategori sayfalarında önemli alanlar
- kategori başlığı
- kısa açıklayıcı intro alanı
- alt kategori / ilgili ürün mantığı
- kullanıcıyı boğmayan ama sayfaya anlam katan açıklama

### 6.3 Kurumsal sayfalar
Kurumsal sayfalar sadece “hakkımızda metni” değil, güven ve görünürlük sayfalarıdır.

İletişim, hakkımızda, hizmet / süreç açıklamaları gibi sayfalar hem kullanıcı güveni hem arama görünürlüğü açısından değerlidir.

---

## 7. Teknik SEO Temelleri

İlk fazda teknik SEO için profesyonel ama aşırı olmayan bir temel kurulmalıdır.

### 7.1 Zorunlu teknik bileşenler
- sitemap üretimi
- robots kontrolü
- canonical mantığı
- düzgün heading hiyerarşisi
- semantik HTML yapısı
- kırık linklerin önlenmesi
- 404 ve yönlendirme yönetimi

### 7.2 Performans ilişkisi
SEO ve performans bu projede birbirinden ayrı düşünülmemelidir.

Özellikle:
- görsel optimizasyonu
- LCP etkileyen alanlar
- layout stability
- gereksiz script yükü

public tarafta doğrudan görünürlüğü etkiler.

### 7.3 Mobil görünürlük ilişkisi
Google ve benzeri arama motorları için mobil deneyim önemlidir. Bu nedenle responsive kararlar ve mobil performans SEO kalitesinin parçası kabul edilmelidir.

---

## 8. Open Graph ve Paylaşım Görünürlüğü

Bu proje yalnızca arama motorunda değil, paylaşım yüzeylerinde de kontrollü görünmelidir.

### 8.1 İlk fazda gerekli alanlar
- og:title
- og:description
- og:image
- temel paylaşım önizleme uyumu

### 8.2 Hangi sayfalarda önemli?
- ana sayfa
- ürün detay sayfaları
- kategori sayfaları
- kurumsal sayfalar

### 8.3 İlk faz yaklaşımı
İlk fazda her sayfa için aşırı özelleştirme gerekmez; ancak paylaşım önizlemesi bozuk veya rastgele bırakılmamalıdır.

---

## 9. Yapısal Veri ve İleri SEO Katmanları

İlk fazda yapısal veri tamamen ihmal edilmemelidir; ancak ağır şema tasarımıyla da başlanmamalıdır.

### 9.1 İlk faz için doğru denge
- temel organization / website seviyesi işaretleme düşünülebilir
- ürün sayfalarında anlamlı ve doğrulanabilir veri varsa sınırlı product schema değerlendirilebilir
- sahte veya eksik veriyi şema ile parlatma yaklaşımı kullanılmamalıdır

### 9.2 Sonraki faza açık alanlar
- gelişmiş schema çeşitleri
- FAQ schema
- breadcrumb schema
- içerik / makale schema yapıları

---

## 10. Görünürlük ve Marka Güveni İlişkisi

SEO bu projede sadece trafik değil, güven hissi de üretmelidir.

### İlk faz için önemli güven sinyalleri
- net iletişim bilgileri
- kurumsal sayfaların düzenli görünmesi
- tutarlı başlık ve içerik yapısı
- bozuk görsel / eksik meta / anlamsız sayfa bırakmama
- teknik ürün bilgisinin güven veren sunumu

Bu alanlar özellikle B2B ağırlıklı yapıda önemlidir çünkü kullanıcı yalnızca ürün değil, tedarik güveni de arar.

---

## 11. Yönetim Paneli ile SEO İlişkisi

SEO alanları yalnızca geliştiriciye bırakılmamalı; ama admin paneli de SEO uzman ekranına dönüşmemelidir.

### 11.1 İlk fazda admin tarafında olması gereken alanlar
- ürün SEO alanları
- kategori SEO alanları
- marka / kurumsal sayfa SEO alanları
- og görsel seçimi veya fallback mantığı
- slug yönetimi veya kontrollü otomatik üretim

### 11.2 İlk fazda olmaması daha doğru olanlar
- aşırı detaylı anahtar kelime alanları
- gereksiz skor ekranları
- karmaşık SEO denetim panelleri
- içerik ekibini boğan teknik kontrol kalabalığı

### 11.3 Doğru denge
Admin tarafında SEO alanları:
- sade
- anlaşılır
- hata üretmeyecek kadar kontrollü
- ama profesyonel görünürlüğü destekleyecek kadar güçlü

olmalıdır.

---

## 12. İlk Faz İçin En Doğru Denge

İlk faz için profesyonel denge şu olacaktır:

### İlk faza alınacaklar
- indekslenmeye değer public sayfalar için SEO omurgası
- temiz URL ve slug yapısı
- meta title / description yapısı
- Open Graph temeli
- sitemap / robots / canonical mantığı
- ürün ve kategori sayfalarında temel içerik anlamı
- admin panelde sade SEO alanları

### Altyapısı hazırlanıp tam açılmayacaklar
- gelişmiş schema alanları
- daha zengin landing page SEO yapıları
- içerik marketing / blog mimarisi
- ayrıntılı SEO raporlama ve skor mekanikleri

### Sonraki faza bırakılabilecekler
- blog / rehber içerik stratejisi
- ileri yapılandırılmış veri katmanları
- çok daha gelişmiş SEO içerik operasyonu
- SEO odaklı özel landing sayfa üretim sistemi

---

## 13. İlk Faz İçin Netleşen Kararlar

### 13.1 SEO öncelik sırası
Bu başlık için ilk fazda profesyonel karar aşağıdaki gibidir:

#### İndekslenecek sayfalar
- ana sayfa
- kategori sayfaları
- ürün detay sayfaları
- kurumsal sayfalar (hakkımızda, iletişim, hizmet / süreç sayfaları varsa)
- marka sayfaları **yalnızca gerçekten içerik değeri taşıyorsa**

#### İndekslenmeyecek sayfalar
- admin paneli
- müşteri paneli
- giriş / kayıt / şifre sıfırlama ekranları
- teklif listesi / teklif sepeti ekranı
- teklif formu iç akışı ve başarı ekranı
- filtre kombinasyonlarıyla oluşan türev URL’ler
- iç arama sonuç sayfaları

#### Marka sayfaları kararı
İlk faz için marka sayfaları otomatik olarak SEO öncelikli kabul edilmeyecektir.

En doğru yaklaşım:
- marka sayfasında anlamlı açıklama
- ilişkili ürün yoğunluğu
- gerçek kullanıcı arama niyeti
- yeterli katalog derinliği

varsa indekslenebilir.

Aksi halde marka sayfası erişilebilir olabilir ama indeks önceliği taşımayabilir.

#### Filtreli sayfalar kararı
İlk fazda filtreli sayfalar **genel olarak indekslenmeyecektir.**

Bu karar neden doğrudur:
- ince ve çoğalan sayfa üretimini önler
- duplicate/canonical karmaşasını azaltır
- SEO kalitesini kategori ve ürün sayfalarında yoğunlaştırır
- ilk faz operasyonunu sade tutar

Yani filtreler güçlü UX katmanı olarak çalışacak; fakat otomatik SEO landing page sistemine dönüşmeyecektir.

#### İlk faz SEO öncelik sırası
1. ürün detay sayfaları
2. kategori sayfaları
3. ana sayfa
4. kurumsal güven sayfaları
5. seçilmiş marka sayfaları

Bu sıra, projenin teklif odaklı teknik katalog yapısıyla en uyumlu SEO öncelik sırasıdır.

### 13.2 Meta alanları yaklaşımı
Bu başlık için ilk fazda profesyonel karar aşağıdaki gibidir:

#### Temel ilke
Meta ve Open Graph alanları tamamen manuel bırakılmayacaktır; ancak sistemin ürettiği fallback çıktılar da kalitesiz, spam hissi veren veya tekrar eden yapıda olmayacaktır.

En doğru denge:
- admin manuel override yapabilir
- sistem güçlü varsayılanlar üretir
- boş alanlar yüzünden zayıf paylaşım veya SEO çıktısı oluşmaz

#### Ürün sayfaları için fallback mantığı
**Meta title fallback**
1. manuel SEO title varsa onu kullan
2. yoksa ürün adı
3. gerekiyorsa ürün adı + marka
4. çok gerekli durumlarda ürün adı + kategori

İlk faz kararı:
- tek title içinde gereksiz uzun kombinasyon kurulmayacak
- ürün adı ana odak olacak
- title yapısı okunabilir kalacak

**Meta description fallback**
1. manuel SEO description varsa onu kullan
2. yoksa kısa ürün açıklamasından kontrollü özet üret
3. kısa açıklama yoksa ürün adı + kategori/marka bağlamı + teklif odaklı kısa açıklama kullan

Description tarafında:
- spam anahtar kelime tekrarından kaçınılacak
- otomatik metin insan tarafından yazılmış gibi doğal akacak
- aşırı uzun veya çok kısa description üretilmeyecek

**OG title fallback**
- varsayılan olarak meta title ile aynı mantık kullanılacak

**OG description fallback**
- varsayılan olarak meta description ile aynı mantık kullanılacak

**OG image fallback**
1. manuel OG image varsa onu kullan
2. yoksa ürün ana görseli
3. ürün ana görseli yoksa kategori fallback görseli veya sistem varsayılan paylaşım görseli

#### Kategori sayfaları için fallback mantığı
**Meta title fallback**
1. manuel SEO title varsa onu kullan
2. yoksa kategori adı
3. gerekiyorsa kategori adı + sektör/ürün tipi bağlamı

**Meta description fallback**
1. manuel SEO description varsa onu kullan
2. yoksa kategori intro metninden kısa özet üret
3. intro yoksa kategori odaklı doğal açıklama fallback’i kullan

**OG image fallback**
1. manuel OG image
2. kategori görseli
3. sistem varsayılan kategori/paylaşım görseli

#### Kurumsal sayfalar için fallback mantığı
Kurumsal sayfalarda fallback daha kontrollü olmalıdır.

**Meta title fallback**
- sayfa başlığı
- gerekiyorsa marka/site adı eki

**Meta description fallback**
- sayfa giriş paragrafından kısa özet
- giriş yoksa önceden tanımlı sade kurumsal fallback metni

**OG image fallback**
- sayfaya özel paylaşım görseli
- yoksa site geneli kurumsal OG görseli

#### Admin panel davranışı
İlk fazda admin tarafında şu alanlar yeterli olacaktır:
- SEO title
- SEO description
- OG title
- OG description
- OG image
- slug

Ancak UX açısından doğru yaklaşım şudur:
- OG title / description boşsa sistem meta alanlarından fallback üretir
- admin her alanı doldurmak zorunda bırakılmaz
- form içinde bu fallback mantığı kısa yardımcı metinle açıklanır

#### İlk faz için nihai karar
İlk faz meta ve OG yaklaşımı şu şekilde uygulanacaktır:
- manuel override desteklenecek
- fallback mantığı ürün, kategori ve kurumsal sayfa tipine göre ayrı işleyecek
- OG alanları mümkün olduğunca meta alanlarını akıllı biçimde devralacak
- görsel fallback zinciri tanımlı olacak
- zayıf, kopya veya spam hissi veren otomatik meta üretiminden kaçınılacaktır

### 13.3 Teknik SEO kapsamı
Bu başlık için ilk fazda profesyonel karar aşağıdaki gibidir:

#### Sitemap kapsamı
İlk fazda sitemap yalnızca indekslenmesi gerçekten değerli public URL’leri içermelidir.

Sitemap’e girecek sayfalar:
- ana sayfa
- kategori sayfaları
- ürün detay sayfaları
- kurumsal sayfalar
- indekslenmesine karar verilmiş marka sayfaları

Sitemap’e girmeyecek sayfalar:
- admin paneli
- müşteri paneli
- auth ekranları
- teklif akışı sayfaları
- filtre kombinasyonları
- iç arama sonuç sayfaları
- noindex tanımlı tüm sayfalar

İlk faz için en doğru yaklaşım:
- sitemap dinamik üretilebilir olmalı
- yalnızca aktif ve yayınlanmış içerikler eklenmeli
- silinen, pasif veya arşivlenen içerikler sitemap’ten düşmelidir

#### Robots yaklaşımı
Robots.txt ilk fazda sade ama kontrollü olacaktır.

Temel yaklaşım:
- admin ve müşteri panel alanları crawl açısından kapalı tutulur
- gereksiz iç akış ve utility path’ler tarama açısından sınırlandırılır
- public tarafta indekslenmesi istenen ana yapılar açık bırakılır
- robots, gizlilik aracı değil crawl yönlendirme aracı olarak ele alınır

Yani hassas alan koruması auth/yetki ile sağlanacak; robots sadece teknik yönlendirme amacı taşıyacaktır.

#### Canonical kuralları
Canonical mantığı ilk fazda zorunlu kabul edilecektir.

En doğru kurallar:
- her indekslenebilir ürün sayfası kendi canonical URL’sini işaretler
- her indekslenebilir kategori sayfası kendi canonical URL’sini işaretler
- parametreli, filtreli veya sıralama etkili türev URL’ler ana temiz liste URL’sine canonical verir
- aynı içeriğe açılan alternatif path üretiminden kaçınılır

Bu karar neden önemlidir:
- duplicate riskini azaltır
- filtre ve sıralama kombinasyonlarının SEO yükünü temizler
- indeks odağını ana sayfa tiplerinde toplar

#### 404 ve redirect yönetimi
İlk fazda 404 ve redirect davranışı kontrollü kurulmalıdır.

Doğru yaklaşım:
- silinmiş veya artık geçerli olmayan URL’lerde gerçek 404 / 410 davranışı düşünülmeli
- URL değişen içeriklerde uygun 301 yönlendirme kullanılmalı
- rastgele tüm kırık URL’leri ana sayfaya yönlendirme yaklaşımı kullanılmamalı
- kullanıcı için anlaşılır bir 404 sayfası bulunmalı

İlk faz için yönetim mantığı:
- slug değişikliklerinde yönlendirme kaydı üretilebilmeli
- ürün veya kategori yayından kalktığında her durumda otomatik ana sayfa yönlendirmesi yapılmamalı
- gerçekten yerine geçen yakın eşdeğer sayfa varsa yönlendirme yapılmalı, yoksa kontrollü 404 tercih edilmelidir

#### Filtreli sayfalarda index / noindex davranışı
İlk faz için profesyonel karar nettir:
- filtreli sayfalar genel olarak **indexlenmeyecek**
- bu sayfalar UX için çalışacak, SEO landing page olmayacaktır

En doğru davranış:
- filtre ve sıralama parametreleri taşıyan türev liste URL’leri noindex mantığına uygun ele alınmalı
- canonical ile ana kategori/liste URL’sine bağlanmalı
- sitemap’e eklenmemeli

Bu kombinasyon ilk faz için en sağlıklı dengedir çünkü:
- çoğalan ince sayfaları önler
- crawl bütçesini korur
- kategori ve ürün sayfalarında otoriteyi yoğunlaştırır

#### İlk faz için nihai karar
İlk faz teknik SEO kapsamı şu şekilde uygulanacaktır:
- sitemap yalnızca değerli indekslenebilir public sayfaları içerecek
- robots sade ve kontrollü olacak
- canonical kuralları ürün, kategori ve parametreli URL’lerde net uygulanacak
- 404 ve 301 davranışı rastgele değil içerik mantığına göre çalışacak
- filtreli URL’ler indexlenmeyecek, canonical + noindex yaklaşımıyla yönetilecektir

### 13.4 İçerik ve görünürlük dengesi
Bu başlık için ilk fazda profesyonel karar aşağıdaki gibidir:

#### Kategori açıklamaları ne kadar uzun olmalı?
İlk fazda kategori açıklamaları ne çok kısa ne de içerik duvarına dönüşecek kadar uzun olmalıdır.

En doğru denge:
- üst bölümde kısa ve güçlü bir intro alanı
- gerekiyorsa alt bölümde daha açıklayıcı destek metni

Profesyonel ilk faz kararı:
- kategori üst açıklaması yaklaşık **40–90 kelime** bandında tutulmalı
- gerçekten ihtiyaç varsa alt bölümde ek açıklama alanı kullanılabilir
- kategori sayfası ürün listesini gölgeleyen uzun SEO metniyle açılmamalıdır

Bu neden doğrudur:
- kullanıcıyı üründen koparmaz
- kategoriye anlam kazandırır
- arama motoru için boş veya zayıf sayfa hissini azaltır
- mobilde okunabilirliği bozmadan içerik katkısı sağlar

#### Ürün açıklamalarında SEO ile satış / teklif dili dengesi nasıl kurulmalı?
Bu proje doğrudan satıştan çok teklif odaklı olduğu için ürün metni klasik e-ticaret satış kopyası gibi yazılmamalıdır.

En doğru denge:
- ürünün ne olduğunu net anlatan açıklama
- teknik güven veren bilgi
- teklif aksiyonunu destekleyen sade dil
- ama gereksiz reklam cümlelerinden kaçınma

İlk faz için ürün açıklama yapısı şu omurgada olmalıdır:
1. kısa ürün tanımı
2. temel teknik bağlam / kullanım alanı
3. gerekiyorsa ayırt edici özellikler
4. teklif vermeyi destekleyen yönlendirici ama abartısız ifade

Doğru dil yaklaşımı:
- “en iyi”, “en kaliteli”, “mükemmel” gibi boş pazarlama dili azaltılmalı
- ürün adı, ürün kodu, kategori ve kullanım amacı doğal biçimde metne yedirilmeli
- açıklama SEO için değil kullanıcı için yazılmalı; SEO faydası doğal olarak gelmelidir

#### Kurumsal sayfalar ilk fazda hangi derinlikte hazırlanmalı?
İlk fazda kurumsal sayfalar yüzeysel placeholder metinlerle geçilmemelidir; ama devasa kurumsal içerik merkezi de kurulmasına gerek yoktur.

İlk faz için yeterli kurumsal set:
- hakkımızda
- iletişim
- gerekiyorsa hizmet / çalışma yaklaşımı
- teklif süreci / nasıl çalışıyoruz tarzı güven artırıcı açıklama sayfası

Derinlik kararı:
- her sayfa gerçek, okunabilir ve güven veren içerik taşımalı
- 2–3 paragrafı geçemeyen zayıf metinlerden kaçınılmalı
- ama ilk fazda uzun kurumsal manifesto metinleri de yazılmamalı

En doğru denge:
- her kurumsal sayfa temel soruya net cevap vermeli
- kullanıcıya şirketin ne yaptığı, nasıl çalıştığı ve nasıl iletişime geçileceği açık olmalı
- SEO amacıyla şişirilmiş anlamsız metinler kullanılmamalıdır

#### İlk faz için nihai karar
İlk faz içerik ve görünürlük dengesi şu şekilde kurulacaktır:
- kategori sayfalarında kısa ama anlamlı intro metni kullanılacak
- ürün açıklamaları teknik güven + teklif odaklı sade dil ile yazılacak
- kurumsal sayfalar gerçek güven sinyali üretecek kadar dolu olacak
- SEO için metin şişirme yapılmayacak
- kullanıcıyı üründen veya teklif aksiyonundan koparan içerik yoğunluğu oluşturulmayacaktır

---

## 14. Sonuç

İlk faz için SEO ve görünürlük yaklaşımı şu omurgaya dayanacaktır:
- SEO yalnızca meta alanı değil, doğru sayfa yapısı ve bulunabilirlik işi olarak ele alınacaktır
- ilk fazda katalog bulunabilirliği öncelikli olacaktır
- indekslenmeye değer public sayfalar optimize edilecek, iç/panel alanları SEO kapsamına alınmayacaktır
- teknik SEO temeli profesyonel ama sade şekilde kurulacaktır
- admin tarafında SEO alanları sade ama yeterli güçte sunulacaktır
- içerik yapısı kullanıcı deneyimini bozmadan görünürlüğü destekleyecektir

---

## 15. Sohbette Netleştirilecek Sonraki Alt Başlıklar

Bu dokümanı birlikte geliştirirken sırayla şunları netleştirebiliriz:
1. Admin SEO alanlarının kesin form kapsamı
2. Sitemap ve canonical uygulama notları
3. Sonraki faz SEO genişleme alanları
4. Şema / structured data derinliği

