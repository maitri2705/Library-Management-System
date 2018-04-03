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
                margin: 200px;
                text-align: center;
                padding: 20px;
                width: 500px;
                
            }
        </style>
    </head>
    <body>
        <center>
    	<div id="menu">
    		<?php
    		include("Connection.php");  
    		//echo $_GET["cardId"];  
    		$card_id=$_GET["cardId"];
    		$sql="select * from book_loans where Card_id like '$card_id' and date_in is null";
    		$result =$conn->query($sql); 
			if ($result->num_rows > 2) 
			{ 
    		?>
	    		<h3> Oops..!! The borrower has already borrowed 3 books..!!</h3>
    			<div class="but">
                    <a href="MainPage.html">Back to Main Page</a>
                </div> 
    		<?php
    		}
    		else{
    			?>
    			<form action="MainPage.html">
	    			
	    		<?php
	    			session_start();
    				$isbn=$_SESSION["ISBN"];

	    		//	$sql="select * from book_loans where card_id=$cardId and date_in like '';";
    				$sql="insert into book_loans (isbn,card_id,date_out,due_date) values 
    				('$isbn','$card_id',current_date(),date_add(current_date(), INTERVAL 14 day))";
    					if ($conn->query($sql)) {
    				?>

    						<h3> The book has been successfully issued..!!</h3>
    			<?php
    					}
    			?>
	    			<input type="submit" value="Back To Main Page" style="no-border"/>
	    		</form>
              <?php
          	}?>
    	</div>
        </center>
    </body>
</html>