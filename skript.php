<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "webbserverprogrammering";
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM users";
	$result = $conn->query($sql);	

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]){
				header("Location: checklogin.php");
			}
			else {
				echo "<h1>Inloggningen misslyckades!</h1><p>Fel kombination av användarnamn och lösenord!</p>";	
				echo "<br><br><a href='uppgift5.html'>Tillbaka</a>";
			}
		}
	} 
	$conn->close();
?>
</body>
</html>