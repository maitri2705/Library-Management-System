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
            $sql="select bl.ISBN, bl.Card_id, b.First_name, b.Last_name, sum(f.fine_amt) as fine from book_loans as bl, fines as f, Borrowers as b 
            where bl.Loan_id=f.Loan_id and f.paid=0 and bl.Card_id= b.card_id and bl.Date_in is NULL group by bl.Card_id";
            $show_fine_result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($show_fine_result) == 0){
                echo "No fines are due<br>";
            } 
            else
            {
                ?>
                <table>
                    <tr>
                        <th>CardID</th>
                        <th>Name</th>
                        <th>Fine Amount</th>
                    </tr>
                <?php
                for ( $i = 0 ; $i < mysqli_num_rows($show_fine_result) ; $i++ )
                {
                    $row = mysqli_fetch_assoc($show_fine_result);
                    echo "<tr>";
                     echo "<td>".$row['Card_id'] ."</td> ";
                    echo "<td>".$row['First_name'] ." ".$row['Last_name']."</td> ";
                    echo "<td>".$row['fine'] ."</td> ";
                    echo "</tr>";
                 }
                 ?>
             </table><br><br>
             <div class="but">
                    <a href="MainPage.html">Back to Main Page</a>
                </div> 
                 <?php
            }
            ?>
        </div>
        </center>
    </body>
</html>