<?php
 
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessConvert extends Command {
 
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'sys:processconvert';
 
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
		$media_convert = MediaConvert::where('state', '!=', 'done')->get();

		foreach($media_convert as $convert){
			$response = $this->getConvertInfo($convert->file_id,'-'.$convert->preset);
			$info_decode_all = json_decode($response, true);
			if($info_decode_all["data"] == 100){
				$file = MediaLike::where('id','=',$convert->file_id)->first();
				if($convert->preset == "400"){
						$re = $this->getConvertProcess($convert->media_id .'/'. $file->path .'-400.mp4');
				}elseif($convert->preset == "700"){
						$re = $this->getConvertProcess($convert->media_id .'/'. $file->path .'-700.mp4');
				}
				$convert->state = "done";
				
				$file->type = "conv";
				if($convert->preset == "400"){
					$file->preset_four = true;
				}elseif($convert->preset == "700"){
					$file->preset_seven = true;
				}
				$file->save();
			}elseif($info_decode_all["data"] < 1){
				$convert->state = "process";
			}
			$convert->percent = $info_decode_all["data"];
			$convert->save();
		}						
    }
	
	public function getConvertInfo($file_id,$preset){
				$fields = array(
								'id' => urlencode($file_id),
								'p'=>urlencode($preset)
						);
		//url-ify the data for the POST
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');


		$process = curl_init();
		$url='http://77.247.178.109/datasrpc/convert/status';

		curl_setopt($process,CURLOPT_URL, $url);
		curl_setopt($process, CURLOPT_POST, count($fields));
		curl_setopt($process, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
	
	public function getConvertProcess($path){
				$fields = array(
								'path' => urlencode($path)
						);
		//url-ify the data for the POST
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');


		$process = curl_init();
		$url='http://77.247.178.109/datasrpc/convert/process';

		curl_setopt($process,CURLOPT_URL, $url);
		curl_setopt($process, CURLOPT_POST, count($fields));
		curl_setopt($process, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}

 
}