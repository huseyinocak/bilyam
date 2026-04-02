<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        return view('admin.catalog.brands.index', [
            'brands' => Brand::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:brands,slug'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $brand = Brand::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        ActivityLogger::log('catalog.brand.created', $brand, ['name' => $brand->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Marka oluşturuldu.');
    }

    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:brands,slug,'.$brand->id],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $brand->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        ActivityLogger::log('catalog.brand.updated', $brand, ['name' => $brand->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Marka güncellendi.');
    }

    public function destroy(Request $request, Brand $brand): RedirectResponse
    {
        $name = $brand->name;
        $brand->delete();

        ActivityLogger::log('catalog.brand.deleted', null, ['name' => $name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Marka silindi.');
    }
}
