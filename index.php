<!DOCTYPE HTML>
<html>
	<head>
		<title>Basic Form</title>
	</head>
	<body>
		<div class = "container">
			<h2>Contacts</h2>
			<a href = '/basic-form/create.php'>New Contact</a>
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>NAME</th>
						<th>ADDRESS</th>
						<th>PHONE</th>
						<th>EMAIL</th>
						<th>NOTES</th>
						<th>CREATED AT</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "";
						$database = "contactDB";
					
					
						$connection = new mysqli($servername, $username, $password, $database);
					
					
						if($connection->connect_error) {
							die("Connection failed: ".$connection->connect_error);
						}
					
					
						$sql = "SELECT * from contacts";
						$result = $connection->query($sql);
					
						if(!$result) {
							die("Invalid query: ".$connection->error);
						}
					
						while($row = $result->fetch_assoc()) {
							echo "
							<tr>
								<td>$row[id].</td>
								<td>$row[name]</td>
								<td>$row[address]</td>
								<td>$row[phone]</td>
								<td>$row[email]</td>
								<td>$row[notes]</td>
								<td>$row[created_at]</td>
								<td>
									<a href = '/basic-form/edit.php?id=$row[id]'>Edit</a>
									<a href = '/basic-form/delete.php?id=$row[id]'>Delete</a>
								</td>
							</tr>
							";
						}
					?>
					
				</tbody>
			</table>
		</div>
	</body>
</html>