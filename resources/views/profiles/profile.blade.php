@extends('layouts.app')
@section('content')
  <div class="container">
      <h1 class="sail big-size">{{ $user->name }}</h1>
      <div class="panel-group">
          <div class="panel panel-info">
              <div class="panel-heading">
                  Informacion de {{ $user->name }}
              </div>
              <div class="panel-body">
                  <img src="{{url('/storage/images/avatars', [ $user->avatar ])}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                  <h2>{{ $user->name }}</h2>
                  @if(Auth::user()->id == $user->id)
                      <div class="container">
                          <div class="row">
                              <div class="col-md-4">
                                  <form enctype="multipart/form-data" action="{{url('/profile' , ['slug' => Auth::user()->slug])}}" method="post">
                                    <label>Actualiza tu foto de perfil</label>
                                    <input type="file" name="avatar">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="pull-left btn btn-small btn-info">Actualizar</button>
                                  </form>
                              </div>
                              <div class="col-md-4">
                                  <label for="disponibilidad">Mi disponibilidad</label>
                                  <p>{{ $profile->disponibilidad }}</p>
                              </div>
                              <p><a href="{{url('/profile/edit', ['slug' => Auth::user()->slug])}}">Editar mi perfil</a></p>
                              @if ($profile->cruise)
                                    <p><a target="_blank" href="{{url('/storage/images/cruises', [$profile->cruise])}}">Ver mi barco</a></p>
                              @endif
                          </div>
                      </div>
                  @else
                      <div class="container">
                          <div class="row">
                              <div class="col-md-4">
                                  <label for="describime">Mi disponibilidad</label>
                                  <p>{{ $profile->disponibilidad }}</p>
                              </div>
                              <div class="col-md-4">
                                  <label for="email">Mi email</label>
                                  <p><a href="{{ $user->email }}">{{ $user->email }}</a></p>
                              </div>
                              @if ($profile->cruise)
                                  <div class="col-md-2">
                                       <p><a target="_blank" href="{{url('/storage/images/cruises', [$profile->cruise])}}">Ver mi barco</a></p>
                                  </div>
                              @endif
                          </div>
                      </div>
                 @endif
              </div>
          </div>
      </div>
      <div class="panel-group">
          <div class="panel panel-info">
              <div class="panel-heading">
                  Mi descripcion
              </div>
              <div class="panel-body">
                  <p>{{ $profile->describirte }}</p>
              </div>
          </div>
      </div>
      <div class="panel-group">
          <div class="panel panel-info">
              <div class="panel-heading">
                  Deja una reseña
              </div>
              <div class="panel-body">
                  <form class="form-horizontal form-group" action="{{url('/comment', ['profile_id' => $profile->id])}}" method="post">
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                       <textarea name="content" rows="8" class="form-control"></textarea>
                       <button type="submit" class="btn btn-info" name="button">Enviar comentario</button>
                  </form>
              </div>
          </div>
      </div>
      <div class="panel-group">
          <div class="panel panel-info">
              <div class="panel-heading">
                  Mira las reseñas hechas por otros usuarios

              </div>
              <div class="count-padding">
                  <h4>{{ $c->count() }} Comentarios</h4>
              </div>
              @foreach ($c as $c)
                  <div class="panel-body">
                      <div class="comment">
                          <img src="{{url('/storage/images/avatars', [ $c->user->avatar ])}}" class="author-image">
                          <div class="comment-name">
                               <a href="{{url('/profile', [ $c->user->slug ])}}"><h5 class="h-4-name">{{ $c->user->name }}</h5></a>
                               <p class="author-time">{{ $c->created_at }}</p>
                          </div>
                          <div class="content">
                              <p>{{ $c->comment }}</p>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>

@endsection
