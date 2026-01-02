<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function index()
    {
        // Main categories (Shop & Service)
        $mainCategories = Category::whereNull('parent_id')->get();

        // Get specific main categories
        $serviceMain = Category::with('children')
            ->where('name', 'Service')
            ->first();

        $shopMain = Category::with('children')
            ->where('name', 'Shop')
            ->first();

        return view('admin.categories', compact(
            'mainCategories',
            'serviceMain',
            'shopMain'
        ));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required|exists:categories,id',
        ]);

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Sub category created successfully');
    }
}
