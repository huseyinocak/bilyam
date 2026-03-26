# Toptanbilya Ürün Kaynağı

## Amaç
Bu proje içinde demo/başlangıç veri modeli, kategori yapısı, ürün kartı içeriği ve görsel yerleşim mantığı için referans kaynak olarak Toptanbilya ürünler sayfası kullanılacaktır.

## Kaynak URL
https://toptanbilya.com/urunler

## Kullanım Kapsamı
Codex aşağıdaki alanlarda bu kaynağı referans alabilir:
- kategori isimleri
- ürün isimleri
- ürün kısa açıklama yapısı
- ürün kartı mantığı
- ürün detay sayfası kurgusu
- görsel kullanım senaryosu
- teklif iste akışı

## Uygulama Kuralları
1. Önce kaynak sayfadaki kategori yapısını temel al.
2. Ürünleri veri modeli olarak normalize et:
   - id
   - category_slug
   - name
   - slug
   - short_spec
   - price_text
   - image_url
   - source_url
3. Mümkünse scraping kodu ayrı bir import script içinde yaz.
4. Veriyi doğrudan rastgele koda gömmek yerine:
   - seed dosyası
   - json veri dosyası
   - import komutu
   yaklaşımlarından birini kullan.
5. Görseller için hotlink yapma; uygun ise indirilebilir asset pipeline kur veya source_url referansı sakla.
6. Kaynak veri değişebilir; sistem import edilebilir ve güncellenebilir tasarlansın.
7. Kaynak veriler ilk fazda referans/demo amaçlı kullanılacak; canlı üretim veri modeli bundan bağımsız genişleyebilir.

## Beklenen Çıktılar
- categories seed/data yapısı
- products seed/data yapısı
- görsel alanı olan ürün modeli
- ürün listeleme ve detay sayfaları
- teklif iste akışı için ürün seçimi desteği