<?php

class OauthYahoo extends Eloquent {
	protected $table = 'oauth_yahoo';

	protected $guarded = array();

	public static $rules = array();

	public function user(){
		return $this->belongsTo('User')->first();
	}
}
