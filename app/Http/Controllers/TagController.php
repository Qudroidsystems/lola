<?php

namespace App\Http\Controllers;

use App\Models\Tag ;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tag.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //
         $validatedData = $request->validate([
            'name' => ['required', 'unique:tags,name'],

        ]);

        // Save the Tag
        $tag  = Tag::create([
            'name' => $validatedData['name'],
        ]);

        return redirect()->back()->with('success', 'Tag  created successfully!');
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
        $tag  = Tag::find($id);
        return view('tag.edit')->with('tag',$tag );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          // Validate the incoming request data
          $validatedData = $request->validate([
            'name' => ['required', 'unique:tags,name,' . $id], // Exclude current Tag  from unique check
        ]);

        // Find the tags by ID
        $tag  = Tag::findOrFail($id);



        // Update other tags fields
        $tag ->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->back()->with('success', 'Tag  updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag  =Tag::find($id);

        if (!$tag ) {
            return response()->json(['success' => false, 'message' => 'Tag  not found.']);
        }


        $tag ->delete();

        return response()->json(['success' => true, 'message' => 'Tag  deleted successfully.']);
    }
}
