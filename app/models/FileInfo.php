<?php

class FileInfo extends Eloquent {

	protected $table = 'file_info';
	protected $guarded = array();
	public static $rules = array();

	public function media(){
		return $this->belongsTo('Media')->first();
	}

}
