<?php

class Media extends Eloquent {

	protected $table = 'media';
	
	protected $guarded = array();

	public static $rules = array(
		'user_id' => 'required',
		'title' => 'required'
	);

	public function files(){
		return $this->hasMany('MediaLike');
	}	
	
	public function getFiles(){
		return MediaLike::where('media_id', '=',$this->id)->get();
	}	
	
	public function totalUsers(){
		return $this->hasMany('UserMedia')->count();
	}	
	
	public function userMedia(){
		return UserMedia::where('media_id', '=',$this->id)->where('user_id', '=', Auth::user()->id)->first();
	}
	
	public function usersMedia(){
		return UserMedia::where('media_id', '=',$this->id)->get();
	}
	
	public function folders(){
		return $this->hasMany('MediaFlag');
	}
	
	public function user(){
		return $this->belongsTo('User')->first();
	}
	
	public function downloading(){
		return $this->state != 'done';
	}
	
	public function isConverting(){
		$conv = MediaConvert::where('media_id', '=',$this->id)->where('state', '!=','done')->count();
		if($conv == 0){
			return false;
		}
		return true;
	}
}
