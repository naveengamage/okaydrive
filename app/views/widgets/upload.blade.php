<script src="{{ URL::asset('include/js/jquery.form.js') }}"></script> 
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
  width: 450px;
  height: 300px;
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

    $('body').on('click', '.result-s li', function() {
			$(this).find("form").ajaxSubmit({		
				success: function(xhr) {
					if(xhr.location){
						window.location = xhr.location;
					}
					if(xhr.error){
						toastr.error(xhr.error);
					}else{
						toastr.success('Your torrent has been added.');
					}					
				}
			});
	});
   
$('form').ajaxForm({
    beforeSend: function() {
		$.fancybox.showLoading();
    },
    uploadProgress: function(event, position, total, percentComplete) {

    },
    success: function(xhr) {
		if(xhr.error){
			toastr.error(xhr.error);
		}else{
			if(xhr.location){
				window.location = xhr.location;
			}else if(xhr.type = "torrent_search"){
					$( '.active' ).removeClass( 'active' );
					$( '.res-tab' ).show();				
					$( '.res-tab' ).children("a").addClass( 'active' );
					$('.flat-form').height(450).width(600);
					$.fancybox.reposition();
					$.fancybox.update();
					$( '.show' ).removeClass( 'show' ).addClass( 'hide' ).hide();
					$( '.results-sec' ).removeClass( 'hide' ).addClass( 'show' ).hide().fadeIn( 550 );
					$( ".result-s ul" ).empty();
					$.each(xhr.data, function() {
						var strHTML = $('#tpl_res').html();
						var m = strHTML.match(/##([\w]+)##/g), data = this;
						for(var i=0; i<m.length; i++) {
							var mv = m[i].substring(2, m[i].length-2);
							strHTML = strHTML.replace(m[i], data[mv]);
						}
						$( ".result-s ul" ).append(strHTML);
					});
			}else{
				toastr.success('Your torrent has been added.');
			}
		}			
    },
	complete: function(xhr) {
		$.fancybox.hideLoading();
	}
}); 


})( jQuery );
</script>

    <div class="container">
        <div class="flat-form">
            <ul class="tabs">
                <li>
                    <a href="#file" class="active">File</a>
                </li>
                <li>
                    <a href="#url">URL</a>
                </li>
				<li>
                    <a href="#magnet">Magnet</a>
                </li>	
				<li>
                    <a href="#search">Search</a>
                </li>
				<li>
                    <a href="#add-on">Add-on</a>
                </li>
				<li id="results" class="res-tab" style="display:none;">
                    <a href="#results">Results</a>
                </li>
            </ul>
            <div id="file" class="form-action show">
                <h1>Upload a .torrent file</h1>
                <p>
					Upload a .torrent file up to 500kb in size.<br><br>
                </p>
                <form action="/upload/file" method="post">
                    <ul>
                        <li>
                            <input type="file" name="file" />
                        </li>    
						<div id="error"></div>
                        <li>
                            <input type="submit" value="Upload" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
            <div id="url" class="form-action hide">
                <h1>Upload via URL</h1>
                <p>
                    Type or paste the URL to any torrent file.
					<br><br>
                </p>
                <form action="/upload/data" method="post">
                    <ul>
                        <li>
                            <input type="text" name="tdt" placeholder="URL" maxlength="150"/>
                        </li>
     
                        <li>
                            <input type="submit" value="Upload" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
			<div id="magnet" class="form-action hide">
                <h1>Upload via Magnet</h1>
                <p>
                    Type or paste the magnet to any torrent.
					<br><br>
                </p>
                <form action="/upload/data" method="post">
                    <ul>
                        <li>
                            <input type="text" name="tdt" placeholder="Magnet URL" />
                        </li>
     
                        <li>
                            <input type="submit" value="Upload" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
			<div id="search" class="form-action hide">
                <h1>Search</h1>
                <p>
                    Search for torrents.
					<br><br>
                </p>
                <form action="/upload/search" method="post">
                    <ul>
                        <li>
                            <input type="text" name="st" placeholder="Search for Torrents" />
                        </li>
     
                        <li>
                            <input type="submit" value="Search" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
			<div id="add-on" class="form-action hide">
                <h1>OneClick Torrent Adder</h1>
                <p>
                    Use our browser add-on to add torrents to your account within a click.
					<br><br>
                </p>
					<ul>
						<li style="padding-bottom: 20px;text-align:center; float:left;">
                           <a style="color:white;" target="_blank" href="https://chrome.google.com/webstore/detail/datas-oneclick-torrent-ad/jhhfnjdjhbjomeojpdjfmjbmihklfigg"><img src="{{ URL::asset('/include/img/icons/chrome.png') }}" alt="Chrome extension" height="64" width="64"/>
						   <p>Chrome</p></a>
                        </li> 
						<li style="padding-left: 20px;text-align:center; float:left;">
                          <a style="color:white;" target="_blank"  href="https://addons.mozilla.org/en-US/firefox/addon/dat-as-torrent-adder/" ><img src="{{ URL::asset('/include/img/icons/mozilla.png') }}" alt="Firefox extension" height="64" width="64">
						   <p>Firefox</p></a>
                        </li> 
						<li style="padding-left: 20px;text-align:center; float:left;">
                           <img src="{{ URL::asset('/include/img/icons/opera.png') }}" alt="Chrome extension" height="64" width="64">
						   <p style="padding-bottom: 0px !important;">Opera</p>
						    <p>Coming Soon</p>
                        </li> 
                    </ul>
            </div>
			<div id="results" class="form-action results-sec hide">
				<div class="result-s">
					<ul>
					</ul>
				</div> 
            </div>
        </div>
    </div>

	<script id="tpl_res" type="text/template">
		<li>
		<form action="/upload/data" method="post">
		  <button onclick="return false;" class="button"> Add </button>
		  <h3>##title##</h3>
		  <p>Seeds: ##seeds## &nbsp&nbspPeers: ##peers## &nbsp&nbsp Size: ##size##</p>
			<input type="hidden" name="tdt" value="##link##">
		</form>
		</li> 
	</script>

