@extends('layouts.admin')

@section('title', 'Kategoriler | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Kategoriler</h1>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-6 grid gap-4 lg:grid-cols-5">
                @csrf
                <input type="text" name="name" placeholder="Kategori adi" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required />
                <input type="text" name="slug" placeholder="slug" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                <input type="number" name="sort_order" placeholder="Sira" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                <input type="text" name="description" placeholder="Kisa aciklama" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-700"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
                <button type="submit" class="lg:col-span-5 rounded-full bg-bilya-blue px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Kategori Ekle</button>
            </form>
        </section>
        <section class="space-y-4">
            @forelse($categories as $category)
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="grid gap-4 lg:grid-cols-5">
                        @csrf @method('PATCH')
                        <input type="text" name="name" value="{{ $category->name }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required />
                        <input type="text" name="slug" value="{{ $category->slug }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        <input type="number" name="sort_order" value="{{ $category->sort_order }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        <input type="text" name="description" value="{{ $category->description }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-700"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" @checked($category->is_active)> Aktif</label>
                        <div class="lg:col-span-5 flex gap-3">
                            <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white dark:bg-white dark:text-slate-900">Kaydet</button>
                    </form>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">@csrf @method('DELETE')<button type="submit" class="rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600">Sil</button></form>
                        </div>
                </div>
            @empty
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">Henuz kategori kaydi yok.</div>
            @endforelse
        </section>
    </div>
@endsection
