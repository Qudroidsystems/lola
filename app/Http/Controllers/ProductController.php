<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Upload;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variation;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private function handleUpload($file)
    {
        if ($file && $file->isValid()) {
            $path = $file->store('uploads', 'public');
            return Upload::create([
                'filename'      => $file->getClientOriginalName(),
                'path'          => 'storage/' . $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type'     => $file->getClientMimeType(),
            ]);
        }
        return null;
    }

    public function index()
    {
        $products = Product::with(['categories', 'brands', 'units', 'warehouses', 'tags'])->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all(['id', 'name']);
        $stores = Warehouse::all();
        $units = Unit::all();
        $brands = Brand::all();
        $kt_ecommerce_add_product_options = Variation::all();

        return view('product.add', compact(
            'categories', 'tags', 'stores', 'units', 'brands', 'kt_ecommerce_add_product_options'
        ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|unique:products,name|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:published,draft',
            'category' => 'required|array',
            'category.*' => 'exists:categories,id',
            'unit' => 'required|array',
            'unit.*' => 'exists:units,id',
            'brand' => 'required|array',
            'brand.*' => 'exists:brands,id',
            'warehouses' => 'required|array',
            'warehouses.*' => 'exists:warehouses,id',
            'sku' => 'required|unique:products,sku|max:255',
            'barcode' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'stock_alert' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'is_featured' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'on_sale' => 'nullable|boolean',
            'tax' => 'nullable|numeric|min:0|max:100',
            'vat_amount' => 'nullable|numeric|min:0|max:100',
            'manufacture' => 'nullable|date',
            'expiry' => 'nullable|date|after_or_equal:manufacture',
            'selected_tag_ids' => 'nullable|array',
            'selected_tag_ids.*' => 'exists:tags,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_tag_description' => 'nullable|string',
            'meta_tag_keywords' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif|max:20480',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:20480',
            'kt_ecommerce_add_product_options' => 'nullable|array',
            'kt_ecommerce_add_product_options.*.discounttype' => 'required|in:nodiscount,percentage,fixed',
            'kt_ecommerce_add_product_options.*.percentage' => 'nullable|numeric|min:0|required_if:kt_ecommerce_add_product_options.*.discounttype,percentage',
            'kt_ecommerce_add_product_options.*.fixed' => 'nullable|numeric|min:0|required_if:kt_ecommerce_add_product_options.*.discounttype,fixed',
        ]);

        $upload = $this->handleUpload($request->file('thumbnail'));

        $product = Product::create([
            'name' => $validatedData['product_name'],
            'description' => $validatedData['description'] ?? null,
            'status' => $validatedData['status'],
            'sku' => $validatedData['sku'],
            'barcode' => $validatedData['barcode'] ?? null,
            'stock' => $validatedData['stock'],
            'stock_alert' => $validatedData['stock_alert'] ?? null,
            'base_price' => $validatedData['price'],
            'sale_price' => $validatedData['sale_price'],
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_new' => $request->has('is_new') ? 1 : 0,
            'on_sale' => $request->has('on_sale') ? 1 : 0,
            'tax' => $validatedData['tax'] ?? null,
            'vat_amount' => $validatedData['vat_amount'] ?? null,
            'manufactured' => $validatedData['manufacture'] ?? null,
            'expiry' => $validatedData['expiry'] ?? null,
            'meta_tag_title' => $validatedData['meta_title'] ?? null,
            'meta_tag_description' => $validatedData['meta_tag_description'] ?? null,
            'meta_tag_keywords' => $validatedData['meta_tag_keywords'] ?? null,
            'thumbnail' => $upload ? $upload->path : null,
        ]);

        $product->categories()->sync($validatedData['category']);
        $product->units()->sync($validatedData['unit']);
        $product->brands()->sync($validatedData['brand']);
        $product->warehouses()->sync(
            array_fill_keys($validatedData['warehouses'], ['quantity' => $validatedData['stock']])
        );

        if (!empty($validatedData['selected_tag_ids'])) {
            $product->tags()->sync($validatedData['selected_tag_ids']);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $upload = $this->handleUpload($file);
                if ($upload) {
                    $product->images()->attach($upload->id, [
                        'type' => 'gallery',
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    public function show(string $id)
    {
        $product = Product::with(['categories', 'tags', 'units', 'brands', 'warehouses', 'images'])->findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::with(['categories', 'tags', 'units', 'brands', 'warehouses', 'images'])->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all(['id', 'name']);
        $stores = Warehouse::all();
        $units = Unit::all();
        $brands = Brand::all();
        $kt_ecommerce_add_product_options = Variation::all();

        return view('product.edit', compact(
            'product', 'categories', 'tags', 'stores', 'units', 'brands', 'kt_ecommerce_add_product_options'
        ));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'product_name' => 'required|unique:products,name,' . $id . '|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:published,draft',
            'category' => 'required|array',
            'category.*' => 'exists:categories,id',
            'unit' => 'required|array',
            'unit.*' => 'exists:units,id',
            'brand' => 'required|array',
            'brand.*' => 'exists:brands,id',
            'warehouses' => 'required|array',
            'warehouses.*' => 'exists:warehouses,id',
            'sku' => 'required|unique:products,sku,' . $id . '|max:255',
            'barcode' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'stock_alert' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'is_featured' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'on_sale' => 'nullable|boolean',
            'tax' => 'nullable|numeric|min:0|max:100',
            'vat_amount' => 'nullable|numeric|min:0|max:100',
            'manufacture' => 'nullable|date',
            'expiry' => 'nullable|date|after_or_equal:manufacture',
            'selected_tag_ids' => 'nullable|array',
            'selected_tag_ids.*' => 'exists:tags,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_tag_description' => 'nullable|string',
            'meta_tag_keywords' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:20480',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:20480',
            'kt_ecommerce_add_product_options' => 'nullable|array',
            'kt_ecommerce_add_product_options.*.discounttype' => 'required|in:nodiscount,percentage,fixed',
            'kt_ecommerce_add_product_options.*.percentage' => 'nullable|numeric|min:0|required_if:kt_ecommerce_add_product_options.*.discounttype,percentage',
            'kt_ecommerce_add_product_options.*.fixed' => 'nullable|numeric|min:0|required_if:kt_ecommerce_add_product_options.*.discounttype,fixed',
        ]);

        $product->update([
            'name' => $validatedData['product_name'],
            'description' => $validatedData['description'] ?? null,
            'status' => $validatedData['status'],
            'sku' => $validatedData['sku'],
            'barcode' => $validatedData['barcode'] ?? null,
            'stock' => $validatedData['stock'],
            'stock_alert' => $validatedData['stock_alert'] ?? null,
            'base_price' => $validatedData['price'],
            'sale_price' => $validatedData['sale_price'],
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_new' => $request->has('is_new') ? 1 : 0,
            'on_sale' => $request->has('on_sale') ? 1 : 0,
            'tax' => $validatedData['tax'] ?? null,
            'vat_amount' => $validatedData['vat_amount'] ?? null,
            'manufactured' => $validatedData['manufacture'] ?? null,
            'expiry' => $validatedData['expiry'] ?? null,
            'meta_tag_title' => $validatedData['meta_title'] ?? null,
            'meta_tag_description' => $validatedData['meta_tag_description'] ?? null,
            'meta_tag_keywords' => $validatedData['meta_tag_keywords'] ?? null,
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete(str_replace('storage/', '', $product->thumbnail));
            }
            $upload = $this->handleUpload($request->file('thumbnail'));
            if ($upload) {
                $product->thumbnail = $upload->path;
                $product->save();
            }
        }

        $product->categories()->sync($validatedData['category']);
        $product->units()->sync($validatedData['unit']);
        $product->brands()->sync($validatedData['brand']);
        $product->warehouses()->sync(
            array_fill_keys($validatedData['warehouses'], ['quantity' => $validatedData['stock']])
        );

        $product->tags()->sync($validatedData['selected_tag_ids'] ?? []);

        if ($request->hasFile('images')) {
            $product->images()->wherePivot('type', 'gallery')->detach();
            foreach ($request->file('images') as $index => $file) {
                $upload = $this->handleUpload($file);
                if ($upload) {
                    $product->images()->attach($upload->id, [
                        'type' => 'gallery',
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->thumbnail) {
            Storage::disk('public')->delete(str_replace('storage/', '', $product->thumbnail));
        }

        foreach ($product->images as $image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $image->path));
            $product->images()->detach($image->id);
        }

        $product->categories()->detach();
        $product->tags()->detach();
        $product->units()->detach();
        $product->brands()->detach();
        $product->warehouses()->detach();
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }
}
