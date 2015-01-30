<?php

class AuthenticationController extends \BaseController {
	public function loginWithGoogle() {

	   // get data from input
        $code = Input::get( 'code' );
        $key=Session::get('iid');



        // get google service
        $googleService = OAuth::consumer( 'Google' );

        // check if code is valid

          // if code is provided get user data and sign in
          if ( !empty( $code ) ) {

          // This was a callback request from google, get the token
          // (REQUESTING for the token)
             $token = $googleService->requestAccessToken( $code );

          // Send a request with it(requesting  user information)
             $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

          if(!empty($token)){ /*if the permission is given(session tokens)*/

                  try{


                      if(!empty($key)){ /*if it's the sign up process*/

                      // Find the user using the user id
                          $user = Sentry::findUserByLogin($result['email']);

                          // Log the user in
                          Sentry::login($user, false);

                          //should display an error message saying the user is already registered

                          $user_id = $user->id;
                          return Redirect::to('login')->withErrors(array('failure' => 'You are already registered. Want to <a href="users/'.$user_id.'/home">login</a> ? ')); 

                      }else{ /*if it's the login process*/

                           // Find the user using the user id
                           $user = Sentry::findUserByLogin($result['email']);

                           // Log the user in
                           Sentry::login($user, false);

                           //should display an error message saying the user is already registered

                           $user_id = $user->id;
                           return Redirect::to('users/'.$user_id.'/home'); 

                      }


                   } catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
                   {


                           if(!empty($key)){ /*if it's the sign up process*/

                                //selected institute id in  the registration
                                   $ins= Institution::whereinstitution_id(Session::get('iid'))->first();
                                   return View::make('home/googlePlusSignup')->with('result',$result)->with('ins',$ins);    
                           }else{ /*if it's the login process*/

                                  return Redirect::to('login')->withErrors(array('failure' => 'You are not registered in our system. Please sign up first')); 
                           }

                   }
           }
       }    // if not ask for permission first (google sign in page)
        else {
            // get googleService (google plus) authorization
            $url = $googleService->getAuthorizationUri();
            $iid = Input::get('instituteId');

         Session::put('iid',$iid);

            // return to google login url
            return Redirect::to( (string)$url );
        }
	}
}