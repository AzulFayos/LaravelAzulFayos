<h1>{{$modo}} persona</h1>

@if(count($errors)>0)
@foreach($errors->all() as $error)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{ $error }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
@endif

<div class="form-group pt-2">
<label for="nombre">Nombre</label>
<input type="text" class="form-control" name="nombre" value="{{ isset($persona->nombre)?$persona->nombre:old('nombre') }}" id="nombre">
</div>
<div class="form-group pt-2">
<label for="apellido1">Primer Apellido</label>
<input type="text" class="form-control" name="apellido1" value="{{ isset($persona->apellido1)?$persona->apellido1:old('apellido1') }}" id="apellido1">
</div>
<div class="form-group pt-2">
<label for="apellido2">Segundo Apellido</label>
<input type="text" class="form-control" name="apellido2" value="{{ isset($persona->apellido2)?$persona->apellido2:old('apellido2') }}" id="apellido2">
</div>
<div class="form-group pt-2">
<label for="telefono">Teléfono</label>
<input type="text" class="form-control" name="telefono" value="{{ isset($persona->telefono)?$persona->telefono:old('telefono')  }}" id="telefono">
</div>
<div class="form-group pt-2">
<label for="DNI">DNI</label>
<input type="text" class="form-control" name="DNI" value="{{ isset($persona->DNI)?$persona->DNI:old('DNI')  }}" id="DNI">
</div>
<div class="form-group pt-2">
<label for="direccion">Dirección</label>
<input type="text" class="form-control" name="direccion" value="{{ isset($persona->direccion)?$persona->direccion:old('direccion')  }}" id="direccion">
</div>
<div class="form-group pt-2">
<label for="foto">Foto</label>
@if(isset($persona->foto))
<div class="pt-2 pb-4">
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$persona->foto}}" width="100" alt="">
</div>
@endif
<input type="file" class="form-control" name="foto" value="" id="foto">
</div>
<div class="pt-4">
<input type="submit" value="{{$modo}} datos" class="btn btn-outline-success btn-lg btn-block"></input>
</div>
<div class="pt-4">
<a href="{{ url('persona/') }}" class="btn btn-outline-secondary" role="button">Volver</a>
</div>