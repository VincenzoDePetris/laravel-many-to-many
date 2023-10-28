@extends('layouts.app')


@section('content')
<div class="container mt-5">

  @if ($errors->any())
  <div class="alert alert-danger" role="alert">
    Correggi i seguenti errori per proseguire:
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
  </div>
  @endif


  <form action="{{ route('admin.works.update', $work) }}" method="POST">
    @method('PUT') @csrf
    <label for="title" class="form-label">Titolo</label>
    <input
      type="text"
      class="form-control"
      id="title"
      name="title"
      value="{{ $work->title }}"
    />


    <label for="category_id" class="form-label">Categoria</label>
    <select name="category_id" id="category_id" class="form-select">
      <option value="">Non categorizzato</option>
      @foreach($categories as $category)
      <option value="{{ $category->id }}" @if (old('category_id') ?? $work->category_id == $category->id) selected @endif>{{ $category->label }}</option>
      @endforeach
    </select>

    <div class="col-12 my-4">
      <div class=" form-check ">

        <input type="checkbox"
         name="tags[]" id="tag-non-valido" 
         value="-50" 
         class="form-check-control"
         @if(in_array('-50', old('tags') ?? [])) checked @endif
         >
          <label for="tag-non-valido">Check non valida</label>
        @foreach($tags as $tag)
        <div class="">
    
          <input type="checkbox"
           name="tags[]" 
           id="tag-{{$tag->id}}" 
           value="{{$tag->id}}" 
           class="form-check-control"
           @if(in_array($tag->id, old('tags') ?? [])) checked @endif>
          <label for="tag-{{$tag->id}}">{{$tag->label}}</label>
        </div>
        @endforeach
      </div>
    </div>

    <label for="link" class="form-label">Link</label>
    <input
      type="text"
      class="form-control"
      id="link"
      name="link"
      value="{{ $work->link }}"
    />

    <label for="slug" class="form-label">Slug</label>
    <input
      type="text"
      class="form-control"
      id="slug"
      name="slug"
      value="{{ $work->slug }}"
    />
  

    <label for="description" class="form-label">Descrizione</label>
  <textarea class="form-control" id="description" name="description" rows="4">
      {{ $work->description }}
    </textarea
  >

    <button type="submit" class="btn btn-primary">Salva</button>
  </form>

</div>
@endsection