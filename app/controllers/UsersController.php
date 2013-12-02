<?php

class UsersController extends \BaseController {


        /**
        * The layout that should be used for responses.
        */
	
	public function index()
	{

           return View::make('userindex');
	}

	
	public function create()
	{
		$pUser = new User;
		//$pUser->test();die;
           return View::make('userregister');
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
		$pUser = new User;
		if($pUser->savedata($formdata))
		{
			return View::make('userlogin')->with('message', 'saved successfully');
		}
        return Redirect::to('register');

    }

	public function postedit()
	{
			return View::make('userpage')->with('message', 'Profile Updated successfully !!');

			return Redirect::to('users')->with('errors',$message)->withInput();
	}
        

	public function store()
	{
		//
	}

	public function show($id)
	{
            return Redirect::to('users');
	}

	public function editdata($id)
	{

        return View::make('useredit');
	}
	
	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}
        
	public function login()
	{
			return Redirect::to('users/'.Auth::user()->id);

			return View::make('userlogin');

	}

    public function activation($userid)
    {
		return View::make('useractivation')->with('id', $userid);
    }

	public function postactivation($userid)
	{

		return View::make('userlogin')->with('message', 'Your account Activated, please login with your email and password');
	   	return View::make('useractivation')->with('message', 'Wrong code')->with('id', $userid);;


	}


	public function getRoutes()
	{
		return Route::getCurrentRoute()->getPath();
	}
}