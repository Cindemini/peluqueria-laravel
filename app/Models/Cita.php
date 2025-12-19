<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;
    
    protected $table = 'citas';
    
    protected $primaryKey = 'id_cita';
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'nombre_clienta',
        'telefono',
        'servicio',
        'fecha_cita',
        'hora_cita',
        'estado'
    ];
    

    static public function getCitas()
    {
        return self::all();
    }
    
    static public function getCitasById($id)
    {
        return self::find($id);
    }
    
    static public function getCitasByEstado($estado)
    {
        return self::where('estado', $estado)->get();
    }
    
    static public function getCitasByFecha($fecha)
    {
        return self::where('fecha_cita', $fecha)->orderBy('hora_cita')->get();
    }
    
    static public function getCitasHoy()
    {
        return self::where('fecha_cita', date('Y-m-d'))->orderBy('hora_cita')->get();
    }
    
    static public function verificarDisponibilidad($fecha, $hora, $id_cita = null)
    {
        $query = self::where('fecha_cita', $fecha)
                    ->where('hora_cita', $hora)
                    ->where('estado', '!=', 'cancelada');
        
        if ($id_cita) {
            $query->where('id_cita', '!=', $id_cita);
        }
        
        return $query->count() == 0;
    }
    
    static public function createCita($request)
    {
        return self::create($request->all());
    }
    
    static public function updateCita($request)
    {
        return self::update($request->all());
    }
    
    static public function cambiarEstado($id_cita, $nuevo_estado)
    {
        $cita = self::find($id_cita);
        if ($cita) {
            $cita->estado = $nuevo_estado;
            return $cita->save();
        }
        return false;
    }
    
    static public function buscarPorNombre($nombre)
    {
        return self::where('nombre_clienta', 'LIKE', "%{$nombre}%")->get();
    }
    
    static public function buscarPorTelefono($telefono)
    {
        return self::where('telefono', 'LIKE', "%{$telefono}%")->get();
    }
    
    static public function getHistorial($limite = 50)
    {
        return self::where('fecha_cita', '<', date('Y-m-d'))
                   ->orderBy('fecha_cita', 'DESC')
                   ->limit($limite)
                   ->get();
    }
    
    static public function getCitasProximas()
    {
        return self::where('fecha_cita', '>=', date('Y-m-d'))
                   ->where('estado', 'pendiente')
                   ->orderBy('fecha_cita')
                   ->orderBy('hora_cita')
                   ->get();
    }
}