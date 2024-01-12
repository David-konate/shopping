<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        // Récupérez l'utilisateur en cours
        $useNow = Auth::user();
        if ($useNow->role_id != 2) {
            return redirect()->route('products.index')
            ->with('error', 'Acces impossible !');
        }
        $products = Product::orderBy('name', 'asc')->get();

        $users = User::orderBy('last_name', 'asc')->get();

        return view('admin.index', compact('useNow', 'products', 'users'));
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
