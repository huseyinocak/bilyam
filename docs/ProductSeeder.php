<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // urunler.index içindeki 24 ürün – başlık, ölçü-tür, fiyat ve görsel yoları
        // TR fiyat biçimlerinden arındırıp decimal'e çevrildi.
        $products = [
            ['name' => 'Taş Ocağı Ağır Yük Rulmanı', 'slug' => 'tas-ocagi-agir-yuk-rulmani', 'category_slug' => 'stone-quarry', 'price' => 2850.00, 'specs' => ['size' => '120x260x86mm', 'type' => 'Spherical Roller'], 'image' => 'images/resources/stone-quarry-bearings.png'],
            ['name' => 'Taş Ocağı Konik Rulman', 'slug' => 'tas-ocagi-konik-rulman', 'category_slug' => 'stone-quarry', 'price' => 1650.00, 'specs' => ['size' => '100x215x56mm', 'type' => 'Tapered Roller'], 'image' => 'images/resources/stone-quarry-bearings.png'],
            ['name' => 'Konkasör Makaralı Rulman', 'slug' => 'konkasor-makarali-rulman', 'category_slug' => 'crusher', 'price' => 3200.00, 'specs' => ['size' => '110x240x80mm', 'type' => 'Cylindrical Roller'], 'image' => 'images/resources/crusher-bearings.png'],
            ['name' => 'Kırıcı Bilyalı Rulman', 'slug' => 'kirici-bilyali-rulman', 'category_slug' => 'crusher', 'price' => 890.00, 'specs' => ['size' => '90x190x43mm', 'type' => 'Deep Groove Ball'], 'image' => 'images/resources/crusher-bearings.png'],
            ['name' => 'Traktör Rulmanı', 'slug' => 'traktor-rulmani', 'category_slug' => 'agricultural', 'price' => 345.00, 'specs' => ['size' => '50x110x27mm', 'type' => 'Angular Contact'], 'image' => 'images/resources/agricultural-bearings.png'],
            ['name' => 'Biçerdöver Rulmanı', 'slug' => 'bicerdöver-rulmani', 'category_slug' => 'agricultural', 'price' => 425.00, 'specs' => ['size' => '60x130x31mm', 'type' => 'Self-Aligning Ball'], 'image' => 'images/resources/agricultural-bearings.png'],
            ['name' => 'Ekstrüder Rulmanı', 'slug' => 'ekstruder-rulmani', 'category_slug' => 'plastic', 'price' => 650.00, 'specs' => ['size' => '40x90x23mm', 'type' => 'High Temperature'], 'image' => 'images/resources/plastic-factory-bearings.png'],
            ['name' => 'Enjeksiyon Makinesi Rulmanı', 'slug' => 'enjeksiyon-makinesi-rulmani', 'category_slug' => 'plastic', 'price' => 520.00, 'specs' => ['size' => '35x80x21mm', 'type' => 'Precision Ball'], 'image' => 'images/resources/plastic-factory-bearings.png'],
            ['name' => 'Yağ Keçesi Seti', 'slug' => 'yag-kecesi-seti', 'category_slug' => 'seals', 'price' => 125.00, 'specs' => ['size' => 'Çok Boy', 'type' => 'Nitrile Rubber'], 'image' => 'images/resources/seals-couplings.png'],
            ['name' => 'Esnek Kaplin', 'slug' => 'esnek-kaplin', 'category_slug' => 'seals', 'price' => 380.00, 'specs' => ['size' => '45mm', 'type' => 'Jaw Coupling'], 'image' => 'images/resources/seals-couplings.png'],
            ['name' => 'Klasik V Kayışı', 'slug' => 'klasik-v-kayisi', 'category_slug' => 'v-belts', 'price' => 85.00, 'specs' => ['size' => 'A-60', 'type' => 'Rubber Compound'], 'image' => 'images/resources/v-belts.png'],
            ['name' => 'Narrow V Kayışı', 'slug' => 'narrow-v-kayisi', 'category_slug' => 'v-belts', 'price' => 145.00, 'specs' => ['size' => 'SPZ-1200', 'type' => 'High Strength'], 'image' => 'images/resources/v-belts.png'],
            ['name' => 'Bronz Burç', 'slug' => 'bronz-burc', 'category_slug' => 'bushings', 'price' => 195.00, 'specs' => ['size' => '50x60x50mm', 'type' => 'CuSn8'], 'image' => 'images/resources/bushings.png'],
            ['name' => 'Kendinden Yağlamalı Burç', 'slug' => 'kendinden-yaglamali-burc', 'category_slug' => 'bushings', 'price' => 285.00, 'specs' => ['size' => '40x50x40mm', 'type' => 'Oilite Bronze'], 'image' => 'images/resources/bushings.png'],
            ['name' => 'Hidrolik Filtre', 'slug' => 'hidrolik-filtre', 'category_slug' => 'filters', 'price' => 165.00, 'specs' => ['size' => '10 Micron', 'type' => '100 L/min'], 'image' => 'images/resources/industrial-filters.png'],
            ['name' => 'Hava Filtresi', 'slug' => 'hava-filtresi', 'category_slug' => 'filters', 'price' => 95.00, 'specs' => ['size' => 'M6', 'type' => '592x592x50mm'], 'image' => 'images/resources/industrial-filters.png'],
            ['name' => 'Poliüretan Teker', 'slug' => 'poliüretan-teker', 'category_slug' => 'wheels', 'price' => 425.00, 'specs' => ['size' => '200x50mm', 'type' => '500kg Kapasite'], 'image' => 'images/resources/industrial-wheels.png'],
            ['name' => 'Çelik Teker', 'slug' => 'celik-teker', 'category_slug' => 'wheels', 'price' => 650.00, 'specs' => ['size' => '150x50mm', 'type' => '1000kg Kapasite'], 'image' => 'images/resources/industrial-wheels.png'],
            ['name' => 'Pillow Block Yatak', 'slug' => 'pillow-block-yatak', 'category_slug' => 'housings', 'price' => 485.00, 'specs' => ['size' => 'UC-210', 'type' => 'Cast Iron'], 'image' => 'images/resources/bearing-housings.png'],
            ['name' => 'Flanşlı Yatak', 'slug' => 'flansli-yatak', 'category_slug' => 'housings', 'price' => 750.00, 'specs' => ['size' => 'UCF-208', 'type' => 'Stainless Steel'], 'image' => 'images/resources/bearing-housings.png'],
            ['name' => 'Toptan Bilyalı Rulman Seti', 'slug' => 'toptan-bilyali-rulman-seti', 'category_slug' => 'wholesale-bearings', 'price' => 1250.00, 'specs' => ['size' => '6200-6210', 'type' => '10 Adet'], 'image' => 'images/resources/bearing-collection.png'],
            ['name' => 'Toptan Konik Rulman Seti', 'slug' => 'toptan-konik-rulman-seti', 'category_slug' => 'wholesale-bearings', 'price' => 2850.00, 'specs' => ['size' => '30202-30210', 'type' => '10 Adet'], 'image' => 'images/resources/bearing-collection.png'],
            ['name' => 'Krom Bilya Seti', 'slug' => 'krom-bilya-seti', 'category_slug' => 'balls', 'price' => 850.00, 'specs' => ['size' => '3-20mm', 'type' => 'GCr15 - 1000 Adet'], 'image' => 'images/resources/bearing-collection.png'],
            ['name' => 'Paslanmaz Bilya Seti', 'slug' => 'paslanmaz-bilya-seti', 'category_slug' => 'balls', 'price' => 1450.00, 'specs' => ['size' => '5-25mm', 'type' => 'AISI 440C - 500 Adet'], 'image' => 'images/resources/bearing-collection.png'],
        ];

        foreach ($products as $p) {
            $category = Category::where('slug', $p['category_slug'])->first();
            if (!$category) {
                continue;
            }

            $product = Product::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'category_id' => $category->id,
                    'brand_id' => null,                 // şu an marka yok -> ileride eklenecek
                    'name' => $p['name'],
                    'sku' => null,
                    'short_description' => $p['specs']['type'] ?? null,
                    'description' => null,
                    'specs' => $p['specs'],
                    'condition' => 'new',
                    'price' => $p['price'],
                    'stock_qty' => 0,
                    'is_active' => true,
                ]
            );

            // Kapak görseli
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'path' => $p['image']],
                ['alt_text' => $p['name'], 'is_primary' => true, 'sort_order' => 0]
            );
        }
    }
}
