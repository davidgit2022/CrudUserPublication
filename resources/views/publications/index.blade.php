@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h2>Listado de Publicaciones</h1>
        @forelse ($publications as $publication)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('publications.show', ['id' => $publication->id]) }}">
                        {{ $publication->title}}
                    </a>
                </h5>
                <p class="card-text">
                    <strong>Autor: </strong><span>{{ $publication->user->name }}</span>
                </p>
            </div>
        </div>
        @empty
        <p>No hay publicaciones</p>
        @endforelse
    
        {{ $publications->links('pagination::bootstrap-5') }}

        
    </div>
@endsection
@push('javascript')
    
@endpush
