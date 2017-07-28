<?php

use App\Alert;
use App\AlertType;
use App\Container;
use App\ContainerState;
use App\FrecuencyType;
use App\UserProfile;
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
        $AlertTypes = [
        'Nuevo',
        'Caido',
        'Fuego',
        'Sin Señal'
        ];
        $frecuencyTypes = [
        'Diariamente',
        'Semanalmente',
        'Mensualmente',
        'Anualmente'
        ];        
        $userProfiles = [
        'Recolector',
        'Limpieza',
        'Mantenimiento'
        ];
    	factory(Container::class,$CantidadContainers)->create();
        
        /* Creando Alert Types*/

        foreach ($AlertTypes as $alert) {
            $alertType = new AlertType();
            $alertType->name = $alert;
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
            $userProfile->name = $profile;
            $userProfile->save();
        }        
        $containers = Container::all();
        foreach ($containers as $container) {
            $containerState = new ContainerState();
            $containerState->state_type = ContainerState::ESTADO_ALERTA;
            $containerState->container_id = $container->id;
            $containerState->save();
            $alert = new Alert();
            $alert->container_state_id = $containerState->id;
            $alert->alert_type_id = 1; //1 Indica Nuevo
            $alert->save();
        }
        /***************************************/
        // $this->call(UsersTableSeeder::class);
    }
}
