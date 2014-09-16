<style>
.container h1{
	margin-top: 20px;
}

h1,.container p,.container a,.container ol,.container ul,.container li,
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
  width: 390px;
  height: 300px;
  position: relative;
  font-family: 'Titillium Web', sans-serif;
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

span.bg-button
{
	display: table;
	padding: 5px;

	border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px 3px 3px 3px;
	-webkit-border-radius: 3px 3px 3px 3px;

	background-color: rgba(0, 0, 0, 0.05);
	-webkit-box-shadow: inset 0px 1px 2px 0px rgba(0,0,0,0.1);
	-moz-box-shadow: inset 0px 1px 2px 0px rgba(0,0,0,0.1);
	box-shadow: inset 0px 1px 2px 0px rgba(0,0,0,0.1);
}

span.bg-button:hover
{
	cursor: pointer;
}
	span.bg-button > *
	{
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}

	span.bg-button:active > span.text
	{
		-webkit-box-shadow: inset 0px 5px 5px -5px rgba(0,0,0,0.35) !important;
		-moz-box-shadow: inset 0px 5px 5px -5px rgba(0,0,0,0.35) !important;
		box-shadow: inset 0px 5px 5px -5px rgba(0,0,0,0.35) !important;
	}

	span.bg-button > span.icon, span.bg-button > span.text
	{
		display: table;
		border: 1px solid #000;
		/*max-height: 38px;*/
	}

	span.bg-button > span.icon
	{
		display: block;
		float: left;
		background: no-repeat center;
		border-right: none !important;
		height: 38px;
		width: 40px;

		border-radius: 3px 0px 0px 3px;
		-moz-border-radius: 3px 0px 0px 3px;
		-webkit-border-radius: 3px 0px 0px 3px;

		-webkit-box-shadow: inset 1px 1px 0px 0px rgba(255,255,255,0.3);
		-moz-box-shadow: inset 1px 1px 0px 0px rgba(255,255,255,0.3);
		box-shadow: inset 1px 1px 0px 0px rgba(255,255,255,0.3);
	}

	span.bg-button > span.text
	{
		padding: 12.5px 40px;
		border-radius: 0px 3px 3px 0px;
		-moz-border-radius: 0px 3px 3px 0px;
		-webkit-border-radius: 0px 3px 3px 0px;

		-webkit-box-shadow: inset 1px 1px 0px 0px rgba(255,255,255,0.3);
		-moz-box-shadow: inset 1px 1px 0px 0px rgba(255,255,255,0.3);
		box-shadow: inset 1px 1px 0px 0px rgba(255,255,255,0.3);

		text-shadow: 0px 1px 0px rgba(0, 0, 0, 0.7);
	}

	span.bg-button.red > span.icon, span.bg-button.red > span.text
	{
		border-color: #c62b2b;
		color: #FFF;
		font-weight: bolder;
	}

	span.bg-button.red > span.icon
	{
		background-color: #d53f3f;
		height: 52px;
		width: 51px;
	}

	span.bg-button.red > span.text
	{
		background-color: #f05050;
		font-family: 'Open Sans', sans-serif;
		font-weight: 500;
		font-size: 25px;
	}

	span.bg-button.red:hover > span.icon
	{
		background-color: #e34d4d;
	}

	span.bg-button.red:hover > span.text
	{
		background-color: #f95f5f;
	}
</style>
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
    <div class="container">
        <div class="flat-form">
            <ul class="tabs">
                <li>
                    <a href="#login" class="active">Download</a>
                </li>
                <li>
                    <a href="#register">Public</a>
                </li>
				<li>
                    <a href="#magnet">Share</a>
                </li>
            </ul>            
			<div id="login" class="form-action show">
                <h1>Download</h1>
                <p>
					Size: 1 MB <br>
					Type: AVI <br><br>
                </p>
                    <ul>
                        <li style="padding-left: 47px !important;">
                            	<span class="bg-button red">
									<span class="icon" style="background-image: url(http://www.okilla.com/example/2013/7/959/images/down-icon.png);"></span>
									<span class="text">
										Download
									</span>
							</span>
                        </li>
                    </ul>
       
            </div>  
            <!--/#login.form-action-->
            <div id="register" class="form-action hide">
                <h1>Upload via URL</h1>
                <p>
                    Type or paste the URL to any torrent file.
					<br><br>
                </p>
                <form>
                    <ul>
                        <li>
                            <input type="text" placeholder="URL" />
                        </li>
     
                        <li>
                            <input type="submit" value="Upload" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
            <!--/#register.form-action-->
			<div id="magnet" class="form-action hide">
                <h1>Upload via Magnet</h1>
                <p>
                    Type or paste the magnet to any torrent.
					<br><br>
                </p>
                <form>
                    <ul>
                        <li>
                            <input type="text" placeholder="Magnet URL" />
                        </li>
     
                        <li>
                            <input type="submit" value="Upload" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
            <!--/#register.form-action-->
        </div>
    </div>			