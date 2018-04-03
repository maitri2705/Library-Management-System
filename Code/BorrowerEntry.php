<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Entry Result</title>
        <link rel="stylesheet" 	type="text/css" href="style.css">
        <script src="jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="script.js" type="text/javascript"></script>
        <style type="text/css">
            #menu{
                background-color: rgb(252,252,252);
                margin: 200px;
                width: 500px;
                text-align: center;
                padding: 20px;
            }
        </style>
    </head>
    <body>
    	<center>
    	<div id="menu">
    	
			
	<?php
		include("Connection.php");    
		$ssn=$_GET['ssn'];
		$sql="select * from borrowers where SSN like '$ssn';";
		$result =$conn->query($sql);      
		if ($result->num_rows > 0) 
		{
			echo "The borrower is already registered..!!";
		}
		else{
			$fname=$_GET['fname'];
			$lname=$_GET['lname'];
			$email=$_GET['email'];
			$address=$_GET['address'];
			$city=$_GET['city'];
			$state=$_GET['state'];
			$phone=$_GET['phone'];
			if(!(empty($ssn) && empty($fname) && empty($lname) && empty($email) && empty($address) && empty($city) && empty($state) && empty($phone))){
				$sql1="select count(*) as counts from borrowers;";
				$result1 =$conn->query($sql1); 
                if ($result1->num_rows > 0) {
                    $row1 = $result1->fetch_assoc();
                    $cardnumber=$row1['counts'];
                }
                $cardnumber=$cardnumber+1;
                $formattedNumber = sprintf('%06d', $cardnumber);
				$cardno="ID".$formattedNumber;
				$sql="insert into borrowers values ('$cardno','$ssn','$fname','$lname','$email','$address','$city','$state','$phone');";
				//echo $sql;
				if ($conn->query($sql)) {
					echo "The borrower entry is done..!!";
				}
			}
			else{
				echo "Required fields are empty..!!";
			}
		}
		?>
		<br>
		<br>
		<div class="but">
                    <a href="MainPage.html">Back to Main Page</a>
                </div> 
 			<?php 
 				$conn->close(); ?>
				
			
	</div>
	</center>
	</body> 
</html>