@extends('layouts.app')
@section('titulo', 'Citas')
@section('contenido')

<div class="d-flex justify-content-between mb-3">
    <h1>Citas</h1>
    <a href="{{ route('citas.create') }}" class="btn btn-primary">Nueva</a>
</div>

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
                <td>{{ $cita->estado }}</td>
                <td>
                    <a href="{{ route('citas.edit', $cita) }}" class="btn btn-sm btn-warning">Editar</a>
                    
                    <form action="{{ route('citas.destroy', $cita) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('¿Eliminar?')">
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

@endsection