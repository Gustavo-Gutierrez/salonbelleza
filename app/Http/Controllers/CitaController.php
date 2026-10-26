<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use App\Models\Servicio;
use App\Models\DetalleCita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cita::with(['cliente', 'empleado', 'detalleCitas.servicio'])
                    ->latest();
        
        // Filtros
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }
        
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        
        if ($request->filled('empleado_id')) {
            $query->where('empleado_id', $request->empleado_id);
        }
        
        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', $request->cliente_id);
        }
        
        $citas = $query->paginate(20);
        $clientes = User::clientes()->get();
        $empleados = User::empleados()->get();
        $servicios = Servicio::activos()->get();
        
        return view('citas.index', compact('citas', 'clientes', 'empleados', 'servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = User::clientes()->get();
        $empleados = User::empleados()->get();
        $servicios = Servicio::activos()->get();
        
        return view('citas.create', compact('clientes', 'empleados', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'cliente_id' => 'required|exists:users,id',
            'empleado_id' => 'required|exists:users,id',
            'servicios' => 'required|array|min:1',
            'servicios.*.id' => 'required|exists:servicios,id',
            'servicios.*.cantidad' => 'required|integer|min:1',
            'notas' => 'nullable|string',
            'descuento' => 'nullable|numeric|min:0',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Calcular duración total
            $duracionTotal = 0;
            $total = 0;
            
            foreach ($request->servicios as $servicioData) {
                $servicio = Servicio::find($servicioData['id']);
                $duracionTotal += $servicio->duracion_minutos * $servicioData['cantidad'];
                $total += $servicio->precio * $servicioData['cantidad'];
            }
            
            $horaInicio = Carbon::parse($request->hora_inicio);
            $horaFin = $horaInicio->copy()->addMinutes($duracionTotal);
            
            // Crear cita
            $cita = Cita::create([
                'fecha' => $request->fecha,
                'hora_inicio' => $horaInicio,
                'hora_fin' => $horaFin,
                'cliente_id' => $request->cliente_id,
                'empleado_id' => $request->empleado_id,
                'notas' => $request->notas,
                'descuento' => $request->descuento ?? 0,
                'total' => $total,
                'total_final' => $total - ($request->descuento ?? 0),
                'estado' => 'pendiente',
            ]);
            
            // Agregar servicios a la cita
            foreach ($request->servicios as $servicioData) {
                $servicio = Servicio::find($servicioData['id']);
                
                $cita->detalleCitas()->create([
                    'servicio_id' => $servicio->id,
                    'cantidad' => $servicioData['cantidad'],
                    'precio_unitario' => $servicio->precio,
                    'subtotal' => $servicio->precio * $servicioData['cantidad'],
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('citas.index')
                ->with('success', 'Cita creada exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al crear la cita: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        $cita->load(['cliente', 'empleado', 'detalleCitas.servicio', 'recibo']);
        return view('citas.show', compact('cita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        $clientes = User::clientes()->get();
        $empleados = User::empleados()->get();
        $servicios = Servicio::activos()->get();
        
        $cita->load('detalleCitas.servicio');
        
        return view('citas.edit', compact('cita', 'clientes', 'empleados', 'servicios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'cliente_id' => 'required|exists:users,id',
            'empleado_id' => 'required|exists:users,id',
            'estado' => 'required|in:pendiente,confirmada,en_proceso,completada,cancelada',
            'notas' => 'nullable|string',
            'descuento' => 'nullable|numeric|min:0',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Actualizar datos básicos
            $cita->update([
                'fecha' => $request->fecha,
                'hora_inicio' => $request->hora_inicio,
                'cliente_id' => $request->cliente_id,
                'empleado_id' => $request->empleado_id,
                'estado' => $request->estado,
                'notas' => $request->notas,
                'descuento' => $request->descuento ?? 0,
            ]);
            
            // Recalcular hora_fin
            $duracionTotal = $cita->detalleCitas->sum(function($detalle) {
                return optional($detalle->servicio)->duracion_minutos * $detalle->cantidad;
            }) ?: 60;
            
            $horaFin = Carbon::parse($request->hora_inicio)->addMinutes($duracionTotal);
            $cita->hora_fin = $horaFin;
            $cita->save();
            
            // Si se completó, generar recibo automáticamente
            if ($request->estado == 'completada' && !$cita->recibo) {
                $this->generarRecibo($cita);
            }
            
            DB::commit();
            
            return redirect()->route('citas.index')
                ->with('success', 'Cita actualizada exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al actualizar la cita: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        DB::beginTransaction();
        
        try {
            // Eliminar detalles primero
            $cita->detalleCitas()->delete();
            
            // Eliminar recibo si existe
            if ($cita->recibo) {
                $cita->recibo->delete();
            }
            
            // Eliminar cita
            $cita->delete();
            
            DB::commit();
            
            return redirect()->route('citas.index')
                ->with('success', 'Cita eliminada exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('citas.index')
                ->with('error', 'Error al eliminar la cita: ' . $e->getMessage());
        }
    }

    /**
     * Vista de agenda/calendario
     */
    public function agenda(Request $request)
    {
        $fecha = $request->filled('fecha') ? Carbon::parse($request->fecha) : Carbon::today();
        $empleadoId = $request->empleado_id;
        
        $empleados = User::empleados()->get();
        
        if ($empleadoId) {
            $empleado = User::find($empleadoId);
            $citas = Cita::where('empleado_id', $empleadoId)
                        ->whereDate('fecha', $fecha)
                        ->orderBy('hora_inicio')
                        ->get();
        } else {
            $empleado = $empleados->first();
            $citas = collect();
        }
        
        // Generar horarios disponibles
        $horariosDisponibles = $this->generarHorariosDisponibles($fecha, $empleado);
        
        return view('citas.agenda', compact('fecha', 'empleados', 'empleado', 'citas', 'horariosDisponibles'));
    }

    /**
     * Cambiar estado de cita
     */
    public function cambiarEstado(Cita $cita, Request $request)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,en_proceso,completada,cancelada',
        ]);
        
        $cita->estado = $request->estado;
        
        // Si se completa la cita, generar recibo automáticamente
        if ($request->estado == 'completada' && !$cita->recibo) {
            $this->generarRecibo($cita);
        }
        
        $cita->save();
        
        return redirect()->back()->with('success', 'Estado de la cita actualizado.');
    }
    
    /**
     * Generar horarios disponibles
     */
    private function generarHorariosDisponibles($fecha, $empleado)
    {
        $horarios = [];
        $horaInicio = Carbon::parse('09:00');
        $horaFin = Carbon::parse('19:00');
        
        while ($horaInicio < $horaFin) {
            $horarios[] = $horaInicio->format('H:i');
            $horaInicio->addMinutes(30);
        }
        
        // Filtrar horarios ocupados
        $citas = Cita::where('empleado_id', $empleado->id)
                    ->whereDate('fecha', $fecha)
                    ->whereIn('estado', ['pendiente', 'confirmada', 'en_proceso'])
                    ->get();
        
        $horariosOcupados = [];
        foreach ($citas as $cita) {
            $horaCita = Carbon::parse($cita->hora_inicio);
            $horariosOcupados[] = $horaCita->format('H:i');
        }
        
        return array_diff($horarios, $horariosOcupados);
    }
    
    /**
     * Generar recibo automáticamente
     */
    private function generarRecibo(Cita $cita)
    {
        DB::beginTransaction();
        
        try {
            $recibo = Recibo::create([
                'fecha' => now(),
                'cita_id' => $cita->id,
                'cliente_id' => $cita->cliente_id,
                'empleado_id' => $cita->empleado_id,
                'user_id' => auth()->id(),
                'metodo_pago' => 'efectivo',
            ]);
            
            DB::commit();
            return $recibo;
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    /**
     * Obtener horarios disponibles (AJAX)
     */
    public function horariosDisponibles(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'empleado_id' => 'required|exists:users,id',
        ]);
        
        $fecha = Carbon::parse($request->fecha);
        $empleado = User::find($request->empleado_id);
        
        $horariosDisponibles = $this->generarHorariosDisponibles($fecha, $empleado);
        
        return response()->json($horariosDisponibles);
    }
}