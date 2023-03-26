@extends('layouts.app')
@section('title',$viewData->title)
@section('content')

    <ul>
        <li>
            <strong>Nombre: </strong>
            {{ $viewData->user->nombres }}
        </li>
        <li>
            <strong>Nombre: </strong>
            {{ $viewData->user->apellidos }}
        </li>
        <li>
            <strong>Nombre: </strong>
            {{ $viewData->user->email }}
        </li>
        <li>
            <strong>Nombre: </strong>
            {{ $viewData->user->clave }}
        </li>
    </ul>

@endsection