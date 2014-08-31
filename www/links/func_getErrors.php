<?php

function getErrorInactiveLink() {
	$str = '<p class="author">Inactive Link</p>';
	$str.= '<p>Sorry, we did a check on the link and it appears that the site is currently inactive.</p>';

	return $str;
}

function getErrorUnknownLink() {
	$str = '<p class="author">Unknown Link</p>';
	$str.= '<p>Sorry, the URL we tried to link to couldn\'t be found in the database.</p>';

	return $str;
}

?>