<?php

namespace App\Http\Controllers;

use App\Models\Trabajadora;
use Illuminate\Http\Request;

/**
 * Class TrabajadoraController
 * @package App\Http\Controllers
 */
class TrabajadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajadoras = Trabajadora::paginate();

        return view('trabajadora.index', compact('trabajadoras'))
            ->with('i', (request()->input('page', 1) - 1) * $trabajadoras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trabajadora = new Trabajadora();
        return view('trabajadora.create', compact('trabajadora'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Trabajadora::$rules);

        $trabajadora = Trabajadora::create($request->all());

        return redirect()->route('trabajadoras.index')
            ->with('success', 'Trabajadora created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trabajadora = Trabajadora::find($id);

        return view('trabajadora.show', compact('trabajadora'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trabajadora = Trabajadora::find($id);

        return view('trabajadora.edit', compact('trabajadora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Trabajadora $trabajadora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trabajadora $trabajadora)
    {
        request()->validate(Trabajadora::$rules);

        $trabajadora->update($request->all());

        return redirect()->route('trabajadoras.index')
            ->with('success', 'Trabajadora updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $trabajadora = Trabajadora::find($id)->delete();

        return redirect()->route('trabajadoras.index')
            ->with('success', 'Trabajadora deleted successfully');
    }
}
