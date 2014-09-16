<script src="{{ URL::asset('include/js/jquery.form.js') }}"></script> 
<style>
.fluid-width-video-wrapper {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100% !important;
    height: 90% !important;
}
body {
    overflow:hidden;
}
.container h1{
	margin-top: 20px;
}

h1, .container h2,.container p,.container a,.container ol,.container ul,.container li,
.container fieldset,.container form,.container label,.container legend,.container table {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}

.container {
	color: white;
	font-family: 'Titillium Web', sans-serif;
	line-height: 1;
}

.container ol,.container ul {
	list-style: none;
}

table {
	border-collapse: collapse;
	border-spacing: 0;
}


.flat-form {
  background: #4e9add;
  margin: 0 auto;
  width: 580px;
  height: 420px;
  position: relative; 
  font-family: 'Cabin Condensed', sans-serif;
}
.tabs {
  background: #3072A8;
  height: 40px;
  margin: 0;
  padding: 0;
  list-style-type: none;
  width: 100%;
  position: relative;
  display: block;
  margin-bottom: 20px;
}
.tabs li {
  display: block;
  float: left;
  margin: 0;
  padding: 0;
}
.tabs a {
  font-family: 'Titillium Web', sans-serif; 
  background: #3072A8;
  display: block;
  float: left;
  text-decoration: none;
  color: white;
  font-size: 16px;
  padding: 12px 22px 12px 22px;
  /*border-right: 1px solid @tab-border;*/

}

.tabs a.active {
  background: #4e9add;
  border-right: none;
  -webkit-transition: all 0.5s linear;
	-moz-transition: all 0.5s linear;
	transition: all 0.5s linear;
}
.form-action {
  padding: 0 20px;
  position: relative;
}

.form-action h1 {
  font-size: 42px;
  padding-bottom: 10px;
}
.form-action h2 {
  font-size: 25px;
  padding-bottom: 20px;
}
.form-action p {
  font-size: 12px;
  padding-bottom: 10px;
  line-height: 25px;
}
form {
  padding-right: 20px !important;
}
form input[type=file],
form input[type=text],
form input[type=password],
form input[type=submit] {
  font-family: 'Titillium Web', sans-serif;
}

form input[type=text],
form input[type=password] {
  width: 100%;
  height: 40px;
  margin-bottom: 10px;
  padding-left: 15px;
  background: #fff;
  border: none;
  color: #e74c3c;
  outline: none;
}
form input[type=file]{
  width: 100%;
  height: 40px;
  margin-bottom: 10px;
  padding-left: 0;
  border: none;
  outline: none;
}
.dark-box {
  background: #5e0400;
  box-shadow: 1px 3px 3px #3d0100 inset;
  height: 40px;
  width: 50px;
}
.form-action .dark-box.bottom {
  position: absolute;
  right: 0;
  bottom: -24px;
}
.tabs + .dark-box.top {
  position: absolute;
  right: 0;
  top: 0px;
}
.show {
  display: block;
}
.hide {
  display: none;
}

.button {
    border: none;
    display: block;
    background: #136899;
    height: 40px;
    width: 80px;
    color: #ffffff;
    text-align: center;
    border-radius: 5px;
    /*box-shadow: 0px 3px 1px #2075aa;*/
  	-webkit-transition: all 0.15s linear;
	  -moz-transition: all 0.15s linear;
	  transition: all 0.15s linear;
}

.button:hover {
  background: #1e75aa;
  /*box-shadow: 0 3px 1px #237bb2;*/
}

.button:active {
  background: #136899;
  /*box-shadow: 0 3px 1px #0f608c;*/
}

::-webkit-input-placeholder {
  color: #e74c3c;
}
:-moz-placeholder {
  /* Firefox 18- */
  color: #e74c3c;
}
::-moz-placeholder {
  /* Firefox 19+ */
  color: #e74c3c;
}
:-ms-input-placeholder {
  color: #e74c3c;
}


.result-s {
  margin: 20px;
  height: 352px;
  overflow:auto;
  overflow-x: hidden;
}

