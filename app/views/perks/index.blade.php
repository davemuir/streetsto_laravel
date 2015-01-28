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
<script>
$(document).ready(function(){

  $('#compareSubmit').click(function(){
    var compareSet =[];
    var checkBoxes = false;
    $('.compare:checked').each(function(){
     compareSet.push($(this).val());
        checkBoxes =  true;

    });
      if(checkBoxes == false){
      alert("Nothing Checked to Compare.  Please check one of your Campaign's boxes to compare actions with other campaigns");
      return;
    }
    var parseSet = [];
    for (var key in compareSet){
       var xhr = new XMLHttpRequest();
      xhr.open('GET', '/analytics/campaigns/'+compareSet[key], false);
      xhr.send(null);
      if (xhr.status == 200) {
        var arr = JSON.parse(xhr.response);
        parseSet.push(arr);
      }
    }

    //console.log(parseSet);
    drawVisualization(parseSet);

  });

  $('#closeComparison').click(function(){
       $('#comparisonChart').hide();//clearRow
  });
  function drawVisualization(parseSet) {
      $('#comparisonChart').show();//clearRow

    var data = new google.visualization.DataTable() ;
    //data.addColumn('Entrances', 'Exiting');
    var Adata = [];
    for(var key in parseSet){
      var entries = parseSet[key][0].entries.length;
      var exits = parseSet[key][0].exits.length;
      var accepted = parseSet[key][0].accepted.length;
      var confirmed = parseSet[key][0].confirmed.length;
      var confirmedOffer = parseSet[key][0].confirmedOffer.length;
      var title = parseSet[key][0].title;
      Adata.push([title,entries,exits,accepted,confirmed,confirmedOffer]);

    }
    Adata.unshift(['campaign Name','entries','exits','accepted','confirmed survey','confirmed offer'])
    data = google.visualization.arrayToDataTable(Adata);

    var options = {
      title : 'Reaches',
      vAxis: {title: "Reach Number"},
      hAxis: {title: "Interaction Types"},
      seriesType: "bars",
      lineWidth:1,
      legend: { position: 'bottom' },
      colors:['#013d50','#4984ba','#5f5f5f','#939a9b','#4bb461'],
      series: {5: {type: "line"}}
    };
    var chart = new google.visualization.ComboChart(document.getElementById('innerComparison'));
    chart.draw(data, options);



    }
});
</script>

<div class="row" >
  <div class="col-md-12">
    

    <div class="campaignBar">

        <a id="newCampaign" class="btn btn-primary btn-mini" href="{{ URL::to('perks/create') }}">New Offer</a>
        <button id='compareSubmit' class="btn btn-primary btn-mini">Compare Selected</button>

    </div>


   <h2 class="titleHeading"><span class='campaignReach'><? $size = sizeOf($activeArray); echo $size;?></span> Campaigns</h2>
     <div class="myToolTip">
        <div class="tt">
          <a id="tt-help" href="#"></a>
          <div class="tt-arrow"></div>
          <div id="tt-wrapper" class="tt-floorPlan">
            <p>Campaigns provide a way to connect the messages and survey content you send out to a customer to a real campaign you may be running in the real world.
              Set up a New campaign, or edit an existing one and attach beams and surveys you have created from your cms.  Campaigns allow you to deliver specific content to the beacons and rooms you are tracking in your campaign.  Get all the data you need from the campaigns you are running right here.</p>
          </div>
        </div>
      </div>

         <div id="comparisonChart">
             <a class="glyphicons remove_2" id="closeComparison" style="float:right;"href=""><i></i></a>
             <div id="innerComparison">
             </div>
        </div>

        <table class="table-striped table firstT" id="zebraTable">
          @if (!empty($activeArray))
         @foreach($activeArray as $key => $value)

         <tr class="clearRow">
                <tr class="clearRow">
                  <td class="col-md-8">@if($value->active == true)<a href="#" class=" glyphicons power onlineCampaign"><i></i><span></span></a>@else<a href="#" class=" glyphicons power offlineCampaign"><i></i><span></span></a>@endif<b>{{$value->title}}</b></td>
                  <td><a  href="/analytics/campaign/{{$value->id}}" class="show-stats campaignItem" id="campStats_<?php echo $key;?>" data-req="{{$value->id}}"><img src="img/stats.svg">statistics</a></td>
                  <td><a class="campaignItem" href="{{ URL::to('campaigns/'.$value->id.'/edit') }}"><img src="img/edit.svg">edit</a></td>
                  <td><a  id="campStats_<?php echo $key;?>" data-req="{{$value->id}}" class="collapseCampaign campaignItem" ><img src="img/eye.svg">view +</a>  </td>
                  <td><input type="checkbox" class="compare" name="{{$value->name}}" value="{{$value->id}}"><br></td>


                </tr>
                <tr class="noStripe">
                  <td colspan=5 class="col-md-12">
                 <div class="stats-wrap"  id="statsWrapper_campStats_<?php echo $key?>" data-req="{{$value->id}}">
                    <div class="stats-body" id="campVisbd_campStats_<?php echo $key?>">

                    </div>
                   <div class="view-body" id="viewVisbd_campStats_<?php echo $key?>">

                    </div>


                </div>



                  </td>
                </tr>
          </tr>

          @endforeach
          @endif
        <tr>
                <tr class="lastTR">
                  <td class="col-md-8">Last</td>
                   <td >Last</td>
                    <td >Last</td>
                     <td >Last</td>
                </tr>
                </tr>
                <tr class="noStripe">
                  <td colspan=5 class="col-md-12">
                 <div class="stats-wrap"  >
                    <div class="stats-body" >
                    </div>
                   <div class="view-body">
                    </div>

                      <select>
                     <option value="data Set">data Set</option>
                      </select>
                </div>
          </tr>

        </table>


     </div>

  </div>
</div>
</div>
</div>
@include("footer")