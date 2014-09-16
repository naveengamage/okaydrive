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
  width: 580px;
  height: 420px;
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
 .faq {
	cursor: hand;
	cursor: pointer;
	border: 1px solid #CCC;
	margin-top: 10px;
	padding: 10px;
}
 .ans { 
	display:none;
	margin-top:7px;
}

#faq {
  margin: 20px;
  height: 352px;
  overflow:auto;
  overflow-x: hidden;
}

#faq li {

  overflow: auto;
  overflow-x: hidden;
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
				<a href="#faq" class="active">FAQ</a>
			</li>
			<li>
				<a href="#chat">Chat</a>
			</li>
			<li>
				<a href="#message">Message</a>
			</li>
		</ul>            
		<!--/#faq.form-action-->
		<div id="faq" class="form-action show">

			<ul>
			<li>
				<div class="faq" onclick="toggle('faq1')">
				 What is DAT.AS?
				 <div id="faq1" class="ans">DAT.AS is a web based service which fetches torrents super fast for users and let them play, stream or download torrents.</div>
				</div>
			</li>
			<li>
				<div class="faq" onclick="toggle('faq2')">
				 Why should I use DAT.AS to download my torrents?
				 <div id="faq2" class="ans">There are multiple reasons to use our services to download your torrents.<br><br> 
				 1). Imagine if you have a internet connection with 500 KBPs, you will have to wait hours to watch something in a torrent but DAT.AS can fetch torrents super fast so you can start watching torrents immediately without waiting. <br><br> 
				 2). Some Internet Service Providers/Companies limits download speeds when you download torrents but they cannot limit any regular web-based download speeds. <br><br> 
				 3). People/Organizations could be watching what you are doing on the internet, DAT.AS is a completely anonymous and secure service, we download your torrents for you and gives you regular web-based download links.<br>
				 </div>
				</div>
			</li>
			<li>
				<div class="faq" onclick="toggle('faq3')">
				 Do you seed after downloading my torrent?
				 <div id="faq3" class="ans">Bit-torrent lives upon sharing files, if everyone only downloads a file and never uploads it for others, Bit-torrent will die. Despite the bandwidth costs we seed every torrent up to ratio of 1:1 before it stops seeding. 
				 </div>
				</div>
			</li>
			<li>
				<div class="faq" onclick="toggle('faq4')">
				 Do you provide support for DAT.AS users?
				 <div id="faq4" class="ans">Yes, we always have a support representative on-line to help our users via chat in real time. If the problem needs more time to solve, the support representative will be in touch with the user via email. <br><br>
				 Our online support is available 08:00 a.m. NZST to 11:30 p.m. NZST on weekdays and  07:00 p.m. NZST to 03:00 a.m.on weekends.
				 </div>
				</div>
			</li>
			<li>
				<div class="faq" onclick="toggle('faq5')">
				 How do I add a torrent?
				 <div id="faq5" class="ans"> You can add torrents by pressing "New Torrent" on the top of the page, you may add a torrent via a .torrent file,a file URL,a file magnet or by searching. We also have a browser add-on which lets our users to add torrents from many torrent indexing sites.
				 </div>
				</div>
			</li>
			</ul>
		</div>
		<!--/#chat.form-action-->
		<div id="chat" class="form-action hide">

			<ul>

			</ul>
		</div>
		<!--/#message.form-action-->
		<div id="message" class="form-action hide">

			<ul>

			</ul>
		</div>
	</div>
</div>
</body>
</html>