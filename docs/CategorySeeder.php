<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // urunler.index filtre butonlarındaki kategoriler -> isim karşılıkları
        $categories = [
            ['name' => 'Taş Ocağı Rulmanları', 'slug' => 'stone-quarry', 'is_active' => true],
            ['name' => 'Konkasör Kırıcı Rulmanları', 'slug' => 'crusher', 'is_active' => true],
            ['name' => 'Tarım Makineleri Rulmanları', 'slug' => 'agricultural', 'is_active' => true],
            ['name' => 'Plastik Fabrikası Rulmanları', 'slug' => 'plastic', 'is_active' => true],
            ['name' => 'Rulman Keçe Kaplin Kasnak', 'slug' => 'seals', 'is_active' => true],
            ['name' => 'V Kayış', 'slug' => 'v-belts', 'is_active' => true],
            ['name' => 'Burçlar', 'slug' => 'bushings', 'is_active' => true],
            ['name' => 'Toptan Filtre', 'slug' => 'filters', 'is_active' => true],
            ['name' => 'Sanayi Tekerleri', 'slug' => 'wheels', 'is_active' => true],
            ['name' => 'Rulman Yatakları', 'slug' => 'housings', 'is_active' => true],
            ['name' => 'Toptan Rulman', 'slug' => 'wholesale-bearings', 'is_active' => true],
            ['name' => 'Toptan Bilya', 'slug' => 'balls', 'is_active' => true],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name'], 'is_active' => $cat['is_active']]
            );
        }
    }
}
