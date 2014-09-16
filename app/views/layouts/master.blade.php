<?php
ob_start(); //for the header() bug.

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>OkayDrive</title>
		<link rel="shortcut icon" href="{{ URL::asset('include/img/favicon.ico') }}" />
		<meta http-equiv="Content-type" content="text/html;charset=utf-8">
		
		<!-- CSS -->
		<link rel="stylesheet" media="(min-width: 750px)" type="text/css" href="{{ URL::asset('include/css/style.css') }}" />
		<link rel="stylesheet" media="(max-width: 750px)" type="text/css" href="{{ URL::asset('include/css/mobile.css') }}" />
		<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:400' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('include/css/button.css') }}" />
		<!-- JAVASCRIPTS -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script src="{{ URL::asset('include/js/jquery.wookmark.js') }}"></script>
		
	@if(!Request::is('signup') && !Request::is('signin') && !Request::is('forgot'))	
		<script type="text/javascript" src="{{ URL::asset('include/js/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('include/css/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
		<link href="{{ URL::asset('include/css/toastr.css') }}" rel="stylesheet"/>
		<script src="{{ URL::asset('include/js/toastr.min.js') }}"></script>
	@endif
	@if(Request::is('torrent/*') || Request::is('share/*'))
		<script src="{{ URL::asset('include/js/flowslider.jquery.js') }}"></script>
		<?php $show_ads = false;
				if(isset(Auth::user()->id)){
					if(Auth::user()->category_id == 1){
						$show_ads = true;
					}
				}
		?>
		

	@endif

	</head>
	<body>
		@if(Request::is('share/*'))
				
		@endif
	<div class="header">
		<div class="logo-wrap">
			<a href="{{ URL::to('/') }}"><div class="logo-img"></div></a>
		</div>
		 @if(!Auth::guest())
			<ul class="mobile-yes">
				@if(!Request::is('earn/*'))
					<a href="/upload" class="nbsmbox fancybox.ajax"><li><div class="new-button">Get a New Torrent</div></li></a>
				@endif
				@if(Request::is('/'))
					<a href="#" data-active="false" class="remove-link"><li><div class="remove-button">Delete</div></li></a>
				@endif
				@if(Request::is('torrent/*'))
					@if(Input::has("d"))
						@if(Input::has("b"))
							<a href="{{ URL::to('torrent/'.Request::segment(2).'?d='. Input::get('b')) }}" data-active="false"><li><div class="move-button">Back</div></li></a>
						@endif
					@endif
					@if($zip != null)
						<a href="{{$zip}}" data-active="false"><li><div class="download-button">Download</div></li></a>
					@endif
					<a href="#" class="remove-link" data-id="{{$m_id}}" data-active="false"><li><div class="remove-button">Delete</div></li></a>
					@if(Auth::user()->category_id == 1 || Auth::user()->category_id == 27)
						<a onclick="$.fancybox.open([{type: 'ajax',href : 'http://okaydrive.com/premium?width=828&height=361',title : 'Only premium users are allowed to share files.'}  ], {padding : 0   });" ><li><div class="share-button">Share & Earn</div></li></a>
					@else
						<a href="{{ URL::to('user/share/'.Request::segment(2)) }}" class="nbsmbox fancybox.ajax"><li><div class="share-button">Share & Earn</div></li></a>
					@endif
				@endif
				@if(Request::is('share/*'))
					@if(isset($zip))
						<a href="{{$zip}}" data-active="false"><li><div class="download-button">Download</div></li></a>
					@endif
					@if(Input::has("d"))
						@if(Input::has("b"))
							<a href="{{ URL::to('share/'.Request::segment(2).'?d='. Input::get('b')) }}" data-active="false"><li><div class="move-button">Back</div></li></a>
						@endif
					@endif
				@endif
			</ul>
			<ul id="nav-mobile" class="mobile-no">
				<li class="nav-ps-mobile"><a href="#"></a>
					<ul>
						<li><a href="/upload" class="nbsmbox fancybox.ajax">Get a New Torrent</a></li>
						<li class="last"><a href="{{ URL::to('/logout') }}">Logout</a></li>
					</ul>
					<div class="clear"></div>
				</li>
			</ul>

			<ul id="nav">
			
				<li><a class="nbsmbox fancybox.ajax" href="{{ URL::to('/premium?width=828&height=361') }}">Premium</a></li>
				<li><a href="https://www.purechat.com/w/pebhq" onclick="return supportPopup('https://www.purechat.com/w/datas')" >Support</a></li>
				<li><a href="#">{{Auth::user()->username}}</a>
					<ul>
						<li><a href="/user/settings" class="nbsmbox fancybox.ajax">Settings</a></li>
						<li class="last"><a href="{{ URL::to('/logout') }}">Logout</a></li>
					</ul>
					<div class="clear"></div>
				</li>
				
			</ul>
		@else
			<ul>
				<a href="{{ URL::to('/signup') }}"><li><div class="signup-button">Sign Up</div></li></a>
				<a href="{{ URL::to('/signin') }}"><li><div class="login-button">Login</div></li></a>
				@if( Request::is('share/*'))
					@if(isset($zip))
						<a href="{{$zip}}" data-active="false"><li><div class="download-button">Download</div></li></a>
					@endif
					@if(Input::has("d"))
						@if(Input::has("b"))
							<a href="{{ URL::to('share/'.Request::segment(2).'?d='. Input::get('b')) }}" data-active="false"><li><div class="move-button">Back</div></li></a>
						@endif
					@endif
				@endif
				@if( Request::is('share/*/file/*'))
					@if(isset($zip))
						<a href="{{$zip}}" data-active="false"><li><div class="download-button">Download</div></li></a>
					@endif
						

				@endif
			</ul>
		
		
		@endif
	</div>
