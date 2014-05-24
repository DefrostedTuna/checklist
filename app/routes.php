<?php

Route::get('/', array(
	'as' 	=> 'home',
	'uses' 	=> 'HomeController@getIndex'
));

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
|	Everything related to Accounts here
|	
|	ROUTE 						GET Protection		POST Protection
|
|	/account/create 			(GET = Guest)		(POST = Guest/CSRF)
|	/account/login 				(GET = Guest)		(POST = Guest/CSRF)
|	/account/logout 			(GET = Auth)
|	/account/update 			(GET = Auth) 		(POST = Auth/CSRF)
|	/account/change-password 	(GET = Auth) 		(POST = Auth/CSRF)
|	/account/forgot-password 	(GET = Guest)		(POST = Guest/CSRF)
|	/account/recover 			(GET = Guest)
|	/account/activate 			(GET = Guest)
|	/account/settings 			(GET = Auth)
|	
*/

	/*	-------------------------------------------------------------------
	|	GET Routes ||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	|	-------------------------------------------------------------------
	*/

		/*	----------------------------------------------------
		|	Auth GET Routes (Need to be logged in to do these)
		|	----------------------------------------------------
		*/

			Route::group(array('before' => 'auth'), function() {

				Route::get('/account/logout', array(
					'as' 	=> 'account-log-out',
					'uses' 	=> 'AccountController@getLogOut'
				));

				Route::get('/account/update', array(
					'as' 	=> 'account-update',
					'uses' 	=> 'AccountController@getUpdate'
				));

				Route::get('/account/change-password', array(
					'as' 	=> 'account-change-password',
					'uses' 	=> 'AccountController@getChangePassword'
				));

				Route::get('/account/settings', array(
					'as' 	=> 'account-settings',
					'uses' 	=> 'AccountController@getSettings'
				));


			});
		/*---------------- End Auth GET Routes ----------------*/
		
		/*	----------------------------------------------------
		|	Guest GET Routes (Can't Be logged in to do these)
		|	----------------------------------------------------
		*/
			Route::group(array('before' => 'guest'), function() {	

				Route::get('/account/create', array(
					'as' 	=> 'account-create',
					'uses' 	=> 'AccountController@getCreate'
				));

				Route::get('/account/login', array(
					'as' 	=> 'account-log-in',
					'uses' 	=> 'AccountController@getLogIn'
				));

				Route::get('/account/forgot-password', array(
					'as' 	=> 'account-forgot-password',
					'uses' 	=> 'AccountController@getForgotPassword'
				));

				Route::get('/account/recover/{code}', array(
					'as' 	=> 'account-recover',
					'uses' 	=> 'AccountController@getRecover'
				));

				Route::get('/account/activate/{code}', array(
					'as' 	=> 'account-activate',
					'uses' 	=> 'AccountController@getActivate'
				));

			});
		/*---------------- End Guest GET Routes ----------------*/

	/* 	End GET Routes 
	|	-----------------------------------------------------------
	*/	

	/* 	-------------------------------------------------------------------
	|	POST Routes |||||||||||||||||||||||||||||||||||||||||||||||||||||||
	|	-------------------------------------------------------------------
	*/	
		/*	----------------------------------------------------
		|	Auth POST Routes (Need to be logged in to do these)
		|	----------------------------------------------------
		*/
			Route::group(array('before' => 'auth'), function() {

				/*	----------------------------------------------------
				|	Auth POST CSRF Routes (Logged In, Token Needed)
				|	----------------------------------------------------
				*/
					Route::group(array('before' => 'csrf'), function() {

						Route::post('/account/update', array(
							'as' 	=> 'account-update',
							'uses' 	=> 'AccountController@postUpdate'
						));

						Route::post('/account/change-password', array(
							'as' 	=> 'account-change-password',
							'uses' 	=> 'AccountController@postChangePassword'
						));

					});
				/*---------------- End Auth POST CSRF Routes ----------------*/
			});
		/*---------------- End Auth POST Routes ----------------*/


		/*	----------------------------------------------------
		|	UN-Auth POST CSRF Routes (Not Logged In, Token Needed)
		|	----------------------------------------------------
		*/
		Route::group(array('before' => 'guest'), function() {	
			Route::group(array('before' => 'csrf'), function() {

				Route::post('/account/create', array(
					'as' 	=> 'account-create',
					'uses' 	=> 'AccountController@postCreate'
				));

				Route::post('/account/login', array(
					'as' 	=> 'account-log-in',
					'uses' 	=> 'AccountController@postLogIn'
				));

				Route::post('/account/forgot-password', array(
					'as' 	=> 'account-forgot-password',
					'uses' 	=> 'AccountController@postForgotPassword'
				));
			});
		});
		/*---------------- End UN-Auth CSRF POST Routes ----------------*/

	/* 	-----------------------------------------------------------
	|	End POST Routes 
	|	-----------------------------------------------------------
	*/

