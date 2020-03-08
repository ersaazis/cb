<?php

namespace ersaazis\cb\commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Refresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:refresh';

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
        Artisan::call('clear-compiled');
        Artisan::call('config:cache');
        Artisan::call('view:cache');
        Artisan::call('route:clear');
        Artisan::call('event:cache');
        Artisan::call('auth:clear-resets');
    }
}
