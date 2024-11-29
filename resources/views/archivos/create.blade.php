@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Archivo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Archivo</span>
                    </div>

                    <div class="bg-white card-body">
                        <form method="POST" action="{{ route('archivos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('archivos.form')
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
