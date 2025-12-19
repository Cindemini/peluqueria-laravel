@extends('layouts.app')

@section('titulo', 'Nueva Cita')

@section('contenido')

<h1>Registrar Cita</h1>

<form action="{{ route('citas.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label class="form-label">Nombre Clienta</label>
        <input type="text" name="nombre_clienta" class="form-control @error('nombre_clienta') is-invalid @enderror" required>
        @error('nombre_clienta')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Teléfono (10 números)</label>
        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" 
               pattern="[0-9]{10}" maxlength="10" placeholder="0998440500" required>
        @error('telefono')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <small class="form-text text-muted">Ingrese exactamente 10 números</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Servicio</label>
        <select name="servicio" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="Corte">Corte</option>
            <option value="Tinte">Tinte</option>
            <option value="Peinado">Peinado</option>
            <option value="Manicure">Manicure</option>
            <option value="Tratamiento">Tratamiento</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha Cita</label>
        <input type="date" name="fecha_cita" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Hora Cita</label>
        <input type="time" name="hora_cita" class="form-control" required>
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