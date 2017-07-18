<?php

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

    	$CantidadContainers = 2;

    	factory(Container::class,$CantidadContainers)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
