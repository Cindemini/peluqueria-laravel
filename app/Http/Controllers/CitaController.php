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
            'fecha_cita' => [
                'required',
                'date',
                'after_or_equal:2025-01-01',
                'before_or_equal:2050-12-31',
            ],
            'hora_cita' => 'required',
        ], [
            'nombre_clienta.required' => 'Por favor ingrese el nombre de la clienta.',
            'nombre_clienta.regex' => 'El nombre de la clienta no puede contener números.',
            'nombre_clienta.max' => 'El nombre no puede tener más de 100 caracteres.',
            'telefono.required' => 'Por favor ingrese el número de teléfono.',
            'telefono.size' => 'El teléfono debe tener exactamente 10 dígitos.',
            'telefono.regex' => 'El teléfono solo puede contener números.',
            'servicio.required' => 'Por favor seleccione un servicio.',
            'fecha_cita.required' => 'Por favor ingrese la fecha de la cita.',
            'fecha_cita.date' => 'ERROR: La fecha ingresada no es válida. Use el formato correcto.',
            'fecha_cita.after_or_equal' => 'ERROR: La fecha debe ser del año 2025 en adelante.',
            'fecha_cita.before_or_equal' => 'ERROR: La fecha no puede ser posterior al año 2050.',
            'hora_cita.required' => 'Por favor ingrese la hora de la cita.',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')
            ->with('success', 'Cita registrada.');
    }

    public function show($id)
    {
        $cita = Cita::withTrashed()->findOrFail($id);
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
            'fecha_cita' => [
                'required',
                'date',
                'after_or_equal:2025-01-01',
                'before_or_equal:2050-12-31',
            ],
            'hora_cita' => 'required',
            'estado' => 'required',
        ], [
            'nombre_clienta.required' => 'Por favor ingrese el nombre de la clienta.',
            'nombre_clienta.regex' => 'El nombre de la clienta no puede contener números.',
            'nombre_clienta.max' => 'El nombre no puede tener más de 100 caracteres.',
            'telefono.required' => 'Por favor ingrese el número de teléfono.',
            'telefono.size' => 'El teléfono debe tener exactamente 10 dígitos.',
            'telefono.regex' => 'El teléfono solo puede contener números.',
            'servicio.required' => 'Por favor seleccione un servicio.',
            'fecha_cita.required' => 'Por favor ingrese la fecha de la cita.',
            'fecha_cita.date' => 'ERROR: La fecha ingresada no es válida. Use el formato correcto.',
            'fecha_cita.after_or_equal' => 'ERROR: La fecha debe ser del año 2025 en adelante.',
            'fecha_cita.before_or_equal' => 'ERROR: La fecha no puede ser posterior al año 2050.',
            'hora_cita.required' => 'Por favor ingrese la hora de la cita.',
            'estado.required' => 'Por favor seleccione el estado de la cita.',
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

    public function eliminadas()
    {
        $citas = Cita::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
        return view('citas.eliminadas', compact('citas'));
    }
}

