<?php
   include("session.php");
	include("database.php");

	$page = $_POST['page'];
   $action = $_POST['action'];
   $id = $_POST['id'];
	$msg = '';

   $name = $_POST['name'];


   if (!($name) && ($action != "erase2")) {
      $msg .= "O campo Nome é obrigatório.<br>";
   }


   if ($msg == ''){
		if ($action == "create2"){
      	$query = "insert into tag (name) values ('$name')";
     		mysql_query($query) or die("Invalid query: " . mysql_error());
   	}

		if ($action == "modify2") {
     		$query = "update tag set name='$name' where id=$id";
   	   mysql_query($query) or die("Invalid query: " . mysql_error());
		}

 	  if ($action == "erase2") {
   	   foreach ($id as $idx) {

            if ($msg == '') {
	            $query = "delete from tag where id=$idx";
         	   mysql_query($query) or die("Invalid query: " . mysql_error());
				}
     		}
   	}

	} else {
	   $_SESSION["msg"] = $msg;
	}

   if ($page){
		header ("Location: tag.php?page=$page");
	} else {
		header ("Location: tag.php");
	}
   exit;
?>
