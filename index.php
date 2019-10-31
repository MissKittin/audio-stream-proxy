<?php 
	// PHP audio stream proxy
	// 26.08.2019
	// dyndns disable switch 31.10.2019

	error_reporting(E_ERROR | E_PARSE); //disable warnings

	// Settings
	$ip='' // not used if dyndns is disabled
	$port=YOUR_SERVER_PORT; //server port
	$username='YOUR_USERNAME'; //server login
	$password='YOUR_PASSWORD'; //server password
	$dyndns_server_data='PATH_TO_DYNDNS/ip.txt';

	if($dyndns_enable)
		if(!$ip=file_get_contents($dyndns_server_data))
		{ //something is wrong in config
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Error</title>
		<meta charset="utf-8">
		<style type="text/css">
			body {
				background-color: #000;
				color: #fff;
			}
		</style>
	</head>
	<body>
		<h1>Server address not found</h1>
	</body>
</html>
<?php
		exit();
	}

	$file='http://' . $username . ':' . $password . '@' . $ip . ':' . $port . '/stream.mp3';
	if(!$head=array_change_key_case(get_headers($file, TRUE)))
	{ //something is wrong with client
		?>
<!DOCTYPE html>
<html>
	<head>
		<title>Error</title>
		<meta charset="utf-8">
		<style type="text/css">
			body {
				background-color: #000;
				color: #fff;
			}
		</style>
	</head>
	<body>
		<h1>Server is down. Sorry ¯\_(ツ)_/¯</h1>
	</body>
</html>
<?php
			exit();
		}

	$size=$head['content-length']; // because filesize() won't work remotely
	header('Content-Type: audio/mpeg');
	header('Accept-Ranges: bytes');
	header('Content-Disposition: inline');
	//header('Content-Length:'.$size);

	readfile($file);
	exit();
?>
