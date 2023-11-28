<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Trabajadora;
use App\Models\Servicio;
use APP\Models\Detallerecibo;


/**
 * Class ReciboController
 * @package App\Http\Controllers
 */
class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recibos = Recibo::all();
        $clientes = Cliente::all();
        $trabajadoras = Trabajadora::all();
        $servicios = Servicio::all();
       

        return view('recibo.index', compact('recibos', 'clientes', 'trabajadoras', 'servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recibo = new Recibo();
        return view('recibo.create', compact('recibo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Recibo::$rules);

        $recibo = Recibo::create($request->all());

        return redirect()->route('recibos.index')
            ->with('success', 'Recibo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recibo = Recibo::find($id);

        return view('recibo.show', compact('recibo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recibo = Recibo::find($id);

        return view('recibo.edit', compact('recibo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Recibo $recibo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recibo $recibo)
    {
        request()->validate(Recibo::$rules);

        $recibo->update($request->all());

        return redirect()->route('recibos.index')
            ->with('success', 'Recibo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $recibo = Recibo::find($id)->delete();

        return redirect()->route('recibos.index')
            ->with('success', 'Recibo deleted successfully');
    }
}
