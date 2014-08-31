<?php

/**
 * Link Manager
 *
 * A simple script to manage the display, adding, validating and tracking of links
 *
 * You need to add a mod_rewrite rule something like this:
 *	RewriteRule ^links/actions/(.*)$ /links/index.php?a=$1 [QSA,L]
 *
 * @author Dan Pupius <http://pupius.co.uk>
 * @version 1.0
 * @copyright ©2004 Daniel Pupius
 * @filesource
 */

// Base path to these scripts etc
$GLOBALS['base_path'] = "/usr/home/sites/www.13thparallel.org/web/links/";
$GLOBALS['base_url'] = "http://13thparallel.org/links/";

// Add support classes, and functions
require($GLOBALS['base_path'] . "class_db.php");
require($GLOBALS['base_path'] . "class_template.php");

require($GLOBALS['base_path'] . "func_getLinksByCategory.php");
require($GLOBALS['base_path'] . "func_getLinksByAlpha.php");

require($GLOBALS['base_path'] . "func_redirectToLinkURL.php");

require($GLOBALS['base_path'] . "config.php");



//decode the action information
$params = explode("/",ltrim($_GET["a"],"/"));
$action = strtolower(array_shift($params));	//remove action from parameters



//handle the actions
switch($action) {

	case "verify":		//verify link, try to get title, and show form to get more details
		echo "<pre>";
		print_r($_POST);
		exit;

		break;

	case "add":		//actually add the link to the database

		break;



	case "go":		//redirect to a link
		$url = implode("/",$params);
		redirectToLinkURL($url);
		break;


	case "unknown":		//show an error for unknown redirect URL
		$url = implode("/",$params);
		$e = new Template('error-unknown');
		$e->set_value('url',$url);
		$content = $e->render();
		break;

	case "inactive":	//show an error for a page that is inactive
		$url = implode("/",$params);
		$e = new Template('error-inactive');
		$e->set_value('url',$url);
		$content = $e->render();
		break;


	case "by-alpha":	//show links alphanumerically
		$content = getLinksByAlpha();

		break;

	case "by-category":	//show  categorised links list
	default:	
		$content = getLinksByCategory();

		break;
		
}



?>
<h1>Links</h1>
<?= $content; ?>