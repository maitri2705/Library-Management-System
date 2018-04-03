<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Search Result</title>
        <link rel="stylesheet" 	type="text/css" href="style.css">
        <script src="jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="script.js" type="text/javascript"></script>
        <style type="text/css">
            #menu{
                background-color: rgb(252,252,252);
                margin-top: 20px;
                padding-top: 20px;
                padding-bottom: 20px;
                text-align: center;        		
            }
        </style>
    </head>
    <body>
	<?php
		include("Connection.php");    
		$auth=$_GET["searchres"];
		$isbn=$_GET["searchres"];
		$title=$_GET["searchres"];
		$sql = "select b.ISBN, b.title, group_concat(a.Author_name) as Author_name 
				from book as b, book_authors as ba, authors as a 
				Where b.ISBN=ba.ISBN and ba.Author_id=a.Author_id and 
				(a.Author_name like '%$auth%' or b.isbn like'%$isbn%' or b.Title like '%$title%') group by b.isbn";
		//echo $sql;
		$result =$conn->query($sql);      
		if ($result->num_rows > 0) 
		{       
		?>
		<div id="menu">
		<form id="form3" action="Explore.html">
			<center>
			<table border="1">
				<tr>
					<th colspan="4">
						<input class="submit" type="submit" value="Back to search" />
					</th>
				</tr>
				<tr>
					<th>ISBN</th>
					<th>Book Title</th>
					<th>Author</th>
					<th></th>
				</tr> 
			<?php
			while($row = $result->fetch_assoc())          
			{?>             
				          
				<tr>
					<td><?php echo $row["ISBN"]."<br>"?></td>
					<td><?php echo $row["title"]."<br>"?></td>
        			<td><?php echo $row["Author_name"]."<br>";?></td>
        			<td> <a href="BookDetail.php?isbn=<?php echo $row['ISBN'];?>">Details</a></td>
  				</tr>
       				<?php ;     
     				} 
 				} 
				else 
				{
					echo "0 results"; 
				}?>
 			<?php 
 				$conn->close(); ?>
				
			</table>
			</center>
		</form>
	</div>
	</body> 
</html>