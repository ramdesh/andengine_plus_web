<?php session_start(); 
include_once 'controllers/controllers.php';
?>
<!DOCTYPE HTML>
<html>

<head>
<title>AndEngine+Web</title>
<meta name="description"
	content="AndEngine + Web is the easiest way to make AndEngine games!" />
<meta name="keywords"
	content="andengine, android, android games, 2d games" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css"
	href="css/ui-darkness/jquery-ui-1.10.1.custom.css" />
<!-- modernizr enables HTML5 elements and feature detects -->
<script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.js"></script>
<script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
<script type="text/javascript" src="js/jquery.sooperfish.js"></script>
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript">
	//Form upload function
	//<div id="draggable-//echo rand(); " class="ui-widget-content">
  $(document).ready(function()
		  {   		
	  				//load sooperfish menu
				  $('ul.sf-menu').sooperfish();
				  //load JQuery UI draggables
			      $(".draggable" ).draggable();
		          $('#resource_upload').ajaxForm({
		          beforeSubmit: function() {
		              $('#results').html('Uploading...');
		          },
		          success: function(data) {
		              var $out = $('#results');
		              $out.html('<div><pre>'+data+'</pre></div>');
		              $out.append('<img id="img-<?php echo rand(); ?>" class="draggable" src="'+ data +'" / ></div>');
		              //Function for draggables 
		              $(function() {
		            	    $( ".draggable" ).draggable();
		            	  });
		          }
		      });
		  });
 
		  	
  </script>
</head>

<body>
	<div id="main">
		<header>
			<div id="logo">
				<div id="logo_text">
					<!-- class="logo_colour", allows you to change the colour of the text -->
					<h1>
						<a href="index.php">AndEngine<span class="logo_colour">+Web</span>
						</a>
					</h1>
					<h2>The easiest way to build AndEngine games</h2>
				</div>
			</div>
			<nav>
				<div id="menu_container">
					<ul class="sf-menu" id="nav">
						<li><a href="index.html">Home</a></li>
						<li><a href="contact.php">Contact Us</a></li>
					</ul>
				</div>
			</nav>
		</header>
		<div id="site_content">
			<div id="sidebar_container">
				<div class="sidebar">
					<h3>Resources</h3>
					<form id="resource_upload" action="controllers/resource_upload.php"
						method="post" enctype="multipart/form-data">
						<div class="form_settings">
							<input type="file" name="resourceFile"> <input class="submit"
								type="submit" name="file_uploaded" value="Upload" />
						</div>
					</form>
					<div id="results" class="results"></div>
					<div id="resource_view" class="resource_view"></div>
				</div>
				<div class="sidebar">
					<h3>Behaviors</h3>

				</div>
			</div>
			<div class="content">
				<div class="screen" style="width: 364px; height: 640px"></div>
			</div>
		</div>
		<footer>
			<p>
				Copyright &copy; AndEngine+Web | <a href="http://rdeshapriya.com">design
					from rdeshapriya.com</a>
			</p>
		</footer>
	</div>
	<p>&nbsp;</p>
</body>
</html>
