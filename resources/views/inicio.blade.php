@extends('layouts.app')

@section('template_title')
    Seleccionar Rol
@endsection

@section('content')
    <section class="content container-fluid text-center">
        <h1 class="mb-4">Seleccionar Rol</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-grid gap-3">
                    <a href="{{ route('archivos.index', ['organismo_id' => 1]) }}" class="btn btn-success btn-lg">Administrador</a>
                    <a href="{{ route('archivos.index', ['organismo_id' => 2]) }}" class="btn btn-primary btn-lg">Policia de la Ciudad</a>
                    <a href="{{ route('archivos.index', ['organismo_id' => 3]) }}" class="btn btn-danger btn-lg">Bomberos de la Ciudad</a>
                    <a href="{{ route('archivos.index', ['organismo_id' => 4]) }}" class="btn btn-warning btn-lg">Defensa Civil</a>
                </div>
            </div>
        </div>
    </section>
@endsection
