@extends('layouts.app')

@section('content')
<div id="productCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner text-white">
        @foreach($products as $key => $product)
            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                @if($product->images->count() > 0)
                <div class="img-solde">
                    <img src="{{ asset($product->images->first()->image_url) }}" class="d-block w-100" alt="Product Image">
                </div>
                @else
                    <div class="card mb-3 custom-card mt-4">
                        <p>{{$product->name}}</p>
                        <p>No Image Available</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
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
