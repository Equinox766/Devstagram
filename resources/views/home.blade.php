@extends('layouts.app')
@section('titulo')
    Pagina principal
@endsection
@section('content')
    <x-listar-post :posts="$posts"/>
@endsection


