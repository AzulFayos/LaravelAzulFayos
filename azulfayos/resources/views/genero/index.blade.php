@php
    $generos
@endphp

<select class="genID" onchange="cambiarEdit({{ $persona->id }})">
<option class="defecto" placeholder="Elige el/los género/s de tu lista" onclick="return confirm('No has seleccionado ningún género')" selected="selected"></option>
@foreach( $generos as $key => $genero)
@if($persona->id===$genero->personas_id)

<option name="GenNombre" value="{{$genero->id}}" onclick="return confirm('Has seleccionado {{ $genero->GenNombre }}')">{{ $genero->GenNombre }}</option>

@endif
@endforeach
</select>

<td class="pt-4">
<div class="p-2 d-inline">
<a class="edit btn btn-outline-info btn-sm" href="{{ url('/genero/'.$genero->id.'/edit') }}">✎</a>
</div>

|

<form name="formu" action="{{ url('/genero/'.$genero->id) }}" method="post" enctype="multipart/form-data" class="d-inline p-2">
@csrf
{{ method_field('DELETE') }}
<input type="hidden" id="change" readonly></input>
<input type="submit" id="BorrarGen" onclick="valor({{ $persona->id }})" value="✖" class="btn btn-outline-secondary btn-sm"></input>
</form>


</td>
<br>


<td  class="pt-4">
<form action="{{ url('/genero') }}" method="post" enctype="multipart/form-data">
@csrf
<input type="text" name="GenNombre" placeholder="Inserta tu género" 
id="GenNombre"></input>
<input type="hidden" value="{{ $persona->id }}" name="personas_id" id="personas_id" readonly></input>
<input type="submit" value="✓" class="btn btn-outline-success btn-sm"></input>
</form>
</td>


<script>

  function valor(id) {
    var select = document.getElementsByClassName("genID")[id-1];
    var selectedOption = select.options[select.selectedIndex].value;
    document.getElementsByName("formu")[id-1].action = "http://localhost/genero/" + selectedOption
  }

  function cambiarEdit(id) {
    var select = document.getElementsByClassName("genID")[id-1];
    var selectedOption = select.options[select.selectedIndex].value;
    document.getElementsByClassName("edit")[id-1].href = "http://localhost/genero/" + selectedOption + "/edit"
  }

</script>