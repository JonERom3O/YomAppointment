<?PHP
	$database_host 		= '172.19.11.243';
	$database_username 	= 'yom';
	$database_password 	= '10678';
	$database_name 		= 'hos';
	
	$mysqli = new mysqli($database_host, $database_username, $database_password, $database_name);
	$mysqli->set_charset("utf8");

?>	
