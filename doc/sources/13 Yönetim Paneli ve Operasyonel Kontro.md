# Web Projesi — 13 Yönetim Paneli ve Operasyonel Kontrol

Bu doküman, ürün temeli, bilgi mimarisi, kullanıcı deneyimi, arayüz, responsive yapı, kimlik doğrulama, veri yönetimi, performans, güvenlik, hata yönetimi ve arama/filtreleme/listeleme kararlarından sonra, projenin **yönetim paneli ve operasyonel kontrol** yaklaşımını netleştirmek için hazırlanmıştır.

Amaç; admin panelinin yalnızca veri girişi yapılan bir arka ofis değil, aynı zamanda teklif operasyonunun, katalog kalitesinin, müşteri yönetiminin, içerik kontrolünün ve sistem görünürlüğünün merkezi olduğu yapıyı proje özelinde tanımlamaktır.

---

## 0. Bu Bölümde Kararlar Nasıl Verilecek?

Bu bölümde kararlar rastgele veya sadece görsel beğeniye göre verilmeyecektir. Tüm alt kararlar aşağıdaki 4 eksen birlikte değerlendirilerek verilecektir:

1. **Görsel referans uyumu**
2. **Operasyonel hız ve kullanılabilirlik**
3. **UI/UX tutarlılığı**
4. **Uygulama mantığı ve sürdürülebilir mimari**

### 0.1 Görsel referansların rolü

Bu projede yönetim paneli tarafında daha önce belirlenen admin tema yaklaşımı referans alınacaktır. Yani:

- kart yapıları
- başlık hiyerarşisi
- özet KPI blokları
- tablo, filtre ve aksiyon yerleşimi
- form section mantığı
- boşluk, yoğunluk ve bilgi katmanları

karar verilirken modern admin tema yaklaşımı baz alınacaktır.

Ancak önemli ilke şudur:

**Tema referansı birebir kopyalama nedeni değil, doğru arayüz kararlarını hızlandıran görsel çerçevedir.**

Bu nedenle bir bileşen yalnızca güzel göründüğü için seçilmeyecek; gerçekten operasyonu hızlandırıyor, okunabilirliği artırıyor ve mimariye uyuyorsa tercih edilecektir.

Böylece doküman sadece fikir listesi değil, uygulanabilir karar dokümanı haline gelecek.

---

## 1. Yönetim Paneli Bu Projede Ne Anlama Geliyor?

Bu projede yönetim paneli sadece ürün ekleme ekranlarından ibaret değildir. Yönetim paneli şu ihtiyaçları birlikte karşılamalıdır:

- gelen teklif taleplerini operasyonel olarak yönetmek
- ürün, kategori, marka ve kullanım alanı verisini düzenlemek
- katalog kalitesini ve görünürlüğünü kontrol etmek
- müşteri kayıtlarını ve teklif geçmişini incelemek
- vitrin ve içerik alanlarını yönetmek
- sistem ayarlarını ve operasyon sinyallerini izlemek
- yetki sınırları içinde kontrollü işlem yapmak

Bu projede yönetim panelinin temel amacı:

**operasyon ekibinin günlük işini hızlandırmak, hata riskini azaltmak ve sistem üzerinde kontrollü görünürlük sağlamaktır.**

---

## 2. Yönetim Panelinin Temel Rolü

İlk faz için admin panel şu 5 ana rolü taşımalıdır:

1. **Operasyon Merkezi**
2. **Katalog Yönetim Merkezi**
3. **Müşteri ve Teklif Takip Merkezi**
4. **İçerik ve Vitrin Yönetim Alanı**
5. **Sistem Kontrol ve İzleme Alanı**

### 2.1 Operasyon Merkezi

Burada temel odak teklif talepleridir.

Admin kullanıcı şunları hızlı görebilmelidir:

- bugün gelen talepler
- bekleyen teklifler
- cevap bekleyen işler
- ek bilgi bekleyen teklifler
- son işlem gören kayıtlar

### 2.2 Katalog Yönetim Merkezi

Bu alan ürünlerin yalnızca eklenmesini değil, kalite ve görünürlük kontrolünü de kapsar.

### 2.3 Müşteri ve Teklif Takip Merkezi

Bu alan müşteri hesabı, misafir teklif sahibi, teklif geçmişi ve müşteri etkileşim takibi için önemlidir.

### 2.4 İçerik ve Vitrin Yönetim Alanı

Ana sayfa blokları, sabit sayfalar, medya ve e-posta şablonları bu kapsamdadır.

### 2.5 Sistem Kontrol ve İzleme Alanı

Loglar, hata sinyalleri, temel sistem araçları ve operasyonel görünürlük burada toplanmalıdır.

