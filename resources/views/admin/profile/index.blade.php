@extends('adminlte::page')

@section('title', 'Meu perfil')

@section('content_header')
    <h1>Meu perfil</h1>
@endsection

@section('content')
    Nome: {{$user['name']}}    
@endsection