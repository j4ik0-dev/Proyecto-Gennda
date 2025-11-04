<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 
        'categoria_id', 
        'titulo', 
        'descripcion', 
        'fecha', 
        'hora', 
        'gasto_estimado'
    ];

    // Para que la API siempre devuelva la categoría junto con el evento
    protected $with = ['categoria'];

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class);
    }

    public function categoria()
    {
        // 'withDefault' evita errores si una categoría fue borrada
        return $this->belongsTo(Categoria::class)->withDefault([
            'nombre' => 'Sin Categoría',
            'color' => '#D1D5DB'
        ]);
    }
}