---

## 3. Admin Panel Bilgi Mimarisi Özeti

Önceki bilgi mimarisi kararlarıyla uyumlu olarak admin panel ana navigasyonu modül grupları halinde ilerlemelidir.

### 3.1 Ana grup yapısı

- **Operasyon**
- **Katalog**
- **Müşteriler**
- **İçerik**
- **Sistem**

### 3.2 İlk faz ana modüller

#### Operasyon

- Dashboard
- Teklif Talepleri
- Müşteriler

#### Katalog

- Ürünler
- Kategoriler
- Markalar
- Kullanım Alanları
- Teknik Özellik Şablonları

#### İçerik

- İçerik Yönetimi
- Ana Sayfa / Vitrin
- Medya Yönetimi
- E-posta Şablonları

#### Sistem

- Genel Ayarlar
- Form ve Talep Ayarları
- Yönetici Kullanıcılar
- Rol / İzin Yönetimi
- Loglar
- Sistem Araçları

---

## 4. Admin Dashboard Yaklaşımı

Admin dashboard ilk fazda “güzel görünen ama işe yaramayan” bir ekran olmamalıdır. İlk bakışta operasyonel durum anlaşılmalıdır.

### 4.1 Dashboard’un cevaplaması gereken temel sorular

- bugün kaç teklif geldi?
- hangileri bekliyor?
- hangileri cevaplandı?
- hangi kayıtlar aksiyon bekliyor?
- katalogda dikkat gerektiren veri eksikleri var mı?
- son operasyon hareketleri neler?

### 4.2 İlk faz dashboard blokları

- toplam teklif sayısı
- bekleyen teklif sayısı
- cevaplanan teklif sayısı
- bugün gelen talepler
- son 7 gün teklif grafiği
- teklif durum dağılımı
- son teklif hareketleri
- dikkat gerektiren işler
- kalite / eksik veri uyarıları

### 4.3 Dashboard tasarım yaklaşımı

- üstte KPI kartları
- ortada grafik ve durum dağılımı
- altta son hareketler ve aksiyon gerektiren kayıtlar
- sade ama bilgi yoğun yapı

---

## 5. Teklif Operasyonu Modülü

Bu proje teklif odaklı olduğu için admin panelin merkezi modülü teklif yönetimidir.

### 5.1 Teklif listesi amacı

- gelen talepleri görmek
- filtrelemek
- durumlarını yönetmek
- detaya hızlı geçmek
- operasyon akışını aksatmadan yürütmek

### 5.2 İlk faz teklif listesinde temel sütunlar

- teklif numarası
- müşteri adı / firma adı
- kullanıcı tipi (misafir / üye)
- tarih
- durum
- ürün sayısı
- son işlem tarihi
- aksiyonlar

### 5.3 İlk faz filtreleri

- durum
- kullanıcı tipi
- tarih aralığı
- teklif numarası
- müşteri / firma adı

### 5.4 Teklif detay ekranında olması gerekenler

- teklif üst bilgisi
- müşteri bilgileri
- teklif satırları
- her satır için adet
- admin fiyat / termin / not girişi
- durum geçmişi
- iç notlar
- e-posta gönderim özeti

### 5.5 Operasyonel hedef

Admin bir teklif üzerinde çalışırken ekrana dağılmamalı; tüm kritik bağlam aynı akış içinde görünmelidir.

---

## 6. Katalog Operasyonları

Katalog modülleri yalnızca CRUD ekranı gibi düşünülmemelidir. Yönetim paneli katalog kalitesini de yönetmelidir.

### 6.1 Ürün yönetimi

Ürün modülü şunları desteklemelidir:

- ürün oluşturma
- ürün düzenleme
- aktif / pasif yönetimi
- arşiv akışı
- teknik özellik yönetimi
- kullanım alanı ilişkisi
- görsel yönetimi
- görünürlük parametreleri

### 6.2 Kategori / marka / kullanım alanı yönetimi

Bu modüller:

- sade ama güçlü liste ekranlarıyla çalışmalı
- aktif/pasif durumu desteklemeli
- sıralama ve görünürlük mantığı taşımalı
- ürünlerle ilişkili etkileri kontrollü göstermelidir

### 6.3 Teknik özellik şablonları

Bu modül veri kalitesinin omurgasıdır.

- kategoriye bağlı şablonlar
- alan tanımları
- filtrelenebilir alan mantığı
- ürün detay ve liste görünürlüğü

### 6.4 Katalog kalite sinyalleri

İlk fazda hafif ama değerli kalite işaretleri düşünülmelidir.
Örnek:

- ana görsel eksik
- teknik alan eksik
- kullanım alanı boş
- görünürlük parametresi çelişkili

