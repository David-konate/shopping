<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Solde;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::query()
            ->select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->when(
                $request->q,
                function (Builder $builder) use ($request) {
                    $builder
                        ->where('products.name', 'like', "%{$request->q}%")
                        ->orWhere('categories.name', 'like', "%{$request->q}%")
                        ->orderBy('products.name', 'asc');
                }
            )->get();
        // ->paginate(9);

        $images = ProductImage::all();
        $categories = Category::all();
        $soldes = Solde::orderBy('start_date', 'asc')->get();


        return view('products.index', compact('products', 'images', 'categories', 'soldes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('products.create', compact('categories',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $product = Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'presentation' =>  $request->presentation,
            'description' =>  $request->description,
            'price' =>  $request->price,
            'welcome' => false,  //pas sur la page d'acceuil par default
            'stock' =>  $request->stock,
            'category_id' =>  $request->category_id,
            'solde_id' => null,
        ]);

          // Attachement des images
        //   $imageIds = $request->input('images_ids', []);
        //   $images = Image::find($imageIds);

        //   $product->images()->saveMany($images);

        return redirect()->route('products.index')
            ->with('success', 'Produit ajouté avec succès !');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $images = ProductImage::where('product_id', $product->id)
            ->get();;
        $categories = Category::all();
        $soldes = Solde::where('product_id', $product->id)
            ->orderBy('start_date', 'asc')
            ->get();

        return view('products.show', compact('product', 'images', 'categories', 'soldes'));
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
