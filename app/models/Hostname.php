<?php

class Hostname extends Moloquent {
	protected $guarded = array();

	public static $rules = array(
		'hostname' => 'required',
	);

    public $timestamps = false;
}
