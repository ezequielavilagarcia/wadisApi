<?php

use App\AlertType;
use App\Container;
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

        $CantidadContainers = 2;
        $AlertTypes = [
        'Nuevo',
        'Caido',
        'Fuego',
        'Sin Señal'
        ];
    	factory(Container::class,$CantidadContainers)->create();
        
        /* Creando Alert Types*/

        foreach ($AlertTypes as $alert) {
            $alertType = new AlertType();
            $alertType->name = $alert;
            $alertType->save();
            # code...
        }
        /***************************************/
        // $this->call(UsersTableSeeder::class);
    }
}
