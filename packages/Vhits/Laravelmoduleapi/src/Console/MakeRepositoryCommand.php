<?php

namespace Vhits\Laravelmoduleapi\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;

class MakeRepositoryCommand extends Command
{

    /**
     * Filesystem instance
     * @var Filesystem
     */
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
    protected $signature = 'module:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make repository custom';

    

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }

        return 0;
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

    /**
     * Return the Singular Capitalize Name
     * @param $name
     * @return string
     */
    public function getLowerClassName($name)
    {
        return strtolower(Pluralizer::singular($name));
    }
    

    /**
     * Return the stub file path
     * @return string
     *
     */
    public function getStubPath()
    {
        return __DIR__ . '/stubs/repository.stub';
    }

    /**
    **
    * Map the stub variables present in stub to its value
    *
    * @return array
    *
    */
    public function getStubVariables()
    {
        return [
            '{{ namespace }}'         => 'App\\Repositories',
            '{{ rootNamespace }}'  => 'App\\',
            '{{ model }}'  => $this->getSingularClassName($this->argument('name')),
            '{{ modelLower }}'  => $this->getLowerClassName($this->argument('name')),
            '{{ class }}'        => $this->getSingularClassName($this->argument('name')).'Repository',
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     *
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }


    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub , $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace($search,$replace, $contents);
        }

        return $contents;

    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFilePath()
    {
        return base_path('App\\Repositories') .'\\' .$this->getSingularClassName($this->argument('name')) . 'Repositary.php';
    }


    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

}
