@extends('layouts.app')
@section('title',$viewData->title)
@section('content')

    <p>Esta es la seccion de usuarios</p>
    <ul>
        @foreach($viewData->users as $user)
        <li>
            {{ $user->nombres }}<br>
            <a href="{{ route('user.one', $user->id) }}">Ver Detalle</a>
        </li>
        @endforeach
    </ul>

@endsection
