<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['empleados']= Empleados::paginate(5);

        return view('empleados.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$fields = [
			'Nombre' => 'required|string|max:100',
			'Apellido' => 'required|string|max:100',
			'Email' => 'required|email',
			//'Foto' => 'required|max:10000|mimes:jpeg, png, jpg'
		];

		$Mensaje=['required' => 'El :attribute es requerido'];
		$this->validate($request, $fields, $Mensaje);

		$userData = request()->except('_token');

		if($request->hasFile('Foto')){
			$userData['Foto']= $request->file('Foto')->store('uploads', 'public');
		}

		Empleados::insert($userData);

		return redirect('empleados')->with('Mensaje', 'Empleado agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$empleado = Empleados::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, $id)
    {

		$fields = [
			'Nombre' => 'required|string|max:100',
			'Apellido' => 'required|string|max:100',
			'Email' => 'required|email'
		];



		$Mensaje=['required' => 'El :attribute es requerido'];
		$this->validate($request, $fields, $Mensaje);

		$userData = request()->except(['_token', '_method']);
		
			if($request->hasFile('Foto')){

				$empleado = Empleados::findOrFail($id);

				Storage::delete('public/' .$empleado->Foto);

				$userData['Foto']= $request->file('Foto')->store('uploads', 'public');
		}

		Empleados::where('id', '=', $id)->update($userData);

		//$empleado = Empleados::findOrFail($id);
		// return view('empleados.edit', compact('empleado'));
		
		return redirect('empleados')->with('Mensaje', 'Empleado modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$empleado = Empleados::findOrFail($id);
		if(Storage::delete('public/' .$empleado->Foto)){

			Empleados::destroy($id);
		}

		return redirect('empleados')->with('Mensaje', 'Empleado eliminado con éxito');
    }
}
