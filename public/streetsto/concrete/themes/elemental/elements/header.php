<?php defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header_top.php');
$as = new GlobalArea('Header Search');
$blocks = $as->getTotalBlocksInArea();
$displayThirdColumn = $blocks > 0 || $c->isEditMode();

?>
<script src="http://sto.apengage.io/streetsto/concrete/js/uisearch.js"></script>
<script src="http://sto.apengage.io/streetsto/concrete/js/classie.js"></script>
<style>
@font-face {
    font-family: 'icomoon';
    src:url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.eot');
    src:url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.eot?#iefix') format('embedded-opentype'),
        url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.woff') format('woff'),
        url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.ttf') format('truetype'),
        url('http://sto.apengage.io/streetsto/concrete/themes/elemental/css/icomoon/icomoon.svg#icomoon') format('svg');
    font-weight: normal;
    font-style: normal;
}

body{
   /* margin-top:0px !important;*/
}
/* the search bar style*/
.sb-search {
    position: relative;
    margin-top: 10px;
   width: 0%;
    min-width: 40px;
    height: 40px;
    float: right;
    overflow: hidden;
 
    -webkit-transition: width 0.3s;
    -moz-transition: width 0.3s;
    transition: width 0.3s;
 
    -webkit-backface-visibility: hidden;
}
.sb-search-input {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    outline: none;
    background: #fff;
    width: 97%;
    height: 38px;
    margin: 0;
    z-index: 10;
    padding: 0px 0px 0px 2% !important;
    font-family: inherit;
    font-size: 16px;
    color: #2c3e50;
}
 
input[type="search"].sb-search-input {
    -webkit-appearance: none;
    -webkit-border-radius: 0px;
}
.sb-search-input::-webkit-input-placeholder {
    color: #cccccc;
}
 
.sb-search-input:-moz-placeholder {
    color: #cccccc;
}
 
.sb-search-input::-moz-placeholder {
    color: #cccccc;
}
 
.sb-search-input:-ms-input-placeholder {
    color: #cccccc;
}
.sb-icon-search,
.sb-search-submit  {
    width: 40px;
    height: 40px;
    display: block;
    position: absolute;
    right: 0;
    top: 0;
    padding: 0;
    margin: 0;
    line-height: 43px;
    text-align: center;
    cursor: pointer;
}
.sb-search-submit {
    background: #fff; /* IE needs this */
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; /* IE 8 */
    filter: alpha(opacity=0); /* IE 5-7 */
    opacity: 0;
    color: transparent;
    border: none;
    outline: none;
    z-index: -1;
}
.sb-icon-search {
    color: #cccccc;
   background:#fff;
    z-index: 90;
    font-size: 17px;
    font-family: 'icomoon';
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    -webkit-font-smoothing: antialiased;
}
 
.sb-icon-search:before {
    content: "\e000";
}

.sb-search.sb-search-open,
.no-js .sb-search {
    width: 100%;
}
.sb-search.sb-search-open .sb-icon-search,
.no-js .sb-search .sb-icon-search {
    background: #00b8ba;
    color: #fff;
    z-index: 11;
}
.sb-search.sb-search-open .sb-search-submit,
.no-js .sb-search .sb-search-submit {
    z-index: 90;
}
</style>
<header style="padding:0px !important;border:none;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
          
            <div id="sb-search" class="sb-search">


                <form name='search' action="<?php  echo $this->url('search','search_all') ?>" method="POST">
                       
                            <input class="sb-search-input" id="search" name="subject" placeholder="Enter your search term..." value="" type="search">
                           <input class="sb-search-submit" type="submit" value="">
                           
                            <span class="sb-icon-search"></span>
                </form> 
            </div>

           
            </div>
        </div>
    </div>
</header>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
</script>