<?php

namespace App\Http\Controllers;

use App\Models\Solde;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Récupérer les soldes ayant un product_id
        $soldes = Solde::where('start_date', '<=', now())
        ->where('end_date', '>', now())
        ->orderBy('start_date', 'asc')
        ->get();

    // Extraire les product_id distincts des soldes
    $productIds = $soldes->pluck('product_id')->unique();

    // Récupérer les produits associés aux product_id des soldes
    $products = Product::query()
        ->select('products.*')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->when(
            $request->q,
            function (Builder $builder) use ($request) {
                $builder
                    ->where('name', 'like', "%{$request->q}%")
                    ->orWhere('categories.name', 'like', "%{$request->q}%")
                    ->orderBy('name', 'asc');
            }
        )
        ->whereIn('products.id', $productIds)
        ->paginate(9);

    $images = ProductImage::all();
    $user_id = Auth::id();





        return view('welcome.index', compact('products', 'images', 'user_id', 'soldes'));
    }
}
