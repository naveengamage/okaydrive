<?php
 
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Test extends Command {
 
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'sys:test';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate a new user";
 
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {	
						include_once('/opt/nginx/html/public/process.php');
						$process = new Process('php /opt/nginx/html/artisan sys:process --hashk');
						
    }
 
}