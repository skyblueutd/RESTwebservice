<!DOCTYPE html>
<html>
<head>
	<title>Client</title>
</head>
<body>
	<?php
	//check if one of book links was clicked
		if(sizeof($_GET) != 0){
		//if($_GET["action"]=="get_book_info"){
			$book_input = file_get_contents('http://localhost/books/id/index.php?action=get_book_info&book_id='.$_GET["book_id"]);
			$book_info = json_decode($book_input, true);
	?>
	<?php foreach($book_info as $book):?>
	Title: <?php echo $book["Title"] ?><br>
	Category: <?php echo $book["Category"] ?><br>
	Authors: <?php foreach($book["Authors"] as $author):
					echo $author."<br>";
					endforeach;?>
					  
	Year: <?php echo $book["Year"] ?><br>
	Price: <?php echo $book["Price"] ?><br>
<?php endforeach?>
	<?php
		}
		else {
			$book_list = file_get_contents('http://localhost/books/index.php?action=get_book_list');
			$book_list = json_decode($book_list, true);
	?>

	<?php foreach($book_list as $books): ?>

	<a href= <?php echo"http://localhost/books/restclient.php?action=get_book_info&book_id=".$books["book_id"] ?>>
	<?php echo "Title:".$books["Title"]?></a>
	<br>
	<?php endforeach; 
		} 
	?>


</body>
</html>

