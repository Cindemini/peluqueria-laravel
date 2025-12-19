@extends('layouts.app')
@section('titulo', 'Citas')
@section('contenido')

<div class="d-flex justify-content-between mb-3">
    <h1>Citas</h1>
    <a href="{{ route('citas.create') }}" class="btn btn-primary">Nueva Cita</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre Clienta</th>
                <th>Teléfono</th>
                <th>Servicio</th>
                <th>Fecha Cita</th>
                <th>Hora</th>
                <th>Fecha Agendamiento</th>
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
                <td>{{ $cita->fecha_registro ? \Carbon\Carbon::parse($cita->fecha_registro)->format('d/m/Y H:i') : '-' }}</td>
                <td>
                    <span class="badge bg-{{ $cita->estado == 'completada' ? 'success' : ($cita->estado == 'cancelada' ? 'danger' : 'warning') }}">
                        {{ ucfirst($cita->estado) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('citas.show', $cita) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('citas.edit', $cita) }}" class="btn btn-sm btn-warning">Editar</a>
                    
                    <form action="{{ route('citas.destroy', $cita) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Está seguro de eliminar esta cita? Se mantendrá en el historial.')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($citas->count() == 0)
<div class="alert alert-info mt-3">
    No hay citas registradas. <a href="{{ route('citas.create') }}">Crear una nueva cita</a>
</div>
@endif

@endsection