<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpecificationValue;
use App\Models\SpecificationField;
use App\Models\SpecificationTemplate;
use App\Models\UseCase;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tas Ocagi Rulmanlari', 'slug' => 'stone-quarry', 'description' => 'Kirma eleme, konveyor ve agir yuk tasiyan saha uygulamalari icin rulman grubu.'],
            ['name' => 'Konkasor Kirici Rulmanlari', 'slug' => 'crusher', 'description' => 'Yuksek darbeli kirici ve konkasor hatlarina uygun dayanikli rulmanlar.'],
            ['name' => 'Tarim Makineleri Rulmanlari', 'slug' => 'agricultural', 'description' => 'Traktor, bicerdöver ve tarim ekipmanlari icin hareket aktarim urunleri.'],
            ['name' => 'Plastik Fabrikasi Rulmanlari', 'slug' => 'plastic', 'description' => 'Ekstruder ve enjeksiyon hatlari icin hassas ve yuksek sicaklik dayanimli urunler.'],
            ['name' => 'Rulman Kece Kaplin Kasnak', 'slug' => 'seals', 'description' => 'Kece, kaplin ve baglanti elemanlari icin tamamlayici urun grubu.'],
            ['name' => 'V Kayis', 'slug' => 'v-belts', 'description' => 'Klasik ve dar kesitli kayis uygulamalari icin urun grubu.'],
            ['name' => 'Burclar', 'slug' => 'bushings', 'description' => 'Asinma yuzeyleri ve yataklama uygulamalari icin burc cesitleri.'],
            ['name' => 'Toptan Filtre', 'slug' => 'filters', 'description' => 'Hidrolik ve hava filtrasyon ihtiyaclari icin endustriyel filtreler.'],
            ['name' => 'Sanayi Tekerleri', 'slug' => 'wheels', 'description' => 'Tasima, platform ve saha arabasi uygulamalari icin sanayi tekerleri.'],
            ['name' => 'Rulman Yataklari', 'slug' => 'housings', 'description' => 'Pillow block ve flansli yatak cozumleri.'],
            ['name' => 'Toptan Rulman', 'slug' => 'wholesale-bearings', 'description' => 'Toplu alim operasyonlari icin set ve koliler.'],
            ['name' => 'Toptan Bilya', 'slug' => 'balls', 'description' => 'Krom ve paslanmaz celik bilya setleri.'],
        ];

        foreach ($categories as $index => $data) {
            Category::updateOrCreate(
                ['slug' => $data['slug']],
                $data + ['is_active' => true, 'sort_order' => $index + 1]
            );
        }

        $brands = [
            ['name' => 'Bilyam Pro', 'slug' => 'bilyam-pro', 'description' => 'Genel endustri ve saha uygulamalari icin ana marka.'],
            ['name' => 'TorqueLine', 'slug' => 'torqueline', 'description' => 'Agir yuk ve yuksek dayanim beklentisi olan urunler.'],
            ['name' => 'AgroMotion', 'slug' => 'agromotion', 'description' => 'Tarim makinesi ve mobil ekipman odakli urunler.'],
            ['name' => 'PolyFlow', 'slug' => 'polyflow', 'description' => 'Plastik ve proses hatlarina uygun hassas urunler.'],
            ['name' => 'SteelTrack', 'slug' => 'steeltrack', 'description' => 'Tasima, teker ve yatak cozumlerinde kullanilan urun grubu.'],
        ];

        foreach ($brands as $data) {
            Brand::updateOrCreate(['slug' => $data['slug']], $data + ['is_active' => true]);
        }

        $useCases = [
            ['name' => 'Kirici Hatlari', 'slug' => 'kirici-hatlari', 'description' => 'Tas ocagi ve kirma eleme hatlari.'],
            ['name' => 'Konveyor Sistemleri', 'slug' => 'konveyor-sistemleri', 'description' => 'Aktarma ve tasima hatlari.'],
            ['name' => 'Tarim Ekipmanlari', 'slug' => 'tarim-ekipmanlari', 'description' => 'Tarim makineleri ve mobil araclar.'],
            ['name' => 'Plastik Uretim Hatlari', 'slug' => 'plastik-uretim-hatlari', 'description' => 'Ekstruder ve enjeksiyon prosesleri.'],
            ['name' => 'Bakim Onarim', 'slug' => 'bakim-onarim', 'description' => 'Planli bakim ve yedek parca talepleri.'],
            ['name' => 'Toplu Satin Alma', 'slug' => 'toplu-satin-alma', 'description' => 'Dusen birim maliyet hedefli toplu tedarik.'],
        ];

        foreach ($useCases as $data) {
            UseCase::updateOrCreate(['slug' => $data['slug']], $data + ['is_active' => true]);
        }

        $templateMap = [];

        foreach (Category::all() as $category) {
            $template = SpecificationTemplate::updateOrCreate(
                ['slug' => $category->slug.'-template'],
                [
                    'category_id' => $category->id,
                    'name' => $category->name.' Teknik Ozellikleri',
                    'description' => $category->name.' kategorisi icin temel teknik alanlar.',
                    'is_active' => true,
                ]
            );

            $fields = [
                ['name' => 'Olcu', 'key' => 'size', 'field_type' => 'text', 'is_filterable' => true],
                ['name' => 'Tur', 'key' => 'type', 'field_type' => 'text', 'is_filterable' => true],
            ];

            foreach ($fields as $sort => $field) {
                $record = SpecificationField::updateOrCreate(
                    ['specification_template_id' => $template->id, 'key' => $field['key']],
                    $field + ['sort_order' => $sort + 1, 'is_required' => false]
                );

                $templateMap[$category->slug][$field['key']] = $record->id;
            }
        }

        $products = [
            ['name' => 'Tas Ocagi Agir Yuk Rulmani', 'slug' => 'tas-ocagi-agir-yuk-rulmani', 'category_slug' => 'stone-quarry', 'price' => 2850.00, 'specs' => ['size' => '120x260x86 mm', 'type' => 'Spherical Roller'], 'image' => 'images/resources/stone-quarry-bearings.png'],
            ['name' => 'Tas Ocagi Konik Rulman', 'slug' => 'tas-ocagi-konik-rulman', 'category_slug' => 'stone-quarry', 'price' => 1650.00, 'specs' => ['size' => '100x215x56 mm', 'type' => 'Tapered Roller'], 'image' => 'images/resources/stone-quarry-bearings.png'],
            ['name' => 'Konkasor Makarali Rulman', 'slug' => 'konkasor-makarali-rulman', 'category_slug' => 'crusher', 'price' => 3200.00, 'specs' => ['size' => '110x240x80 mm', 'type' => 'Cylindrical Roller'], 'image' => 'images/resources/crusher-bearings.png'],
            ['name' => 'Kirici Bilyali Rulman', 'slug' => 'kirici-bilyali-rulman', 'category_slug' => 'crusher', 'price' => 890.00, 'specs' => ['size' => '90x190x43 mm', 'type' => 'Deep Groove Ball'], 'image' => 'images/resources/crusher-bearings.png'],
            ['name' => 'Traktor Rulmani', 'slug' => 'traktor-rulmani', 'category_slug' => 'agricultural', 'price' => 345.00, 'specs' => ['size' => '50x110x27 mm', 'type' => 'Angular Contact'], 'image' => 'images/resources/agricultural-bearings.png'],
            ['name' => 'Bicerdöver Rulmani', 'slug' => 'bicerdover-rulmani', 'category_slug' => 'agricultural', 'price' => 425.00, 'specs' => ['size' => '60x130x31 mm', 'type' => 'Self-Aligning Ball'], 'image' => 'images/resources/agricultural-bearings.png'],
            ['name' => 'Ekstruder Rulmani', 'slug' => 'ekstruder-rulmani', 'category_slug' => 'plastic', 'price' => 650.00, 'specs' => ['size' => '40x90x23 mm', 'type' => 'High Temperature'], 'image' => 'images/resources/plastic-factory-bearings.png'],
            ['name' => 'Enjeksiyon Makinesi Rulmani', 'slug' => 'enjeksiyon-makinesi-rulmani', 'category_slug' => 'plastic', 'price' => 520.00, 'specs' => ['size' => '35x80x21 mm', 'type' => 'Precision Ball'], 'image' => 'images/resources/plastic-factory-bearings.png'],
            ['name' => 'Yag Kecesi Seti', 'slug' => 'yag-kecesi-seti', 'category_slug' => 'seals', 'price' => 125.00, 'specs' => ['size' => 'Cok Boy', 'type' => 'Nitrile Rubber'], 'image' => 'images/resources/seals-couplings.png'],
            ['name' => 'Esnek Kaplin', 'slug' => 'esnek-kaplin', 'category_slug' => 'seals', 'price' => 380.00, 'specs' => ['size' => '45 mm', 'type' => 'Jaw Coupling'], 'image' => 'images/resources/seals-couplings.png'],
            ['name' => 'Klasik V Kayisi', 'slug' => 'klasik-v-kayisi', 'category_slug' => 'v-belts', 'price' => 85.00, 'specs' => ['size' => 'A-60', 'type' => 'Rubber Compound'], 'image' => 'images/resources/v-belts.png'],
            ['name' => 'Narrow V Kayisi', 'slug' => 'narrow-v-kayisi', 'category_slug' => 'v-belts', 'price' => 145.00, 'specs' => ['size' => 'SPZ-1200', 'type' => 'High Strength'], 'image' => 'images/resources/v-belts.png'],
            ['name' => 'Bronz Burc', 'slug' => 'bronz-burc', 'category_slug' => 'bushings', 'price' => 195.00, 'specs' => ['size' => '50x60x50 mm', 'type' => 'CuSn8'], 'image' => 'images/resources/bushings.png'],
            ['name' => 'Kendinden Yaglamali Burc', 'slug' => 'kendinden-yaglamali-burc', 'category_slug' => 'bushings', 'price' => 285.00, 'specs' => ['size' => '40x50x40 mm', 'type' => 'Oilite Bronze'], 'image' => 'images/resources/bushings.png'],
            ['name' => 'Hidrolik Filtre', 'slug' => 'hidrolik-filtre', 'category_slug' => 'filters', 'price' => 165.00, 'specs' => ['size' => '10 Micron', 'type' => '100 L/min'], 'image' => 'images/resources/industrial-filters.png'],
            ['name' => 'Hava Filtresi', 'slug' => 'hava-filtresi', 'category_slug' => 'filters', 'price' => 95.00, 'specs' => ['size' => '592x592x50 mm', 'type' => 'Panel Filtre'], 'image' => 'images/resources/industrial-filters.png'],
            ['name' => 'Poliuretan Teker', 'slug' => 'poliuretan-teker', 'category_slug' => 'wheels', 'price' => 425.00, 'specs' => ['size' => '200x50 mm', 'type' => '500 kg Kapasite'], 'image' => 'images/resources/industrial-wheels.png'],
            ['name' => 'Celik Teker', 'slug' => 'celik-teker', 'category_slug' => 'wheels', 'price' => 650.00, 'specs' => ['size' => '150x50 mm', 'type' => '1000 kg Kapasite'], 'image' => 'images/resources/industrial-wheels.png'],
            ['name' => 'Pillow Block Yatak', 'slug' => 'pillow-block-yatak', 'category_slug' => 'housings', 'price' => 485.00, 'specs' => ['size' => 'UC-210', 'type' => 'Cast Iron'], 'image' => 'images/resources/bearing-housings.png'],
            ['name' => 'Flansli Yatak', 'slug' => 'flansli-yatak', 'category_slug' => 'housings', 'price' => 750.00, 'specs' => ['size' => 'UCF-208', 'type' => 'Stainless Steel'], 'image' => 'images/resources/bearing-housings.png'],
            ['name' => 'Toptan Bilyali Rulman Seti', 'slug' => 'toptan-bilyali-rulman-seti', 'category_slug' => 'wholesale-bearings', 'price' => 1250.00, 'specs' => ['size' => '6200-6210', 'type' => '10 Adet'], 'image' => 'images/resources/bearing-collection.png'],
            ['name' => 'Toptan Konik Rulman Seti', 'slug' => 'toptan-konik-rulman-seti', 'category_slug' => 'wholesale-bearings', 'price' => 2850.00, 'specs' => ['size' => '30202-30210', 'type' => '10 Adet'], 'image' => 'images/resources/bearing-collection.png'],
            ['name' => 'Krom Bilya Seti', 'slug' => 'krom-bilya-seti', 'category_slug' => 'balls', 'price' => 850.00, 'specs' => ['size' => '3-20 mm', 'type' => 'GCr15 - 1000 Adet'], 'image' => 'images/resources/bearing-collection.png'],
            ['name' => 'Paslanmaz Bilya Seti', 'slug' => 'paslanmaz-bilya-seti', 'category_slug' => 'balls', 'price' => 1450.00, 'specs' => ['size' => '5-25 mm', 'type' => 'AISI 440C - 500 Adet'], 'image' => 'images/resources/bearing-collection.png'],
        ];

        $brandCycle = Brand::query()->orderBy('id')->get();
        $useCaseCycle = UseCase::query()->orderBy('id')->get();

        foreach ($products as $index => $item) {
            $category = Category::where('slug', $item['category_slug'])->first();

            if (! $category) {
                continue;
            }

            $brand = $brandCycle[$index % $brandCycle->count()];
            $code = 'BLY-'.str_pad((string) ($index + 101), 4, '0', STR_PAD_LEFT);

            $product = Product::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'name' => $item['name'],
                    'code' => $code,
                    'sales_mode' => 'quote',
                    'visibility_mode' => 'public',
                    'stock_status' => 'Temin edilebilir',
                    'price_currency' => 'TRY',
                    'price' => $item['price'],
                    'technical_summary' => $item['specs']['size'].' | '.$item['specs']['type'],
                    'short_description' => $item['specs']['type'],
                    'description' => $item['name'].' urunu, '.$category->name.' uygulamalari icin secilen teknik bir cozumdur. Toplu alim, yedek parca ve teklif operasyonlarina uygun olacak sekilde kataloglanmistir.',
                    'show_price' => true,
                    'show_stock' => false,
                    'is_featured' => $index < 8,
                    'is_active' => true,
                ]
            );

            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'path' => $item['image']],
                ['alt_text' => $item['name'], 'is_primary' => true, 'sort_order' => 0]
            );

            $product->useCases()->syncWithoutDetaching([
                $useCaseCycle[$index % $useCaseCycle->count()]->id,
                $useCaseCycle[($index + 1) % $useCaseCycle->count()]->id,
            ]);

            foreach ($item['specs'] as $key => $value) {
                $fieldId = $templateMap[$category->slug][$key] ?? null;

                if (! $fieldId) {
                    continue;
                }

                ProductSpecificationValue::updateOrCreate(
                    ['product_id' => $product->id, 'specification_field_id' => $fieldId],
                    ['value' => $value]
                );
            }
        }
    }
}
