@extends('layouts.master')
@section('content')
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ URL::asset('include/css/bootstrap.css') }}">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
				padding-left: 150px;
            }
        </style>
        <link rel="stylesheet" href="{{ URL::asset('include/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('include/css/main.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('include/css/morris-0.4.3.min.css') }}">
        <script src="{{ URL::asset('include/js/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>

   <div class="container">
   
      <div class="page-header">
					<p class='message' id='NoticeMessage'>
						Share some files to start earning. How? Go to the torrent page -> Click on 'SHARE' button on top & get the link. Give the link to others and get paid when they view.
					</p>
        <h3>Payment Rates</h3>
      </div>

      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Country</th>
                <th>Rate</th>
                <th style="width:250px;">payment per 1000 views</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>United States, United Kingdom, Germany, Ireland, Russia, Switzerland, Denmark, Greece, Poland</td>
                <td class="status">HIGH</td>
                <td><strong>$3</strong></td>
              </tr>
              <tr>
                <td>Belgium, Norway, Slovakia, Czechia, Japan, Canada, France, Great Britain, Australia, Austria, Belarus, Israel, Ireland, Italy, Emirates, Portugal, Romania, Ukraine, Switzerland, Sweden, Southern Africa</td>
                <td class="status">GOOD</td>
                <td><strong>$2</strong></td>
              </tr>
              <tr>
                <td>Azerbaijan, Armenia, Georgia, Islandia, Qatar, Kuwait, Luxembourg, Moldova, Monaco, Saudi Arabia, Singapore, Uzbekistan, Croatia, Brazil, Hungary, Vietnam, Hong Kong, Indonesia, Iraq, Kirghizia, Mexico, New Zealand, Serbia, Thailand, Chile</td>
                <td class="status">GOOD</td>
                <td><strong>$1</strong></td>
              </tr>
              <tr>
                <td>Other countries</td>
                <td class="status">NORMAL</td>
                <td><strong>$0.20</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
    </div> <!-- /container -->        

        <script src="{{ URL::asset('include/js/bootstrap.min.js') }}"></script>

  
        <script>
        $(document).ready(function(){
          $('#clicks').hide();
          $('#click_li').on('click',function(e){
            e.preventDefault();
            // alert('sss');
            $(this).addClass('active');
            $('#imp').removeClass('active');
            $('#impressions').removeClass('active in').hide();
            $('#clicks').addClass('active in').show();
          });
          $('#imp').on('click',function(e){
            e.preventDefault();
            $(this).addClass('active');
            $('#click_li').removeClass('active');
            $('#clicks').removeClass('active in').hide();
            $('#impressions').addClass('active in').show();
            
          });
        });
        </script>





@stop