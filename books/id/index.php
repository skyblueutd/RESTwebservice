<?php
$servername="localhost";
$username="root";
$password="";

//create connection
$con= mysqli_connect($servername, $username, $password, "HW4");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

function get_book_info($id, $con){
	$author_list = array();
	$book_list = array();
	$book_info_query = "select * FROM book where Book_id='$id'";
	$author_query = "SELECT Author_Name FROM Authors AS A INNER JOIN Book_Authors AS B ON B.Author_id= A.Author_id AND B.Book_id = '$id'";
	$A_query = mysqli_query($con,$book_info_query);
	$B_query = mysqli_query($con,$author_query);
	if((mysqli_num_rows($A_query)>0)&&(mysqli_num_rows($B_query)>0)){
		while($row=mysqli_fetch_array($B_query)) {
			$authors=$row["Author_Name"];
			array_push($author_list,$authors);
		}

		while($row=mysqli_fetch_array($A_query)){
			$data = array("Title" => $row["Title"], "Category"=>$row["Category"], "Authors" => $author_list, "Year" => $row["Year"], "Price" => $row["Price"]);
			array_push($book_list, $data);
		}
	}
	return $book_list;
}

if(isset($_GET["book_id"])){

         $value= get_book_info($_GET["book_id"],$con);
         exit(json_encode($value));
}

?>