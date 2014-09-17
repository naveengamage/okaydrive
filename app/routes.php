<?php
date_default_timezone_set('Pacific/Auckland');
// ********* POPULAR ROUTE ********** //

Route::get('/founder', function()
{
	echo "Thanks, you will be redirected to linkedin profile of the founder in 5 seconds.";
	return header("Refresh: 5;url=https://www.linkedin.com/profile/view?id=170177558");
});

Route::get('/', function(){


	if (Auth::guest()){
		return Redirect::to('/signin');
	}else{
		$msg = null;
		$msg2 = null;
		if(Input::has('error')){
			$msg = 'Your account has no bandwidth left to download this file.';
			$msg2 = 'Your account has no bandwidth left to download this file, please upgrade your account to premium.';
		}
		$user_media =  UserMedia::where('user_id', '=', Auth::user()->id)->get();
		if(count($user_media) == 0){
				$media = array();
				$data = array('media'=>$media);
				return View::make('home',$data)->with(array('msg'=>$msg,'msg2'=>$msg2,'avlper'=> (100 - percentage(Auth::user()->used_bytes,Auth::user()->avl_bytes,'1')),'freebytes'=> getfilesize(Auth::user()->avl_bytes - Auth::user()->used_bytes)));
		}
		$uma = array();
		foreach($user_media as $um){
			array_push($uma, $um->media_id);
		}
		$media =  Media::whereIn('id', $uma)->get();
		foreach($media as $m){
			$user_media =  UserMedia::where('media_id', '=', $m->id )->where('user_id', '=', Auth::user()->id)->first();
			$m->uni_id = $user_media->uni_id;
			$m->created = $user_media->created_at;
			if($user_media->is_deleted){
				$m->state = "deleted";
			}
		}
		$media->sort(function($a, $b)
			{
				$a = $a->created;
				$b = $b->created;
				if ($a === $b) {
					return 0;
				}
				return ($a < $b) ? 1 : -1;
			});
//$media = Media::join('user_media', 'comments.post_id', '=', 'posts.id')
 //       ->order_by('comments.created_at')
  //      ->get(array('comments.field1 as field1', 'posts.field2 as field2'));
		
		$data = array('media'=>$media);
		return View::make('home',$data)->with(array('msg'=>$msg,'msg2'=>$msg2,'avlper'=> (100 - percentage(Auth::user()->used_bytes,Auth::user()->avl_bytes,'1')),'freebytes'=>  getfilesize(Auth::user()->avl_bytes - Auth::user()->used_bytes)));
	}
});

Route::get('/home', function(){
	if (Auth::guest()){
		return Redirect::to('/signin');
	}else{
		$msg = null;
		$msg2 = null;
		if(Input::has('error')){
			$msg = 'Your account has no bandwidth left to download this file.';
			$msg2 = 'Your account has no bandwidth left to download this file, please upgrade your account to premium.';
		}
		$user_media =  UserMedia::where('user_id', '=', Auth::user()->id)->get();
		if(count($user_media) == 0){
				$media = array();
				$data = array('media'=>$media);
				return View::make('home',$data)->with(array('msg'=>$msg,'msg2'=>$msg2,'avlper'=> (100 - percentage(Auth::user()->used_bytes,Auth::user()->avl_bytes,'1')),'freebytes'=> getfilesize(Auth::user()->avl_bytes - Auth::user()->used_bytes)));
		}
		$uma = array();
		foreach($user_media as $um){
			array_push($uma, $um->media_id);
		}
		$media =  Media::whereIn('id', $uma)->get();
		foreach($media as $m){
			$user_media =  UserMedia::where('media_id', '=', $m->id )->where('user_id', '=', Auth::user()->id)->first();
			$m->uni_id = $user_media->uni_id;
			$m->created = $user_media->created_at;
			if($user_media->is_deleted){
				$m->state = "deleted";
			}
		}
			$media->sort(function($a, $b)
			{
				$a = $a->created;
				$b = $b->created;
				if ($a === $b) {
					return 0;
				}
				return ($a < $b) ? 1 : -1;
			});
		
		$data = array('media'=>$media);
		return View::make('home',$data)->with(array('msg'=>$msg,'msg2'=>$msg2,'avlper'=> (100 - percentage(Auth::user()->used_bytes,Auth::user()->avl_bytes,'1')),'freebytes'=>  getfilesize(Auth::user()->avl_bytes - Auth::user()->used_bytes)));
	}
});
Route::get('earn', function(){
	if (Auth::guest()){
		return Redirect::guest('signin');
	}else{
	

			return Redirect::to('earn/stats');
		
	}
});

Route::get('earn/stats', function(){
	if (Auth::guest()){
		return Redirect::guest('signin');
	}else{
$start = date('Y-m-d');

 if(!Input::has('p') || Input::get('p') == 't'){
	$date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
	$date->modify('+1 day');
	$end = $date->format('Y-m-d');

	$period = new DatePeriod(
		 new DateTime($start),
		 new DateInterval('PT1H'),
		 new DateTime($end)
	);
}elseif(Input::get('p') == 'y'){
	$date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
	$date->modify('-1 day');
	$end = $date->format('Y-m-d');

	$period = new DatePeriod(
		 new DateTime($end),
		 new DateInterval('PT1H'),
		 new DateTime($start)
	);

}elseif(Input::get('p') == 'w'){
	$date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
	$date->modify('-7 day');
	$end = $date->format('Y-m-d');

	$period = new DatePeriod(
		 new DateTime($end),
		 new DateInterval('P1D'),
		 new DateTime($start)
	);

}elseif(Input::get('p') == 'm'){
	$date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
	$date->modify('-30 day');
	$end = $date->format('Y-m-d');

	$period = new DatePeriod(
		 new DateTime($end),
		 new DateInterval('P1D'),
		 new DateTime($start)
	);

}elseif(Input::get('p') == '3m'){
	$date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
	$date->modify('-90 day');
	$end = $date->format('Y-m-d');

	$period = new DatePeriod(
		 new DateTime($end),
		 new DateInterval('P1D'),
		 new DateTime($start)
	);

}

$data_graph = iterator_to_array($period);

$first_date = '';
$data_gp = array();


foreach($data_graph as $d){
	if($first_date == ''){
		$first_date = $d->format('Y-m-d H:i:s');
	}else{
		$temp_data = DB::table('share_usage')->where('perc','>' , 50)->where('user_id','=' , Auth::user()->id)->whereBetween('created_at', array($first_date, $d->format('Y-m-d H:i:s')))
			 ->select('country', DB::raw('count(*) as total'))
			 ->groupBy('country')
			 ->get();
		$total_views = 0;
		$total_earnings = 0;
		
		foreach($temp_data as $cd){
				$rate = DB::table('pay_rate')->where('name','LIKE' , '%'. $cd->country .'%')->first();
		
				if($cd->total != 0){
					$total_views += $cd->total;
					$rate_thousand = $cd->total / 1000;
					
					if(isset($rate->id)){
						$total_earnings +=  number_format($rate_thousand * $rate->rate, 2, '.', '');
					}else{
						$total_earnings += number_format($rate_thousand * 0.50, 2, '.', '');
					}
				}else{
					$total_earnings += number_format(0, 2, '.', '');
				}	
		}
		$data_gp[] = array('views' => $total_views/1000, 'earnings' => $total_earnings, 'date' => $d->format('Y-m-d H:i:s'));
		$first_date = $d->format('Y-m-d H:i:s');
	}
}

	
	$country_data = DB::table('share_usage')->where('perc','>' , 50)->where('user_id','=' , Auth::user()->id)
                 ->select('country', DB::raw('count(*) as total'))
                 ->groupBy('country')
                 ->get();
	$total_user_earnings = 0;	
	$total_user_views = 0;				 
	foreach($country_data as $cd){
		$rate = DB::table('pay_rate')->where('name','LIKE' , '%'. $cd->country .'%')->first();
		
		if($cd->total != 0){
			$rate_thousand = $cd->total / 1000;
			$total_user_views += $cd->total;
			if(isset($rate->id)){
				$total_user_earnings +=  number_format($rate_thousand * $rate->rate, 2, '.', '');
				$cd->earnings =  number_format($rate_thousand * $rate->rate, 2, '.', '');
				$cd->rate = $rate->rate;
			}else{
				$total_user_earnings += number_format($rate_thousand * 0.20, 2, '.', '');	
				$cd->earnings = number_format($rate_thousand * 0.20, 2, '.', '');
				$cd->rate = 0.20;
			}
		}else{
			$total_user_earnings += number_format(0, 2, '.', '');
			$cd->earnings = number_format(0, 2, '.', '');
			$cd->rate = 0.00;
		}
	
	}
			$shared_files = ShareMedia::where('user_id','=',Auth::user()->id)->count();
			$data  = array('country' => $country_data, 'graph' => $data_gp, 'files' => $shared_files, 'total_user_earnings' => $total_user_earnings, 'total_user_views' => $total_user_views);
			return View::make('page.torrent.earn', $data);
		
	}
});

