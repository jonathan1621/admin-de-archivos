<div class="p-1 row padding-1">
    <div class="col-md-12">
        <div class="form-group">

            <label for="organismo_id">Organismo</label>

            <select name="organismo_id" id="organismo_id" class="select2" style="width: 100%;">
                <option value="">Selecciona un organismo</option>
                @foreach ($organismos as $organismo)
                    <option value="{{ $organismo->id }}" {{ $archivo->organismo_id == $organismo->id ? 'selected' : '' }}>
                        {{ $organismo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 form-group mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $archivo?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="mb-2 form-group mb20">
            <label for="archivo" class="form-label">{{ __('Archivo') }}</label>
            <input type="file" name="archivo" class="form-control @error('archivo') is-invalid @enderror" id="archivo">
                @if (old('archivo'))
                    <span>Archivo previamente cargado: {{ old('archivo') }}</span>
                @elseif($archivo?->nombreoriginal)
                    <span>Archivo previamente cargado: {{ $archivo->nombreoriginal }}</span>
                @endif
                {!! $errors->first('archivo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="mt-2 col-md-12 mt20">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-secondary" href="{{ url()->previous() }}"> {{ __('Cancelar') }}</a>
    </div>
</div>
