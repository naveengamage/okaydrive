@extends('layouts.master')
@section('content')
	<div id="main" role="main">

		<?php
		
			$user_media_count =  UserMedia::where('user_id', '=', Auth::user()->id)->where('cat','!=', '1')->count();
			if(Auth::user()->category_id == 1 && $user_media_count != 0){
					?> <p class='message' id='NoticeMessage'>
						Some of your files will be deleted in 2 days. Upgrade to premium to have unlimited torrents.
					</p>
				<?php
			}
			?>
		<ul id="tiles">
		@foreach($media as $torrent)
			@if($torrent->state == "failed" || $torrent->state == "fail_free")
				<li class="media-tile failed" data-id="{{$torrent->uni_id}}" style="position: absolute; top: 0px; left: 61px; display: list-item;">
					<a href="/torrent/{{$torrent->uni_id}}">
					<img src="include/img/filetype/failed.png" height="130" width="130"></a>
					<a href="/torrent/{{$torrent->uni_id}}"><p>{{$torrent->title}}</p></a>
				</li>
			@elseif($torrent->state == "done")
					<li class="media-tile completed" data-id="{{$torrent->uni_id}}" style="position: absolute; top: 0px; left: 61px; display: list-item;">
					<a href="/torrent/{{$torrent->uni_id}}">
					@if($torrent->max_file_id != 0)
					<img src="/snaps/thumbs/{{$torrent->id}}/{{$torrent->max_file_id}}/1.jpg" height="130" width="130"></a>
					@else
					<img src="include/img/filetype/completed.png" height="130" width="130"></a>
					@endif
					<a href="/torrent/{{$torrent->uni_id}}"><p>{{$torrent->title}}</p></a>
				</li>
			@elseif($torrent->state == "deleted" || $torrent->state == "delete")
				<li class="media-tile deleted" data-active="false" data-id="{{$torrent->uni_id}}" style="position: absolute; top: 0px; left: 61px; display: list-item;">
					<a href="#">
					<img src="include/img/filetype/deleted.png" height="130" width="130"></a>
					<a href="#"><p>{{$torrent->title}}</p></a>
				</li>
			@else				
				<li class="media-tile active" data-id="{{$torrent->uni_id}}" style="position: absolute; top: 0px; left: 61px; display: list-item;">
					<a href="/torrent/{{$torrent->uni_id}}">
					<img src="include/img/filetype/active.png" height="130" width="130"></a>
					<a href="/torrent/{{$torrent->uni_id}}"><p>{{$torrent->title}}</p></a>
				</li>
			@endif
		@endforeach
		</ul>
	</div>
@stop