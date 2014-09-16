<?php
 ini_set('max_execution_time', 300); 
 set_time_limit(0);
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class StartAll extends Command {
 
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'user:start';
 
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

		
		$media = Media::where('state', '!=', 'done')->where('state', '!=', 'failed')->where('state', '!=', 'max_pause')->where('state', '!=', 'process')->get();
				
		foreach($media as $update){

					if($update->state === "put_pause"){
						echo "start"; 
						
						$url = 'http://77.247.178.109/rt/plugins/httprpc/action.php';
						$myvars = 'mode=start&hash='. $update->hash;

						$ch = curl_init( $url );
						curl_setopt( $ch, CURLOPT_POST, 1);
						curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
						curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
						curl_setopt( $ch, CURLOPT_HEADER, 0);
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

						$response = curl_exec( $ch );

						$torrent_start = json_decode($response, true);

						
							$update->state = "put_start";
							$update->save();			
						
					}

		}
	}
	
}