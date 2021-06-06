@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>
    
      {{Session::get('mensaje')}}
    
  </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('mensajeAlert'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>
    
      {{Session::get('mensajeAlert')}}
    
  </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(count($errors)>0)
@foreach($errors->all() as $error)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{ $error }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
@endif

<div class=" justify-content-center aling-items-center">
<a href="{{ url('persona/create') }}" class="btn btn-outline-primary">Registrar persona</a>
</div>

<table class="table" >
  <thead class="thead-ligth">
    <tr>
      <th>#</th>
      <th>Foto</th>
      <th>Nombre</th>
      <th>Primer apellido</th>
      <th>Segundo apellido</th>
      <th>Telefono</th>
      <th>DNI</th>
      <th>Dirección</th>
      <th>Género</th>
      <th>Opciones género</th>
      <th>Añade tu género</th>
      <th>Opciones persona</th>
    </tr>
  </thead>
  <tbody >
  @foreach( $personas as $persona )
    <tr class="justify-content-center aling-items-center">
      <td class="pt-4">{{ $persona->id }}</td>

      <td> <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$persona->foto }}" width="70" alt=""></td>

      <td class="pt-4">{{ $persona->nombre }}</td>
      <td class="pt-4">{{ $persona->apellido1 }}</td>
      <td class="pt-4">{{ $persona->apellido2 }}</td>
      <td class="pt-4">{{ $persona->telefono }}</td>
      <td class="pt-4">{{ $persona->DNI }}</td>
      <td class="pt-4">{{ $persona->direccion }}</td>
   
      <td class="pt-4">@include('genero.index')</td>
     
      <td class="pt-4">
      <div class="p-2 d-inline">
        <a href="{{ url('/persona/'.$persona->id.'/edit') }}" class="btn btn-outline-info btn-sm">Editar</a> 
      </div>
       | 
      

      <form action="{{ url('/persona/'.$persona->id) }}" method="post" class="d-inline p-2">
      @csrf
      {{ method_field('DELETE') }}
      <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar" class="btn btn-outline-secondary btn-sm">
      </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{!! $personas->links() !!}
</div>
@endsection