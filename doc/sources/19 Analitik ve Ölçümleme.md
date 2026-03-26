# Web Projesi — 19.4 Tek Analitik Ekosistem Kurulum Standardı

Bu karar notu, **Web Projesi — 19 Analitik ve Ölçümleme** dokümanındaki **tek analitik ekosistem kurulum standardı** alt başlığının temiz ve uygulanabilir nihai halini içerir.

---

## 1. Temel İlke

İlk faz için analitik yaklaşımı **tek analitik ekosistem** üzerinden kurulacaktır.

Temel amaç:
- veri dağınıklığını önlemek
- aynı metriğin farklı araçlarda çelişkili görünmesini azaltmak
- event isimlendirmesini ve dashboard mantığını sade tutmak
- ilk fazta raporlama kalitesini araç sayısından çok kurulum disiplinine dayandırmaktır

Bu nedenle ilk fazta:
- ana analitik omurga tek ekosistemde kurulacak
- event standardı tek sözlük üzerinden yönetilecek
- production ve staging ayrımı net olacak
- ek araç kalabalığı ilk sürüme alınmayacaktır

---

## 2. Neden Tek Analitik Ekosistem?

İlk faz için bu kararın profesyonel gerekçesi şudur:

- aynı event’in farklı araçlarda farklı sayılması riski azalır
- ekip hangi metriğe nereden bakacağını bilir
- kurulum ve bakım maliyeti düşer
- dashboard ve ürün kararları daha tutarlı veriyle beslenir
- staging / production ayrımı daha temiz yönetilir

### Nihai karar
İlk faz için ana web analitiği ve çekirdek event ölçümlemesi **tek analitik ekosistem** içinde tutulacaktır.

---

## 3. Production ve Staging Ayrımı Nasıl Yapılacak?

Analitik tarafında production ve staging kesin olarak ayrılmalıdır.

### 3.1 Temel ilke
Staging verisi production raporlarını kirletmeyecektir.

### 3.2 İlk faz için doğru yaklaşım
- production ortamı ayrı ölçüm kimliği / stream / property mantığıyla çalışmalı
- staging ortamı production ile aynı rapora veri göndermemeli
- local/development ortamı mümkünse ayrı tutulmalı veya ölçümleme dışı bırakılmalı

### 3.3 Nihai karar
İlk faz için:
- **production analitiği ayrı çalışacak**
- **staging production raporuna veri yazmayacak**
- **development/local mümkünse ayrı veya kapalı olacak**

Bu, analitik verinin güvenilir kalması için zorunlu kabul edilecektir.

---

## 4. Event İsimlendirme Standardı

İlk faz için event isimlendirme disiplini tek standarda bağlanacaktır.

### 4.1 Temel kurallar
- tüm event isimleri küçük harf ve snake_case olacak
- fiil veya davranış odaklı olacak
- aynı davranış farklı isimlerle tekrar edilmeyecek
- event adı kısa ama anlamlı olacak
- UI bileşen adları değil, kullanıcı davranışı isimlendirilecek

### 4.2 Doğru örnekler
- `search_performed`
- `search_no_result`
- `product_detail_viewed`
- `quote_item_added`
- `quote_form_started`
- `quote_form_submitted`
- `quote_form_submit_failed`
- `email_verification_completed`

### 4.3 Kaçınılacak örnekler
- `clickedButton1`
- `go_to_quote`
- `searchDone`
- `productPage`
- `heroBannerClickFinal`

### Nihai karar
İlk faz için event isimleri:
- **snake_case**
- **davranış odaklı**
- **tek anlamlı**
- **tekrarsız**

olacaktır.

---

## 5. Event Parametre Standardı

Event kadar parametre standardı da sade ve tutarlı olmalıdır.

### 5.1 İlk faz için izin verilen çekirdek parametre mantığı
Aşağıdaki tür parametreler ilk faz için uygundur:
- `page_type`
- `product_id`
- `category_id`
- `brand_id`
- `result_count`
- `search_term_length`
- `user_type`
- `quote_item_count`
- `form_step`
- `error_type`

### 5.2 Temel ilke
Parametre yalnızca gerçekten raporlanacaksa eklenmelidir.

Yani:
- sırf mümkün diye parametre eklenmeyecek
- raporda hiç kullanılmayacak alan payload’a yazılmayacak
- aynı bilginin farklı isimleri oluşturulmayacak

### 5.3 Güvenlik ve gizlilik sınırı
İlk fazta analitik payload içine şunlar yazılmayacaktır:
- e-posta adresi
- telefon numarası
- açık isim/soyisim
- teklif notlarının serbest metni
- hassas müşteri verisi
- teknik olarak kişiyi doğrudan tanımlayabilecek veri

