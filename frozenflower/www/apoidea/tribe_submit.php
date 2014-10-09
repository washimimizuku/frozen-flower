<?php
   include("session.php");
	include("database.php");

	$page = $_POST['page'];
   $action = $_POST['action'];
   $id = $_POST['id'];
	$msg = '';

   $name = $_POST['name'];




   if ($msg == ''){
		if ($action == "create2"){
      	$query = "insert into tribe (name) values ('$name')";
     		mysql_query($query) or die("Invalid query: " . mysql_error());
   	}

		if ($action == "modify2") {
     		$query = "update tribe set name='$name' where id=$id";
   	   mysql_query($query) or die("Invalid query: " . mysql_error());
		}

 	  if ($action == "erase2") {
   	   foreach ($id as $idx) {
            $query = "select * from user where tribeId='$idx'";
            $result = mysql_query($query) or die("Invalid query: " . mysql_error());
            $num = mysql_num_rows($result);

            if ($num > 0) {
               $msg .= "Não foi possível apagar a entidade do tipo tribe $row[0] devido a ter entidades do tipo user associadas a ela.<br>";
            }


            if ($msg == '') {
	            $query = "delete from tribe where id=$idx";
         	   mysql_query($query) or die("Invalid query: " . mysql_error());
				}
     		}
   	}

	} else {
	   $_SESSION["msg"] = $msg;
	}

   if ($page){
		header ("Location: tribe.php?page=$page");
	} else {
		header ("Location: tribe.php");
	}
   exit;
?>
