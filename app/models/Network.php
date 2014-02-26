<?php

class Network extends Moloquent {
	protected $guarded = array();

	public static $rules = array(
		'nid' => 'required|integer',
		'n_name' => 'required',
		'n_ip' => 'required|ip',
	);

    public $timestamps = false;

}
