<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function show(Category $category): RedirectResponse
    {
        abort_unless($category->is_active, 404);

        return redirect()->route('products.index', ['category' => $category->slug]);
    }
}
