<?php 
global $global;
require_once('controllers/controllers.php');
initialize_controllers();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>AndEngine + Web</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link
	href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700,900"
	rel="stylesheet" />
<script src="js/jquery.js"></script>
<script
	src="css/5grid/init.js?use=mobile,desktop,1000px&amp;mobileUI=1&amp;mobileUI.theme=none&amp;mobileUI.titleBarHeight=0"></script>
<script src="js/jquery.dropotron-1.2.js"></script>
<script src="js/init.js"></script>
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.js"></script>
<script type="text/javascript" src="js/andengine_plus_web.js"></script>
<noscript>
	<link rel="stylesheet" href="css/5grid/core.css" />
	<link rel="stylesheet" href="css/5grid/core-desktop.css" />
	<link rel="stylesheet" href="css/5grid/core-1200px.css" />
	<link rel="stylesheet" href="css/5grid/core-noscript.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/style-desktop.css" />
</noscript>
<link rel="stylesheet" type="text/css"
	href="css/ui-darkness/jquery-ui-1.10.1.custom.css" />
<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
<script type="text/javascript">
	//Form upload function
	//<div id="draggable-//echo rand(); " class="ui-widget-content">
 $(document).ready(function() {
	//load JQuery UI draggables
	$(".draggable").draggable();
	initializeDroppable();
	$('#resource_upload')
			.ajaxForm(
					{
						beforeSubmit : function() {
							$('#results').html(
									'Uploading...');
						},
						success : function(data) {
							var $out = $('#results');
							$out.html('<img id="img-<?php echo $global['resource_manager']->generate_resourceid() ?>" class="draggable" src="'+ data
											+ '" alt="myImage" / ></div>');
							//Function for draggables 
							$(function() {
								$(".draggable").draggable({snap:".screen"});
							});
						}
					});
 });
