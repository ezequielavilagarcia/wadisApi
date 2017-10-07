<?php

use App\Alert;
use App\AlertType;
use App\Container;
use App\ContainerState;
use App\FrecuencyType;
use App\Task;
use App\TaskType;
use App\UserProfile;
use App\Zone;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Container::truncate();
        AlertType::truncate();
		Alert::truncate();

        $CantidadContainers = 2;
        $AlertTypes = 
        [
            [
                'id'=> AlertType::NUEVO, 
                'name' => 'Nuevo'
            ],
            [
                'id'=> AlertType::VOLCADO, 
                'name' => 'Volcado'
            ],
            [
                'id'=> AlertType::INCENDIO, 
                'name' => 'Gases Peligrosos'
            ],
            [
                'id'=> AlertType::SIN_SENIAL, 
                'name' => 'Sin Señal'
            ],
            [
                'id'=> AlertType::INCENDIO_APAGADO, 
                'name' => 'Sin Gases Peligrosos'
            ],
            [
                'id'=> AlertType::LEVANTADO, 
                'name' => 'Levantado'
            ]
        ]
        ;
        $frecuencyTypes = [
        'Diariamente',
        'Semanalmente',
        'Mensualmente',
        'Anualmente'
        ];        
        $userProfiles = [
            [
                'profile' => 'Recolector',
                'tasks' => [
                    [
                        'task_id' => Task::RECOLECCION,
                        'tasktype' => 'Recolectar',
                        'description' => 'Tarea de recolección de Residuos'
                    ]
                ]

            ],        
            [
                'profile' => 'Limpieza',
                'tasks' => [
                    [
                        'tasktype' => 'Limpiar',
                        'description' => 'Tarea de limpieza de contenedor'
                    ]
                ]

            ],            
            [
                'profile' => 'Mantenimiento',
                'tasks' => [
                    [
                        'tasktype' => 'Visita de Mantenimiento',
                        'description' => 'Tarea de Mantenimiento general'
                    ],
                    [
                        'task_id' => Task::VOLCADO,
                        'tasktype' => 'Levantar contenedor Volcado',
                        'description' => 'Levantar el contenedor Volcado'
                    ]
                ]
                
            ],           
            [
                'profile' => 'Urgencias',
                'tasks' => [
                    [
                        'task_id' => Task::INCENDIO,
                        'tasktype' => 'Apagar Incendio',
                        'description' => 'Apagar incendios'
                    ]
                ]

            ]
        ];
        $zone = new Zone();
        $zone->name = "Sin Zona";
        $zone->save();
        
    	factory(Container::class,$CantidadContainers)->create();
        
        /* Creando Alert Types*/

        foreach ($AlertTypes as $alert) {
            $alertType = new AlertType();
            $alertType->id = $alert['id'];
            $alertType->name = $alert['name'];
            $alertType->save();
        } 
        /* Creando Frecuency Types*/

        foreach ($frecuencyTypes as $frecuency) {
            $frecuencyType = new FrecuencyType();
            $frecuencyType->name = $frecuency;
            $frecuencyType->save();
        }  
        /* Creando User Profiles*/

        foreach ($userProfiles as $profile) {
            $userProfile = new UserProfile();
            $userProfile->name = $profile['profile'];
            $userProfile->save();
            foreach ($profile['tasks'] as $task) {
                $taskType = new TaskType();
                $taskType->name = $task['tasktype'];
                $taskType->description = $task['description'];
                $taskType->save();

                $taskDB = new Task();
                if(isset($task['task_id']))
                    $taskDB->id = $task['task_id'];
                $taskDB->user_profile_id = $userProfile->id;
                $taskDB->task_type_id = $taskType->id;
                $taskDB->save();
            }            

        }        
        $containers = Container::all();
        foreach ($containers as $container) {
            $containerState = new ContainerState();
            $containerState->state_type = ContainerState::ESTADO_ALERTA;
            $containerState->container_id = $container->id;
            $containerState->save();
            $alert = new Alert();
            $alert->container_state_id = $containerState->id;
            $alert->alert_type_id = AlertType::NUEVO; //1 Indica Nuevo
            $alert->save();
        }


        /***************************************/
        // $this->call(UsersTableSeeder::class);
    }
}
