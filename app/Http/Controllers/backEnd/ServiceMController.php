<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ServiceMController extends Controller
{
    public function serviceManagement()
    {
        $categories = Category::paginate(3);
        return view('backEnd.pages.companyService.serviceManagement', compact('categories'));
    }

    public function saveCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|in:0,1',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category saved successfully!',
            'category' => $category,
        ]);
    }
}
