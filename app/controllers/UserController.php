<?php
use Illuminate\Support\MessageBag;
class UserController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/  


public function view(){
	return View::make('user/login');
}

public function registerForm(){
 /* $company = new Company;
  $company->name = Input::get('company');
  $company->save();

  $companyID = $company->_id;
  $user = new User;
  $user->email = Input::get('email');
  $user->fname = Input::get('fname');
  $user->lname = Input::get('lname');
  $user->phone = Input::get('phone');
  $user->companyID = $companyID;
  $user->user_access = "Admin";
  $user->password = Hash::make(Input::get('password'));
  $user->save();*/
  $fname = Input::get('fname');
  $lname =  Input::get('lname');
  $email = Input::get('email');
  $company = Input::get('company');
  
  $data = array(
      "fname" => $fname,
      "lname" => $lname,
      "email" => $email,
      "company" => $company
  );
  $user = User::where('user_access','=','Admin')->get();
    $userTo = array();
      foreach ($user as $key => $value) {
          $userTo[] = $value->email;
      }

  Mail::send('emails.newUserRequest', $data, function($message) use ($userTo){
    $message->to($userTo);
    $message->subject('Hi, someone you may know has applied for user access');
  });
  //return $password;
  return Redirect::to('/login');
}

public function loginForm() {
    $errors = new MessageBag();
    if ($old = Input::old("errors")) {
      $errors = $old;
   }
    $data = ["errors" => $errors];
    if (Input::server("REQUEST_METHOD") == "POST") {
      $validator = Validator::make(Input::all(), ["email" => "required", "password" => "required"]);
      if ($validator->passes()) {
        $credentials = ["email" => Input::get("email"), "password" => Input::get("password")];
        if (Auth::attempt($credentials)) {

          return Redirect::to("/dashboard");
        }
      }
      $data["errors"] = new MessageBag(["password" => ["Email and/or password invalid."]]);
      $data["email"] = Input::get("email");
      return Redirect::to("/login")->withInput($data);
    }
     return Redirect::to("/login");
  }

//handle add user/company from form.
public function autoAddUser($fname,$lname,$email,$company){

      $company = new Company;
      $company->name = Input::get('company');
      $company->save();
      $companyID = $company->_id;

      $newUser = new User;
      $newUser->fname = $fname;
      $newUser->lname = $lname;
      $newUser->email = $email;
      $newUser->user_access = "Staff";
      $newUser->companyID = $companyID;
     

      /*$allUser = User::all();
      foreach($allUser as $key => $value){
        if($value->email == $newUser->email){
          $validator = array('message' => 'The email you provided already is registered');
          return Redirect::to("/addUser")->withErrors($validator);
        }
      }*/
      $length = 8;
      $password = "";
        // define possible characters
        $possible = "0123456789abcdfghjkmnpqrstvwxyz";
        $i = 0;
        // add random characters to $password until $length is reached
        while ($i < $length) {
          // pick a random character from the possible ones
          $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
          // we don't want this character if it's already in the password
          if (!strstr($password, $char)) {
            $password .= $char;
            $i++;
          }
       }
      $data = array(
        "company" => $company->name,
        "access" => $newUser->user_access,
        "email" => $email,
        "fname" => $newUser->fname,
        "lname" => $newUser->lname,
        "tempPass" => $password

      );
      $userData = array(
        "email" => $email,
        "fname" => $newUser->fname
      );

      $newUser->password = Hash::make($password);
      $newUser->save();

      Mail::send('emails.requestedUser', $data, function($message) use($userData){
          $message->to($userData['email'], "candidate")->subject('Hi '.$userData['fname'].', you have been granted user access');
      });

      return Redirect::to('/dashboard');
  }

  public function logoutAction() {
    $user = Auth::user();
    Auth::logout();
    return Redirect::to("/login");
  }
  
  
	
	//displays the form for the new password to be added.
//	public function forgotPassword($email){
//---------------------------------------------------------------------
	public function forgotPassword(){
	/*
$data["errors"] = new MessageBag(["company" => ["Email invalid."]]);
//$data["email"] = Input::get("email");
return Redirect::to("/login")->withInput($data);
*/
	try{
		$myUser = User::where('email','=',Input::get("email"))->get();
		if($myUser){
			foreach ($myUser as $key => $value) {
				$id    = $value->_id;
				$fname = $value->fname;
				$lname = $value->lname;
				$email = $value->email;
			}
			$data = array(
				"fname"    => $fname,
				"lname"    => $lname,
				"tempPass" => "1234"
			);
			$userData = array(
				"email" => $email,
				"fname" => $lname.','.$fname
			);
			Mail::send('emails.passwordReset', $data, function($message) use($userData){
				$message->to($userData['email'], "candidate")->subject('Hi '.$userData['fname'].', have you forgotten your password?');
			});
			return View::make('pwreset/reset',array('user' => $userData));
		}else{
			return View::make('pwreset/error',array('error' => 'user not found'));
		}
	}catch(Exception $e){
		return View::make('pwreset/error',array('error' => 'user not found<br/>'.$e->getMessage()));
	}
//		return Redirect::to("/");
//---------------------------------------------------------------------
//		return Redirect::to("/resetpassword");
	}

}


