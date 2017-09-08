<?php

namespace App\Console\Commands;

use App\Container;
use Illuminate\Console\Command;

class registerWithoutSignal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'withoutSign:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica Dispositivos sin señal';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*          SELECT null as 'id', c.id as 'container_id', 3 as 'state_type',now() as 'created_at',now() as 'updated_at'
            FROM containers  c 
            LEFT JOIN container_states cs ON c.id = cs.container_id AND cs.created_at = NOW()
            WHERE cs.id is null
            ORDER BY c.id*/
    }
}
