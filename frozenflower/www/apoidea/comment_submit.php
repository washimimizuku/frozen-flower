<?php
   include("session.php");
	include("database.php");

	$page = $_POST['page'];
   $action = $_POST['action'];
   $id = $_POST['id'];
	$msg = '';

   $articleID = $_POST['articleID'];
   $date = $_POST['dateYear']."-".$_POST['dateMonth']."-".$_POST['dateDay'];
   $title = $_POST['title'];
   $text = $_POST['text'];
   $name = $_POST['name'];
   $email = $_POST['email'];
   $link = $_POST['link'];
   $active = $_POST['active'];




   if ($msg == ''){
		if ($action == "create2"){
      	$query = "insert into comment (articleID, title, text, name, email, link, active) values ('$articleID', '$title', '$text', '$name', '$email', '$link', '$active')";
     		mysql_query($query) or die("Invalid query: " . mysql_error());
   	}

		if ($action == "modify2") {
     		$query = "update comment set articleID='$articleID', title='$title', text='$text', name='$name', email='$email', link='$link', active='$active' where id=$id";
   	   mysql_query($query) or die("Invalid query: " . mysql_error());
		}

 	  if ($action == "erase2") {
   	   foreach ($id as $idx) {

            if ($msg == '') {
	            $query = "delete from comment where id=$idx";
         	   mysql_query($query) or die("Invalid query: " . mysql_error());
				}
     		}
   	}

	} else {
	   $_SESSION["msg"] = $msg;
	}

   if ($page){
		header ("Location: comment.php?page=$page");
	} else {
		header ("Location: comment.php");
	}
   exit;
?>
