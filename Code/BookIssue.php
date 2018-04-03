<!DOCTYPE html>
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Search Result</title>
        <link rel="stylesheet" 	type="text/css" href="style.css">
        <script src="jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="script.js" type="text/javascript"></script>
        <style type="text/css">
            #menu{
                background-color: rgb(252,252,252);
                margin-top: 200px;
                text-align: center;
                padding-top: 20px;
                padding-bottom: 20px;
                width: 500px;
            }
        </style>
    </head>
    <body>
        <center>
    	<div id="menu">
    		<?php
    		include("Connection.php");    
    		session_start();
    		$isbn=$_SESSION["ISBN"];
    		$sql="select * from book_loans where isbn like '$isbn' and date_in is null;";
    		$result =$conn->query($sql); 
			if ($result->num_rows > 0) 
			{ 
    		?>
	    		<h3> Oops..!! Book not available</h3>
    			<div class="but">
                    <a href="MainPage.html">Back to Main Page</a>
                </div> 
    		<?php
    		}
    		else{
    			?>
    			<form action="CheckOnCard.php">
	    			<h3> Book Available... Enter card no and issue it</h3>
	    			<input type="text" name="cardId"/>
	    			<input type="submit" value="Issue" style="no-border"/>
	    		</form>
              <?php
          	}?>
    	</div>
        </center>
    </body>
</html>