<?php

namespace App\Http\Controllers;

use App\Autor;
use App\Exports\AutoresExport;
use App\Extensions\HttpCurls;
use App\Extensions\Resources;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AutorController extends Controller
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
            $validate = Resources::validateCreateAutor($request->all(), 1);

            if ($validate) {
                return response()->json(['mensaje' => $validate], 500);
            } else {
                DB::beginTransaction();
                $autor = new Autor();
                $autor->name = $request->name;
                $autor->lastname = $request->lastname;
                $autor->nickname = $request->nickname;
                $autor->nationality = $request->nationality;
                $autor->biografy = $request->biografy;
                $autor->email = $request->email;

                if ($autor->save()) {
                    $idAutorCreated = Autor::latest('id')->first()->id;
                    $dataUser['name'] = $request->name;
                    $dataUser['email'] = $request->email;
                    $dataUser['password'] = $request->password;

                    $createUser = RegisterController::create($dataUser);

                    if ($createUser) {
                        DB::commit();
                        return response()->json(['mensaje' => 'Autor Registrado con éxito', 'idAutor' => $idAutorCreated], 200);
                    } else {
                        DB::rollBack();
                        return response()->json(['mensaje' => 'Ocurrió un error al intentar registar el Autor'], 500);
                    }
                }
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Error en el sistema:' . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show($autor = null)
    {

        if ($autor == null) {
            $listAutor = Autor::all();
        } else {
            $listAutor = Autor::where('id', $autor)->get();
        }

        return response()->json(['list' => $listAutor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
            $validate = Resources::validateCreateAutor($request->all(), 2);

            if ($validate) {
                return response()->json(['mensaje' => $validate], 500);
            } else {
                DB::beginTransaction();
                $autor = Autor::find($request->idAutor);
                $autor->name = $request->name;
                $autor->lastname = $request->lastname;
                $autor->nickname = $request->nickname;
                $autor->nationality = $request->nationality;
                $autor->biografy = $request->biografy;

                if ($autor->save()) {
                    DB::commit();
                    return response()->json(['mensaje' => 'Autor Editado con éxito'], 200);
                } else {
                    DB::rollBack();
                    return response()->json(['mensaje' => 'Ocurrió un error al intentar registar el Autor'], 500);
                }
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Error en el sistema:' . $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!empty($request->idAutor)) {
            DB::beginTransaction();
            $deleteAutor = DB::table('autors')
                ->where('id', $request->idAutor)
                ->delete();
            if ($deleteAutor) {
                DB::commit();
                return response()->json(['mensaje' => 'Autor Eliminado con éxito'], 200);
            } else {
                DB::rollBack();
                return response()->json(['mensaje' => 'Ocurrió un error al intentar eliminar el Autor'], 500);
            }
        } else {
            return response()->json(['mensaje' => 'Debe ingresar el ID del autor'], 500);
        }
    }

    public function exportData()
    {
        $export = new AutoresExport();
        return Excel::download($export, 'Autores.xlsx');
    }
}
