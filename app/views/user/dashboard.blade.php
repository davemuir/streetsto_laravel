<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Daravel PHP Framework</title>

@include("header")
</head>
<body>

<?php
	$user = Auth::user();
	if($user->user_access == "Admin"){
	?>	@include("nav")<?php
	}else{
	?>	@include("guestNav")<?php
	}
?>
<div class="row" id="loginHeader">

		<div class='col-md-6'>
			<img src='img/apengageBigLogo.png' id='frontPageLogo'/>
			Dashboard - Hello {{$user->fname}}
			<!--{{Form::open(['route' => 'user/logout', 'action'=>  'UserController@logoutAction', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
			{{Form::button('Log Out', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
			{{Form::close()}}-->
			
		</div>

		<div class="col-md-6">
		<div class="row">
			
		</div>
		</div>

		

</div>
@include("footer")
</body>
</html>
