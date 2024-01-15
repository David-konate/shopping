@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="body">
    <div class="container">
        <h1 class="mt-5">Bienvenue {{ $useNow->first_name }}</h1>

        <div class="row mt-5">
            <div class="col-md-2 d-flex flex-column mt-5">
                <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-lg mb-2 mt-5 btn-secondary-color">Produit</a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-lg mb-2 mt-5 btn-secondary-color">Catégories</a>
                <a href="{{ route('soldes.index') }}" class="btn btn-outline-dark btn-lg mb-2 mt-5 btn-secondary-color">Soldes</a>
                <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg mb-2 mt-5 btn-secondary-color">Utilisateur</a>
            </div>
            <div class="col-md-2 d-flex flex-column mt-5">
                <a href="{{ route('products.create') }}" class="btn btn-outline-dark btn-lg mb-2 mt-5 btn-secondary-color-sm"><i class="material-icons text-white">add</i>
                </a>
                <a href="{{ route('products.create') }}" class="btn btn-outline-dark btn-lg mb-2 mt-5 btn-secondary-color-sm"><i class="material-icons text-white">create_new_folder</i>
                </a>
                <a href="{{ route('soldes.create') }}" class="btn btn-outline-dark btn-lg mb-2 mt-5 btn-secondary-color-sm"><i class="material-icons text-white"><span class="material-symbols-outlined">
                            loyalty
                        </span></i>
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg mb-2 mt-5 btn-secondary-color-sm"><i class="material-icons text-white">person_add</i>
                </a>
                @endif

            </div>

            <div class="col-md-8">
                <div class="table-prod-user">
                    <div class="table-admin-prod">
                        <table class="table">
                            <thead class="thead-dark" style="position: sticky; top: 0; z-index: 1;">
                                <tr class="background-color-secondary">
                                    <th class="background-color-secondary" scope="col">#</th>
                                    <th class="background-color-secondary" scope="col">Produit</th>
                                    <th class="background-color-secondary" scope="col">Categorie</th>
                                    <th class="background-color-secondary" scope="col">Prix</th>
                                    <th class="background-color-secondary" scope="col">Quantité</th>
                                    <th class="background-color-secondary" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td><a href="{{ route('products.edit', $product->id) }}"><i class="material-icons">create</i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-prod-user mt-5">
                        <div class="table-admin-prod">
                            <table class="table">
                                <thead class="thead-dark " style="position: sticky; top: 0; z-index: 1;">
                                    <tr class="background-color-secondary">
                                        <th class="background-color-secondary" scope="col">#</th>
                                        <th class="background-color-secondary" scope="col">Solde</th>
                                        <th class="background-color-secondary" scope="col">Produit</th>
                                        <th class="background-color-secondary" scope="col">Prix initial</th>
                                        <th class="background-color-secondary" scope="col">Remise</th>
                                        <th class="background-color-secondary" scope="col">Prix</th>
                                        <th class="background-color-secondary" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($soldes as $solde)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $solde->name }}</td>
                                        <td>{{ optional($solde->product)->name ?? 'Aucun produit associé' }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $solde->percentage }}</td>
                                        @php
                                        $nouveau_prix = round($product->price - ($solde->percentage * $product->price / 100), 2);
                                        @endphp
                                        <td>{{ $nouveau_prix }}</td>
                                        <td><a href="{{ route('soldes.edit', $solde->id) }}"><i class="material-icons">create</i></a></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-admin-user mt-5">
                        <div class="table-admin-prod">
                            <table class="table">
                                <thead class="thead-dark background-color-secondary" style="position: sticky; top: 0; z-index: 1;">
                                    <tr class="background-color-secondary">
                                        <th class="background-color-secondary" scope="col">#</th>
                                        <th class="background-color-secondary" scope="col">Utilisateur</th>
                                        <th class="background-color-secondary" scope="col">nb commandes</th>
                                        <th class="background-color-secondary" scope="col">total</th>
                                        <th class="background-color-secondary" scope="col">panier moyen</th>
                                        <th class="background-color-secondary" scope="col">adresse mail</th>
                                        <th class="background-color-secondary" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                        <th scope="col">{{ number_format($user->purchase_count, 0, '.', ',') }}</th>
                                        <td>{{ $user->purchase_total }}</td>
                                        <td class="background-color-secondary">
                                            @if ($user->purchase_count > 0)
                                            {{ number_format($user->purchase_total / $user->purchase_count, 2) }}
                                            @else
                                            0
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td><a href="{{ route('users.edit', $user->id) }}"><i class="material-icons">create</i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
