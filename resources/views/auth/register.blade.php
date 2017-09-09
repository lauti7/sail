@extends('layouts.app')
@section('head')
  <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection
@section('content')
<div class="container">
  <h1 class="text-center big-size sail">Naveguemos</h1>
</div>
<h3 class="text-center">¿No sabes con quien ir a navegar? O ¿No te gusta ir a navegar solo?</h3>
<h2 class="text-center">Registrate y podras conseguir un acompañante </h2>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading sail">Registrate</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre Completo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Direccion de Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="location" class="col-md-4 control-label">Ubicacion
                          </label>
                          <div class="col-md-6">
                            <input id="location"  type="text" name="location" class="form-control" required>
                            <button type="button" class="btn btn-info" onclick="getLocation()">Ubicame</button>
                          </div>
                        </div>



                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar la contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
getLocation();
function getLocation() {
   if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(geocode);
   } else {
     console.log('Hubo un problema');
   }
}
//geocode();
function geocode(position) {
  var lat = position.coords.latitude;
  var lng = position.coords.longitude;
  var latString = String(lat);
  var lngString = String(lng);
  var location = latString + ',' + lngString;
  axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
    params:{
      latlng:location,
      key:'AIzaSyDbwtDQs29cAycSSOWAw-Q6Uw5uiTHOHiA'
    }
  })
  .then(function(response){
    console.log(response.data.results[1].formatted_address);
    var formattedAddress = response.data.results[1].formatted_address;
    var formattedAddressOutput = formattedAddress;
    document.getElementById('location').value = formattedAddressOutput;
  })
  .catch(function(error){
    console.log(error);
  })
}

</script>

@endsection