@if(Request::is('/') || Request::is('home')  || Request::is('earn/*') || Request::is('torrent/*') || Request::is('share/*'))	
	<div class="sidebar-rp">
		<div class="sidebar-rp-filters">
		@if(Request::is('/') || Request::is('home'))
			<ul id="filters">
				<li><div class="sidebar ico-all"></div>ALL</li>
				<li data-filter="active"><div class="sidebar ico-active"></div>Active</li>
				<li data-filter="completed"><div class="sidebar ico-complete"></div>Completed</li>
				<li data-filter="failed"><div class="sidebar ico-fail"></div>Failed</li>
				<li data-filter="deleted"><div class="sidebar ico-deleted"></div>Deleted</li>
			</ul>
		@elseif(Request::is('share/*/file/*'))
			<ul id="filters">
					<a style="color: #FFFFFF;text-decoration: none !important;" href="{{ URL::to('/share/'.Request::segment(2)) }}"><li><div class="sidebar ico-back"></div>Back</li></a>
			</ul>
		@elseif(Request::is('torrent/*') || Request::is('share/*'))
			<ul id="filters">
					<li><div class="sidebar ico-all"></div>All</li>
					<li data-filter="image"><div class="sidebar ico-picture"></div>Pictures</li>
					<li data-filter="sound"><div class="sidebar ico-sound"></div>Audio</li>
					<li data-filter="video"><div class="sidebar ico-video"></div>Video</li>
					<li data-filter="text"><div class="sidebar ico-text"></div>Text</li>
					<li data-filter="folder"><div class="sidebar ico-folder"></div>Folders</li>
					<li data-filter="other"><div class="sidebar ico-other"></div>Other</li>
			</ul>
		@elseif(Request::is('earn/*'))
			<ul id="filters">
					<a style="color: #FFFFFF;text-decoration: none !important;" href="{{ URL::to('/') }}"><li><div class="sidebar ico-home"></div>Home</li></a>
					<a style="color: #FFFFFF;text-decoration: none !important;" href="{{ URL::to('/earn') }}"><li><div class="sidebar ico-active"></div>Stats</li></a>
					<a style="color: #FFFFFF;text-decoration: none !important;" href="{{ URL::to('/earn/rates') }}"><li><div class="sidebar ico-rates"></div>Pay Rates</li></a>
					<a style="color: #FFFFFF;text-decoration: none !important;" href="{{ URL::to('/earn/cashout') }}"><li><div class="sidebar ico-trolley"></div>Cash Out</li></a>
			</ul>
		@endif
		</div>
		
		<div class="sidebar-rp-stats">
			<div class="rp-stats-progressbar-wr">
				@if(!isset($avlper))
					<?php $avlper = 0; ?>
				@endif
				<div class="rp-stats-progressbar-pb" style="width: {{$avlper}}%"></div>
			</div>
			@if(isset($freebytes))

				<h2>{{$freebytes}}</h2>
				<h2>Free Traffic</h2>
			@endif
		</div>
	</div>