---

## 7. Müşteri ve Hesap Yönetimi

Admin panel müşteri listesine yalnızca hesap listesi gibi bakmamalıdır; müşteri bağlamı teklif geçmişiyle birlikte anlaşılmalıdır.

### 7.1 Müşteri listesinde temel alanlar

- ad soyad
- firma adı
- e-posta
- telefon
- kullanıcı tipi / üyelik durumu
- son teklif tarihi
- toplam teklif sayısı
- son etkileşim tarihi

### 7.2 Müşteri detayında görülebilecek alanlar

- temel profil bilgileri
- şirket bilgileri
- teklif geçmişi
- notlar
- kullanıcı durumu
- doğrulama durumu

### 7.3 Misafir ve üye ayrımı

Admin ekranında misafir teklif sahipleri ile üye müşteriler karışmamalı; ama aynı operasyon akışında anlamlı biçimde görülebilmelidir.

---

## 8. İçerik, Vitrin ve İletişim Yönetimi

İlk fazda admin panel yalnızca operasyon değil, vitrinsel kontrol de sağlamalıdır.

### 8.1 İçerik yönetimi

- sabit sayfalar
- kurumsal içerikler
- iletişim alanları
- temel metin blokları

### 8.2 Ana sayfa / vitrin yönetimi

- öne çıkan kategoriler
- öne çıkan ürünler
- blok sıraları
- CTA alanları
- güven blokları

### 8.3 Medya yönetimi

- ürün görselleri
- banner görselleri
- medya seçimi
- güvenli yükleme ve düzenli listeleme

### 8.4 E-posta şablonları

- teklif alındı
- admin bildirim
- teklif cevabı
- konu başlığı ve içerik yönetimi

---

## 9. Sistem Yönetimi ve Operasyonel Kontrol

Bu alan yalnızca teknik ayarlar değil, kontrollü işletim görünürlüğü de sağlamalıdır.

### 9.1 Genel ayarlar

- site adı
- temel iletişim bilgileri
- logo / favicon
- mail ayarları
- görünürlük parametreleri

### 9.2 Form ve talep ayarları

- teklif form alanları
- zorunlu alanlar
- bildirim alıcıları
- misafir teklif davranışı

### 9.3 Yönetici kullanıcılar

- admin kullanıcı listesi
- rol atama
- aktif / pasif durumu
- son giriş bilgisi

### 9.4 Rol / izin yönetimi

- rol tanımları
- ekran bazlı yetkiler
- işlem bazlı izinler

### 9.5 Loglar ve sistem araçları

- admin giriş logları
- kritik işlem logları
- e-posta logları
- hata sinyalleri
- temel sağlık kontrol göstergeleri

---

## 10. Admin UX İlkeleri

Admin panelin başarısı görsel şıklıkla değil, operasyon hızını artırmasıyla ölçülmelidir.

### 10.1 Temel ilkeler

- ilk bakışta durum anlaşılmalı
- yoğun veri katmanlı ama sade sunulmalı
- kritik aksiyonlar korunmalı
- aynı işlem kalıpları tutarlı çalışmalı
- filtre ve liste ekranları boğucu olmamalı
- formlar bölüm section mantığıyla ilerlemeli

### 10.2 Hızlı aksiyon yaklaşımı

Admin panelde kullanıcıyı detay sayfalar arasında kaybetmeden çalıştıran kısa yol aksiyonları bulunmalıdır. Ancak ilk fazda aşırı aksiyon kalabalığı oluşturulmamalıdır.

### 10.3 Boş durum ve hata durumları

- boş ekranlar yönlendirme içermeli
- hata mesajları ham teknik içerik göstermemeli
- operasyonel hatalar açıklayıcı ama kontrollü olmalı

---

## 11. Responsive Admin Yaklaşımı

Admin panel masaüstü öncelikli olacaktır; ancak tablet ve mobilde temel izleme ve hafif düzenleme mümkün olmalıdır.

### İlk faz responsive hedefi

- masaüstünde tam verimli kullanım
- tablette yönetilebilir görünüm
- mobilde temel izleme + hafif işlem

### Mobilde öncelikli admin işlemleri

- dashboard özetlerini görmek
- teklif detayını incelemek
- teklif durumunu güncellemek
- kısa not eklemek

### Mobilde ikinci planda kalacak işlemler

- uzun ürün formları
- yoğun tablo operasyonları
- kapsamlı toplu işlemler

---

## 12. Güvenlik ve Yetki Bağlamı

Yönetim paneli tarafında güvenlik yalnızca giriş ekranıyla sınırlı değildir.

### İlk faz minimum korumalar

