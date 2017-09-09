@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="sail big-size">Completa tu perfil</h2>
                <div class="panel panel-default">
                    <div class="panel-heading sail">
                        Completa tu perfil
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal form-group" action="{{ url('/finish') }}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <textarea name="describirte" rows="6" class="form-control" placeholder="Describite....">{{ $userProfile->describirte }}</textarea>
                            <textarea name="disponibilidad" rows="6 " class="form-control" placeholder="Dinos tu disponibilidad para navegar...">{{ $userProfile->disponibilidad }}</textarea>
                            <button type="submit" class="btn btn-small btn-info">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
