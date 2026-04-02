<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $content = implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin',
            'Disallow: /dashboard',
            'Disallow: /account',
            'Disallow: /login',
            'Disallow: /register',
            'Disallow: /quote-list',
            'Sitemap: '.route('sitemap', absolute: true),
        ]);

        return response($content, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    public function sitemap(): Response
    {
        $urls = collect([
            [
                'loc' => route('home', absolute: true),
                'lastmod' => now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
            [
                'loc' => route('products.index', absolute: true),
                'lastmod' => now()->toDateString(),
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
        ])
            ->merge(Category::query()->where('is_active', true)->get()->map(fn (Category $category) => [
                'loc' => route('categories.show', $category, absolute: true),
                'lastmod' => optional($category->updated_at)->toDateString() ?: now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ]))
            ->merge(Product::query()->where('is_active', true)->where('visibility_mode', 'public')->get()->map(fn (Product $product) => [
                'loc' => route('products.show', $product, absolute: true),
                'lastmod' => optional($product->updated_at)->toDateString() ?: now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ]));

        $xml = View::make('seo.sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
