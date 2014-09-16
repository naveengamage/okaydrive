<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessFiles extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'check:files';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

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
	public function fire()
	{

		$media_id = $this->option('media');
		
		$media_files = MediaLike::where('media_id','=', $media_id )->get();
		

		
		$download_folder = '/home/mfs/Downloads/transmission/completed/'. $media_id;
		
		foreach($media_files as $file){
		
			//$new_file = new MediaAdd;
			//$new_file->path = $download_folder;
			//$new_file->media_id = $media_id;
			//$new_file->name = str_replace("#", "", $bs . $file[0]);
			//$new_file->size = $file[3];
			
			
			$filepath = $download_folder.'/'. $this->mb_escapeshellarg($file->path);
			
			$new_name = str_replace("#", "", $filepath);
			
			if($filepath != $new_name){
			
				$old_folder = $download_folder.'/'. $file->path;
				$new_folder = $download_folder.'/'. str_replace("#", "", $file->path );
				shell_exec("mv $old_folder $new_folder");
				shell_exec("mv $filepath $new_name");
				$filepath = $new_name;
				
			}
			
			if($this->getFast($filepath)){
				$out_meta = shell_exec("qtfaststart $filepath 2>&1");
				sleep(5);
			}
			
			$fi_size = shell_exec("stat -c '%s' $filepath 2>&1");
			$file->size_or = (int)$fi_size;
			
			if(file_exists($download_folder.'/'.  str_replace("#", "", $file->path ))){
				if((int)$fi_size > 15032385536 ){
					$file->cksum = '-';
				}else{
					$cksum = shell_exec("python3.2 /var/www/data/crc32sum.py $filepath 2>&1");
					$file->cksum = $cksum;
				}
				$file->save();
			}
		}
		//$transmission = new Vohof\Transmission($config);
		//$remove = $transmission->remove($hash);
	}
	
	protected function getOptions()
    {
        return array(
            array('hash', null, InputOption::VALUE_REQUIRED, 'hash of the torrent'),array('media', null, InputOption::VALUE_REQUIRED, 'hash of the torrent')
        );
    }
	
	public function getFast($path){
		$path_info = pathinfo($path);
		if(isset($path_info['extension'])){
			$ext = $path_info['extension'];
		}else{
			$ext = "";
		}
		$extension = strtolower($ext);
		$fast = false;
		switch ($extension) {
				case "mov":
				case "mp4":
						$fast = true;
						break;																					
				default:
						$fast = false;
						break;
		}
		return $fast;
	}

	public function mb_escapeshellarg($arg)
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return '"' . str_replace(array('"', '%'), array('', ''), $arg) . '"';
		} else {
			return "'" . str_replace("'", "'\\''", $arg) . "'";
		}
	}


}
