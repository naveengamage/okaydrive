@extends('layouts.master')
@section('content')
		

			<div class="intro-pu-wrapper">
				<h1>Reset Password</h1>
		@if (Session::has('error'))
			<div style="width: 100%;text-align: center;color: #ea1515;">{{ trans(Session::get('error')) }}</div>
				<form method="POST" action="{{ URL::to('forgot') . '/' . $token }}">
					<div id="form-intro-pu" style="position: absolute;top: 100px;">
        @elseif (Session::has('success'))
			<div style="width: 100%;text-align: center;color: #ea1515;">Password has been reset.</div>
				<form method="POST" action="{{ URL::to('forgot') . '/' . $token }}">
					<div id="form-intro-pu" style="position: absolute;top: 120px;">
		@else
			<form method="POST" action="{{ URL::to('forgot') . '/' . $token }}">
				<div id="form-intro-pu" style="position: absolute;top: 90px;">
        @endif
							<input class="login-mail-logo" type="text" style="margin-top:10px" value="Email" onblur="if(value=='') value = 'Email'" onfocus="if(value=='Email') value = ''" name="email" maxlength="30">
							<input class="login-password-logo-wt" style="margin-top:70px" type="password"  id="password" name="password" maxlength="30" onblur="if(value=='') this.className='login-password-logo-wt'" onclick="this.className='login-password-logo'" />
							<input class="login-password-logo-rp-wt" style="margin-top:130px" type="password"  id="password_confirm" name="password_confirmation" maxlength="30" onblur="if(value=='') this.className='login-password-logo-rp-wt'" onclick="this.className='login-password-logo'" />
							<input name="token" type="hidden" value="{{ $token }}">   
						<button value="Submit" name="reset" style="margin-top:190px">Submit</button>
					</div>
					<div class="intro-pu-options" style="margin-top: 250px; height: 25px;"></div>
				</form>	
				
			<div class="footer-intro-pu">
				You will receive an e-mail.
			</div>
		</div>			
@stop		