Route::get('earn/rates', function(){
	if (Auth::guest()){
		return Redirect::guest('signin');
	}else{
	

			return View::make('page.torrent.rate');
		
	}
});

Route::get('earn/cashout', function(){
	if (Auth::guest()){
		return Redirect::guest('signin');
	}else{
	

			return View::make('page.torrent.cashout');
		
	}
});

Route::post('earn/cashout', function(){
	if (Auth::guest()){
		return Redirect::guest('signin');
	}else{
	
		$pr = PayRequest::where('user_id','=', Auth::user()->id)->where('done','=', 0)->first();
		if(isset($pr->id)){
			return Redirect::to('earn/cashout')->with(array('errors' => 'You\'ve already requested for a cash out!'));
		}else{
			if(Input::has('email')){
					if(filter_var(Input::get('email'), FILTER_VALIDATE_EMAIL)) {
				
					}
					else {
						return Redirect::to('earn/cashout')->with(array('errors' => 'Invalid email address!'));
					}
					$country_data = DB::table('share_usage')->where('perc','>' , 50)->where('user_id','=' , Auth::user()->id)
						 ->select('country', DB::raw('count(*) as total'))
						 ->groupBy('country')
						 ->get();
					$total_user_earnings = 0;					 
					foreach($country_data as $cd){
						$rate = DB::table('pay_rate')->where('name','LIKE' , '%'. $cd->country .'%')->first();
						
						if($cd->total != 0){
							$rate_thousand = $cd->total / 1000;
							if(isset($rate->id)){
								$total_user_earnings +=  number_format($rate_thousand * $rate->rate, 2, '.', '');
							}else{
								$total_user_earnings += number_format($rate_thousand * 0.20, 2, '.', '');	
							}
						}else{
							$total_user_earnings += number_format(0, 2, '.', '');
						}
					
					}
					if($total_user_earnings >= 10){
						$npr = new PayRequest;
						$npr->user_id = Auth::user()->id;
						$npr->email = Input::get('email');
						$npr->save();
						return Redirect::to('earn/cashout')->with(array('errors' => 'Request has been submitted!'));
					}else{
						return Redirect::to('earn/cashout')->with(array('errors' => 'Sorry, minimum cash out amount is $10!'));
					}
			}else{
				return Redirect::to('earn/cashout')->with(array('errors' => 'No email address specified!'));
			}
		}	
	}
});

Route::get('torrent/{uniid}', function($uniid){
	if (Auth::guest()){
		return Redirect::guest('signin');
	}else{
		$user_media =  UserMedia::where('uni_id', '=', $uniid)->where('user_id', '=', Auth::user()->id)->first();
		if(count($user_media) == 0){
		
		}else{
			$media =  Media::where('id', '=', $user_media->media_id)->first();
			$pa = Input::get("p");
			
			if(!$media->downloading()){
				include_once('/opt/nginx/html/vendor/secure_link.php');
				$zip_link = new secURL($media->id,null,false,null,true);
				$zip_link->createlink();
				$zip_file_link = $zip_link->getlink();
			}else{
				$zip_file_link = null;
			}
		
			if(Input::has("d")){
				$current = Input::get("d");
			}else{
				$current = 0;
			}
			
			if($current == 0){
				if($media->ignore_first){
					$current = 1;
				}
			}
			
			$data = array(
				'media' => $media,
				'current'=>$current,
				'user_media'=>$user_media);

			return View::make('page.torrent.private', $data)->with(array('m_id'=>$user_media->uni_id ,'zip'=> $zip_file_link,'freebytes'=>  getfilesize(Auth::user()->avl_bytes - Auth::user()->used_bytes),'avlper'=>(100 - percentage(Auth::user()->used_bytes,Auth::user()->avl_bytes,'1'))));
		}
	}
});

Route::get('share/{uniid}', function($uniid){

		$user_media =  ShareMedia::where('uni_id', '=', $uniid)->first();
		if(count($user_media) == 0){
		
		}else{
			$media =  Media::where('id', '=', $user_media->media_id)->first();
			$pa = Input::get("p");
			

				include_once('/opt/nginx/html/vendor/secure_link_share.php');
				if (Auth::guest()){
					$this_user = $user_media->user_id . '-0';
				}else{
					$this_user = $user_media->user_id . '-' . Auth::user()->id;
				}
				$zip_link = new secURL($media->id,null,false,null,true,$this_user);
				$zip_link->createlink();
				$zip_file_link = $zip_link->getlink();

		
			if(Input::has("d")){
				$current = Input::get("d");
			}else{
				$current = 0;
			}
			
			if($current == 0){
				if($media->ignore_first){
					$current = 1;
				}
			}
			
			$data = array(
				'media' => $media,
				'current'=>$current,
				'zip' => $zip_file_link,
				'user_media'=>$user_media);

			return View::make('page.torrent.share', $data)->with(array('m_id'=>$user_media->uni_id ,'zip'=> $zip_file_link));
		}
	
});

