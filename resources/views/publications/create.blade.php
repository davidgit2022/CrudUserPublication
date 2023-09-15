@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2><b>Publicaciones</b></h2>
            </div>
            <div class="float-sm-end mb-2 ">
                <a href="javascript:void(0)" class="btn btn-success">Nuevo</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table-publication">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titúlo</th>
                        <th>Contenido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('publications.modal')
</div>
@endsection
@push('javascript')
    @include('ajax.ajaxPublication')
@endpush