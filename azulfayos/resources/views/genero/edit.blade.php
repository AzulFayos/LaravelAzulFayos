@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url('/genero/'.$genero->id) }}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('genero.form')
</form>


</div>
@endsection