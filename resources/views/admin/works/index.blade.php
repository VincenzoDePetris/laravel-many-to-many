@extends('layouts.app');

@section('content')

<div class="container mt-5">
  <a href="{{ route('admin.works.create') }}" role="button" class="btn btn-primary my-4"
    >Crea progetto</a
  >

  <table>
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Categoria</th>
        <th scope="col">Description</th>
        <th scope="col">Tag</th>
        <th scope="col">Dettaglio</th>
        <th scope="col">Modifica</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($works as $work)
      <tr>
        <th scope="row">{{ $work->id }} </th>
        <td>{{ $work->title }} </td>
        <td>{!! $work->getCategoryBadge() !!}</td>
        <td>{{ $work->description }} </td>
        <td>
          @forelse($work->tags as $tag)
            {{ $tag->label }} @unless($loop->last) , @else . @endunless
          @empty
            -
          @endforelse
          </td>
        <td><a href="{{ route('admin.works.show', $work ) }}">Detail</a> </td>
        <td><a href="{{ route('admin.works.edit', $work) }}">Modifica</a></td>
        <td><button
          type="button"
          class="btn btn-danger"
          data-bs-toggle="modal"
          data-bs-target="#delete-modal-{{ $work->id }}"
        >
          Elimina
        </button></td>
      </tr>

      <div class="container mt-5">

        <div
        class="modal fade"
        id="delete-modal-{{ $work->id }}"
        tabindex="-1"
        aria-labelledby="delete-modal-{{ $work->id }}-label"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1
                        class="modal-title fs-5"
                        id="delete-modal-{{ $work->id }}-label"
                    >
                        Conferma eliminazione
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body text-start">
                    Sei sicuro di voler eliminare il progetto {{ $work->title }}? <br />
                    L'operazione non è reversibile
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Annulla
                    </button>
    
                    <form
                        action="{{ route('admin.works.destroy', $work) }}"
                        method="POST"
                        class=""
                    >
                        @method('DELETE') @csrf
    
                        <button type="submit" class="btn btn-danger">
                            Elimina
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
      @endforeach
    </tbody>
  </table>

  
  
</div>
@endsection