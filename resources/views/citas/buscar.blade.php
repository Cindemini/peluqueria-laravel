@extends('layouts.app')

@section('titulo', 'Buscar Citas')

@section('contenido')

<div class="d-flex justify-content-between mb-3">
    <h1>Buscar Citas</h1>
    <a href="{{ route('citas.index') }}" class="btn btn-secondary">Volver</a>
</div>

<form action="{{ route('citas.buscar') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" 
               name="q" 
               class="form-control" 
               placeholder="Buscar por nombre o teléfono..." 
               value="{{ $query }}">
        <button class="btn btn-primary" type="submit">Buscar</button>
    </div>
</form>

@if($query)
    <p class="text-muted">Resultados para: <strong>{{ $query }}</strong></p>
@endif

@if($citas->count() > 0)
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre Clienta</th>
                <th>Teléfono</th>
                <th>Servicio</th>
                <th>Fecha</th>
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
                <td>{{ $cita->fecha_cita }}</td>
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
@elseif($query)
<div class="alert alert-warning">
    No se encontraron citas que coincidan con "{{ $query }}".
</div>
@endif

@endsection





