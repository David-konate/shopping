<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Solde;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class SoldeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $soldes = Solde::orderBy('name', 'asc')->get();
        $products = Product::orderBy('name', 'asc')->get();
        $images = ProductImage::all();

        return view('soldes.index', compact('soldes', 'products', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $soldes = Solde::all();
        $products = Product::join('soldes', 'soldes.product_id', '=', 'products.id')->get();

        $images = ProductImage::all();

        return view('soldes.create', compact('products', 'images', 'soldes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $user_id = Auth::id();
        $solde = Solde::create([
            'name'       => $request->name,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'percentage' => $request->percentage,
            'product_id'    => $request->product_id,
            'user_id'   => $user_id
        ]);

        $solde->save();

        return redirect()->route('soldes.index')
            ->with('success', 'Solde ajouté avec succès !');
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
        $solde = Solde::find($id);
        $products = Product::join('soldes', 'soldes.product_id', '=', 'products.id')->get();

        $images = ProductImage::all();

        return view('soldes.edit', compact('products', 'images', 'solde'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $user_id = Auth::id();

        $solde = Solde::find($id);

        $solde->name = $request->name;
        $solde->start_date = $request->start_date;
        $solde->end_date   = $request->end_date;
        $solde->percentage = $request->percentage;
        $solde->product_id    = $request->product_id;
        $solde->user_id   = $user_id;


        $solde->save();

        return redirect()->route('soldes.index')
            ->with('success', 'Solde ajouté avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $solde = Solde::findOrFail($id);
        $solde->delete();
        return redirect('/soldes')->with('success', 'Solde supprimé avec succès');
    }
}
