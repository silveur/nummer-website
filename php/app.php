<?php
	$home = getenv("HOME");
	$phpRoot = $_SERVER['DOCUMENT_ROOT'];
	$settings = file_get_contents($home . '/settings.json', true);
	$settings = json_decode($settings);

	if( $_SERVER['SERVER_NAME'] == 'localhost' )
		$settings = $settings->local;
	else
		$settings = $settings->production;

	$con = mysqli_connect( "localhost", $settings->mysql->user, $settings->mysql->password, "NummerWebsite" );

	function query( $query )
	{
		global $con;
		$result = mysqli_query( $con, $query );
		$array = $result->fetch_array(MYSQLI_ASSOC);
		// $result = mysqli_fetch_array( $result );
		return $array;
	}
?>