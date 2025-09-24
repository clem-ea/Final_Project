<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        // admin routes protected by middleware in route definitions OR controller middleware
        $this->middleware('admin')->except(['index','show']);
    }

    // user view (catalog)
    public function index()
    {
        $products = Product::with('category')->paginate(12);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('products','public');
            $data['photo'] = $path;
        }
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success','Produk berhasil disimpan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            // hapus foto lama
            if ($product->photo) Storage::disk('public')->delete($product->photo);
            $data['photo'] = $request->file('photo')->store('products','public');
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success','Produk berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        if ($product->photo) Storage::disk('public')->delete($product->photo);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Produk berhasil dihapus.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
