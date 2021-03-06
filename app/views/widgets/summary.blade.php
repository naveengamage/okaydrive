<style>
h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{font-weight:inherit}
h1{font-size:28px;line-height:50px}
h2{font-size:22px;line-height:30px}
h3{font-size:16px;line-height:34px}
h4{font-size:14px;line-height:30px}
h5{font-size:12px;line-height:24px}
h6{font-size:10px;line-height:21px}
#show-result{font:normal 14px/20px maven_proregular, Helvetica, sans-serif;color:#A7A7A7;background:#f7f7f7 url(../images/admin-body.jpg)}
a{cursor:pointer;color:#afc98c;text-decoration:none;-webkit-transition:all .35s ease;-moz-transition:all .35s ease;-o-transition:all .35s ease;transition:all .35s ease;outline:none}
a:hover,a.hover,a:focus{color:#1668b5;-webkit-transition:all .55s ease;-moz-transition:all .55s ease;-o-transition:all .35s ease;transition:all .55s ease;outline:none}
hr,.hr2,.hr3,.h4{border:none;clear:both;height:0;background:none;border-bottom:#e4e4e4 solid 1px;box-shadow:0 1px 0 0 #FFF;margin:10px 0;padding:0}
.hr2{margin-top:30px;margin-bottom:30px}
.hr3{height:8px;background:none repeat scroll 0 0 #f9f9f9;border-radius:2px 2px 2px 2px;box-shadow:0 1px 1px rgba(0,0,0,0.1) inset;border:0;margin:5px}
.hr4{height:16px;font-size:10px;line-height:18px;text-transform:uppercase;background:none repeat scroll 0 0 #f9f9f9;border-radius:0;box-shadow:0 1px 1px rgba(0,0,0,0.1) inset;border:0;font-weight:600;text-align:center;color:#3B3E40;letter-spacing:1px;margin:5px}
.avatar,.avatar2{background-color:#FFF;box-shadow:0 1px 1px rgba(0,0,0,0.2);padding:2px}
.box{padding:10px}
#usermenu{margin-top:25px;margin-bottom:25px}
#usermenu a i{font-size:40px;display:block;margin-bottom:7px;line-height:40px;height:40px}
#usermenu a{text-align:center;border-radius:3px;font-size:16px;background-color:#363636;display:inline-block;font-weight:300;margin-bottom:4px;text-shadow:1px 1px 0 #000;box-shadow:0 2px 4px rgba(0,0,0,0.2);padding:5px 15px}
#logo{text-align:center;margin-top:25px;margin-bottom:25px;background-color:#363636;height:60px;line-height:60px;border-radius:3px;box-shadow:0 2px 4px rgba(0,0,0,0.2);padding:10px}
#logo img{display:inline-block;vertical-align:middle}
input[type=text],input[type=email],input[type=search],input[type=password],textarea{-webkit-appearance:none;background:#fff}
input,textarea{color:#606060;border:2px solid #e4e4e4;background:#fff;width:100%;border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;margin:0 0 15px;padding:10px}
input:focus,textarea:focus{border:2px solid #d6d4d4}
.butsmall,.butsmallalt{border:1px solid #323537;min-width:20px!important;color:#fff;text-align:center;position:relative;border-radius:2px;-webkit-border-radius:2px;-moz-border-radius:2px;box-shadow:inset 0 1px 0 rgba(255,255,255,0.2);-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,0.2);-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,0.2);text-shadow:1px 1px 0 rgba(0,0,0,0.4);z-index:500;background:linear-gradient(tobottom,#4b4f510%,#414547100%);cursor:pointer;margin:0 0 0 5px;padding:5px!important}
.butsmallalt{box-shadow:none;-webkit-box-shadow:none;-moz-box-shadow:none}
.butsmallalt:hover{background:#4b4f51}
.butsmall.green{text-shadow:1px 1px 0 rgba(0,0,0,0.2);border:1px solid #719e37;background:linear-gradient(tobottom,#9bc7470%,#82bd42100%)}
.butsmall.red{text-shadow:1px 1px 0 rgba(0,0,0,0.2);border:1px solid #af2b1b;background:linear-gradient(tobottom,#bc34230%,#cd4433100%)}
.user .blue{border:1px solid #323537}
.blue{border:1px solid #0f70ad;text-shadow:1px 1px 0 rgba(0,0,0,0.2);background:linear-gradient(tobottom,#208ed30%,#0272bd100%)}
.button.green{text-shadow:1px 1px 0 rgba(0,0,0,0.2);border:1px solid #719e37;background:linear-gradient(tobottom,#9bc7470%,#82bd42100%);margin:0}
.but-small-icon{font-size:24px;display:block;float:right;width:24px;height:24px;line-height:24px;margin-left:5px;text-align:center}
.bgred,.bggreen,.bgblue,.bgorange{border-radius:4px;box-shadow:0 1px 0 #FFF inset, 0 2px 4px rgba(0,0,0,0.08);position:relative;margin:15px 0;padding:10px}
.bgred p,.bggreen p,.bgblue p,.bgorange p{color:#fff;text-shadow:1px 1px 0 rgba(0,0,0,0.2);margin:0 10px 0 0}
.bgblue{background:#88bbc8;border:1px solid #88bbc8}
.bgred{background:#ee9695;border:1px solid #ee9695}
.bgorange{background:#ffba83;border:1px solid #ffba83}
.bggreen{background:#afc98c;border:1px solid #afc98c}
.close,div.bggreen .close,div.bgorange .close,div.bgred .close,div.bgblue .close{color:#000;cursor:pointer;font-size:24px;opacity:0.2;position:absolute;right:10px;text-shadow:0 1px 0 #fff;top:8px}
div.bgred p span,div.bggreen p span,div.bgorange p span,div.bgblue p span{display:inline-block;margin-right:10px}
div.bgred ul.error{color:#fff;margin-left:35px}
.pagetip,.greentip,.redtip,.orangetip,.bluetip{background:#F3F3F3;border:1px solid #F3F3F3;border-radius:4px;box-shadow:0 1px 0 #FFF inset, 0 2px 4px rgba(0,0,0,0.08);color:#818181;margin-bottom:25px;text-shadow:0 1px #fff;padding:15px}
.greentip{background:#afc98c;color:#fff;text-shadow:1px 1px 0 rgba(0,0,0,0.2);border-color:#afc98c}
.redtip{background:#ee9695;color:#fff;text-shadow:1px 1px 0 rgba(0,0,0,0.2);border-color:#ee9695}
.orangetip{background:#ffba83;color:#fff;text-shadow:1px 1px 0 rgba(0,0,0,0.2);border-color:#ffba83}
.bluetip{background:#88bbc8;color:#fff;text-shadow:1px 1px 0 rgba(0,0,0,0.2);border-color:#88bbc8}
.widget-container{height:1%;overflow:hidden;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
.widget-container .small:first-child{float:left}
section.small{width:49%;float:right;box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box}
section.widget{background:#fff;border:1px solid #f6f6f6;min-height:120px;border-radius:5px;box-shadow:0 2px 2px rgba(204,204,204,0.2);-webkit-box-shadow:0 2px 2px rgba(204,204,204,0.2);-moz-box-shadow:0 2px 2px rgba(204,204,204,0.2);box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;margin:10px 0 25px}
section.widget header{background-color:#3A3A3A;border:1px solid #343434;color:#F2F2F2;display:block;text-shadow:0 1px 0 #000;border-bottom:none;overflow:visible;border-radius:5px 5px 0 0;line-height:20px;padding:10px}
section.widget header h1{font-family:maven_proregular, sans-serif;line-height:30px;font-size:18px;color:#fff;float:left}
section.widget header h3{font-family:maven_proregular, sans-serif;font-size:12px;color:#5daced}
section.widget header aside{float:right}
section.widget form header{background:transparent;display:block;width:100%;border-bottom:2px solid #ebebe6;font-size:18px;color:#232323;box-shadow:0 2px 0 0 #FFF;margin:0 -30px 30px;padding:0 30px 20px}
section.widget form header span{display:block;font-size:13px;color:#BEBEBE}
section.widget .content{padding:25px}
section.widget header aside > a{display:block;background:#313131;color:#FFF;border-top:1px solid #1c1f23;border-bottom:1px solid #4c4f56;position:relative;font-size:16px;border-radius:4px;margin:0;padding:3px 8px}
.fixed{position:fixed}
section.widget .content2,section.widget .content.no-padding{padding:0}
table.myTable input[type=checkbox]{width:30px;margin:0}
table.myTable th:first-child{padding-left:10px}
table.myTable tr:nth-child(odd){background:#fff}
table.myTable{border:1px solid #f6f6f6;width:100%;border-radius:5px}
table.myTable th.first{min-width:30px}
table.myTable thead tr{border-bottom:1px solid #fff}
table.myTable tr{border:1px solid #f4f4f4;background:#f9f9f9}
table.myTable tr:hover{background:#afc98c;color:#fff;cursor:pointer}
table.myTable tr.nohover:hover{background:transparent;cursor:default}
table.myTable th{font-weight:400;min-width:20px;text-align:left}
table.myTable td.nowrap{white-space:nowrap}
table.myTable td{vertical-align:middle;padding:15px}
table.myTable thead tr .header{background-image:url(../images/sort.gif);background-repeat:no-repeat;background-position:-5px 17px;cursor:pointer;padding-left:20px;line-height:1em;height:2em;background-color:#F3F3F3;font-weight:300;text-transform:uppercase;font-size:12px;text-shadow:0 1px 0 #fff;color:#666;font-family:maven_probold}
table.myTable thead tr .headerSortUp{background-image:url(../images/asc.gif)}
table.myTable thead tr .headerSortDown{baeckground-image:url(../images/desc.gif)}
table.myTable thead tr th.avatar{padding-left:70px}
table.myTable td.avatar{line-height:30px}
table.myTable td.avatar img{float:left;margin:0 15px 0 0}
.dataview tr td:first-child{width:180px!important;word-wrap:break-word}
span.tbicon,.tbicon{background:#333;display:inline-block;height:26px;width:32px;border-radius:3px;margin-top:1px;margin-bottom:1px}
span.tbicon a{color:#fff;display:block;text-align:center;line-height:26px}
span.tbicon.large{width:40px;height:32px;background:#eee;border:1px solid #c4c4c4;box-shadow:0 1px 0 0 #FFF}
span.tbicon.large a{line-height:32px;color:#3B3E40;box-shadow:0 1px 0 0 #FFF}
table.myTable thead tr:hover,table.myTable thead tr .headerSortDown,table.myTable thead tr .headerSortUp{color:#208ed3}
.messi-modal{position:absolute;top:0;left:0;width:100%;height:100%;overflow:hidden;background:rgba(11,11,11,0.6)}
.messi{position:absolute;background-color:#fff;box-shadow:0 3px 7px rgba(0,0,0,0.3);min-width:200px;min-height:50px;max-width:90%;max-height:75%;overflow-y:auto;margin:0;padding:0}
.messi-box{position:relative;height:auto;overflow:hidden;opacity:1}
.messi-wrapper{position:relative}
.messi-titlebox{font-size:16px;overflow:hidden;border-bottom:1px solid #ddd;background:none repeat scroll 0 0 #f8f8f8;height:45px;line-height:45px;padding:0 15px}
.messi-closebtn{border-left:1px solid rgba(0,0,0,0.1);position:absolute;top:0;right:0;display:block;width:45px;height:45px;cursor:pointer;text-align:center;line-height:45px;font-size:30px}
.messi-content{overflow:hidden;background:#f2f2f2;padding:15px}
.messi-footbox{background-color:#f5f5f5;border-top:1px solid #ddd;box-shadow:0 1px 0 #fff inset;padding:0}
.messi-actions{display:block}
.messi-actions .btnbox{display:block;float:right;border-left:1px solid rgba(0,0,0,0.1);line-height:45px;height:45px}
.messi .mod-button{display:block;line-height:43px;height:43px;margin-top:1px;padding-right:30px;padding-left:15px}
.messi .mod-button i{padding-left:10px;padding-right:5px}
#tooltip{border-radius:5px;font:normal 11px/16px FMSlimRegular, Helvetica, sans-serif;text-align:center;color:#fff;background:#111;position:absolute;z-index:9000;padding:10px}
#tooltip:after{width:0;height:0;border-left:10px solid transparent;border-right:10px solid transparent;border-top:10px solid #111;content:'';position:absolute;left:50%;bottom:-10px;margin-left:-10px}
#tooltip.top:after{border-top-color:transparent;border-bottom:10px solid #111;top:-20px;bottom:auto}
#tooltip.left:after{left:10px;margin:0}
#tooltip.right:after{right:10px;left:auto;margin:0}
#loader{position:absolute;width:100%;height:100%;display:block;overflow:hidden;background:rgba(0,0,0,0.6);z-index:1000000;background-image:url(../images/loader.gif);background-repeat:no-repeat;background-position:50% 50%}
.loading,.sloading{height:30px;width:30px;margin-left:5px;display:none;float:left;background:url(../images/ajax-loader.gif) 50% 50% no-repeat}
.sloading{margin-top:10px;height:39px;width:39px}
#plans .plan{text-align:center;margin-top:20px;background:#F3F3F3;border:1px solid #F3F3F3;border-radius:4px;box-shadow:0 1px 0 #FFF inset, 0 2px 4px rgba(0,0,0,0.08);color:#818181;margin-bottom:25px;text-shadow:0 1px #fff}
#plans .plan h2{font-size:1.8em;font-weight:300;color:#3A3A3A;margin:0;padding:.6em 0}
#plans .plan p.price{background:#88bbc8;color:#fff;font-size:1.2em;font-weight:300;height:2.6em;line-height:2.6em;margin:0}
#plans .plan p.recurring,#plans .plan p.desc,#plans .plan p.pbutton{border-bottom:1px solid #eee;padding:10px}
#plans .plan p.pbutton a,#plans .plan p.pbutton i{display:block;height:2em;line-height:2em}
footer{text-align:center;text-shadow:0 1px #fff;margin-top:25px}
#usermenu a:hover,.button a,.butsmall i,section.widget header aside a,table.myTable tr:hover a{color:#fff}
section.widget header aside a:hover,table.myTable thead tr .header:hover{color:#afc98c}
section.widget .content .stats-wrapper:last-child div,section.widget .content .stats-wrapper .stats p,#msgholder{margin:0}
@media only screen and max-width 767px,only screen and max-device-width 767px {
.testing{position:fixed;top:0;width:100%;z-index:1500}
section.alert{height:auto!important;transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out}
section.content{transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out;margin:85px 0 0;padding:15px}
section.alert div{transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out;margin:15px 15px 15px 10px}
.widget-container .small:first-child,.widget-container .small{float:none;width:100%;height:auto!important;transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out}
span.icon{font-size:48px;transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out}
section.user .profile-img{display:none;transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out}
header input{width:30%}
section.widget header span.icon,.button.dropdown,section.alert div span{display:none}
button.ico-font{opacity:1}
section.user .buttons{left:15px;right:auto}
.widget button{margin:0 5px 10px 0}
section.alert button{right:15px;float:right;margin:5px 0 10px 5px}
body.login{padding-top:50px}
.login section{width:85%;margin:0 auto}
.login section h1{font-size:32px}
header.main,section.widget header,section.widget .content{padding:15px}
section.widget header hgroup,section.alert div p{margin:0}
}
@media only screen and min-width 768px and max-width 1024px {
section.content{transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out;margin:75px 0 0 70px}
section.alert div{transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out;margin:15px 25px 15px 90px}
}
@media only screen and min-device-width 768px and max-device-width 1024px and orientation landscape {
section.content{transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out;margin:75px 0 0 210px}
section.alert div{transition:all .5s ease-in-out;-o-transition:all .5s ease-in-out;-moz-transition:all .5s ease-in-out;-webkit-transition:all .5s ease-in-out;margin:15px 25px 15px 235px}
}
@media only screen and -webkit-min-device-pixel-ratio 2,only screen and min--moz-device-pixel-ratio 2,only screen and -o-min-device-pixel-ratio 21,only screen and min-device-pixel-ratio 2,only screen and min-resolution 192dpi,only screen and min-resolution 2dppx {
div.wysiwyg ul.toolbar li{background:#313131 url(../images/jquery.wysiwyg-retina.png) no-repeat;background-size:180px!important}
div.wysiwyg ul.toolbar li.bold{background-position:0 0;background-size:180px!important}
.jquery-checkbox img{background:transparent url(../images/checkbox-retina.png) no-repeat;background-size:75px auto}
}
</style>
<div id="show-result"><div class="box">
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="pp_form" name="pp_form">
    <table class="myTable">
        <tbody><tr>
          <td colspan="2"><h2>Purchase Summary</h2></td>
        </tr>
      <tr>
        <th><strong>Membership Title:</strong></th>
        <td><strong>{{$name}}</strong></td>
      </tr>
      <tr>
        <th><strong>Membership Price:</strong></th>
        <td><strong>{{$price}}</strong></td>
      </tr>
      <tr>
        <th><strong>Membership Period:</strong></th>
        <td><strong>{{$period}}</strong></td>
      </tr>
      <tr>
        <th><strong>Recurring Payment:</strong></th>
        <td><strong>Yes</strong></td>
      </tr>
      <tr>
        <th><strong>Valid Until:</strong></th>
        <td><strong>{{$valid}}</strong></td>
      </tr>
      <tr>
        <th><strong>Cancellation Policy:</strong></th>
        <td>Anytime</td>
      </tr>
      <tr class="nohover">
        <td colspan="2"><input type="image" src="{{URL::asset("include/img/gateway/paypal_big.png")}}" name="submit" style="vertical-align:middle;border:0;width:264px;margin-right:10px" title="Pay With Paypal" alt="" onclick="document.pp_form.submit();"> </td>
      </tr>
    </tbody></table>
	<input type="hidden" name="cmd" value="_xclick-subscriptions">
	<input type="hidden" name="a3" value="{{$amount}}">
	<input type="hidden" name="p3" value="{{$item_period}}">
	<input type="hidden" name="t3" value="{{$item_period_type}}">
	<input type="hidden" name="src" value="1">
	<input type="hidden" name="sra" value="1">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="business" value="paypal-datas@mail.ru">
	<input type="hidden" name="item_name" value="{{$name}}">
	<input type="hidden" name="item_number" value="{{$item_number}}">
	<input type="hidden" name="return" value="https://dat.as/?thanks=1">
	<input type="hidden" name="cancel_return" value="http://dat.as/?cancel=1">
	<input type="hidden" name="currency_code" value="USD">	
  </form>
</div></div>