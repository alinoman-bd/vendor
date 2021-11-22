<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResourceSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resource:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        echo "geeting data form files";
        $addresses = collect(
            json_decode(
                file_get_contents(__DIR__. "./../../../database/Data/Address.json")
            )
        )->toArray();
        foreach ($addresses as  $address) {
            echo json_encode($address);
        }
    }
}