Route::post('torrent/{uniid}/status', function($uniid){
	if (Auth::guest()){
		
	}else{
		$user_media =  UserMedia::where('uni_id', '=', $uniid)->where('user_id', '=', Auth::user()->id)->first();
		if(count($user_media) == 0){
		
		}else{
			$media =  Media::where('id', '=', $user_media->media_id)->first();
			$status["se"] = $media->peersa;
			$status["pe"] = $media->peersc;
			$status["sp"] = getspeed($media->upsd);
			$status["pr"] = $media->perc;
			$status["si"] = getfilesize($media->size);
			$status["rt"] = getremain($media->eta);
			
			$media_state = $media->state;
			if($media->userMedia()->max_error===true){
				$media_state = "max_pause";
			}
			switch ($media_state) {
					case "wait":
							$state = "checking";
							$status["rt"] = 0;
							break;	
					case "check":
							$state = "checking";
							$status["rt"] = 0;
							break;				
					case "queue":
							$state = "starting";
							$status["rt"] = 0;
							break;	
					case "downloading":
							$state = "downloading";
							break;	
					case "process":
							$state = "processing";
							$status["rt"] = 0;
							break;	
					case "failed":
							$state = 'failed. reason: ' . $media->error;
							$status["rt"] = 0;
							break;	
					case "max_pause":
							$state = 'max torrent size for Free accounts reached';
							$status["rt"] = 0;
							break;	
					case "put_pause":
							$state = "checking";
							$status["rt"] = 0;
							break;	
					case "put_start":
							$state = "checking";
							$status["rt"] = 0;
							break;
					case "hashing":
							$state = "checking files";
							$status["rt"] = 0;
							break;
					case "stop":
							$state = "something went wrong.";
							$status["rt"] = 0;
							break;		
					case "done":
							$state = "completed";
							$status["rt"] = 0;
							break;						
					case "delete":
							$state = "deleted";
							$status["rt"] = 0;
							break;	
					case "fail_free":
							$state = "took more than 1 hour to download";
							$status["rt"] = 0;
							break;								
					default:

			}
			$status["st"] = $state;
			$response = Response::json(array('result'=>true,'data'=>$status));	
			$response->header('Content-Type', 'application/json');
			return $response;
		}
	}
});

Route::get('torrent/{uniid}/file/{fileid}', function($uniid,$fileid){
	if (Auth::guest()){
		
	}else{
		$user_media =  UserMedia::where('uni_id', '=', $uniid)->where('user_id', '=', Auth::user()->id)->first();
		if(count($user_media) == 0){
		
		}else{
			$media =  Media::where('id', '=', $user_media->media_id)->first();
			$file =  MediaLike::where('id', '=', $fileid)->first();
			
			include_once('/opt/nginx/html/vendor/secure_link.php');
			$URL = new secURL($media->id,$file->id);
			$URL->createlink();
			$file_link = $URL->getlink();
			
			$URL = new secURL($media->id,$file->id,true, '-400');
			$URL->createlink();
			$file_link_conv_400 = $URL->getlink();
			
			$URL = new secURL($media->id,$file->id,true, '-700');
			$URL->createlink();
			$file_link_conv_700 = $URL->getlink();
			
			$file_size = getfilesize($file->size);
			
			$data = array(
				'media'=>$media,
				'link'=>$file_link,
				'link_conv_400'=>$file_link_conv_400,
				'link_conv_700'=>$file_link_conv_700,
				'file'=>$file,
				'file_size'=>$file_size,
				'user_media'=>$user_media);
				

			return View::make('widgets.frame', $data);
		}
	}
});

Route::get('share/{uniid}/file/{fileid}', function($uniid,$fileid){

		$user_media =  ShareMedia::where('uni_id', '=', $uniid)->first();
		if(count($user_media) == 0){
		
		}else{
			$media =  Media::where('id', '=', $user_media->media_id)->first();
			$file =  MediaLike::where('id', '=', $fileid)->where('media_id', '=', $user_media->media_id)->first();
			
			if(isset($file->id)){
				include_once('/opt/nginx/html/vendor/secure_link_share.php');
				if (Auth::guest()){
					$this_user = $user_media->user_id . '-0';
				}else{
					$this_user = $user_media->user_id . '-' . Auth::user()->id;
				}
				$URL = new secURL($media->id,$file->id,false,'',false,$this_user);
				$URL->createlink();
				$file_link = $URL->getlink();
				
				
				$file_size = getfilesize($file->size);
				
				$data = array(
					'media'=>$media,
					'link'=>$file_link,
					'file'=>$file,
					'file_size'=>$file_size,
					'user_media'=>$user_media);
					

				return View::make('widgets.share', $data);
			}
		}
	
});

Route::post('torrent/{uniid}/file/{fileid}/subs', function($uniid,$fileid){
	if (Auth::guest()){
		
	}else{
		$user_media =  UserMedia::where('uni_id', '=', $uniid)->where('user_id', '=', Auth::user()->id)->first();
		if(count($user_media) == 0){
		
		}else{
			$lang = Input::get('l');
			
			$file =  MediaLike::where('id', '=', $fileid)->where('media_id', '=', $user_media->media_id)->first();
			
			if(empty($file)){
				$response = Response::json(array('result'=>false,'location' => false,'error'=>'No file found.'));	
				$response->header('Content-Type', 'application/json');
				return $response;	
			}
			
			$query = $file->name;
			
			try {
				require_once '/opt/nginx/html/vendor/opensub/SubtitlesManager.php';
				$manager = new OpenSubtitles\SubtitlesManager();
				$sub = $manager->getSubtitleUrls($query,$lang);
			} catch (Exception $e) {
				$response = Response::json(array('result'=>false,'location' => false,'error'=>'Opensubtitles.org API not available.'));	
				$response->header('Content-Type', 'application/json');
				return $response;	
			}	
			
			if(empty($sub) || $sub == null){
				$response = Response::json(array('result'=>false,'location' => false,'error'=>'No results found.'));	
				$response->header('Content-Type', 'application/json');
				return $response;			
			}
				
			$response = Response::json(array('result'=>true,'type'=>'subs','data'=>$sub));	
			$response->header('Content-Type', 'application/json');
			return $response;
		}
	}
});

