@extends('layouts.app')

@section('content')
<div id="productCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner text-white">
        @foreach($products as $key => $product)
        <div class="carousel-item {{$key == 0 ? 'active' : ''}} box-sha-primary">
        @if($product->images->count() > 0)
        <div class="box-sha-primary">
            <!-- Ajouter l'image dans le coin supérieur gauche -->
            <img src="{{ asset('images/solde.jpg') }}" alt="Overlay Image" class="overlay-image">
            <div style="display: flex; justify-content: center;">
                <div class="img-solde">
                    <img src="{{ asset($product->images->first()->image_url) }}" alt="Product Image">
                </div>
                <div class="img-solde">
                    <img src="{{ asset($product->images->first()->image_url) }}" class="" alt="Product Image">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="text-bold">{{$product->name}}</h1>
                    <p style="background-color: #1118274b; margin-left: 15%; margin-right: 15%">{{$product->presentation}}</p>
                </div>
            </div>
        </div>
        @else
        <img src="{{ asset('images/solde.jpg') }}" alt="Overlay Image" class="overlay-image">
            <div  style="display: flex; justify-content: center;">
                <img src="{{ asset('images/basket.jpg') }}" alt="Product Image" style="height:600px;">
                <img src="{{ asset('images/basket.jpg') }}" alt="Product Image" style="height:600px;">
            </div>
            <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-bold" style="">{{$product->name}}</h1>
                        <p style="background-color: #1118274b; margin-left: 15%; margin-right: 15%">{{$product->presentation}}</p>
                    </div>
            @endif
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
        <span class="sr-only btn btn-outline-light">Previous</span>
    </a>
    <a class="carousel-control-next " href="#productCarousel" role="button" data-slide="next">
        <span class="sr-only btn btn-outline-light">Next</span>
    </a>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <h1 class="card-header background-primary text-white text-center">Shopping.com</h1>
            </div>
        </div>
    </div>
</div>

<!-- script Three.js -->

<!-- Ajoutez le script Bootstrap JavaScript (jQuery doit être inclus avant) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

@endsection
