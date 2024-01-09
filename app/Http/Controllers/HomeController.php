<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

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

        $products = Product::query()
        ->select('products.id', 'products.name', 'products.description', 'products.presentation' )
        ->join('categories', 'products.category_id', '=', 'categories.id')
            ->when(
                $request->q,
                function (Builder $builder) use ($request) {
                    $builder
                        ->where('name', 'like', "%{$request->q}%")
                        ->orWhere('categories.categotyName', 'like', "%{$request->q}%")
                        ->orderBy('name', 'asc')
                        ->get();
                }
            )
            ->paginate(9);
            $images = ProductImage::all();

        return view('welcome.index', compact('products', 'images'));
    }
}
