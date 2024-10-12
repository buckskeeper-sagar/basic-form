<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "contactDB";

	$connection = new mysqli($servername, $username, $password, $database);

	$name = "";
	$address = "";
	$phone = "";
	$email = "";
	$notes = "";
	
	$errorMsg = "";
	$successMsg = "";
	
	if( $_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = $_POST["name"];
		$address = $_POST["address"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$notes = $_POST["notes"];
		
		do {
			if( empty($name) || empty($address) || empty($phone) || empty($email) || empty($notes)) {
				$errorMsg = "All fields are required.";
				break;
			}	
		

			$sql = "INSERT INTO contacts (name, address, phone, email, notes) VALUES ('$name', '$address', '$phone', '$email', '$notes')";
			$result = $connection->query($sql);

			if(!$result) {
				$errorMsg = "Invalid query: ".$connection->error;
				break;
			}

		
			$name = "";
			$address = "";
			$phone = "";
			$email = "";
			$notes = "";
		
			$successMsg = "Contact added successfully.";

			header("location: /basic-form/index.php");
			exit;

		} while(false);
	
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Basic Form</title>
	</head>
	<body>
		<div class = "container">
			<h2>New Contact</h2>

			<?php
				if(!empty($errorMsg)) {
					echo $errorMsg;
				}

			?>
			
			<form method = "post">
				<div>
					<label>Name</label>
					<div>
						<input type = "text" name = "name" value = "<?php echo $name; ?>"><br><br>
					</div>
				</div>
				<div>
					<label>Address</label>
					<div>
						<input type = "text" name = "address" value = "<?php echo $address; ?>"><br><br>
					</div>
				</div>
				<div>
					<label>Phone</label>
					<div>
						<input type = "text" name = "phone" value = "<?php echo $phone; ?>"><br><br>
					</div>
				</div>
				<div>
					<label>Email</label>
					<div>
						<input type = "text" name = "email" value = "<?php echo $email; ?>"><br><br>
					</div>
				</div>
				<div>
					<label>Notes</label>
					<div>
						<input type = "text" name = "notes" value = "<?php echo $notes; ?>"><br><br>
					</div>
				</div>
				
				<?php

					if(!empty($successMsg)) {
						echo $successMsg;
					}

				?>


				<div class = "button">
					<button type = "submit">Submit</button>
					<a href = '/basic-form/index.php'>Cancel</a>
				</div>
			</form>
		</div>
	</body>
</html>