@extends ('layouts.app')

@section('title')
Mon compte
@endsection

@section('content')
<div class="body">
    <div class="container">
        <h1>{{$user->last_name}}</h1>



        <div class="row ">


            <form class="col-4 mx-auto" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mt-5 ">
                    <label for="last_name">Prénom</label>
                    <input required type="text" class="form-control custom-input" placeholder="modifier" name="last_name" value="{{ $user->last_name }}" id="last_name">
                </div>
                <div class="form-group mt-5 ">
                    <label for="first_name">Nom</label>
                    <input required type="text" class="form-control custom-input" placeholder="modifier" name="first_name" value="{{ $user->first_name }}" id="first_name">
                </div>


                <button type="submit" class="btn btn-outline-dark btn-secondary-color mt-4">Valider</button>

            </form>

            @if($user->role_id == 2)
                    <div class="row">

                    </div>
                @endif

            <form class="mx-auto" action="{{route('users.destroy', $user)}}" method="post">
                @csrf
                @method("delete")
                <button type="submit" class="btn btn-outline-danger mt-2">supprimer le compte</button>
            </form>
        </div>
        <div class="mb-6">

        </div>
    </div>

    @endsection
