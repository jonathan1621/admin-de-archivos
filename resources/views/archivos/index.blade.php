@extends('layouts.app')

@section('template_title')
    Archivos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Administrador de archivos') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('archivos.create', ['organismo_id' => request('organismo_id')]) }}"
                                    class="float-right btn btn-primary btn-sm"
                                    data-placement="left">
                                    {{ __('Agregar nuevo') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="m-4 alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="bg-white card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

									<th >Organismo</th>
									<th >Descripcion</th>
									<th >Archivo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($archivos as $archivo)
                                        <tr>
                                            <td>{{ ++$i }}</td>

										{{-- <td >{{ $archivo->organismo_id }}</td> --}}
                                        <td>{{ $archivo->organismo->nombre ?? 'Sin organismo' }}</td>
                                        <td >{{ $archivo->descripcion }}</td>
									        <td >{{ $archivo->nombre_original }}</td>

                                            <td>
                                                <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('archivos.show', $archivo->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    {{-- <a class="btn btn-sm btn-success" href="{{ route('archivos.edit', $archivo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a> --}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('archivos.edit', ['archivo' => $archivo->id, 'organismo_id' => request()->query('organismo_id')]) }}">Editar</a>

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('¿Seguro de que deseas borrarlo?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $archivos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
<script>
    function volverALaUltimaUrl() {
        const ultimaUrl = @json(session('ultima_url', route('inicio')));
        window.location.href = ultimaUrl;
    }
</script>
