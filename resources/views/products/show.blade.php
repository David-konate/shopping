@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center mt-5">
            <div class="card custom-card mt-4 mx-auto" style="max-width: 1000px;">
                <div class="row g-0 custom-card">
                    <!-- Top Section -->
                    <div class="img-product-index col-md-4">
                        <div class="img-hero-index-card mt-4">
                            <div id="carouselExampleControls" class="carousel slide mt-3" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }} image-prod-detail ms-4">
                                        {{$loop->iteration}}
                                        <img src="{{ asset($image->image_url) }}" alt="Product Image">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mt-4">
                        <!-- Top-right content -->
                        <div class="col-md-12 text-end">
                            <div class="card-body me-5 boxshadow-color-secondary" id="slidingDiv2">
                                <h1 class="card-title text-black red-background boxshadow-secondary-color">{{ $product->name }}</h1>
                            </div>
                            <div>
                                <h5 class="card-text mb-1 mt-3 me-4
                                 text-black"><small>{{ $product->description }}</small>
                                </h5>

                            </div>
                        </div>
                        <div class="price-prod-detail text-end ms-4">
                            @php $hasSolde = false; @endphp
                            @foreach($soldes as $solde)
                            @if($solde->product_id == $product->id)
                            @php $hasSolde = true; @endphp
                            @php
                            $nouveau_prix = round($product->price - ($solde->percentage * $product->price / 100), 2);
                            @endphp
                            <div class="mt-3 d-flex justify-content-evenly">
                                <p class="text-center mt-1"><del>{{$product->price}} €</del></p>
                                <p class="text-center font-weight-bold fs-5">{{ $nouveau_prix }} €</p>
                            </div>
                            <p class="mt-2 text-left remise text-center">Remise de {{$solde->percentage}} %</p>
                            @break
                            @endif
                            @endforeach
                            @if(!$hasSolde)
                            <div class="row g-0 custom-card " id="slidingDiv" style="width: 0; overflow: hidden;">
                                <div id="slidingDiv" class="mt-3 d-flex justify-content-evenly background-color-secondary boxshadow-secondary-color">
                                    <p class="mt-3 fs-5">{{$product->price}} €</p>
                                </div>
                            </div>
                            <div class="mt-3 d-flex justify-content-end">
                                <p class="mt-3 fs-5 me-5">Stock : {{$product->stock}} unités</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // Animation pour faire glisser la div de droite à gauche
                $("#slidingDiv").animate({
                    width: '100%', // Définir la largeur à 100% de la largeur parente
                    marginLeft: '0' // Définir la marge gauche à 0
                }, "slow");
            });

        </script>
    </div>
</div>
@endsection
