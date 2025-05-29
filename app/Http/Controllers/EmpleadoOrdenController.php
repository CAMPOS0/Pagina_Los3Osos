<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;

class EmpleadoOrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::with('menu')->orderBy('created_at', 'desc')->get();
        return view('empleado.orden', compact('ordenes'));
    }

    public function edit(Orden $orden)
    {
        return view('empleado.orden-edit', compact('orden'));    }

    public function update(Request $request, Orden $orden)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:1',
            'estado' => 'required|in:pendiente,en_proceso,completada'
        ]);

        $orden->update([
            'cantidad' => $request->cantidad,
            'estado' => $request->estado,
            'total' => $orden->menu->precio * $request->cantidad
        ]);
        
        return redirect()->route('empleado.orden.index')->with('success', 'Orden actualizada correctamente');
    }    public function destroy(Orden $orden)
    {
        $orden->delete();
        return redirect()->route('empleado.orden.index')->with('success', 'Orden eliminada correctamente');
    }
}
