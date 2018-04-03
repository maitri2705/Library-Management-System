<html>
 <body>
 	<?php
            
$servername = "localhost";
$username = "root";
$password = "Maitri2705@";
$dbname = "library_management";
// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname); // Checkconnection 
if ($conn -> connect_error)  
{      
    die("Connection failed: " . $conn->connect_error);
}       
?>
</body>
</html>