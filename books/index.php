<?php
$servername="localhost";
$username="root";
$password="";

//create connection
$con= mysqli_connect($servername, $username, $password, "HW4");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

function get_book_list($con)
{
	$book_list = array();
	$list_query="select * from book";
    $run_query=mysqli_query($con,$list_query);
    if(mysqli_num_rows($run_query)>0){
        while($row=mysqli_fetch_array($run_query)){
            $data=array("book_id" => $row["Book_id"], "Title" => $row["Title"], "Price" => $row["Price"], "Category"=>$row["Category"]);
            array_push($book_list, $data);
        }
        return $book_list;
    }
}


     $value= get_book_list($con);
     exit(json_encode($value));



?>