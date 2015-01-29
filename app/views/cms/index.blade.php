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
<h1>Perks</h1>
<li><a href="{{URL::route('new perk')}}">create perk</a></li>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Date</th>
			<th>Title</th>
			<th>Offer</th>
			<th>edit</th>
			<th>delete</th>
		</tr>
	</thead>
	<body>
		 <?php 
			foreach($perks as $perk){
				echo "<tr><td>".$perk->updated_at."</td><td>".$perk->title."</td>";
				echo "<td>".$perk->offer_ids[0]."</td>";
				echo "<td><a href='/index.php/cms/edit/".$perk->_id."'>Edit</a></td><td><a href='/index.php/cms/remove/".$perk->_id."'>delete</a></td></tr>";
			}
		?>
	</body>
</table>
</div>
</div>