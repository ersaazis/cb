<?php namespace ersaazis\cb\commands;

use App;
use Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class DeveloperCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'crud:developer {--username=AUTO : Create developer username} {--password=AUTO : To custom the password of developer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CRUD Generate Developer User';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new DeveloperCommandService($this))->create();
    }
}