Route::post('torrent/{uniid}/file/{fileid}/convert', function($uniid,$fileid){
	if (Auth::guest()){
		
	}else{
		$user_media =  UserMedia::where('uni_id', '=', $uniid)->where('user_id', '=', Auth::user()->id)->first();
		if(count($user_media) == 0){
				$response = Response::json(array('result'=>false,'location' => false,'error'=>"No access to the file.." ));	
				$response->header('Content-Type', 'application/json');
				return $response;
		}else{
			$preset = Input::get('preset');
			if($preset == 400 || $preset == 700){
				$media =  Media::where('id', '=', $user_media->media_id)->first();
				$file =  MediaLike::where('id', '=', $fileid)->where('media_id', '=',$media->id)->first();
				
				if(empty($file)){
					$response = Response::json(array('result'=>false,'location' => false,'error'=>"File not found." ));	
					$response->header('Content-Type', 'application/json');
					return $response;
				}
				
				if($media->state != 'done'){
					$response = Response::json(array('result'=>false,'location' => false,'error'=>"This file is being downloaded." ));	
					$response->header('Content-Type', 'application/json');
					return $response;
				}
				
				if($file->size > 1073741824){
					$response = Response::json(array('result'=>false,'location' => false,'error'=>"Only files below 1GB can be converted." ));	
					$response->header('Content-Type', 'application/json');
					return $response;
				}
				if($preset == 400 && $file->preset_four){
					$response = Response::json(array('result'=>false,'location' => false,'error'=>"This file has been already converted." ));	
					$response->header('Content-Type', 'application/json');
					return $response;
				}
				
				if($preset == 700 && $file->preset_seven){
					$response = Response::json(array('result'=>false,'location' => false,'error'=>"This file has been already converted." ));	
					$response->header('Content-Type', 'application/json');
					return $response;
				}
				
				$check_preset = MediaConvert::where('media_id', '=',$media->id)->where('file_id', '=',$file->id)->where('preset', '=',$preset)->first();
				
				if(count($check_preset) != 0){
					if($check_preset->state != 'done'){
						$response = Response::json(array('result'=>true,'msg'=>'File is being converted.','data'=>null));	
						$response->header('Content-Type', 'application/json');
						return $response;
					}
				}
				
				$user_conv = MediaConvert::where('user_id', '=',Auth::user()->id)->where('state', '!=','done')->count();
				
				if($user_conv != 0){
					$response = Response::json(array('result'=>false,'location' => false,'error'=>"You have another file being converted." ));	
					$response->header('Content-Type', 'application/json');
					return $response;
				}
				
				$new_convert = new MediaConvert;
				$new_convert->media_id = $media->id;
				$new_convert->file_id = $file->id;
				$new_convert->user_id = Auth::user()->id;
				$new_convert->state = "queue";
				$new_convert->preset = $preset;
				$new_convert->save();
				
				$response = setConvert($file->id,$media->id .'/'. $file->path ,'-'.$preset);
				
				$response = Response::json(array('result'=>true,'msg'=>'File is being converted.','data'=> null));	
				$response->header('Content-Type', 'application/json');
				return $response;
			}else{
					$response = Response::json(array('result'=>false,'location' => false,'error'=>"Pre-set type not found." ));	
					$response->header('Content-Type', 'application/json');
					return $response;	
			}
		}
	}
});

Route::post('torrent/{uniid}/convert/status', function($uniid){
	if (Auth::guest()){
		
	}else{
		$user_media =  UserMedia::where('uni_id', '=', $uniid)->where('user_id', '=', Auth::user()->id)->first();
		
		if(count($user_media) == 0){
			$response = Response::json(array('result'=>false,'location' => false,'error'=>"Request not found." ));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}
		
		$media = Media::where('id', '=',$user_media->media_id)->first();
		
		$media_convert = MediaConvert::where('media_id', '=',$media->id)->get();
		
		$data = array();
		
		foreach($media_convert as $convert){
			$tmp["status"] = $convert->state;
			$tmp["pg"] = $convert->percent;
			$tmp["id"] = $convert->file_id;
			$data[] = $tmp;
		}

		$response = Response::json(array('result'=>true,'data'=>$data));	
		$response->header('Content-Type', 'application/json');
		return $response;
	}
});

Route::post('user/torrents/{uniid}/remove', function($uniid){
	if (Auth::guest()){
		
	}else{
		$user_media =  UserMedia::where('uni_id', '=', $uniid)->where('user_id', '=', Auth::user()->id)->first();
		
		if(count($user_media) == 0){
			$response = Response::json(array('result'=>false,'location' => false,'error'=>"Access denied." ));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}
		
		$media = Media::where('id','=',$user_media->media_id)->first();
		
		if(UserMedia::where('media_id', '=', $media->id)->count() == 1 && $media->state != 'done' && $media->state != 'process'){
			$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
			$input_xml = '<methodCall><methodName>system.multicall</methodName><params><param><value><array><data><value><struct><member><name>methodName</name><value><string>d.set_custom5</string></value></member><member><name>params</name><value><array><data><value><string>'. $media->hash .'</string></value><value><string>1</string></value></data></array></value></member></struct></value><value><struct><member><name>methodName</name><value><string>d.delete_tied</string></value></member><member><name>params</name><value><array><data><value><string>'. $media->hash .'</string></value></data></array></value></member></struct></value><value><struct><member><name>methodName</name><value><string>d.erase</string></value></member><member><name>params</name><value><array><data><value><string>'. $media->hash .'</string></value></data></array></value></member></struct></value></data></array></value></param></params></methodCall>';

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
			
			$media->state = 'delete';
			$media->save();
		}
		
		if($user_media->is_deleted ){
			$user_media->delete();
		}else{
			$user_media->is_deleted = true;
			$user_media->save();
		}
		
		$response = Response::json(array('result'=>true,'location' => false,'data'=>null));	
		$response->header('Content-Type', 'application/json');
		return $response;
	}
});

Route::post('user/torrents/{uniid}/add', function($uniid){
	if (Auth::guest()){
		
	}else{
		$user_media =  UserMedia::where('uni_id', '=', $uniid)->where('user_id', '=', Auth::user()->id)->first();
		
		if(count($user_media) == 0){
			$response = Response::json(array('result'=>false,'location' => false,'error'=>"Access denied." ));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}
		
		$media = Media::where('id','=',$user_media->media_id)->first();
		
		if($media->state == 'delete'){
		
			$url_post = 'http://s01.okaydrive.com/rt/php/addtorrent2.php';
			$myvars = 'torrents_start_stopped=1&url='. $media->source;

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
			
			if($json["result"] == "success"){
					$media->state = 'put_pause';
					$media->save();
			}else{
					$report = new UserFlag;
					$report->media_id = $media->id;
					$report->save();
			}			
		}
		
		if($user_media->is_deleted){
			$user_media->is_deleted = false;
			$user_media->save();
		}
		
		$response = Response::json(array('result'=>true,'location' => false,'data'=>null));	
		$response->header('Content-Type', 'application/json');
		return $response;
	}
});

Route::post('get/subs', function(){
	if (Auth::guest()){
		
	}else{
		$name = Input::get('name'); 
		$path = Input::get('path');
		
		if(empty($path) || empty($name) || $name == '' || $path == ''){
			$response = Response::json(array('result'=>false,'location' => false,'error'=>"Input cannot be empty." ));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}
		
		require_once '/opt/nginx/html/vendor/opensub/SubtitlesManager.php';
		$manager = new OpenSubtitles\SubtitlesManager();
		$sub = $manager->downloadSubtitle($path,$name);

		$response = Response::json(array('result'=>true,'data'=>$sub));	
		$response->header('Content-Type', 'application/json');
		return $response;
	}
});

Route::post('get/subs/file', function(){
	if (Auth::guest()){
		
	}else{
		require('/opt/nginx/html/vendor/upload.php');
		$upload_directory = '/opt/nginx/html/public/uploads/subs';
		$allowed_extensions = array('srt');
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

		$response = Response::json(array('result'=>true,'type'=>'subs_file','data'=>URL::to('/uploads/subs'). '/'.$filename ));	
		$response->header('Content-Type', 'application/json');
		return $response;
	}
});

Route::get('upload', function(){
	if (Auth::guest()){
		
	}else{
		return View::make('widgets.upload');
	}
});

