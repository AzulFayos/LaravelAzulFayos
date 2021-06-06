<h1>Edita tu genero</h1>

@if(count($errors)>0)
@foreach($errors->all() as $error)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{ $error }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
@endif

<div class="form-group pt-2">
<label for="GenNombre">Género</label>
<input type="text" class="form-control" name="GenNombre" value="{{ isset($genero->GenNombre)?$genero->GenNombre:''  }}" id="GenNombre">
</div>

<div class="pt-4">
<input type="submit" value="Editar datos" class="btn btn-outline-success btn-lg btn-block">
</div>

<div class="pt-4">
<a href="{{ url('persona/') }}" class="btn btn-outline-secondary" role="button">Volver</a>
</div>