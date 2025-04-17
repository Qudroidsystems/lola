<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Upload;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        //  $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:user-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::with('cover')->get();
        return view('category.index')->with('categories',$categories);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.add');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => ['required', 'unique:categories,name'],
            'description' => ['nullable', 'max:250'],
            'status' => ['required'], // Optional, add valid statuses
            'avatar' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Max file size is 2MB
        ]);

        // Check if a file is uploaded
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            // Store the file using Laravel's storage system
            $path = $file->storeAs('uploads', uniqid().'.'.$file->getClientOriginalExtension(), 'public');


            // Save file metadata in the uploads table
            $upload = Upload::create([
                'path' => $path,
                'filename' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);

            if (! $upload) {
                return response()->json(['error' => 'Failed to save upload'], 500);
            }

            // Save the category and associate the upload's ID
            $category = Category::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'status' => $validatedData['status'], // Ensure it matches allowed values
                'cover_id' => $upload->id, // Use the uploaded file's ID
                'meta_tag_title'=> $request->meta_tag_title,
                'meta_tag_description'=> $request->meta_tag_description,
                'meta_tag_keywords' => $request->meta_tag_keywords,

            ]);

            return redirect()->back()->with('success', 'Category created successfully!');
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

       $category = Category::with('cover')->find($id);
       return view('category.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
                // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => ['required', 'unique:categories,name,' . $id], // Exclude current category from unique check
                'description' => ['nullable', 'max:250'],
                'status' => ['required'], // Ensure valid statuses
                'avatar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Avatar is optional
                'meta_tag_title' => ['nullable', 'string'],
                'meta_tag_description' => ['nullable', 'string'],
                'meta_tag_keywords' => ['nullable', 'string'],
            ]);

            // Find the category by ID
            $category = Category::findOrFail($id);

            // Check if a new file is uploaded
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');

                // Store the file using Laravel's storage system
                $path = $file->storeAs('uploads', uniqid() . '.' . $file->getClientOriginalExtension(), 'public');

                // Save file metadata in the uploads table
                $upload = Upload::create([
                    'path' => $path,
                    'filename' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                ]);

                if (!$upload) {
                    return response()->json(['error' => 'Failed to save upload'], 500);
                }

                // Update the category's cover_id with the new upload's ID
                $category->cover_id = $upload->id;
            }

            // Update other category fields
            $category->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'status' => $validatedData['status'],
                'meta_tag_title' => $validatedData['meta_tag_title'],
                'meta_tag_description' => $validatedData['meta_tag_description'],
                'meta_tag_keywords' => $validatedData['meta_tag_keywords'],
            ]);

            return redirect()->back()->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $category = Category::find($id);

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found.']);
        }
    
        // Optionally remove associated files
        if ($category->cover) {
            \Storage::disk('public')->delete($category->cover->path);
            $category->cover->delete();
        }
    
        $category->delete();
    
        return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
    }

        
    public function deletecategory(Request $request)
    {
        
                    // Find the category by ID
                $category = Category::with('cover')->findOrFail($request->categoryid);

                // Check if the category has an associated cover
                if ($category->cover) {
                    // Verify the file path
                    $filePath = $category->cover->path;

                    // Delete the file from the storage
                    if (\Storage::disk('public')->exists($filePath)) {
                        \Storage::disk('public')->delete($filePath);
                    }

                    // Delete the associated upload record
                    $category->cover->delete();
                }

                // Delete the category itself
               $delete =  $category->delete();
                //check data deleted or not
                if ($delete) {
                    $success = true;
                    $message = "Category has been removed";
                } else {
                    $success = true;
                    $message = "Category not found";
                }
                
                //  return response
                return response()->json([
                    'success' => $success,
                    'message' => $message,
                ]);

       
          }

                  
    }
