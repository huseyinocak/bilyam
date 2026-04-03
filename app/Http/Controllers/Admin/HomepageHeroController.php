<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateHomepageHeroRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomepageHeroController extends Controller
{
    public function edit(): View
    {
        $static = Setting::getValue('homepage.hero.static', [
            'eyebrow' => 'Endüstriyel Teknik Ürün Tedariği',
            'title' => 'Doğru rulman ve teknik ürünleri hızla bulun, teklifinizi kısa sürede alın.',
            'description' => 'Taş ocağı, konkasör, tarım makineleri, filtre, sanayi tekeri ve yardımcı ürün gruplarında geniş katalog, hızlı teklif ve güvenilir operasyon akışı.',
            'primary_cta_label' => 'Kataloğu İncele',
            'primary_cta_url' => '/products',
            'secondary_cta_label' => 'Teklif Oluştur',
            'secondary_cta_url' => '/quote-list',
            'support_items' => [
                'Kategori bazlı ürün keşfi',
                'Tek seferde çoklu teklif talebi',
                'Takip edilebilir operasyon',
            ],
        ]);

        return view('admin.settings.homepage-hero', [
            'heroMode' => Setting::getValue('homepage.hero.mode', 'static'),
            'staticHero' => $static,
            'slides' => Setting::getValue('homepage.hero.slides', []),
            'products' => Product::query()->where('is_active', true)->orderBy('name')->get(),
            'categories' => Category::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateHomepageHeroRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Setting::putValue('homepage.hero.mode', 'string', $data['hero_mode'], 'homepage');
        Setting::putValue('homepage.hero.static', 'json', [
            'eyebrow' => $data['static']['eyebrow'],
            'title' => $data['static']['title'],
            'description' => $data['static']['description'],
            'primary_cta_label' => $data['static']['primary_cta_label'],
            'primary_cta_url' => $data['static']['primary_cta_url'],
            'secondary_cta_label' => $data['static']['secondary_cta_label'] ?? null,
            'secondary_cta_url' => $data['static']['secondary_cta_url'] ?? null,
            'support_items' => collect($data['static']['support_items'] ?? [])->filter()->values()->all(),
        ], 'homepage');

        $slides = collect($data['slides'] ?? [])
            ->filter(fn (array $slide) => filled($slide['type'] ?? null))
            ->sortBy('sort_order')
            ->values()
            ->map(function (array $slide) {
                return [
                    'type' => $slide['type'],
                    'id' => $slide['type'] === 'product' ? (int) $slide['product_id'] : (int) $slide['category_id'],
                    'eyebrow' => $slide['eyebrow'] ?? null,
                    'title_override' => $slide['title_override'] ?? null,
                    'description_override' => $slide['description_override'] ?? null,
                    'primary_cta_label' => $slide['primary_cta_label'] ?? null,
                    'primary_cta_url' => $slide['primary_cta_url'] ?? null,
                    'secondary_cta_label' => $slide['secondary_cta_label'] ?? null,
                    'secondary_cta_url' => $slide['secondary_cta_url'] ?? null,
                    'sort_order' => (int) ($slide['sort_order'] ?? 0),
                    'is_active' => (bool) ($slide['is_active'] ?? false),
                ];
            })
            ->all();

        Setting::putValue('homepage.hero.slides', 'json', $slides, 'homepage');

        ActivityLogger::log('settings.homepage.hero.updated', null, [
            'hero_mode' => $data['hero_mode'],
            'slide_count' => count($slides),
        ], $request->user()?->id, $request, 'app');

        return back()->with('status', 'Anasayfa hero ayarları güncellendi.');
    }
}
