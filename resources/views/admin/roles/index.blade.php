@extends('layouts.admin')

@section('title', 'Roller | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Roller</h1>
            <form method="POST" action="{{ route('admin.roles.store') }}" class="mt-6 flex gap-4">
                @csrf
                <input type="text" name="name" placeholder="Yeni rol adi" class="flex-1 rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                <button type="submit" class="rounded-full bg-bilya-blue px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Rol Ekle</button>
            </form>
        </section>
        <section class="space-y-4">
            @foreach($roles as $role)
                <div class="rounded-[2rem] border border-slate-200 bg-white px-6 py-5 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-base font-semibold text-slate-900 dark:text-white">{{ $role->name }}</p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $role->users_count }} kullanici atamasi</p>
                        </div>
                        @if(!in_array($role->name, $protectedRoles, true))
                            <form method="POST" action="{{ route('admin.roles.destroy', $role) }}">@csrf @method('DELETE')<button type="submit" class="rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600">Sil</button></form>
                        @else
                            <span class="text-sm text-slate-400">Sistem rolu</span>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="mt-5 grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                        @csrf @method('PATCH')
                        @foreach($permissions as $permission)
                            <label class="flex items-center gap-3 rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-700">
                                <input type="checkbox" name="permission_names[]" value="{{ $permission->name }}" @checked($role->permissions->contains('name', $permission->name))>
                                <span>{{ $permission->name }}</span>
                            </label>
                        @endforeach
                        <div class="sm:col-span-2 xl:col-span-3">
                            <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white dark:bg-white dark:text-slate-900">Izinleri Kaydet</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </section>
    </div>
@endsection