Route::post('upload/search', function(){
	if (Auth::guest()){
		
	}else{
		$q = Input::get('st'); 
		
		if(empty($q) || $q == ''){
			$response = Response::json(array('result'=>false,'location' => false,'error'=>"Input cannot be empty." ));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}
		
        $url = 'http://kickass.to/usearch/'.$q.'/?field=seeders&sorder=desc&rss=1';
        $request = curl_init();
        curl_setopt($request, CURLOPT_ENCODING, "gzip");
        curl_setopt($request, CURLOPT_HEADER, 0);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($request);
        curl_close($request);
		
		if(empty($data)){
			$response = Response::json(array('result'=>false,'location' => false,'error'=>"No results found." ));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}
		
        $dom = new \DOMDocument();
        $dom->loadXML($data);

        $xmlPath = new \DOMXPath($dom);
        $itemPath = $xmlPath->query('*/item');

        $results = array();
		
		if(count($itemPath) == 0){
			$response = Response::json(array('result'=>false,'location' => false,'error'=>"No results found." ));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}
        foreach($itemPath as $item) {
			$result["title"] = $item->getElementsByTagName('title')->item(0)->nodeValue;
			$result["link"] = $item->getElementsByTagName('enclosure')->item(0)->getAttribute('url');
			$result["seeds"] = $item->getElementsByTagNameNS('http://xmlns.ezrss.it/0.1/','seeds')->item(0)->nodeValue;
			$result["peers"] = $item->getElementsByTagNameNS('http://xmlns.ezrss.it/0.1/','peers')->item(0)->nodeValue;
			$result["size"] = getfilesize($item->getElementsByTagNameNS('http://xmlns.ezrss.it/0.1/','contentLength')->item(0)->nodeValue);
            $results[] = $result;
        }

		$response = Response::json(array('result'=>true,'type'=>'torrent_search','data'=>$results));	
		$response->header('Content-Type', 'application/json');
		return $response;
	}
});

Route::post('upload/data', 'MediaController@uploadData');
Route::post('upload/file', 'MediaController@uploadFile');

Route::get('premium', function(){
	if (Auth::guest()){

	}else{
		return View::make('widgets.premium');
	}
});

Route::get('user/settings', function(){
	if (Auth::guest()){

	}else{
			$data = array(
				'avlbytes'=>  getfilesize(Auth::user()->avl_bytes),
				'usedbytes' => getfilesize(Auth::user()->used_bytes),
				'freebytes'=>  getfilesize(Auth::user()->avl_bytes - Auth::user()->used_bytes),
				'perc' => percentage(Auth::user()->used_bytes,Auth::user()->avl_bytes,'1'),
				'plan_name' =>  Auth::user()->category()->name,
				'plan_exp'=> Auth::user()->prem_valid,
				'set_ea' => Auth::user()->ea,
				'set_sub_lng'=> Auth::user()->default_sub_lng);
				
		return View::make('widgets.settings',$data);
	}
});

Route::get('user/share/{id}', function($id){
	if(Auth::user()->category_id == 1 || Auth::user()->category_id == 27){
		
	}else{
		$user_media =  UserMedia::where('uni_id', '=', $id)->where('user_id', '=', Auth::user()->id)->first();
		if(isset($user_media->id)){
				$share_m = ShareMedia::where('user_id','=', Auth::user()->id)->where('media_id','=',$user_media->media_id)->first();
				if(isset($share_m->id)){
					$link = "http://okaydrive.com/share/".$share_m->uni_id;
				}else{
					$media = Media::where('id','=', $user_media->media_id)->first();
					if($media->state == "done"){
						$new_smedia = new ShareMedia;
						$new_smedia->uni_id = uniqid(rand(), true);
						$new_smedia->media_id = $user_media->media_id;
						$new_smedia->user_id = Auth::user()->id;
						$new_smedia->save();
						$link = "http://okaydrive.com/share/".$new_smedia->uni_id;
					}else{
						return View::make('widgets.sharedl');
					}
				}
				$data = array('link' => $link);
			return View::make('widgets.sharebox',$data);
		}
	}
});

Route::get('t', function(){
						$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
				$myvars = 'mode=list-get&hash=504B7A3D8CCF5C9C0FCC2A2E25B6E177A842A2F1';

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
				
				var_dump($tor );
});

Route::post('user/settings/update', function(){
	if (Auth::guest()){

	}else{
		$sub_lng = Input::get('lng');
		if(!Input::has('ea')){
			$ea = false;
		}else{
			$ea = true;
		}
		
		if(Auth::user()->default_sub_lng != $sub_lng || Auth::user()->ea != $ea ){
			Auth::user()->ea = $ea;
			Auth::user()->default_sub_lng = $sub_lng;
			Auth::user()->save();
			
			$response = Response::json(array('result'=>true,'location' => false,'data'=>null, 'msg' => 'Settings has been updated.'));	
			$response->header('Content-Type', 'application/json');
			return $response;
		}
		$response = Response::json(array('result'=>true,'location' => false,'data'=>null, 'msg' => 'No changes made.'));	
		$response->header('Content-Type', 'application/json');
		return $response;
	
	}
});

Route::post('user/account/update', function(){
	if (Auth::guest()){

	}else{
		$input = array_except(Input::all(), '_method');
		
		if(($input['password_new'] == '' && $input['password_current'] == '') || $input['password_new'] == '' || $input['password_current'] == ''){
			$response = Response::json(array('result'=>false,'location' => false,'data'=>null, 'error' => 'Input cannot be empty.'));	
			$response->header('Content-Type', 'application/json');
			return $response;	
		}elseif(isset($input['password_new']) && isset($input['password_current'])){
			if(Hash::check($input['password_current'], Auth::user()->password)){
				Auth::user()->password = Hash::make($input['password_new']);
				Auth::user()->save();	
				
				$response = Response::json(array('result'=>true,'location' => false,'data'=>null, 'msg' => 'Account has been updated'));	
				$response->header('Content-Type', 'application/json');
				return $response;					
			}else{
				$response = Response::json(array('result'=>false,'location' => false,'data'=>null, 'error' => 'Current password does not match.'));	
				$response->header('Content-Type', 'application/json');
				return $response;	
			}
		}else{
			$response = Response::json(array('result'=>false,'location' => false,'data'=>null, 'error' => 'Check the input.'));	
			$response->header('Content-Type', 'application/json');
			return $response;		
		}	
	}
});

Route::get('plan/{name}/summary', function($name){
	if (Auth::guest()){

	}else{

		if($name == '30gold'){
						if(Auth::user()->category_id == 1){
							$date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
							$date->modify('+1 month');
							$update_date = $date->format('Y-m-d');
						}else{
							$date = DateTime::createFromFormat('Y-m-d H:i:s', Auth::user()->prem_valid);
							$date->modify('+1 month');
							$update_date = $date->format('Y-m-d');
						}
			$data = array(
				'name'=>'30 Gold',
				'price'=>'4.99 USD',
				'period'=>'1 Month',
				'valid'=>$update_date,
				'amount'=>'4.99',
				'item_number'=>'2_'.Auth::user()->id,
				'item_period'=>'1',
				'item_period_type'=>'M');
		}elseif($name == '90stack'){
						if(Auth::user()->category_id == 1){
							$date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
							$date->modify('+3 month');
							$update_date = $date->format('Y-m-d');
						}else{
							$date = DateTime::createFromFormat('Y-m-d H:i:s', Auth::user()->prem_valid);
							$date->modify('+3 month');
							$update_date = $date->format('Y-m-d');
						}
			$data = array(
				'name'=>'90 Stack',
				'price'=>'12.99 USD',
				'period'=>'3 Months',
				'valid'=>$update_date,
				'amount'=>'12.99',
				'item_number'=>'3_'.Auth::user()->id,
				'item_period'=>'3',
				'item_period_type'=>'M');
		}elseif($name == '356blast'){
						if(Auth::user()->category_id == 1){
							$date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
							$date->modify('+1 year');
							$update_date = $date->format('Y-m-d');
						}else{
							$date = DateTime::createFromFormat('Y-m-d H:i:s', Auth::user()->prem_valid);
							$date->modify('+1 year');
							$update_date = $date->format('Y-m-d');
						}
			$data = array(
				'name'=>'356 Blast',
				'price'=>'59.99 USD',
				'period'=>'1 Year',
				'valid'=>$update_date,
				'amount'=>'59.99',
				'item_number'=>'4_'.Auth::user()->id,
				'item_period'=>'1',
				'item_period_type'=>'Y');
		}
		return View::make('widgets.summary',$data);
	}
});

