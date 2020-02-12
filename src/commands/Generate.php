<?php namespace ersaazis\cb\commands;

use App;
use Cache;
use ersaazis\cb\helpers\ModuleGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Generate extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'crud:make {--module=ALL : The table that want to generate the module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CRUD Make a Module';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info($this->description);
        $option = $this->option("module");
        if($option == "ALL") {
            $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
            foreach($tables as $table) {
                $this->generate($table);
            }
        }else{
            $this->generate($option);
        }
    }

    private function generate($table) {
        (new ModuleGenerator($table))->make();
        $this->info("New module from table ".$table." has been created!");
    }
}
