<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Solde;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

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
        $soldes = Solde::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->get();

        $user = Auth::user();
        // dd($user_id);
        return view('products.index', compact('products', 'user', 'images', 'categories', 'soldes',));
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
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Produit ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $images = ProductImage::where('product_id', '=', $product->id)->get();
        $categories = Category::all();
        $soldes = Solde::where('product_id', $id)
            ->orderBy('start_date', 'asc')
            ->get();

        $user = Auth::user();


        return view('products.show', compact('product', 'images', 'categories', 'soldes', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::orderBy('name', 'asc')->get();
        $images = ProductImage::where('product_id', '=', $product->id)->get();

        return view('products.edit', compact('product', 'categories','images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            // Ajoutez ici d'autres règles de validation pour d'autres champs si nécessaire
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produit non trouvé');
        }

        $product->name = $request->input('name');
        $product->presentation = $request->input('presentation');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category_id'); // Assurez-vous que c'est la bonne propriété
        $product->welcome = $request->has('welcome');

        // Vérifiez si de nouveaux fichiers d'image sont téléchargés
        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');

            foreach ($uploadedImages as $uploadedImage) {
                $filenameWithExt = $uploadedImage->getClientOriginalName();
                $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $uploadedImage->getClientOriginalExtension();
                $filename = $filenameWithExt . '_' . time() . '.' . $extension;
                $uploadedImage->storeAs('public/uploads/', $filename);

                if ($request->has('image')) {
                    $fileName = uniqid() . '.' . $request->image->extension();
                    $request->image->storeAs('public/products', $fileName);
                }

                $productImage = new ProductImage();
                $productImage->image_url = $filename;
                $product->images()->save($productImage);
            }
        }


        $product->save();

        return redirect()->route('products.index')->with('success', 'Le produit a été mis à jour avec succès !');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

         // Supprimer les avis liés au produit
    Review::where('product_id', $id)->delete();

        ProductImage::where('product_id', $id)->delete();

        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/products')->with('success', 'Produit supprimé avec succès');
    }
}