.result-s ul {
  list-style-type: none;
  width: 500px;

}

.result-s h3 {

  margin: 0; padding: 0;
}

.result-s li button {
  float: right;
  margin: 0 15px 0 0;
}

.result-s li {
  padding: 10px;
  overflow: auto;
}

.result-s li:hover {
  background: #3f81bc;
  cursor: pointer;
}
</style>
@if($media->downloading())
		<script>
		  var SHOW_CLASS = 'show',
			  HIDE_CLASS = 'hide',
			  ACTIVE_CLASS = 'active';
		  
		  $( '.tabs' ).on( 'click', 'li a', function(e){
			e.preventDefault();
			var $tab = $( this ),
				 href = $tab.attr( 'href' );
		  
			 $( '.active' ).removeClass( ACTIVE_CLASS );
			 $tab.addClass( ACTIVE_CLASS );
		  
			 $( '.show' )
				.removeClass( SHOW_CLASS )
				.addClass( HIDE_CLASS )
				.hide();
			
			  $(href)
				.removeClass( HIDE_CLASS )
				.addClass( SHOW_CLASS )
				.hide()
				.fadeIn( 550 );
		  });
		  
		</script>
		</head>
		<body>
			<div class="container">
				<div class="flat-form" style="width:320px !important;height:200px !important;">
					<ul class="tabs">
						<li>
							<a href="#download" class="active">Message</a>
						</li>
						<li>
							<a href="#info">Info</a>
						</li>
					</ul>            
					<div id="download" class="form-action show">
						<h3>This file is being downloaded.</h3>
						<p>
							Size: {{$file_size}}  <br><br>
						</p>

			   
					</div>  
					<div id="info" class="form-action hide">
						<h1>File Info</h1>
						<p>
							Name: {{$file->name}} <br>
							Size: {{$file_size}} <br>
						</p>
					</div>
					<!--/#register.form-action-->
				</div>
			</div>	
