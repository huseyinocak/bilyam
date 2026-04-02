<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SpecificationField;
use App\Models\SpecificationTemplate;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SpecificationTemplateController extends Controller
{
    public function index(): View
    {
        return view('admin.specifications.index', [
            'templates' => SpecificationTemplate::query()->with(['category', 'fields'])->orderBy('name')->get(),
            'categories' => Category::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:specification_templates,slug'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $template = SpecificationTemplate::create([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'slug' => ($validated['slug'] ?? null) ?: Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        ActivityLogger::log('catalog.spec_template.created', $template, ['name' => $template->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Teknik özellik şablonu oluşturuldu.');
    }

    public function update(Request $request, SpecificationTemplate $template): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:specification_templates,slug,'.$template->id],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $template->update([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'slug' => ($validated['slug'] ?? null) ?: Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        ActivityLogger::log('catalog.spec_template.updated', $template, ['name' => $template->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Teknik özellik şablonu güncellendi.');
    }

    public function destroy(Request $request, SpecificationTemplate $template): RedirectResponse
    {
        $name = $template->name;
        $template->delete();

        ActivityLogger::log('catalog.spec_template.deleted', null, ['name' => $name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Teknik özellik şablonu silindi.');
    }

    public function storeField(Request $request, SpecificationTemplate $template): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'key' => ['nullable', 'string', 'max:255', 'unique:specification_fields,key,NULL,id,specification_template_id,'.$template->id],
            'field_type' => ['required', 'in:text,number,select,boolean'],
            'unit' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_filterable' => ['nullable', 'boolean'],
            'is_required' => ['nullable', 'boolean'],
        ]);

        $field = $template->fields()->create([
            'name' => $validated['name'],
            'key' => ($validated['key'] ?? null) ?: Str::snake($validated['name']),
            'field_type' => $validated['field_type'],
            'unit' => $validated['unit'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_filterable' => (bool) ($validated['is_filterable'] ?? false),
            'is_required' => (bool) ($validated['is_required'] ?? false),
        ]);

        ActivityLogger::log('catalog.spec_field.created', $field, ['name' => $field->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Teknik alan oluşturuldu.');
    }

    public function updateField(Request $request, SpecificationTemplate $template, SpecificationField $field): RedirectResponse
    {
        abort_unless($field->specification_template_id === $template->id, 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'key' => ['nullable', 'string', 'max:255', 'unique:specification_fields,key,'.$field->id.',id,specification_template_id,'.$template->id],
            'field_type' => ['required', 'in:text,number,select,boolean'],
            'unit' => ['nullable', 'string', 'max:50'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_filterable' => ['nullable', 'boolean'],
            'is_required' => ['nullable', 'boolean'],
        ]);

        $field->update([
            'name' => $validated['name'],
            'key' => ($validated['key'] ?? null) ?: Str::snake($validated['name']),
            'field_type' => $validated['field_type'],
            'unit' => $validated['unit'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_filterable' => (bool) ($validated['is_filterable'] ?? false),
            'is_required' => (bool) ($validated['is_required'] ?? false),
        ]);

        ActivityLogger::log('catalog.spec_field.updated', $field, ['name' => $field->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Teknik alan güncellendi.');
    }

    public function destroyField(Request $request, SpecificationTemplate $template, SpecificationField $field): RedirectResponse
    {
        abort_unless($field->specification_template_id === $template->id, 404);

        $name = $field->name;
        $field->delete();

        ActivityLogger::log('catalog.spec_field.deleted', null, ['name' => $name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Teknik alan silindi.');
    }
}
