@extends('layouts.default')

@section('content')

<style>

    .push-top {
      margin-top: 50px;
    }
</style>

<div class="card push-top">
  <div class="card-header">
    Agregar nuevo evento
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" enctype="multipart/form-data" action="{{ route('events.store') }}">
      
          <div class="form-group">
          @csrf
              <label for="name">Nombre</label>
              <input type="text" class="form-control" name="nombre"/>
          </div>
          <div class="form-group">
              <label for="text">Descripcion</label>
              <input type="text" class="form-control" name="descripcion"/>
          </div>
        <br>
        
          <button type="submit" class="btn btn-block btn-success">Crear evento</button>
      </form>
  </div>
</div>
@endsection