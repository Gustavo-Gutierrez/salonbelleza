<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Cliente;
use App\Models\Citum;

class DashboardController extends Controller
{
    public function index()
    {
    $chart_options = [
        'chart_title' => 'transacciones de citas por cliente',
        'chart_type' => 'bar',
        'report_type' => 'group_by_relationship',
        'model' => 'App\Models\Citum',
    
        'relationship_name' => 'cliente', // represents function user() on Transaction model
        'group_by_field' => 'Nombre', // users.name
    
        
        
        'filter_field' => 'Fecha', 
        'filter_days' => 30, // show only transactions for last 30 days
        'filter_period' => 'week', // show only transactions for this week
    ];
    $chart1 = new LaravelChart($chart_options);
    
    $chart_options = [
        'chart_title' => 'transacciones de citas por trabajadora',
        'chart_type' => 'line',
        'report_type' => 'group_by_relationship',
        'model' => 'App\Models\Citum',
    
        'relationship_name' => 'trabajadora', // represents function user() on Transaction model
        'group_by_field' => 'Nombre', // users.name
    
        
        
        'filter_field' => 'Fecha', 
        'filter_days' => 30, // show only transactions for last 30 days
        'filter_period' => 'week', // show only transactions for this week
    ];
    $chart2 = new LaravelChart($chart_options);

    return view('Dashboard.grafico', compact('chart1','chart2'));
    

}
}
