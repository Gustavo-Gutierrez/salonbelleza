<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Producto;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@yolandastudio.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'codigo_empleado' => 'EMP-000001',
        ]);
        
        // Usuario empleado
        $empleado = User::create([
            'name' => 'Yolanda Gutiérrez',
            'email' => 'yolanda@yolandastudio.com',
            'password' => Hash::make('empleado123'),
            'role' => 'empleado',
            'especialidad' => 'Coloración y Cortes',
            'horario' => 'Lunes a Viernes 9:00-18:00',
        ]);
        $empleado->generarCodigoEmpleado();
        
        // Clientes de ejemplo
        $clientes = [
            [
                'name' => 'Ana Martínez',
                'email' => 'ana@ejemplo.com',
                'phone' => '5551234567',
                'ci' => '12345678',
                'address' => 'Calle Principal 123',
                'birth_date' => '1990-05-15',
            ],
            [
                'name' => 'María Rodríguez',
                'email' => 'maria@ejemplo.com',
                'phone' => '5557654321',
                'ci' => '87654321',
                'address' => 'Avenida Central 456',
                'birth_date' => '1985-08-22',
            ],
        ];
        
        foreach ($clientes as $clienteData) {
            $cliente = User::create([
                'name' => $clienteData['name'],
                'email' => $clienteData['email'],
                'phone' => $clienteData['phone'],
                'ci' => $clienteData['ci'],
                'address' => $clienteData['address'],
                'birth_date' => $clienteData['birth_date'],
                'role' => 'cliente',
                'password' => Hash::make('cliente123'),
            ]);
            $cliente->generarCodigoCliente();
        }
        
        // Servicios
        $servicios = [
            [
                'nombre' => 'Corte de Cabello',
                'descripcion' => 'Corte profesional con lavado y secado',
                'precio' => 350,
                'duracion_minutos' => 60,
            ],
            [
                'nombre' => 'Coloración Completa',
                'descripcion' => 'Coloración profesional con productos premium',
                'precio' => 1200,
                'duracion_minutos' => 120,
            ],
            [
                'nombre' => 'Manicure Básico',
                'descripcion' => 'Limpieza, corte y esmaltado de uñas',
                'precio' => 250,
                'duracion_minutos' => 45,
            ],
            [
                'nombre' => 'Pedicure Spa',
                'descripcion' => 'Tratamiento completo de pies con exfoliación',
                'precio' => 400,
                'duracion_minutos' => 60,
            ],
            [
                'nombre' => 'Maquillaje Profesional',
                'descripcion' => 'Maquillaje para eventos especiales',
                'precio' => 600,
                'duracion_minutos' => 90,
            ],
        ];
        
        foreach ($servicios as $servicioData) {
            Servicio::create($servicioData);
        }
        
        // Productos (Inventario)
        $productos = [
            [
                'nombre' => 'Shampoo Profesional',
                'descripcion' => 'Shampoo para cabello teñido',
                'categoria' => 'Cuidado Capilar',
                'stock_minimo' => 10,
                'stock_actual' => 25,
                'precio_compra' => 85.50,
                'precio_venta' => 150.00,
                'unidad_medida' => 'botella',
            ],
            [
                'nombre' => 'Tinte Wella',
                'descripcion' => 'Tinte profesional color 5N',
                'categoria' => 'Coloración',
                'stock_minimo' => 15,
                'stock_actual' => 30,
                'precio_compra' => 120.00,
                'precio_venta' => 250.00,
                'unidad_medida' => 'unidad',
            ],
            [
                'nombre' => 'Esmalte Semi-Permanente',
                'descripcion' => 'Esmalte gel de larga duración',
                'categoria' => 'Manicure',
                'stock_minimo' => 20,
                'stock_actual' => 8, // Bajo stock
                'precio_compra' => 45.00,
                'precio_venta' => 90.00,
                'unidad_medida' => 'unidad',
            ],
            [
                'nombre' => 'Crema Hidratante',
                'descripcion' => 'Crema para manos y cuerpo',
                'categoria' => 'Cuidado Personal',
                'stock_minimo' => 5,
                'stock_actual' => 12,
                'precio_compra' => 65.00,
                'precio_venta' => 120.00,
                'unidad_medida' => 'frasco',
            ],
        ];
        
        foreach ($productos as $productoData) {
            Producto::create($productoData);
        }
        
        $this->command->info('✅ Datos iniciales creados exitosamente!');
        $this->command->info('👤 Usuario admin: admin@yolandastudio.com / admin123');
        $this->command->info('👩‍💼 Usuario empleado: yolanda@yolandastudio.com / empleado123');
        $this->command->info('👥 Usuarios cliente: cliente123');
    }
}