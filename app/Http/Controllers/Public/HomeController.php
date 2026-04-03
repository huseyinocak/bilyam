<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $heroMode = Setting::getValue('homepage.hero.mode', 'static');
        $staticHero = Setting::getValue('homepage.hero.static', [
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

        $heroSlides = collect(Setting::getValue('homepage.hero.slides', []))
            ->filter(fn (array $slide) => (bool) ($slide['is_active'] ?? false))
            ->sortBy('sort_order')
            ->take(5)
            ->map(fn (array $slide) => $this->resolveHeroSlide($slide))
            ->filter()
            ->values();

        return view('public.home', [
            'heroMode' => $heroSlides->isNotEmpty() && $heroMode === 'slider' ? 'slider' : 'static',
            'staticHero' => $staticHero,
            'heroSlides' => $heroSlides,
            'heroStats' => [
                ['value' => Category::query()->where('is_active', true)->count().'+', 'label' => 'Aktif kategori'],
                ['value' => Product::query()->where('is_active', true)->count().'+', 'label' => 'Katalog ürünü'],
                ['value' => '3 Adım', 'label' => 'Teklif akışı'],
            ],
            'trustBlocks' => [
                ['title' => 'Hızlı Teklif Akışı', 'text' => 'Birden fazla ürünü tek listede toplayın, teklif sürecini tek adımda başlatın.'],
                ['title' => 'Geniş Ürün Gamı', 'text' => 'Rulman, filtre, kayış, burç, sanayi tekeri ve yardımcı ürün gruplarında geniş seçenekler.'],
                ['title' => 'Teknik Destek', 'text' => 'Kategori, ürün kodu ve teknik bilgilerle doğru ürüne daha hızlı ulaşın.'],
                ['title' => 'Kurumsal Tedarik Yaklaşımı', 'text' => 'Çoklu kalem, tekrar talep ve operasyon takibi için uygun yapıda ilerleyin.'],
            ],
            'processSteps' => [
                ['title' => 'Ürünleri Seçin', 'text' => 'Kategori veya arama ile ihtiyacınıza uygun ürünleri bulun.'],
                ['title' => 'Listeye Ekleyin', 'text' => 'Birden fazla ürünü adet bilgisiyle teklif listenizde toplayın.'],
                ['title' => 'Talebinizi Gönderin', 'text' => 'İletişim bilgilerinizi iletin, operasyon ekibimizden size özel dönüş alın.'],
            ],
            'supplyBenefits' => [
                'Kategori bazlı ürün keşfi',
                'Tek seferde çoklu teklif talebi',
                'Müşteri panelinden takip imkanı',
                'Operasyon ekibi ile hızlı geri dönüş',
            ],
            'categories' => Category::query()->where('is_active', true)->orderBy('sort_order')->take(6)->get(),
            'featuredProducts' => Product::query()->with(['category', 'brand', 'images', 'primaryImage'])->where('is_active', true)->where('is_featured', true)->take(4)->get(),
        ]);
    }

    private function resolveHeroSlide(array $slide): ?array
    {
        if (($slide['type'] ?? null) === 'product') {
            $product = Product::query()->with(['category', 'primaryImage'])->where('is_active', true)->find($slide['id'] ?? null);

            if (! $product) {
                return null;
            }

            return [
                'eyebrow' => $slide['eyebrow'] ?: ($product->category?->name ?: 'Öne Çıkan Ürün'),
                'title' => $slide['title_override'] ?: $product->name,
                'description' => $slide['description_override'] ?: ($product->technical_summary ?: $product->short_description ?: 'Teknik ürün detayı ve teklif akışı için öne çıkan ürün.'),
                'image' => $product->primaryImage?->path ? Storage::disk('public')->url($product->primaryImage->path) : null,
                'image_alt' => $product->primaryImage?->alt_text ?: $product->name,
                'primary_cta_label' => $slide['primary_cta_label'] ?: 'Ürünü İncele',
                'primary_cta_url' => $slide['primary_cta_url'] ?: route('products.show', $product),
                'secondary_cta_label' => $slide['secondary_cta_label'] ?: 'Teklif Oluştur',
                'secondary_cta_url' => $slide['secondary_cta_url'] ?: route('quote-list.index'),
            ];
        }

        if (($slide['type'] ?? null) === 'category') {
            $category = Category::query()->where('is_active', true)->find($slide['id'] ?? null);

            if (! $category) {
                return null;
            }

            return [
                'eyebrow' => $slide['eyebrow'] ?: 'Kategori Vitrini',
                'title' => $slide['title_override'] ?: $category->name,
                'description' => $slide['description_override'] ?: ($category->description ?: 'Bu kategoriye ait ürünleri inceleyin ve teklif listenizi oluşturun.'),
                'image' => $category->image_path ? Storage::disk('public')->url($category->image_path) : null,
                'image_alt' => $category->image_alt ?: $category->name,
                'primary_cta_label' => $slide['primary_cta_label'] ?: 'Kategoriyi İncele',
                'primary_cta_url' => $slide['primary_cta_url'] ?: route('categories.show', $category),
                'secondary_cta_label' => $slide['secondary_cta_label'] ?: 'Teklif Oluştur',
                'secondary_cta_url' => $slide['secondary_cta_url'] ?: route('quote-list.index'),
            ];
        }

        return null;
    }
}
