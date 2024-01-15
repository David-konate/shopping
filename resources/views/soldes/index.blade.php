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
                    @foreach($soldes as $solde)
                    <div class="col-md-4">
                        <a href="{{ route('soldes.edit', $solde->id) }}" class="col-md-4 text-decoration-none">
                            <div class="card mb-3 custom-card text-center" id="soldeCard{{$solde->id}}">
                                <div class="card-body-magic" style="min-height: 150px;">
                                    <h2 class="titre-card-solde text-white backgroun-color-secondary mt-2 mb-2">
                                        {{$solde->name}}
                                    </h2>
                                    {{$solde->product_id}}

                                    <div class="d-flex justify-content-around">
    @foreach($products as $product)
        @if($solde->product_id === $product->id)
            <div class="img-product-index">
                <div class="img-solde-index-card mt-4">
                    <div class="img-hero-index-card mt-4  ms-3">
                        @if($product->images->count() > 0)
                            <img class="card-img-top img-products" src="{{ asset('storage/uploads/' . $product->images->first()->image_url) }}" alt="Card image cap">
                        @else
                            <img class="card-img-top img-products" src="{{ asset('images/npi.png') }}" alt="Product Image">
                        @endif
                    </div>
                </div>
                <h4 class="titre-card-product mt-2 mb-2 text-dark">
                    {{$solde->product->name}}
                </h4>
            </div>
        @endif
    @endforeach
</div>


                                    <div class="d-flex justify-content-evenly mt-5">
                                        <p class="span-solde" id="soldeStartDate{{$solde->id}}">Début : {{$solde->start_date}}</p>
                                        <p class="span-solde" id="soldeEndDate{{$solde->id}}">Fin : {{$solde->end_date}}</p>
                                    </div>
                                    <p class="mt-4">Remise : {{ $solde->percentage }} %</p>
                                    <div class="d-flex justify-content-evenly">
                                        <p class="span-solde">
                                            <del>{{ number_format($product->price, 2) }} €</del>
                                        </p>
                                        @php
                                        $prix_apres_pourcentage = $product->price - ($product->price * ($solde->percentage / 100));
                                        @endphp
                                        <p class="span-solde result-solde">{{ number_format($prix_apres_pourcentage, 2) }} €</p>
                                    </div>
                                </div>
                            </div>
                            <script>
                                var currentDate = new Date();
                                var soldeStartDate = new Date("{{$solde->start_date}}");
                                var soldeEndDate = new Date("{{$solde->end_date}}");
                                if (soldeEndDate <= currentDate) {
                                    // Désactiver l'effet de la date de début si la date de fin est dépassée
                                    document.getElementById("soldeCard{{$solde->id}}").style.backgroundColor = "";
                                    document.getElementById("soldeStartDate{{$solde->id}}").style.backgroundColor = "";
                                } else if (soldeStartDate <= currentDate) {
                                    // Appliquer l'effet vert uniquement si la date de début est dépassée et la date de fin n'est pas dépassée
                                    document.getElementById("soldeCard{{$solde->id}}").style.backgroundColor = "green";
                                    document.getElementById("soldeStartDate{{$solde->id}}").style.backgroundColor = "rgba(100, 189, 100, 0.5)";
                                }
                                if (soldeEndDate <= currentDate) {
                                    document.getElementById("soldeEndDate{{$solde->id}}").style.backgroundColor = "red";
                                }
                            </script>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
