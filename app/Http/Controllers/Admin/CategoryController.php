<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.catalog.categories.index', [
            'categories' => Category::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $category = Category::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        ActivityLogger::log('catalog.category.created', $category, ['name' => $category->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Kategori oluşturuldu.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug,'.$category->id],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        ActivityLogger::log('catalog.category.updated', $category, ['name' => $category->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Kategori güncellendi.');
    }

    public function destroy(Request $request, Category $category): RedirectResponse
    {
        $name = $category->name;
        $category->delete();

        ActivityLogger::log('catalog.category.deleted', null, ['name' => $name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Kategori silindi.');
    }
}
