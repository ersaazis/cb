<?php

namespace ersaazis\cb\commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Rebuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:rebuild';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'rebuild application';

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
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('crud:seed');
    }
}
