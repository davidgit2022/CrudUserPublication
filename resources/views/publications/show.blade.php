@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Detalles de la Publicación</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $publication->title}}</h5>
                <p class="card-text">{{ $publication->content}}</p>
                <p class="card-text"><b>Fecha de publicación: </b>{{ $publication->created_at->format('d/m/Y')}}</p>
                <a href="{{ route('publications.index')}}" class="btn btn-primary">Volver a la lista</a>
            </div>
        </div>
    </div>
@endsection
