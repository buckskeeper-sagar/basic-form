<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "contactDB";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$address = "";
$phone = "";
$email = "";
$notes = "";

$errorMsg = "";
$successMsg = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET["id"])) {
        header("location: /basic-form/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM contacts WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row) {
        header("location: /basic-form/index.php");
        exit;
    }

    $name = $row["name"];
    $address = $row["address"];
    $phone = $row["phone"];
    $email = $row["email"];
    $notes = $row["notes"];
}
else {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $notes = $_POST["notes"];

    do {
        if( empty($id) || empty($name) || empty($address) || empty($phone) || empty($email) || empty($notes)) {
            $errorMsg = "All the fields are required.";
            break;
        }

        $sql = "UPDATE contacts SET name = '$name', address = '$address', phone = '$phone', email = '$email', notes = '$notes' WHERE id = $id";

        $result = $connection->query($sql);
        if(!$result) {
            $errorMsg = "Invalid query: ".$commection->error;
            break;
        }

        $successMsg = "Client updated successfully.";
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
			<h2>Edit Contact</h2>

			<?php
				if(!empty($errorMsg)) {
					echo $errorMsg;
				}

			?>
			
			<form method = "post">
                <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
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