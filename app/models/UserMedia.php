<?php

class UserMedia extends Eloquent {

	protected $table = 'user_media';
	protected $guarded = array();
	public static $rules = array();

	public function user(){
		return $this->belongsTo('User')->first();
	}

	public function media(){
		return $this->belongsTo('Media')->first();
	}

}