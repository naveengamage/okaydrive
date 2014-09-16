@extends('layouts.master')
@section('content')
		
@if(isset($_GET['key']) && strlen($_GET['key']) == 32)
			<div class="intro-pu-wrapper">
				<h1>Reset Password</h1>
				<form method="POST">
					<div id="form-intro-pu" style="position: absolute;top: 90px;">
						<input class="login-user-logo" type="text" style="margin-top:10px" value="Username" onblur="if(value=='') value = 'Username'" onfocus="if(value=='Username') value = ''" name="password" maxlength="30">
						<input class="login-password-logo" type="text" style="margin-top:65px" value="Password" onblur="if(value=='') value = 'Password'" onfocus="if(value=='Password') value = ''" name="password2" maxlength="30">
						
						<input type="hidden" name="subforgot" value="1">
						<button value="Submit" name="reset" style="margin-top:130px">Submit</button>
					</div>
					<div class="intro-pu-options" style="margin-top: 200px; height: 25px;"></div>
				</form>	
@else

		<div class="intro-pu-wrapper">
			<h1>Forgot Password</h1>
		@if (Session::has('error'))
			<div style="width: 100%;text-align: center;color: #ea1515;">Invalid email address.</div>
			<form action="{{ URL::to('forgot') }}" method="POST" name="forgotform">
			<div id="form-intro-pu" style="position: absolute;top: 120px;">
        @elseif (Session::has('success'))
			<div style="width: 100%;text-align: center;color: #ea1515;">An email with the password reset has been sent.</div>
			<form action="{{ URL::to('forgot') }}" method="POST" name="forgotform">
			<div id="form-intro-pu" style="position: absolute;top: 120px;">
		@else
			<form action="{{ URL::to('forgot') }}" method="POST" name="forgotform">
			<div id="form-intro-pu" style="position: absolute;top: 90px;">
        @endif

				<input class="login-mail-logo-wt" type="text" style="margin-top:10px" value="" onblur="if(value=='') this.className='login-mail-logo-wt'" onfocus="this.className='login-mail-logo'" name="email" maxlength="30">
				<button value="Get New Password" name="forgotten" style="margin-top:70px">Submit</button>
			</div>
			<div class="intro-pu-options" style="margin-top: 150px; height: 25px;"></div>
			</form>
		
@endif		
			<div class="footer-intro-pu">
				You will receive an e-mail.
			</div>
		</div>			
@stop		