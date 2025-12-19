@extends('layouts.app')

@section('titulo', 'Editar Cita')

@section('contenido')

<h1>Editar Cita</h1>

<form action="{{ route('citas.update', $cita) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label class="form-label">Nombre Clienta</label>
        <input type="text" name="nombre_clienta" class="form-control" value="{{ $cita->nombre_clienta }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ $cita->telefono }}" required>
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

