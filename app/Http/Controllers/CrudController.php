<?php

namespace App\Http\Controllers;

use App\Crud;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Crud[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $cruds=Crud::query()->orderBy('nombre','ASC')->get();

        $array=[];
        $i=1;
        foreach ($cruds as $crud){
            array_push($array,[
                'nombre'=>$crud->nombre,
                'number'=>$i,
                'id'=>$crud->id,
                'created_at'=>$crud->created_at,
                'updated_at'=>$crud->updated_at
            ]);

            $i++;
        }
        return $array;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre=$request->nombre;
        $dependencia=new Crud();
        $dependencia->nombre=$nombre;
        $dependencia->save();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nombre=$request->nombre;
        $dependencia=Crud::find($id);
        $dependencia->nombre=$nombre;
        $dependencia->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return int
     */
    public function destroy($id)
    {
       return Crud::destroy($id);
    }

    public function show($id)
    {
        return Crud::find($id);
    }

}
