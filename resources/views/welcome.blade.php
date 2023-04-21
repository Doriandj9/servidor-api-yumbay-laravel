@extends('layouts.app')
@section('title',$viewData['title'])
@section('content')
@php 
    var_dump($especialidades);
@endphp
   <form action="{{ route('aut') }}" method="post">
    @csrf
    <input type="text" name="cedula" value="{{old('name')}}">
    <input type="text" name="clave" value="{{old('clave')}}">
    <input type="text" name="rol" value="{{old('rol')}}">
    <button type="submit">Enviar</button>
   </form>
   <P>
    {{ asset('css/app.css') }}
   </P>
@endsection
