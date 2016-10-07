<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>

<!-- Basic Page Needs
  ================================================== -->
<meta charset="utf-8">
<title>{{ $template['name'] }}</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
  ================================================== -->
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" type="text/css">
<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" type="text/css">
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script> 
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.js') }}"></script> 
<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<!-- Favicons
	================================================== -->
	
</head>
<body>

    <!--Strat Main Container-->
    <div id="body-wrapper">
      
        <div class="container">
            <div class="row">
                <?php echo $template['description']; ?>
                <div class="col-sm-12 mar-10 text-center">
                    <button onclick="myFunction()">Print this page</button>
                </div>
            </div> 
        </div>
    </div>    
    <!--End Main container-->

<script>
function myFunction() {
    window.print();
}

$(window).load(function(){
    var name = '<?php echo $petient->first_name." ".$petient->last_name ?>';
    var src = '<?php echo URL::asset("images/logo.png") ?>';
    var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
   $('.logo img').attr('src',src);
    $('.name').text(name);
   $('.sign').text(name);
   var d = new Date();
   $('.date').text(d.toLocaleDateString());
   $('.day').text(weekdays[d.getDay()]);
   $('.month').text(d.getMonth()+1);
   $('.year').text(d.getYear());
   $('.datetime').text(d.toLocaleString());
   
});
</script>
</body>
</html>