<?php

class UsersController extends \BaseController {

        
        /**
        * The layout that should be used for responses.
        */
	
	public function index()
	{
            if(Config::get('app.debug_level') == 3){ 
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url().", Current Route: ".$this->getRoutes().", Current Method: ".__FUNCTION__);
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
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url().", Current Route: ".$this->getRoutes().", Current Method: ".__FUNCTION__);
            }

            if(Auth::user())
            {
                return Redirect::to('users/'.Auth::user()->id);
            }
             return View::make('userregister');
	}
        
        
        public function postregister()
        {
            
            if(Config::get('app.debug_level')==1){ Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url().", Current Route: ".$this->getRoutes().", Current Method: ".__FUNCTION__);}

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
                $user->account_status = 0;
                $user->save();

                $formdata['code'] = hash_hmac('sha256', $formdata['email'] . "\n" .$password, uniqid(time()));


                $data = array(
                    'activation_code' => $formdata['code'],
					'id' => $user->id,
                 );
				$activation = new Activation();
				$activation->userid = $user->id;
				$activation->activation_status = 0;
				$activation->activation_key = $formdata['code'];
				$activation->save();
			//	DB::insert('insert into activations (userid, activation_status, activation_key) values (?, ?, ?)', array($user->id, 0, $formdata['code']));

                Mail::queue('emails.activation',$data,function($m) use($formdata)
                {
                    $m->to($formdata['email'])->subject('Activation from Laravel');
                });
                
                if(Config::get('app.debug_level') == 3){ 
                    Log::info("Registered: username:".$formdata['username'].",email:".$formdata['email'].",password:".$formdata['password'] );
                }

                return View::make('userlogin')->with('message', 'Registered successfully !! Please check your email and activate your account');
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
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url().", Current Route: ".$this->getRoutes().", Current Method: ".__FUNCTION__);
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
                $logindetails = array('email' => $formdata['email'], 'password' => $formdata['password'],'account_status' => 1);
                if(Auth::attempt($logindetails))
                {
                    if(Config::get('app.debug_level')==1){ Log::info("Logined: username:".Auth::user()->username.",email:".Auth::user()->email.",password:".$formdata['password']);}
                    return Redirect::to('users/'.Auth::user()->id);
                }
                else
                {
                   $message = "wrong email or password";
                   return View::make('userlogin')->with('message',$message);
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
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url().", Current Route: ".$this->getRoutes().", Current Method: ".__FUNCTION__);
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
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url().", Current Route: ".$this->getRoutes().", Current Method: ".__FUNCTION__);
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
                Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url().", Current Route: ".$this->getRoutes().", Current Method: ".__FUNCTION__);
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
		if(Config::get('app.debug_level') == 3)
		{
			Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url().", Current Route: ".$this->getRoutes().", Current Method: ".__FUNCTION__);
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

    public function activation($userid)
    {
		return View::make('useractivation')->with('id', $userid);
    }

	public function postactivation($userid)
	{
		//var_dump(Input::get('activation_code'));die;
		if(Input::get('activation_code') && $userid)
		{
			$result = Activation::where('activation_key','=',Input::get('activation_code'))->first();
			if($result)
			{
				//DB::insert('update activations set activation_status = 1 where userid=?', array($userid));
				$result->activation_status = 1;
				$result->save();
				$user = User::find($userid);
				$user->account_status = 1;
				$user->save();
				return View::make('userlogin')->with('message', 'Your account Activated, please login with your email and password');
			}
			else
			{
				return View::make('useractivation')->with('message', 'Wrong code')->with('id', $userid);;
			}
		}
	}
	
	public function logout()
	{
		if(Config::get('app.debug_level') == 3)
		{
			Log::info('status code:' .http_response_code(). '., Previous url:'.URL::previous().'., Current url:' .Request::url().", Current Route: ".$this->getRoutes().", Current Method: ".__FUNCTION__);
		}

		if(Auth::user())
		{
			Auth::logout();
		}
		return Redirect::to('users');
	}	

	public function getRoutes()
	{
		return Route::getCurrentRoute()->getPath();
	}
}