### Nihai karar
İlk faz için event parametreleri:
- **az ama anlamlı**
- **raporlanabilir**
- **gizlilik uyumlu**
- **tekrarsız**

olacaktır.

---

## 6. Kurulum Disiplini Nasıl İşleyecek?

Analitik kurulumu geliştirici hafızasına bırakılmayacaktır.

### 6.1 İlk faz için gerekli disiplin
- event sözlüğü yazılı olacak
- hangi event’in zorunlu, hangisinin opsiyonel olduğu belli olacak
- event adı, açıklaması ve temel parametreleri belgeli olacak
- production/staging ölçüm kimlikleri karışmayacak
- dashboard’a bağlanan event’ler ayrıca görünür olacak

### 6.2 Event sözlüğünde minimum alanlar
Her event için en az şu bilgiler tutulmalıdır:
- event adı
- event amacı
- zorunlu / opsiyonel durumu
- hangi sayfa/akışta tetiklendiği
- temel parametreleri
- dashboard’a bağlanıp bağlanmadığı

### 6.3 Nihai karar
İlk fazta analitik kurulum standardı yalnızca kod entegrasyonu değil, **belgeli event disiplini** ile birlikte yürütülecektir.

---

## 7. Dashboard’a Bağlanan Event’ler Nasıl Yönetilecek?

İlk fazta tüm event’ler dashboard’a bağlanmayacaktır.

### Dashboard’a bağlanan event’ler
Yalnızca yüksek karar değeri taşıyan çekirdek event’ler dashboard’a besleme yapacaktır.

Bunlar özellikle:
- `quote_form_submitted`
- `quote_form_submit_failed`
- `quote_item_added`
- `search_performed`
- `search_no_result`
- `product_detail_viewed`
- `category_selected`

### İlke
- dashboard, event deposunun ham görünümü olmayacak
- event’ler önce ölçümleme standardına girecek
- sonra yalnızca seçilenler dashboard’a yansıyacaktır

### Nihai karar
Dashboard’a bağlanan event seti ayrıca belgeli ve sınırlı tutulacaktır.

---

## 8. Staging’de Event Davranışı Nasıl Olacak?

Staging’de event sistemi tamamen kapatılmayacaktır; çünkü event doğruluğu da test edilmelidir.

### İlk faz için doğru yaklaşım
- staging’de event tetikleme mantığı çalışmalı
- ancak production analitiğini kirletmemeli
- staging event’leri ayrı stream/property’ye gitmeli veya güvenli biçimde ayrılmalıdır
- staging testleri sırasında dashboard mantığını etkileyen çekirdek event akışı doğrulanabilmelidir

### Nihai karar
İlk fazta staging analitiği:
- **gerçek mantıkla çalışacak**
- **production verisini kirletmeyecek**
- **test doğrulamasına yetecek kadar görünür olacak**

---

## 9. İlk Fazta Hangi Analitik Karmaşıklıklar Alınmayacak?

Aşağıdaki alanlar ilk faz için gereksiz karmaşıklık kabul edilecektir:
- birden fazla ana analitik aracıyla paralel event yönetimi
- çok detaylı segmentasyon katmanları
- event payload’ında aşırı zengin veri taşıma
- ürün kararına hizmet etmeyen mikro etkileşim ölçümleme
- BI/warehouse seviyesinde ağır veri modelleme

### Nihai karar
İlk fazta amaç analitik mimarisi göstermek değil; **karar üreten sade ve güvenilir ölçümleme hattı** kurmaktır.

---

## 10. İlk Faz İçin Nihai Karar

İlk faz için tek analitik ekosistem kurulum standardı şu şekilde kurulacaktır:

- ana analitik omurga tek ekosistem üzerinden yönetilecektir
- production, staging ve development verileri birbirine karışmayacaktır
- event isimleri snake_case ve davranış odaklı olacaktır
- parametreler az, anlamlı ve gizlilik uyumlu tutulacaktır
- event sözlüğü yazılı ve görünür olacaktır
- dashboard’a bağlanan event seti ayrıca sınırlı ve belgeli olacaktır
- staging’de event mantığı gerçek çalışacak ama production analitiğini kirletmeyecektir

---

## 11. Uygulama Notu

Bu karar, 19. madde içindeki diğer alt başlıklarla birlikte düşünülmelidir:
- admin dashboard metrik önceliği
- zorunlu / opsiyonel event ayrımı
- operasyonel metriklerin dashboard ve log ekranı dağılımı

Yani tek analitik ekosistem standardı, yalnızca araç seçimi değil; **ölçümlemenin nasıl disiplinli, sade ve güvenilir kalacağını** tanımlayan yapısal karardır.

