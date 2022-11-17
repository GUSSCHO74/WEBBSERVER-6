<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "users";
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM users";
	$result = $conn->query($sql);

	$login_success = false;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]){
				$login_success = true;
			}
		}
	} 
	else {
		echo "0 results";
	}
	$conn->close();

	echo `<form action="logout.php" method="post">
	<input type="submit" name="logout" value="Logout" />
	</form>`;


	if($login_success) {
		session_start();
		$_SESSION["username"] = $_POST["username"];
		echo "Lyckad inloggning!</br></br>";
		echo "<b>Du är inloggad som " . $_SESSION["username"] . "</b>";
	}
	else {
		echo "Inloggningen misslyckades!</br></br>";  
		echo "<b>Du är inte inloggad.</br>"; 
	}

	if($login_success == true ){
		$_SESSION["validateToken"] = true;
		echo'
		<form action="upload.php" method="post" enctype="multipart/form-data">
		</br>Välj en fil:</br></br>
		<input type="file" name="fileToUpload" id="fileToUpload" /></br></br>
		<input type="submit" value="Ladda upp" name="submit" />
		</form>';
	}

?>
<br><br>
<a href="uppgift6.html">Tillbaka</a>