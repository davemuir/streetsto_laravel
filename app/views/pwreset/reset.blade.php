<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Result</title>
@include("header")
</head>
<body>
<h1>Thank you <?php echo $user['fname']; ?></h1>
<br/>
<h2>An email was set to <?php echo $user['email']; ?>, please check your inbox to reset your password.</h2>
    
    
    
   <p><a href="{{URL::to('login')}}">Go to Login Page</a></p> 
</body>
</html>
