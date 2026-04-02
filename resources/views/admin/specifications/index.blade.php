@extends('layouts.admin')

@section('title', 'Teknik Özellikler | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Teknik Özellik Şablonları</h1>
            <form method="POST" action="{{ route('admin.specification-templates.store') }}" class="mt-6 grid gap-4 lg:grid-cols-5">
                @csrf
                <select name="category_id" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white"><option value="">Kategori secin</option>@foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach</select>
                <input type="text" name="name" placeholder="Şablon adı" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                <input type="text" name="slug" placeholder="slug" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                <input type="text" name="description" placeholder="Aciklama" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-700"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
                <button type="submit" class="lg:col-span-5 rounded-full bg-bilya-blue px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Şablon Ekle</button>
            </form>
        </section>
        <section class="space-y-4">
            @foreach($templates as $template)
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <form method="POST" action="{{ route('admin.specification-templates.update', $template) }}" class="grid gap-4 lg:grid-cols-5">
                        @csrf @method('PATCH')
                        <select name="category_id" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white"><option value="">Kategori secin</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected($template->category_id===$category->id)>{{ $category->name }}</option>@endforeach</select>
                        <input type="text" name="name" value="{{ $template->name }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <input type="text" name="slug" value="{{ $template->slug }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <input type="text" name="description" value="{{ $template->description }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-700"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" @checked($template->is_active)> Aktif</label>
                        <div class="lg:col-span-5 flex gap-3">
                            <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white dark:bg-white dark:text-slate-900">Şablonu Kaydet</button>
                    </form>
                            <form method="POST" action="{{ route('admin.specification-templates.destroy', $template) }}">@csrf @method('DELETE')<button type="submit" class="rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600">Sil</button></form>
                        </div>

                    <div class="mt-6 border-t border-slate-200 pt-6 dark:border-slate-800">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Alanlar</h2>
                        <form method="POST" action="{{ route('admin.specification-templates.fields.store', $template) }}" class="mt-4 grid gap-4 lg:grid-cols-6">
                            @csrf
                            <input type="text" name="name" placeholder="Alan adi" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            <input type="text" name="key" placeholder="key" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                            <select name="field_type" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white"><option value="text">text</option><option value="number">number</option><option value="select">select</option><option value="boolean">boolean</option></select>
                            <input type="text" name="unit" placeholder="Birim" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                            <input type="number" name="sort_order" placeholder="Sira" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                            <div class="flex items-center gap-4 text-sm"><label><input type="hidden" name="is_filterable" value="0"><input type="checkbox" name="is_filterable" value="1"> Filtre</label><label><input type="hidden" name="is_required" value="0"><input type="checkbox" name="is_required" value="1"> Zorunlu</label></div>
                            <button type="submit" class="lg:col-span-6 rounded-full bg-bilya-blue px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Alan Ekle</button>
                        </form>
                        <div class="mt-4 space-y-3">
                            @forelse($template->fields->sortBy('sort_order') as $field)
                                <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-950">
                                    <form method="POST" action="{{ route('admin.specification-templates.fields.update', [$template, $field]) }}" class="grid gap-4 lg:grid-cols-6">
                                        @csrf @method('PATCH')
                                        <input type="text" name="name" value="{{ $field->name }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white" required>
                                        <input type="text" name="key" value="{{ $field->key }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white">
                                        <select name="field_type" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white"><option value="text" @selected($field->field_type==='text')>text</option><option value="number" @selected($field->field_type==='number')>number</option><option value="select" @selected($field->field_type==='select')>select</option><option value="boolean" @selected($field->field_type==='boolean')>boolean</option></select>
                                        <input type="text" name="unit" value="{{ $field->unit }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white">
                                        <input type="number" name="sort_order" value="{{ $field->sort_order }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white">
                                        <div class="flex items-center gap-4 text-sm"><label><input type="hidden" name="is_filterable" value="0"><input type="checkbox" name="is_filterable" value="1" @checked($field->is_filterable)> Filtre</label><label><input type="hidden" name="is_required" value="0"><input type="checkbox" name="is_required" value="1" @checked($field->is_required)> Zorunlu</label></div>
                                        <div class="lg:col-span-6 flex gap-3">
                                            <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white dark:bg-white dark:text-slate-900">Kaydet</button>
                                    </form>
                                            <form method="POST" action="{{ route('admin.specification-templates.fields.destroy', [$template, $field]) }}">@csrf @method('DELETE')<button type="submit" class="rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600">Sil</button></form>
                                        </div>
                                </div>
                            @empty
                                <div class="rounded-2xl border border-dashed border-slate-300 px-4 py-6 text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">Bu şablona ait teknik alan bulunmuyor.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
@endsection
