@extends('layouts.master')
@section('content')
<div class="intro-pu-wrapper" style="display: block;">
			<h1>Cashout</h1>
			@if(count(Session::get('errors')) != 0)
				<div style="width: 100%;text-align: center;color: #ea1515;">
					{{Session::get('errors')}} <br>
				</div>
			@endif
			<form action="" method="post" enctype="multipart/form-data">
				<div id="form-intro-pu" style="position: absolute;top: 70px;">
					<input class="login-paypal-mail-logo-wt" type="text" style="margin-top:30px" value="" onblur="if(value=='') this.className='login-paypal-mail-logo-wt'" name="email" maxlength="50" onfocus="this.className='login-mail-logo'">
					<button value="Submit" name="submit" style="margin-top:110px">Submit</button>

					
				</div>
				<div class="intro-pu-options" style="margin-top: 150px; height: 25px;"></div>
			</form>
			<div class="footer-intro-pu">
				Minimum cashout amount: $10
			</div>
		</div>
		@stop