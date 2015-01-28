<?php
use Illuminate\Support\MessageBag;
class PerksController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/  




//makes the offerings view
public function view(){
	$user= Auth::user();
	$activeArray = Offer::where('companyID',$user->companyID)->orderBy('title')->get();
	$inactiveArray = Offer::where('active', false)->where('company_id',$user->companyID)->get();
	return View::make('/perks/index')->with('activeArray',$activeArray)->with('inactiveArray',$inactiveArray);
}
public function create(){
		$user= Auth::user();
		if ($user) {
     
		$company = $user->company;
		return $company;
		exit;
		$beams = $company->perks;
		return View::make('/perks/create')->with('beams', $beams);
	}
}
public function newPerk(){
	return View::make('/cms/new');
}
public function removePerk($perkID){
	$perk = Perk::find($perkID);
	$perk->delete();
	return Redirect::to('/cms/index');
}
public function edit($perkID){

	$beamID = Perk::where('_id','=',$perkID)->get();
	return View::make('/cms/edit')->with('perkID',$perkID)->with('beamID',$beamID);
}

public function cms(){
	$user = Auth::user();
	$companyID = $user->companyID;
	$perks = Perk::where('companyID','=',$companyID)->get();

	return View::make('/cms/index')->with('perks',$perks)->with('companyID',$companyID);
}
public function storeNewPerk(){


		$user = Auth::user();
	
		if ($user ) {

		$beam = new Perk;
		$beam->title = Input::get('beamtitle');
	   	$beam->companyID = $user->companyID;

		//Create a tag entry for each beacon
		if (Input::get('beamtag')) {
		$tags =  explode( ' ', trim(Input::get('beamtag')) );
		$beam->tags = $tags;
		}


		$media = $beam->elements;
	    $selection;
	    for ($i=0; $i < Input::get('size'); $i++) {
	    	$string = strip_tags(Input::get('field_value_'.$i),'<img>,<iframe>,<a>,<b>,<i>,<br>,<div>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<p>');
	    	$name = array('type' => Input::get('field_name_'.$i), 'content' => str_replace("’", "&apos;", $string));
	        $media[] =  $name;
	    }

	    $beam->elements = $media;
	    $elemValidator = Validator::make(
	    	array('fields' => $beam->elements),
    		array('fields' => 'required')
			);
			if ($elemValidator->fails())
			{
            //printr(Input::all()); exit();
				//return "no elemets";

				return 'errors 1';
			}


	    $titleCheck = $beam->title;

	    $beamvalidator = Validator::make(
    		array('beam name' => $titleCheck),
    		array('beam name' => array('required'))
		);
			if ($beamvalidator->fails())
			{
				// The given data did not pass validation
				//return "nothing provided";//View::make("user/cms")->with();

				return 'errors 2';
			}

		$beam->save(); 

    	return Redirect::to('/cms/index');


		}
	}

public function updatePerk(){
		$user = Auth::user();
		
		// Update title
		if ($user) {

		$beam = Perk::find(Input::get('beamID'));
		$beam->title = Input::get('beamtitle');
	
      //Create a tag entry for each beacon
      if (Input::get('beamtag')) {
      $tags =  explode( ' ', trim(Input::get('beamtag')) );
       $beam->tags = $tags;
      }

    	$input1 = Input::get('field_name_');

		$media = array();
	    //$string = strip_tags(Input::get('field_value_'),'<img>,<iframe>,<a>,<b>,<i>,<br>,<div>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<p>');

	    $name = array('type' => 'html', 'content' => strip_tags(Input::get('field_name_'),'<img>,<table>,<td>,<th>,<thead>,<tbody>,<tr>,<iframe>,<a>,<b>,<i>,<br>,<div>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<p>'));
	
	    $media[] =  $name;
	 
	    //return $media;
	    $beam->elements = $media;
	    $elemValidator = Validator::make(
	    	array('fields' => $beam->elements),
    		array('fields' => 'required')
			);
			if ($elemValidator->fails())
			{
            printr(Input::all()); exit();
				//return "no elemets";

				return Redirect::to("cms/beam")->withErrors($elemValidator);
			}


	    $titleCheck = $beam->title;


    	
    	$beam->save();



    	return Redirect::to("cms/index");


		}
	}

//for editting offers
public function editOffer(){
	$user = Auth::user();
	$companyID = $user->companyID;
	$perks = Offer::where('companyID','=',$companyID)->get();
	return View::make('/cms/index')->with('perks',$perks)->with('companyID',$companyID);
}


}

