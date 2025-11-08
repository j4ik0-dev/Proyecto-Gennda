<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'monto',
        'saldo_total'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id');
    }
}

use App\Http\Controllers\API\saldoController;
Route::apiResource('saldo', ProductController::class); 