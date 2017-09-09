@extends('layouts.app')
<head>

</head>
@section('content')
<div class="container">
    <div class="row">
        @foreach ($users as $user)
            <div class="col-md-4">
                <section>
                    <div class="card text-center" style="width:275px; height:295px; padding-bottom:50px;">
                        <img src="{{url('/storage/images/avatars', [ $user->avatar ])}}" style="width:100%; height:150px;">
                        <div class="card-body text-center">
                            <h4 class="card-title">{{ $user->name }}</h4>
                            <p class="card-text"><strong>Disponibilidad: </strong>{{ $user->profile->disponibilidad }}</p>
                            <div class="text-center">
                                <a href="{{url('/profile', [ $user->slug ])}}" style="padding-right:10px;">Ver el perfil del usuario</a>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
</div>
@endsection
