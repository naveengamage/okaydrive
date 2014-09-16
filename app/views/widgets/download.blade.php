<style>
.fluid-width-video-wrapper {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100% !important;
    height: 90% !important;
}
body {
    overflow:hidden;
}
.container h1{
	margin-top: 20px;
}

h1,h2,.container p,.container a,.container ol,.container ul,.container li,
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
}

.result-s li:hover {
  background: #3f81bc;
  cursor: pointer;
}	

	
</style>

    <div class="container">
        <div class="flat-form">
            <ul class="tabs">
                <li>
                    <a id="play-tab" href="#player-tab" class="active">Play</a>
                </li>
                <li>
                    <a href="#download">Download</a>
                </li>
				<li>
                    <a href="#subs">Subtitles</a>
                </li>
				<li>
                    <a href="#convert">Convert</a>
                </li>
				<li>
                    <a href="#info">Info</a>
                </li>
				<li class="sub-tab" style="display:none;">
                    <a href="#results">Results</a>
                </li>
            </ul>            
			<div id="player-tab" style="display: block;" class="form-action-player">
					 <div class="fluid-width-video-wrapper">
							<a  
								 href="https://ia600508.us.archive.org/11/items/mortdegerry/mortdegerry_512kb.mp4"
								 style="width:100%;height:100%"  
								 id="player"> 
							</a> 
					</div>
       
            </div>  
            <!--/#login.form-action-->
            <div id="download" class="form-action hide">
                  <h1>Download</h1>
                <p>
					Size: 1 MB <br>
					Type: AVI <br><br>
                </p>
                    <ul>
                        <li style="width: 50%;margin: 0px auto 0px auto;">
                            	<span class="bg-button red">
									<span class="icon" style="background-image: url(http://www.okilla.com/example/2013/7/959/images/down-icon.png);"></span>
									<span class="text">
										Download
									</span>
							</span>
                        </li>
                    </ul>
            </div>
            <!--/#register.form-action-->
			<div id="subs" class="form-action hide">
			<h1>Subtitles</h1>
			<h2 style="padding-top: 10px;">Search</h2>
			
			<form action="/torrent/79816060ea56d56f2a2148cd45705511079f9bca/file/5/subs" method="post">
				<ul> 
					<input type="hidden" name="q" value="rush">
					<li style="padding-bottom: 20px;" >
						<label> Select language </label>
						<select name="l">
						<option value="eng">English</option>
						<option value="Abkhazian">Abkhazian</option>
						</select>
					</li> 
					<li>
						<input type="submit" value="Search" class="button" />
					</li>
				</ul>
			</form>
			<h2 style="padding-top: 20px;">or Upload a subtitle file </h2>
                <form action="/get/subs/file" method="post">
                    <ul>
                        <li>
                            <input type="file" name="file" />
                        </li>    
                        <li>
                            <input type="submit" value="Upload" class="button" />
                        </li>
                    </ul>
                </form>
            </div>
			<div id="convert" class="form-action hide">

            </div>
			<div id="info" class="form-action hide">
				<h1>File Info</h1>
                <p>
					Size: 1 MB <br>
					Type: AVI <br><br>
                </p>
            </div>
            <!--/#register.form-action-->
			<div id="results" class="form-action hide sub-result">
				<div class="result-s">
				  <ul>
				  </ul>
				</div>  
            </div> 
        </div>
    </div>	