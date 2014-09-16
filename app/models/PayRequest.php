<?php

class PayRequest extends Eloquent {
	protected $table = 'pay_request';
	
	protected $guarded = array();

	public static $rules = array();

}
