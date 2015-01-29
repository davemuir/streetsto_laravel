<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img style="max-height:26px;" src="http://{{$_SERVER['SERVER_NAME']}}/img/keylogo.png"></a>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{URL::route('Perks')}}">Offers</a></li>
			 <li><a href="{{URL::route('Analytics')}}">Analytics</a></li>
			 <li><a href="{{URL::route('CMS')}}">Perks</a></li>
       <li><a class="glyphicons power" href="#"><i></i>Account</a></li>
			 <li><a class="glyphicons power" href="{{URL::to('logout')}}"><i></i>log out</a></li>

          </ul>
          <form class="navbar-form navbar-right">
            <input type="hidden" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>