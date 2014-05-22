<?php

class AccountController extends BaseController {

	public function getSettings() {
		return 	View::make('account.settings');
	}

	public function getLogIn() {
		return 	View::make('account.login');
	}

	public function postLogIn() {

		$validator = Validator::make(Input::all(), array(
			'email' 	=> 'required|email',
			'password' 	=> 'required'
		));


		if($validator->fails()) {
			return 	Redirect::route('account-log-in')
					->withErrors($validator)
					->withInput();
		}	else {

			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password'),
				'active' 	=> 1
			));

			if($auth) {
				//redirect to intended page
				return 	Redirect::intended('/')
						->with('global', 'You have been logged in as ' . Auth::user()->username . '!');
			} else {
				return 	Redirect::route('account-log-in')
						->with('global', 'The email or password incorrect.');
			}
		}

		return 	Redirect::route('account-log-in')
				->with ('global', 'There was a problem processing the request.');
	}

	public function getLogOut() {
		Auth::logout();
		return Redirect::route('home');
	}

	public function getCreate() {
		return View::make('account.create');
	}

	public function postCreate() {

		$validator = Validator::make(Input::all(), array(
			'email' 			=> 'required|max:128|email|unique:users',
			'first_name' 		=> 'required|max:25|min:3',
			'last_name' 		=> 'required|max:25|min:3',
			'username' 			=> 'required|max:25|min:3|unique:users',
			'password' 			=> 'required|min:6',
			'confirm_password' 	=> 'required|same:password'
		));

		if($validator->fails()) {
			return 	Redirect::route('account-create')
					->withErrors($validator)
					->withInput();
		} else {

			//create account
			$email 			= Input::get('email');
			$username 		= Input::get('username');
			$password 		= Input::get('password');
			$first_name 	= Input::get('first_name');
			$last_name 		= Input::get('last_name');
			//activation code
			$code 			= str_random(60);

			$user = User::create(array(
				'email' 		=> $email,
				'username' 		=> $username,
				'password' 		=> Hash::make($password),
				'first_name' 	=> $first_name,
				'last_name'		=> $last_name,
				'code' 			=> $code,
				'active' 		=> 0
			));

			if($user) {
				Mail::send('emails.auth.activate', array(
													'link' => URL::route('account-activate', $code), 
													'username' => $username), 
							function($message) use ($user) {
								$message->to($user->email, $user->username)->subject('Activate your account');
				});
				
				return 	Redirect::route('account-log-in')
						->with('global', 'Your account has been created! We have sent you an activation email, please check your inbox shortly.');
			} else {
				return 	Redirect::route('account-create')
						->with('global', 'There was a problem creating the account, please try again later.');
			}
		}

		return 	Redirect::route('account-create')
				->with ('global', 'There was a problem processing the request.');

	}

	public function getUpdate() {
		return 	View::make('account.update');
	}

	public function postUpdate() {
		$validator = Validator::make(Input::all(), array(
			'first_name' 	=> 'required|min:3|max:25',
			'last_name' 	=> 'required|min:3|max:25'
		));

		if($validator->fails()) {
			return 	Redirect::route('account-update')
					->withErrors($validator)
					->withInput();
		} else {

			$first_name 	= Input::get('first_name');
			$last_name 		= Input::get('last_name');
			$user_id		= Auth::user()->id;

			$update 	= User::where('id', '=', $user_id)
							->update(array(
								'first_name'	=> $first_name,
								'last_name' 	=> $last_name
							));

			if($update) {
				return 	Redirect::route('account-settings')
						->with('global', 'User information has been updated.');
			} else {
				return 	Redirect::route('account-settings')
						->with('global', 'There was a problem updating your account.');
			}
		}

		return 	Redirect::route('account-settings')
				->with ('global', 'There was a problem processing the request.');
	}

	public function postDelete() {

	}

	public function getActivate($code) {
		
		$user = User::where('code', '=', $code)
					->where('active', '=', 0);

		//if user is returned, $user is set to first record
		if($user->count()) {
			$user = $user->first();

			$user->active 	= 1;
			$user->code 	= '';

			if($user->save()) {
				return 	Redirect::route('home')
						->with('global', 'Activated! You can now log in to yor account!');
			} else {
				return 	Redirect::route('home')
						->with ('global', 'There was a problem activating your account, please try again later.');
			}
		}

		return 	Redirect::route('home')
			->with ('global', 'There was a problem processing the request.');
	}

	public function getChangePassword() {
		return 	View::make('account.password');
	}

	public function postChangePassword() {

		$validator = Validator::make(Input::all(), 
			array(
				'current_password' => 'required',
				'new_password' => 'required|min:6',
				'confirm_new_password' => 'required|same:new_password'
		));

		if($validator->fails()) {
			return 	Redirect::route('account-change-password')
					->withErrors($validator);
		} else {

			//confirm current user
			$user = User::find(Auth::user()->id);

			$current_password 	= Input::get('current_password');
			$new_password 		= Input::get('new_password');

			if(Hash::check($current_password, $user->getAuthPassword())) {

				$user->password = Hash::make($new_password);

				if($user->save()) {
					return 	Redirect::route('home')
							->with('global', 'Your password has been changed!');
				}
			} else {
				return 	Redirect::route('account-change-password')
						->with('global', 'Your password was incorrect.');
			}

		}

		return 	Redirect::route('account-change-password')
				->with ('global', 'There was a problem processing the request.');

	}

	public function getForgotPassword() {
		return 	View::make('account.forgot');
	}

	public function postForgotPassword() {

		$validator = Validator::make(Input::all(), array(
			'email' => 'required|email'
		));

		if($validator->fails()) {
			return 	Redirect::route('account-forgot-password')
					->withErrors($validator)
					->withInput();
		}	else {

			$user = User::where('email', '=', Input::get('email'));

			//if find user returns true
			if($user->count()) {
				//grab first user found
				$user = $user->first();

				//generate random code and password
				$code 					= str_random(60);
				$password 				= str_random(10);

				$user->code 			= $code;
				$user->password_temp 	= $password;

				if($user->save()) {

					Mail::send('emails.auth.forgot', array(
						'link' => URL::route('account-recover', $code),
						'username' => $user->username, 
						'password' => $password), 
							function($message) use($user) {
								$message
								->to($user->email, $user->username)
								->subject('Your new password');
							}); 

					return 	Redirect::route('home')
							->with('global', 'We have sent an email containing a new password, please check your inbox shortly and follow the link to activate it.');
				} else {
					return 	Redirect::route('home')
							->with('global', 'There was a problem requesting a new password, please try again later');	
				}
			}
		}
		return 	Redirect::route('home')
				->with ('global', 'There was a problem processing the request.');
	}

	public function getRecover($code) {

		$user = User::where('code', '=', $code)
					->where('password_temp', '!=', '');

		if($user->count()) {
			$user = $user->first();

			$user->password 		= Hash::make($user->password_temp);
			$user->password_temp 	= '';
			$user->code 			= '';

			if($user->save()) {	
				return 	Redirect::route('home')
						->with('global', 'You can now log in with your new password!');
			}	else {
				return 	Redirect::route('home')
						->woth('global', 'There was a problem recovering your account. Please try again later.');
			}
		}

		return 	Redirect::route('home')
				->with ('global', 'There was a problem processing the request.');	
	}

}