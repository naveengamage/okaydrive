@extends('layouts.master')
@section('content')
		<div id="main" role="main">
		@if($media->files()->count() == 0)
		    <p class='message' id='ErrorMessage'>
				Files will be loaded as soon as they are available.
			</p>
		@endif		
		@if($media->state == 'fail_free')
		    <p class='message' id='ErrorMessage'>
				This torrent took more than 1 hour to download, most likely it has less seeders. Upgrade to premium to keep your torrents active even they have less seeders.
			</p>
		@endif
		@if($media->state == 'max_pause')
		    <p class='message' id='ErrorMessage'>
				This torrent is has exceeded the file size allowed for free accounts. Upgrade your account to premium to enjoy unlimited size torrents. 
			</p>
		@endif
		<?php
			$status = false;
			
			$useage = Auth::user()->used_bytes;
			
			if($useage < Auth::user()->avl_bytes){
			
				$size_f =  $media->size;
				
				
				if($size_f < (Auth::user()->avl_bytes - $useage)){
						$status = true;
				}
			}
			if(Auth::user()->category_id == 1){
			
				date_default_timezone_set('Pacific/Auckland');

				$ip_date = date("Y-m-d"); 
				$size_f =  $media->size;
				
				$ip_bytes = DataIp::where('ip','=',$_SERVER['REMOTE_ADDR'])->where('date','=',$ip_date)->sum('bytes');
				
						if($size_f < (1073741824 - $ip_bytes)){
								$status = true;
						}else{
							$status = false;
						}
			}
		?>
		
		@if(!$status && $media->state == 'done')
			<p class='message' id='ErrorMessage'>
				You do not have enough bandwidth left to download this file. Upgrade your account to premium to download without limits.
			</p>
		@endif
			<ul id="tiles">
<?php $folders_array = array();  $files_array = array();?>			
@foreach($media->files()->where('in','=', $current)->get() as $file)
	<?php
										$path_info = pathinfo($file->path);
										if(isset($path_info['extension'])){
											$ext = $path_info['extension'];
										}else{
											$ext = "";
										}
										$extension = strtolower($ext);
										$downloading = $media->downloading();
										if($file->type == "conv"){
											$extension = "mp4";
										}
												switch ($extension) {
														case "jpg":
														case "png":
														case "gif":
														case "bmp":
																		include_once('/opt/nginx/html/vendor/secure_link.php');
																		$URL = new secURL($media->id,$file->id);
																		$URL->createlink();
																		$link_image = $URL->getlink();
																		$filetype   = "image";
																		if($downloading){
																			$actionfile = "<img src=\"/include/img/filetype/image.png\" height=\"130\" width=\"130\">";
																		}else{
																			$actionfile = "<img src=\"/cache/thumbs/$file->id.jpg\" height=\"130\" width=\"130\">";
																		}
																		$actionlink = "<a class=\"frame fancybox.image\" id=\"$file->id\" href=\"$link_image\">";
																		$showthis = 1;	
																		break;	
														case "ogg":
														case "flv":
														case "mp4":
														case "flv":
																		$filetype   = "video";
																		if($downloading){
																			$actionfile = "<img src=\"/include/img/filetype/video-format-play.png\" height=\"130\" width=\"130\">";
																		}else{
																			$actionfile = "<img src=\"/snaps/thumbs/$media->id/$file->id/1.jpg\" height=\"130\" width=\"130\"><span class=\"play-img\"></span>";
																		}
																		$actionlink = "<a class=\"nbsmbox fancybox.ajax\" id=\"$file->id\" href=\"/torrent/$user_media->uni_id/file/$file->id\">";
																		$showthis = 1;
																		break;	
														case "3gp":
														case "mkv":
														case "avi":
														case "mpeg":
														case "mpg":
																		$convert_prog = 0;
																		$file_convert = $file->fileConvert();
																			if($downloading){
																				$actionfile = "<img src=\"/include/img/filetype/video-format-nonp.png\" height=\"130\" width=\"130\">";
																			}else{
																				if(!empty($file_convert)){
																					$convert_prog = $file_convert->percent;
																					$actionfile = "<img src=\"/snaps/thumbs/$media->id/$file->id/1.jpg\" height=\"130\" width=\"130\"><span class=\"prog-text\">$convert_prog %</span>";
																				}else{
																					$actionfile = "<img src=\"/snaps/thumbs/$media->id/$file->id/1.jpg\" height=\"130\" width=\"130\"><span class=\"prog-text\"></span>";
																				}
																			}
																		$filetype   = "video";
																		$actionlink = "<a class=\"nbsmbox fancybox.ajax\" id=\"$file->id\" href=\"/torrent/$user_media->uni_id/file/$file->id\">";
																		$showthis = 1;
																		break;		
														case "mp3":
																		include_once('/opt/nginx/html/vendor/secure_link.php');
																		$URL = new secURL($media->id,$file->id);
																		$URL->createlink();
																		$link_music = urlencode($URL->getlink());
																		$filetype   = "sound";
																		$actionfile = "<img src=\"/include/img/filetype/music.png\" height=\"130\" width=\"130\">";
																		$actionlink = "<a class=\"nbsmbox fancybox.ajax\" id=\"$file->id\" href=\"/torrent/$user_media->uni_id/file/$file->id\">";
																		if(!$downloading){
																			$actionfile .= "<div class=\"fl-au-player\">
																								<object type=\"application/x-shockwave-flash\" data=\"/include/player/player_mp3_maxi.swf\" width=\"25\" height=\"20\">
																									<param name=\"movie\" value=\"/include/player/player_mp3_maxi.swf\" />
																									<param name=\"bgcolor\" value=\"#ffffff\" />
																									<param name=\"FlashVars\" value=\"mp3=$link_music&amp;width=25&amp;showslider=0&amp;bgcolor1=444444&amp;bgcolor2=444444&amp;buttonovercolor=dddddd&bgcolor=7d7d7d\" />
																								</object>
																							</div>";
																		}
																		$showthis = 1;
																		break;																		
														default:
																		$filetype   = "other";
																		$actionlink = "<a class=\"nbsmbox fancybox.ajax\" id=\"$file->id\" href=\"/torrent/$user_media->uni_id/file/$file->id\">";
																		$actionfile = "<img src=\"/include/img/filetype/other.png\" height=\"130\" width=\"130\">";
																		$showthis = 1;
												}
												
												if (strlen($file->name) <= 19) {
																$filestamp = $file->name;
												} else {
																if($file->name[15] != ' '){ $file->name = wordwrap( $file->name,20,' ',true);}
																$filestamp = substr($file->name,0 ,40) . "...";
												}
												
												if ($showthis){
													echo "<li class=\"media-tile $filetype\">$actionlink$actionfile</a>$actionlink<p>" . $filestamp . "</p></a></li>";
												}
	?>

													