- ayrı admin giriş alanı
- güçlü parola kuralları
- rol ve izin kontrolü
- kritik işlemler için onay adımı
- admin giriş ve işlem logları

### Kritik işlem örnekleri

- rol değiştirme
- sistem ayarı güncelleme
- ürün arşivleme / kalıcı silme
- görünürlük parametresi değiştirme
- teklif iptal / kapatma

---

## 13. Performans ve Operasyon Verimliliği

Admin panelde performans; hız kadar operasyon akıcılığı anlamına gelir.

### İlk faz ilkeleri

- dashboard tüm ağır veriyi aynı anda yüklememeli
- büyük listelerde sayfalama zorunlu olmalı
- filtreleme indeks dostu düşünülmeli
- tablo ve form ekranları gereksiz veri taşımamalı
- yoğun işler mümkünse arka plan süreçleriyle desteklenmeli

---

## 14. İlk Faz İçin Netleşmesi Gereken Kararlar

Bu bölüm sohbet ilerledikçe birlikte doldurulacaktır.

### 14.1 Dashboard öncelik sırası

- hangi KPI’lar en üstte olacak?
- hangi grafikler ilk fazda gerçekten gerekli?
- hangi uyarılar dashboard’da görünmeli?

### 14.2 Teklif operasyonu davranışları

- teklif detayında satır bazlı cevap akışı nasıl netleşecek?
- kısmi cevap izinleri nasıl yönetilecek?
- admin iç not yapısı ilk fazda ne kadar açık olacak?

### 14.3 Katalog kalite sinyalleri

- ilk fazda hangi eksik veri uyarıları görünür olacak?
- bunlar satır seviyesinde mi, dashboard seviyesinde mi gösterilecek?

### 14.4 Sistem araçları kapsamı

- ilk fazda sistem araçları ekranı ne kadar derine inmeli?
- sağlık kontrolünde hangi sinyaller görünmeli?

---

## 15. Geçici Sonuç

İlk faz için yönetim paneli yaklaşımı şu omurgaya dayanacaktır:

- teklif operasyonu merkezde olacak
- katalog yönetimi kalite odaklı ilerleyecek
- müşteri ve içerik yönetimi sade ama işlevsel tutulacak
- sistem görünürlüğü ilk fazda kontrollü ama anlamlı seviyede kurulacak
- admin UX’i hız, tutarlılık ve düşük hata riski üzerine kurulacak

---

## 16. Görsel ve Operasyonel Karar Standardı

Bu maddeden sonraki tüm alt kararlarda aşağıdaki standarda uyulacaktır:

### 16.1 Görsel tarafta beklenti

- modern admin dashboard dili
- net başlık hiyerarşisi
- kart tabanlı özet bloklar
- tablo ve filtrelerde temiz yoğunluk dengesi
- form ekranlarında section bazlı düzen
- aksiyonların görsel öncelik sırasının açık olması

### 16.2 Operasyon tarafında beklenti

- admin kullanıcı ilk bakışta nerede olduğunu anlamalı
- kritik kayıtlar saklanmamalı, görünür olmalı
- sık yapılan işler mümkün olduğunca kısa adımla tamamlanmalı
- detay ekranında bağlam kaybı yaşanmamalı
- aynı iş kalıbı farklı modüllerde benzer davranmalı

### 16.3 Mimari tarafta beklenti

- modüller arası sınırlar net olmalı
- liste, detay, form ve ayar ekranı kalıpları tekrarlanabilir olmalı
- permission yapısı sonradan kırılmayacak şekilde düşünülmeli
- responsive kırılımlar sonradan sorun çıkarmayacak sadelikte kurulmalı
- ilk faz kararları gelecekte genişlemeye uygun olmalı

### 16.4 Son karar prensibi

Bir bileşen veya ekran için seçim yapılırken:

- tema referansına uyuyor ama operasyonu zayıflatıyorsa reddedilir
- güçlü görünüyor ama mimariyi karmaşıklaştırıyorsa sadeleştirilir
- çok kullanışlı ama görsel hiyerarşiyi bozuyorsa yeniden düzenlenir
- ilk faz için ağırsa sonraki faza taşınır

Yani her karar hem tasarım hem kullanım hem mimari süzgecinden geçerek verilecektir.

---

## 17. Sohbette Netleştirilecek Sonraki Alt Başlıklar

Bu dokümanı birlikte geliştirirken sırayla şunları netleştirebiliriz:

1. Dashboard kartları ve uyarı yapısı
2. Teklif operasyon ekranı ve detay akışı
3. Katalog kalite kontrol sinyalleri
4. Yönetici kullanıcılar / rol-izin ekranlarının kapsamı
5. Sistem araçları ve operasyonel görünürlük seviyesi

