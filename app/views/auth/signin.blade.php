@extends('layouts.master')

@section('content')

	@if(Input::has("auth") || Session::has('auth'))
		@if(Session::has('auth'))
			<?php Session::forget('auth'); ?>
		@endif
			<div class="intro-pu-wrapper">
				<h1>Login</h1>

				@if(Session::get('errors') != '')
					<div style="width: 100%;text-align: center;color: #ea1515;">{{Session::get('errors');}}</div>
				@endif
				<form action="{{ URL::to('signin') }}" method="post">
					<div id="form-intro-pu" style="position: absolute;top: 90px;">
						@if(Session::get('input_email') != '')
							<input class="login-user-logo" type="text" style="margin-top:10px" value="{{Session::get('input_email')}}" onblur="if(value=='') this.className='login-user-logo-wt'" onfocus="this.className='login-user-logo'" id="username" name="email" maxlength="30">
						@else
							<input class="login-user-logo-wt" type="text" style="margin-top:10px" value="" onblur="if(value=='') this.className='login-user-logo-wt'" onfocus="this.className='login-user-logo'" id="username" name="email" maxlength="30">
						@endif
						<input class="login-password-logo-wt" style="margin-top:70px" type="password"  id="password" name="password" maxlength="30" onblur="if(value=='') this.className='login-password-logo-wt'" onclick="this.className='login-password-logo'" />
						<button name="login" value="Login" style="margin-top:130px">Login</button>
					</div>
					<div class="intro-pu-options-ex" style="margin-top: 230px">
							<input id="rimaniconnesso" class="login-checkbox" type="checkbox" name="remember"  />
							<label for="rimaniconnesso" class="login-label">Keep me logged in</label>
					</div>
				</form>
				<div class="footer-intro-ex" style="margin-top:10px">
					{{"Login with : &nbsp;"}}
					<a href="{{ URL::to('facebook') }}"><img src="/include/img/social/f_facebook.png"></a>
					<a href="{{ URL::to('twitter') }}"><img src="/include/img/social/f_twitter.png"></a>
					<a href="{{ URL::to('google') }}"><img src="/include/img/social/f_google.png"></a>
					<a href="{{ URL::to('yahoo') }}"><img src="/include/img/social/f_yahoo.png"></a>

				</div>
				<div class="footer-intro-pu">
					Forgot Password? <a href="{{ URL::to('forgot') }}">Recover it</a>
				</div>
				
			</div>

	@else
		<div id="login-features">
			<h1>Get all your torrents, super fast.</h1>
			<h2>Play torrents instantly in your browser or download torrents at lightning speeds.</h2>
			<ul>
			  <li>Simply upload a .torrent file &amp; download or play files</li>
			  <li>1 TB bandwidth for your download needs</li>
			  <li>Unlimited storage for torrent files</li>
			  <li>Access cache files - no waiting</li>
			  <li>Download accelerator supported - IDM, DownThemAll, etc</li>
			</ul>
		</div>

			<div class="intro-pu-wrapper" style="left:80%;">
				<h1>Login</h1>

				@if(Session::get('errors') != '')
					<div style="width: 100%;text-align: center;color: #ea1515;">{{Session::get('errors');}}</div>
				@endif
				<form action="{{ URL::to('signin') }}" method="post">
					<div id="form-intro-pu" style="position: absolute;top: 90px;">
						@if(Session::get('input_email') != '')
							<input class="login-user-logo" type="text" style="margin-top:10px" value="{{Session::get('input_email')}}" onblur="if(value=='') this.className='login-user-logo-wt'" onfocus="this.className='login-user-logo'" id="username" name="email" maxlength="30">
						@else
							<input class="login-user-logo-wt" type="text" style="margin-top:10px" value="" onblur="if(value=='') this.className='login-user-logo-wt'" onfocus="this.className='login-user-logo'" id="username" name="email" maxlength="30">
						@endif
						<input class="login-password-logo-wt" style="margin-top:70px" type="password"  id="password" name="password" maxlength="30" onblur="if(value=='') this.className='login-password-logo-wt'" onclick="this.className='login-password-logo'" />
						<button name="login" value="Login" style="margin-top:130px">Login</button>
					</div>
					<div class="intro-pu-options-ex" style="margin-top: 230px">
							<input id="rimaniconnesso" class="login-checkbox" type="checkbox" name="remember"  />
							<label for="rimaniconnesso" class="login-label">Keep me logged in</label>
					</div>
				</form>
				<div class="footer-intro-ex" style="margin-top:10px">
					{{"Login with : &nbsp;"}}
					<a href="{{ URL::to('facebook') }}"><img src="/include/img/social/f_facebook.png"></a>
					<a href="{{ URL::to('twitter') }}"><img src="/include/img/social/f_twitter.png"></a>
					<a href="{{ URL::to('google') }}"><img src="/include/img/social/f_google.png"></a>
					<a href="{{ URL::to('yahoo') }}"><img src="/include/img/social/f_yahoo.png"></a>

				</div>
				<div class="footer-intro-pu">
					Forgot Password? <a href="{{ URL::to('forgot') }}">Recover it</a>
				</div>
				
			</div>
	@endif
@stop