@endforeach
@foreach($media->folders()->where('in','=', $current)->get() as $folder)
				<li class="media-tile folder" style="position: absolute; top: 0px; left: 61px; display: list-item;">
					<a href="/torrent/{{$user_media->uni_id}}?d={{$folder->folder_id}}&b={{$current}}" >
					<img src="/include/img/filetype/folder.png" height="130" width="130"></a>
					<a href="/torrent/{{$user_media->uni_id}}d={{$folder->folder_id}}&b={{$current}}"><p>{{ $folder->name }}</p></a>
				</li>
@endforeach
				
		    </ul>
		</div>
			<?php
			if(!$media->downloading() && $media->max_file_id != 0){
				$thumb_views = array();
					$frames= 13;
					for ($k = 1 ; $k < $frames; $k++){ 
							$thumb_set["thumb"] = 'snaps/thumbs/'.$media->id .'/'. $media->max_file_id .'/'.$k.'.jpg';
							$thumb_set["big"] = 'snaps/big/'.$media->id .'/'. $media->max_file_id .'/'.$k.'.jpg';
							$thumb_views[] = $thumb_set;
					}
					$files_vid =  MediaLike::where('media_id', '=', $media->id)->where('type', '=', 'vid')->where('type', '=', 'vid-conv')->get();
					foreach($files_vid as $file_vid){
							$thumb_set["thumb"] = 'snaps/thumbs/'.$media->id .'/'. $file_vid->id .'/1.jpg';
							$thumb_set["big"] = 'snaps/big/'.$media->id .'/'. $file_vid->id .'/1.jpg';
							$thumb_views[] = $thumb_set;
					}
			}
			?>
		<div id="bottom">
			@if($media->downloading())
			<div id="con" style="background: #f5f5f5;overflow: hidden;height:150px;">
					<div style="text-align:center; margin:0 auto; ">
						<div class="stat-bt" style="display:inline-block;margin-top:5px;vertical-align: middle;">
								<input type="text" value="0" data-width="135" data-height="135" class="knob">		
						</div>
						<div  style="display:inline-block;vertical-align: middle;margin-left:10px;"> 
							<h3 class="wra-text"><span class="d-stat">loading</span> : <span class="d-perc">----%</span></h3> 
							<h4 class="wra-text" id="d-text">Speed:&nbsp; <span class="d-speed">0</span>&nbsp;&nbsp;&nbsp;&nbsp;Seeders:&nbsp;<span class="d-seeds">0</span>&nbsp;&nbsp;&nbsp;&nbsp;Remain:&nbsp;<span class="d-rt">0</span>&nbsp;&nbsp;&nbsp;&nbsp;Size:&nbsp;<span class="d-size">0</span></h4>	
						</div>
					</div>
			</div>	
			@else	
				@if($media->max_file_id != 0)
					<div id="con" style="background: #f5f5f5;overflow: hidden;height:135px;">
						<div id="slider" class="slider-horizontal">
							@foreach($thumb_views as $thumb_view)
								<div class="item item-1"><a href="{{URL::to($thumb_view["big"])}}" class="fancybox-thumb" rel="fancybox-thumb" title=""><img width="150px" height="100px" src="{{ URL::to($thumb_view["thumb"])}}"></a></div>
							@endforeach
						</div>	
					</div>	
				@endif
			
			@endif
		</div>	
			@if($media->downloading())
			<script src="{{ URL::asset('include/js/jquery.knob.js') }}"></script>
			<script>$(function() { $(".knob").knob({readOnly: true});});</script>
			<script>
			setInterval(function()
				{ 
					$.ajax({
					  type:"post",
					  url:"{{URL::to("torrent/$user_media->uni_id/status")}}",
					  datatype:"html",
					  success:function(data)
					  {
						$('.d-stat').html(data.data.st);
						$('.d-seeds').html(data.data.se);
						$('.d-speed').html(data.data.sp);
						$('.d-rt').html(data.data.rt);
						$('.d-size').html(data.data.si);
						$('.d-perc').html(data.data.pr+'%');
						$('.knob').val(data.data.pr).trigger('change');
						if(data.data.st == 'completed') location.reload(false);
					  }
					});
				}, 4000);
			
			</script>
			@else
			<script>
				jQuery(document).ready(function(e){FlowSlider("#slider",{startPosition:0,position:.1,marginStart:50,marginEnd:100,controllerOptions:[{mouseStart:0,mouseEnd:100}]})})
			</script>
			@endif
@stop