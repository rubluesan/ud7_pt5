<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    public function list()
    {
        $clientes = Cliente::all();

        return view('cliente.list', ['clientes' => $clientes]);
    }

    public function new(Request $request)
    {
        if ($request->isMethod('post')) {
            // recogemos los campos del formulario en un objeto cuenta
            $hoy = new DateTime;

            $validated = $request->validate([
                'DNI' => 'required|size:9|unique:clientes',
                'nombre' => 'required',
                'apellidos' => 'required',
                'fechaN' => 'before_or_equal:'.$hoy->format('d-m-Y'),
            ]);

            $cliente = new Cliente;
            $cliente->DNI = $request->DNI;
            $cliente->nombre = $request->nombre;
            $cliente->apellidos = $request->apellidos;
            $cliente->fechaN = $request->fechaN;

            $filename = '';
            if ($request->file('imagen')) {
                $file = $request->file('imagen');
                $filename = $request->nombre.'_'.$request->apellidos.'_'.uniqid().'.'.$file->extension();
                $file->move(public_path('uploads/imagenes'), $filename);
                $cliente->imagen = $filename;
            }

            $cliente->save();

            return redirect()->route('cliente_list')->with('status', value: 'Nuevo cliente '.$cliente->DNI.' creado!');
        }
        // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

        $clientes = Cliente::all();

        return view(view: 'cliente.new');
    }

    public function delete($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect()->route('cliente_list')->with('status', 'Cliente '.$cliente->DNI.' eliminadO!');
    }

    public function edit(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if ($request->isMethod('post')) {
            // recogemos los campos del formulario en un objeto cuenta

            $hoy = new DateTime;
            $validated = $request->validate([
                'DNI' => ['required', Rule::unique('clientes')->ignore($cliente->id), 'size:9'],
                'nombre' => 'required',
                'apellidos' => 'required',
                'fechaN' => 'before_or_equal:'.$hoy->format('d-m-Y'),
            ]);

            $cliente->DNI = $request->DNI;
            $cliente->nombre = $request->nombre;
            $cliente->apellidos = $request->apellidos;
            $cliente->fechaN = $request->fechaN;

            $filename = '';

            if (isset($request->borrarImagen)) {
                $filename = $cliente->imagen;
                $cliente->imagen = null;
                $path = public_path('uploads/imagenes/'.$filename);

                if (File::exists($path)) {
                    File::delete($path);
                }
            }

            if ($request->file(key: 'imagen')) {
                $file = $request->file('imagen');
                $filename = $request->nombre.'_'.$request->apellidos.'_'.uniqid().'.'.$file->extension();
                $file->move(public_path('uploads/imagenes'), $filename);
                $cliente->imagen = $filename;
            }

            $cliente->save();

            return redirect()->route('cliente_list')->with('status', 'Cliente '.$cliente->DNI.' actualizado!');
        }
        // si no venimos de hacer submit al formulario, tenemos que mostrar el formulario

        $clientes = Cliente::all();

        return view('cliente.edit', ['cliente' => $cliente]);
    }
}
