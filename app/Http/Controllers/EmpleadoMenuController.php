<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Orden;

class EmpleadoMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('empleado.menu', compact('menus'));
    }

    public function crearOrden(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        
        $orden = new Orden([
            'menu_id' => $request->menu_id,
            'cantidad' => $request->cantidad,
            'estado' => 'pendiente',
            'total' => $menu->precio * $request->cantidad
        ]);

        $orden->save();

        return redirect()->route('empleado.orden.index')
            ->with('success', 'Orden creada correctamente');
    }
}
