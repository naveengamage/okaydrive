<script src="{{ URL::asset('include/js/jquery.form.js') }}"></script> 
<script src="{{ URL::asset('include/js/jquery.knob.js') }}"></script>
<style>
.cont h1{
	margin-top: 20px;
}

h1,.cont p,.cont a,.cont ol,.cont ul,.cont li,
.cont fieldset,.cont form,.cont label,.cont legend,.cont table {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}

.cont {
	color: white;
	font-family: 'Titillium Web', sans-serif;
	line-height: 1;
}

.cont ol,.cont ul {
	list-style: none;
}

table {
	border-collapse: collapse;
	border-spacing: 0;
}


.flat-form {
  background: #4e9add;
  margin: 0 auto;
  width: 500px;
  height: 430px;
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
  overflow-x: hidden;
}

.result-s li:hover {
  background: #3f81bc;
  cursor: pointer;
}	

table{
font-family: verdana,helvetica,arial,sans-serif;
color: #000000;
}

table.reference,table.tecspec{
	border-collapse:collapse;width:100%;
}

table.reference tr:nth-child(odd)	{background-color:#f1f1f1;}
table.reference tr:nth-child(even)	{background-color:#ffffff;}

table.reference tr.fixzebra			{background-color:#f1f1f1;}

table.reference th{
	color:#ffffff;background-color:#555555;border:1px solid #555555;padding:3px;vertical-align:top;text-align:left;
}

table.reference th a:link,table.reference th a:visited{
	color:#ffffff;
}

table.reference th a:hover,table.reference th a:active{
	color:#EE872A;
}

table.reference td{
	border:1px solid #d4d4d4;padding:5px;padding-top:7px;padding-bottom:7px;vertical-align:top;
}

table.reference td.example_code
{
vertical-align:bottom;
}

</style>
<script>
(function( $ ) {
  // constants
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

$(".useage_mt").knob({readOnly: true});

$('form').ajaxForm({
    beforeSend: function() {

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
		}			
    },
	complete: function(xhr) {
		
	}
}); 


})( jQuery );
</script>

    <div class="cont">
        <div class="flat-form">
            <ul class="tabs">
                <li>
                    <a href="#usage" class="active">Usage</a>
                </li>
                <li>
                    <a href="#account">Account</a>
                </li>
				<li>
                    <a href="#payments">Payments</a>
                </li>	
				<li>
                    <a href="#settings">Settings</a>
                </li>
            </ul>
            <div id="usage" class="form-action show">
                <h1>Bandwidth Usage</h1>
                <p>
					Your bandwidth usage for this month.<br><br>
                </p>
				<div style="text-align: center ; margin: auto;"><input type="text" value="{{$perc}}" data-width="135" data-height="135" class="useage_mt">	</div>
				<br><label> Allowance: {{ $avlbytes}} </label><br><br>
				<label> Used: {{ $usedbytes}} </label><br><br>
				<label> Free: {{ $freebytes}} </label>
            </div>
            <div id="account" class="form-action hide">
                <h1>Account</h1>
                <p>
                    Your account details.

                </p>
				<form action="/user/update" method="post">
                    <ul>						
                        <li>
                            <label> Current plan: {{$plan_name}} </label><br><br>
							@if($plan_exp == '0000-00-00 00:00:00')
								<?php $plan_exp = 'none'; ?>
							@endif
							<label> Expires: {{$plan_exp}} </label><br><br>
                        </li>
                        <li>
                            <input type="submit" value="Cancel current plan" style="width:100%;" class="button" />
                        </li>
                    </ul>
                </form>
                <form action="/user/account/update" method="post">
                    <ul>						
                        <li style="padding-top: 20px;">
                            <input type="password" name="password_new" placeholder="New Password" />
                        </li>
						<li>
                            <input type="password" name="password_current" placeholder="Old Password" />
                        </li>
                        <li>
                            <input type="submit" value="Update" class="button"/>
                        </li>
                    </ul>
                </form>
            </div>
            <!--/#register.form-action-->
			<div id="payments" class="form-action hide">
                <h1>Payments</h1>
                <p>
                    Payments you've made for this account.
					<br><br>
                </p>
				<table class="reference" >
					<tbody><tr>
						<th>Description</th>
						<th>Amount</th>		
						<th>Date</th>
					</tr>
					@foreach(Auth::user()->payments() as $payment)
					<tr>
						<td>{{$payment->description}}</td>
						<td>{{$payment->amount}} USD</td>		
						<td>{{$payment->created_at}}</td>
					</tr>
					@endforeach
				</tbody></table>
            </div>
            <!--/#register.form-action-->
            <!--/#search.form-action-->
			<div id="settings" class="form-action hide">
                <h1>Settings</h1>
                <p>
                    Your account settings.
					<br><br>
                </p>
                <form action="/user/settings/update" method="post">
                    <ul>
						<li style="padding-bottom: 20px;" >
							<?php list($lng_code, $lng_name) = explode(",", $set_sub_lng); ?>
							<label> Select default subtitle language </label>
							<select name="lng">
							<option value="{{$lng_code}},{{$lng_name}}">{{$lng_name}}</option>
							<option value="all,ALL">ALL</option>
							<option value="afr,Afrikaans">Afrikaans</option>
							<option value="alb,Albanian">Albanian</option>
							<option value="ara,Arabic">Arabic</option>
							<option value="arm,Armenian">Armenian</option>
							<option value="baq,Basque">Basque</option>
							<option value="bel,Belarusian">Belarusian</option>
							<option value="ben,Bengali">Bengali</option>
							<option value="bos,Bosnian">Bosnian</option>
							<option value="pob,Portuguese-BR">Portuguese-BR</option>
							<option value="bre,Breton">Breton</option>
							<option value="bul,Bulgarian">Bulgarian</option>
							<option value="bur,Burmese">Burmese</option>
							<option value="cat,Catalan">Catalan</option>
							<option value="chi,Chinese">Chinese</option>
							<option value="hrv,Croatian">Croatian</option>
							<option value="cze,Czech">Czech</option>
							<option value="dan,Danish">Danish</option>
							<option value="dut,Dutch">Dutch</option>
							<option value="eng,English">English</option>
							<option value="epo,Esperanto">Esperanto</option>
							<option value="est,Estonian">Estonian</option>
							<option value="fin,Finnish">Finnish</option>
							<option value="fre,French">French</option>
							<option value="glg,Galician">Galician</option>
							<option value="geo,Georgian">Georgian</option>
							<option value="ger,German">German</option>
							<option value="ell,Greek">Greek</option>
							<option value="heb,Hebrew">Hebrew</option>
							<option value="hin,Hindi">Hindi</option>
							<option value="hun,Hungarian">Hungarian</option>
							<option value="ice,Icelandic">Icelandic</option>
							<option value="ind,Indonesian">Indonesian</option>
							<option value="ita,Italian">Italian</option>
							<option value="jpn,Japanese">Japanese</option>
							<option value="kaz,Kazakh">Kazakh</option>
							<option value="khm,Khmer">Khmer</option>
							<option value="kor,Korean">Korean</option>
							<option value="lav,Latvian">Latvian</option>
							<option value="lit,Lithuanian">Lithuanian</option>
							<option value="ltz,Luxembourgish">Luxembourgish</option>
							<option value="mac,Macedonian">Macedonian</option>
							<option value="may,Malay">Malay</option>
							<option value="mal,Malayalam">Malayalam</option>
							<option value="mni,Manipuri">Manipuri</option>
							<option value="mon,Mongolian">Mongolian</option>
							<option value="mne,Montenegrin">Montenegrin</option>
							<option value="nor,Norwegian">Norwegian</option>
							<option value="oci,Occitan">Occitan</option>
							<option value="per,Farsi">Farsi</option>
							<option value="pol,Polish">Polish</option>
							<option value="por,Portuguese">Portuguese</option>
							<option value="rum,Romanian">Romanian</option>
							<option value="rus,Russian">Russian</option>
							<option value="scc,Serbian">Serbian</option>
							<option value="sin,Sinhalese">Sinhalese</option>
							<option value="slo,Slovak">Slovak</option>
							<option value="slv,Slovenian">Slovenian</option>
							<option value="spa,Spanish">Spanish</option>
							<option value="swa,Swahili">Swahili</option>
							<option value="swe,Swedish">Swedish</option>
							<option value="syr,Syriac">Syriac</option>
							<option value="tgl,Tagalog">Tagalog</option>
							<option value="tam,Tamil">Tamil</option>
							<option value="tel,Telugu">Telugu</option>
							<option value="tha,Thai">Thai</option>
							<option value="tur,Turkish">Turkish</option>
							<option value="ukr,Ukrainian">Ukrainian</option>
							<option value="urd,Urdu">Urdu</option>
							<option value="vie,Vietnamese">Vietnamese</option>
							</select>
						</li> 
						<li style="padding-bottom: 20px;" >
                           <input type="checkbox" name="ea" value="1" @if($set_ea) checked @endif> Send me email updates
                        </li> 
                        <li>
                            <input type="submit" value="Update" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>