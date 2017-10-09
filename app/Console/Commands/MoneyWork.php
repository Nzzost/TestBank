<?php

namespace App\Console\Commands;

use App\Client;
use App\Services\Finance;
use Illuminate\Console\Command;

class MoneyWork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'finance:money-work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command get commition percent from client every month';

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
        $finance = new Finance();
        $finance->takeParcent();

        return $this->info('Operations finished');
    }
}
