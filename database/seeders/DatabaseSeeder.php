<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Demo Admin',
            'email' => 'admin@example.com',
        ]);

        $category = Category::query()->firstOrCreate(
            ['slug' => 'bilya'],
            ['name' => 'Bilya']
        );

        foreach ([
            ['name' => '6204 ZZ Rulman', 'sku' => '6204ZZ', 'short_spec' => 'Çift taraf metal kapaklı rulman'],
            ['name' => '6205 2RS Rulman', 'sku' => '62052RS', 'short_spec' => 'Çift taraf kauçuk kapaklı rulman'],
        ] as $product) {
            Product::query()->firstOrCreate(
                ['slug' => Str::slug($product['name'])],
                [
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'sku' => $product['sku'],
                    'short_spec' => $product['short_spec'],
                    'source_url' => 'https://toptanbilya.com/urunler',
                ]
            );
        }
    }
}
