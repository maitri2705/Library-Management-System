<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Book Detail</title>
		<link rel="stylesheet" 	type="text/css" href="style.css">
        <script src="jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="script.js" type="text/javascript"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            #menu{
                background-color: rgb(252,252,252);
                margin: 200px;
                text-align: center;
                padding-top: 20px;
                padding-bottom: 20px;
            }
        </style>
	</head>
	<body>
		<center>
		<div id="menu">
		<form>
			<h1> Book Detail</h1>
		<?php
		include("Connection.php");    
		//echo $_GET["isbn"];
		$isbn=$_GET["isbn"];
		session_start();
		$_SESSION['ISBN']=$isbn;
		$sql="select * from book where isbn='$isbn'";
		$result =$conn->query($sql); 
		if ($result->num_rows > 0) 
		{ 
			$row = $result->fetch_assoc();
		?>
			<h4>ISBN10	:</h4><?php echo $row["ISBN"]?>
			<h4>Title 	:</h4><?php echo $row["Title"]?>
			<h4>Authors :</h4>
			<?php
			$sql="select Author_name from authors where Author_id in(select Author_id from book_authors where isbn like '%$isbn%');";
			$result1 =$conn->query($sql);      
			if ($result1->num_rows > 0) 
			{ 
			?>
			<ul style="list-style-type:none;">
				<?php
				while($row1 = $result1->fetch_assoc())
				{
				?>
					<li><?php echo $row1["Author_name"]?></li>
				<?php
				}
				?>
			</ul>
			<?php
				}
			?>
			<!-- <input type="label" name="isbn" value="<?php echo $isbn?>" hidden/>
			<input class="submit" type="submit" value="Issue the book" /> -->
			<div class="but">
                    <a href="BookIssue.php">Issue</a>
                </div>
			<?php
				}
			?>
		</form>
	</div>
	</center>
	</body>
</html>