@php
    use Illuminate\Support\Facades\Storage;
    $template = $templates[$product->category_id] ?? null;
    $specValues = $product->specificationValues->keyBy('specification_field_id');
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="grid gap-4 lg:grid-cols-2">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    @if($product->exists && $product->primaryImage?->path)
        <div class="lg:col-span-2 overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800">
            <img src="{{ Storage::disk('public')->url($product->primaryImage->path) }}" alt="{{ $product->name }}" class="h-56 w-full object-cover">
        </div>
    @endif

    <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="Urun adi" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
    <input type="text" name="code" value="{{ old('code', $product->code) }}" placeholder="Urun kodu" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
    <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" placeholder="slug" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" placeholder="Fiyat" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
    <select name="category_id" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
        <option value="">Kategori secin</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id) === (string) $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    <select name="brand_id" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
        <option value="">Marka secin</option>
        @foreach($brands as $brand)
            <option value="{{ $brand->id }}" @selected((string) old('brand_id', $product->brand_id) === (string) $brand->id)>{{ $brand->name }}</option>
        @endforeach
    </select>
    <input type="text" name="technical_summary" value="{{ old('technical_summary', $product->technical_summary) }}" placeholder="Teknik ozet" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
    <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}" placeholder="Kisa aciklama" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
    <textarea name="description" rows="5" placeholder="Detay aciklama" class="lg:col-span-2 rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('description', $product->description) }}</textarea>
    <input type="file" name="image" accept="image/*" class="lg:col-span-2 rounded-2xl border border-slate-300 px-4 py-3 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
    <input type="file" name="gallery_images[]" accept="image/*" multiple class="lg:col-span-2 rounded-2xl border border-slate-300 px-4 py-3 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
    <select name="use_case_ids[]" multiple class="lg:col-span-2 rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
        @foreach($useCases as $useCase)
            <option value="{{ $useCase->id }}" @selected(collect(old('use_case_ids', $product->useCases->pluck('id')->all()))->contains($useCase->id))>{{ $useCase->name }}</option>
        @endforeach
    </select>

    @if($template?->fields?->isNotEmpty())
        <div class="lg:col-span-2 rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
            <p class="text-sm font-semibold text-slate-900 dark:text-white">Teknik Degerler</p>
            <div class="mt-4 grid gap-4 lg:grid-cols-2">
                @foreach($template->fields->sortBy('sort_order') as $field)
                    <label class="text-sm">
                        <span class="mb-2 block font-medium text-slate-700 dark:text-slate-200">{{ $field->name }}</span>
                        <input type="text" name="specification_values[{{ $field->id }}]" value="{{ old('specification_values.'.$field->id, optional($specValues->get($field->id))->value) }}" class="block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    </label>
                @endforeach
            </div>
        </div>
    @endif

    <div class="lg:col-span-2 flex flex-wrap gap-4 text-sm">
        <label class="flex items-center gap-2"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" @checked((bool) old('is_active', $product->is_active))> Aktif</label>
        <label class="flex items-center gap-2"><input type="hidden" name="is_featured" value="0"><input type="checkbox" name="is_featured" value="1" @checked((bool) old('is_featured', $product->is_featured))> One cikan</label>
        <label class="flex items-center gap-2"><input type="hidden" name="show_price" value="0"><input type="checkbox" name="show_price" value="1" @checked((bool) old('show_price', $product->show_price))> Fiyat goster</label>
        <label class="flex items-center gap-2"><input type="hidden" name="show_stock" value="0"><input type="checkbox" name="show_stock" value="1" @checked((bool) old('show_stock', $product->show_stock))> Stok goster</label>
    </div>

    <div class="lg:col-span-2 flex gap-3">
        <button type="submit" class="rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">{{ $submitLabel }}</button>
        <a href="{{ route('admin.products.index') }}" class="rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Listeye Don</a>
    </div>
</form>

@if($product->exists && $product->images->isNotEmpty())
    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach($product->images as $image)
            <div class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800">
                <img src="{{ Storage::disk('public')->url($image->path) }}" alt="{{ $image->alt_text }}" class="h-40 w-full object-cover">
                <div class="space-y-2 p-3">
                    @if(!$image->is_primary)
                        <form method="POST" action="{{ route('admin.products.images.primary', [$product, $image]) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full rounded-full border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 dark:border-slate-700 dark:text-slate-200">Birincil Yap</button>
                        </form>
                    @else
                        <div class="rounded-full bg-emerald-100 px-3 py-2 text-center text-xs font-semibold text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">Birincil Gorsel</div>
                    @endif
                    <form method="POST" action="{{ route('admin.products.images.destroy', [$product, $image]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full rounded-full border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-600">Gorseli Sil</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
