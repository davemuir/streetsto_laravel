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

  <div class="row">
    <div class="col-md-12">
      
      <!-- Form Wizard / Arrow navigation & Progress bar -->

      <div id="rootwizard" class="wizard">

        <!-- Wizard heading -->
        <div class="wizard-head">
          <ul>
            <li><a href="#tab1" data-toggle="tab">First</a></li>
            <li><a href="#tab2" data-toggle="tab">Second</a></li>
            <li><a href="#tab3" data-toggle="tab">Third</a></li>
            <li><a href="#tab4" data-toggle="tab">Fourth</a></li>

          </ul>
        </div>
        <!-- // Wizard heading END -->

        <div class="widget">
         {{ Form::open([
           "route"        => "Save Beacons",
           "autocomplete" => "off",
           'method' =>'POST'
           ]) }}
           <!-- Wizard Progress bar -->
           <div class="widget-head progress" id="bar">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45">Step <strong class="step-current">1</strong> of <strong class="steps-total">3</strong> - <strong class="steps-percent">100%</strong></div>
          </div>
          <!-- // Wizard Progress bar END -->

          <div class="widget-body">
            <div class="tab-content">

              <!-- Step 1 -->
              <div class="tab-pane active" id="tab1">
               <h4>Add Beacons</h4>
               <p>Configure your beacons through this step by step guide. Create the different rooms of your location below and assign your beacons to them.
                See who is in your  at any given time from your <a href="{{URL::to('/')}}">dashboard</a>.</p>
              </div>
              <!-- // Step 1 END -->

              <!-- Step 2 -->
              <div class="tab-pane" id="tab2">
                <div class="row">



              <!-- Add Beacon Drop down-->

                      <div class="col-md-8">
                        <h4>Select your Beacon</h4>
                        <div id="beacon_list_wrapper">


                        </div>
                        {{ Form::text("manufacturer", Input::get("manufacturer"), [
                    "placeholder" => "Manufacturer","class" =>"form-control hidden", "id" => "manuTF"
                    ]) }}


                        {{ Form::label("uuid", "UUID of Beacons" , array('class'=>'hidden','id'=>'uuidTFLabel') )}}
                  {{ Form::text("uuid", Input::get("uuid"), [
                    "placeholder" => "find this on your box","class" =>"form-control hidden", "id" => "uuidTF"
                    ]) }}
                    <div id="beac_wrapper" style="display: none;">
                    {{ Form::label("major", "Major of Beacon" , array('class'=>''))}}
                  {{ Form::text("major", Input::get("major"), [
                    "placeholder" => "find this on your box","class" =>"form-control ", "id" => "majorTF"
                    ]) }}

                    {{ Form::label("minor", "Minor of Beacon", array('class'=>''))}}
                  {{ Form::text("minor", Input::get("minor"), [
                    "placeholder" => "find this on your box","class" =>"form-control ", "id" => "minorTF"
                    ]) }}
                  </div>




                      </div>
              <!-- End of add Beacon functionality-->

                  <div class="col-md-12 sysBeacons">


                 </div>



                </div>
              </div>
              <!-- // Step 2 END -->

              <!-- Step 3 -->
              <div class="tab-pane" id="tab3">
                <div class="row">
                  <div class="col-md-3">
                    <strong>Description</strong>
                    <p class="muted">Give your beacon an easily idenitifiable Alias.</p>
                  </div>
                  <div class="col-md-9">
                   {{ Form::label("alias", "Give your beacon a Name")}}
                   {{ Form::text("alias", Input::get("alias"), [
                     "placeholder" => "Frodo's Beacon","class" =>"form-control", "id"=>"beaconAlias"
                     ]) }}

                    <!-- {{ Form::label("branch", "Choose a Branch")}}
                   {{ Form::text("branch", Input::get("branch"), [
                     "placeholder" => "The Shire","class" =>"form-control"
                     ]) }}-->

                 



                   <script>

                    $("#campaignSelect option").each(function(index){
                      $(this).text($(this).text().replace(/_/g, ' '));
                    });

                  </script>

                </select>
              </div>
            </div>
          </div>
          <!-- // Step 3 END -->

          <!-- Step 4 -->
          <div class="tab-pane" id="tab4">
            <div class="row">
              <div class="col-md-3">
                <strong>Review </strong>
                <p class="muted">Review and Submit your form</p>
              </div>
              <div class="col-md-9">
                  <p><b>Manufacturer:</b> <span id="review_manu"> </span></p>
                  <p><b>UUID:</b> <span id="review_uuid"> </span></p>
                  <p><b>Major:</b> <span id="review_major"> </span></p>
                  <p><b>Minor:</b> <span id="review_minor"> </span></p>
                  <p><b>Alias:</b> <span id="review_alias"> </span></p>
                  <p><b>Room:</b> <span id="review_room"> </span></p>

              </div>
            </div>
          </div>
          <!-- // Step 4 END -->



        </div>

        <!-- Wizard pagination controls -->
        <ul class="pagination margin-bottom-none">
          <li class="primary previous first"><a href="#" class="no-ajaxify">First</a></li>
          <li class="primary previous"><a href="#" class="no-ajaxify">Previous</a></li>
          <li class="last primary"><a href="#" class="no-ajaxify">Last</a></li>
          <li class="next primary"><a href="#" class="no-ajaxify">Next</a></li>
          <li class="next finish primary" style="display:none;">{{ Form::submit("Finish", ['class'=> 'no-ajaxify finish_beacon']) }}</li>
          <li>
            <div id="tt-wrapper" class="tt-sysAdmin">
              <a id="tt-help" href="#">
                <span>Steps to setting up and managing your beacons.</span>
              </a>
            </div>
          </li>
        </ul>
        <!-- // Wizard pagination controls END -->
        {{ Form::close() }}
      </div>
    </div>
  </div>
  <!-- // Form Wizard / Arrow navigation & Progress bar END -->
</div>
</div>
@include('footer')