@endif
		
		 @yield('content')
	 <script src="{{ URL::asset('include/js/jquery.wookmark.start.js') }}"></script>
	 
	<script language="javascript" type="text/javascript"> 
		function supportPopup(url) {
			newwindow=window.open(url,'name','height=500,width=400');
			if (window.focus) {newwindow.focus()}
			return false;
		}
		$(document).ready(function() {
				@if(isset($msg))
					@if($msg != null)
						toastr.error('{{$msg}}');

							$.fancybox.open([
								{
									type: 'ajax',
									href : 'http://okaydrive.com/premium?width=828&height=361',
									title : '{{$msg2}}'
								}  
							], {
								padding : 0   
							});

					@endif
				@endif
				toastr.options = {
					"timeOut": "5000",
					"closeButton": true,
					"positionClass": "toast-bottom-right"
				};
				@if(Request::is('torrent/*'))
					@if($media->isConverting())
						getConvertStatus();
					@endif
				@endif
				$(".nbsmbox").fancybox({
					padding : 0,
					margin : 65,
					maxWidth	: 828,
					maxHeight	: 600,
					fitToView	: true,
					width		: 390,
					height		: 340,
					autoSize	: true,
					closeClick	: false,
					openEffect	: 'none',
					scrolling : 'no',
					closeEffect	: 'none',
					afterClose: function() {
						$('body').off('click', '.result-s li');
					},
					'ajax' : {
						data    : 'type=ajax'
					},
					helpers     : { 
						overlay : {closeClick: false}
					}
				});
				$(".frame").fancybox({
					padding : 0,
					margin : 65,
					fitToView	: true,
					autoSize	: true,
					closeClick	: false,
					openEffect	: 'none',
					scrolling : 'no',
					closeEffect	: 'none',
					beforeShow: function () {
						this.title += '<a href="'+this.href+'" target="blank" class="button button-rounded button-flat-action" id="img-button"> Download</a>'					
					},
					helpers : {
						title : {
							type: 'inside'
						}
					}			
				});

				$(".fancybox-thumb").fancybox({
					margin : 65,
					fitToView	: true,
					autoSize	: true,
					openEffect	: 'none',
					closeEffect	: 'none',
					prevEffect		: 'none',
					nextEffect		: 'none'
					@if(Request::is('share/*'))
					,minWidth : 470,
					beforeShow: function () {
	
					}
					@endif
				});
		});

		@if(Request::is('torrent/*'))

			
			$('body').on('click', '.remove-link', function() {
			    var self = $(this),id = self.data('id');
				$.ajax({
				  type:"post",
				  url:"{{ URL::to("user/torrents")}}/"+id+"/remove",
				  datatype:"html",
				  success:function(res)
				  {
					toastr.success('Your torrent has been removed.');	
					window.location = "{{URL::to('/')}}";
				  }
				});
			});	
		@endif
		@if(Request::is('/') || Request::is('home'))
			$('body').on('click', '.remove-link', function() {
				var active = $(this).data("active");
				if(!active){
					$('.media-tile').each(function(){
						$(this).data("active",true);
						$(this).find('.media-tile-add').remove();
						$(this).append('<button class="red-btn media-tile-delete">Delete</button> ');
						window.refreshGrid();
					});
					$(this).data("active",true);
				}else{
					$(this).data("active",false);
					$('.media-tile').each(function(){
						$(this).data("active",false);
						$(this).find('.media-tile-delete').remove();
						window.refreshGrid();
					});
				}
			});	
			
			$('body').on('click', '.deleted', function() {
				var active = $(this).data("active");
				if(!active){
					$(this).find('.media-tile-delete').remove();
					$(this).data("active",true);
					$(this).append('<button class="green-btn media-tile-add">Add</button> ');
					window.refreshGrid();
				}else{
					$(this).data("active",false);
					$(this).find('.media-tile-add').remove();
					window.refreshGrid();
				}
			});	
			
			$('body').on('click', '.media-tile-delete', function() {
			    var self = $(this),id = self.closest("li").data('id');
				$.ajax({
				  type:"post",
				  url:"{{ URL::to("user/torrents")}}/"+id+"/remove",
				  datatype:"html",
				  success:function(res)
				  {
					self.parent('li').remove(); 
					toastr.success('Your torrent has been removed.');	
					window.refreshGrid();
				  }
				});
			});	
			$('body').on('click', '.media-tile-add', function() {
			    var self = $(this),id = self.closest("li").data('id');
				$.ajax({
				  type:"post",
				  url:"{{ URL::to("user/torrents")}}/"+id+"/add",
				  datatype:"html",
				  success:function(res)
				  {
					toastr.success('Your torrent has been added.');	
					window.refreshGrid();
					location.reload(false);
				  }
				});
			});	
		@endif	
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




		</body>
</html>