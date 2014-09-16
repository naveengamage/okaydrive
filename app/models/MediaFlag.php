<?php

class MediaFlag extends Eloquent {

	protected $table = 'media_folders';
	protected $guarded = array();
	public static $rules = array();

	public function user(){
		return $this->belongsTo('User')->first();
	}

	public function media(){
		return $this->belongsTo('Media')->first();
	}

}
