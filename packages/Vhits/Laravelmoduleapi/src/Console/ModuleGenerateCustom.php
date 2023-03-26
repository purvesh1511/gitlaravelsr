<?php

namespace Vhits\Laravelmoduleapi\Console;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Facades\File;


class ModuleGenerateCustom extends Command
{
    
    protected $files;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make {name}';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Create a new module class';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createModel();
        $this->createService();
        $this->createRepository();
        $this->createMigration();
        $this->createController();
        return 0;
    }

    /**
     * Create a Controller file for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $model = Str::studly(class_basename($this->argument('name')));
        $this->call('module:controller', [
            'name' => "{$model}",
        ]);
    }

    /**
     * Create a model file for the model.
     *
     * @return void
     */
    protected function createModel()
    {
        $model = Str::studly(class_basename($this->argument('name')));
        $this->call('module:model', [
            'name' => "{$model}",
        ]);
    }


    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));
        $this->call('module:migration', [
            'name' => "{$table}"
        ]);
    }

    /**
     * Create a service file for the model.
     *
     * @return void
     */
    protected function createService()
    {
        $service = Str::studly(class_basename($this->argument('name')));
        $this->call('module:service', [
            'name' => "{$service}",
        ]);
    }

    /**
     * Create a repository file for the model.
     *
     * @return void
     */
    protected function createRepository()
    {
        $repository = Str::studly(class_basename($this->argument('name')));
        $this->call('module:repository', [
            'name' => "{$repository}",
        ]);
    }

    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }



}
