@extends('layouts.master')
@section('content')
		<div id="main" role="main">
			<ul id="tiles">
<?php $folders_array = array();  $files_array = array();?>			
@foreach($media->files()->where('in','=', $current)->get() as $file)
	<?php
										$path_info = pathinfo($file->path);
										$extension = strtolower($path_info['extension']);
										$downloading = $media->downloading();
										if($file->type == "conv"){
											$extension = "mp4";
										}
												switch ($extension) {
														case "jpg":
														case "png":
														case "gif":
														case "bmp":
						
																		$filetype   = "image";
																		if($downloading){
																			$actionfile = "<img src=\"/include/img/filetype/image.png\" height=\"130\" width=\"130\">";
																		}else{
																			$actionfile = "<img src=\"/cache/thumbs/$file->id.jpg\" height=\"130\" width=\"130\">";
																		}
																		$actionlink = "<a id=\"$file->id\" href=\"/share/$user_media->uni_id/file/$file->id\">";
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
																		$actionlink = "<a id=\"$file->id\" href=\"/share/$user_media->uni_id/file/$file->id\">";
																		$showthis = 1;
																		break;	
														case "3gp":
														case "mkv":
														case "avi":
														case "mpeg":
														case "mpg":
																		
																			if($downloading){
																				$actionfile = "<img src=\"/include/img/filetype/video-format-nonp.png\" height=\"130\" width=\"130\">";
																			}else{
																					$actionfile = "<img src=\"/snaps/thumbs/$media->id/$file->id/1.jpg\" height=\"130\" width=\"130\"><span class=\"prog-text\"></span>";
																				
																			}
																		$filetype   = "video";
																		$actionlink = "<a id=\"$file->id\" href=\"/share/$user_media->uni_id/file/$file->id\">";
																		$showthis = 1;
																		break;		
														case "mp3":
																		include_once('/opt/nginx/html/vendor/secure_link.php');
																		$URL = new secURL($media->id,$file->id);
																		$URL->createlink();
																		$link_music = urlencode($URL->getlink());
																		$filetype   = "sound";
																		$actionfile = "<img src=\"/include/img/filetype/music.png\" height=\"130\" width=\"130\">";
																		$actionlink = "<a id=\"$file->id\" href=\"/share/$user_media->uni_id/file/$file->id\">";
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
																		$actionlink = "<a id=\"$file->id\" href=\"/share/$user_media->uni_id/file/$file->id\">";
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
					<a href="/share/{{$user_media->uni_id}}?d={{$folder->folder_id}}&b={{$current}}" >
					<img src="/include/img/filetype/folder.png" height="130" width="130"></a>
					<a href="/share/{{$user_media->uni_id}}d={{$folder->folder_id}}&b={{$current}}"><p>{{ $folder->name }}</p></a>
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
	
				@if($media->max_file_id != 0)
					<div id="con" style="background: #f5f5f5;overflow: hidden;height:135px;">
						<div id="slider" class="slider-horizontal">
							@foreach($thumb_views as $thumb_view)
								<div class="item item-1"><a href="{{URL::to($thumb_view["big"])}}" class="fancybox-thumb" rel="fancybox-thumb" title=""><img width="150px" height="100px" src="{{ URL::to($thumb_view["thumb"])}}"></a></div>
							@endforeach
						</div>	
					</div>	
				@endif
			

		</div>	
			<script>
				jQuery(document).ready(function(e){FlowSlider("#slider",{startPosition:0,position:.1,marginStart:50,marginEnd:100,controllerOptions:[{mouseStart:0,mouseEnd:100}]})})
			</script>



@stop