@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Archivo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} Archivo</span>
                    </div>
                    <div class="bg-white card-body">
                        <form method="POST" action="{{ route('archivos.update', $archivo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('archivos.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
