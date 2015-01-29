<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Daravel PHP Framework</title>
@include("header")
</head>
<body>
<?php if(isset($data)){
	print_r($data);
}
?>
<div class="row" id="loginHeader">

		<div class='col-md-6'>
			<img src='img/apengageBigLogo.png' id='frontPageLogo'/>
		</div>
			
	
		<div class="col-md-6">
		<div class="row">
			{{Form::open(['route' => 'login form', 'action'=>  'UserController@loginForm', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
			    	
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
			   	<!--<a style="clear:both;margin-left:7.5px;color: #fff;" href="{{URL::route('Reset Password')}}">Forgot password?</a>-->
			</div>
			</div>
				
			<a href="#" class="btn btn-success" data-toggle="modal" data-target="#basicModal">Forgot my Password</a>
				
			{{Form::close()}}
		</div>      
		</div>   

		<!--Register Form-->
		<br/>
		<br/>
		<div class="col-md-6">
		<div class="row">
			{{Form::open(['route' => 'register form', 'action'=>  'UserController@registerForm', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
			    	
			<div class="col-md-4">

			    
			    {{Form::text('email', Input::get('email'), ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control'])}}
			</div>
			<div class="col-md-4">	    
			    {{Form::text('fname', Input::get('fname'), ["id"=>"placeLogin",'placeholder' => 'First Name', 'class' => 'form-control'])}}
			</div>
			<div class="col-md-4">	    
			    {{Form::text('lname', Input::get('lname'), ["id"=>"placeLogin",'placeholder' => 'Last Name', 'class' => 'form-control'])}}
			</div>
			<div class="col-md-4">	    
			    {{Form::text('company', Input::get('company'), ["id"=>"placeLogin",'placeholder' => 'Company Name', 'class' => 'form-control'])}}
			</div>
			<div class="col-md-4">	    
			    {{Form::text('phone', Input::get('phone'), ["id"=>"placeLogin",'placeholder' => 'Phone No.', 'class' => 'form-control'])}}
			</div>

			<div class="col-md-4">
			
			    {{Form::password('password', ["id"=>"placeLogin",'placeholder' => 'Password', 'class' => 'form-control'])}}

			   {{'<div id="check-section"><input type="checkbox" name="persistent" value="yes"></input><label class="checkbox inline"><span id="check-text">Remember Me</span></label></div>'}}

			</div>

			<div class="col-md-4">
			
			    {{Form::button('Register', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
		
			<div class="row">
			   	<!--<a style="clear:both;margin-left:7.5px;color: #fff;" href="{{URL::route('Reset Password')}}">Forgot password?</a>-->
			</div>
			</div>
		
			{{Form::close()}}
		</div>
		</div>
		

</div>

<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">Forgotten Password</h4>
            </div>
            <div class="modal-body">
                {{Form::open(['route' => 'Forgot Password', 'action'=>  'UserController@forgotPassword', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'forgotPassword'])}}
			    	
			<div class="col-md-4">	    
			    {{Form::text('email', Input::get('email'), ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control'])}}
			</div>
 
			<div class="col-md-4">
			
			    {{Form::button('Submit', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
 
			</div>
				
			
			{{Form::close()}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      
        </div>
    </div>
  </div>
</div>
</body>
</html>
