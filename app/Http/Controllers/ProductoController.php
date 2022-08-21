<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //consultar la información
         $datos['productos']=Producto::paginate(3);
         return view('producto.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'Producto'=>'required|string|max:100',
            'Cantidad'=>'required|int|max:100',
            'Caducidad'=>'required|string|max:100',
            'Precio'=>'required|string|max:10',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];

        $mensaje=[
                'required'=>'El :attribute es requerido',
                'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request,$campos,$mensaje);


        $datosProducto = request()->except('_token');

        //con esta condicional cambiamos el archivo y lo guardamos para poder tener guardada la foto como .jpj
        if($request->hasFile('Foto')){
            $datosProducto['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Producto::insert($datosProducto);
        return redirect('producto')->with('mensaje','Producto agregado con exito');
       // return response()->json($datosProducto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto=Producto::findOrFail($id);
        return view('producto.edit',compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Producto'=>'required|string|max:100',
            'Cantidad'=>'required|int|max:100',
            'Caducidad'=>'required|string|max:100',
            'Precio'=>'required|string|max:10',    
        ];

        $mensaje=[
                'required'=>'El :attribute es requerido',      
        ];


        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La foto es requerida'];
        }

        $this->validate($request,$campos,$mensaje);

        $datosProducto = request()->except(['_token','_method']);
        
        if($request->hasFile('Foto')){
            $producto=Producto::findOrFail($id);
            Storage::delete('public/'.$producto->Foto);
            $datosProducto['Foto']=$request->file('Foto')->store('uploads','public');
        }
        
        
        Producto::where('id','=',$id)->update($datosProducto);

        $producto=Producto::findOrFail($id);
        //return view('empleado.edit',compact('empleado'));
        return redirect('producto')->with('mensaje','Producto Modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producto=Producto::findOrFail($id);
        if(Storage::delete('public/'.$producto->Foto)){
            Producto::destroy($id);
        }

        
        return redirect('producto')->with('mensaje','Producto Borrado');
    }
}
