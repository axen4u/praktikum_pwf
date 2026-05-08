<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @group Category API
     */
    public function index()
    {
        try {
            $categories = Kategori::all();
            Log::info('Successfully retrieved categories');
            return response()->json([
                'success' => true,
                'data' => $categories
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve categories: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve categories'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @group Category API
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_kategori' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $category = Kategori::create($request->all());
            Log::info('Successfully created category: ' . $category->id);
            
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to create category: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create category'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * @group Category API
     */
    public function update(Request $request, $id)
    {
        try {
            $category = Kategori::find($id);
            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            $validator = Validator::make($request->all(), [
                'nama_kategori' => 'sometimes|required|string|max:255',
                'deskripsi' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $category->update($request->all());
            Log::info('Successfully updated category: ' . $id);

            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'data' => $category
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to update category ' . $id . ': ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @group Category API
     */
    public function destroy($id)
    {
        try {
            $category = Kategori::find($id);
            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            $category->delete();
            Log::info('Successfully deleted category: ' . $id);

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to delete category ' . $id . ': ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category'
            ], 500);
        }
    }
}
