<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cita;
use App\Models\Recibo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::clientes()->withCount(['citasComoCliente', 'recibosComoCliente']);
        
        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('ci', 'like', "%{$search}%")
                  ->orWhere('codigo_cliente', 'like', "%{$search}%");
            });
        }
        
        $clientes = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'ci' => 'nullable|string|max:20|unique:users,ci',
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Crear cliente
            $cliente = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'ci' => $request->ci,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'role' => 'cliente',
                'password' => bcrypt('cliente123'),
            ]);
            
            // Generar código de cliente automáticamente
            $cliente->generarCodigoCliente();
            
            DB::commit();
            
            return redirect()->route('clientes.index')
                ->with('success', 'Cliente creado exitosamente. Código: ' . $cliente->codigo_cliente);
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al crear el cliente: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $cliente)
    {
        // Verificar que sea cliente
        if ($cliente->role != 'cliente') {
            abort(404);
        }
        
        $cliente->load(['citasComoCliente' => function($query) {
            $query->orderBy('fecha', 'desc')->limit(10);
        }, 'recibosComoCliente' => function($query) {
            $query->orderBy('fecha', 'desc')->limit(10);
        }]);
        
        // Estadísticas
        $estadisticas = [
            'total_citas' => $cliente->citasComoCliente()->count(),
            'citas_completadas' => $cliente->citasComoCliente()->where('estado', 'completada')->count(),
            'total_gastado' => $cliente->recibosComoCliente()->sum('total'),
            'ultima_cita' => $cliente->citasComoCliente()->orderBy('fecha', 'desc')->first(),
        ];
        
        return view('clientes.show', compact('cliente', 'estadisticas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $cliente)
    {
        // Verificar que sea cliente
        if ($cliente->role != 'cliente') {
            abort(404);
        }
        
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $cliente)
    {
        // Verificar que sea cliente
        if ($cliente->role != 'cliente') {
            abort(404);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($cliente->id),
            ],
            'phone' => 'required|string|max:20',
            'ci' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('users')->ignore($cliente->id),
            ],
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date',
        ]);
        
        $cliente->update($request->only(['name', 'email', 'phone', 'ci', 'address', 'birth_date']));
        
        return redirect()->route('clientes.show', $cliente)
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $cliente)
    {
        // Verificar que sea cliente
        if ($cliente->role != 'cliente') {
            abort(404);
        }
        
        DB::beginTransaction();
        
        try {
            // Verificar si tiene citas activas
            $citasActivas = $cliente->citasComoCliente()
                ->whereIn('estado', ['pendiente', 'confirmada', 'en_proceso'])
                ->exists();
            
            if ($citasActivas) {
                throw new \Exception('No se puede eliminar el cliente porque tiene citas activas.');
            }
            
            // Soft delete
            $cliente->delete();
            
            DB::commit();
            
            return redirect()->route('clientes.index')
                ->with('success', 'Cliente eliminado exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('clientes.index')
                ->with('error', $e->getMessage());
        }
    }
    
    /**
     * Historial completo del cliente
     */
    public function historial(User $cliente)
    {
        // Verificar que sea cliente
        if ($cliente->role != 'cliente') {
            abort(404);
        }
        
        $citas = $cliente->citasComoCliente()
            ->with(['empleado', 'detalleCitas.servicio'])
            ->orderBy('fecha', 'desc')
            ->paginate(15);
        
        $recibos = $cliente->recibosComoCliente()
            ->with(['empleado', 'cita'])
            ->orderBy('fecha', 'desc')
            ->paginate(15);
        
        return view('clientes.historial', compact('cliente', 'citas', 'recibos'));
    }
    
    /**
     * Información del cliente (AJAX)
     */
    public function info(Request $request)
    {
        $cliente = User::clientes()->find($request->id);
        
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }
        
        return response()->json([
            'name' => $cliente->name,
            'email' => $cliente->email,
            'phone' => $cliente->phone,
            'address' => $cliente->address,
            'codigo_cliente' => $cliente->codigo_cliente,
            'total_gastado' => number_format($cliente->total_gastado, 2),
            'citas_completadas' => $cliente->citas_completadas,
        ]);
    }
}