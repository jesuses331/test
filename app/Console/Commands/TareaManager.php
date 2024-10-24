<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TareaManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tarea-manager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        while (true) {
            $this->info('Selecciona una opción:');
            $this->info('1. Añadir tarea');
            $this->info('2. Eliminar tarea');
            $this->info('3. Marcar tarea como completada');
            $this->info('4. Listar tareas pendientes');
            $this->info('5. Obtener tarea');
            $this->info('6. Salir');

            $option = $this->ask('Ingrese el número de opción:');

            switch ($option) {
                case '1':
                    try {
                        $descripcion = $this->ask('Ingrese el nombre de la tarea:');
                        Http::post('http://localhost:8000/api/tareas', ['descripcion' => $descripcion]);
                    } catch (\Throwable $e) {
                        $this->error('Error inesperado: ' . $e->getMessage());
                    }
                    break;
                case '2':
                    $id = $this->ask('Ingrese el ID de la tarea a eliminar:');
                    Http::delete('http://localhost:8000/api/tareas/' . $id);
                    break;
                case '3':
                    $id = $this->ask('Ingrese el ID de la tarea a marcar como completada:');
                    Http::put('http://localhost:8000/api/tareas/' . $id);
                    break;
                case '4':
                    $tareas = Http::get('http://localhost:8000/api/tareas');
                    if ($tareas->successful()) {
                        $datos = $tareas->json();
                        if (count($datos) > 0) {
                            foreach ($datos as $tareas) {
                                $this->info("ID: {$tareas['id']} - Tarea: {$tareas['descripcion']}");
                            }
                        } else {
                            $this->info('No hay tareas pendientes.');
                        }
                    } else {

                        $this->error('Error al obtener las tareas.');
                    }
                    break;
                case '5':
                    $this->info('Saliendo...');
                    exit;
                default:
                    $this->error('Opción inválida.');
            }
        }
    }
}
