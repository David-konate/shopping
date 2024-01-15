@extends('layouts.app')

@section('title')
Modifier une categorie
@endsection

@section('content')

<div class="container-fluid px-5">
    <h1 class="page-title h1 ms-5 mt-4">Modification d'une catégorie</h1>
    <form action="{{ route('categories.update', $category->id) }}" class="needs-validation" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-danger btn-sm" type="submit">Supprimer</a>
            </div>
        </form>

        <div class="row mx-0 mt-5">
            <div class="mb-3 col-md-6 mx-auto mt-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" value="{{ $category->name }}" name="name" required>
            </div>
        </div>


        <div class="mb-3 col-md-6 mx-auto text-center">
                <button type="submit" class="btn btn-outline-dark">Enregistrer</button>
            </div>
    </form>
</div>

@endsection
