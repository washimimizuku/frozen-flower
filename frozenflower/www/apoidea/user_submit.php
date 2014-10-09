<?php
   include("session.php");
	include("database.php");

	$page = $_POST['page'];
   $action = $_POST['action'];
   $id = $_POST['id'];
	$msg = '';

   $tribeID = $_POST['tribeID'];
   $name = $_POST['name'];
   $username = $_POST['username'];
   $password_temp = $_POST['password'];
   $password_check = $_POST['password_check'];
   $password = md5($password_temp);


   if (!($tribeID) && ($action != "erase2")) {
      $msg .= "O campo Grupo é obrigatório.<br>";
   }
   if (!($username) && ($action != "erase2")) {
      $msg .= "O campo Username é obrigatório.<br>";
   }
   if (($password_temp != $password_check) && ($action != "erase2")) {
      $msg .= "Os campos de Password têm de ser iguais.<br>";
   }
   if (!($password) && ($action != "erase2")) {
      $msg .= "O campo Password é obrigatório.<br>";
   }


   if ($msg == ''){
		if ($action == "create2"){
      	$query = "insert into user (tribeID, name, username, password) values ('$tribeID', '$name', '$username', '$password')";
     		mysql_query($query) or die("Invalid query: " . mysql_error());
   	}

		if ($action == "modify2") {
     		$query = "update user set tribeID='$tribeID', name='$name', username='$username', password='$password' where id=$id";
   	   mysql_query($query) or die("Invalid query: " . mysql_error());
		}

 	  if ($action == "erase2") {
   	   foreach ($id as $idx) {

            if ($msg == '') {
	            $query = "delete from user where id=$idx";
         	   mysql_query($query) or die("Invalid query: " . mysql_error());
				}
     		}
   	}

	} else {
	   $_SESSION["msg"] = $msg;
	}

   if ($page){
		header ("Location: user.php?page=$page");
	} else {
		header ("Location: user.php");
	}
   exit;
?>
