<?php

namespace App\Http\Controllers;

use App\AutorPorLibro;
use App\Events\CountAutorForLibro;
use Illuminate\Http\Request;

class AutorPorLibroController extends Controller
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
    public static function create($idAutor,$idLibroCreated,$participacion)
    {
        event(new CountAutorForLibro($idAutor,$participacion));
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
     * @param  \App\AutorPorLibro  $autorPorLibro
     * @return \Illuminate\Http\Response
     */
    public function show(AutorPorLibro $autorPorLibro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AutorPorLibro  $autorPorLibro
     * @return \Illuminate\Http\Response
     */
    public function edit(AutorPorLibro $autorPorLibro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AutorPorLibro  $autorPorLibro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AutorPorLibro $autorPorLibro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AutorPorLibro  $autorPorLibro
     * @return \Illuminate\Http\Response
     */
    public function destroy(AutorPorLibro $autorPorLibro)
    {
        //
    }
}
