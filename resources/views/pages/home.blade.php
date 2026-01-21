@extends('template.default')
@section('title')
    home
@endsection
@section('content')
    <main class="w-full md:w-3/4 p-4">
        @include('monster._random',['monster'=> $randomMonster])
        @include('monster._lastMonster',['monsters'=> $lastMonsters])
    </main>
@endsection
