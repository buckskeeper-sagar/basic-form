<?php

	if(isset($_GET["id"])) {
    	$id = $_GET["id"];

    	$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "contactDB";

		$connection = new mysqli($servername, $username, $password, $database);

    	$sql = "DELETE FROM contacts WHERE id = $id";

    	$connection->query($sql);
	}

	header("location: /basic-form/index.php");
	exit;

?>