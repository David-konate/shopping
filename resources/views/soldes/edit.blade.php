@extends('layouts.app')

@section('title')
Modifier une solde
@endsection

@section('content')

<div class="container-fluid px-5">
    <h1 class="page-title h1 ms-5 mt-4">Modification d'une solde</h1>
    <form action="{{ route('soldes.update', $solde->id) }}" class="needs-validation" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <form action="{{ route('soldes.destroy', $solde->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="d-flex justify-content-end">
            <button class="btn btn-outline-danger btn-sm" type="submit">Supprimer</a>
        </div>
    </form>

        <div class="row mx-0 form-create-prod mt-5">
            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" value="{{ $solde->name }}" name="name" required>
            </div>

            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="product_id" class="form-label">Produit lié à la solde</label>
                <select class="form-select" id="product_id" name="product_id" >
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $solde->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6 mx-auto">
                <label for="start_date" class="form-label">Début de la promo</label>
                <input type="date" class="form-control custom-input" id="start_date" value="{{ $solde->start_date }}" name="start_date">
            </div>



            <div class="mb-3 col-md-6 mx-auto">
                <label for="end_date" class="form-label">Fin de la promo</label>
                <input type="date" class="form-control custom-input" id="end_date" value="{{ $solde->end_date }}" name="end_date" value="">
            </div>

            <div class="mb-3 col-md-1 mx-auto">
                <label for="percentage" class="form-label">Pourcentage appliqué</label>
                <input type="number" class="form-control" id="percentage" name="percentage" value="{{ $solde->percentage }}" required step="1" pattern="\d+">
            </div>

            <div class="mb-3 col-md-1 mx-auto">

            </div>


            <div class="mb-3 col-md-6 mx-auto text-center">
                <button type="submit" class="btn btn-outline-dark">Enregistrer</button>
            </div>
        </div>
    </form>
</div>

@endsection
