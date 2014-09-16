@extends('layouts.master')

@section('content')
		<div class="intro-pu-wrapper">
			<h1>Sign Up</h1>
			@if(count(Session::get('errors')) != 0)
				<div style="width: 100%;text-align: center;color: #ea1515;">
				
				@foreach(Session::get('errors') as $error)
					{{$error[0]}} <br>
				@endforeach
				
				</div>
			@endif
			<form action="{{ URL::to('signup') }}" method="post" autocomplete="off">
			@if(count(Session::get('errors')) == 1)
				<div id="form-intro-pu" style="position: absolute;top: 100px;">
			@elseif(count(Session::get('errors')) == 2)
				<div id="form-intro-pu" style="position: absolute;top: 120px;">
			@elseif(count(Session::get('errors')) == 3)
				<div id="form-intro-pu" style="position: absolute;top: 140px;">
			@else
				<div id="form-intro-pu" style="position: absolute;top: 70px;">
			@endif
			
			@if(Session::get('input_username') != '')
					<input class="login-user-logo" type="text" style="margin-top:10px" value="{{Session::get('input_username')}}" onblur="if(value=='') this.className='login-user-logo-wt'" id="username" name="username" maxlength="30" onfocus="this.className='login-user-logo'">
			@else
					<input class="login-user-logo-wt" type="text" style="margin-top:10px" value="" onblur="if(value=='') this.className='login-user-logo-wt'" id="username" name="username" maxlength="30" onfocus="this.className='login-user-logo'">
			@endif
			@if(Session::get('input_email') != '')
					<input class="login-mail-logo" type="text" style="margin-top:70px" value="{{Session::get('input_email')}}" onblur="if(value=='') this.className='login-mail-logo-wt'" name="email" maxlength="50" onfocus="this.className='login-mail-logo'">
			@else
					<input class="login-mail-logo-wt" type="text" style="margin-top:70px" value="" onblur="if(value=='') this.className='login-mail-logo-wt'" name="email" maxlength="50" onfocus="this.className='login-mail-logo'">
			@endif
					<input class="login-password-logo-wt" style="margin-top:130px" type="password"  id="password" name="password" maxlength="30" onblur="if(value=='') this.className='login-password-logo-wt'" onclick="this.className='login-password-logo'" />
					<input class="login-password-logo-rp-wt" style="margin-top:190px" type="password"  id="password_confirm" name="password_confirmation" maxlength="30" onblur="if(value=='') this.className='login-password-logo-rp-wt'" onclick="this.className='login-password-logo'" />
					<button value="Register" style="margin-top:250px">Register</button>
				</div>

				<div class="intro-pu-options-ex" style="margin-top: 300px; height: 25px;"></div>
			</form>
			
			<div class="footer-intro-ex" style="margin-top:10px">
				<?php echo "Login with : &nbsp;"; ?>
				<a href="{{ URL::to('facebook') }}"><img src="/include/img/social/f_facebook.png"></a>
				<a href="{{ URL::to('twitter') }}"><img src="/include/img/social/f_twitter.png"></a>
				<a href="{{ URL::to('google') }}"><img src="/include/img/social/f_google.png"></a>
				<a href="{{ URL::to('yahoo') }}"><img src="/include/img/social/f_yahoo.png"></a>

			</div>
			<div class="footer-intro-pu">
				Forgot Password? <a href="{{ URL::to('forgot') }}">Recover it</a>
			</div>
		</div>

@stop