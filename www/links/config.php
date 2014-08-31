<?php

//database settings
$db_host = "localhost";
$db_database = "dpupius";
$db_user = "dpupius";
$db_password = "jchy65!";

/**
 * Extends the database class to create a database connection specific for this site
 *
 * @author Dan Pupius <dan.pupius@actelearning.com>
 * @version 1.0
 * @copyright ©2004 Act e-learning
 */
class DBp extends DB {
	function DBp() {
		parent::DB($GLOBALS["db_host"],$GLOBALS["db_database"],$GLOBALS["db_user"],$GLOBALS["db_password"]);
	}
}

?>