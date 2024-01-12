@extends('layouts.app')

@section('title')
Creer une solde
@endsection

@section('content')

<div class="container-fluid px-5">
    <h1 class="page-title h1 ms-5 mt-4">Créatication d'une solde</h1>
    <form action="{{ route('soldes.store') }}" class="needs-validation" method="POST">
        @csrf

        <div class="row mx-0 form-create-prod mt-5">
            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="product_id" class="form-label">Produit lié à la solde</label>
                <select class="form-select" id="product_id" name="product_id">
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ isset($solde) && $solde->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6 mx-auto">
                <label for="start_date" class="form-label">Début de la promo</label>
                <input type="date" class="form-control custom-input" id="start_date" name="start_date">
            </div>

            <div class="mb-3 col-md-6 mx-auto">
                <label for="end_date" class="form-label">Fin de la promo</label>
                <input type="date" class="form-control custom-input" id="end_date" name="end_date" value="">
            </div>

            <div class="mb-3 col-md-1 mx-auto">
                <label for="percentage" class="form-label">Pourcentage appliqué</label>
                <input type="number" class="form-control" id="percentage" name="percentage" required step="1" pattern="\d+">
            </div>

            <div class="mb-3 col-md-1 mx-auto">

            </div>


            <div class="mb-3 col-md-1 mx-auto text-center">
                <button type="submit" class="btn btn-outline-dark mt-4">Enregistrer</button>
            </div>
        </div>
    </form>
</div>

@endsection
