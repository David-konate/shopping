@extends('layouts.app')

@section('title')
Creer une categorie
@endsection

@section('content')

<div class="container-fluid px-5">
    <h1 class="page-title h1 ms-5 mt-4">Créatication d'une solde</h1>
    <form action="{{ route('categories.store') }}" class="needs-validation" method="POST">
        @csrf

        <div class="row mx-0  mt-5">
            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3 col-md-1 mx-auto text-center mt-3">
                <button type="submit" class="btn btn-outline-dark mt-4">Enregistrer</button>
            </div>
        </div>
    </form>
</div>

@endsection
