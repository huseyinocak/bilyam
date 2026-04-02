@extends('layouts.admin')

@section('title', 'Markalar | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Markalar</h1>
            <form method="POST" action="{{ route('admin.brands.store') }}" class="mt-6 grid gap-4 lg:grid-cols-4">
                @csrf
                <input type="text" name="name" placeholder="Marka adi" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required />
                <input type="text" name="slug" placeholder="slug" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                <input type="text" name="description" placeholder="Aciklama" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-700"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
                <button type="submit" class="lg:col-span-4 rounded-full bg-bilya-blue px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Marka Ekle</button>
            </form>
        </section>
        <section class="space-y-4">
            @forelse($brands as $brand)
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <form method="POST" action="{{ route('admin.brands.update', $brand) }}" class="grid gap-4 lg:grid-cols-4">
                        @csrf @method('PATCH')
                        <input type="text" name="name" value="{{ $brand->name }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required />
                        <input type="text" name="slug" value="{{ $brand->slug }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        <input type="text" name="description" value="{{ $brand->description }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-700"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" @checked($brand->is_active)> Aktif</label>
                        <div class="lg:col-span-4 flex gap-3">
                            <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white dark:bg-white dark:text-slate-900">Kaydet</button>
                    </form>
                            <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}">@csrf @method('DELETE')<button type="submit" class="rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600">Sil</button></form>
                        </div>
                </div>
            @empty
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">Henuz marka kaydi yok.</div>
            @endforelse
        </section>
    </div>
@endsection
