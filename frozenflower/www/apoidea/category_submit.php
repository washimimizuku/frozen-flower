<?php
   include("session.php");
	include("database.php");

	$page = $_POST['page'];
   $action = $_POST['action'];
   $id = $_POST['id'];
	$msg = '';

   $parentCategoryID = $_POST['parentCategoryID'];
   $name = $_POST['name'];
   $stub = $_POST['stub'];
   $active = $_POST['active'];
   $feed = $_POST['feed'];


   if (!($name) && ($action != "erase2")) {
      $msg .= "O campo Nome é obrigatório.<br>";
   }
   if (!($stub) && ($action != "erase2")) {
      $msg .= "O campo Stub é obrigatório.<br>";
   }


   if ($msg == ''){
		if ($action == "create2"){
      	$query = "insert into category (parentCategoryID, name, stub, active, feed) values ('$parentCategoryID', '$name', '$stub', '$active', '$feed')";
     		mysql_query($query) or die("Invalid query: " . mysql_error());
   	}

		if ($action == "modify2") {
     		$query = "update category set parentCategoryID='$parentCategoryID', name='$name', stub='$stub', active='$active', feed='$feed' where id=$id";
   	   mysql_query($query) or die("Invalid query: " . mysql_error());
		}

 	  if ($action == "erase2") {
   	   foreach ($id as $idx) {
            $query = "select * from category where categoryId='$idx'";
            $result = mysql_query($query) or die("Invalid query: " . mysql_error());
            $num = mysql_num_rows($result);

            if ($num > 0) {
               $msg .= "Não foi possível apagar a entidade do tipo category $row[0] devido a ter entidades do tipo category associadas a ela.<br>";
            }


            if ($msg == '') {
	            $query = "delete from category where id=$idx";
         	   mysql_query($query) or die("Invalid query: " . mysql_error());
				}
     		}
   	}

	} else {
	   $_SESSION["msg"] = $msg;
	}

   if ($page){
		header ("Location: category.php?page=$page");
	} else {
		header ("Location: category.php");
	}
   exit;
?>
