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

  $fname = Input::get('fname');
  $lname =  Input::get('lname');
  $email = Input::get('email');
  $company = Input::get('company');
  $phone = Input::get('phone');
  
    //curl to get the locations json 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"http://sto.apengage.io/filemaker/locations_json.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec ($ch);
  curl_close ($ch);

  $data = array(
      "fname" => $fname,
      "lname" => $lname,
      "email" => $email,
      "company" => $company,
      "phone" => $phone,
      "response" => $response
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

  public function importCompany(){
     
      $email = Input::get("email");
      $companyBranch = Input::get("branch");
      //return $companyBranch .' - '. $companyName;
      //exit;

      $company = new Company;
      $company->name = Input::get('company');
      $company->locationID = Input::get('branch');
      $company->save();
      $companyID = $company->_id;
      $locationID = $company->locationID;

      $newUser = new User;
      $newUser->fname = Input::get("fname");
      $newUser->lname =Input::get("lname");
      $newUser->email = Input::get("email");
      $newUser->locationID = $locationID;
      $newUser->user_access = "Staff";
      $newUser->companyID = $companyID;
     

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

}
