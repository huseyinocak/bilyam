@extends('layouts.admin')

@section('title', 'Aktivite Loglari | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Aktivite Loglari</h1>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Auth, teklif ve katalog uzerindeki kritik olaylar burada izlenir.</p>
                </div>
                <form method="GET" action="{{ route('admin.activity-logs.index') }}">
                    <select name="channel" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <option value="">Tüm kanallar</option>
                        @foreach($channels as $item)
                            <option value="{{ $item }}" @selected($channel === $item)>{{ strtoupper($item) }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </section>
        <section class="space-y-3">
            @forelse($logs as $log)
                <div class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                        <div>
                            <p class="text-base font-semibold text-slate-900 dark:text-white">{{ $log->event }}</p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ strtoupper($log->channel) }} • {{ $log->created_at->format('d.m.Y H:i:s') }}</p>
                        </div>
                        <div class="text-sm text-slate-500 dark:text-slate-400">{{ $log->user?->name ?: 'Sistem' }}</div>
                    </div>
                    @if($log->properties)
                        <pre class="mt-4 overflow-x-auto rounded-2xl bg-slate-50 p-4 text-xs text-slate-600 dark:bg-slate-950 dark:text-slate-300">{{ json_encode($log->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    @endif
                </div>
            @empty
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">Secili filtre icin log kaydi bulunmuyor.</div>
            @endforelse
            <div>{{ $logs->links() }}</div>
        </section>
    </div>
@endsection
