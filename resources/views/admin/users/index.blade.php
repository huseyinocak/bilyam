@extends('layouts.admin')

@section('title', 'Kullanicilar | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Kullanicilar</h1>
            <form method="POST" action="{{ route('admin.users.store') }}" class="mt-6 grid gap-4 lg:grid-cols-3">
                @csrf
                <input type="text" name="name" placeholder="Ad Soyad" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                <input type="email" name="email" placeholder="E-posta" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                <input type="text" name="phone" placeholder="Telefon" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                <select name="user_type" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white"><option value="customer">Customer</option><option value="admin">Admin</option></select>
                <input type="password" name="password" placeholder="Sifre" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                <input type="password" name="password_confirmation" placeholder="Sifre tekrari" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                <select name="role_names[]" multiple class="lg:col-span-3 rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">@foreach($roles as $role)<option value="{{ $role->name }}">{{ $role->name }}</option>@endforeach</select>
                <button type="submit" class="lg:col-span-3 rounded-full bg-bilya-blue px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Kullanici Ekle</button>
            </form>
        </section>
        <section class="space-y-4">
            @foreach($users as $user)
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="grid gap-4 lg:grid-cols-3">
                        @csrf @method('PATCH')
                        <input type="text" name="name" value="{{ $user->name }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <input type="email" name="email" value="{{ $user->email }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <select name="user_type" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white"><option value="customer" @selected($user->user_type==='customer')>Customer</option><option value="admin" @selected($user->user_type==='admin')>Admin</option></select>
                        <input type="password" name="password" placeholder="Yeni sifre (opsiyonel)" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <input type="password" name="password_confirmation" placeholder="Sifre tekrari" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <select name="role_names[]" multiple class="lg:col-span-3 rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">@foreach($roles as $role)<option value="{{ $role->name }}" @selected($user->roles->contains('name', $role->name))>{{ $role->name }}</option>@endforeach</select>
                        <div class="lg:col-span-3 flex items-center gap-3">
                            <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white dark:bg-white dark:text-slate-900">Kaydet</button>
                    </form>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}">@csrf @method('DELETE')<button type="submit" class="rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600">Sil</button></form>
                        </div>
                    <div class="mt-3 flex flex-wrap gap-2 text-xs text-slate-500 dark:text-slate-400">@foreach($user->roles as $role)<span class="rounded-full border border-slate-200 px-3 py-1 dark:border-slate-700">{{ $role->name }}</span>@endforeach</div>
                </div>
            @endforeach
            <div>{{ $users->links() }}</div>
        </section>
    </div>
@endsection
