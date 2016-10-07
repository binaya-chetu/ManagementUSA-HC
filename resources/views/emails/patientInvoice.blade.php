<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Hi {{ $patient }}</h2>
<h3>Arizona Mens Clinic has sent you payment Invoice</h3>

    <div>
       To view the invoice, click on the link <a href="{{ $url }}">Invoice</a>
    </div></br>
	<div>
       Thanks,</br>
	   Arizona Mens Clinic,</br>
	   America
    </div>

</body>
</html>