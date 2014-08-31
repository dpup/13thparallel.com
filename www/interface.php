<?php

$old_mapping = array();
$old_mapping["sigslots"] = "sig-slots";
$old_mapping["statistics"] = "who-are-we-designing-for";
$old_mapping["bezier_curves"] = "bezier-curves";
$old_mapping["scrollbars"] = "dhtml-scrollbars";
$old_mapping["portability_one"] = "coding-for-portability1";
$old_mapping["portability_two"] = "coding-for-portability2";
$old_mapping["seperating_structure"] = "seperating-structure";
$old_mapping["maths"] = "maths-and-dhtml";
$old_mapping["rdf"] = "rdf";
$old_mapping["viewport"] = "viewport";
//$old_mapping["api"] = "";
$old_mapping["column_script"] = "column-script";
$old_mapping["margin_fix"] = "margin-fix";
$old_mapping["rss_parser"] = "rss";
$old_mapping["doubleyou"] = "doubleyou";
$old_mapping["multi_interview"] = "multi-interview";
$old_mapping["scott_andrew"] = "";
//$old_mapping["bookmarklets"] = "";
//$old_mapping["splash_pages"] = "";
//$old_mapping["referrers"] = "";


preg_match ( "/title=([a-zA-Z0-9_]*)/", $_SERVER["REQUEST_URI"], $matches );
if($matches && $matches[1] != "" && $old_mapping[$matches[1]] != NULL) {
	header("Location: /archive/" . $old_mapping[$matches[1]] . "/");
	exit;
}


$page = trim($_GET["page"],"/");

if($page == "") { header("Location: /archive/"); exit; }


$file = $page . "/index.htm";
$script = $page . "/index.php";

if(file_exists($file)) {
	if(substr($_GET["page"],-1) != "/") { header("Location: /". $page . "/"); exit; }

	$content = file_get_contents($file);


} else if(file_exists($script)) {

	if(substr($_GET["page"],-1) != "/") { header("location: /". $page . "/"); exit; }

	ob_start();
	include($script);
	$content = ob_get_contents();
	ob_end_clean();

} else {
	$content = '<h1>Page Not Found</h1>';
	$content.= '<p class="author">ERROR 404</p>';
	$content.= '<p>Sorry the page you requested doesn\'t exist.  Try the <a href="/">Home Page</a> and browse from there.</p>';
  $content.= "<p>$file, $script</p>";
	header("HTTP/1.0 404 Not Found");
}

preg_match("/\<h1\>(.*)\<\/h1\>/i", $content, $matches);
$title = str_replace("<h1>","",$matches[0]); 
$title = str_replace("</h1>","",$title) . " &raquo; ";

if(strpos($content,"<!-- NO TEMPLATE -->") > -1) {
	echo $content;
	exit;
} else if(strpos($file, "archive") > -1) $section = 1;
else if(strpos($file, "about") > -1) $section = 2;
else if(strpos($file, "contact") > -1) $section = 3;
else $section = 0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--
  Title:        Thirteenth Parallel (Archive / Temp Site)
  Description:  Interface for the temporary site put up to hold 13th's old content

  Creator:      Dan Pupius <http://pupius.co.uk>
  Date:         2005-01-14
  Rights:       Copyright (c)2002-2005 Daniel Pupius
-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?= $title ?>Thirteenth Parallel</title>
		<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
		<meta name="copyright" content="Copyright (c)2002-2005 Thirteenth Parallel, All Rights Reserved" />
		<link rel="stylesheet" type="text/css" href="/styles/13.css" />
		<script type="text/javascript" src="/js/Toolkit.js"></script>
		<script type="text/javascript" src="/js/Toolkit.Events.js"></script>
		<script type="text/javascript" src="/js/stuff.js"></script>
	</head>
	
	<body>
		<p id="title"><em>Thirteenth Parallel</em></p>

		<div id="menu">
			<ul>
				<li><a href="/archive/"<?= ($section==1)?' class="active"':'' ?>>Archive</a></li>
				<li><a href="/about/"<?= ($section==2)?' class="active"':'' ?>>About</a></li>
				<li><a href="/contact/"<?= ($section==3)?' class="active"':'' ?>>Contact</a></li>
			</ul>
		</div>

		<div id="body">

<?= $content ?>

		</div>

		<div id="footer" class="copyright">Copyright&copy;2001-2005 Thirteenth Parallel<br />All Rights Reserved</div>

	</body>
</html>