@else
		@if($file->type == "vid" || $file->type == "conv")
			@if(!$media->downloading())
			<?php $media_info = MediaInfo::where('media_id', '=', $media->id)->where('file_id', '=', $file->id)->first(); ?>
			@endif
		<script type="text/javascript" src="{{ URL::asset('include/js/flowplayer-3.2.13.min.js') }}"></script>
		<script>
		  var SHOW_CLASS = 'show',
			  HIDE_CLASS = 'hide',
			  ACTIVE_CLASS = 'active',
			  HIDDEN = false;
		  
		  $( '.tabs' ).on( 'click', 'li a', function(e){
			e.preventDefault();
			var $tab = $( this ),
				 href = $tab.attr( 'href' );
		  
			 $( '.active' ).removeClass( ACTIVE_CLASS );
			 $tab.addClass( ACTIVE_CLASS );
		  

			 $( '.show' )
				.removeClass( SHOW_CLASS )
				.addClass( HIDE_CLASS )
				.hide();
			
				
			if(href != "#player-tab"){
				if(!HIDDEN){
					flowplayer("player").hide();
					HIDDEN = true;
				}
			  $(href)
				.removeClass( HIDE_CLASS )
				.addClass( SHOW_CLASS )
				.hide()
				.fadeIn( 550 );
			}else{
				flowplayer("player").show();		
				HIDDEN = false;
			}
			
		  });
		  
		  
			$('body').on('click', '.result-s li', function() {
					$(this).find("form").ajaxSubmit({		
						success: function(xhr) {
							if(xhr.error){
								toastr.error(xhr.error);
							}else{
								flowplayer("player").getPlugin('captions').loadCaptions(0, xhr.data);
								toastr.success("Subtitles has been added.");
								$( '.sub-off' ).show();
								$('#play-tab').click();
							}
						}
					});
			});
		  
		  $('form').ajaxForm({
				beforeSend: function() {
					$.fancybox.showLoading();
				},
				uploadProgress: function(event, position, total, percentComplete) {

				},
				success: function(xhr) {
					if(xhr.error){
						toastr.error(xhr.error);
					}else{
						if(xhr.msg){
							toastr.success(xhr.msg);
						}
						if(xhr.type == "subs"){
							$( '.active' ).removeClass( 'active' );
							$( '.sub-tab' ).show();				
							$( '.sub-tab' ).children("a").addClass( 'active' );
							$( '.show' ).removeClass( 'show' ).addClass( 'hide' ).hide();
							$( '.sub-result' ).removeClass( 'hide' ).addClass( 'show' ).hide().fadeIn( 550 );
							$( ".result-s ul" ).empty();
							$.each(xhr.data, function() {
								var strHTML = $('#tpl_sub').html();
								var m = strHTML.match(/##([\w]+)##/g), data = this;
								for(var i=0; i<m.length; i++) {
									var mv = m[i].substring(2, m[i].length-2);
									strHTML = strHTML.replace(m[i], data[mv]);
								}
								$( ".result-s ul" ).append(strHTML);
							});
							
						}else if(xhr.type == "subs_file"){
								flowplayer("player").getPlugin('captions').loadCaptions(0, xhr.data);
								toastr.success("Subtitles has been added.");
								$( '.sub-off' ).show();
								$('#play-tab').click();
						}
					}			
				},
				complete: function(xhr) {
					$.fancybox.hideLoading();
				}
			}); 
			


		</script>
		</head>
		<body>
			<div class="container">
				<div class="flat-form">
					<ul class="tabs">
						<li>
							<a id="play-tab" href="#player-tab" class="active">Play</a>
						</li>
						<li>
							<a href="#download">Download</a>
						</li>
						<li>
							<a href="#subs">Subtitles</a>
						</li>
						<li>
							<a href="#info">Info</a>
						</li>
						<li class="sub-tab" style="display:none;">
							<a href="#results">Results</a>
						</li>
					</ul>            
					<div id="player-tab" style="display: block;" class="form-action-player">
							 <div class="fluid-width-video-wrapper">
									<a  style="width:100%;height:100%" id="player">
									 </a>
							</div>
			   
					</div>  

					<div id="download" class="form-action hide">
						  <h1>Download</h1>
						<p>
							Size: {{$file_size}} <br>
						</p>
							<ul>
										 <li style="padding-top: 20px;">
												<a href="{{$link}}"><button class="button">Download</button></a>
										</li>
							</ul>
					</div>

					<div id="subs" class="form-action hide">
					<button class="button sub-off" onclick="flowplayer('player').getPlugin('captions').loadCaptions(0, 'http://okaydrive.com/uploads/subs/empty.srt');toastr.success('Subtitles has been removed.');$( '.sub-off' ).hide();" style="display:none;float: right; position: relative; top: 10px; right: 10px;">Turn Off</button>
					<h1>Subtitles</h1>

					<h2 style="padding-top: 10px;">Search</h2>
					
					<form action="/torrent/{{$user_media->uni_id}}/file/{{$file->id}}/subs" method="post">
						<ul> 
							<li style="padding-bottom: 20px;" >
								<label> Select language </label>
								<?php list($lng_code, $lng_name) = explode(",", Auth::user()->default_sub_lng); ?>
								<select name="l">
								<option value="{{$lng_code}}">{{$lng_name}}</option>
								<option value="all">ALL</option>
								<option value="afr">Afrikaans</option>
								<option value="alb">Albanian</option>
								<option value="ara">Arabic</option>
								<option value="arm">Armenian</option>
								<option value="baq">Basque</option>
								<option value="bel">Belarusian</option>
								<option value="ben">Bengali</option>
								<option value="bos">Bosnian</option>
								<option value="pob">Portuguese-BR</option>
								<option value="bre">Breton</option>
								<option value="bul">Bulgarian</option>
								<option value="bur">Burmese</option>
								<option value="cat">Catalan</option>
								<option value="chi">Chinese</option>
								<option value="hrv">Croatian</option>
								<option value="cze">Czech</option>
								<option value="dan">Danish</option>
								<option value="dut">Dutch</option>
								<option value="eng">English</option>
								<option value="epo">Esperanto</option>
								<option value="est">Estonian</option>
								<option value="fin">Finnish</option>
								<option value="fre">French</option>
								<option value="glg">Galician</option>
								<option value="geo">Georgian</option>
								<option value="ger">German</option>
								<option value="ell">Greek</option>
								<option value="heb">Hebrew</option>
								<option value="hin">Hindi</option>
								<option value="hun">Hungarian</option>
								<option value="ice">Icelandic</option>
								<option value="ind">Indonesian</option>
								<option value="ita">Italian</option>
								<option value="jpn">Japanese</option>
								<option value="kaz">Kazakh</option>
								<option value="khm">Khmer</option>
								<option value="kor">Korean</option>
								<option value="lav">Latvian</option>
								<option value="lit">Lithuanian</option>
								<option value="ltz">Luxembourgish</option>
								<option value="mac">Macedonian</option>
								<option value="may">Malay</option>
								<option value="mal">Malayalam</option>
								<option value="mni">Manipuri</option>
								<option value="mon">Mongolian</option>
								<option value="mne">Montenegrin</option>
								<option value="nor">Norwegian</option>
								<option value="oci">Occitan</option>
								<option value="per">Farsi</option>
								<option value="pol">Polish</option>
								<option value="por">Portuguese</option>
								<option value="rum">Romanian</option>
								<option value="rus">Russian</option>
								<option value="scc">Serbian</option>
								<option value="sin">Sinhalese</option>
								<option value="slo">Slovak</option>
								<option value="slv">Slovenian</option>
								<option value="spa">Spanish</option>
								<option value="swa">Swahili</option>
								<option value="swe">Swedish</option>
								<option value="syr">Syriac</option>
								<option value="tgl">Tagalog</option>
								<option value="tam">Tamil</option>
								<option value="tel">Telugu</option>
								<option value="tha">Thai</option>
								<option value="tur">Turkish</option>
								<option value="ukr">Ukrainian</option>
								<option value="urd">Urdu</option>
								<option value="vie">Vietnamese</option>
								</select>
							</li> 
							<li>
								<input type="submit" value="Search" class="button" />
							</li>
						</ul>
					</form>
					<h2 style="padding-top: 20px;">or Upload a subtitle file </h2>
						<form action="/get/subs/file" method="post">
							<ul>
								<li>
									<input type="file" name="file" />
								</li>    
								<li>
									<input type="submit" value="Upload" class="button" />
								</li>
							</ul>
						</form>
					</div>
					<div id="convert" class="form-action hide">

					</div>
					<div id="info" class="form-action hide">
						<h1>File Info</h1>
						<p>
							Name: {{$file->name}} <br>
							Size:{{$file_size}} <br>
							@if(isset($media_info->video_codec_name) && $media_info->video_codec_name != null)
							Type: {{$media_info->video_codec_name}} <br>
							@endif
							@if(isset($media_info->video_duration) && $media_info->video_duration != null)
							Duration: {{$media_info->video_duration}} <br>
							@endif
							@if(isset($media_info->video_width) && $media_info->video_width != null)
							Width: {{$media_info->video_width}} Height: {{$media_info->video_height}} <br>
							@endif
							@if(isset($media_info->video_ratio) && $media_info->video_ratio != null)
							Ratio: {{$media_info->video_ratio}} <br>
							@endif
							@if(isset($media_info->video_fps) && $media_info->video_fps != null)
							FPS: {{$media_info->video_fps}} <br>
							@endif
							@if(isset($media_info->audio_codec_name) && $media_info->audio_codec_name != null)
							Audio Codec: {{$media_info->audio_codec_name}} <br>
							@endif
							@if(isset($media_info->audio_bit_rate) && $media_info->audio_bit_rate != null)
							Audio Bit-rate: {{$media_info->audio_bit_rate}} <br>
							@endif
						</p>
					</div>
					<!--/#register.form-action-->
					<div id="results" class="form-action hide sub-result">
						<div class="result-s">
						  <ul>
						  </ul>
						</div>  
					</div> 
				</div>
			</div>	
										<?php 	
													$link = str_replace("'","\\u0027", $link);
													$link = str_replace("(","\\u0028", $link);	
													$link = str_replace(")","\\u0029", $link);
													$link = str_replace("~","\\u007e", $link);
													$link_play = urlencode( $link );
												
										?>
		  <script>
				flowplayer("player", "{{ URL::asset('include/swf/flowplayer.commercial-3.2.18.swf') }}",{
					key: '#$471cb004f588991175c',
					plugins: {
						pseudo: {
							url: "{{ URL::asset('include/swf/flowplayer.pseudostreaming-3.2.12.swf') }}"
						},
							// the captions plugin
						captions: {
							url: "{{ URL::asset('include/swf/flowplayer.captions-3.2.10.swf') }}",
				 
							// pointer to a content plugin (see below)
							captionTarget: 'content'
						},
						controls: {
							url: "flowplayer.controls-3.2.15.swf",
				 
							// customize the appearance to make the control bar transparent
							backgroundColor: "transparent",
							backgroundGradient: "none",
							sliderColor: '#FFFFFF',
							sliderBorder: '1.5px solid rgba(160,160,160,0.7)',
							volumeSliderColor: '#FFFFFF',
							volumeBorder: '1.5px solid rgba(160,160,160,0.7)',
				 
							timeColor: '#ffffff',
							durationColor: '#535353',
				 
							tooltipColor: 'rgba(255, 255, 255, 0.7)',
							tooltipTextColor: '#000000'
			 
						},
						content: {
							url: "{{ URL::asset('include/swf/flowplayer.content-3.2.9.swf') }}",
							bottom: 25,
							width: '80%',
							height:40,
							backgroundColor: 'transparent',
							backgroundGradient: 'none',
							border: 0,
				 
							// an outline is useful so that the subtitles are more visible
							textDecoration: 'outline',
							style: {
								'body': {
								fontSize: '14',
								fontFamily: 'Arial',
								textAlign: 'center',
								color: '#ffffff'
								}
							}
						}
					},
					canvas: {
						backgroundImage: 'url(http://okaydrive.com/snaps/big/{{$media->id}}/{{$file->id}}/1.jpg)'
					},
					clip: {
						provider: "pseudo",
						url: "{{$link_play}}",
						autoPlay: true,
						urlEncoding: true,
						preload: true,
						//autoBuffering: true,
						metaData: false,
					}
				});
		  </script>
		  <script id="tpl_sub" type="text/template">
				<li>
				<form action="/get/subs" method="post">
				  <button onclick="return false;" class="button"> Add </button>
				  <h3>##name##</h3>
				  <p>##lang##</p>
					<input type="hidden" name="name" value="##name##">
					<input type="hidden" name="path" value="##url##">
				</form>
				</li> 
		</script>
		@elseif($file->type == "img")


		@elseif($file->type == "vid-conv")
		<script>
		  var SHOW_CLASS = 'show',
			  HIDE_CLASS = 'hide',
			  ACTIVE_CLASS = 'active';
		  
		  $( '.tabs' ).on( 'click', 'li a', function(e){
			e.preventDefault();
			var $tab = $( this ),
				 href = $tab.attr( 'href' );
		  
			 $( '.active' ).removeClass( ACTIVE_CLASS );
			 $tab.addClass( ACTIVE_CLASS );
		  
			 $( '.show' )
				.removeClass( SHOW_CLASS )
				.addClass( HIDE_CLASS )
				.hide();
			
			  $(href)
				.removeClass( HIDE_CLASS )
				.addClass( SHOW_CLASS )
				.hide()
				.fadeIn( 550 );
		  });
		  
			
		</script>
		</head>
		<body>
			<div class="container">
				<div class="flat-form" style="width:420px !important;height:350px !important;">
					<ul class="tabs">
						<li>
							<a href="#download" class="active">Download</a>
						</li>
						<li>
							<a href="#info">Info</a>
						</li>
						<li class="sub-tab" style="display:none;">
							<a href="#results">Results</a>
						</li>
					</ul>            
					<!--/#login.form-action-->
					<div id="download" class="form-action show">
						  <h1>Download</h1>
						<p>
								Size: {{$file_size}} <br>
						</p>
							<ul>
								<li style="padding-top: 20px;">
										<a href="{{$link}}"><button class="button">Download</button></a>
								</li>
							</ul>
					</div>
					<div id="info" class="form-action hide">
					@if(!$media->downloading())
					<?php $media_info = MediaInfo::where('media_id', '=', $media->id)->where('file_id', '=', $file->id)->first(); ?>
					@endif
						<h1>File Info</h1>
						<p>
							Name: {{$file->name}} <br>
							Size: {{$file_size}} <br>
							@if(isset($media_info->video_codec_name) && $media_info->video_codec_name != null)
							Type: {{$media_info->video_codec_name}} <br>
							@endif
							@if(isset($media_info->video_duration) && $media_info->video_duration != null)
							Duration: {{$media_info->video_duration}} <br>
							@endif
							@if(isset($media_info->video_width) && $media_info->video_width != null)
							Width: {{$media_info->video_width}} Height: {{$media_info->video_height}} <br>
							@endif
							@if(isset($media_info->video_ratio) && $media_info->video_ratio != null)
							Ratio: {{$media_info->video_ratio}} <br>
							@endif
							@if(isset($media_info->video_fps) && $media_info->video_fps != null)
							FPS: {{$media_info->video_fps}} <br>
							@endif
							@if(isset($media_info->audio_codec_name) && $media_info->audio_codec_name != null)
							Audio Codec: {{$media_info->audio_codec_name}} <br>
							@endif
							@if(isset($media_info->audio_bit_rate) && $media_info->audio_bit_rate != null)
							Audio Bit-rate: {{$media_info->audio_bit_rate}} <br>
							@endif
						</p>
					</div>
					<!--/#register.form-action-->
					<div id="results" class="form-action hide sub-result">
						<div class="result-s">
						  <ul>
						  </ul>
						</div>  
					</div> 
				</div>
			</div>

		@else
		<script>
		  var SHOW_CLASS = 'show',
			  HIDE_CLASS = 'hide',
			  ACTIVE_CLASS = 'active';
		  
		  $( '.tabs' ).on( 'click', 'li a', function(e){
			e.preventDefault();
			var $tab = $( this ),
				 href = $tab.attr( 'href' );
		  
			 $( '.active' ).removeClass( ACTIVE_CLASS );
			 $tab.addClass( ACTIVE_CLASS );
		  
			 $( '.show' )
				.removeClass( SHOW_CLASS )
				.addClass( HIDE_CLASS )
				.hide();
			
			  $(href)
				.removeClass( HIDE_CLASS )
				.addClass( SHOW_CLASS )
				.hide()
				.fadeIn( 550 );
		  });
		  
		</script>
		</head>
		<body>
			<div class="container">
				<div class="flat-form" style="width:320px !important;height:280px !important;">
					<ul class="tabs">
						<li>
							<a href="#download" class="active">Download</a>
						</li>
						<li>
							<a href="#info">Info</a>
						</li>
					</ul>            
					<div id="download" class="form-action show">
						<h1>Download</h1>
						<p>
							Size: {{$file_size}}  <br><br>
						</p>
							<ul>
								<li style=" margin:0 auto !important;">
									<a href="{{$link}}"><button class="button">Download</button></a>
								</li>
							</ul>
			   
					</div>  
					<div id="info" class="form-action hide">
						<h1>File Info</h1>
						<p>
							Name: {{$file->name}} <br>
							Size: {{$file_size}} <br>
						</p>
					</div>
					<!--/#register.form-action-->
				</div>
			</div>	
		@endif
@endif
	</body>
	</html>