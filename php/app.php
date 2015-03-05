<?php
	$os = PHP_OS;
	if ($os == "Darwin")
	{
		$home = getenv("HOME");
		$settings = file_get_contents($home . '/settings.json', true);
		$settings = json_decode($settings);
		$settings = $settings->local;
	}
	else
	{
		$home = 'home/silveur';
		$settings = file_get_contents($home . '/settings.json', true);
		$settings = json_decode($settings);
		$settings = $settings->production;
	}

	$con = mysqli_connect( "localhost", $settings->mysql->user, $settings->mysql->password, "NummerWebsite" );

	function query( $query )
	{
		global $con;
		$result = mysqli_query( $con, $query );
		//$array = $result->fetch_array(MYSQLI_ASSOC);
		$result = mysqli_fetch_array( $result );
		return $result;
	}
?>