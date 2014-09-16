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
        <h3>Payment Dashboard</h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-3 pull-right">
                  <form action="#">
                    <span>Period</span>
                    <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" name="" id="">
                    @if(!Input::has('p') || Input::get('p') == 't')
						<option selected="selected" value="{{ URL::to('earn/stats?p=t') }}">Today</option>
					@else
						<option value="{{ URL::to('earn/stats?p=t') }}">Today</option>
					@endif
					@if(Input::get('p') == 'y')
                      <option selected="selected" value="{{ URL::to('earn/stats?p=y') }}">Yesterday</option>  
					@else
						 <option value="{{ URL::to('earn/stats?p=y') }}">Yesterday</option>  
					@endif
					@if(Input::get('p') == 'w')
						<option selected="selected" value="{{ URL::to('earn/stats?p=w') }}">This Week</option>
					@else
						<option value="{{ URL::to('earn/stats?p=w') }}">This Week</option>
					@endif
					@if(Input::get('p') == 'm')
						<option selected="selected" value="{{ URL::to('earn/stats?p=m') }}">This Month</option>
					@else
						<option value="{{ URL::to('earn/stats?p=m') }}">This Month</option>
					@endif
					@if(Input::get('p') == '3m')
						<option selected="selected" value="{{ URL::to('earn/stats?p=3m') }}">Last 3 Months</option>
					@else
						<option value="{{ URL::to('earn/stats?p=3m') }}">Last 3 Months</option>
					@endif
                    </select>
                  </form>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <ul class="nav nav-tabs" style="margin-bottom: 15px;margin-top: -57px;">
                <li class="active" id="imp"><a href="#" >Earnings</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="impressions">
                  <div class="row">
                    <div class="col-md-12">
                      <div id="imp-graph"></div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade active in" id="clicks">
                  <div class="row">
                    <div class="col-md-12">
                      <div id="click-graph"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="well well-sm">
        <div class="row">
          <div class="col-md-3 stats st">
            <h4>$ {{ Auth::user()->cash_out }}</h4>
            <span class="stat-heading">Last Earnings</span>
          </div>
          <div class="col-md-3 stats st">
            <h4>{{$total_user_views}}</h4>
            <span class="stat-heading">Views</span>
          </div>
          <div class="col-md-3 stats st">
            <h4>{{ $files }} </h4>
            <span class="stat-heading">Shared Files</span>
          </div>
          <div class="col-md-3 stats">
            <h4>$ {{$total_user_earnings}}</h4>
            <span class="stat-heading">Total Earnings</span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Country</th>
                <th>views</th>
                <th>rate</th>
                <th>earnings</th>
              </tr>
            </thead>
            <tbody>
@foreach($country as $c)	
              <tr>
                <td>{{$c->country}}</td>
                <td>{{$c->total}}</td>
                <td><strong>$ {{$c->rate}}</strong></td>
                <td><strong>$ {{$c->earnings}}</strong></td>
              </tr>
@endforeach			  
            </tbody>
          </table>
        </div>
      </div>
      
    </div> <!-- /container -->        

        <script src="{{ URL::asset('include/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('include/js/raphael-min.js') }}"></script>
        <script src="{{ URL::asset('include/js/morris.js') }}"></script>
        <script>

  Morris.Area({
    element: 'imp-graph',
    data: [
	    <?php $total_raws= count($graph) - 1; $count_raws = 0;?>
	@foreach($graph as $g)
		@if($total_raws <= $count_raws)
			{ period: '{{$g["date"] }}', v: {{$g["views"] }}, e:{{$g["earnings"]}}}
		@else
			{ period: '{{$g["date"] }}',v: {{$g["views"] }}, e:{{$g["earnings"]}}},
		@endif
		<?php $count_raws++; ?>
	@endforeach
    ],
    xkey: 'period',
	xLabels: 'month',
	preUnits: '$',
    ykeys: ['e' , 'v'],
    labels: ['Earnings','Views'],
	lineColors: ['#2577b5','#7cb47c'],
    pointSize: 3,
    hideHover: 'auto'
  });
		</script>
@stop