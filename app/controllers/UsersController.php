<?php

class UsersController extends \BaseController {

        
        /**
        * The layout that should be used for responses.
        */
	
	public function index()
	{
            if(Config::get('app.debug_level') == 3){ 
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url()."method: index");
            }
            
            if(Auth::user())
            {
                return Redirect::to('users/'.Auth::user()->id);
            }
            return View::make('userindex');
	}

	
	public function create()
	{
            if(Config::get('app.debug_level') == 3){ 
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url()."method: create");
            }

            if(Auth::user())
            {
                return Redirect::to('users/'.Auth::user()->id);
            }
             return View::make('userregister');
	}
        
        
        public function postregister()
        {
            
            if(Config::get('app.debug_level')==1){ Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url()."method: postregister");}

            $formdata = array(
                'username' => Input::get('username'),
                'email'=> Input::get('email'),
                'password' => Input::get('password'),
            );
            
            $rules = array('username'=>'required',
                'email'=>'required|email', 
                'password' => 'required');
            $valid = Validator::make($formdata, $rules);
            if(!$valid->fails())
            {
                $password = $formdata['password'];
                $password = Hash::make($password);
                
                $user = new User();
                $user->username = $formdata['username'];
                $user->email = $formdata['email'];
                $user->password = $password;
                $user->save();
                
                if(Config::get('app.debug_level') == 3){ 
                    Log::info("Registered: username:".$formdata['username'].",email:".$formdata['email'].",password:".$formdata['password'] );
                }

                return View::make('userlogin')->with('message', 'Registered successfully !!');
            }
            else
            {
                $message = $valid->messages();
                return Redirect::to('register')->with('errors',$message)->withInput();
            }           
        }
        
        public function postlogin()
        {
            if(Config::get('app.debug_level')==1){ 
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url()."method: postlogin");
            }

            $formdata = array(
                'email'=> Input::get('email'),
                'password' => Input::get('password'),
            );
            $rules = array(
                'email'=>'required', 
                'password' => 'required');
            $valid = Validator::make($formdata, $rules);
            if(!$valid->fails())
            {
                $logindetails = array('email' => $formdata['email'], 'password' => $formdata['password']);
                if(Auth::attempt($logindetails))
                {
                    if(Config::get('app.debug_level')==1){ Log::info("Logined: username:".Auth::user()->username.",email:".Auth::user()->email.",password:".$formdata['password']);}
                    return Redirect::to('users/'.Auth::user()->id);
                }
                else
                {
                   $message = 'wrong email or password';
                   return Redirect::to('login')->with('message',$message)->withInput(); 
                }
            }
            else
            {
                $message = $valid->messages();
                return Redirect::to('login')->with('errors',$message)->withInput();
            }           
        }
        
        public function postedit()
        {
            if(Config::get('app.debug_level') == 3){ 
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url()."method: postedit");
            }
            $formdata = array(
                'username' => Input::get('username'),
                'email'=> Input::get('email'),
                'password' => Input::get('password'),
            );
            
            $rules = array('username'=>'required',
                'email'=>'required|email', 
                );
            $valid = Validator::make($formdata, $rules);
            if(!$valid->fails())
            {        
                $user = Auth::user(); 
                $user->username = $formdata['username'];
                $user->email = $formdata['email'];
                if (!empty($formdata['password'])){
                    $password = $formdata['password'];
                    $password = Hash::make($password);
                    $user->password = $password;
                }
                $user->save();
                if(Config::get('app.debug_level')==3){ Log::info("Updated profile details, username:".$user->username.",email:".$user->email.",password".$formdata['password']);}
                return View::make('userpage')->with('message', 'Profile Updated successfully !!');
            }
            else
            {
                $message = $valid->messages();
                return Redirect::to('users')->with('errors',$message)->withInput();
            }           
        }
        

	public function store()
	{
		//
	}

	public function show($id)
	{
            if(Config::get('app.debug_level') == 3){ 
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url()."method: show");
            }

            if(Auth::user())
            {
                 return View::make('userpage');
            }
            return Redirect::to('users');
            
           
	}

	public function edit($id)
	{
            if(Config::get('app.debug_level') == 3){ 
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url()."method: edit");
            }

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
            if(Config::get('app.debug_level') == 3){ 
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url()."method: login");
            }

            if(Auth::user())
            {
                return Redirect::to('users/'.Auth::user()->id);
            }
            else
            {
                return View::make('userlogin');
            }
        }
        
        public function logout()
        {
            if(Config::get('app.debug_level') == 3){ 
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url()."method: logout");
            }

            if(Auth::user())
            {
                Auth::logout();
            }
            return Redirect::to('users');
           
        }

}
