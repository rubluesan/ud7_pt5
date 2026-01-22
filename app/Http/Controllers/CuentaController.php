<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuenta;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function list()
    {
        $cuentas = Cuenta::all();

        return view('cuenta.list', ['cuentas' => $cuentas]);
    }

    public function new(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'codigo' => 'required|max:10|unique:cuentas',
                'saldo' => 'required',
            ]);

            // recogemos los campos del formulario en un objeto cuenta
            $cuenta = new Cuenta;
            $cuenta->codigo = $request->codigo;
            $cuenta->saldo = $request->saldo;
            $cuenta->cliente_id = $request->cliente_id;
            $cuenta->save();

            return redirect()->route(route: 'cuenta_list')->with('status', 'Nueva cuenta '.$cuenta->codigo.' creada!');
        }
        // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

        $clientes = Cliente::all();

        return view('cuenta.new', ['clientes' => $clientes]);
    }

    public function delete($id)
    {
        $cuenta = Cuenta::find($id);
        $cuenta->delete();

        return redirect()->route('cuenta_list')->with('status', 'Cuenta '.$cuenta->codigo.' eliminada!');
    }

    public function edit(Request $request, $id)
    {
        $cuenta = Cuenta::find($id);

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'codigo' => ['required', Rule::unique('cuentas')->ignore($cuenta->id), 'max:10'],
                'saldo' => 'required',
            ]);

            // recogemos los campos del formulario en un objeto cuenta

            $cuenta->codigo = $request->codigo;
            $cuenta->saldo = $request->saldo;
            $cuenta->cliente_id = $request->cliente_id;
            $cuenta->save();

            return redirect()->route('cuenta_list')->with('status', 'Cuenta '.$cuenta->codigo.' actualizada!');
        }
        // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

        $clientes = Cliente::all();

        return view('cuenta.edit', ['clientes' => $clientes, 'cuenta' => $cuenta]);
    }
}
