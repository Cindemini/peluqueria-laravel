@extends('layouts.app')

@section('titulo', 'Citas de Hoy')

@section('contenido')

<div class="d-flex justify-content-between mb-3">
    <h1>Citas de Hoy</h1>
    <div>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Ver Todas</a>
        <a href="{{ route('citas.create') }}" class="btn btn-primary">Nueva Cita</a>
    </div>
</div>

@if($citas->count() > 0)
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre Clienta</th>
                <th>Teléfono</th>
                <th>Servicio</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
            <tr>
                <td>{{ $cita->nombre_clienta }}</td>
                <td>{{ $cita->telefono }}</td>
                <td>{{ $cita->servicio }}</td>
                <td>{{ $cita->hora_cita }}</td>
                <td>
                    <span class="badge bg-{{ $cita->estado == 'completada' ? 'success' : ($cita->estado == 'cancelada' ? 'danger' : 'warning') }}">
                        {{ ucfirst($cita->estado) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('citas.edit', $cita) }}" class="btn btn-sm btn-warning">Editar</a>
                    <a href="{{ route('citas.show', $cita) }}" class="btn btn-sm btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="alert alert-info">
    No hay citas programadas para hoy.
</div>
@endif

@endsection




