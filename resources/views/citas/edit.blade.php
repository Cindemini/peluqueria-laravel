@extends('layouts.app')

@section('titulo', 'Editar Cita')

@section('contenido')

<h1>Editar Cita</h1>

<form action="{{ route('citas.update', $cita) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label class="form-label">Nombre Clienta</label>
        <input type="text" name="nombre_clienta" class="form-control @error('nombre_clienta') is-invalid @enderror" value="{{ old('nombre_clienta', $cita->nombre_clienta) }}" required>
        @error('nombre_clienta')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Teléfono (10 números)</label>
        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" 
               value="{{ old('telefono', $cita->telefono) }}" pattern="[0-9]{10}" maxlength="10" placeholder="0998440500" required>
        @error('telefono')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="form-text text-muted">Ingrese exactamente 10 números</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Servicio</label>
        <select name="servicio" class="form-select" required>
            <option value="Corte" {{ $cita->servicio == 'Corte' ? 'selected' : '' }}>Corte</option>
            <option value="Tinte" {{ $cita->servicio == 'Tinte' ? 'selected' : '' }}>Tinte</option>
            <option value="Peinado" {{ $cita->servicio == 'Peinado' ? 'selected' : '' }}>Peinado</option>
            <option value="Manicure" {{ $cita->servicio == 'Manicure' ? 'selected' : '' }}>Manicure</option>
            <option value="Tratamiento" {{ $cita->servicio == 'Tratamiento' ? 'selected' : '' }}>Tratamiento</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha Cita</label>
        <input type="date" name="fecha_cita" class="form-control" value="{{ $cita->fecha_cita }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Hora Cita</label>
        <input type="time" name="hora_cita" class="form-control" value="{{ $cita->hora_cita }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
            <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="completada" {{ $cita->estado == 'completada' ? 'selected' : '' }}>Completada</option>
            <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
        </select>
    </div>

    <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

<script>
    document.querySelector('input[name="telefono"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

@endsection