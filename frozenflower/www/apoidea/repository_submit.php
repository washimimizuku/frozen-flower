<?php
   include("session.php");
	include("database.php");

	$page = $_POST['page'];
   $action = $_POST['action'];
   $id = $_POST['id'];
	$msg = '';

   $feedID = $_POST['feedID'];
   $title = $_POST['title'];
   $description = $_POST['description'];
   $publishDate = $_POST['publishDate'];
   $author = $_POST['author'];
   $category = $_POST['category'];
   $guid = $_POST['guid'];




   if ($msg == ''){
		if ($action == "create2"){
      	$query = "insert into repository (feedID, title, description, publishDate, author, category, guid) values ('$feedID', '$title', '$description', '$publishDate', '$author', '$category', '$guid')";
     		mysql_query($query) or die("Invalid query: " . mysql_error());
   	}

		if ($action == "modify2") {
     		$query = "update repository set feedID='$feedID', title='$title', description='$description', publishDate='$publishDate', author='$author', category='$category', guid='$guid' where id=$id";
   	   mysql_query($query) or die("Invalid query: " . mysql_error());
		}

 	  if ($action == "erase2") {
   	   foreach ($id as $idx) {
            $query = "select * from enclosure where repositoryId='$idx'";
            $result = mysql_query($query) or die("Invalid query: " . mysql_error());
            $num = mysql_num_rows($result);

            if ($num > 0) {
               $msg .= "Não foi possível apagar a entidade do tipo repository $row[0] devido a ter entidades do tipo enclosure associadas a ela.<br>";
            }


            if ($msg == '') {
	            $query = "delete from repository where id=$idx";
         	   mysql_query($query) or die("Invalid query: " . mysql_error());
				}
     		}
   	}

	} else {
	   $_SESSION["msg"] = $msg;
	}

   if ($page){
		header ("Location: repository.php?page=$page");
	} else {
		header ("Location: repository.php");
	}
   exit;
?>
