<?php

class Object extends Moloquent {
	protected $guarded = array();

	public static $rules = array(
		'uid' => 'required|integer'
	);

    public $timestamps = false;

}
