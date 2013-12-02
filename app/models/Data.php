<?php

use Jenssegers\Mongodb\Model as Eloquent;
class Data extends Eloquent {

	protected $connection = 'mongodb';
	protected $collection = 'network';

	public function savedata($data)
	{
		if(!empty($data))
		{
			$connection = DB::connection('mongodb')->collection('network');
			$connection->insert($data);
			return true;
		}
		return false;
	}
	public function updatedata($id,$data)
	{
		$this->where('_id',Input::get('_id'));//->update($data);
		foreach($data as $key=>$value)
		{
			$this->$key = $value;
		}
		$this->save();
		//var_dump($result);die;

	}


}