Route::get('signin', function(){
	if (Auth::guest()){
		if(Input::has("token")){
			Session::put('authtoken',Input::get("token"));
		}
		return View::make('auth.signin');
	}else{
		if(Input::has("token") && Input::has("auth")){
			$api_key = md5(microtime().rand());
			$token = Input::get("token");
			Auth::user()->token = $token;
			Auth::user()->api_key = $api_key;
			Auth::user()->api_key_date = date("Y-m-d H:i:s");
			Auth::user()->save();
			return  "<script type='text/javascript'> window.close();</script>";
		}
		return Redirect::to('/');
	}
});

Route::get('forgot', function(){
	if (Auth::guest()){
		return View::make('auth.forgot');
	}else{
		return Redirect::to('/');
	}
});

Route::post('forgot', array(
  'uses' => 'UserController@password_request',
  'as' => 'password.request'
));

Route::get('forgot/{token}', array(
  'uses' => 'UserController@password_reset_token',
  'as' => 'password.reset'
));

Route::post('forgot/{token}', array(
  'uses' => 'UserController@password_reset_post',
  'as' => 'password.update'
));


Route::post('signin', 'UserController@signin');

Route::get('signup', function(){
	if (Auth::guest()){
		return View::make('auth.signup');
	}else{
		return Redirect::to('/');
	}
});

Route::post('signup', 'UserController@signup');

Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('/');
});

Route::get('test', function(){
				$c = DB::table('media_files')->where('id','<', 4000)->get();
				foreach($c as $f){

					
					$filepath = '/home/mfs/Downloads/transmission/completed/'.$f->media_id . '/'. mb_escapeshellarg($f->path);
					$fi_size = shell_exec("stat -c '%s' $filepath 2>&1");
					if($f->size_or != (int)$fi_size){
						echo $f->media_id . '-- ';
						echo $f->id . '----' . $f->size_or  . '----' . (int)$fi_size;
						echo '<br>';
					}
					//$f->save();
					
				
				}
				


});

Route::get('test2', function(){
				$url = 'http://s01.okaydrive.com/rt/plugins/httprpc/action.php';
				$myvars = 'mode=list-get&hash=5720CE89CEB5206B8C741C6AF3552AD867F416AF';

				$ch = curl_init( $url );
											$username = 'datalinktunnel';
							$password = 'T52UamGTrmCCGn4fJgyq';
							curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt( $ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,1); 
				curl_setopt($ch, CURLOPT_TIMEOUT, 2); //timeout in seconds
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

				$response = curl_exec( $ch );

				$tor = json_decode($response, true);
									$state = 'stop';	

echo'<pre>';
print_r($tor);
echo'</pre>';

});

Route::get('test02', function(){
$filepath = '/home/mfs/Downloads/transmission/completed/31/Frozen.2013.720p.WEB-DL.H264-PublicHD/Frozen.2013.720p.WEB-DL.H264-PublicHD.mkv';
echo shell_exec("stat -c '%s' $filepath 2>&1");
});

Route::post('test3', function(){					
				$media = Media::where('title', 'LIKE' , '%.meta%')->where('state', '=' , 'done')->get();
				
				foreach($media as $m){
				
						$mediafiles = MediaLike::where('media_id', '=' , $m->id)->get();
						
						foreach($mediafiles as $mf){
							$mf->delete();
						}
						
						$userm = UserMedia::where('media_id', '=', $m->id)->get();
						
						foreach($userm as $mm){
							$mm->delete();
						}
						
					    $m->delete();
				}

});

Route::get('test4', function(){

							$media_users = UserMedia::where('media_id','=','11')->get();
							

							
							foreach($media_users as $media_user){
								$user = User::where('id','=',$media_user->user_id)->first();
								$user_cat = Category::where('id','=',$user->category_id)->first();
								echo $user_cat->max_add;
}
});

