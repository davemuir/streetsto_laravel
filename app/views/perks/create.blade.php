@include("header")
<?php
  $user = Auth::user();
  if($user->user_access == "Admin"){
  ?>  @include("nav")<?php
  }else{
  ?>  @include("guestNav")<?php
  }
?>
<div class="innerContent">
<div class="container">
  <h1>create an offer</h1>

{{Form::open(['route' => 'store offer', 'action'=>  'PerkController@store', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}			    
{{Form::text('title', Input::get('title'), ["id"=>"placeLogin",'placeholder' => 'Title', 'class' => 'form-control'])}}  
{{Form::text('category', Input::get('category'), ["id"=>"placeLogin",'placeholder' => 'Budget Category', 'class' => 'form-control'])}} 
{{Form::text('type', Input::get('type'), ["id"=>"placeLogin",'placeholder' => 'Offer Type', 'class' => 'form-control'])}} 

<h4>Select your Beacon</h4>


 {{ Form::select("beacon", $beacons, null, array('class' => 'form-control','id'=>'beacon_room')  ) }}

<h4>Choose one of your Perks</h4>
  {{ Form::select("perk", $perks, null, array('class' => 'form-control','id'=>'beacon_room')  ) }}
   {{Form::button('Create ', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
{{Form::close()}}
</div>
</div>
@include("footer")