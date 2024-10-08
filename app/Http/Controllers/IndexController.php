<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function products($id)
    {
        //
        $products = Books::findOrFail($id);
        return view("main.products", compact('products'));
    }

    public function about()
    {
        //
        return view("main.about");
    }

    public function contact()
    {
        //
        return view("main.contact");
    }

    public function shop()
    {
        //
//        $category = Categories::where("category")

        $product = Books::with('categories')->get();
        return view('main.shop', compact('product'));
    }

    public function admin()
    {
        //
        $categories = Categories::all();
        return view("main.admin", compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
