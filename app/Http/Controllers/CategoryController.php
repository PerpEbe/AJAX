<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
// use DataTable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $categories = Category::all();
    //     if($request->ajax()) {
    //         return DataTables::of($categories)->make(true);
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
        ]);

        Category::create([
            'name'=>$request->name,
            'type'=>$request->type,
        ]);

        return response()->json([
            'success'=>'Category Saved Successfully'
        ], 201);
    }

    public function fetch() {
        $categories=Category::all();
        return response()->json([
            'categories'=>$categories,
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
