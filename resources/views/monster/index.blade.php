@extends('template.default')

@section('title', 'Tous les monstres')

@section('content')
  <h1 class="text-3xl font-bold mb-6 creepster">
    Liste des monstres
  </h1>

  @include('monster._lastMonster', ['monsters' => $monsters])
@endsection
