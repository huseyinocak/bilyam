<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ImportToptanbilyaCatalog extends Command
{
    protected $signature = 'catalog:import-toptanbilya {--limit=200} {--from-json=database/data/toptanbilya_products.json}';

    protected $description = 'Import products from toptanbilya.com reference data (or local JSON fallback)';

    public function handle(): int
    {
        $rows = $this->loadFromWeb();

        if ($rows->isEmpty()) {
            $rows = $this->loadFromJson();
        }

        if ($rows->isEmpty()) {
            $this->error('No importable rows found from web or JSON source.');

            return self::FAILURE;
        }

        $limit = max(1, (int) $this->option('limit'));

        $rows->take($limit)->each(function (array $row): void {
            $categoryName = trim((string) ($row['category'] ?? 'Genel')) ?: 'Genel';
            $category = Category::query()->firstOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName]
            );

            $name = trim((string) ($row['name'] ?? 'Ürün'));

            Product::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'category_id' => $category->id,
                    'name' => $name,
                    'sku' => $row['sku'] ?? null,
                    'short_spec' => $row['short_spec'] ?? null,
                    'price_text' => $row['price_text'] ?? null,
                    'image_url' => $row['image_url'] ?? null,
                    'source_url' => $row['source_url'] ?? 'https://toptanbilya.com/urunler',
                    'quote_enabled' => true,
                    'is_active' => true,
                ]
            );
        });

        $this->info('Import completed.');

        return self::SUCCESS;
    }

    private function loadFromWeb()
    {
        try {
            $response = Http::timeout(20)->get('https://toptanbilya.com/urunler');
            if (! $response->ok()) {
                return collect();
            }

            preg_match_all('/<h3[^>]*>(.*?)<\/h3>/si', $response->body(), $matches);
            $names = collect($matches[1] ?? [])->map(fn ($raw) => trim(strip_tags(html_entity_decode($raw))))
                ->filter()
                ->unique()
                ->values();

            return $names->map(fn ($name) => [
                'category' => 'Toptanbilya',
                'name' => $name,
                'short_spec' => null,
                'price_text' => null,
                'image_url' => null,
                'source_url' => 'https://toptanbilya.com/urunler',
            ]);
        } catch (\Throwable) {
            return collect();
        }
    }

    private function loadFromJson()
    {
        $path = base_path((string) $this->option('from-json'));
        if (! is_file($path)) {
            return collect();
        }

        $payload = json_decode(file_get_contents($path), true);

        return collect($payload)->filter(fn ($row) => is_array($row) && ! empty($row['name']));
    }
}
