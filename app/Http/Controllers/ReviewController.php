<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Afficher le formulaire de création d'avis
         return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
              // Enregistrer le nouvel avis dans la base de données
              $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
                'comment' => 'required|string',
                'rating' => 'required|integer|between:1,5',
            ]);

            Review::create($data);

            return redirect()->route('reviews.index')->with('success', 'Avis enregistré avec succès!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
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
