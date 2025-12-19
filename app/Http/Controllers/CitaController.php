<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::orderBy('fecha_cita', 'DESC')->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        return view('citas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_clienta' => [
                'required',
                'max:100',
                'regex:/^[^0-9]+$/u',
            ],
            'telefono' => [
                'required',
                'size:10',
                'regex:/^[0-9]{10}$/',
            ],
            'servicio' => 'required|max:100',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
        ], [
            'nombre_clienta.regex' => 'El nombre no puede contener números.',
            'telefono.size' => 'El teléfono debe tener exactamente 10 números.',
            'telefono.regex' => 'El teléfono debe contener solo números (10 dígitos).',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')
            ->with('success', 'Cita registrada.');
    }

    public function show(Cita $cita)
    {
        return view('citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        return view('citas.edit', compact('cita'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'nombre_clienta' => [
                'required',
                'max:100',
                'regex:/^[^0-9]+$/u',
            ],
            'telefono' => [
                'required',
                'size:10',
                'regex:/^[0-9]{10}$/',
            ],
            'servicio' => 'required|max:100',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
            'estado' => 'required',
        ], [
            'nombre_clienta.regex' => 'El nombre no puede contener números.',
            'telefono.size' => 'El teléfono debe tener exactamente 10 números.',
            'telefono.regex' => 'El teléfono debe contener solo números (10 dígitos).',
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index')
            ->with('success', 'Cita actualizada.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('citas.index')
            ->with('success', 'Cita eliminada correctamente.');
    }

    public function citasHoy()
    {
        $citas = Cita::getCitasHoy();
        return view('citas.hoy', compact('citas'));
    }

    public function historial()
    {
        $citas = Cita::getHistorial();
        return view('citas.historial', compact('citas'));
    }

    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,completada,cancelada'
        ]);

        $cita = Cita::find($id);
        if ($cita) {
            $cita->estado = $request->estado;
            $cita->save();
            return redirect()->back()->with('success', 'Estado actualizado correctamente.');
        }

        return redirect()->back()->with('error', 'Cita no encontrada.');
    }

    public function buscar(Request $request)
    {
        $query = $request->input('q');
        $citas = collect();

        if ($query) {
            $citas = Cita::where('nombre_clienta', 'LIKE', "%{$query}%")
                ->orWhere('telefono', 'LIKE', "%{$query}%")
                ->get();
        }

        return view('citas.buscar', compact('citas', 'query'));
    }
}

