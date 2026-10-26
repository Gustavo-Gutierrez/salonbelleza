<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\MovimientoInventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::withCount('movimientos');
        
        if ($request->filled('search')) {
            $query->where('nombre', 'like', "%{$request->search}%")
                  ->orWhere('codigo', 'like', "%{$request->search}%");
        }
        
        if ($request->filled('categoria') && $request->categoria != 'todas') {
            $query->where('categoria', $request->categoria);
        }
        
        if ($request->filled('estado')) {
            if ($request->estado == 'bajo_stock') {
                $query->whereColumn('stock_actual', '<=', 'stock_minimo');
            } elseif ($request->estado == 'agotado') {
                $query->where('stock_actual', 0);
            } elseif ($request->estado == 'activo') {
                $query->where('activo', true);
            } elseif ($request->estado == 'inactivo') {
                $query->where('activo', false);
            }
        }
        
        $productos = $query->orderBy('nombre')->paginate(20);
        $categorias = Producto::distinct()->pluck('categoria');
        
        return view('productos.index', compact('productos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:100',
            'stock_minimo' => 'required|integer|min:0',
            'stock_actual' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'unidad_medida' => 'required|string|max:50',
            'fecha_vencimiento' => 'nullable|date',
            'ubicacion' => 'nullable|string|max:100',
            'activo' => 'boolean',
        ]);
        
        DB::beginTransaction();
        
        try {
            $producto = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'categoria' => $request->categoria,
                'stock_minimo' => $request->stock_minimo,
                'stock_actual' => $request->stock_actual,
                'precio_compra' => $request->precio_compra,
                'precio_venta' => $request->precio_venta,
                'unidad_medida' => $request->unidad_medida,
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'ubicacion' => $request->ubicacion,
                'activo' => $request->has('activo'),
            ]);
            
            // Registrar movimiento inicial
            if ($request->stock_actual > 0) {
                MovimientoInventario::create([
                    'fecha' => now(),
                    'tipo' => 'entrada',
                    'motivo' => 'Entrada inicial',
                    'cantidad' => $request->stock_actual,
                    'cantidad_anterior' => 0,
                    'cantidad_nueva' => $request->stock_actual,
                    'producto_id' => $producto->id,
                    'user_id' => auth()->id(),
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('productos.index')
                ->with('success', 'Producto creado exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al crear el producto: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $producto->load(['movimientos.usuario', 'detalleCitas.cita']);
        $movimientos = $producto->movimientos()->latest()->paginate(10);
        
        return view('productos.show', compact('producto', 'movimientos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:100',
            'stock_minimo' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'unidad_medida' => 'required|string|max:50',
            'fecha_vencimiento' => 'nullable|date',
            'ubicacion' => 'nullable|string|max:100',
            'activo' => 'boolean',
        ]);
        
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'stock_minimo' => $request->stock_minimo,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $request->precio_venta,
            'unidad_medida' => $request->unidad_medida,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'ubicacion' => $request->ubicacion,
            'activo' => $request->has('activo'),
        ]);
        
        return redirect()->route('productos.show', $producto)
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        // Verificar si el producto está siendo usado
        if ($producto->detalleCitas()->exists()) {
            return redirect()->route('productos.index')
                ->with('error', 'No se puede eliminar el producto porque está siendo usado en citas.');
        }
        
        $producto->delete();
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
    
    /**
     * Ajustar stock del producto
     */
    public function ajustarStock(Request $request, Producto $producto)
    {
        $request->validate([
            'tipo' => 'required|in:entrada,salida,ajuste',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
        ]);
        
        DB::beginTransaction();
        
        try {
            $cantidadAnterior = $producto->stock_actual;
            
            if ($request->tipo == 'entrada') {
                $producto->agregarStock($request->cantidad, $request->motivo, auth()->id());
            } elseif ($request->tipo == 'salida') {
                $producto->reducirStock($request->cantidad, $request->motivo, auth()->id());
            } else {
                // Ajuste directo
                $producto->stock_actual = $request->cantidad;
                $producto->save();
                
                MovimientoInventario::create([
                    'fecha' => now(),
                    'tipo' => 'ajuste',
                    'motivo' => $request->motivo,
                    'cantidad' => $request->cantidad - $cantidadAnterior,
                    'cantidad_anterior' => $cantidadAnterior,
                    'cantidad_nueva' => $request->cantidad,
                    'observaciones' => $request->observaciones,
                    'producto_id' => $producto->id,
                    'user_id' => auth()->id(),
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('productos.show', $producto)
                ->with('success', 'Stock ajustado exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al ajustar stock: ' . $e->getMessage());
        }
    }
}