<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM users";

$filename = basename($_FILES["fileToUpload"]["name"]);

function fileDataForUpload($uploadUsername, $uploadFileName ){
    $FileLog = fopen("fileuploadinformation.txt", "a+") or die("Unable to open file!");
    fwrite($FileLog, $uploadUsername.";".$uploadFileName."\n");
    fclose($FileLog);
}

if($_SESSION["validateToken"] == true){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.</br></br>";
        fileDataForUpload($_SESSION["username"], basename($_FILES["fileToUpload"]["name"]));
        if($_SESSION["username"] == "holros"){
            $sql = "INSERT INTO uploads (filename, user, uploadtime, snuskig)
            VALUES ('$filename', '" . $_SESSION["username"] . "', NOW(), TRUE)";
            $conn->query($sql);
        }
        else {
            $sql = "INSERT INTO uploads (filename, user, uploadtime) VALUES ('$filename', '" . $_SESSION["username"] . "', NOW())";
            $result = $conn->query($sql);
        }
    } 
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
    <a href="logout.php">Logga ut</a> 
</body>
</html>