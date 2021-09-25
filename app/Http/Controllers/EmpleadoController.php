<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(3);
        return view('empleado.index', $datos );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     * Recibe la información y la prepara para que se guarde directamente en la tabla
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // campos a validar
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];

        // mensajes de error para el usuario
        $mensaje=[
                            // comodin
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida',

        ];

        // lo unimos 
        $this->validate($request, $campos, $mensaje);


        // obtiene toda la informacion que se le envió
        // $datosEmpleado = request()->all();
        // obtiene toda la informacion excepto el token
        $datosEmpleado = request()->except('_token');

        // Si la petición tiene un archivo Foto 
        if( $request->hasFile('Foto') ){
            // Alteramos el campo Foto, utilizamos el nombre del campo Foto, insertamos la información en el storage en la ruta uploads que esta en public
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }


        // Agarra el modelo y los inserta en la Base de Datos
        Empleado::insert( $datosEmpleado );
        // va a responder y va a mostrar en documento json toda la información
        // return response()->json($datosEmpleado);

        // redireccionamos a la url empleado y se le envia un mensaje con el valor  
        return redirect('empleado')->with('mensaje','Empleado agregado con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Recuperamos los datos 
        $empleado=Empleado::findOrFail($id);
        // le pasamos a la vista la información empleado y los mostramos en el formulario.
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        // campos a validar
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
        ];

        // mensajes de error para el usuario
        $mensaje=[
                            // comodin
            'required'=>'El :attribute es requerido',

        ];

        if( $request->hasFile('Foto') ){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La foto es requerida'];
        
        }

        // lo unimos 
        $this->validate($request, $campos, $mensaje);

        // le quitamos el token y el metodo de toda la información
        $datosEmpleado = request()->except('_token','_method');

        // Si la petición tiene un archivo Foto 
        if( $request->hasFile('Foto') ){
            // Recuperamos la información del empleado
            $empleado=Empleado::findOrFail($id);
            // hacemos el borrado de la foto antigua
            Storage::delete('public/'.$empleado->Foto);
            // Alteramos el campo Foto, utilizamos el nombre del campo Foto, insertamos la información en el storage en la ruta uploads que esta en public
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        // buscamos la información que esta con el id, 
        // y una vez que la encuentra se hace el update con los datos del empleado 
        Empleado::where('id','=',$id)->update($datosEmpleado);
        // Recuperamos los datos 
        $empleado=Empleado::findOrFail($id);
        // le pasamos a la vista la información empleado y los mostramos en el formulario.
        // return view('empleado.edit', compact('empleado'));
        
        // redireccionamos a la vista empleado y se le envia un mensaje con el valor  
        return redirect('empleado')->with('mensaje', 'Empleado modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Recuperamos los datos 
        $empleado=Empleado::findOrFail($id);

        // Borrar fisicamente la foto del storage
        if(Storage::delete('public/'.$empleado->Foto) ){

            Empleado::destroy($id);
        }


        // redireccionamos a la vista empleado y se le envia un mensaje con el valor  
        return redirect('empleado')->with('mensaje', 'Empleado borrado');
    }
}
