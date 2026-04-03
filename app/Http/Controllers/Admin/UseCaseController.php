<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UseCase;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UseCaseController extends Controller
{
    public function index(): View
    {
        return view('admin.catalog.use-cases.index', [
            'useCases' => UseCase::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:use_cases,slug'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $useCase = UseCase::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        ActivityLogger::log('catalog.use_case.created', $useCase, ['name' => $useCase->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Kullanım alanı oluşturuldu.');
    }

    public function update(Request $request, UseCase $useCase): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:use_cases,slug,'.$useCase->id],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $useCase->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        ActivityLogger::log('catalog.use_case.updated', $useCase, ['name' => $useCase->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Kullanım alanı güncellendi.');
    }

    public function destroy(Request $request, UseCase $useCase): RedirectResponse
    {
        $name = $useCase->name;
        $useCase->delete();

        ActivityLogger::log('catalog.use_case.deleted', null, ['name' => $name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Kullanım alanı silindi.');
    }
}
