@extends('layouts.app')

@section('content')
<div id="productCarousel" class="carousel slide" data-ride="carousel">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="carousel-inner text-white">
        @foreach($products as $key => $product)
        <div class="carousel-item {{$key == 0 ? 'active' : ''}} box-sha-primary">
            <div class="box-sha-primary">
                <a href="{{ route('products.show', $product->id) }}">
                <!-- Ajouter l'image dans le coin supérieur gauche -->
                <img src="{{ asset('images/solde.jpg') }}" alt="Overlay Image" class="overlay-image">
                <div class="carou-img">
                    <div class="img-solde d-flex justify-content-between">
                        <div class="img-solde">
                            @if($product->images->count() >= 3)
                            <img src="{{ asset('storage/uploads/' .  $product->images[0]->image_url) }}" alt="Product Image">
                            @else
                            <!-- Afficher une image par défaut ou un message selon votre besoin -->
                            <img src="{{ asset('images/npi.png') }}" alt="Image par défaut">
                            @endif
                        </div>
                        <div class="img-solde">
                            @if($product->images->count() >= 2)
                            <img src="{{ asset( 'storage/uploads/' . $product->images[1]->image_url) }}" class="" alt="Product Image">
                            @else
                            <!-- Afficher une image par défaut ou un message selon votre besoin -->
                            <img src="{{ asset('images/npi.png') }}" alt="Image par défaut">
                            @endif
                        </div>
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-bold secondary-color">{{$product->name}}</h1>
                    </div>
                </div>
                </a>
            </div>
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
        <div class="col-md-8 mt-5">
            <h1 class="card-header background-primary text-white text-center">
                <a href="{{ route('products.index') }}" class=" secondary-color background-primary text-decoration-none">Shopping.com</a>
            </h1>
        </div>
    </div>
</div>

@endsection
