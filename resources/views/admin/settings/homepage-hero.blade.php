@extends('layouts.admin')

@section('title', 'Anasayfa Hero Ayarları | Bilyam')

@section('content')
    <div class="space-y-6" x-data="{ heroMode: '{{ old('hero_mode', $heroMode) }}' }">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Anasayfa Hero Ayarları</h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Varsayılan olarak statik hero kullanılır. İsterseniz ürün ve kategori bazlı slider hero’ya geçebilirsiniz.</p>
        </section>

        <form method="POST" action="{{ route('admin.settings.homepage-hero.update') }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Hero Modu</h2>
                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-4 dark:border-slate-800">
                        <input type="radio" name="hero_mode" value="static" x-model="heroMode" @checked($heroMode === 'static')>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-white">Statik Hero</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Toptanbilya tarzı slogan odaklı hero.</p>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-4 dark:border-slate-800">
                        <input type="radio" name="hero_mode" value="slider" x-model="heroMode" @checked($heroMode === 'slider')>
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-white">Slider Hero</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Ürün ve kategori bazlı Sellzy ilhamlı görsel hero.</p>
                        </div>
                    </label>
                </div>
            </section>

            <section x-show="heroMode === 'static'" x-transition class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Statik Hero İçeriği</h2>
                <div class="mt-5 grid gap-4 lg:grid-cols-2">
                    <input type="text" name="static[eyebrow]" value="{{ old('static.eyebrow', $staticHero['eyebrow'] ?? '') }}" placeholder="Üst etiket" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <input type="text" name="static[title]" value="{{ old('static.title', $staticHero['title'] ?? '') }}" placeholder="Başlık" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <textarea name="static[description]" rows="4" placeholder="Açıklama" class="lg:col-span-2 rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('static.description', $staticHero['description'] ?? '') }}</textarea>
                    <input type="text" name="static[primary_cta_label]" value="{{ old('static.primary_cta_label', $staticHero['primary_cta_label'] ?? '') }}" placeholder="Birincil CTA etiketi" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <input type="text" name="static[primary_cta_url]" value="{{ old('static.primary_cta_url', $staticHero['primary_cta_url'] ?? '') }}" placeholder="Birincil CTA URL" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <input type="text" name="static[secondary_cta_label]" value="{{ old('static.secondary_cta_label', $staticHero['secondary_cta_label'] ?? '') }}" placeholder="İkincil CTA etiketi" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <input type="text" name="static[secondary_cta_url]" value="{{ old('static.secondary_cta_url', $staticHero['secondary_cta_url'] ?? '') }}" placeholder="İkincil CTA URL" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @for($i = 0; $i < 3; $i++)
                        <input type="text" name="static[support_items][]" value="{{ old('static.support_items.'.$i, $staticHero['support_items'][$i] ?? '') }}" placeholder="Destek maddesi {{ $i + 1 }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    @endfor
                </div>
            </section>

            <section x-show="heroMode === 'slider'" x-transition class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Slider Hero Öğeleri</h2>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Maksimum 5 aktif slide kullanılabilir. Ürün ve kategori birlikte seçilebilir.</p>
                    </div>
                </div>

                <div class="mt-5 space-y-5">
                    @for($i = 0; $i < 5; $i++)
                        @php $slide = old('slides.'.$i, $slides[$i] ?? []); @endphp
                        <div class="rounded-2xl border border-slate-200 p-5 dark:border-slate-800 {{ (bool) ($slide['is_active'] ?? false) ? 'ring-2 ring-bilya-blue/30' : '' }}">
                            <div class="mb-4 flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Slide {{ $i + 1 }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Ürün veya kategori tabanlı hero öğesi</p>
                                </div>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ (bool) ($slide['is_active'] ?? false) ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300' : 'bg-slate-100 text-slate-500 dark:bg-slate-950 dark:text-slate-400' }}">{{ (bool) ($slide['is_active'] ?? false) ? 'Aktif' : 'Pasif' }}</span>
                            </div>
                            <div class="grid gap-4 lg:grid-cols-3">
                                <select name="slides[{{ $i }}][type]" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                    <option value="">Tip seçin</option>
                                    <option value="product" @selected(($slide['type'] ?? '') === 'product')>Ürün</option>
                                    <option value="category" @selected(($slide['type'] ?? '') === 'category')>Kategori</option>
                                </select>
                                <select name="slides[{{ $i }}][product_id]" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                    <option value="">Ürün seçin</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" @selected((string) ($slide['id'] ?? $slide['product_id'] ?? '') === (string) $product->id)>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                <select name="slides[{{ $i }}][category_id]" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                    <option value="">Kategori seçin</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected((string) ($slide['id'] ?? $slide['category_id'] ?? '') === (string) $category->id)>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="slides[{{ $i }}][eyebrow]" value="{{ $slide['eyebrow'] ?? '' }}" placeholder="Üst etiket" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                <input type="text" name="slides[{{ $i }}][title_override]" value="{{ $slide['title_override'] ?? '' }}" placeholder="Başlık override" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                <textarea name="slides[{{ $i }}][description_override]" rows="3" placeholder="Açıklama override" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ $slide['description_override'] ?? '' }}</textarea>
                                <input type="text" name="slides[{{ $i }}][primary_cta_label]" value="{{ $slide['primary_cta_label'] ?? '' }}" placeholder="Birincil CTA etiketi" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                <input type="text" name="slides[{{ $i }}][primary_cta_url]" value="{{ $slide['primary_cta_url'] ?? '' }}" placeholder="Birincil CTA URL (opsiyonel)" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                <input type="text" name="slides[{{ $i }}][secondary_cta_label]" value="{{ $slide['secondary_cta_label'] ?? '' }}" placeholder="İkincil CTA etiketi" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                <input type="text" name="slides[{{ $i }}][secondary_cta_url]" value="{{ $slide['secondary_cta_url'] ?? '' }}" placeholder="İkincil CTA URL (opsiyonel)" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                <input type="number" name="slides[{{ $i }}][sort_order]" value="{{ $slide['sort_order'] ?? $i + 1 }}" placeholder="Sıra" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-800"><input type="hidden" name="slides[{{ $i }}][is_active]" value="0"><input type="checkbox" name="slides[{{ $i }}][is_active]" value="1" @checked((bool) ($slide['is_active'] ?? false))> Aktif</label>
                            </div>
                        </div>
                    @endfor
                </div>
            </section>

            <div>
                <button type="submit" class="rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Hero Ayarlarını Kaydet</button>
            </div>
        </form>
    </div>
@endsection
