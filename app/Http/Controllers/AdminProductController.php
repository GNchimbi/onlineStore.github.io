<?php

namespace App\Http\Controllers;

use Inertia\inertia;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index() 
    {
        return Inertia::render('Admin/Products/Index', [
            'products' => Product::paginate(10),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Create');
    }
    public function store(StoreProductRequest $request)
    {
        $newProduct = new Product();
        $newProduct->setName($request->name);
        $newProduct->setDescription($request->description);
        $newProduct->setPrice($request->price);
        $newProduct->save();
        if($request->hasFile('image')){
            $imageName = $newProduct->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newProduct->setImage($imageName);
            $newProduct->save();
            $request->session()->flash('message', 'Product Created Successful!');
            return redirect()->route("admin.products.index");
        }
    }
    public function edit($id)
    {
        return Inertia::render('Admin/Products/Edit', [
            'product' => Product::findOrFail($id),
        ]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->setName($request->name);
        $product->setDescription($request->description);
        $product->setPrice($request->price);
        error_log($request->file('image'));
        if($request->hasFile('image')){
            $imageName = $product->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
            $product->save();
        }
        return redirect(route('admin.products.index'))->with('msg', 'Product updated successful!');
    }

    public function destroy(Request $request, $id) 
    {
        Product::destroy($id);
        $request->session()->flash('message', 'Product deleted sucessful!');
        return back();
    }
}
