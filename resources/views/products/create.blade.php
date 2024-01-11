@extends('layouts.app')

@section('title')
Créer un produit
@endsection

@section('content')
<div class="container-fluid px-5">
    <h1 class="page-title h1 ms-5 mt-4">Création d'un produit</h1>
    <form action="{{ route('products.store') }}" class="needs-validation" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mx-0 form-create-prod mt-5">
            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="presentation" class="form-label">Présentation</label>
                <input type="text" class="form-control" id="presentation" name="presentation" required>
            </div>

            <div class="mb-3 col-md-6 mx-auto mt-2">
                <label for="category_id" class="form-label">Catégorie</label>
                <select class="form-select text-black" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                    <option class="text-dark" value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6 mx-auto mt-2">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>

            <div class="d-flex justify-content-evenly">
                <div class="mb-3 col-md-1 mx-auto">
                    <label for="price" class="form-label">Prix</label>
                    <input type="number" class="form-control" id="price" name="price" required step="1" pattern="\d+">
                </div>

                <div class="mb-3 col-md-1 mx-auto">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required step="1" pattern="\d+">
                </div>
            </div>


            <div class="mb-3 col-md-6 mx-auto text-center">
                <button type="submit" class="btn btn-outline-dark">Enregistrer</button>
            </div>
        </div>
    </form>
</div>

@endsection
