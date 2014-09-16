<?php

class MediaLike extends Eloquent {

	protected $table = 'media_files';
	protected $guarded = array();
	public static $rules = array();

	public function user(){
		return $this->belongsTo('User')->first();
	}

	public function media(){
		return $this->belongsTo('Media')->first();
	}
	
	public function fileConvert(){
		return MediaConvert::where('file_id', '=',$this->id)->where('state', '!=','done')->first();
	}	
	
	public function isConverting(){
		$conv = MediaConvert::where('file_id', '=',$this->id)->where('state', '!=','done')->count();
		if($conv == 0){
			return false;
		}
		return true;
	}

}
