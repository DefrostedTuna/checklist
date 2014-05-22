<?php

class HomeController extends BaseController {

	public function getIndex() {

		if(Auth::check()) {
			return 	View::make('auth-home');
		} else {
			return 	View::make('guest-home');
		}
		
		
	}

}
