<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>
<?php
$u = new User();
$user =  $u->getUserName();
 if($user == '' ){
 	header('Location:http://sto.apengage.io/streetsto/index.php/splash');
 	die();
 }

 ?>
<style>
	/*.mainContainer{
		margin-top:30px;
	}*/
	.list{
		list-style: none;
		padding-left:0px;
	}
	.parentList:hover,.typeList:hover,.locationList:hover{
		background:#cccccc;
		color:#fff;
	}
	.parentList,.typeList,.locationList{
		font-size:18px;
		padding: 10px 0px;
		padding-left:5%;
		border-bottom:1px solid #cccccc;
	}
	.parentList:first-child,.typeList:first-child,.locationList:first-child{
		border-top:1px solid #cccccc;
	}
	.backButton{
		font-size:27px;
		padding-left:5%;
	}
	#backContainer{
		padding-bottom:10px;
	}
	.backButton{
		color:#00b8ba;
	}
</style>
<main>
	<div class="mainContainer">
<?php
$a = new Area('Main');
$a->enableGridContainer();
$a->display($c);
?>
<script>
$(document).ready(function(){
	//populate the workbook select

	getSelect();
	function getSelect(){
		$("#backContainer").empty();
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'http://192.168.128.157/filemaker/list.php', false);
		xhr.send(null);
		if (xhr.status == 200) {
			     var resp = JSON.parse(xhr.response);	
			     console.log(resp);
			     $('.list').empty();
			    for (record in resp) {
			    	$('.list').append("<li class='parentList' id='"+record+"'>"+resp[record]+"</li>");
				}

				$('.parentList').click(function(){
					var type = $(this).attr('id');
					getList(type);
				});
		}
	}

	function getList(type){
		$("#backContainer").empty();
		$("#backContainer").append('<span class="backButton" id="back"> < </span>');
		$('#back').click(function(){
			 getSelect();
		});
		$.ajax({
			    type: 'post',
				url: 'http://192.168.128.157/filemaker/list.php',
			    data: {type:type},
			    success: function(response) {
				    var resp = JSON.parse(response);	
				   // console.log(resp);
				    $('.list').empty();
				    for (record in resp) {
				    	$('.list').append("<li class='typeList' id='"+record+"'>"+resp[record]+"</li>");
				    	var previous = record;
					}

			    	$('.typeList').click(function(previous){
			    		var location = $(this).attr('id');
			    		var previous = type;
			    		getType(location,previous);
			    	});
			    }
		});
	}
	//});

	//function for location
	function getType(location,previous){
		$("#backContainer").empty();
		$("#backContainer").append('<span class="backButton" id="back"> < </span>');
		$('#back').click(function(){
			 typeBack(previous);
		});
	
		$.ajax({
			    type: 'post',
				url: 'http://192.168.128.157/filemaker/list.php',
			    data: {location:location},
			    success: function(response) {
			    	var resp = JSON.parse(response);	
			   		//console.log(resp);
			     	$('.list').empty();
			   		for (record in resp) {
			    		$('.list').append("<li class='locationList' id='"+record+"'>"+resp[record]+"</li>");
					}
			    	$('.locationList').click(function(){
			    		var favouriteID = $(this).attr("id");
			    		var location = $(this).text();
			    		window.location = "index.php/location?lid="+location;
			    	});
			    }
		});
	}

	/*function favSet(favouriteID){
		$.ajax({
			    type: 'get',
				url: 'index.php/favourite',
			    data: {fav:favouriteID,userID:'1234'},
			    success: function(response) {
				   console.log(response);
			    }
		});
	}*/

	function typeBack(previous){
		type = previous;
		getList(type);

	}

});

</script>

<div id="backContainer">
	
</div>
<ul class="list">

</ul>
<?php
$a = new Area('Page Footer');
$a->enableGridContainer();
$a->display($c);
?>
</div>
</main>

<?php  $this->inc('elements/footer.php'); ?>
