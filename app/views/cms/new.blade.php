@include("header")
<?php
  $user = Auth::user();
  if($user->user_access == "Admin"){
  ?>  @include("nav")<?php
  }else{
  ?>  @include("guestNav")<?php
  }
?>
<?php
$user = Auth::user();
?>
<!-- =========================================Create New Beam Section Begins Here============================================ -->
<div class="innerContent">
    {{ Form::open([
                "route"        => "store new perk",
                "autocomplete" => "off",
                "enctype" =>"multipart/form-data",
                "id" => "beamForm"
            ]) }}
  <div class="container">
      <!-- Error Messages Display Section-->
 

      <!-- Beam Title and Tags Section -->
      <div class="row bColor beamRow">

          <div class="col-md-6">
              <div class="item">
                {{ Form::label("beamtitle", "Beam Title") }}
                {{ Form::text("beamtitle", Input::get("beamTitle"), [
                    "placeholder" => "beam title ","class" =>"form-control",'id'=>'beamTitle'
                ]) }}

              </div>
              {{ Form::text("image", Input::get("image"), ["class" =>"form-hidden", "id" => "mediaImg"]) }}
              {{ Form::text("image", Input::get("image"), ["class" =>"form-hidden", "id" => "mediaImg"]) }}

          </div>

          <div class="col-md-6">
            <div class="item">
                {{ Form::label("beamtag", "Tags") }}
                {{ Form::text("beamtag", " ", [
                    "placeholder" => "tags ","class" =>"form-control"
                ]) }}
              </div>
          </div>

          <div class="col-md-6">
            <input type="number" name="size" id="counter" value='0' hidden >
          </div>

          <div class="col-md-6">
            <div class="sendBeamButtonContainer">
              {{ Form::submit("Save Perk" , array('class' => 'sendBeam', "id" => "sendBeam", "onclick" => "validateBeam()")) }}
            </div>
          </div>

      </div>
      <!-- Beam Title and Tags Section -->

      <!-- Add Body Section to add Beam Content -->
      <div class="row beamRow beamFields rowSeprator">

          <div class=" col-md-1">
            <h4><!-- Fields --></h4>
          </div>

          <div class=" col-md-11">
            <ul>
                <li><div id="option_html" class="optionButton">Add Body</div></li>
            </ul>
          </div>

      </div>
      <!-- End of Add Body Section -->

      <div class="row beamRow rowSeprator"> <!-- 3rd row for content for eg field choosen-->

        <div class="col-md-12">
          <div id="field_wrap">
            <h3 id="fieldTitle"></h3>

          </div>
        </div>

      </div>

  </div>

</div>

  {{ Form::close() }}
<!-- ========================================Create New Beam Section Ends Here================================================= -->



<?php
$user = Auth::user();
$company = $user->company;
?>


<script type="text/javascript">
var count=0;
var fcount=0;
var tcount = 0;
var ccount = 0;



function increment() {

}




function appendField(argument) {

      var ibody = '<div class="field crit_'+fcount+'"><p><span class="option_title"></span><a class="option_remove glyphicons remove_2" href=""><i></i></a></p><input value="'+argument+'" class="field_name form-control hidden" type="text" id="field_name_'+fcount+'" name="field_name_'+fcount+'" /></input> <section id="editor"><div id="edit_'+fcount+'" style="margin-top: 30px;"></div></section><hr/><input class="field_value form-control hidden" type="text" id="field_value_'+fcount+'" name="field_value_'+fcount+'" /></input></div>';

   if (fcount<3) {
   $('#field_wrap').append(ibody);

   $("#edit_"+fcount).editable({imageUploadURL: '/uploadImage',inlineMode: false,  preloaderSrc: "", imageDeleteURL: "", imagesLoadURL:"/asset/images/true"});
  //  .editable({inlineMode: false,  preloaderSrc: "", imageDeleteURL: ""});
    //$("#edit_"+fcount).editable({imagesUploadURL:"/uploads"});
   //$("#edit_"+fcount).editable("option", "imageUploadURL", "/uploads");

    fcount++;
   $('#counter').val( function(i, oldval) {
        count++;
        return count;
    });
      $('.option_remove').off('click').on("click", function() {
          event.preventDefault();
          count = count-1;
          $(this).closest('.field').remove();
          fcount--;

      });
    };
}

function validateBeam(){
  for (var i = 0; i < count; i++) {
      var val = $("#edit_"+i).editable("getHTML");
      $("#field_value_"+i).val(val);
  };

  return true;
}

function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}



$('#option_html').bind("click", function(){
 event.preventDefault();
 if($(this).hasClass('clicked')){
    alert('handling only one');
  }else{
    $('#option_html').addClass('clicked');
    appendField("html");
  }

});



</script>
<script type="text/javascript">

/***********************************************
* Drop Down Date select script- by JavaScriptKit.com
* This notice MUST stay intact for use
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
***********************************************/

var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];

function populatedropdown(dayfield, monthfield, yearfield){
var today=new Date()
var dayfield=document.getElementById(dayfield)
var monthfield=document.getElementById(monthfield)
var yearfield=document.getElementById(yearfield)
for (var i=1; i<=31; i++)
dayfield.options[i]=new Option(i, i+1)
dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
for (var m=1; m<12; m++)
monthfield.options[m]=new Option(monthtext[m], monthtext[m])
monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
var thisyear=today.getFullYear()
for (var y=1; y<20; y++){
yearfield.options[y]=new Option(thisyear, thisyear)
thisyear+=1
}
yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
}

</script>

<script type="text/javascript">

//populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
//window.onload=function(){
  $( document ).ready(function() {
populatedropdown("daydropdown", "monthdropdown", "yeardropdown")
populatedropdown("enddaydropdown", "endmonthdropdown", "endyeardropdown")
});
//}
</script>
