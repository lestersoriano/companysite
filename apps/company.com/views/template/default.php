<?php

// Sanity check, install should only be checked from index.php
defined('SYSPATH') or exit('Install tests must be loaded from within index.php!');

if (version_compare(PHP_VERSION, '5.3', '<'))
{
	// Clear out the cache to prevent errors. This typically happens on Windows/FastCGI.
	clearstatcache();
}
else
{
	// Clearing the realpath() cache is only possible PHP 5.3+
	clearstatcache(TRUE);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Company |Your Feed </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="http://company-site.s3.amazonaws.com/site-assets/css/bootstrap.css" rel="stylesheet">
    <link href="http://company-site.s3.amazonaws.com/site-assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="http://company-site.s3.amazonaws.com/site-assets/css/scaffolding.css" rel="stylesheet">
    <link href="http://company-site.s3.amazonaws.com/site-assets/css/design.css" rel="stylesheet">

    <link href="http://company-site.s3.amazonaws.com/site-assets/css/flexslider.css" rel="stylesheet">

	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://company-site.s3.amazonaws.com/site-assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://company-site.s3.amazonaws.com/site-assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://company-site.s3.amazonaws.com/site-assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://company-site.s3.amazonaws.com/site-assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://company-site.s3.amazonaws.com/site-assets/ico/apple-touch-icon-57-precomposed.png">

  </head>
<body class="<?php echo !empty($body_class) ? $body_class : ""?>">

<?php echo $header?>

<div class="container-fluid <?php echo !empty($page) ? $page : ""?>">
	<?php echo $body?>
	
	 <footer class="footer">
      	<?php echo $footer?>
	 </footer>
	
 </div>
 <!-- /container -->


 	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="http://company-site.s3.amazonaws.com/site-assets/js/jquery.js"></script>
    <script src="http://company-site.s3.amazonaws.com/site-assets/js/jquery.pageslide.js"></script>
    <script src="http://company-site.s3.amazonaws.com/site-assets/js/bootstrap-transition.js"></script>
    <script src="http://company-site.s3.amazonaws.com/site-assets/js/bootstrap-alert.js"></script>
    <script src="http://company-site.s3.amazonaws.com/site-assets/js/bootstrap-dropdown.js"></script>
    <script src="http://company-site.s3.amazonaws.com/site-assets/js/bootstrap-button.js"></script>
    <script src="http://company-site.s3.amazonaws.com/site-assets/js/jquery.flexslider.js"></script>
    <script src="http://company-site.s3.amazonaws.com/site-assets/js/waypoints.js"></script>
    <script src="http://company-site.s3.amazonaws.com/site-assets/js/application.js"></script>

</body>
</html>