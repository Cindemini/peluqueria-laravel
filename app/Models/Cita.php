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

    static public function getCitasHoy()
    {
        return self::where('fecha_cita', date('Y-m-d'))->orderBy('hora_cita')->get();
    }

    static public function getHistorial($limite = 50)
    {
        return self::where('fecha_cita', '<', date('Y-m-d'))
                   ->orderBy('fecha_cita', 'DESC')
                   ->limit($limite)
                   ->get();
    }
}