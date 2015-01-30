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

		<div class='img_logo'>
			<img src='http://{{$_SERVER['SERVER_NAME']}}/img/apengage_logo.png' id='frontPageLogo'/>
		</div>
			<br />
			<br />
	
		<div class="col-md-6">
		<div class="row-register">
			{{Form::open(['route' => 'login form', 'action'=>  'UserController@loginForm', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
			    	
			<div class="col-md-4">	    
			    {{Form::text('email', '', ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control', 'required'=>true])}}
			</div>
			
			<div class="col-md-4">  
			
			    {{Form::password('password', ["id"=>"placeLogin",'placeholder' => 'Password', 'class' => 'form-control', 'required'=>true])}}

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
		<div class="row-register">
			{{Form::open(['route' => 'register form', 'action'=>  'UserController@registerForm', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
			    	
			<div class="col-md-4">

<!--			    {{Form::text('email', Input::get('email'), ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control'])}} -->
			    {{Form::text('email', '', ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control', 'required'=>true])}}
			</div>
			<div class="col-md-4">	    
			    {{Form::text('fname', Input::get('fname'), ["id"=>"placeLogin",'placeholder' => 'First Name', 'class' => 'form-control', 'required'=>true])}}
			</div>
			<div class="col-md-4">	    
			    {{Form::text('lname', Input::get('lname'), ["id"=>"placeLogin",'placeholder' => 'Last Name', 'class' => 'form-control', 'required'=>true])}}
			</div>
			<div class="col-md-4">	    
			    {{Form::text('company', Input::get('company'), ["id"=>"placeLogin",'placeholder' => 'Company Name', 'class' => 'form-control', 'required'=>true])}}
			</div>
			<div class="col-md-4">	    
			    {{Form::text('phone', Input::get('phone'), ["id"=>"placeLogin",'placeholder' => 'Phone No.', 'class' => 'form-control', 'required'=>true])}}
			</div>

			<div class="col-md-4">
			
			    {{Form::password('password', ["id"=>"placeLogin",'placeholder' => 'Password', 'class' => 'form-control', 'required'=>true])}}

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

<?php

//------------------------------- Modals start here

?>


<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            
            <h4 class="modal-title" id="myModalLabel">Forgotten Password</h4>
            </div>
            <div class="modal-body">
                {{Form::open(['route' => 'Forgot Password', 'action'=>  'UserController@forgotPassword', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'forgotPassword'])}}
			    	
			<div class="col-md-4">	    
			    {{Form::text('email', '', ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control', 'required'=>true ])}}
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

<?php if(isset($ttl)): ?>
<div class="modal fade" id="loginMesageModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            
            <h4 class="modal-title" id="myMsgLabel"><?php echo $ttl; ?></h4>
            </div>
            <div class="modal-body">
				<?php if( isset($msg) ): ?>
					<h3>email address: <?php echo $mail; ?></h3>
					<br/>
					<?php echo $msg; ?>.
				<?php else: ?>
					<h3>Thank you <?php echo $user['fname']; ?></h3>
					<br/>
					An email was sent to <?php echo $user['email']; ?>, please check your inbox to reset your password.
				<?php endif; ?>
				
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
	$("#loginMesageModal").modal({show:true});//show();
	$("#forgotPassword")[0].reset();
});
</script>
<?php endif; ?>
</body>
</html>
