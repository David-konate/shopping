@extends('layouts.app')

@section('content')
<div class="body" style="margin: 100px;">
    <div class="container">
        <div class="row">

            <a href="" class="text-decoration-none text-dark mt-4">
                <div class="card mb-3 custom-card mt-4" style="width: 550px;">
                    <div class="row g-0 custom-card">
                        <div class="img-product-index col-md-4">
                            <div class="img-hero-index-card mt-4">
                                @if($product->images->count() > 0)
                                <img class="card-img-top img-products" src="{{ asset($product->images->first()->image_url) }}" alt="Card image cap">
                                @else
                                <img class="card-img-top img-products" src="{{ asset('images/basket.jpg') }}" alt="Product Image">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8 text-center">
                            <div class="card-body">
                                <h3 class="card-title">{{ $product->pseudo }}</h3>
                                <h5 class="card-text mb-1"><small class=" text-white">{{ $product->name }} </small></h5>
                                <p class="card-text text-white"><small class=" text-white ">{{ $product->name }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>


            </a>

        </div>
        @endsection
