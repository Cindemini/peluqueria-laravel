@extends('layouts.app')

@section('titulo', 'Nueva Cita')

@section('contenido')

<h1>Registrar Cita</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>¡Error!</strong> Por favor corrija los siguientes errores:
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('citas.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label class="form-label">Nombre Clienta</label>
        <input type="text" name="nombre_clienta" class="form-control @error('nombre_clienta') is-invalid @enderror"
               value="{{ old('nombre_clienta') }}" required>
        @error('nombre_clienta')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="form-text text-muted">No puede contener números</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Teléfono (10 números)</label>
        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
               pattern="[0-9]{10}" maxlength="10" placeholder="0998440500"
               value="{{ old('telefono') }}" required>
        @error('telefono')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="form-text text-muted">Ingrese exactamente 10 números</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Servicio</label>
        <select name="servicio" class="form-select @error('servicio') is-invalid @enderror" required>
            <option value="">Seleccione</option>
            <option value="Corte" {{ old('servicio') == 'Corte' ? 'selected' : '' }}>Corte</option>
            <option value="Tinte" {{ old('servicio') == 'Tinte' ? 'selected' : '' }}>Tinte</option>
            <option value="Peinado" {{ old('servicio') == 'Peinado' ? 'selected' : '' }}>Peinado</option>
            <option value="Manicure" {{ old('servicio') == 'Manicure' ? 'selected' : '' }}>Manicure</option>
            <option value="Tratamiento" {{ old('servicio') == 'Tratamiento' ? 'selected' : '' }}>Tratamiento</option>
        </select>
        @error('servicio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha Cita</label>
        <input type="date" name="fecha_cita" class="form-control @error('fecha_cita') is-invalid @enderror"
               value="{{ old('fecha_cita') }}" required>
        @error('fecha_cita')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="form-text text-muted">La fecha debe estar entre 2025 y 2050</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Hora Cita</label>
        <input type="time" name="hora_cita" class="form-control @error('hora_cita') is-invalid @enderror"
               value="{{ old('hora_cita') }}" required>
        @error('hora_cita')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<script>
    document.querySelector('input[name="telefono"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

@endsection