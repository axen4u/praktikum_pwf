<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @group Product API
     */
    public function index()
    {
        try {
            $products = Product::with('kategori')->get();
            Log::info('Successfully retrieved all products');
            return response()->json([
                'success' => true,
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve products: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve products'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @group Product API
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'kategori_id' => 'required|exists:kategoris,id',
                'nama_produk' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'harga' => 'required|numeric',
                'stok' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $product = Product::create(array_merge($request->all(), [
                'user_id' => Auth::id()
            ]));

            Log::info('Successfully created product: ' . $product->id);
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to create product: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create product'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * @group Product API
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $validator = Validator::make($request->all(), [
                'kategori_id' => 'sometimes|required|exists:kategoris,id',
                'nama_produk' => 'sometimes|required|string|max:255',
                'deskripsi' => 'nullable|string',
                'harga' => 'sometimes|required|numeric',
                'stok' => 'sometimes|required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $product->update(array_merge($request->all(), [
                'user_id' => Auth::id()
            ]));

            Log::info('Successfully updated product: ' . $id);
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to update product ' . $id . ': ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update product'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @group Product API
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $product->delete();
            Log::info('Successfully deleted product: ' . $id);

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to delete product ' . $id . ': ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete product'
            ], 500);
        }
    }
}
