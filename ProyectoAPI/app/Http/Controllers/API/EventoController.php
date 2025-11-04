<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EventoController extends Controller
{
    /**
     * Muestra los eventos del usuario filtrados por mes y año.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mes' => 'required|integer|min:1|max:12',
            'ano' => 'required|integer|min:2000|max:2100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $eventos = $request->user()->eventos()
            ->whereYear('fecha', $request->ano)
            ->whereMonth('fecha', $request->mes)
            ->orderBy('fecha', 'asc')
            ->orderBy('hora', 'asc')
            ->get();
        
        // Nota: Gracias al $with = ['categoria'] en el Modelo Evento,
        // cada evento ya vendrá con su categoría incluida.
        return response()->json($eventos);
    }

    /**
     * Almacena un nuevo evento para el usuario autenticado.
     */
public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date_format:Y-m-d',
            'hora' => 'nullable|date_format:H:i',
            'descripcion' => 'nullable|string',
            'gasto_estimado' => 'nullable|numeric|min:0|max:99999999.99',
            'categoria_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $datosValidados = $validator->validated();

        if ($request->has('categoria_id') && $request->categoria_id) {
            $categoria = $request->user()->categorias()->find($request->categoria_id);
            if (!$categoria) {
                return response()->json(['message' => 'La categoría seleccionada no es válida.'], 422);
            }
            $datosValidados['categoria_id'] = $categoria->id;
        }

        $evento = $request->user()->eventos()->create($datosValidados);

        // --- ¡¡¡ESTA ES LA LÍNEA DEL ARREGLO!!! ---
        // Forzamos a que se cargue la relación 'categoria'
        // (que usará el 'withDefault' si es necesario)
        $evento->load('categoria'); 
        
        // Ahora sí devolvemos el evento con el objeto 'categoria' incluido
        return response()->json($evento, 201);
    }

    /**
     * Muestra un evento específico.
     */
    public function show(Request $request, Evento $evento)
    {
        // --- CHEQUEO DE SEGURIDAD (EVENTO) ---
        // Validamos que el evento que se quiere ver le pertenece al usuario.
        if ($request->user()->id !== $evento->usuario_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return response()->json($evento);
    }

    /**
     * Actualiza un evento específico.
     */
    public function update(Request $request, Evento $evento)
    {
        // --- CHEQUEO DE SEGURIDAD (EVENTO) ---
        if ($request->user()->id !== $evento->usuario_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $validator = Validator::make($request->all(), [
            'titulo' => 'sometimes|required|string|max:255',
            'fecha' => 'sometimes|required|date_format:Y-m-d',
            'hora' => 'nullable|date_format:H:i',
            'descripcion' => 'nullable|string',
            'gasto_estimado' => 'nullable|numeric|min:0|max:99999999.99',
            'categoria_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $datosValidados = $validator->validated();

        // --- CHEQUEO DE SEGURIDAD (CATEGORÍA) ---
        // Si el usuario está intentando cambiar la categoría,
        // validamos que la NUEVA categoría también le pertenezca.
        if ($request->has('categoria_id') && $request->categoria_id) {
            $categoria = $request->user()->categorias()->find($request->categoria_id);
            if (!$categoria) {
                return response()->json(['message' => 'La categoría seleccionada no es válida.'], 422);
            }
            $datosValidados['categoria_id'] = $categoria->id;
        }

        $evento->update($datosValidados);

        // Devolvemos el evento actualizado, recargando la relación 'categoria'
        // por si acaso cambió.
        return response()->json($evento->load('categoria'));
    }

    /**
     * Elimina un evento específico.
     */
    public function destroy(Request $request, Evento $evento)
    {
        // --- CHEQUEO DE SEGURIDAD (EVENTO) ---
        if ($request->user()->id !== $evento->usuario_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $evento->delete();
        return response()->json(null, 204);
    }
}