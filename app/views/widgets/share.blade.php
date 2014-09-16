@extends('layouts.master')
@section('content')

		<div class="wrapper-gn-f">
			<div class="file">

				<h4>{{ $file->name}}</h4>
				
				
												<?php
												
											$file_type = $file->type;
										$path_info = pathinfo($file->path);
										$extension = strtolower($path_info['extension']);
										
											switch ($extension) {
													case "jpg":
													case "png":
													case "gif":
													case "bmp":
																$thefile = $link;
																echo "<a href=\"$thefile\" target=\"_blank\"><img src=\"$thefile\" /></a>";
																break;
													case "mp4":
													case "flv":
															echo "<script src=\"http://okaydrive.com/include/js/flowplayer-3.2.13.min.js\"></script>";
															$thefile = $link;
															$thesnap = 'http://okaydrive.com/snaps/big/'.$media->id .'/'.$file->id .'/1.jpg';
															$play_cont = "<img width=\"496\" height=\"250\" src=\"$thesnap\"><div id=\"play\"></div>";
															echo "<div class=\"videoplayer_wrapper\" ><a id=\"player\">".$play_cont."</a></div>";
															echo "<script language=\"JavaScript\"> 

																$( '#player' ).click(function() {
																$('#player img').remove();
																 $('#play').remove(); 
																  flowplayer(\"player\", \"http://okaydrive.com/include/swf/flowplayer.commercial-3.2.18.swf\", {
																	// commercial version license key
																	key: '#$471cb004f588991175c',
																	plugins: {
																		pseudo: {
																			url: \"http://okaydrive.com/include/swf/flowplayer.pseudostreaming-3.2.12.swf\"
																		}
																	},
																	clip: {
																		// our clip uses pseudostreaming
																		provider: 'pseudo',
																		url: \"".$thefile."\",
																		autoPlay: true
																	}

																});
																});


																</script>";
																break;
													case "mp3":
													
													
																break;				
													default:
													
																break;
														
												}
												?>
												
	
				<div class="fl-info">
					<?php $path_info = pathinfo($file->path); if(!isset($path_info['extension'])){ $path_ext = '';}else{ $path_ext = '.'.$path_info['extension']; } ?>
					<h2>Size: {{$file_size}}</h2>
					<h2>Date: {{ date( 'm/d/y g:i A', strtotime($file->created_at)) }}</h2>
					<h2>Type: {{ $path_ext }}	</h2>
				</div>
				<div class="fl-button">
					<a href="{{$link}}" target="_blank"><button>Download</button></a>
					<button onclick="showhide('share-wrapper'); return(false);">Share</button>
				</div>
				<div style="clear: both"></div>
				<div style="display: none; z-index: 99" id="share-wrapper">
					<input type="text" name="share-link" readonly="readonly" value="{{Request::url();}}" onclick="this.focus(); this.select();" />
					<div class="social-share">
						<a href="https://twitter.com/intent/tweet?source=webclient&text={{Request::url();}}" target="_blank"><div class="twitter-ico-38"></div></a>
						<a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url();}}" target="_blank"><div class="facebook-ico-38"></div></a>
						<div style="clear: both"></div>
					</div>
					<div style="clear: both"></div>
				</div>
				<script src="//go.padstm.com/?id=39754"></script>
			</div>
		</div>

	<script type="text/javascript">
				$(document).ready(function () {
					$('#nav li').hover(
						function () {
							//mostra sottomenu
							$('ul', this).stop(true, true).delay(50).slideDown(100);
 
						}, 
						function () {
							//nascondi sottomenu
							$('ul', this).stop(true, true).slideUp(200);        
						}
					);
				});
	</script>
	<script language="javascript" type="text/javascript"> 
		function showhide(id){ 
			if (document.getElementById){ 
			obj = document.getElementById(id); 
				if (obj.style.display == "none"){ 
				obj.style.display = ""; 
				} else { 
				obj.style.display = "none"; 
				} 
			} 
		} 
	</script>

	@stop