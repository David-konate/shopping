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
    <div class="row justify-content-center">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-3 custom-card bg-dark text-center">
                <div class="card-body-magic" style="min-height: 630px;">
                    <h2 class="titre-card-product titre-card-product mt-2 mb-2">
                        {{$product->name}}
                    </h2>
                    <div class="img-hero-index-card mt-4">
                        @if($product->images->count() > 0)
                        <img class="card-img-top img-products" src="{{ asset($product->images->first()->image_url) }}" alt="Card image cap">
                        @else
                        <img class="card-img-top img-products" src="{{ asset('images/basket.jpg') }}" alt="Product Image">
                        @endif
                    </div>

                    <div class="card-section mt-4 mb-2">{{$product->category->name}}</div>
                    <div>
                        <div class="presentation mt-3 text-center" style="width: 90%; margin: 0 auto;">
                            <div>{{$product->presentation}}</div>
                        </div>
                        @php $hasSolde = false; @endphp
                        @foreach($soldes as $solde)
                        @if($solde->product_id == $product->id)
                        @php $hasSolde = true; @endphp

                        @php
                        $nouveau_prix = round($product->price - ($solde->percentage * $product->price / 100), 2);
                        @endphp
                        <div class="mt-3 text-white d-flex justify-content-evenly">
                            <p class="text-center mt-1"><del>{{$product->price}} €</del></p>
                            <p class="text-center font-weight-bold fs-5">{{ $nouveau_prix }} €</p>
                        </div>
                        <p class="mt-2 text-white text-left remise text-center">Remise de {{$solde->percentage}} %</p>
                        @break
                        @endif
                        @endforeach
                        @if(!$hasSolde)
                        <p class="mt-5 text-white text-left mt-3 fs-5">{{$product->price}} €</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



        </div>
        @endsection
