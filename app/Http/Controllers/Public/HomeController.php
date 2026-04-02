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
            'highlights' => [
                ['title' => 'Hizli Kesif', 'text' => 'Urun, kategori, urun kodu ve kullanim alanina gore teknik urunleri hizla bulun.'],
                ['title' => 'Teklif Listesi', 'text' => 'Birden fazla urunu adet bilgisiyle tek listede toplayip talep gonderin.'],
                ['title' => 'Kurumsal Akis', 'text' => 'B2B agirlikli ama bireysel kullaniciyi da dislamayan profesyonel bir deneyim sunun.'],
            ],
            'journey' => [
                'Urunleri inceleyin ve ihtiyaciniza uygun olanlari secin.',
                'Teklif listenize birden fazla urun ekleyip adetleri belirleyin.',
                'Iletisim bilgilerinizi girerek teklif talebinizi tek seferde iletin.',
            ],
            'adminMetrics' => [
                ['label' => 'Alan', 'value' => 'Public + Customer + Admin'],
                ['label' => 'Model', 'value' => 'Katalog + Teklif Operasyonu'],
                ['label' => 'Tema', 'value' => 'Light / Dark Hazir'],
            ],
            'categories' => Category::query()->where('is_active', true)->orderBy('sort_order')->take(6)->get(),
            'featuredProducts' => Product::query()->with(['category', 'brand', 'images'])->where('is_active', true)->where('is_featured', true)->take(4)->get(),
        ]);
    }
}
