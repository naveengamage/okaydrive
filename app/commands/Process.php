<?php
 mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');
mb_language('uni');
mb_regex_encoding('UTF-8');
ob_start('mb_output_handler');

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
		include_once "/opt/nginx/html/laravel/vendor/SmartImage.class.php";	
		try{

			$hash = $this->option('hash');
			$media = Media::where('hash', '=', $hash)->first();
			
				if($media->files()->count() == 0){
					echo "files";
					
							$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
							$myvars = 'mode=info&hash=' . $hash;

							$ch = curl_init( $url );
							$username = 'datalinktunnel';
							$password = 'T52UamGTrmCCGn4fJgyq';
							curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
							curl_setopt( $ch, CURLOPT_POST, 1);
							curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
							curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt( $ch, CURLOPT_HEADER, 0);
							curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

							$response = curl_exec( $ch );

							$torrent_info = json_decode($response, true);
							
						$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
						$myvars = 'mode=fls&hash=' . $hash;

						$ch = curl_init( $url );
						$username = 'datalinktunnel';
						$password = 'T52UamGTrmCCGn4fJgyq';
						curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
						curl_setopt( $ch, CURLOPT_POST, 1);
						curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
						curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
						curl_setopt( $ch, CURLOPT_HEADER, 0);
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

						$response = curl_exec( $ch );

						$torrent_files = json_decode($response, true);
							
						$files = $torrent_files;

						
						if(!empty($files)){
							echo "not empty";
							echo count($files);
									$ignore_first_folder = true;
									$id = 1;
									$paths = array();
									foreach($files as $file){	
											if($torrent_info[3] != 0){
												$fd = parse_url(basename ( str_replace("#", "", $torrent_info[2] ) ) . '/' . str_replace("#", "", $file[0]));
											}else{
												$fd = parse_url(str_replace("#", "", $file[0]));
											}	
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
																if($torrent_info[3] != 0){
																	$new_file->path = basename ( str_replace("#", "", $torrent_info[2] ) ) . '/' . str_replace("#", "", $file[0] );
																}else{
																	$new_file->path = str_replace("#", "", $file[0] );
																}
																$new_file->name = $path_parts["basename"];
																$new_file->type = $this->getExt($new_file->path);
																$new_file->in = 0;
																$new_file->size = $file[3];
																$new_file->media_id = $media->id;
																//$like->user_id = Auth::user()->id;
																$new_file->save();	
																$ignore_first_folder = false;
													}else{
														if(isset($dirs[$i-1]) && $dirs[$i-1] != '.'){
																$full_path = $this->fullpath($dirs,$i-1);
																//echo $path_parts["basename"].' '.$paths[$full_path]["id"];
																$new_file = new MediaLike;
																if($torrent_info[3] != 0){
																	$new_file->path = basename ( str_replace("#", "", $torrent_info[2] ) ) . '/' . str_replace("#", "", $file[0]);
																}else{
																	$new_file->path = str_replace("#", "", $file[0] );
																}
																$new_file->type = $this->getExt($new_file->path);
																$new_file->name = $path_parts["basename"];
																$new_file->in = $paths[$full_path]["id"];
																$new_file->size = $file[3];
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
					
				}
			
			$files_local = $media->getFiles();

			if(!empty($files_local)){
				echo "pro";

					$media_id = $media->id;
	
				shell_exec('nohup php /opt/nginx/html/artisan check:files --media='.$media_id.' > /dev/null 2>&1 & echo $!');
	
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
				$fast = false;
				foreach($files_local as $file){
					if($file->type == "vid" || $file->type == "vid-conv"){
						if($file->type == "vid"){
							$fast = $this->getFast($file->path);
						}
						if($file->id == $max_file_id){
							$info = $this->makeThumbs($media->id,$file->id,$media->id.'/'.$file->path,$fast, 13);
						}else{
							$info = $this->makeThumbs($media->id,$file->id,$media->id.'/'.$file->path,$fast, 1);
						}
						if(!empty($info) && $info != null){
							$info_decode_all = json_decode($info, true);
							$info_decode = $info_decode_all["data"];
							$new_fileinfo = new FileInfo;
							$new_fileinfo->file_id = $file->id;
							$new_fileinfo->media_id = $media->id;
							$new_fileinfo->video_duration = $info_decode["video_duration"];
							$new_fileinfo->video_codec_name = $info_decode["video_codec_name"];
							$new_fileinfo->video_width = $info_decode["video_width"];
							$new_fileinfo->video_height = $info_decode["video_height"];
							$new_fileinfo->video_height = $info_decode["video_height"];
							$new_fileinfo->video_ratio = $info_decode["video_ratio"];
							$new_fileinfo->video_fps = $info_decode["video_fps"];
							$new_fileinfo->audio_codec_name = $info_decode["audio_codec_name"];
							$new_fileinfo->audio_bit_rate = $info_decode["audio_bit_rate"];
							$new_fileinfo->save();
						}
					}elseif($file->type == "img"){
						//$this->setimages($file->name ,$media->id . '/'. $file->path);
						
									
						$file_path_thumb = '/opt/nginx/html/public/cache/thumbs/' . $file->id . '.jpg';
												
	
						$full_path = '/home/mfs/Downloads/transmission/completed/'.$media->id . '/'. $file->path;
						

		
						if (file_exists($file_path_thumb)){
							unlink($file_path_thumb);
						}					

						try {
									
							$img = new SmartImage($full_path);
							$img -> resize(130, 130, true); 
							$img -> saveImage($file_path_thumb, 85); 
						} catch (Exception $e) {
							
							$full_path = '/home/mfs/Downloads/transmission/image.png';
							$img = new SmartImage($full_path); 
							$img -> saveImage($file_path_thumb, 85); 
						}
		
						//file_put_contents($file_path_thumb, $file_img_tmp);
		
					}
				}
				
				sleep(10);
					$save_base_thumbs = "/opt/nginx/html/public/snaps/thumbs/";
					$save_base_big = "/opt/nginx/html/public/snaps/big/";
				foreach($files_local as $file){
					if($file->type == "vid" || $file->type == "vid-conv"){
											
								$snap_big_path = $save_base_big . $media->id;
								if (!file_exists($snap_big_path)) {
									mkdir($snap_big_path, 0775, true);
								}
								$snap_big_path_full = $snap_big_path .'/' . $file->id ;
								if (!file_exists($snap_big_path_full)) {
									mkdir($snap_big_path_full, 0775, true);
								}
								
								$snap_thumb_path = $save_base_thumbs . $media->id;
								if (!file_exists($snap_thumb_path)) {
									mkdir($snap_thumb_path, 0775, true);
								}
								$snap_thumb_path_full = $snap_thumb_path .'/' . $file->id ;
								if (!file_exists($snap_thumb_path_full)) {
									mkdir($snap_thumb_path_full, 0775, true);
								}
								
								if($media->max_file_id != $file->id){
									$file_get = '/opt/nginx/html/laravel/public/snaps/'.$media->id.'/'.$file->id.'/1.jpg';
									$snap_big_path_full_file = $snap_big_path_full .'/1.jpg';
									$snap_thumb_path_full_file = $snap_thumb_path_full .'/1.jpg';
									if (file_exists($snap_big_path_full_file)) { } 
									else {
										try {
											$file_img = file_get_contents($file_get);
											file_put_contents($snap_big_path_full_file, $file_img);
											
											$img = new SmartImage($snap_big_path_full_file);
											$img -> resize(130, 130, true); 
											$img -> saveImage($snap_thumb_path_full_file, 85); 
										} catch (Exception $e) {

											
											$img = new SmartImage('/opt/nginx/html/app/commands/1.png');
											$img -> resize(130, 130, true); 
											$img -> saveImage($snap_thumb_path_full_file, 85);
										}	
										
									}
									
								}elseif($media->max_file_id == $file->id){
									$frames= 13;
									for ($k = 1 ; $k < $frames; $k++){ 
										
										$snap_big_path_full_file = $snap_big_path_full .'/'.$k.'.jpg';
										$snap_thumb_path_full_file = $snap_thumb_path_full .'/'.$k.'.jpg';
										$file_get = '/opt/nginx/html/laravel/public/snaps/'.$media->id.'/'.$file->id.'/'.$k.'.jpg';
										if (file_exists($snap_big_path_full_file)) { } 
										else {
											try {
												$file_img = file_get_contents($file_get);
												file_put_contents($snap_big_path_full_file, $file_img);

												$img = new SmartImage($snap_big_path_full_file);
												$img -> resize(130, 130, true); 
												$img -> saveImage($snap_thumb_path_full_file, 85); 	
											} catch (Exception $e) {

												$img = new SmartImage('/opt/nginx/html/app/commands/1.png');
												$img -> resize(130, 130, true); 
												$img -> saveImage($snap_thumb_path_full_file, 85); 	
											}
										}
									}
								}
						
					}
				}
				
			while(MediaLike::where('media_id','=',$media->id)->where('cksum','=','')->count() != 0){
				sleep(1);
			}
			
				$media["state"] = 'done';
				$media->save();
				
						$media_users = $media->usersMedia();
						foreach($media_users as $media_user){
						try {
									$user_this = User::where('id','=',$media_user->user_id)->first();
									if(isset($user_this->email) && $user_this->ea){
										require_once('/opt/nginx/html/vendor/php-aws-ses-master/src/ses.php');

										$ses = new SimpleEmailService('AKIAJNUKDR6WQV2PJLEA', 'Q0p4SCDdHK5QddvUICYj/xMfoAbcxa7buuRYTJyY');

										$m = new SimpleEmailServiceMessage();
										$m->addTo($user_this->email);
										$m->setFrom('DATAS Support <support@okaydrive.com>');
										$m->setSubject('Your files are ready to download.');
										$html = '<table class="yiv7962433916container" align="center" cellspacing="0" border="0" cellpadding="0" width="580" bgcolor="#FFFFFF" style="width:580px;background-color:#FFF;border-top:1px solid #DDD;border-bottom:1px solid #DDD;" id="yui_3_13_0_1_1397466773730_2821">
												<tbody id="yui_3_13_0_1_1397466773730_2820"><tr id="yui_3_13_0_1_1397466773730_2819">
													<td class="yiv7962433916title" style="padding-top:34px;padding-left:39px;padding-right:39px;text-align:left;border-left-width:1px;border-left-style:solid;border-left-color:#DDD;border-right-width:1px;border-right-style:solid;border-right-color:#DDD;" id="yui_3_13_0_1_1397466773730_2818">
														<h2 style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;font-size:30px;color:#262626;font-weight:normal;margin-top:0;margin-bottom:13px;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;letter-spacing:0;" id="yui_3_13_0_1_1397466773730_2817">Your file is ready!</h2>
														<h3 style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;font-size:16px;color:#3e434a;font-weight:normal;margin-top:0;margin-bottom:19px;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;line-height:25px;" id="yui_3_13_0_1_1397466773730_2824">The file <b>'. $media->title .'</b> has been downloaded and ready to Play, Download, Convert or Stream.</h3>
													</td>
												</tr>
												<tr id="yui_3_13_0_1_1397466773730_2831">
													<td class="yiv7962433916cta" align="left" style="background-color:#F1FAFE;font-size:14px;color:#1f1f1f;border-top-width:1px;border-top-style:solid;border-top-color:#DAE3EA;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#DAE3EA;border-left-width:1px;border-left-style:solid;border-left-color:#DDD;border-right-width:1px;border-right-style:solid;border-right-color:#DDD;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:20px;padding-bottom:20px;padding-right:39px;padding-left:39px;text-align:left;" id="yui_3_13_0_1_1397466773730_2830">
														<table cellspacing="0" border="0" cellpadding="0" width="500" align="left">
															<tbody><tr>
																<td width="24"></td>
																<td class="yiv7962433916link" align="left" style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;padding-left:9px;font-size:14px;"><strong><a rel="nofollow" style="color:#2b6cb5;font-family:Arial;font-size:12px;" target="_blank" href="https://okaydrive.com/torrent/'.$media_user->uni_id .'">Click here to go to your file</a></strong></td>
															</tr>
														</tbody></table>
													</td>
												</tr>
												<tr id="yui_3_13_0_1_1397466773730_2827">
													<td class="yiv7962433916footer" style="color:#797c80;font-size:12px;border-left-width:1px;border-left-style:solid;border-left-color:#DDD;border-right-width:1px;border-right-style:solid;border-right-color:#DDD;padding-top:23px;padding-left:39px;padding-right:13px;padding-bottom:23px;text-align:left;" id="yui_3_13_0_1_1397466773730_2826">
														<p style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:13px;padding-right:0;padding-left:0;line-height:20px;" id="yui_3_13_0_1_1397466773730_2832">
															You can login with <a rel="nofollow" style="font-weight:bold;text-decoration:none;color:inherit;cursor:default;">' . $user_this->username .'</a> at <a rel="nofollow" target="_blank" href="https://okaydrive.com" id="yui_3_13_0_1_1397466773730_2833">https://okaydrive.com</a>
														</p>
														<p style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:13px;padding-right:0;padding-left:0;line-height:20px;" id="yui_3_13_0_1_1397466773730_2825">Want some help with using our site? Simply reply to this email or email us - support@okaydrive.com. Email alerts are enabled by default, you may disable email alerts in your account settings.</p>
													</td>
												</tr>
												<tr>
											</tr></tbody></table>';
										$m->setMessageFromString('',$html);
										$ses->sendEmail($m);
									}
							
							} catch (Exception $e) {

							}
							
						}

			}

		
		} catch (Exception $e) {
			file_put_contents('/home/mfs/l.log', $e);
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
	
	public function file_get_contents_utf8($fn) {
		 $content = file_get_contents($fn);
		  return mb_convert_encoding($content, 'UTF-8',
			  mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
	}
	
	public function makeThumbs($media_id,$file_id,$path,$fast,$count){
				$fields = array(
								'media_id' => urlencode($media_id),
								'file_id' => urlencode($file_id),
								'path' => urlencode($path),
								'fast' => urlencode($fast),
								'count' => urlencode($count)
						);
		//url-ify the data for the POST
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');


		$process = curl_init();
		$url='http://s01.okaydrive.com/datasrpc/thumbs';
		$username = 'datalinktunnel';
		$password = 'T52UamGTrmCCGn4fJgyq';
		curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
		curl_setopt($process,CURLOPT_URL, $url);
		curl_setopt($process, CURLOPT_POST, count($fields));
		curl_setopt($process, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}	
	
	public function setFiles($hash,$media_id){
				$fields = array(
								'hash' => urlencode($hash),
								'media_id' => urlencode($media_id)
						);
		//url-ify the data for the POST
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');


		$process = curl_init();
		$url='http://s01.okaydrive.com/datasrpc/process';
		$username = 'datalinktunnel';
		$password = 'T52UamGTrmCCGn4fJgyq';
		curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
		curl_setopt($process,CURLOPT_URL, $url);
		curl_setopt($process, CURLOPT_POST, count($fields));
		curl_setopt($process, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
	
	public function setimages($name,$path){
		
		$file_name = $name;
		
		$full_path = '/home/mfs/Downloads/transmission/completed/'.$path;
		
		$file_path_thumb = '/opt/nginx/html/laravel/public/snaps/' . $file_name;
		
		if (file_exists($file_path_thumb)){
			unlink($file_path_thumb);
		}					

		try {
					
			$img = new SmartImage($full_path);
			$img -> resize(130, 130, true); 
			$img -> saveImage($file_path_thumb, 85); 
		} catch (Exception $e) {
			
			$full_path = '/home/mfs/Downloads/transmission/image.png';
			$img = new SmartImage($full_path); 
			$img -> saveImage($file_path_thumb, 85); 
		}	
		
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
	
	public function getExt($path){
		$path_info = pathinfo($path);
		$type = '';
		
		if(isset($path_info['extension'])){
			$extension = strtolower($path_info['extension']);	
			switch ($extension) {
					case "3gp":
					case "mkv":
					case "avi":
					case "mpeg":
					case "mpg":
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
		}
		return $type;
	}
 
}