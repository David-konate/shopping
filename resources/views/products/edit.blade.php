@extends('layouts.app')

@section('title')
Modifier un produit
@endsection

@section('content')

<div class="container-fluid px-5">

    <h1 class="page-title h1 ms-5 mt-4">Modification d'un produit</h1>
    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="d-flex justify-content-end">
            <button class="btn btn-outline-danger btn-sm" type="submit">Supprimer</a>
        </div>
    </form>
    <form action="{{ route('products.update', $product->id) }}" class="needs-validation" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row mx-0 form-create-prod mt-5">
            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" value="{{ $product->name }}" name="name" required>
            </div>

            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="presentation" class="form-label">Présentation</label>
                <input type="text" class="form-control" id="presentation" value="{{ $product->presentation }}" name="presentation" required>
            </div>

            <div class="mb-3 col-md-6 mx-auto">
                <label for="category_id" class="form-label">Categories</label>
                <select class="form-select" id="category_id" name="category_id">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6 mx-auto mt-2">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" value="" name="description" required>{{ $product->description }}</textarea>
            </div>

            <div class="d-flex justify-content-evenly">
                <div class="mb-3 col-md-1 mx-auto">
                    <label for="price" class="form-label">Prix</label>
                    <input type="number" class="form-control" id="price" value="{{ $product->price }}" name="price" required step="1" pattern="\d+">
                </div>

                <div class="mb-3 col-md-1 mx-auto">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" value="{{ $product->stock }}" name="stock" required step="1" pattern="\d+">
                </div>
            </div>





            <div class="mb-3 col-md-6 mx-auto text-center">
                <div class="mb-5 ms-5 form-check">
                    <input class type="checkbox" class="form-check-input" id="welcome" name="welcome" {{ $product->welcome ? 'checked' : '' }}>
                    <label class="form-check-label" for="welcome">IMettre en avant sur la page d'accueil</label>
                </div>
                <div class="form-group col-md-6 me-5">
                    <label for="images" class="form-label">Photos</label>
                    <input type="file" class="form-control custom-input" name="images[]" id="images" multiple>
                </div>

                <button type="submit" class="btn btn-outline-dark mt-4 mb-2">Enregistrer</button>
            </div>
        </div>
    </form>


    <div class="images-products">

        @if($product->images->count() > 0)
        @foreach($images as $image)

        <div class="img-hero-index-card mt-4">
            <form action="{{ route('images.destroy', $image->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm d-flex justify-content-center align-items-center" type="submit">
                    <i class="material-icons">delete</i>
                </button>
            </form>
            <div class="img-hero-index-card mt-">
            <img class="card-img-top img-products mt-2" style="width:400px;" src="{{ asset('storage/uploads/' . $image->image_url) }}" alt="Card image cap">
            </div>
        </div>
        @endforeach
        @else
        <div class="img-hero-index-card mt-4">
            <img src="{{ asset('images/npi.png') }}" alt="Product Image">
        </div>
        @endif

    </div>
</div>

@endsection
