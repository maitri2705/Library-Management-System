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
                
                $loan=$_GET['id'];
                $sql="update book_loans set Date_in=current_date() where Loan_id=".$loan.";";
                //echo $sql;
                $result =$conn->query($sql); 
               // if ($result->num_rows > 0) {
                    echo "<h3> Book is Checked In..!!";
                    ?>
                    <br>
                    <br>
                    <div class="but">
                        <a href="MainPage.html">Back to Main Page</a>
                    </div> 
                        <?php
                  //  }
                 
                ?>
            </div>
        </center>
    </body>
</html>