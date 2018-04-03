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
                $sql="update fines set Paid=1 where Loan_id=".$loan;
                $result =$conn->query($sql); 
                if ($result) {
                        ?>
                        <h4> Fines paid..!</h4>
                        <?php
                        $link="CheckInDone.php?id=".$loan;
                        ?>
                        <div class="but">
                            <a href="<?php echo $link?>">CheckIn</a>
                        </div>
                        <?php
                    }
                 
                ?>
            </div>
        </center>
    </body>
</html>