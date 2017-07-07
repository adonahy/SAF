<?php
    //$con = mysql_connect("sql200.eshost.com.ar","eshos_19125861","sanjose1234");
    $con = mysql_connect("localhost","root","");

	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db("SAF", $con);
    //mysql_select_db("eshos_19125861_aca", $con);

    $errors = array();
?>
