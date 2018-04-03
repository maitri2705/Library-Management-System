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
                $data_query =  "select loan_id as fines_loan_id, datediff(current_date(), bl.Due_date) as due_days from book_loans as bl where datediff(current_date(), bl.Due_date)>0 and Date_in is NULL";
                $data_result = mysqli_query($conn, $data_query);   
                    for ( $i = 0 ; $i < mysqli_num_rows($data_result) ; $i++ )
                    {
                        $row = mysqli_fetch_assoc($data_result);
                        $check_fine_query = "select * from fines where loan_id = '".$row['fines_loan_id']."'";
                        $check_fine_result = mysqli_query($conn, $check_fine_query);
                        $fine_amt = $row['due_days']*0.25;
                        if (mysqli_num_rows($check_fine_result)==0){
                            $insert_fine_query = "insert into fines values(".$row['fines_loan_id'].", ".$fine_amt.", 0)";
                            $insert_fine_result = mysqli_query($conn, $insert_fine_query) or die('Query "' . $insert_fine_query . '" failed: ' . mysqli_error($con));
                        }
                        else{
                            $update_fine_query = "update fines set Fine_amt=".$fine_amt." where paid=0";
                            $update_fine_result = mysqli_query($conn, $update_fine_query) or die('Query "' . $update_fine_query . '" failed: ' . mysqli_error($con));
                        }
                    }   
                
                echo "Page has been refreshed";?>
                <br>
                <br>
                <div class="but">
                        <a href="MainPage.html">Back to Main Page</a>
                    </div> 
            </div>
        </center>
    </body>
</html>