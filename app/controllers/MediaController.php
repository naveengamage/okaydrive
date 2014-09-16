<?php
date_default_timezone_set('Pacific/Auckland');
class MediaController extends BaseController {

	/**
	 * Media Repository
	 *
	 * @var Meda
	 */
	protected $media;

	public function __construct(Media $media)
	{
		$this->media = $media;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$media = $this->media->all();

		return View::make('media.index', compact('media'));
	}

	public function apiAdd()
	{
	
		$msg = null;
		$result = false;
		$code = 111;
		$url = Input::get("url");
		$api_key = Input::get("api_key");

		if(!empty($api_key)){
			$be_cache = BrowserExtension::where('url','=', $url)->first();
			
			if(count($be_cache) != 0){
					list ($data_code,$data_result)= $this->apiSave($api_key,$be_cache->data_url,false);
					if($data_result){
						$result = true;
						$code = 0;
					}elseif($data_code == 'nouser' ){
						$code = 505;
					}else{
						$code = 404;
						$msg = $data_code;
					}								
			}else{
				$url_data = parse_url($url);
				if($url_data['host'] === "kickass.to" || $url_data['host'] === "kickass.to.unblock.to" ){
			  
					$request = curl_init();
					curl_setopt($request, CURLOPT_ENCODING, "gzip");
					curl_setopt($request, CURLOPT_HEADER, 0);
					curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($request, CURLOPT_URL, $url);
					curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
					$data = curl_exec($request);
					curl_close($request);
								
					$doc = new DOMDocument();
					libxml_use_internal_errors(true);
					$doc->loadHTML($data);
					libxml_use_internal_errors(false);
					
					$xpath = new DOMXPath($doc);
					$results = $xpath->query('//*[@class="siteButton giantButton"]');
					foreach($results as $r){
						$data_url = $r->getAttribute('href'); break;
					}
					
					if(!isset($data_url) || empty($data_url)){
						$response = Response::json(array('result'=> $result,'code'=>110,'msg'=> $msg));	
						$response->header('Content-Type', 'application/json');
						return $response;
					}

					list ($data_code,$data_result)= $this->apiSave($api_key,$data_url,$url);
					if($data_result){
						$result = true;
						$code = 0;
					}elseif($data_code == 'nouser' ){
						$code = 505;
					}else{
						$code = 404;
						$msg = $data_code;
					}
				}elseif($url_data['host'] === "thepiratebay.se" || $url_data['host'] === "fastpiratebay.eu" || $url_data['host'] === "thepiratebay.se.unblock.to"){
					$request = curl_init();
					curl_setopt($request, CURLOPT_ENCODING, "gzip");
					curl_setopt($request, CURLOPT_HEADER, 0);
					curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($request, CURLOPT_URL, $url);
					curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
					$data = curl_exec($request);
					curl_close($request);
								
					$doc = new DOMDocument();
					libxml_use_internal_errors(true);
					$doc->loadHTML($data);
					libxml_use_internal_errors(false);
					
					$xpath = new DOMXPath($doc);
					$results = $xpath->query('//*[@title="Get this torrent"]');
					foreach($results as $r){
						$data_url = $r->getAttribute('href'); break;
					}
					
					if(!isset($data_url) || empty($data_url)){
						$response = Response::json(array('result'=> $result,'code'=>110,'msg'=> $msg));	
						$response->header('Content-Type', 'application/json');
						return $response;
					}
					
					list ($data_code,$data_result)= $this->apiSave($api_key,$data_url,$url);
					if($data_result){
						$result = true;
						$code = 0;
					}elseif($data_code == 'nouser' ){
						$code = 505;
					}else{
						$code = 404;
						$msg = $data_code;
					}
				}elseif($url_data['host'] === "isohunt.to"){
					$request = curl_init();
					curl_setopt($request, CURLOPT_ENCODING, "gzip");
					curl_setopt($request, CURLOPT_HEADER, 0);
					curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($request, CURLOPT_URL, $url);
					curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
					$data = curl_exec($request);
					curl_close($request);
								
					$doc = new DOMDocument();
					libxml_use_internal_errors(true);
					$doc->loadHTML($data);
					libxml_use_internal_errors(false);
					
					$xpath = new DOMXPath($doc);
					$results = $xpath->query('//*[@title="You need BitTorrent software for this P2P download link to work"]');
					foreach($results as $r){
						$data_url2 = $r->getAttribute('href'); break;
					}
					
					$request2 = curl_init();
					curl_setopt($request2, CURLOPT_ENCODING, "gzip");
					curl_setopt($request2, CURLOPT_HEADER, 0);
					curl_setopt($request2, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($request2, CURLOPT_URL, 'http://isohunt.to/'.$data_url2);
					curl_setopt($request2, CURLOPT_FOLLOWLOCATION, 1);
					$data = curl_exec($request2);
					curl_close($request2);
								
					$doc2 = new DOMDocument();
					libxml_use_internal_errors(true);
					$doc2->loadHTML($data);
					libxml_use_internal_errors(false);
					
					$xpath2 = new DOMXPath($doc2);
					$results2 = $xpath2->query('//*[@class="btn btn-blue"]');
					foreach($results2 as $r){
						$data_url = $r->getAttribute('href'); break;
					}
					
					if(!isset($data_url) || empty($data_url)){
						$response = Response::json(array('result'=> $result,'code'=>110,'msg'=> $msg));	
						$response->header('Content-Type', 'application/json');
						return $response;
					}
					
					list ($data_code,$data_result)= $this->apiSave($api_key,$data_url,$url);
					if($data_result){
						$result = true;
						$code = 0;
					}elseif($data_code == 'nouser' ){
						$code = 505;
					}else{
						$code = 404;
						$msg = $data_code;
					}
				}
			}
		}else{
			$code = 505;
		}		
		  

		$response = Response::json(array('result'=> $result,'code'=>$code,'msg'=> $msg));	
		$response->header('Content-Type', 'application/json');
		return $response;

	}
	
	public function apiSave($api_key, $url, $org_url){
	
		$api_user =  User::where('api_key','=',$api_key)->where('active','=', '1')->first();
		
		if(count($api_user) == 0){

			return array('nouser',false);
		}
		
		if(	$org_url != false){
			$new_be = new BrowserExtension;
			$new_be->user_id = $api_user->id;
			$new_be->url = $org_url;
			$new_be->data_url = $url;
			$new_be->save();
		}
					
		$count = UserMedia::where('user_id','=',$api_user->id)->where('is_deleted','=', '0')->where('cat','=', '1')->count();
		
		//if($count >= 2 && $api_user->category_id == 1){
			//$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Free accounts are only allowed 2 torrents per account.' ));	
			//$response->header('Content-Type', 'application/json');
		//	return array('Free accounts are only allowed 2 torrents per account.',false);
		//}
		
		$user_media =  UserMedia::where('user_id', '=', $api_user->id)->where('is_deleted','=', '0')->get();
		
		if(count($user_media) != 0){
		
			$uma = array();
			foreach($user_media as $um){
				array_push($uma, $um->media_id);
			}
			$media_count =  Media::whereIn('id', $uma)->where('state','!=', 'done')->where('state','!=', 'max_pause')->where('state','!=', 'failed')->where('state','!=', 'process')->where('state','!=', 'stop')->count();
			
			if($media_count >= 1 && $api_user->category_id == 1){
				//$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Free accounts are only allowed 1 active torrent per account.' ));	
				//$response->header('Content-Type', 'application/json');
				return array('Free accounts are only allowed 1 active torrent per account.',false);
			}
			
			if($media_count >= 10 && !Auth::user()->admin){
				//$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Your account is only allowed 10 active torrents.' ));	
				//$response->header('Content-Type', 'application/json');
				return array('Your account is only allowed 10 active torrents.',false);	
			}
		}


			if($api_user->category_id == 1){
				$status = true;
				
				$useage = $api_user->used_bytes;
				
				if($useage > $api_user->avl_bytes){					
						$status = false;
				}
				
				if(($api_user->avl_bytes - $useage) < 104857600){
						$status = false;
				}

				date_default_timezone_set('Pacific/Auckland');

				$ip_date = date("Y-m-d"); 
				
				$ip_bytes = DataIp::where('ip','=',$_SERVER['REMOTE_ADDR'])->where('date','=',$ip_date)->sum('bytes');
				
				if((1073741824 - $ip_bytes) < 104857600){
						$status = false;
				}
				
				if(!$status){

					return array('Low bandwidth left on your account. Upgrade your account to premium.',false);					
				}
			}			
		

		$hash = '';

		
		$url_post = 'http://s01.okaydrive.com/rt/php/addtorrent2.php';
		$myvars = 'torrents_start_stopped=1&url='. $url;
		$source_url = $url;
		$ch = curl_init( $url_post );
		
		$username = 'datalinktunnel';
		$password = 'T52UamGTrmCCGn4fJgyq';
		curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec( $ch );

		$json = json_decode($response, true);
		
		$uni_id = '';
		if($json["result"] == "success"){

				$hash = $json["hash"];
				
				$mediaexist = Media::where('hash', '=', $hash)->first();
				if(isset($mediaexist->id)){
				
					if($mediaexist->state == 'done' || $mediaexist->state == 'failed'){
							$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
							$myvars = 'mode=remove&hash='.$mediaexist->hash;

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

							$removed = json_decode($response, true);
					
					}

						
					
					$userHasMedia = UserMedia::where('user_id', '=', $api_user->id)->where('media_id', '=', $mediaexist->id)->first();
					if(!isset($userHasMedia->id)){
							if($mediaexist->size  > $api_user->category()->max_add){
								//$response = Response::json(array('result'=>false,'location' => false,'error'=>'Max torrent size allowed for Free accounts reached.'));	
								//$response->header('Content-Type', 'application/json');
								return array('Max torrent size allowed for Free accounts reached.',false);
							}
						if($mediaexist->state == 'max_pause'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'fail_free' && $mediaexist->user_id != $api_user->user_id){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'delete'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						$newMedia = new UserMedia;
						$newMedia->user_id = $api_user->id;
						$newMedia->cat = $api_user->category_id;
						$newMedia->media_id = $mediaexist->id;
						$newMedia->uni_id = uniqid(rand(), true);
						$newMedia->save();
						$uni_id = $newMedia->uni_id;
						$res = 'cache';
					}else{
					
						if($mediaexist->state == 'max_pause'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'fail_free' && $mediaexist->user_id != $api_user->user_id){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'delete'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($userHasMedia->is_deleted){
							$userHasMedia->is_deleted = false;
							$userHasMedia->save();
						}
						$res = 'has';
						$uni_id = $userHasMedia->uni_id;
					}					
				}else{
							sleep(3);
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
							
					if(empty($torrent_info[0]) || !isset($torrent_info[0])){
						$torrent_info[0] = $hash;
					}
					
					$inputTorrent["hash"] = $hash; 
					$inputTorrent["title"] = $torrent_info[0];
					$inputTorrent["state"] = 'put_pause'; 
					$inputTorrent["user_id"] = $api_user->id;
					$inputTorrent["api"] = 1;
					$inputTorrent["source"] = $source_url;
					$inputTorrent["cat"] = $api_user->category_id;
					$new_media = $this->media->create($inputTorrent);
					
					$newMedia = new UserMedia;
					$newMedia->user_id = $api_user->id;
					$newMedia->cat = $api_user->category_id;
					$newMedia->media_id = $new_media->id;
					$newMedia->uni_id = uniqid(rand(), true);
					$newMedia->save();
					$uni_id = $newMedia->uni_id;
					
	
							sleep(1);
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
							$totalSize = $torrent_info[1];
						
						if(!empty($totalSize)){
							if($totalSize  > $api_user->category()->max_add){
								$newMedia->delete();
								$new_media->delete();
								//$response = Response::json(array('result'=>false,'location' => false,'error'=>'Max torrent size allowed for Free accounts reached.'));	
								//$response->header('Content-Type', 'application/json');
								return array('Max torrent size allowed for Free accounts reached.',false);
							}else{
								$new_media["size"] = $totalSize;
							}							
						}
						
						if(!empty($files) && !empty($torrent_info[2])){
							$ignore_first_folder = true;
							$id = 1;
							$paths = array();
							foreach($files as $file){
								if($file[0] != $hash.'.meta'){
								
									if($torrent_info[3] != 0){
										$fd = parse_url(basename ( $torrent_info[2] ) . '/' .$file[0]);
									}else{
										$fd = parse_url($file[0]);
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
														$new_folder->media_id = $new_media->id;
														$new_folder->save();	
													$id++;
												}
											}elseif(isset($dirs[$i]) && $dirs[$i] == '.'){
														//echo $path_parts["basename"].' 0';
														$new_file = new MediaLike;
														if($torrent_info[3] != 0){
															$new_file->path = basename ( $torrent_info[2] ) . '/' . $file[0];
														}else{
															$new_file->path = $file[0];
														}
														$new_file->type = $this->getExt($new_file->path);														
														$new_file->name = $path_parts["basename"];
														$new_file->in = 0;
														$new_file->size = $file[3];
														$new_file->media_id = $new_media->id;
														//$like->user_id = Auth::user()->id;
														$new_file->save();	
														$ignore_first_folder = false;
											}else{
												if(isset($dirs[$i-1]) && $dirs[$i-1] != '.'){
														$full_path = $this->fullpath($dirs,$i-1);
														//echo $path_parts["basename"].' '.$paths[$full_path]["id"];
														$new_file = new MediaLike;
														if($torrent_info[3] != 0){
															$new_file->path = basename ( $torrent_info[2] ) . '/' . $file[0];
														}else{
															$new_file->path = $file[0];
														}
														$new_file->type = $this->getExt($new_file->path);
														$new_file->name = $path_parts["basename"];
														$new_file->in = $paths[$full_path]["id"];
														$new_file->size = $file[3];
														$new_file->media_id = $new_media->id;
														//$like->user_id = Auth::user()->id;
														$new_file->save();														
												}
											}
										}	
								}				
							}
							$new_media["ignore_first"] = $ignore_first_folder;
						}
						$new_media->save();
					
					$res = 'added';
				}
			
		}else{
			$error = "Could not add the torrent, please check your input.";
		}
		
		//$new_media = $this->media->create($input);
		if(isset($error)){
			//$response = Response::json(array('result'=>false,'location' => false,'error'=>$error));	
			//$response->header('Content-Type', 'application/json');
			return array($error,false);	
		}else{
			//$response = Response::json(array('result'=>true,'location' => '/torrent/'.$uni_id,'torrent'=>$res));	
			//$response->header('Content-Type', 'application/json');
			return array('ok',true);
		}
	
	}

	public function uploadData()
	{

		$requestsPerHour = 60;
		$key = sprintf('api:%s', Request::getClientIp());

	
		
		$get_data = DB::table('limit')->where('ip', $key)->first();
		
		if(isset($get_data->ip)){	
			$count = $get_data->count;
			$count++;
			DB::table('limit')->where('ip', $key)->update(array('count' => $count));
		}else{
			DB::table('limit')->insert(array('ip' => $key, 'count' => 0));
		}

		
		$count = UserMedia::where('user_id','=',Auth::user()->id)->where('is_deleted','=', '0')->where('cat','=', '1')->count();
		//if($count >= 2 && Auth::user()->category_id == 1){
		//	$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Free accounts are only allowed 2 torrents per account.' ));	
		//	$response->header('Content-Type', 'application/json');
		//	return $response;	
		//}
		
		$user_media =  UserMedia::where('user_id', '=', Auth::user()->id)->where('is_deleted','=', '0')->get();
		
		if(count($user_media) != 0){
		
			$uma = array();
			foreach($user_media as $um){
				array_push($uma, $um->media_id);
			}
			$media_count =  Media::whereIn('id', $uma)->where('state','!=', 'done')->where('state','!=', 'max_pause')->where('state','!=', 'failed')->where('state','!=', 'process')->where('state','!=', 'stop')->count();
			
			if($media_count >= 1 && Auth::user()->category_id == 1){
				$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Free accounts are only allowed 1 active torrent per account.' ));	
				$response->header('Content-Type', 'application/json');
				return $response;	
			}
			
			if($media_count >= 10 && !Auth::user()->admin){
				$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Your account is only allowed 10 active torrents.' ));	
				$response->header('Content-Type', 'application/json');
				return $response;	
			}
		}	
		
			if(Auth::user()->category_id == 1){
				$status = true;
				
				$useage = Auth::user()->used_bytes;
				
				if($useage > Auth::user()->avl_bytes){					
						$status = false;
				}
				
				if((Auth::user()->avl_bytes - $useage) < 104857600){
						$status = false;
				}

				date_default_timezone_set('Pacific/Auckland');

				$ip_date = date("Y-m-d"); 
				
				$ip_bytes = DataIp::where('ip','=',$_SERVER['REMOTE_ADDR'])->where('date','=',$ip_date)->sum('bytes');
				
				if((1073741824 - $ip_bytes) < 104857600){
						$status = false;
				}
				
				if(!$status){
					$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Low bandwidth left on your account. Upgrade your account to premium.' ));	
					$response->header('Content-Type', 'application/json');
					return $response;	
				}
			}
		
		$input = Input::all();
		$hash = '';
		if(!isset($input["tdt"]) || empty($input["tdt"])){
			$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Could not locate the torrent. Please check the input.' ));	
			$response->header('Content-Type', 'application/json');
			return $response;	
		}
		
		
		$url = 'http://s01.okaydrive.com/rt/php/addtorrent2.php';
		$myvars = 'torrents_start_stopped=1&url='. $input["tdt"];

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
		$json = json_decode($response, true);
		//var_dump($json);
		
		$uni_id = '';
		
		if($json["result"] == "success"){
				$hash = $json["hash"];

				$mediaexist = Media::where('hash', '=', $hash)->first();
				if(isset($mediaexist->id)){
				
					if($mediaexist->state == 'done' || $mediaexist->state == 'failed'){
							$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
							$myvars = 'mode=remove&hash='.$mediaexist->hash;

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

							$removed = json_decode($response, true);
					
					}
											
					
					$userHasMedia = UserMedia::where('user_id', '=', Auth::user()->id)->where('media_id', '=', $mediaexist->id)->first();
					if(!isset($userHasMedia->id)){
							if($mediaexist->size  > Auth::user()->category()->max_add){
								$response = Response::json(array('result'=>false,'location' => false,'error'=>'Max torrent size allowed for Free accounts reached.'));	
								$response->header('Content-Type', 'application/json');
								return $response;	
							}
							
						if($mediaexist->state == 'max_pause'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'fail_free' && $mediaexist->user_id != Auth::user()->user_id){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'delete'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						$newMedia = new UserMedia;
						$newMedia->user_id = Auth::user()->id;
						$newMedia->cat = Auth::user()->category_id;
						$newMedia->media_id = $mediaexist->id;
						$newMedia->uni_id = uniqid(rand(), true);
						$newMedia->save();
						$uni_id = $newMedia->uni_id;
						$res = 'cache';
					}else{
					
						if($mediaexist->state == 'max_pause'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'fail_free' && $mediaexist->user_id != Auth::user()->user_id){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'delete'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($userHasMedia->is_deleted){
							$userHasMedia->is_deleted = false;
							$userHasMedia->save();
						}
						$res = 'has';
						$uni_id = $userHasMedia->uni_id;
					}					
				}else{
						sleep(4);
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

					if(empty($torrent_info[0]) || !isset($torrent_info[0])){
						$torrent_info[0] = $hash;
					}
					
					$inputTorrent["hash"] = $hash; 
					$inputTorrent["title"] = $torrent_info[0]; 
					$inputTorrent["state"] = 'put_pause'; 
					$inputTorrent["user_id"] = Auth::user()->id;
					$inputTorrent["source"] = $input["tdt"];
					$inputTorrent["cat"] = Auth::user()->category_id;
					$new_media = $this->media->create($inputTorrent);
					
					$newMedia = new UserMedia;
					$newMedia->user_id = Auth::user()->id;
					$newMedia->cat = Auth::user()->category_id;
					$newMedia->media_id = $new_media->id;
					$newMedia->uni_id = uniqid(rand(), true);
					$newMedia->save();
					$uni_id = $newMedia->uni_id;
					
							sleep(1);
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
						$totalSize = $torrent_info[1];
						
						if(!empty($totalSize)){
							if($totalSize  > Auth::user()->category()->max_add){
								$newMedia->delete();
								$new_media->delete();
								$response = Response::json(array('result'=>false,'location' => false,'error'=>'Max torrent size allowed for Free accounts reached.'));	
								$response->header('Content-Type', 'application/json');
								return $response;	
							}else{
								$new_media["size"] = $totalSize;
							}							
						}
						if(!empty($files) && !empty($torrent_info[2])){
							$ignore_first_folder = true;
							$id = 1;
							$paths = array();
							foreach($files as $file){
								if($file[0] != $hash.'.meta'){
											if($torrent_info[3] != 0){
												$fd = parse_url(basename ( $torrent_info[2] ) . '/' .$file[0]);
											}else{
												$fd = parse_url($file[0]);
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
														$new_folder->media_id = $new_media->id;
														$new_folder->save();	
													$id++;
												}
											}elseif(isset($dirs[$i]) && $dirs[$i] == '.'){
														//echo $path_parts["basename"].' 0';
														$new_file = new MediaLike;
														if($torrent_info[3] != 0){
															$new_file->path = basename ( $torrent_info[2] ) . '/' . $file[0];
														}else{
															$new_file->path = $file[0];
														}
														$new_file->type = $this->getExt($new_file->path);														
														$new_file->name = $path_parts["basename"];
														$new_file->in = 0;
														$new_file->size = $file[3];
														$new_file->media_id = $new_media->id;
														//$like->user_id = Auth::user()->id;
														$new_file->save();	
														$ignore_first_folder = false;
											}else{
												if(isset($dirs[$i-1]) && $dirs[$i-1] != '.'){
														$full_path = $this->fullpath($dirs,$i-1);
														//echo $path_parts["basename"].' '.$paths[$full_path]["id"];
														$new_file = new MediaLike;
														if($torrent_info[3] != 0){
															$new_file->path = basename ( $torrent_info[2] ) . '/' . $file[0];
														}else{
															$new_file->path = $file[0];
														}
														$new_file->type = $this->getExt($new_file->path);
														$new_file->name = $path_parts["basename"];
														$new_file->in = $paths[$full_path]["id"];
														$new_file->size = $file[3];
														$new_file->media_id = $new_media->id;
														//$like->user_id = Auth::user()->id;
														$new_file->save();														
												}
											}
										}	
								}
							}
							$new_media["ignore_first"] = $ignore_first_folder;
						}
						$new_media->save();
					
					$res = 'added';
				}
			
		}else{
			$error = "Could not add the torrent, please check your input.";
		}
		
		//$new_media = $this->media->create($input);
		if(isset($error)){
			$response = Response::json(array('result'=>false,'location' => false,'error'=>$error));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}else{
			$response = Response::json(array('result'=>true,'location' => '/torrent/'.$uni_id,'torrent'=>$res));	
			$response->header('Content-Type', 'application/json');
			return $response;
		}
	}
	
	public function uploadFile()
	{

			
		$requestsPerHour = 60;
		$key = sprintf('api:%s', Request::getClientIp());

	
		
		$get_data = DB::table('limit')->where('ip', $key)->first();
		
		if(isset($get_data->ip)){	
			$count = $get_data->count;
			$count++;
			DB::table('limit')->where('ip', $key)->update(array('count' => $count));
		}else{
			DB::table('limit')->insert(array('user_id'=> Auth::user()->id, 'ip' => $key, 'count' => 0));
		}
		

		$count = UserMedia::where('user_id','=',Auth::user()->id)->where('is_deleted','=', '0')->where('cat','=', '1')->count();
		//if($count >= 2 && Auth::user()->category_id == 1){
		//	$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Free accounts are only allowed 2 torrents per account.' ));	
		//	$response->header('Content-Type', 'application/json');
		//	return $response;	
		//}
		
		$user_media =  UserMedia::where('user_id', '=', Auth::user()->id)->where('is_deleted','=', '0')->get();
		
		if(count($user_media) != 0){
		
			$uma = array();
			foreach($user_media as $um){
				array_push($uma, $um->media_id);
			}
			$media_count =  Media::whereIn('id', $uma)->where('state','!=', 'done')->where('state','!=', 'max_pause')->where('state','!=', 'failed')->where('state','!=', 'process')->where('state','!=', 'stop')->count();
			
			if($media_count >= 1 && Auth::user()->category_id == 1){
				$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Free accounts are only allowed 1 active torrent per account.' ));	
				$response->header('Content-Type', 'application/json');
				return $response;	
			}
			
			if($media_count >= 10){
				$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Your account is only allowed 10 active torrents.' ));	
				$response->header('Content-Type', 'application/json');
				return $response;	
			}
		}	
		
			if(Auth::user()->category_id == 1){
				$status = true;
				
				$useage = Auth::user()->used_bytes;
				
				if($useage > Auth::user()->avl_bytes){					
						$status = false;
				}
				
				if((Auth::user()->avl_bytes - $useage) < 104857600){
						$status = false;
				}

				date_default_timezone_set('Pacific/Auckland');

				$ip_date = date("Y-m-d"); 
				
				$ip_bytes = DataIp::where('ip','=',$_SERVER['REMOTE_ADDR'])->where('date','=',$ip_date)->sum('bytes');
				
				if((1073741824 - $ip_bytes) < 104857600){
						$status = false;
				}
				
				if(!$status){
					$response = Response::json(array('result'=>false, 'location' => false,'error'=>'Low bandwidth left on your account. Upgrade your account to premium.' ));	
					$response->header('Content-Type', 'application/json');
					return $response;	
				}
			}
			

		
		require('/opt/nginx/html/vendor/upload.php');
		$upload_directory = '/opt/nginx/html/public/cache/tmp';
		$allowed_extensions = array('torrent');
		$max_size = 1048576;

		$uploader = new FileUpload('file');

		$ext = $uploader->getExtension();

		if (empty($ext)) {
			$response = Response::json(array('result' => false, 'location' => false, 'error' => 'Invalid file type.'));
			$response->header('Content-Type', 'application/json');
			return $response;  
		}

		$filename = uniqid(uniqid(), true) . '.' . $ext; 
		$uploader->newFileName = $filename;

		$uploader->sizeLimit = $max_size;

		$result = $uploader->handleUpload($upload_directory, $allowed_extensions); 
		
		$errors = $uploader->getErrorMsg();
		if(!empty($errors)){
			$response = Response::json(array('result' => false, 'location' => false, 'error' => $uploader->getErrorMsg()));
			$response->header('Content-Type', 'application/json');
			return $response;  
		}
		
		$file = $uploader->getSavedFile();

		
		$url = 'http://s01.okaydrive.com/rt/php/addtorrent2.php';
		$myvars = 'torrents_start_stopped=1&url=https://okaydrive.com/cache/tmp/'. $filename;

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

		$json = json_decode($response, true);


		$uni_id = '';
		if($json["result"] == "success"){
		
				$hash = $json["hash"];
				
				$mediaexist = Media::where('hash', '=', $hash)->first();
				if(isset($mediaexist->id)){
				
					if($mediaexist->state == 'done' || $mediaexist->state == 'failed'){
							$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
							$myvars = 'mode=remove&hash='.$mediaexist->hash;

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

							$removed = json_decode($response, true);
					
					}
										
					$userHasMedia = UserMedia::where('user_id', '=', Auth::user()->id)->where('media_id', '=', $mediaexist->id)->first();
					if(!isset($userHasMedia->id)){
							if($mediaexist->size  > Auth::user()->category()->max_add){
								$response = Response::json(array('result'=>false,'location' => false,'error'=>'Max torrent size allowed for Free accounts reached.'));	
								$response->header('Content-Type', 'application/json');
								return $response;	
							}
						if($mediaexist->state == 'max_pause'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}			

						if($mediaexist->state == 'fail_free' && $mediaexist->user_id != Auth::user()->user_id){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'delete'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						$newMedia = new UserMedia;
						$newMedia->user_id = Auth::user()->id;
						$newMedia->cat = Auth::user()->category_id;
						$newMedia->media_id = $mediaexist->id;
						$newMedia->uni_id = uniqid(rand(), true);
						$newMedia->save();
						$uni_id = $newMedia->uni_id;
						$res = 'cache';
					}else{
					
						if($mediaexist->state == 'max_pause'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}			

						if($mediaexist->state == 'fail_free' && $mediaexist->user_id != Auth::user()->user_id){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($mediaexist->state == 'delete'){
							$mediaexist->state = 'put_pause';
							$mediaexist->save();
						}
						
						if($userHasMedia->is_deleted){
							$userHasMedia->is_deleted = false;
							$userHasMedia->save();
						}
						$uni_id = $userHasMedia->uni_id;
						$res = 'has';
					}					
				}else{
				
					sleep(4);
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

					if(empty($torrent_info[0]) || !isset($torrent_info[0])){
						$torrent_info[0] = $hash;
					}
					$inputTorrent["hash"] = $hash; 
					$inputTorrent["title"] = $torrent_info[0]; 
					$inputTorrent["state"] = 'put_pause'; 
					$inputTorrent["user_id"] = Auth::user()->id;
					$inputTorrent["source"] = 'https://okaydrive.com/cache/tmp/'. $filename;
					$inputTorrent["cat"] = Auth::user()->category_id;
					$new_media = $this->media->create($inputTorrent);
					
					$newMedia = new UserMedia;
					$newMedia->user_id = Auth::user()->id;
					$newMedia->cat = Auth::user()->category_id;
					$newMedia->media_id = $new_media->id;
					$newMedia->uni_id = uniqid(rand(), true);
					$newMedia->save();
					$uni_id = $newMedia->uni_id;
					
							sleep(1);
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
						$totalSize = $torrent_info[1];
						
						if(!empty($totalSize)){
							if($totalSize  > Auth::user()->category()->max_add){
								$newMedia->delete();
								$new_media->delete();
								$response = Response::json(array('result'=>false,'location' => false,'error'=>'Max torrent size allowed for Free accounts reached.'));	
								$response->header('Content-Type', 'application/json');
								return $response;	
							}else{
								$new_media["size"] = $totalSize;
							}							
						}
						if(!empty($files) && !empty($torrent_info[2])){
							$ignore_first_folder = true;
							$id = 1;
							$paths = array();
							foreach($files as $file){
								if($file[0] != $hash.'.meta'){
											if($torrent_info[3] != 0){
												$fd = parse_url(basename ( $torrent_info[2] ) . '/' .$file[0]);
											}else{
												$fd = parse_url($file[0]);
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
														$new_folder->media_id = $new_media->id;
														$new_folder->save();	
													$id++;
												}
											}elseif(isset($dirs[$i]) && $dirs[$i] == '.'){
														//echo $path_parts["basename"].' 0';
														$new_file = new MediaLike;
														if($torrent_info[3] != 0){
															$new_file->path = basename ( $torrent_info[2] ) . '/' . $file[0];
														}else{
															$new_file->path = $file[0];
														}
														$new_file->type = $this->getExt($new_file->path);														
														$new_file->name = $path_parts["basename"];
														$new_file->in = 0;
														$new_file->size = $file[3];
														$new_file->media_id = $new_media->id;
														//$like->user_id = Auth::user()->id;
														$new_file->save();	
														$ignore_first_folder = false;
											}else{
												if(isset($dirs[$i-1]) && $dirs[$i-1] != '.'){
														$full_path = $this->fullpath($dirs,$i-1);
														//echo $path_parts["basename"].' '.$paths[$full_path]["id"];
														$new_file = new MediaLike;
														if($torrent_info[3] != 0){
															$new_file->path = basename ( $torrent_info[2] ) . '/' . $file[0];
														}else{
															$new_file->path = $file[0];
														}
														$new_file->type = $this->getExt($new_file->path);
														$new_file->name = $path_parts["basename"];
														$new_file->in = $paths[$full_path]["id"];
														$new_file->size = $file[3];
														$new_file->media_id = $new_media->id;
														//$like->user_id = Auth::user()->id;
														$new_file->save();														
												}
											}
										}
								}
							}
							$new_media["ignore_first"] = $ignore_first_folder;
						}
						$new_media->save();
					
					$res = 'added';
				}
			
		}else{
			$error = "Could not add the torrent, please check your input.";
		}
		
		//$new_media = $this->media->create($input);
		if(isset($error)){
			$response = Response::json(array('result'=>false,'location' => false,'error'=>$error));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}else{
			$response = Response::json(array('result'=>true,'location' => '/torrent/'.$uni_id,'torrent'=>$res));	
			$response->header('Content-Type', 'application/json');
			return $response;
		}	
	}
	// Sanitize Image URL's

	private function sanitize($string, $force_lowercase = true, $anal = false) {
	    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
	                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
	                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
	    $clean = trim(str_replace($strip, "", strip_tags($string)));
	    $clean = preg_replace('/\s+/', "-", $clean);
	    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
	    return ($force_lowercase) ?
	        (function_exists('mb_strtolower')) ?
	            mb_strtolower($clean, 'UTF-8') :
	            strtolower($clean) :
	        $clean;
	}

	// Slugify Media titles

	public function slugify($text) {
	    // replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		if (empty($text))
		{
		return 'n-a';
		}

	  	return $text;
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
					$type = '';
		}
		return $type;
	}

}