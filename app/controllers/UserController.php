<?php 

class UserController extends BaseController{

	/**
	 * User Repository
	 *
	 * @var User
	 */
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public static $rules = array(
		'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
    );

    // *********** USER SIGNUP ********** //

	public function signup(){

		$validation = Validator::make( Input::all(), static::$rules );
		
		$email = Input::get('email');
		$username = Input::get('username');
		
		if ($validation->fails()){
			$errors = $validation->messages()->toArray();
			if(!empty($email) && !empty($username)){
				return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email, 'input_username'=> $username));
			}
			if(!empty($email)){
				return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email));
			}
			if(!empty($username)){
				return Redirect::to('signup')->with(array('errors' => $errors, 'input_username'=> $username));
			}
			return Redirect::to('signup')->with(array('errors' => $errors));
		}


		$username = htmlspecialchars(stripslashes(Input::get('username')));

		$user = User::where('username', '=', $username)->first();

		if(!$user){

			$settings = Setting::first();

			if($settings->user_registration){

				if( count(explode(' ', $username)) == 1 ){

					if(Input::get('password') != ''){
						$user = $this->new_user( $username, Input::get('email'), Hash::make(Input::get('password')) ); 
								//require_once('/opt/nginx/html/vendor/php-aws-ses-master/src/ses.php');

								//$ses = new SimpleEmailService('AKIAJNUKDR6WQV2PJLEA', 'Q0p4SCDdHK5QddvUICYj/xMfoAbcxa7buuRYTJyY');

								//$m = new SimpleEmailServiceMessage();
								//$m->addTo(Input::get('email'));
								//$m->setFrom('DATAS Support <support@dat.as>');
								//$m->setSubject('Welcome to DAT.AS.');
								$html = '<table class="yiv7962433916container" align="center" cellspacing="0" border="0" cellpadding="0" width="580" bgcolor="#FFFFFF" style="width:580px;background-color:#FFF;border-top:1px solid #DDD;border-bottom:1px solid #DDD;" id="yui_3_13_0_1_1397466773730_2821">
										<tbody id="yui_3_13_0_1_1397466773730_2820"><tr id="yui_3_13_0_1_1397466773730_2819">
											<td class="yiv7962433916title" style="padding-top:34px;padding-left:39px;padding-right:39px;text-align:left;border-left-width:1px;border-left-style:solid;border-left-color:#DDD;border-right-width:1px;border-right-style:solid;border-right-color:#DDD;" id="yui_3_13_0_1_1397466773730_2818">
												<h2 style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;font-size:30px;color:#262626;font-weight:normal;margin-top:0;margin-bottom:13px;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;letter-spacing:0;" id="yui_3_13_0_1_1397466773730_2817">Welcome to DATAS!</h2>
												<h3 style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;font-size:16px;color:#3e434a;font-weight:normal;margin-top:0;margin-bottom:19px;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;line-height:25px;" id="yui_3_13_0_1_1397466773730_2824">Hi, '. $username .'! We welcome you to DAT-AS. You can add new torrents by Searching, Entering torrent magnet/url or Uploading a .torrent file. </h3>
											</td>
										</tr>
										<tr id="yui_3_13_0_1_1397466773730_2831">
											<td class="yiv7962433916cta" align="left" style="background-color:#F1FAFE;font-size:14px;color:#1f1f1f;border-top-width:1px;border-top-style:solid;border-top-color:#DAE3EA;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#DAE3EA;border-left-width:1px;border-left-style:solid;border-left-color:#DDD;border-right-width:1px;border-right-style:solid;border-right-color:#DDD;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:20px;padding-bottom:20px;padding-right:39px;padding-left:39px;text-align:left;" id="yui_3_13_0_1_1397466773730_2830">
												<table cellspacing="0" border="0" cellpadding="0" width="500" align="left">
													<tbody><tr>
														<td width="24"></td>
														<td class="yiv7962433916link" align="left" style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;padding-left:9px;font-size:14px;"><strong>Need help? Check for our online support or email us at support@dat.as</strong></td>
													</tr>
												</tbody></table>
											</td>
										</tr>
										<tr id="yui_3_13_0_1_1397466773730_2827">
											<td class="yiv7962433916footer" style="color:#797c80;font-size:12px;border-left-width:1px;border-left-style:solid;border-left-color:#DDD;border-right-width:1px;border-right-style:solid;border-right-color:#DDD;padding-top:23px;padding-left:39px;padding-right:13px;padding-bottom:23px;text-align:left;" id="yui_3_13_0_1_1397466773730_2826">
												<p style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:13px;padding-right:0;padding-left:0;line-height:20px;" id="yui_3_13_0_1_1397466773730_2832">
													You can login with <a rel="nofollow" style="font-weight:bold;text-decoration:none;color:inherit;cursor:default;">' . $username . '</a> at <a rel="nofollow" target="_blank" href="https://dat.as" id="yui_3_13_0_1_1397466773730_2833">https://dat.as</a>
												</p>
												<p style="font-family:Helvetica Neue, Arial, Helvetica, sans-serif;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:13px;padding-right:0;padding-left:0;line-height:20px;" id="yui_3_13_0_1_1397466773730_2825">Want some help with using our site? Simply reply to this email or email us at support@dat.as. Email alerts are enabled by default, you may disable email alerts in your account settings.</p>
											</td>
										</tr>
										<tr>
									</tr></tbody></table>';
								//$m->setMessageFromString('',$html);
								//$ses->sendEmail($m);

					    if($user){
					    	Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true);
					    }

					    return Redirect::to('signin')->with(array('errors' => 'Account has been successfully created!'));

					} else {
						$errors = array();
						$errors[][0] = 'Invalid password.';
						
						if(!empty($email) && !empty($username)){
							return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email, 'input_username'=> $username));
						}
						if(!empty($email)){
							return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email));
						}
						if(!empty($username)){
							return Redirect::to('signup')->with(array('errors' => $errors, 'input_username'=> $username));
						}
						return Redirect::to('signup')->with(array('errors' => $errors));
					}

				} else {
					$errors = array();
					$errors[][0] = 'Username must not contain any spaces.';
					
					if(!empty($email) && !empty($username)){
						return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email, 'input_username'=> $username));
					}
					if(!empty($email)){
						return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email));
					}
					if(!empty($username)){
						return Redirect::to('signup')->with(array('errors' => $errors, 'input_username'=> $username));
					}
					return Redirect::to('signup')->with(array('errors' => $errors));
				}

			} else {
				$errors = array();
				$errors[][0] = 'Sorry, Registration has been closed.';
				
				if(!empty($email) && !empty($username)){
					return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email, 'input_username'=> $username));
				}
				if(!empty($email)){
					return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email));
				}
				if(!empty($username)){
					return Redirect::to('signup')->with(array('errors' => $errors, 'input_username'=> $username));
				}
				return Redirect::to('signup')->with(array('errors' => $errors));
			}

		} else {
			$errors = array();
			$errors[][0] = 'Sorry, this username is already in use. Please try another name.';
			
			if(!empty($email) && !empty($username)){
				return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email, 'input_username'=> $username));
			}
			if(!empty($email)){
				return Redirect::to('signup')->with(array('errors' => $errors, 'input_email'=> $email));
			}
			if(!empty($username)){
				return Redirect::to('signup')->with(array('errors' => $errors, 'input_username'=> $username));
			}
			return Redirect::to('signup')->with(array('errors' => $errors));
		}

	}

	// *********** CREATE A NEW USERNAME WITH USERNAME EMAIL AND PASSWORD ********** //

	private function new_user($username, $email, $password, $filename = NULL){
	    $user = new User;
	    $user->username = $username;
	    $user->email = $email;
	    $user->password = $password;
		
		//$user->category_id = 27;
		//$user->prem_valid = '2014-06-12 00:00:00';
		//$user->avl_bytes = 1099511627776;
		
		date_default_timezone_set('Pacific/Auckland');
		
		$date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
		$date->modify('+1 day');
		$date = $date->format('Y-m-d H:i:s');
		
		$user->category_id = 1;
		$user->prem_valid = $date;
		$user->used_bytes = 0;
		$user->avl_bytes = 1073741824;
					
	    if($filename){
	    	$user->avatar = $filename;
	    }

	    $user->save();
		

						
	    return $user;
	}

	// *********** WHEN USER SIGNS UP AWARD THEM WITH POINTS ********** //

	private function new_user_points($user_id){
		$point = new Point;
    	$point->user_id = $user_id;
    	$point->points = 200;
    	$point->description = 'Registration';
    	$point->save();
	}

	// *********** USER SIGNIN ********** //

	public function signin(){
		if (Session::has('authtoken')){
			Session::put('auth', '1');
		}
		
		$email = Input::get('email');
		$pass = Input::get('password');
		if(!empty($email) && !empty($pass)){
			// get login POST data
			$email_login = array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1
			);

			$username_login = array(
				'username' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1
			);

			if ( Auth::attempt($email_login,true) || Auth::attempt($username_login,true) ){
				if (Session::has('authtoken'))
				{
					$user = User::where('id','=', Auth::user()->id)->first();
					if(count($user) != 0){
						$api_key = md5(microtime().rand());
						$token = Session::get('authtoken');
						$user->token = $token;
						$user->api_key = $api_key;
						$user->api_key_date = date("Y-m-d H:i:s");
						$user->save();
					}
					Session::forget('authtoken');
					Session::forget('auth');
					return  "<script type='text/javascript'> window.close();</script>";
				}	
				return Redirect::intended('/');
				
			} else {
				if(!empty($email)){
					return Redirect::to('signin')->with(array('errors' => 'Incorrect username or password.', 'input_email' => $email));
				}
				// auth failure! redirect to login with errors
				return Redirect::to('signin')->with(array('errors' => 'Incorrect username or password.'));
			}
		}else{
			if(!empty($email)){
				return Redirect::to('signin')->with(array('errors' => 'Username or password cannot be empty.','input_email' => $email));
			}
			return Redirect::to('signin')->with(array('errors' => 'Username or password cannot be empty.'));
		}

	}

	// *********** FACEBOOK OAUTH SIGNIN/SIGNUP ********** //

	public function facebook(){
		if (Session::has('authtoken')){
			Session::put('auth', '1');
		}
		
		$settings = Setting::first();

		if($settings->user_registration){	

			// get data from input
		    $code = Input::get( 'code' );

		    // get fb service
		    $fb = OAuth::consumer( 'Facebook' );

		    // check if code is valid

		    // if code is provided get user data and sign in
		    if ( !empty( $code ) ) {

		        // This was a callback request from google, get the token
		        $token = $fb->requestAccessToken( $code );

		        // Send a request with it
		        $result = json_decode( $fb->request( '/me?fields=picture,email,id,username' ), true );

		        $oauth_userid = $result['id'];
		        $oauth_username = $result['username'];
		        $oauth_email = $result['email'];
		        $oauth_picture = 'http://graph.facebook.com/' . $oauth_userid . '/picture?type=large';
		        if(isset($oauth_userid) && isset($oauth_username) && isset($oauth_email) && isset($oauth_picture)){
		        	
		        	$fb_auth = OauthFacebook::where('oauth_userid', '=', $oauth_userid)->first();
			        	
			        if(isset($fb_auth->id)){
			        	$user = User::find($fb_auth->user_id);
			        } else {
			        	// Execute Add or Login Oauth User
			        	$user = User::where('email', '=', $oauth_email)->first();

			        	if(!isset($user->id)){
			        		$username = $this->create_username_if_exists($oauth_username);
			        		$email = $oauth_email;
			        		$password = Hash::make($this->rand_string(15));

			        		$user = $this->new_user($username, $email, $password, $this->uploadImageFromURL($oauth_picture, $username));

			        		$this->new_user_points($user->id);

			        		$new_oauth_user = new OauthFacebook;
			        		$new_oauth_user->user_id = $user->id;
			        		$new_oauth_user->oauth_userid = $oauth_userid;
			        		$new_oauth_user->save();

			        	} else {
			        		// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
			        		return Redirect::to('signin')->with(array('errors' => 'Email is already in use.'));
			        	}
			        }

		        	// Redirect to new User Login;
		        	Auth::login($user,true);
		        
					if (Session::has('authtoken'))
					{
						$user = User::where('id','=', Auth::user()->id)->first();
						if(count($user) != 0){
							$api_key = md5(microtime().rand());
							$token = Session::get('authtoken');
							$user->token = $token;
							$user->api_key = $api_key;
							$user->api_key_date = date("Y-m-d H:i:s");
							$user->save();
						}
						Session::forget('authtoken');
						Session::forget('auth');
						return  "<script type='text/javascript'> window.close();</script>";
					}
		        	return Redirect::intended('/');
		        	

		        } else {
		        	// Something went wrong, redirect and send error msg
		        	echo 'Some Oauth information was not able to get retrieved. Please try again.';
		        	echo '<br />Info retrieved:<br />';
		        	echo '<br />userid: ' . $oauth_userid;
		        	echo '<br />username: ' . $oauth_username;
		        	echo '<br />email: ' . $oauth_email;
		        	echo '<br />picture: ' . $oauth_picture;
		        }

		    }
		    // if not ask for permission first
		    else {
		        // get fb authorization
		        $url = $fb->getAuthorizationUri();

		        // return to facebook login url
		        return Response::make()->header( 'Location', (string)$url );
		    }
		} else {
			return Redirect::to('signin')->with(array('errors' => 'Sorry, Registration has been closed.'));
		}
	}

	// *********** GOOGLE OAUTH SIGNIN/SIGNUP ********** //
	public function twitter(){
	
		   $auth_url = Twitter::request();
			header('Location: ' . $auth_url);

	}	
	
	public function yahoo(){
		if (Session::has('authtoken')){
			Session::put('auth', '1');
		}
		
		require '/opt/nginx/html/vendor/openid.php';
		$openid = new LightOpenID($_SERVER['HTTP_HOST']);
     
			//Not already logged in
			if(!$openid->mode)
			{
				 

					//The google openid url
					$openid->identity = 'https://me.yahoo.com';
					 
					//Get additional google account information about the user , name , email , country
				   $openid->required = array('namePerson', 'namePerson/friendly', 'contact/email');
					
					$openid->realm = 'http://okaydrive.com';
					$openid->returnUrl = 'http://okaydrive.com/yahoo';
					 
					//start discovery
					header('Location: ' . $openid->authUrl());
				
			}
			else
			{
				if($openid->validate())
				{
					//User logged in
					$yahoo_id = $openid->identity;
					$attributes = $openid->getAttributes();

					
					$yahoo_id = explode('#', $yahoo_id);
					$yahoo_id = $yahoo_id[0];
					
					$email = $attributes["contact/email"];
					$username_n = explode('@', $email);
					
					$oauth_email = $email;			
					$oauth_username  = $username_n[0];					
					$oauth_userid  = $yahoo_id;
					
					if(isset($oauth_userid) && isset($oauth_username) && isset($oauth_email)){
		        	
						$yahoo_auth = OauthYahoo::where('oauth_userid', '=', $oauth_userid)->first();
							
						if(isset($yahoo_auth->id)){
							$user = User::find($yahoo_auth->user_id);
						} else {
							// Execute Add or Login Oauth User
							$user = User::where('email', '=', $oauth_email)->first();

							if(!isset($user->id)){
								$username = $this->create_username_if_exists($oauth_username);
								$email = $oauth_email;
								$password = Hash::make($this->rand_string(15));
								$oauth_picture = null;
								$avatar = ($oauth_picture != NULL) ? $this->uploadImageFromURL($oauth_picture, $username) : NULL;

								$user = $this->new_user($username, $email, $password, $avatar);

								//$this->new_user_points($user->id);

								$new_oauth_user = new OauthYahoo;
								$new_oauth_user->user_id = $user->id;
								$new_oauth_user->oauth_userid = $oauth_userid;
								$new_oauth_user->save();

							} else {

								// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
								return Redirect::to('/signin')->with('er2', 'Email is already in use.');
							}
						}


						// Redirect to new User Login;
						Auth::login($user,true);
						//$this->add_user_login_point();
						if (Session::has('authtoken'))
						{
							$user = User::where('id','=', Auth::user()->id)->first();
							if(count($user) != 0){
								$api_key = md5(microtime().rand());
								$token = Session::get('authtoken');
								$user->token = $token;
								$user->api_key = $api_key;
								$user->api_key_date = date("Y-m-d H:i:s");
								$user->save();
							}
							Session::forget('authtoken');
							Session::forget('auth');
							return  "<script type='text/javascript'> window.close();</script>";
						}
						return Redirect::intended('/');
						

					} else {
						// Something went wrong, redirect and send error msg
						echo 'Some Oauth information was not able to get retrieved. Please try again.';
						echo '<br />Info retrieved:<br />';
						echo '<br />userid: ' . $oauth_userid;
						echo '<br />username: ' . $oauth_username;
						echo '<br />email: ' . $oauth_email;
						echo '<br />picture: ' . $oauth_picture;
					}
				
				}
				else
				{
					return Redirect::to('signin')->with('errors', 'Please try again.');
				}
			}
	}	
	
	public function authTwitter(){	
		if (Session::has('authtoken')){
			Session::put('auth', '1');
		}
		
		$oauth_userid = Twitter::id();
		$oauth_username = Twitter::username();
		$oauth_email = $oauth_userid;
					if(isset($oauth_userid) && isset($oauth_username)){
		        	
						$twitter_auth = OauthTwitter::where('oauth_userid', '=', $oauth_userid)->first();
							
						if(isset($twitter_auth->id)){
							$user = User::find($twitter_auth->user_id);
						} else {
							// Execute Add or Login Oauth User
							$user = User::where('email', '=', $oauth_email)->first();

							if(!isset($user->id)){
								$username = $this->create_username_if_exists($oauth_username);
								$email = $oauth_email;
								$password = Hash::make($this->rand_string(15));
								$oauth_picture = null;
								$avatar = ($oauth_picture != NULL) ? $this->uploadImageFromURL($oauth_picture, $username) : NULL;

								$user = $this->new_user($username, $email, $password, $avatar);

								//$this->new_user_points($user->id);

								$new_oauth_user = new OauthTwitter;
								$new_oauth_user->user_id = $user->id;
								$new_oauth_user->oauth_userid = $oauth_userid;
								$new_oauth_user->save();

							} else {
								// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
								return Redirect::to('signin')->with('errors', 'This email is already in use.');
							}
						}


						// Redirect to new User Login;
						Auth::login($user,true);
						//$this->add_user_login_point();
						if (Session::has('authtoken'))
						{
							$user = User::where('id','=', Auth::user()->id)->first();
							if(count($user) != 0){
								$api_key = md5(microtime().rand());
								$token = Session::get('authtoken');
								$user->token = $token;
								$user->api_key = $api_key;
								$user->api_key_date = date("Y-m-d H:i:s");
								$user->save();
							}
							Session::forget('authtoken');
							Session::forget('auth');
							return  "<script type='text/javascript'> window.close();</script>";
						}
						return Redirect::intended('/');
						

					} else {
						// Something went wrong, redirect and send error msg
						echo 'Some Oauth information was not able to get retrieved. Please try again.';

					}
		 
	}
	
	public function google() {
		if (Session::has('authtoken')){
			Session::put('auth', '1');
		}
		
		$settings = Setting::first();

		if($settings->user_registration){	
		    // get data from input
		    $code = Input::get( 'code' );

		    // get google service
		    $googleService = OAuth::consumer( 'Google' );

		    // check if code is valid

		    // if code is provided get user data and sign in
		    if ( !empty( $code ) ) {

		        // This was a callback request from google, get the token
		        $token = $googleService->requestAccessToken( $code );

		        // Send a request with it
		        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
		        // $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
		        // dd($result);

		        $oauth_userid = $result['id'];
		        $oauth_username = slugify($result['name']);
		        $oauth_email = $result['email'];
		        if(!isset($result['picture'])){
		        	$oauth_picture = NULL;
		        } else {
		        	$oauth_picture = $result['picture'];
		        }

		        if(isset($oauth_userid) && isset($oauth_username) && isset($oauth_email)){
		        	
		        	$google_auth = OauthGoogle::where('oauth_userid', '=', $oauth_userid)->first();
			        	
			        if(isset($google_auth->id)){
			        	$user = User::find($google_auth->user_id);
			        } else {
			        	// Execute Add or Login Oauth User
			        	$user = User::where('email', '=', $oauth_email)->first();

			        	if(!isset($user->id)){
			        		$username = $this->create_username_if_exists($oauth_username);
			        		$email = $oauth_email;
			        		$password = Hash::make($this->rand_string(15));

			        		$avatar = ($oauth_picture != NULL) ? $this->uploadImageFromURL($oauth_picture, $username) : NULL;

			        		$user = $this->new_user($username, $email, $password, $avatar);

			        		$this->new_user_points($user->id);

			        		$new_oauth_user = new OauthGoogle;
			        		$new_oauth_user->user_id = $user->id;
			        		$new_oauth_user->oauth_userid = $oauth_userid;
			        		$new_oauth_user->save();

			        	} else {
			        		// Redirect and send error message that email already exists. Let them know that they can request to reset password if they do not remember
			        		return Redirect::to('signin')->with('errors', 'This email is already in use.');
			        	}
			        }


		        	// Redirect to new User Login;
		        	Auth::login($user,true);
					if (Session::has('authtoken'))
					{
						$user = User::where('id','=', Auth::user()->id)->first();
						if(count($user) != 0){
							$api_key = md5(microtime().rand());
							$token = Session::get('authtoken');
							$user->token = $token;
							$user->api_key = $api_key;
							$user->api_key_date = date("Y-m-d H:i:s");
							$user->save();
						}
						Session::forget('authtoken');
						Session::forget('auth');
						return  "<script type='text/javascript'> window.close();</script>";
					}

		        	return Redirect::intended('/');
		        	

		        } else {
		        	// Something went wrong, redirect and send error msg
		        	echo 'Some Oauth information was not able to get retrieved. Please try again.';
		        	echo '<br />Info retrieved:<br />';
		        	echo '<br />userid: ' . $oauth_userid;
		        	echo '<br />username: ' . $oauth_username;
		        	echo '<br />email: ' . $oauth_email;
		        	echo '<br />picture: ' . $oauth_picture;
		        }



		    }
		    // if not ask for permission first
		    else {
		        // get googleService authorization
		        $url = $googleService->getAuthorizationUri();

		        // return to facebook login url
		        return Response::make()->header( 'Location', (string)$url );
		    }
		} else {
			return Redirect::to('signin')->with(array('errors' => 'Sorry, Registration has been closed.'));
		}
	}

	// *********** LOOP THROUGH USERNAMES TO RETURN ONE THAT DOESN'T EXIST ********** //

	private function create_username_if_exists($username){
		$user = User::where('username', '=', $username)->first();

		while (isset($user->id)) {
			$username = $username . uniqid();
			$user = User::where('username', '=', $username)->first();
		}

		return $username;
	}

	// *********** RANDOM STRIN GENERATOR ********** //

	private function rand_string( $length ) {

	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    return substr(str_shuffle($chars),0,$length);

	}

	// *********** ADD USER LOGIN POINT, ONE PER DAY ********** //

	private function add_user_login_point(){
		$user_id = Auth::user()->id;

		$LastLoginPoints = Point::where('user_id', '=', $user_id)->where('description', '=', 'Daily Login')->orderBy('created_at', 'desc')->first();
		if(!isset($LastLoginPoints) || date('Ymd') !=  date('Ymd', strtotime($LastLoginPoints->created_at)) ){
			$point = new Point;
			$point->user_id = $user_id;
			$point->description = 'Daily Login';
			$point->points = 5;
			$point->save();
			return true;
		} else {
			return false;
		}
	}

	// *********** UPLOAD IMAGE FOR AVATAR ********** //

	private function uploadImage(){
		
		$file = Input::file('avatar');
		$upload_folder = 'uploads/avatars/';

		$filename =  $file->getClientOriginalName();

		if (file_exists($upload_folder.$filename)) {
			$filename =  uniqid() . '-' . $file->getClientOriginalName();
		}

	    $uploadSuccess = Input::file('avatar')->move($upload_folder, $filename);
		
		$img = Image::make($upload_folder . $filename)->resize(200, 200, false)->save($upload_folder . $filename);

		return $filename;

	}

	// *********** UPLOAD IMAGE FROM URL FOR AVATAR FROM OAUTH ********** //

	private function uploadImageFromURL($file_url, $filename){
		
		
		$file = file_get_contents($file_url);

		$upload_folder = 'uploads/avatars/';

		$filename = $filename . '.jpg';

		if (file_exists($upload_folder.$filename)) {
			$filename =  uniqid() . '-' . $filename . '.jpg';
		}

	    
	    //$extension = $file->getClientOriginalExtension(); //if you need extension of the file
	    $uploadSuccess = file_put_contents($upload_folder.$filename, $file); //$img->move($upload_folder, $filename);
	
		$img = Image::make($upload_folder . $filename)->resize(200, 200, false)->save($upload_folder . $filename);

		return $filename;

	}

	// *********** ADD USER FLAG ********** //

	public function add_flag(){
		$id = Input::get('user_id');
		$user_flag = UserFlag::where('user_id', '=', Auth::user()->id)->where('user_flagged_id', '=', $id)->first();

		if(isset($user_flag->id)){ 
			$user_flag->delete();
		} else {
			$flag = new UserFlag;
			$flag->user_id = Auth::user()->id;
			$flag->user_flagged_id = $id;
			$flag->save();
			echo $flag;
		}
	}


	// *********** UPDATE USER ********** //

	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, User::$update_rules);

		if ($validation->passes())
		{
			$user = $this->user->find($id);

			if(file_exists($input['avatar'])){
            	$input['avatar'] = $this->uploadImage();
            } else { $input['avatar'] = $user->avatar; }

            if($input['password'] == ''){
            	$input['password'] = $user->password;
            } else{ $input['password'] = Hash::make($input['password']); }

            if($user->username != $input['username']){
            	$username_exist = User::where('username', '=', $input['username'])->first();
            	if($username_exist){
            		return Redirect::to('user/' .$user->username)->with(array('note' => 'Sorry that username is already in use.', 'note_type' => 'error') );;
            	}
            }

			$user->update($input);

			return Redirect::to('user/' .$user->username);
		}

		return Redirect::to('user/' . Auth::user()->username)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}


	// *********** SHOW USER PROFILE ********** //

	public function profile($username){

		$user = User::where('username', '=', $username)->first();
		$medias = Media::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(Config::get('site.num_results_per_page'));

		$data = array(
				'user' => $user,
				'medias' => $medias,
				);

		return View::make('user.index', $data);
	}

	// *********** SHOW USER PROFILE LIKES ********** //

	public function profile_likes($username){

		$user = User::where('username', '=', $username)->first();
		$medias = MediaLike::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(Config::get('site.num_results_per_page'));

		$data = array(
				'user' => $user,
				'medias' => $medias,
				'likes' => true,
				);

		return View::make('user.index', $data);
	}

	// ********** USER POINTS PAGE **********  //

	public function points($username){

		$data = array(
			'user' => User::where('username', '=', $username)->first(),
			'points' => Point::where('user_id', '=', Auth::user()->id)->get(),
			);

		return View::make('user.points', $data);
	}

	// ********** RESET PASSWORD ********** //

	public function password_reset()
	{
		return View::make('auth.password_reset');
	}

	// ********** RESET REQUEST ********** //

	public function password_request()
	{
	  $credentials = array('email' => Input::get('email'));
	  $result = Password::remind($credentials, function($message){
	  	$message->subject('Password Reset Info');
	  });
	  if($result == "reminders.sent"){
		return Redirect::to('forgot')->with('success', 'Please check your email.');
	  }else{
		return Redirect::to('forgot')->with('error', 'Invalid email address.');
	  }
	}

	// ********** RESET PASSWORD TOKEN ********** //

	public function password_reset_token($token)
	{
	  return View::make('auth.forgot_reset')->with('token', $token);
	}

	// ********** RESET PASSWORD POST ********** //

	public function password_reset_post()
	{
	  $credentials = array('email' => Input::get('email'),'password' => Input::get('password'),'password_confirmation' => Input::get('password_confirmation'),'token' => Input::get('token'));
	 
	  $result = Password::reset($credentials, function($user, $password)
	  {
	    $user->password = Hash::make($password);
	 
	    $user->save();
	 
	    return Redirect::to('signin')->with('errors', 'Password has been reset');
	  });
	  
		if($result == "reminders.reset"){
			return Redirect::to('signin')->with('errors', 'Password has been reset');
		  }elseif($result == "reminders.token"){
			return Redirect::to('forgot'. '/' . $credentials['token'])->with('error', 'Token has been expired.');
		  }elseif($result == "reminders.password"){
			return Redirect::to('forgot'. '/' . $credentials['token'])->with('error', 'Please check the passwords.');
		  }elseif($result == "reminders.users"){
			return Redirect::to('forgot'. '/' . $credentials['token'])->with('error', 'Invalid email address.');
		  }else{
			return Redirect::to('forgot'. '/' . $credentials['token'])->with('error', 'Please try again.');
		  }
	}

}