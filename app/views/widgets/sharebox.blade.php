<!DOCTYPE HTML>
<html><head>
<title>Simple FAQ Template</title>
<style type="text/css">

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
  width: 500px;
  height: 250px;
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
  overflow:auto;
  overflow-x: hidden;
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


</style>
<script type="text/javascript">
function toggle(Info) {
  var CState = document.getElementById(Info);
  CState.style.display = (CState.style.display != 'block')
                       ? 'block' : 'none';
}
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

})( jQuery );
</script>
</head>
<body>
<div class="container">
	<div class="flat-form">
		<ul class="tabs">
			<li>
				<a href="#share" class="active">Share</a>
			</li>
			<li>
				<a href="#earn">Earn</a>
			</li>
		</ul>            
		<div id="share" class="form-action show">
			
				<h1>Share your torrent</h1>
                <p>
                    Use the link below to share your torrent.
					<br><br>
                </p>
                <form action="/upload/data" method="post">
                    <ul>
                        <li>
                            <input type="text" onClick="this.select();" value="{{$link}}" name="tdt" placeholder="URL" maxlength="150"/>
                        </li>
                    </ul>
                </form>
		</div>
		<div id="earn" class="form-action hide">
					<h1>Check your earnings</h1>
					<p>
						Your earnings for sharings your torrents.
						<br><br>
					</p>
					<ul>						
                        <li>
                            <input type="submit" value="Go to Earnings Dashboard" style="width:100%;" class="button" onclick="location.href='/earn';">
                        </li>
                    </ul>
		</div>
	</div>
</div>
</body>
</html>