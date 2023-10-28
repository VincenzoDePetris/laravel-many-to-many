@extends('layouts.app')

@section('content')

<div class="container mt-5">
  <a href="{{ route('admin.works.index') }}" class="btn btn-success my-3">Torna alla  lista</a>

  <h1>{{ $work->title }}</h1>
  <p class="mt-5"><b>Descrizione:</b> {!! $work->getCategoryBadge() !!}</p>
  <div class="mt-5">Link: <b>{{ $work->link }}</b></div>
  <div class="mt-5">Slug:<b> {{ $work->slug }}</b></div>
  <div class="mt-5">Categoria: <b>{{ $work->category?->label }}</b></div>
</div>
@endsection