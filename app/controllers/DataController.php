<?php

class DataController extends \BaseController {
	protected $pData;
	public function __construct()
	{
		$this->pData = new Data;
	}


	/**
	 * The layout that should be used for responses.
	 */

	public function index()
	{
		return View::make('dataindex');
	}

	public function create()
	{
		return View::make('dataregister');
	}

	public function postregister()
	{
		$formdata = array(
			'uid' => Input::get('uid'),
			'nid'=> Input::get('nid'),
			'network_name' => Input::get('network_name'),
			'ip_address' => Input::get('ip_address'),
			'nstatus' => Input::get('nstatus'),
			'hostname' => Input::get('hostname'),
			'block' => Input::get('block'),
		);
		if($this->pData->savedata($formdata))
		{
			return View::make('dataindex')->with('message', 'saved successfully');
		}
		return Redirect::to('register');
	}

	public function showall()
	{
		$alldata = $this->pData->get();
		return View::make('alldata')->with('alldata', $alldata);
	}

	public function postedit()
	{
		$formdata = array(
			'uid' => Input::get('uid'),
			'nid'=> Input::get('nid'),
			'network_name' => Input::get('network_name'),
			'ip_address' => Input::get('ip_address'),
			'nstatus' => Input::get('nstatus'),
			'hostname' => Input::get('hostname'),
			'block' => Input::get('block'),
		);		
		$this->pData->where('_id',Input::get('id'))->update($formdata);
		return View::make('dataindex')->with('message', 'Updated successfully');
	}

	public function deletedata($id)
	{
		$this->pData->where('_id',$id)->delete();
		return Redirect::to('alldata');
	}

	public function store()
	{
		//
	}

	public function show($id)
	{
		return Redirect::to('data');
	}

	public function editdata($id)
	{
		$data = $this->pData->find($id);
		$data = $data['attributes'];
		return View::make('dataedit')->with('data',$data);
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

	public function getRoutes()
	{
		return Route::getCurrentRoute()->getPath();
	}
}