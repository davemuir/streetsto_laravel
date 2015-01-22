<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Daravel PHP Framework</title>

</head>
<body>


<div class="row" id="loginHeader">

		<div class='col-md-6'>
			<img src='img/apengageBigLogo.png' id='frontPageLogo'/>
		</div>

		<div class="col-md-6">
		<div class="row">
			{{Form::open(['route' => 'login', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
			    	
			<div class="col-md-4">

			    
			    {{Form::text('email', Input::get('email'), ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control'])}}
			</div>

			<div class="col-md-4">
			
			    {{Form::password('password', ["id"=>"placeLogin",'placeholder' => 'Password', 'class' => 'form-control'])}}

			   {{'<label class="checkbox inline"><div id="check-section"><input type="checkbox" name="persistent" value="yes"></label><span id="check-text">Remember Me</span></div>'}}

			</div>

			<div class="col-md-4">
			
			    {{Form::button('SIGN IN', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
		
			<div class="row">
			   	<a style="clear:both;margin-left:7.5px;color: #fff;" href="{{URL::route('Reset Password')}}">Forgot password?</a>
			</div>
			</div>
		
			{{Form::close()}}
		</div>
		</div>

		

</div>

</body>
</html>
