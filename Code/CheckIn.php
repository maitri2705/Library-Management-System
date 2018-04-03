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
    		$isbn=$_GET["isbn"];
            $card_no=$_GET["cno"];
            $name=$_GET["boroname"];
            if(!strcmp($isbn, "") && strcmp($card_no, "")){
                $sql="select Card_id from book_loans where Isbn like '$isbn' and Date_in is null;";
                $result =$conn->query($sql); 
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $card_no=$row["Card_id"];
                }
            }
            if(strcmp($card_no,"")>0){
                $found=false;
                $sql3="select b.Loan_id,Isbn,Fine_amt from book_loans as b join fines as f on b.Loan_id=f.Loan_id
                 where Card_id like '$card_no' and paid=0 and Date_in is null;";
                $result3=$conn->query($sql3);
                if ($result3->num_rows >0) {
                    $found=True;
                    ?>
                    <table border="1">
                    <tr>
                        <th>ISBN</th>
                        <th>Fine</th>
                    </tr> 
                <?php
                    while ($row3 = $result3->fetch_assoc()) {
                      ?>
                    <tr>
                        <td><?php echo $row3["Isbn"]."<br>"?></td>
                        <td><?php echo $row3["Fine_amt"]."<br>"?></td>
                        <?php
                        $link="PayFine.php?id=".$row3["Loan_id"];
                        ?>
                        <td> <a href="<?php echo $link?>">Pay Fine</a></td>
                    </tr>
                      <?php  
                    }?>
                </table>
                <?php
                }
                $sql="select Loan_id,Isbn from book_loans where Loan_id not in (select loan_id from fines where paid=0) and 
                Card_id like '$card_no' and Date_in is null;";
                $result3=$conn->query($sql);
                if ($result3->num_rows >0) {
                    $found=True;
                    ?>
                    <br>
                    <br>
                    <table border="1">
                    <tr>
                        <th>ISBN</th>
                    </tr> 
                <?php
                    while ($row1 = $result3->fetch_assoc()) {
                      ?>
                    <tr>
                        <td><?php echo $row1["Isbn"]."<br>"?></td>
                        <?php
                        $link="CheckInDone.php?id=".$row1["Loan_id"];
                        ?>
                        <td> <a href="<?php echo $link?>">CheckIn</a></td>
                    </tr>
                      <?php  
                    }?>
                </table>
                <?php
                }
                if(!$found){
                    echo "<h3>No Books are Checked_Out on this Id!!</h3>";   
                    ?>
                    <div class="but">
                        <a href="MainPage.html">Back to Main Page</a>
                    </div> 
                    <?php
                }
            }
            if(empty($isbn) && empty($card_no) && !empty($name)){
                $sql1="select Card_id,First_name,Last_name from borrowers where First_name like '%$name%' or Last_name like '%$name%'";
               // echo $sql1;
                $result1 =$conn->query($sql1); 
                if ($result1->num_rows > 0) {
                    ?>
                    <table border="1">
                    <tr>
                        <th>Card_id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th></th>
                    </tr> 
                <?php
                    while ($row1 = $result1->fetch_assoc()) {
                      ?>
                    <tr>
                        <td><?php echo $row1["Card_id"]."<br>"?></td>
                        <td><?php echo $row1["First_name"]."<br>"?></td>
                        <td><?php echo $row1["Last_name"]."<br>";?></td>
                        <?php
                        $isbn="";
                        $name="";
                        $link="CheckIn.php?isbn=".$isbn."&cno=".$row1['Card_id']."&boroname=".$name;
                        ?>
                        <td> <a href="<?php echo $link?>">GetId</a></td>
                    </tr>
                      <?php  
                    }?>
                </table>
                <?php
                }
            }
            ?>
            </div>
        </center>
    </body>
</html>