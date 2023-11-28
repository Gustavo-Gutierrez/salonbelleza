<?php

namespace App\Http\Controllers;

use App\Models\Citum;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Trabajadora;
use App\Models\DetalleCitum;
use App\Models\Servicio;


/**
 * Class CitumController
 * @package App\Http\Controllers
 */
class CitumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = Citum::all();
        $clientes = Cliente::all();
        $trabajadoras = Trabajadora::all();
        $detallecitas = DetalleCitum::all();

        return view('citum.index', compact('citas', 'clientes', 'trabajadoras', 'detallecitas'));
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $citum = new Citum();
        $clientes = Cliente::all();
        $trabajadoras = Trabajadora::all();
        $detallecitas = DetalleCitum::all();
        $servicios = Servicio::all();
        return view('citum.create', compact('citum', 'clientes', 'trabajadoras', 'detallecitas', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Citum::$rules);

        $citum = Citum::create($request->all());

        return redirect()->route('cita.index')
            ->with('success', 'Citum created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $citum = Citum::find($id);

        return view('citum.show', compact('citum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $citum = Citum::find($id);

        return view('citum.edit', compact('citum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Citum $citum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citum $citum)
    {
        request()->validate(Citum::$rules);

        $citum->update($request->all());

        return redirect()->route('cita.index')
            ->with('success', 'Citum updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $citum = Citum::find($id)->delete();

        return redirect()->route('cita.index')
            ->with('success', 'Citum deleted successfully');
    }
}
