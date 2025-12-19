@extends('layouts.app')

@section('titulo', 'Detalle de Cita')

@section('contenido')

<h1>Detalle de Cita</h1>

<div class="card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nombre Clienta:</dt>
            <dd class="col-sm-9">{{ $cita->nombre_clienta }}</dd>

            <dt class="col-sm-3">Teléfono:</dt>
            <dd class="col-sm-9">{{ $cita->telefono }}</dd>

            <dt class="col-sm-3">Servicio:</dt>
            <dd class="col-sm-9">{{ $cita->servicio }}</dd>

            <dt class="col-sm-3">Fecha:</dt>
            <dd class="col-sm-9">{{ $cita->fecha_cita }}</dd>

            <dt class="col-sm-3">Hora:</dt>
            <dd class="col-sm-9">{{ $cita->hora_cita }}</dd>

            <dt class="col-sm-3">Estado:</dt>
            <dd class="col-sm-9">
                <span class="badge bg-{{ $cita->estado == 'completada' ? 'success' : ($cita->estado == 'cancelada' ? 'danger' : 'warning') }}">
                    {{ ucfirst($cita->estado) }}
                </span>
            </dd>
        </dl>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('citas.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('citas.edit', $cita) }}" class="btn btn-primary">Editar</a>
</div>

@endsection