Route::post('test9', function(){

					$update = Media::where('hash' , '=' , 'A88EF509425F827998A4FD84AF2D46E020F6510B')->first();
					
				$url = 'http://77.247.178.109/rt/plugins/httprpc/action.php';
				$myvars = 'mode=list-get&hash='.$update->hash;

				$ch = curl_init( $url );
				curl_setopt( $ch, CURLOPT_POST, 1);
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
				curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt( $ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,2); 
				curl_setopt($ch, CURLOPT_TIMEOUT, 4); //timeout in seconds
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

				$response = curl_exec( $ch );

				$tor = json_decode($response, true);
				
								$url = 'http://77.247.178.109/rt/plugins/httprpc/action.php';
								$myvars = 'mode=fls&hash=A88EF509425F827998A4FD84AF2D46E020F6510B';

								$ch = curl_init( $url );
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
								echo "not empty";
											$ignore_first_folder = true;
											$id = 1;
											$paths = array();
											foreach($files as $file){
												echo "foreach";
												var_dump($file);
													if($file[0] != $tor[0].'.meta' && isset($file[0]) && !empty($file[0])){
														echo "inside";
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

});

	
	function percent($num_amount, $num_total) {

		$count1 = $num_amount / $num_total;
		$count2 = $count1 * 100;
		$count = number_format($count2, 0);
		return $count;
	}

	function fullpath($path,$times){
		$full_path = '';
		for($i = 0; $i <= $times;$i++){
			$full_path .= $path[$i] . '/';
		}
		return $full_path;
	}
	
	function getExt($path){
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

Route::get('auth/facebook', 'UserController@facebook');
Route::get('auth/twitter', 'UserController@authTwitter');
Route::get('google', 'UserController@google');
Route::get('yahoo', 'UserController@yahoo');
Route::get('twitter', 'UserController@twitter');
Route::get('facebook', function(){
	$settings = Setting::first();

	$facebook = new Facebook(array(
	  'appId'  => $settings->fb_key,
	  'secret' => $settings->fb_secret_key,
	  'cookie' => true,
	  'oauth' => true,
	));

	$params = array(
	  'scope' => 'email, user_photos',
	  'redirect_uri' => URL::to("auth/facebook"),
	);

	$loginUrl = $facebook->getLoginUrl($params);

     //return to facebook login url
    return Response::make()->header( 'Location', (string)$loginUrl );
});

function slugify($str) {
	// replace non letter or digits by -
	if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
	$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
	$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);
	$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
	$str = strtolower( trim($str, '-') );

	if (empty($str))
	{
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
	}
	   
	return $str;
}

function getfilesize($bytes) {
   if ($bytes >= 1099511627776) {
       $return = round($bytes / 1024 / 1024 / 1024 / 1024, 2);
       $suffix = "TB";
   } elseif ($bytes >= 1073741824) {
       $return = round($bytes / 1024 / 1024 / 1024, 2);
       $suffix = "GB";
   } elseif ($bytes >= 1048576) {
       $return = round($bytes / 1024 / 1024, 2);
       $suffix = "MB";
   } elseif ($bytes >= 1024) {
       $return = round($bytes / 1024, 2);
       $suffix = "KB";
   } else {
       $return = $bytes;
       $suffix = "Byte";
   }
    $return .= " " . $suffix;

   return $return;
}

function getspeed($bytes) {
   if ($bytes >= 1099511627776) {
       $return = round($bytes / 1024 / 1024 / 1024 / 1024, 2);
       $suffix = "TBP";
   } elseif ($bytes >= 1073741824) {
       $return = round($bytes / 1024 / 1024 / 1024, 2);
       $suffix = "GBP";
   } elseif ($bytes >= 1048576) {
       $return = round($bytes / 1024 / 1024, 2);
       $suffix = "MBP";
   } elseif ($bytes >= 1024) {
       $return = round($bytes / 1024, 2);
       $suffix = "KBP";
   } else {
       $return = $bytes;
       $suffix = "Byte";
   }
   if ($return == 1) {
       $return .= " " . $suffix;
   } else {
       $return .= " " . $suffix . "s";
   }
   return $return;
}

function getremain($seconds = 0) {
	$result = '0 Seconds';
	$H = floor($seconds / 3600);
	$i = ($seconds / 60) % 60;
	$s = $seconds % 60;
	if($H != 0 && $i != 0 && $s != 0){
	   //$result = sprintf("%02d Hours %02d Minues %02d Seconds", $H, $i, $s);
	   $result = sprintf("%02d Hours", $H);
	}elseif($i != 0 && $s != 0){
	  $result = sprintf("%02d Minutes %02d Seconds", $i, $s);
	}else{
	  $result = sprintf("%02d Seconds", $s);
	}
   return $result;
}

function perc($double){
return round($double * 100); 
}
	function setConvert($file_id,$path,$preset,$threads = 6){
				$fields = array(
								'path' => urlencode($path),
								'id' => urlencode($file_id),
								't' => urlencode($threads),
								'p'=>urlencode($preset)
						);
		//url-ify the data for the POST
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');


		$process = curl_init();
		$url='http://77.247.178.109/datasrpc/convert';

		curl_setopt($process,CURLOPT_URL, $url);
		curl_setopt($process, CURLOPT_POST, count($fields));
		curl_setopt($process, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
	
	function getConvertInfo($file_id){
				$fields = array(
								'id' => urlencode($file_id)
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
	
	function mb_escapeshellarg($arg)
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return '"' . str_replace(array('"', '%'), array('', ''), $arg) . '"';
		} else {
			return "'" . str_replace("'", "'\\''", $arg) . "'";
		}
	}
	
	function percent2($num_amount, $num_total) {

		$count1 = $num_amount / $num_total;
		$count2 = $count1 * 100;
		$count = number_format($count2, 0);
		return $count;
	}
	
	function percentage($val1, $val2, $precision) 
	{
		$division = $val1 / $val2;

		$res = $division * 100;

		$res = round($res, $precision);
		
		return $res;
	}
	
Route::post('/datasrpc/gt/pp/payment/ipn', function()
{
  define("_VALID_PHP", true);
  define("_PIPN", true);

  ini_set('log_errors', true);
  ini_set('error_log', dirname(__file__) . '/ipn_errors.log');
	
  if (isset($_POST['payment_status'])) {
		  require_once ("/opt/nginx/html/vendor/class_pp.php");

		  $listener = new IpnListener();
		  $listener->use_live = true;
		  $listener->use_ssl = true;
		  $listener->use_curl = false;

		  try {
			  $listener->requirePostMethod();
			  $ppver = $listener->processIpn();
		  }
		  catch (exception $e) {
			  error_log($e->getMessage());
			  exit(0);
		  }

		  $payment_status = $_POST['payment_status'];
		  $receiver_email = $_POST['receiver_email'];
		  list($membership_id, $user_id) = explode("_", $_POST['item_number']);
		  $mc_gross = $_POST['mc_gross'];
		  $txn_id = $_POST['txn_id'];

		  $getxn_id = true;
			$cat = Category::where('order', '=',$membership_id)->first();
			if(isset($cat->id)){	
				 $price = $cat->amount;	
			}
		 
		  $pp_email = 'paypal-datas@mail.ru';

		  $v1 = number_format($mc_gross, 2, '.', '');
		  $v2 = number_format($price, 2, '.', '');

		if ($ppver) {
			if (Input::get('payment_status') == 'Completed') {
				if ($receiver_email == $pp_email && $v1 == $v2 && $getxn_id == true) {

					$user = User::where('id', '=',$user_id)->first();
					if(isset($user->id)){
						if($membership_id != 1 && $membership_id != 100){
								date_default_timezone_set('Pacific/Auckland');
					
								$todays_date = date("Y-m-d H:i:s"); 
								$today = strtotime($todays_date); 
								
								$exp_date = $user->prem_valid;
								$expiration_date = strtotime($exp_date); 
								
								if ($expiration_date > $today) { 
										$date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
										$date->modify('+1 day');
										$date = $date->format('Y-m-d H:i:s');
										$user->category_id = 1;
										$user->prem_valid = $date;
										$user->used_bytes = 0;
										$user->avl_bytes = 1073741824;
										$user->save();	
								}
					
							if($user->category_id == 1){
								$date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
								$date->modify($cat->days);
								$update_date = $date->format('Y-m-d H:i:s');
							}else{
								$user_date = $user->prem_valid;								
								$date = DateTime::createFromFormat('Y-m-d H:i:s', $user_date);
								$date->modify($cat->days);
								$update_date = $date->format('Y-m-d H:i:s');
							}
										
							$user->category_id = $cat->id;
							$user->prem_valid = $update_date;
							$user->avl_bytes = $cat->max_bytes;
							$user->save();
							
							$payment = new Payment;
							$payment->description = $cat->name;
							$payment->amount = $v2;
							$payment->user_id = $user_id;
							$payment->payer_email = $_POST['payer_email'];
							$payment->payment_date = $_POST['payment_date'];
							$payment->payment_id = $_POST['txn_id'];
							$payment->save();
						}
					}
				}
			}else {
			
			}
			

		}

	}
});

Route::post('/datasrpc/tunnel/auth/i', function()
{

	foreach($_POST as $key=>$row){
		$skip = false;
		try{
			if(!isset($_POST[$key]['user'])){
			
				$rel6 = '{(\d+)-(\d+)}';
				preg_match($rel6,$key, $matches_user);
				
				if($matches_user[2] == 1){
					$skip = true;
				}	
				
				if($skip){
				
				}else{
				
					$userid = $matches_user[1];
					$bytes = $row['bytes'];
					$share_bytes = $row['sbytes'];
			
					if($matches_user[2] == 0){
						
					}else{

						$share_user = User::where('id','=', $matches_user[2])->first();
						if(isset($share_user->id)){
							$share_user->used_bytes = $share_user->used_bytes + $share_bytes;
							$share_user->save();
						}
					}
					
					$user = User::where('id','=', $userid)->first();
								
					if(count($user) != 0){
					
						$user->used_bytes = $user->used_bytes + $bytes;
						$user->shared_bytes = $user->shared_bytes + $share_bytes;
						$user->save();
						
						foreach($row['ip'] as $keyip=>$ip_row){
							$ip = $keyip;
							
							foreach($ip_row['media'] as $keymedia=>$media_row){
								$media_id = $keymedia;
								
								foreach($media_row['share'] as $keyshare=>$share_row){
								
									$is_share = $keyshare;
									
									$ip_bytes = $share_row['bytes'];

									date_default_timezone_set('Pacific/Auckland');

									$ip_date = date("Y-m-d"); 
									
									$ip_rec = DataIp::where('ip','=',$ip)->where('date','=',$ip_date)->where('media_id','=',$media_id)->where('shared','=',$is_share)->first();
									
									if($is_share){
										$get_share_report = ShareReport::where('ip', '=', $ip)->where('date','=',$ip_date)->where('media_id', '=', $media_id)->first();
										if(isset($get_share_report->id)){
				
											$get_share_report->bytes = $get_share_report->bytes  + $ip_bytes;
											$get_share_report->perc = percent2($get_share_report->bytes,$get_share_report->size);
											$get_share_report->save();
										
										}else{
											$shareReport = new ShareReport;
											$media = Media::find($media_id);
											if(isset($media->id)){
												$c_code = 'IND'; $c_name = 'India';
												$shareReport->ip = $ip;
												$shareReport->media_id = $media_id;
												$shareReport->user_id = $userid;
												$shareReport->size = $media->size;
												$shareReport->bytes = $ip_bytes;
												$shareReport->perc = percent2($shareReport->bytes,$shareReport->size);
												$shareReport->date = $ip_date;
												try{
													$c_code = geoip_country_code_by_name($ip);
													$c_name = geoip_country_name_by_name($ip);
												}catch(Exception $e) {
													$report = new UserFlag;
													$report->type = 'share update record error';
													$report->media_id = $media_id;
													$report->res = $e->getMessage();
													$report->save();
												}
												$shareReport->country = $c_name;
												$shareReport->country_code = $c_code;
												$shareReport->save();
											}
										}	
									}
									
									if(isset($ip_rec->id)){
										$ip_rec->bytes = $ip_rec->bytes + $ip_bytes;
										$ip_rec->save();
									}else{
										$ip_record = new DataIp;
										$ip_record->user_id = $userid;
										$ip_record->media_id = $media_id;
										$ip_record->ip = $ip;
										$ip_record->bytes = $ip_bytes;
										$ip_record->date = $ip_date;
										$ip_record->shared = $is_share;
										$ip_record->save();
									}
								}
							}
							
							
						}
						

						unset($ip);
						unset($ip_bytes);
					}
					unset($userid);
					unset($bytes);
					unset($user);
				}
			}
		
		}catch(Exception $e) {
			echo 'Message: ' .$e->getMessage();
			$report = new UserFlag;
			$report->type = "data useage update records";
			$report->res = var_export($row, true) . $e->getMessage();
			$report->save();
		}
	}
	

		try{		
			end($_POST);   
			$key = key($_POST);  
			reset($_POST);
			
			$user_tor = $_POST[$key]['torid'];
			$user_pid = $_POST[$key]['user'];
			$user_ip =  $_POST[$key]['ipuser'];
			$auth_ano = $_POST[$key]['anoni'];
			
			$s = check($user_pid,$user_tor, $user_ip, $auth_ano);
			
			$data['status'] = $s;
			
			$data_e = json_encode($data);
			echo $data_e;
		}catch(Exception $e) {
			echo 'Message: ' .$e->getMessage();
			$report = new UserFlag;
			$report->type = "data useage update auth check";
			$report->res = var_export($_POST[$key], true) . $e->getMessage();
			$report->save();
		}
});

Route::post('/api/token/get', function()
{

$token = uniqid();

$response = Response::json(array('result'=>true,'token'=>$token));	
$response->header('Content-Type', 'application/json');
return $response;	

});

Route::post('/api/token/check', function()
{
$result = false;
$key = null;
$token = Input::get("token");
$user = User::where('token','=', $token)->first();
if(count($user) != 0){
	$key = $user->api_key;
	$result = true;
}

$response = Response::json(array('result'=>$result ,'apikey'=>$key));	
$response->header('Content-Type', 'application/json');
return $response;	

});



Route::post('/api/torrent/add', 'MediaController@apiAdd');

function check($id,$file,$user_ip, $auth_ano = false){
	$status = false;

	$id_user = $id;
	$id_file = $file;


	
	try{
			if($auth_ano){

								date_default_timezone_set('Pacific/Auckland');
	
								$ip_date = date("Y-m-d"); 
								$media = Media::find($id_file);
								$size_f =  $media->size;
									
								$ip_bytes = DataIp::where('ip','=',$user_ip)->where('date','=',$ip_date)->sum('bytes');
								
										if($size_f < (4294967296 - $ip_bytes)){
												$status = true;
										}else{
												$status = false;
										}
			}else{
	
				$user = User::where('id','=', $id_user)->first();
				
				if(count($user) != 0){
								
						$useage = $user->used_bytes;
						
						$media = Media::find($id_file);
						
						
						if(count($media) != 0){
								
								date_default_timezone_set('Pacific/Auckland');
								
								$todays_date = date("Y-m-d H:i:s"); 
								$today = strtotime($todays_date); 
								
								$exp_date = $user->prem_valid;
								$expiration_date = strtotime($exp_date); 
								
								if ($expiration_date > $today) { $active = true; } else { $active = false; }
							
							
							if ($active) {
									
									if($useage <  $user->avl_bytes){
										
										$size_f =  $media->size;
									
										
										if($size_f < ($user->avl_bytes - $useage)){
												$status = true;
										}
									}
									
							}else {
							
									$date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
									$date->modify('+1 day');
									$date = $date->format('Y-m-d H:i:s');
									
									if($user->category_id != 1){
										$user->last_prem = date("Y-m-d H:i:s");
									}
									$user->category_id = 1;
									$user->prem_valid = $date;
									$user->used_bytes = 0;
									$user->avl_bytes = 1073741824;
									
									$user->save();	
									
									$useage = $user->used_bytes;
									
									if($useage < $user->avl_bytes){
									
										$size_f =  $media->size;
										
										
										if($size_f < ($user->avl_bytes - $useage)){
												$status = true;
										}
									}			
							}
							
							if($user->category_id == 1){
							
								date_default_timezone_set('Pacific/Auckland');

								$ip_date = date("Y-m-d"); 
								$size_f =  $media->size;
								
								$ip_bytes = DataIp::where('ip','=',$user_ip)->where('date','=',$ip_date)->sum('bytes');
								
										if($size_f < (1073741824 - $ip_bytes)){
												$status = true;
										}else{
											$status = false;
										}
							}
						}
				}
			}
		}catch(Exception $e) {
			echo 'Message: ' .$e->getMessage();
			$report = new UserFlag;
			$report->type = "data useage check auth";
			$report->res = $e->getMessage();
			$report->save();
		}
	return $status;
}
