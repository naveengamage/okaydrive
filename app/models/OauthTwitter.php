<?php

class OauthTwitter extends Eloquent {
	protected $table = 'oauth_twitter';

	protected $guarded = array();

	public static $rules = array();

	public function user(){
		return $this->belongsTo('User')->first();
	}
}
