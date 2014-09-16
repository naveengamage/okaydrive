<?php
date_default_timezone_set('Pacific/Auckland');
 ini_set('max_execution_time', 300); 
 set_time_limit(0);
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckAll extends Command {
 
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'user:generate';
 
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
		$time_start = microtime(true); 
		
		$media = Media::where('state', '!=', 'done')->where('state', '!=', 'failed')->where('state', '!=', 'max_pause')->where('state', '!=', 'process')->where('state', '!=', 'fail_free')->where('state', '!=', 'delete')->get();
				
		foreach($media as $update){
		try {
					if($update->state === "put_pause"){
						echo "start"; 
						
						$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
						$myvars = 'mode=start&hash='. $update->hash;

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

						$torrent_start = json_decode($response, true);

						
							$update->state = "put_start";
							$update->save();			
						
					}

			
				$now = new DateTime();
				$now_stamp = $now->format('Y-m-d H:i:s');  
			
				$diff = strtotime($now_stamp) - strtotime($update->featured_at);
				$diff_in_minss = $diff/60;	
				 
				if($diff_in_minss > 60 && $update->cat == 1 && $update->featured_at != "0000-00-00 00:00:00"){
				
										$media_users = UserMedia::where('media_id','=',$update->id)->get();
										$del = true;
										foreach($media_users as $media_user){
											$user = User::where('id','=',$media_user->user_id)->first();
											if($user->category_id == 1){
											
											}else{
												$del = false;
												$update->cat = $user->category_id;
												$update->save();
											}
										}	
										if($del){
											$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
											$input_xml = '<methodCall><methodName>system.multicall</methodName><params><param><value><array><data><value><struct><member><name>methodName</name><value><string>d.set_custom5</string></value></member><member><name>params</name><value><array><data><value><string>'. $update->hash .'</string></value><value><string>1</string></value></data></array></value></member></struct></value><value><struct><member><name>methodName</name><value><string>d.delete_tied</string></value></member><member><name>params</name><value><array><data><value><string>'. $update->hash .'</string></value></data></array></value></member></struct></value><value><struct><member><name>methodName</name><value><string>d.erase</string></value></member><member><name>params</name><value><array><data><value><string>'. $update->hash .'</string></value></data></array></value></member></struct></value></data></array></value></param></params></methodCall>';

											$ch = curl_init( $url );
											$username = 'datalinktunnel';
											$password = 'T52UamGTrmCCGn4fJgyq';
											curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
											curl_setopt( $ch, CURLOPT_POST, 1);
											curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);
											curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
											curl_setopt( $ch, CURLOPT_HEADER, 0);
											curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,2); 
											curl_setopt($ch, CURLOPT_TIMEOUT, 4); //timeout in seconds
											curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

											$response = curl_exec( $ch );
											
											$report = new UserFlag;
											$report->type = 'check';
											$report->media_id = $update->id;
											$report->res = 'took more than an hour'.$response;
											$report->save();
												
											$update->state = 'fail_free';
											$update->save();
											
											$user_report = UserFlag::where('media_id','=',$update->id)->where('type','=','error')->first();
											if(!isset($user_report->id)){
												$report = new UserFlag;
												$report->type = 'error';
												$report->media_id = $update->id;
												$report->res = $response;
												$report->save();
											}
											
										}
				}else{
			
					$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
					$myvars = 'mode=list-get&hash='.$update->hash;

					$ch = curl_init( $url );
					$username = 'datalinktunnel';
					$password = 'T52UamGTrmCCGn4fJgyq';
					curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
					curl_setopt( $ch, CURLOPT_POST, 1);
					curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
					curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt( $ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,2); 
					curl_setopt($ch, CURLOPT_TIMEOUT, 4); //timeout in seconds
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

					$response = curl_exec( $ch );

					$tor = json_decode($response, true);
					
					
					if(count($tor != 0) && $tor != false){

						echo $tor[0];


						echo "files begin";
						if(($update->files()->count() == 0 && $update->file_try < 3 && $update->state == "downloading") || ($update->files()->count() == 0 && $update->file_try == 3 && $update->state == "downloading" && $this->percent($tor[9],$tor[6]) > 0)){
							echo "files";

							if($tor[3] != 0){
							
								if(strpos($update->title ,'.meta') !== false){
									echo "in";
								}else{
										if(!empty($tor[26])){
										
											$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
											$myvars = 'mode=fls&hash=' . $tor[0];

											$ch = curl_init( $url );
											$username = 'datalinktunnel';
											$password = 'T52UamGTrmCCGn4fJgyq';
											curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
											curl_setopt( $ch, CURLOPT_POST, 1);
											curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
											curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
											curl_setopt( $ch, CURLOPT_HEADER, 0);
											curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,3); 
											curl_setopt($ch, CURLOPT_TIMEOUT, 5); //timeout in seconds
											curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

											$response = curl_exec( $ch );

											$torrent_files = json_decode($response, true);
													
											
											$files = $torrent_files;
										
											if(!empty($files)){
														$ignore_first_folder = true;
														$id = 1;
														$paths = array();
														foreach($files as $file){
																if($file[0] != $tor[0].'.meta' && isset($file[0]) && !empty($file[0])){
																	if($tor[34] != 0){
																		$fd = parse_url(basename ( str_replace("#", "", $tor[26] ) ) . '/' . str_replace("#", "", $file[0] ));
																	}else{
																		$fd = parse_url( str_replace("#", "", $file[0] ) );
																	}	
																	if(isset($fd['path'])){
																		$path_parts = pathinfo($fd['path']);
																	}else{
																		$path_parts = pathinfo($file["name"]);
																	}
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
																					$new_folder->media_id = $update->id;
																					$new_folder->save();	
																				$id++;
																			}
																		}elseif(isset($dirs[$i]) && $dirs[$i] == '.'){
																					//echo $path_parts["basename"].' 0';
																					$new_file = new MediaLike;
																					if($tor[34] != 0){
																						$new_file->path = basename ( str_replace("#", "", $tor[26] ) ) . '/' . str_replace("#", "", $file[0] );
																					}else{
																						$new_file->path = str_replace("#", "", $file[0] );
																					}
																					$new_file->name = $path_parts["basename"];
																					$new_file->type = $this->getExt($new_file->path);
																					$new_file->in = 0;
																					$new_file->size = $file[3];
																					$new_file->media_id = $update->id;
																					//$like->user_id = Auth::user()->id;
																					$new_file->save();	
																					$ignore_first_folder = false;
																		}else{
																			if(isset($dirs[$i-1]) && $dirs[$i-1] != '.'){
																					$full_path = $this->fullpath($dirs,$i-1);
																					//echo $path_parts["basename"].' '.$paths[$full_path]["id"];
																					$new_file = new MediaLike;
																					if($tor[34] != 0){
																						$new_file->path = basename ( str_replace("#", "", $tor[26] ) ) . '/' . str_replace("#", "", $file[0] );
																					}else{
																						$new_file->path = $file[0];
																					}
																					$new_file->type = $this->getExt($new_file->path);
																					$new_file->name = $path_parts["basename"];
																					$new_file->in = $paths[$full_path]["id"];
																					$new_file->size = $file[3];
																					$new_file->media_id = $update->id;
																					//$like->user_id = Auth::user()->id;
																					$new_file->save();														
																			}
																		}
																	}	
																}
														}
														$update["ignore_first"] = $ignore_first_folder;
														$update->save();
											}
											
											$update->file_try = $update->file_try +1;
											$update->save();
										}
								}
							}
						}


						$info = $tor;

						
						echo "max check begin";
						
						$max_pause = false;
					if(strpos($update->title ,'.meta') !== false){
						echo "in";
					}else{
						if($tor[5] != $update->hash . '.meta' && $info[29] != 0 && $info[6] != null && $info[6] != 0 && !empty($info[6]) && $update->max_check == 0){
							$max_pause = true;
							$media_users = UserMedia::where('media_id','=',$update->id)->get();
							
							echo $info[6]. 'size';
							
							foreach($media_users as $media_user){
								$user = User::where('id','=',$media_user->user_id)->first();
								$user_cat = Category::where('id','=',$user->category_id)->first();
								
								if($info[6] > $user_cat->max_add){							
									$media_user->max_error = true;
									$media_user->save();							
								}else{
									$max_pause = false;
								}
							}				
							if($max_pause){ 						
								$update->state = "max_pause";
								$update->save();
								$info["status"] = 7;
																		
								$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
								$input_xml = '<methodCall><methodName>system.multicall</methodName><params><param><value><array><data><value><struct><member><name>methodName</name><value><string>d.set_custom5</string></value></member><member><name>params</name><value><array><data><value><string>'. $update->hash .'</string></value><value><string>1</string></value></data></array></value></member></struct></value><value><struct><member><name>methodName</name><value><string>d.delete_tied</string></value></member><member><name>params</name><value><array><data><value><string>'. $update->hash .'</string></value></data></array></value></member></struct></value><value><struct><member><name>methodName</name><value><string>d.erase</string></value></member><member><name>params</name><value><array><data><value><string>'. $update->hash .'</string></value></data></array></value></member></struct></value></data></array></value></param></params></methodCall>';

								$ch = curl_init( $url );
								$username = 'datalinktunnel';
								$password = 'T52UamGTrmCCGn4fJgyq';
								curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
								curl_setopt( $ch, CURLOPT_POST, 1);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);
								curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
								curl_setopt( $ch, CURLOPT_HEADER, 0);
								curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,2); 
								curl_setopt($ch, CURLOPT_TIMEOUT, 4); //timeout in seconds
								curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

								$response = curl_exec( $ch );	

											$report = new UserFlag;
											$report->type = 'check';
											$report->media_id = $update->id;
											$report->res = 'max pause'.$response;
											$report->save();
											
							}
							$update->max_check = 1;
							$update->save();
						}
					}
						
						
						echo "max check end";
						if($max_pause){
						
						}else{
						
							$state = 'stop';	
							
							if($info[1]!=0)
							{
								$state = "downloading";
								if(($info[4] == 0) || ($info[29]==0)){
									$state  = "paused";
								}
							}elseif($info[24]!=0){
								$state  = "hashing";
							}elseif($info[2]!=0){
								$state  = "checking";
							}
							
							if($info[9] >= $info[6]){
								$state = "done";
							}
							
							if($update->title != $info[5]){
								if($info[5] == ''){
									$info[5] = 'no name field';
								}
								$update->title = $info[5];
							}
							
										
							if($update->state == "put_start" && $state == 'stop'){
								$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
								$myvars = 'mode=start&hash=' . $tor[0];

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

								$torrent_start = json_decode($response, true);
								
								$update->state = "downloading";
								$update->status = 4;
								$update->save();
							}elseif($update->state == "downloading" && $state == 'stop'){
								$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
								$myvars = 'mode=start&hash=' . $tor[0];

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

								$torrent_start = json_decode($response, true);
							
							}elseif($update->state == "downloading" && $state == 'paused'){
								$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
								$myvars = 'mode=start&hash=' . $tor[0];

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

								$torrent_start = json_decode($response, true);
							
							}
							
								if($info[29] == 0 && $info[1] == 1 && $info[2] == 1){
									$state = 'hashing';
								}
								
								switch ($state)
								{
								case "hashing":			
										$update->state = "hashing";
										$update->save();
										break;
								case "checking":
										$update->state = "check";
										$update->status = 2;
										$update->save();
										break;
								case "paused":

								case "downloading":
										$update->state = "downloading";
										$update->status = 4;
										$update->save();
										break;
								case "done":
					
									if($tor[5] == $update->hash . '.meta' || $update->title == $update->hash . '.meta'){
										$report = new UserFlag;
										$report->media_id = $update->id;
										$report->save();
									}else{
										$loc = '/home/mfs/Downloads/transmission/completed/'.$update->id;
										$url = 'http://s01.okaydrive.com/rt/plugins/datadir/action.php';
										$myvars = 'move_fastresume=0&move_datafiles=1&move_addpath=1&hash=' . $tor[0] . '&datadir='.$loc;

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

										$torrent_move = json_decode($response, true);
										
										
										$process = shell_exec('nohup php /opt/nginx/html/artisan sys:process --hash=' . $update->hash. ' > /dev/null 2>&1 & echo $!');
										$update->state = "process";
										$update->status = 5;
										$update->save();
										break;				
									}
								}	
								
							if($update->state == "put_start"  || $update->state == "put_pause"  || strpos($update->title ,'.meta') !== false || $update->featured_at != "0000-00-00 00:00:00"){
								echo "in";
							}else{
								if($update->state == "downloading"){
									$now = new DateTime();
									$now_stamp = $now->format('Y-m-d H:i:s');  
									$update->featured_at = $now_stamp;
									$update->save();
								}
							}
							

							if($update->state == "hashing"){
								$update->perc = $this->percent($info[25],$info[8]);
							}else{
								$update->perc = $this->percent($info[9],$info[6]);
							}


							$update->upsd = $info[13];
							
					
							
							
							if($info[13] == 0){
								$update->eta = $info[6]-$info[9];
							}else{
								$update->eta = ($info[6]-$info[9])/$info[13];
							}
						
							$update->peersc = $info[18];
							
							$update->peersa = $info[19];
							
							$update->size = $info[6];
							
							if($update->title != $info[5]){
								if($info[5] == ''){
									$info[5] = 'no name field';
								}
								$update->title = $info[5];
							}
							$update->save();
						
						}
						echo uniqid();
					}
				}
			
			}catch(Exception $e) {
				echo 'Message: ' .$e->getMessage();
				$report = new UserFlag;
				$report->type = 'check-all-error';
				$report->media_id = $update->id;
				$report->res = $e->getMessage();
				$report->save();
			}
		}
		echo "end";
		
    }
	
	public function percent($num_amount, $num_total) {

		$count1 = $num_amount / $num_total;
		$count2 = $count1 * 100;
		$count = number_format($count2, 0);
		return $count;
	}

	public function fullpath($path,$times){
		$full_path = '';
		for($i = 0; $i <= $times;$i++){
			$full_path .= $path[$i] . '/';
		}
		return $full_path;
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