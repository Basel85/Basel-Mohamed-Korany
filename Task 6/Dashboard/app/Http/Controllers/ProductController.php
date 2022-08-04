<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $brands = DB::Table('brands_')->select('id', 'name_en')->orderBy('name_en')->get();
        $subcategories = DB::Table('subcategories')->select('id', 'name_en')->orderBy('name_en')->get();
        return view('products.create', compact("brands", "subcategories"));
    }

    public function edit(int $id)
    {
        $product = DB::TABLE('products')->where('id', $id)->first();
        $brands = DB::Table('brands_')->select('id', 'name_en')->orderBy('name_en')->get();
        $subcategories = DB::Table('subcategories')->select('id', 'name_en')->orderBy('name_en')->get();
        return view('products.edit', compact("brands", "subcategories", "product"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'between:0,999999.99'],
            'quantity' => ['required', 'integer', 'between:1,999'],
            'code' => ['required', 'integer', 'between:1,999999', 'unique:products,code'],
            'status' => ['required', 'in:0,1'],
            'details_en' => ['required', 'string'],
            'details_ar' => ['required', 'string'],
            'image' => ['required', 'max:1024', 'mimes:jpg,png,jpeg'],
            'brand_id' => ['required', 'integer', 'exists:brands_,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
        ]);
        $newImageName = $request->file('image')->hashName();
        $request->file('image')->move(public_path('images\products'), $newImageName);
        $productData = $request->except('image', '_token');
        $productData['image'] = $newImageName;
        if (DB::TABLE('products')->insert($productData)) {
            return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, int $id)
    {

        $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'between:0,999999.99'],
            'quantity' => ['required', 'integer', 'between:1,999'],
            'code' => ['required', 'integer', 'between:1,999999', 'unique:products,code, ' . $id],
            'status' => ['required', 'in:0,1'],
            'details_en' => ['required', 'string'],
            'details_ar' => ['required', 'string'],
            'image' => ['nullable', 'max:1024', 'mimes:jpg,png,jpeg'],
            'brand_id' => ['required', 'integer', 'exists:brands_,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
        ]);
        $productData = $request->except('image', '_token', '_method');

        if ($request->hasFile('image')) {
            $newImageName = $request->file('image')->hashName();
            $request->file('image')->move(public_path('images\products'), $newImageName);
            $productData['image'] = $newImageName;
            $photoName = DB::TABLE('products')->select('image')->where('id', $id)->first()->image;
            $photoPath = public_path("images\products\\{$photoName}");
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        if (DB::TABLE('products')->where('id', $id)->update($productData)) {
            return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function delete(int $id)
    {
        $photoName = DB::TABLE('products')->select('image')->where('id', $id)->first()->image;
        $photoPath = public_path("images\products\\{$photoName}");
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
        DB::TABLE('products')->where('id',$id)->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
