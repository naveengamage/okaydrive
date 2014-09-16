<?php
 
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessIt extends Command {
 
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'sys:process';
 
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
		$config = array('host'=> 'http://77.247.178.109:9018','endpoint' => '/datasrpc/rpc','username' => 'datasrpc','password' => 'Q8EAxtApHzNmz6UKHBQX');
		
		$hash = $this->option('hash');
		$media = Media::where('hash', '=', $hash)->first();
		
		$transmission = new Vohof\Transmission($config);
		$getFiles = $transmission->get($media->hash, array('files'));
		
		$files = $getFiles["arguments"]["torrents"][0]["files"];
		
		if(!empty($files)){
					$media->files()->delete();
					$media->folders()->delete();
					
					$ignore_first_folder = true;
					$id = 1;
					$paths = array();
					foreach($files as $file){							
							$fd = parse_url($file["name"]);
							$path_parts = pathinfo($fd['path']);
							$dirs = explode("/", $path_parts['dirname']);
							
								for($i=0; $i <= count($dirs); $i++){ 	
									if(isset($dirs[$i]) && $dirs[$i] != '.'){
										$full_path = $this->fullpath($dirs,$i);
										if (array_key_exists( $full_path, $paths)) {
											
										}else{
											$paths[$full_path]["id"] = $id;
											$paths[$full_path]["name"] = $dirs[$i];
											$prev_path = $this->fullpath($dirs,$i-1);
											
											if(!isset($paths[$prev_path]["id"])){ $pv_p = 0; }else{ $pv_p = $paths[$prev_path]["id"]; }
												$new_folder = new MediaFlag;	
												$new_folder->name = $dirs[$i];
												$new_folder->folder_id = $id;
												$new_folder->in = $pv_p;
												$new_folder->media_id = $media->id;
												$new_folder->save();	
											$id++;
										}
									}elseif(isset($dirs[$i]) && $dirs[$i] == '.'){
												//echo $path_parts["basename"].' 0';
												$new_file = new MediaLike;
												$new_file->path = $file["name"];	
												$new_file->name = $path_parts["basename"];
												$new_file->type = $this->getExt($new_file->path);
												$new_file->in = 0;
												$new_file->size = $file["length"];
												$new_file->media_id = $media->id;
												//$like->user_id = Auth::user()->id;
												$new_file->save();	
												$ignore_first_folder = false;
									}else{
										if(isset($dirs[$i-1]) && $dirs[$i-1] != '.'){
												$full_path = $this->fullpath($dirs,$i-1);
												//echo $path_parts["basename"].' '.$paths[$full_path]["id"];
												$new_file = new MediaLike;
												$new_file->path = $file["name"];	
												$new_file->name = $path_parts["basename"];
												$new_file->type = $this->getExt($new_file->path);
												$new_file->in = $paths[$full_path]["id"];
												$new_file->size = $file["length"];
												$new_file->media_id = $media->id;
												//$like->user_id = Auth::user()->id;
												$new_file->save();														
										}
									}
								}								
					}
					$media["ignore_first"] = $ignore_first_folder;
					$media->save();
		}
		
		$files_local = $media->files();

		if(!empty($files_local)){
			$max_file_id = null;
			$max_file_size = 0;
			foreach($files_local as $file){
				if($file->type == "vid" || $file->type == "vid-conv"){
					if($file->size > $max_file_size){
						$max_file_size = $file->size;
						$max_file_id = $file->id;
					}				
				}
			}
			$media->max_file_id = $max_file_id;
			$media->save();
			foreach($files_local as $file){
				if($file->type == "vid" || $file->type == "vid-conv"){
					if($file->id == $max_file_id){
						echo $this->makeThumbs($media->id,$file->id,'/home/mfs/Downloads/transmission/completed/done/'.$media->id.'/'.$file->path, 1);
					}else{ 
						echo $this->makeThumbs($media->id,$file->id,'/home/mfs/Downloads/transmission/completed/done/'.$media->id.'/'.$file->path, 13);
					}
				}
			}
		}		
		
		
    }
	
	protected function getOptions()
    {
        return array(
            array('hash', null, InputOption::VALUE_REQUIRED, 'hash of the torrent')
        );
    }
	
	public function fullpath($path,$times){
		$full_path = '';
		for($i = 0; $i <= $times;$i++){
			$full_path .= $path[$i] . '/';
		}

		return $full_path;
	}
	
	public function makeThumbs($media_id,$file_id,$path,$count){
				$fields = array(
								'media_id' => urlencode($media_id),
								'file_id' => urlencode($file_id),
								'path' => urlencode($path),
								'count' => urlencode($count)
						);
		//url-ify the data for the POST
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');


		$process = curl_init();
		$url='http://77.247.178.109/datasrpc/thumbs';

		curl_setopt($process,CURLOPT_URL, $url);
		curl_setopt($process, CURLOPT_POST, count($fields));
		curl_setopt($process, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
	
	public function getExt($path){
		$path_info = pathinfo($path);
		$extension = strtolower($path_info['extension']);
		$type = '';
		switch ($extension) {
				case "3gp":
				case "mkv":
				case "avi":
				case "mpeg":
				case "mpg":
				case "wvm":
						$type = "vid-conv";
						break;	
				case "ogg":
				case "flv":
				case "mp4":
						$type = "vid";
						break;	
				case "jpg":
				case "jpeg":
				case "png":
				case "gif":
				case "bmp":
						$type = "img";
						break;																				
				default:
		}
		return $type;
	}
 
}