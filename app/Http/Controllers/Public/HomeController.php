<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('public.home', [
            'heroBadges' => [
                'Geniş kategori yapısı',
                'Çoklu ürün için tek teklif akışı',
                'Kurumsal tedarik odakli operasyon',
            ],
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
            'categoryVisuals' => [
                'stone-quarry' => 'images/resources/stone-quarry-bearings.png',
                'crusher' => 'images/resources/crusher-bearings.png',
                'agricultural' => 'images/resources/agricultural-bearings.png',
                'plastic' => 'images/resources/plastic-factory-bearings.png',
                'seals' => 'images/resources/seals-couplings.png',
                'v-belts' => 'images/resources/v-belts.png',
                'bushings' => 'images/resources/bushings.png',
                'filters' => 'images/resources/industrial-filters.png',
                'wheels' => 'images/resources/industrial-wheels.png',
                'housings' => 'images/resources/bearing-housings.png',
                'wholesale-bearings' => 'images/resources/bearing-collection.png',
                'balls' => 'images/resources/bearing-collection.png',
            ],
            'categories' => Category::query()->where('is_active', true)->orderBy('sort_order')->take(6)->get(),
            'featuredProducts' => Product::query()->with(['category', 'brand', 'images', 'primaryImage'])->where('is_active', true)->where('is_featured', true)->take(4)->get(),
        ]);
    }
}
