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
			'hostname' => Input::get('hostname'),
		);
		$formdata['nstatus'] = false;
		$formdata['block'] = false;
		if(Input::get('nstatus'))
		{
			$formdata['nstatus'] = true;
		}
		if(Input::get('block'))
		{
			$formdata['block'] = true;
		}
		$result = $this->pData->savedata($formdata);
		if($result === true)
		{
			return View::make('dataindex')->with('message', 'saved successfully');
		}
		return Redirect::to('register')->with('errors', $result)->withinput();

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
			'hostname' => Input::get('hostname'),
		);

		$formdata['nstatus'] = false;
		$formdata['block'] = false;
		if(Input::get('nstatus'))
		{
			$formdata['nstatus'] = true;
		}
		if(Input::get('block'))
		{
			$formdata['block'] = true;
		}
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
			$this->pData->where('_id',Input::get('id'))->update($formdata);
			return View::make('dataindex')->with('message', 'Updated successfully');
		}
		else
		{
			$data = $this->pData->find(Input::get('id'));
			$data = $data['attributes'];
			return View::make('dataedit')->with('data',$data)->with('errors',$valid->messages());
		}
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