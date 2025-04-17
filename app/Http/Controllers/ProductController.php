<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\Unit;
use App\Models\Upload;
use App\Models\Variation;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         // Fetch all products with relevant data like SKU, quantity, price, etc.
        $products = Product::select('id', 'name', 'description','sku', 'stock', 'base_price', 'sale_price', 'status')->get();
        return view('product.index', compact('products'));
    }


     /**
     * Search or fetch products based on query or barcode.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all(['id', 'name']); // Fetch both ID and name
        $stores = Warehouse::all();
        $units = Unit::all();
        // $kt_ecommerce_add_product_options = Variation::with('values')->get(); // Ensure relations are loaded
        $brands = Brand::all();
        $kt_ecommerce_add_product_options = Variation::all();


        return view('product.add', compact('categories', 'tags', 'stores', 'units', 'brands'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_name' => 'required|unique:products,name|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:published,draft',
            'category' => 'required|exists:categories,id',
            'unit' => 'required|exists:units,id',
            'brand' => 'required|exists:brands,id',
            'warehouses' => 'required|exists:warehouses,id',
            //'warehouses.*' => 'exists:warehouses,id',
            // 'quantities' => 'required|array',
            // 'quantities.*' => 'integer|min:0',
            'sku' => 'required|unique:products,sku|max:255',
            'barcode' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'stock_alert' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'is_featured' => 'required|numeric|min:0',
            'is_new' => 'required|numeric|min:0',
            'on_sale' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0|max:100',
            'vat_amount' => 'nullable|numeric|min:0|max:100',
            'manufacture' => 'nullable|date',
            'expiry' => 'nullable|date|after_or_equal:manufacture',
            'selected_tag_ids' => 'nullable|json',
            'meta_title' => 'nullable|string|max:255',
            'meta_tag_description' => 'nullable|string',
            'meta_tag_keywords' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'kt_ecommerce_add_product_options' => 'nullable|array',
            'kt_ecommerce_add_product_options.*.discounttype' => 'required|in:nodiscount,percentage,fixed',
            'kt_ecommerce_add_product_options.*.percentage' => 'nullable|numeric|min:0|required_if:kt_ecommerce_add_product_options.*.discounttype,percentage',
            'kt_ecommerce_add_product_options.*.fixed' => 'nullable|numeric|min:0|required_if:kt_ecommerce_add_product_options.*.discounttype,fixed',
        ]);

        // Create the product
        $product = new Product();
        $product->name = $validatedData['product_name'];
        $product->description = $validatedData['description'] ?? null;
        $product->status = $validatedData['status'];
        $product->sku = $validatedData['sku'];
        $product->barcode = $validatedData['barcode'] ?? null;
        $product->stock = $validatedData['stock'];
        $product->stock_alert = $validatedData['stock_alert'] ?? null;
        $product->base_price = $validatedData['price'];
        $product->sale_price = $validatedData['sale_price'];
        $product->is_featured = $validatedData['is_featured'];
        $product->is_new = $validatedData['is_new'];
        $product->on_sale = $validatedData['on_sale'];
        $product->tax = $validatedData['tax'] ?? null;
        $product->vat_amount = $validatedData['vat_amount'] ?? null;
        $product->manufactured = $validatedData['manufacture'] ?? null;
        $product->expiry = $validatedData['expiry'] ?? null;
        $product->meta_tag_title = $validatedData['meta_title'] ?? null;
        $product->meta_tag_description = $validatedData['meta_tag_description'] ?? null;
        $product->meta_tag_keywords = $validatedData['meta_tag_keywords'] ?? null;

        // Handle the thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $upload = $this->handleUpload($request->file('thumbnail'));
            if ($upload) {
                $product->thumbnail = $upload->path;
            }
        }

        $product->save();

        // Attach relationships
        $product->categories()->sync([$validatedData['category']]);
        $product->brands()->sync([$validatedData['brand']]);
        $product->units()->sync([$validatedData['unit']]);
        $product->warehouses()->sync($validatedData['warehouses']);

        if (!empty($validatedData['selected_tag_ids'])) {
            $tagIds = json_decode($validatedData['selected_tag_ids'], true);
            if (is_array($tagIds)) {
                $product->tags()->sync($tagIds);
            }
        }

        // Handle product images uploads and associate with ProductImage model
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $file) {

                $upload = $this->handleMultipleUpload($file);
                if ($upload) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'upload_id' => $upload->id,
                        'sort_order' => $index + 1, // Assigning a sequential order
                    ]);
                }


            }
        }

        return redirect()->back()->with('success', 'Product created successfully!');


    }

    public function uploadImages(Request $request)
    {
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $path = $file->store('thumbnails', 'public');

            // Save to database
            $upload = Upload::create([
                'path' => 'storage/' . $path,
                'filename' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
            ]);

            return response()->json(['path' => $upload->path]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    private function handleUpload($file)
    {
        try {
            if (!$file->isValid()) {
                throw new \Exception('Invalid file uploaded');
            }

            // Create image instance
            $image = Image::make($file);

            // Resize image while maintaining aspect ratio
            $image->fit(400, 400, function ($constraint) {
                $constraint->upsize(); // Prevent upsizing if image is smaller
            });

            // Generate unique filename
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $path = 'thumbnails/' . $filename;

            // Save resized image to storage
            Storage::disk('public')->put($path, (string) $image->encode());

            return Upload::create([
                'path' => 'storage/' . $path,
                'filename' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientOriginalExtension(),
                'size' => $image->filesize(), // Get size after resizing
            ]);

        } catch (\Exception $e) {
            \Log::error('File upload failed: ' . $e->getMessage());

            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            return null;
        }
    }

    private function handleMultipleUpload($file)
    {
        try {
            if (!$file->isValid()) {
                throw new \Exception('Invalid file uploaded');
            }

            // Create image instance
            $image = Image::make($file);

            // Resize image while maintaining aspect ratio
            $image->fit(400, 400, function ($constraint) {
                $constraint->upsize(); // Prevent upsizing if image is smaller
            });

            // Generate unique filename
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $path = 'thumbnails/' . $filename;

            // Save resized image to storage
            Storage::disk('public')->put($path, (string) $image->encode());

            return Upload::create([
                'path' => 'storage/' . $path,
                'filename' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientOriginalExtension(),
                'size' => $image->filesize(), // Get size after resizing
            ]);

        } catch (\Exception $e) {
            \Log::error('File upload failed: ' . $e->getMessage());

            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            return null;
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
       return view('product.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         $product = Product::findOrFail($id);

         // Validate the incoming request data
         $validatedData = $request->validate([
             'product_name' => 'required|unique:products,name,' . $id . '|max:255',
             'description' => 'nullable|string',
             'status' => 'required|string|in:published,draft',
             'category' => 'required|exists:categories,id',
             'unit' => 'required|exists:units,id',
             'brand' => 'required|exists:brands,id',
             'warehouses' => 'required|array',
             'warehouses.*' => 'exists:warehouses,id',
             'sku' => 'required|unique:products,sku,' . $id . '|max:255',
             'barcode' => 'nullable|string|max:255',
             'stock' => 'required|integer|min:0',
             'stock_alert' => 'nullable|integer|min:0',
             'price' => 'required|numeric|min:0',
             'tax' => 'nullable|numeric|min:0|max:100',
             'vat_amount' => 'nullable|numeric|min:0|max:100',
             'manufacture' => 'nullable|date',
             'expiry' => 'nullable|date|after_or_equal:manufacture',
             'selected_tag_ids' => 'nullable|json',
             'meta_title' => 'nullable|string|max:255',
             'meta_tag_description' => 'nullable|string',
             'meta_tag_keywords' => 'nullable|string',
             'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
             'images' => 'nullable|array',
             'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
         ]);

         // Update product details
         $product->update([
             'name' => $validatedData['product_name'],
             'description' => $validatedData['description'] ?? null,
             'status' => $validatedData['status'],
             'sku' => $validatedData['sku'],
             'barcode' => $validatedData['barcode'] ?? null,
             'stock' => $validatedData['stock'],
             'stock_alert' => $validatedData['stock_alert'] ?? null,
             'base_price' => $validatedData['price'],
             'tax' => $validatedData['tax'] ?? null,
             'vat_amount' => $validatedData['vat_amount'] ?? null,
             'manufactured' => $validatedData['manufacture'] ?? null,
             'expiry' => $validatedData['expiry'] ?? null,
             'meta_tag_title' => $validatedData['meta_title'] ?? null,
             'meta_tag_description' => $validatedData['meta_tag_description'] ?? null,
             'meta_tag_keywords' => $validatedData['meta_tag_keywords'] ?? null,
         ]);

         // Handle thumbnail update
         if ($request->hasFile('thumbnail')) {
             $upload = $this->handleUpload($request->file('thumbnail'));
             if ($upload) {
                 $product->thumbnail = $upload->path;
                 $product->save();
             }
         }

         // Sync relationships
         $product->categories()->sync([$validatedData['category']]);
         $product->brands()->sync([$validatedData['brand']]);
         $product->units()->sync([$validatedData['unit']]);
         $product->warehouses()->sync($validatedData['warehouses']);

         if (!empty($validatedData['selected_tag_ids'])) {
             $tagIds = json_decode($validatedData['selected_tag_ids'], true);
             if (is_array($tagIds)) {
                 $product->tags()->sync($tagIds);
             }
         }

         // Update images images
         if ($request->hasFile('images')) {
             // Remove old images
             ProductImage::where('product_id', $product->id)->delete();

             // Add new images
             foreach ($request->file('images') as $index => $file) {
                 $upload = $this->handleUpload($file);
                 if ($upload) {
                     ProductImage::create([
                         'product_id' => $product->id,
                         'upload_id' => $upload->id,
                         'sort_order' => $index + 1,
                     ]);
                 }
             }
         }

         return redirect()->back()->with('success', 'Product updated successfully!');
     }


    /**
     * Remove the specified resource from storage.
     */


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete images images
        ProductImage::where('product_id', $product->id)->delete();

        // Delete thumbnail file (optional, if needed)
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        // Delete product record
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

}
