@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/login_signup.css') }}" />
    <style type="text/css">
        html, body, #main_container{
            background:none;
        }
        .navbar.gallery-sub-header{
            display:none;
        }
        #footer, .backstretch, #overlay, .form-signin{
            display:none;
        }
    </style>
@stop

@section('content')

<div class="container">

    
     
    <form method="POST" action="{{ URL::to('password_reset') . '/' . $token }}" accept-charset="UTF-8" class="form-signin" style="top: 51px; display: block;">  
            
        @if (Session::has('error'))
            <span class="error">{{ trans(Session::get('reason')) }}</span>
        @elseif (Session::has('success'))
            <span class="success">An email with the password reset has been sent.</span>
        @endif

        <h2 class="form-login-heading" style="font-size:16px; color:#fff; text-align:center; font-weight:normal; margin-bottom:15px; margin-top:5px;">Enter your email and new password</h2>

		<input class="login-mail-logo-wt" type="text" style="margin-top:70px" value="" onblur="if(value=='') this.className='login-mail-logo-wt'" name="email" maxlength="50" onfocus="this.className='login-mail-logo'">
     
        <input name="password" type="password" id="password" class="form-control" placeholder="password">
     
        <input name="password_confirmation" type="password" id="password_confirmation" class="form-control" placeholder="confirm password">
     
        <input name="token" type="hidden" value="{{ $token }}">     
        <button class="btn btn-lg btn-block btn-color" type="submit">Set My New Password</button>
     
    </form>

</div>
<div id="overlay"></div>

<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.backstretch.min.js') }}"></script>
<script type="text/javascript">

    var images = ['01.jpg', '02.jpg', '03.jpg', '04.jpg', '05.jpg', '06.jpg', '07.jpg', '08.jpg', '09.jpg', '10.jpg'];

    $(document).ready(function(){
        $.backstretch('{{ URL::to("/") }}/uploads/backgrounds/' + images[Math.floor(Math.random() * images.length)] );
        position_elements();
    });

    $(window).resize(function(){
        position_elements();
    });

    function position_elements(){
        $('#overlay').css('height', $(window).height());
        $('.form-signin').css('top', ( ($(window).height()/2) - ($('.form-signin').height()/2) ) - $('.navbar').height() + 'px' );
        $('.backstretch, #overlay, .form-signin').fadeIn();
    }
</script>

@stop