<?php
namespace App\Console;

use Symfony\Component\Console\Application;

class Kernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Demo::class,
    ];

    public function run()
    {
        $application = new Application();

        foreach ($this->commands as $command) {
            $application->add(new $command());
        }
        
        $application->run();
    }
}