</script>
</head>
<body class="right-sidebar">

	<!-- Header Wrapper -->
	<div id="header-wrapper" class="wrapper">
		<div class="5grid-layout">
			<div class="row">
				<div class="12u">

					<!-- Header -->
					<div id="header">

						<!-- Logo -->
						<div id="logo">
							<h1>
								<a href="#" class="mobileUI-site-name">AndEngine + Web</a>
							</h1>
							<span class="byline">The easiest way to build AndEngine games!</span>
						</div>
						<!-- /Logo -->

						<!-- Nav -->
						<nav id="nav" class="mobileUI-site-nav">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li class="current_page_item"><a href="index.php">Game Dev View</a>
								</li>
								
							</ul>
						</nav>
						<!-- /Nav -->

					</div>
					<!-- /Header -->

				</div>
			</div>
		</div>
	</div>
	<!-- /Header Wrapper -->

	<!-- Main Wrapper -->
	<div class="wrapper wrapper-style2">
		<div class="title">Game Dev View</div>
		<div class="5grid-layout">
			<div class="row">
				<div class="12u">

					<!-- Main -->
					<div id="main">
						<div class="5grid">
							<div class="row">
								<div class="8u mobileUI-main-content">

									<!-- Content -->
									<div id="content">
										<article class="is is-post">
											<!-- <header class="style1">
											</header>-->
											<div class="screen" style="width: 364px; height: 640px"></div>

										</article>
										<div class="5grid">
											<div class="row">
												<div class="6u">
													<section class="is is-pair-one"></section>
												</div>
												<div class="6u">
													<section class="is is-pair-two"></section>
												</div>
											</div>
										</div>
									</div>
									<!-- /Content -->

								</div>
								<div class="4u">

									<!-- Sidebar -->
									<div id="sidebar">
										<section class="is">
											<header>
												<h3>Resources</h3>
												<form id="resource_upload"
													action="controllers/httprouter.php?function=resource_upload"
													method="post" enctype="multipart/form-data">
													<div class="form_settings">
														<input type="file" name="resourceFile"> <input
															class="submit" type="submit" name="file_uploaded"
															value="Upload" />
													</div>
												</form>
												<div id="results" class="results"></div>
												<div id="resource_view" class="resource_view">
													<?php $global['resource_manager']->serve_resources() ?>
												</div>
										
										</section>
										<section class="is">
											<header>
												<h2>Behaviors</h2>
											</header>


										</section>
										<section class="is">
											<header>
												<h2>Save Your Progress</h2>
											</header>
											<a href="#" class="button button-style1" onclick="javascript:saveSpritePosition();">Save</a>
										</section>
                                        <section class="is">
                                            <header>
                                                <h2>Build and Download APK</h2>
                                            </header>
                                            <a href="#" class="button button-style1" onclick="">Build</a>
                                        </section>
									</div>
									<!-- /Sidebar -->

								</div>
							</div>
						</div>
					</div>
					<!-- /Main -->

				</div>
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->


	<!-- Footer Wrapper -->
	<div id="footer-wrapper" class="wrapper">
		<div class="title">What is AndEngine + Web?</div>
		<div class="5grid-layout">
			<div class="row">
				<div class="12u">

					<!-- Footer -->
					<div id="footer">
						<header class="style1">
							
							<p class="byline">
								 'AndEngine + Web' is conceived as a web interface provided to develop AndEngine 
								 games in a simple drag-and-drop manner, removing the need to install bulky SDKs, 
								 learn complex programming concepts, or familiarization with the AndEngine framework. 
								 It aims to provide the power of AndEngine without the trouble of learning a large 
								 amount of extra concepts, and allows developers to focus on creating games rather 
								 than on how to create them.
							</p>
						</header>
						<hr />
						<div class="5grid">
							<div class="row">
								<div class="6u">

									<!-- Contact Form -->
									<section class="footer-one">
										<form method="post" action="#">
											<div class="5grid">
												<div class="row">
													<div class="6u">
														<input type="text" class="text" name="name"
															id="contact-name" placeholder="Name" />
													</div>
													<div class="6u">
														<input type="text" class="text" name="name"
															id="contact-email" placeholder="Email" />
													</div>
												</div>
												<div class="row">
													<div class="12u">
														<textarea name="message" id="contact-message"
															placeholder="Message"></textarea>
													</div>
												</div>
												<div class="row">
													<div class="12u">
														<ul class="actions">
															<li><input type="submit" class="button button-style1"
																value="Send" /></li>
															<li><input type="reset" class="button button-style2"
																value="Reset" /></li>
														</ul>
													</div>
												</div>
											</div>
										</form>
									</section>
									<!-- /Contact Form -->

								</div>
								<div class="6u">

									<!-- Contacts -->
									<section class="footer-two">
										<div class="feature-list feature-list-small">
											<div class="5grid">
												<div class="row">
													<div class="6u">
														<section>
															<h3 class="icon icon-home">Mailing Address</h3>
															<p>
																Faculty of Information Technology, University of Moratuwa,
																Katubedda, Moratuwa.
															</p>
														</section>
													</div>
													<div class="6u">
														<section>
															<h3 class="icon icon-comment">Social</h3>
															<p>
																<a href="http://twitter.com/rami_desh">@rami_desh</a><br />
																<a href="http://rdeshapriya.com">http://rdeshapriya.com</a><br />
																<a href="http://facebook.com/rdeshapriya">http://facebook.com/rdeshapriya</a><br />
															</p>
														</section>
													</div>
												</div>
												<div class="row">
													<div class="6u">
														<section>
															<h3 class="icon icon-envelope">Email</h3>
															<p>
																<a href="mailto:rasade88@gmail.com">rasade88@gmail.com</a>
															</p>
														</section>
													</div>
							
												</div>
											</div>
										</div>
									</section>
									<!-- /Contacts -->

								</div>
							</div>
						</div>
						<hr />
					</div>
					<!-- /Footer -->

					<!-- Copyright -->
					<div id="copyright">
						<span> &copy; AndEngine + Web </a>. Design by <a
							href="http://rdeshapriya.com/">Ramindu Deshapriya</a>.
						</span>
					</div>
					<!-- /Copyright -->

				</div>
			</div>
		</div>
	</div>
	<!-- /Footer Wrapper -->

</body>
</html>

<?php 
function initialize_controllers() {
	global $global;
	$global['resource_manager'] = new ResourceManager();
	$global['db'] = DatabaseManager::getInstance();
	$global['logger'] = new Logger();
	$global['user_action'] = new UserController();
}
?>
