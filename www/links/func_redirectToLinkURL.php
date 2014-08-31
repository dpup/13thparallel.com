<?php

function redirectToLinkURL($url) {
	$db = new DBp();
	$sql = "UPDATE sitelinks SET hits = (hits + 1)  WHERE url='".mysql_escape_string($url)."'";
	$db->query($sql);

	if($db->affected_rows() == 0) {
		header("location: " . $GLOBALS['base_url'] . "actions/unknown/$url");

	} else {
		//test the link
		$str = @file_get_contents("http://$url");
		if($str == false) header("location: " . $GLOBALS['base_url'] . "actions/inactive/$url");
		else header("location: http://$url");
	}

	exit();
} 

?>