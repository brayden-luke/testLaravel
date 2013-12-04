<?php

use Jenssegers\Mongodb\Model as Eloquent;
class Data extends Eloquent {

	protected $connection = 'mongodb';
	protected $collection = 'network';

	public function savedata($data)
	{

		if(!empty($data))
		{
			$formdata = array(
				'uid' => $data['uid'],
				'nid' => $data['nid'],
				'network_name' => $data['network_name'],
				'ip_address' => $data['ip_address'],
				'hostname' => $data['hostname'],
			);
			$rules = array(
				'uid' => 'Required|Min:3|Max:80|Alpha',
				'nid'=> 'Required|Between:1,64',
				'network_name' => 'Required|Between:3,64',
				'ip_address' => 'Required|AlphaNum|Between:6,30',
				'hostname' => 'Required|AlphaNum|Between:3,64'
			);
			$valid = Validator::make($formdata, $rules);
			if($valid->passes())
			{
				$connection = DB::connection('mongodb')->collection('network');
				$connection->insert($data);
				return true;
			}
			else
			{
				return $valid->messages();
			}
		}
		return false;
	}
}