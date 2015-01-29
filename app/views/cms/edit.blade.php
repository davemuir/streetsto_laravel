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
	<?php
//print_r($beamID);
$beamID = $beamID[0];
//exit;
?>
<script>
$(document).ready(function(){
  //check the submission and process new values
$('#submitMe').click(function(){
    //event.preventDefault();
  	 var val = $("#edit_").editable("getHTML");
      $("#field_name_").attr('value',val);
      $("#field_value_").attr('value',val);
     var string = $("#field_name_").val();

    var confirmed =  confirm('Are you Sure?');
    if(confirmed == false){
        return false;
    }else{


    }
});

  
});
</script>
<div class="innerContent">
  <div class="beamContainer">
    <div class="row bColor beamRow" >


              @if($beamID)
                  {{ Form::open([
                    "route"        => "update perk",
                    "autocomplete" => "off",
                    "enctype" =>"multipart/form-data",
                    "method" => "PUT"
                  ]) }}


                <div class="col-md-6">
                  <div class="item">
                      {{ Form::label("beamtitle", "Beam Title") }}
                      {{ Form::text("beamtitle", $beamID['title'], [
                        "placeholder" => $beamID['title'] ,"class" =>"form-control"
                      ]) }}
                  </div>
                </div>
                <div class="col-md-6">
                  <?php
                    $tags = '';
                    foreach($beamID['tags'] as $key=>$value){
                      $tags .= $value.' ';
                    }
                  ?>
                  <div class="item">
                    {{ Form::label("beamtag", "Tags") }}
                    {{ Form::text("beamtag", $tags, [
                        "placeholder" => "tags ","class" =>"form-control"
                    ]) }}
                  </div>
                </div>
                <div class="col-md-6">
                    {{ Form::label("beamcontent", "Beam Content") }}
                </div>
                <div class="col-md-6">
                  <div class="sendBeamButtonContainer">
                   
                    {{ Form::text('beamID', $beamID['_id'], ["class"=>"form-hidden"]) }}
                    <button type="submit" id='submitMe' class="beamDelete  sendBeam">Update</button>

                  </div>
                </div>
      </div>

      <div class="row beamRow beamFields rowSeprator">

                <div class=" col-md-1">
                  <h4><!-- Fields --></h4>
                </div>

                <div class=" col-md-11">
                  
                </div>

      			</div>

      <div class="row beamRow rowSeprator"> <!-- 3rd row for content for eg field choosen-->

      

                  
   

      <div class="row beamRow rowSeprator"> <!-- 3rd row for content for eg field choosen-->

        <div class="col-md-12">
          <div id="field_wrap">
            <h3 id="fieldTitle"></h3>
            	  <?php  $elements = $beamID['elements'];
                    	 $string = $elements[0]['content']; 
                    	 $string =  strip_tags($string,'<img>,<table>,<td>,<th>,<thead>,<tbody>,<tr>,<iframe>,<a>,<b>,<i>,<br>,<div>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<p>');
                    ?>
                   
         			 <div class="field crit_" id='crit_'><p><span class="option_title"></span></p>
         			 	<input value="" class="field_name wsi form-control hidden" type="text" id="field_name_" name="field_name_" /></input> 
         			 	<section id="editor"><div class='editAll' id="edit_" style="margin-top: 30px;"></div></section><hr/><input class="field_value form-control hidden" type="text" id="field_value_" name="field_value_" /></input></div>
          </div>
        </div>

      </div>

               

                 
               


                  {{Form::close()}}
              @endif
         <div class="col-md-6">
           
        </div>
    </div>
</div>
</div>
</div>
</div>
<script>
$("#edit_").editable({imageUploadURL: '/uploadImage',inlineMode: false,  preloaderSrc: "", imageDeleteURL: "", imagesLoadURL:"/asset/images/true"});
$("#edit_").editable("setHTML", '<?php echo $string; ?>', false);
</script>
@include("footer")
