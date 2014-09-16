<?php

class MediaConvert extends Eloquent {

	protected $table = 'media_convert';
	protected $guarded = array();
	public static $rules = array();

	public function media(){
		return $this->belongsTo('Media')->first();
	}

}