/*
---------------------------------------------------------------------------
 End Account Routes
---------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Checkist Routes
|--------------------------------------------------------------------------
|
|	Everything related to Checklists here
|	
|	ROUTE 							GET Protection		POST Protection
|
|	/list 							(GET = Auth)		
|	/list/create 					(GET = Auth)		(POST = Auth/CSRF)
|	/list/view/{list}				(GET = Auth)		(POST = Auth/CSRF)
|	/list/view/{list}/add 			(GET = Auth) 		(POST = Auth/CSRF)
|	/list/view/{list}/item/remove 						(POST = Auth/CSRF)
| 	/list/view/{list}/remove 							(POST = Auth/CSRF)
*/

	/*	-------------------------------------------------------------------
	|	GET Routes ||||||||||||||||||||||||||||||||||||||||||||||||||||||||
	|	-------------------------------------------------------------------
	*/
		/*	----------------------------------------------------
		|	Auth GET Routes (Need to be logged in to do these)
		|	----------------------------------------------------
		*/

			Route::group(array('before' => 'auth'), function() {

				Route::get('/list', array(
					'as' 	=> 'list',
					'uses' 	=> 'ChecklistController@getIndex'
				));

				Route::get('/list/create', array(
					'as' 	=> 'list-create',
					'uses'	 => 'ChecklistController@getCreate'
				));

				Route::get('/list/view/{list}', array(
					'as' 	=> 'list-items',
					'uses'	 => 'ChecklistController@getItems'
				));

				Route::get('list/view/{list}/add-batch', array(
					'as' 	=> 'list-items-add-batch',
					'uses'	 => 'ChecklistController@getAddBatch'
				));

			});
		/*---------------- End Auth GET Routes ----------------*/

	/* 	-------------------------------------------------------------------
	|	POST Routes |||||||||||||||||||||||||||||||||||||||||||||||||||||||
	|	-------------------------------------------------------------------
	*/	
		/*	----------------------------------------------------
		|	Auth POST Routes (Need to be logged in to do these)
		|	----------------------------------------------------
		*/
			Route::group(array('before' => 'auth'), function() {

				/*	----------------------------------------------------
				|	Auth POST CSRF Routes (Logged In, Token Needed)
				|	----------------------------------------------------
				*/
					Route::group(array('before' => 'csrf'), function() {

						Route::post('/list/create', array(
							'as' 	=> 'list-create',
							'uses' 	=> 'ChecklistController@postCreate'
						));

						Route::post('/list/view/{list}', array(
							'as' 	=> 'list-items',
							'uses'	 => 'ChecklistController@postItems'
						));

						Route::post('list/view/{list}/add', array(
							'as' 	=> 'list-items-add',
							'uses'	 => 'ChecklistController@postAddItem'
						));						

						Route::post('list/view/{list}/add-batch', array(
							'as' 	=> 'list-items-add-batch',
							'uses'	 => 'ChecklistController@postAddBatch'
						));

						Route::post('list/view/{list}/item/remove', array(
							'as' 	=> 'list-items-remove',
							'uses'	 => 'ChecklistController@postRemoveItem'
						));		

						Route::post('list/view/{list}/remove', array(
							'as' 	=> 'list-remove',
							'uses'	 => 'ChecklistController@postRemoveList'
						));		

					});
				/*---------------- End Auth POST CSRF Routes ----------------*/
			});
		/*---------------- End Auth POST Routes ----------------*/




