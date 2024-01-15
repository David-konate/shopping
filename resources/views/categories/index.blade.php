@extends('layouts.app')

@section('content')
<div class="body" style="margin: 100px;">
    <div class="container">
        <div class="row">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="container mt-5">
                <form action="{{ route('products.index') }}" method="GET" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Recherche" name="q" value="{{ request('q') }}">
                    <button class="btn btn-outline-light mt-2" type="submit">Rechercher</button>
                </form>
            </div>
            <div class="container-fluid mt-4">
                <div class="row">
                    @foreach($categories as $category)
                    <div class="col-md-4">
                        <a href="{{ route('categories.edit', $category->id) }}" class="col-md-4 text-decoration-none">
                            <div class="card mb-3 custom-card text-center" id="soldeCard{{$category->id}}">
                                <div class="card-body-magic" style="min-height: 150px;">
                                    <h2 class="titre-card-solde text-white backgroun-color-secondary mt-2 mb-2">
                                        {{$category->name}}
</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
