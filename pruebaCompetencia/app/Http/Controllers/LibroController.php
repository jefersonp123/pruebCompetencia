<?php

namespace App\Http\Controllers;

use App\AutorPorLibro;
use App\Exports\LibrosExport;
use App\Extensions\Resources;
use App\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $validate = Resources::validateCreateLibro($request->all(), 1);

            if ($validate) {
                return response()->json(['mensaje' => $validate], 500);
            } else {
                DB::beginTransaction();
                $libro = new Libro();
                $libro->title = $request->title;
                $libro->year_publication = $request->year_publication;
                $libro->gender = $request->gender;
                $libro->editorial = $request->editorial;
                $libro->summary = $request->summary;
                $libro->pages = $request->pages;

                if ($libro->save()) {
                    $idLibroCreated = Libro::latest('id')->first()->id;

                    //$createUser = AutorPorLibroController::create($request->idAutor,$idLibroCreated,$request->participación);

                    //if ($createUser) {
                    DB::commit();
                    return response()->json(['mensaje' => 'Libro Registrado con éxito', 'idLibro' => $idLibroCreated], 200);
                    // } else {
                    //     DB::rollBack();
                    //     return response()->json(['mensaje' => 'Ocurrió un error al intentar registar el Autor'], 500);
                    // }
                }
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Error en el sistema:' . $e], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show($libro = null)
    {

        if ($libro == null) {
            $listAutor = Libro::all();
        }else {
            $listAutor = Libro::where('title','like','%'.$libro.'%')->get();
        }

        return response()->json(['list'=>$listAutor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
            $validate = Resources::validateCreateLibro($request->all(), 2);

            if ($validate) {
                return response()->json(['mensaje' => $validate], 500);
            } else {
                DB::beginTransaction();
                $libro = Libro::find($request->idLibro);
                $libro->title = $request->title;
                $libro->year_publication = $request->year_publication;
                $libro->gender = $request->gender;
                $libro->editorial = $request->editorial;
                $libro->summary = $request->summary;
                $libro->pages = $request->pages;

                if ($libro->save()) {
                    DB::commit();
                    return response()->json(['mensaje' => 'Libro Editado con éxito'], 200);
                } else {
                    DB::rollBack();
                    return response()->json(['mensaje' => 'Ocurrió un error al intentar registar el Libro'], 500);
                }
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Error en el sistema:' . $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!empty($request->idLibro)) {
            DB::beginTransaction();
            $deleteAutor = DB::table('libros')
                ->where('id', $request->idLibro)
                ->delete();
            if ($deleteAutor) {
                DB::commit();
                return response()->json(['mensaje' => 'Libro Eliminado con éxito'], 200);
            } else {
                DB::rollBack();
                return response()->json(['mensaje' => 'Ocurrió un error al intentar eliminar el Libro'], 500);
            }
        }else {
            return response()->json(['mensaje' => 'Debe ingresar el ID del Libro'], 500);
        }
    }

    
    public function exportData()
    {
        $export = new LibrosExport();
        return Excel::download($export, 'Libros.xlsx');
    }
}
