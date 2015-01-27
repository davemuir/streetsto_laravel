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
  $user = new User;
  $user->email = Input::get('email');
  $user->fname = Input::get('fname');
  $user->lname = Input::get('lname');
  $user->lname = Input::get('company');
  $user->phone = Input::get('phone');
  $user->user_access = "Admin";
  $user->password = Hash::make(Input::get('password'));
  $user->save();
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



  public function logoutAction() {
    $user = Auth::user();
    Auth::logout();
    return Redirect::to("/login");
  }

}
