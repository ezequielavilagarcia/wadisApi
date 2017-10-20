<?php

use App\Alert;
use App\AlertType;
use App\Container;
use App\ContainerState;
use App\FrecuencyType;
use App\Http\Controllers\ContainerState\AlertController;
use App\Http\Controllers\ContainerState\FullnessController;
use App\Http\Controllers\ContainerTask\ContainerTaskController;
use App\Location;
use App\Task;
use App\TaskType;
use App\User;
use App\UserProfile;
use App\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

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
        User::truncate();

        $CantidadContainers = 10;
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
                    ],
                    [
                        'task_id' => 6,
                        'tasktype' => 'Visita de Mantenimiento',
                        'description' => 'Reparar rueda delantera derecha'
                    ],
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

        $zone = new Zone();
        $zone->name = "UNLAM";
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

/* CEANDO USERS */
        $user = new User();
        $user->email = "recolector@unlam.com";
        $user->password = "1234";
        $user->username = "Recolector";

        $user->name= "Recolector";
        $user->last_name= "Unlam";
        $user->identification = "12345678";
        $user->root = 0;
        $user->user_profile_id = 1;

        $user->zone_id = 2;
        $user->save();

        $user = new User();
        $user->email = "mantenimiento@unlam.com";
        $user->password = "1234";
        $user->username = "Mantenimiento";
        $user->name= "Mantenimiento";
        $user->last_name= "Unlam";
        $user->identification = "12345678";
        $user->root = 0;
        $user->user_profile_id = 3;

        $user->zone_id = 2;
        $user->save();

        $user = new User();
        $user->email = "urgencias@unlam.com";
        $user->password = "1234";
        $user->username = "Urgencias";
                $user->name= "Urgencias";
        $user->last_name= "Unlam";
        $user->identification = "12345678";
        $user->root = 0;
        $user->user_profile_id = 4;

        $user->zone_id = 2;
        $user->save();

        $user = new User();
        $user->email = "limpieza@unlam.com";
        $user->password = "1234";
        $user->username = "Limpieza";
                $user->name= "Limpieza";
        $user->last_name= "Unlam";
        $user->identification = "12345678";
        $user->root = 0;
        $user->user_profile_id = 2;

        $user->zone_id = 2;
        $user->save();

        $containers = Container::all();
        $i = 0;
        $locations = [
            [
                'geo_x' => '-34.670405',
                'geo_y' => '-58.562343',
                'address' => 'Florencio Varela 1903-1999, B1754JEC San Justo, Buenos Aires, Argentina'
            ],
                        [
                'geo_x' => '-34.671816',
                'geo_y' => '-58.563858',
                'address' => 'Florencio Varela 2159, B1754JEG San Justo, Buenos Aires, Argentina'

            ],
            [
                'geo_x' => '-34.671868',
                'geo_y' => '-58.560945',
                'address' => 'Ombú 2748, B1754BCD San Justo, Buenos Aires, Argentina'
            ],
                        [
                'geo_x' => '-34.671992',
                'geo_y' => '-58.559947',
                'address' => 'Av. Pres. Dr. Arturo Umberto Illia 1924, San Justo, Buenos Aires, Argentina'
            ],
                        [
                'geo_x' => '-34.671242',
                'geo_y' => '-58.560172',
                'address' => 'Zapiola 2725-2749, B1754BFC San Justo, Buenos Aires, Argentina'
            ],
                        [
                'geo_x' => '-34.670430',
                'geo_y' => '-58.561299',
                'address' => 'Zapiola 2661, B1754BFA San Justo, Buenos Aires, Argentina'
            ],
            [
                'geo_x' => '-34.666491',
                'geo_y' => '-58.569888'
            ],
            [
                'geo_x' => '-34.666364',
                'geo_y' => '-58.571109'
            ],
            [
                'geo_x' => '-34.667220',
                'geo_y' => '-58.570712'
            ],
            [
                'geo_x' => '-34.668526',
                'geo_y' => '-58.569038'
            ]
        ];
/*CONTAINERS RECOLECTAR */
        foreach ($containers as $container) {
            $containerState = new ContainerState();
            $containerState->state_type = ContainerState::ESTADO_ALERTA;
            $containerState->container_id = $container->id;
            $containerState->save();
            $alert = new Alert();
            $alert->container_state_id = $containerState->id;
            $alert->alert_type_id = AlertType::NUEVO; //1 Indica Nuevo
            $alert->save();

            $containerState = new ContainerState();

            $containerState->state_type = ContainerState::ESTADO_LOCACION;
            $containerState->container_id = $container->id;
            $containerState->save();

            $state = new Location();
            $state->container_state_id = $containerState->id;
            $state->geo_x = $locations[$i]["geo_x"];
            $state->geo_y = $locations[$i]["geo_y"];
            if(isset($locations[$i]["address"]))
                $state->address = $locations[$i]["address"];
            $state->save();
            $request = new Request();
            $request["mac"] = $container->mac;
            if($i <6){
                $request["value"] = 80;
                $controller = new FullnessController();
            }else{
                if($i < 9){
                    $request["date_execution"] = date('Y-m-d');
                    $request["user_id"] = 2; //Usuario de mantenimiento
                    $request["container_id"] = $container->id;
                    if($i %2){
                        $request["task_id"] = 3;
                    }else{
                        $request["task_id"] = 6;
                    }
                    $controller = new ContainerTaskController();
                }else{
                    $request["mac"] = $container->mac;
                    $request["alert_type"] = 2;
                    $controller = new AlertController();
                }
            }
            
            $controller->store($request);
            
            $i++;
        }

        /***************************************/
        // $this->call(UsersTableSeeder::class);
    }
}
