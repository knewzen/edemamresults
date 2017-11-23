<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>Hacarus Test</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="/hacarus/assets/css/bulma.css" rel="stylesheet">
	<style type="text/css">
	body{font-family:"Roboto","sans-serif";}
	</style>
</head>
<body>
	<div class="container">
	<a href="/hacarus/"><h1>HACARUS</h1></a>
	<form action="/hacarus/" method="get">
		<input type="text" name="search"/>
		<input type="submit" value=" SEARCH "/>
	</form>
	<?php

	if(@$_REQUEST['search']!=""){
		$querystring = @$_REQUEST['search'];

		echo "<h3>Results for: <em>$querystring</em></h3>\n";
		echo "<div id=\"results\"></div>";
	}

	?>
	</div>
	<script>

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        myObj = JSON.parse(this.responseText);
	        var results = '';
	        for(var i = 0; i < myObj.hits.length; i++){
	        	var label = myObj.hits[i].recipe.label;
		        var thumb = myObj.hits[i].recipe.image;
		        var url = myObj.hits[i].recipe.url;
		        var content = "<div class=\"column is-one-third\"><div clas=\"card\"><div class=\"card-image\"><figure class=\"image is-4by3\"><img src=\""+ thumb +"\"/></figure></div><div class=\"card-content\"><div class=\"content\"><h4>"+ label +"</h4></div><footer class=\"card-footer\"><p class=\"card-footer-item\"><span><a href=\""+url+"\" target=\"_blank\">Read Recipe</a></span></p></footer></div></div></div>";
		        var results = results + content;
	        }
	        
	        document.getElementById("results").innerHTML = "<div class=\"container\"><div class=\"columns is-multiline is-2\">"+results+"</div></div>";
	    }
	};
	xmlhttp.open("GET", "https://api.edamam.com/search?q=<?php echo $querystring;?>&from=0&to=10", true);
	xmlhttp.send();

	</script>
</body>
</html>