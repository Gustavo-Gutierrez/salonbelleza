<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cita;
use App\Models\Recibo;
use App\Models\Producto;
use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Fechas
        $hoy = Carbon::today();
        $inicioMes = Carbon::now()->startOfMonth();
        $finMes = Carbon::now()->endOfMonth();
        $inicioSemana = Carbon::now()->startOfWeek();
        $finSemana = Carbon::now()->endOfWeek();
        
        // Estadísticas generales
        $estadisticas = [
            // Citas
            'citas_hoy' => Cita::whereDate('fecha', $hoy)->count(),
            'citas_pendientes' => Cita::where('estado', 'pendiente')->count(),
            'citas_confirmadas' => Cita::where('estado', 'confirmada')->count(),
            'citas_completadas_mes' => Cita::where('estado', 'completada')
                ->whereBetween('fecha', [$inicioMes, $finMes])
                ->count(),
            
            // Clientes
            'total_clientes' => User::clientes()->count(),
            'clientes_nuevos_mes' => User::clientes()
                ->whereBetween('created_at', [$inicioMes, $finMes])
                ->count(),
            
            // Finanzas
            'ingresos_hoy' => Recibo::whereDate('fecha', $hoy)->sum('total') ?? 0,
            'ingresos_semana' => Recibo::whereBetween('fecha', [$inicioSemana, $finSemana])->sum('total') ?? 0,
            'ingresos_mes' => Recibo::whereBetween('fecha', [$inicioMes, $finMes])->sum('total') ?? 0,
            
            // Inventario
            'productos_bajo_stock' => Producto::whereColumn('stock_actual', '<=', 'stock_minimo')->count(),
            'productos_agotados' => Producto::where('stock_actual', 0)->count(),
            
            // Gastos
            'gastos_mes' => Gasto::whereBetween('fecha', [$inicioMes, $finMes])->sum('monto') ?? 0,
        ];
        
        // Citas de hoy
        $citasHoy = Cita::with(['cliente', 'empleado', 'detalleCitas.servicio'])
            ->whereDate('fecha', $hoy)
            ->orderBy('hora_inicio')
            ->get();
        
        // Citas recientes
        $citasRecientes = Cita::with(['cliente', 'empleado'])
            ->where('estado', '!=', 'cancelada')
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio', 'desc')
            ->limit(10)
            ->get();
        
        // Productos bajo stock
        $productosBajoStock = Producto::with('movimientos')
            ->whereColumn('stock_actual', '<=', 'stock_minimo')
            ->orderBy('stock_actual')
            ->limit(10)
            ->get();
        
        // Top servicios más solicitados
        $topServicios = DB::table('detalle_citas')
            ->join('servicios', 'detalle_citas.servicio_id', '=', 'servicios.id')
            ->select(
                'servicios.nombre',
                DB::raw('COUNT(*) as total_citas'),
                DB::raw('SUM(detalle_citas.cantidad) as total_servicios'),
                DB::raw('SUM(detalle_citas.subtotal) as total_ingresos')
            )
            ->groupBy('servicios.id', 'servicios.nombre')
            ->orderBy('total_ingresos', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard.index', compact(
            'estadisticas',
            'citasHoy',
            'citasRecientes',
            'productosBajoStock',
            'topServicios'
        ));
    }
}