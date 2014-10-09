<?php
   include("session.php");
	include("database.php");

	$page = $_POST['page'];
   $action = $_POST['action'];
   $id = $_POST['id'];
	$msg = '';

   $title = $_POST['title'];
   $description = $_POST['description'];
   $siteUrl = $_POST['siteUrl'];
   $feedUrl = $_POST['feedUrl'];
   $language = $_POST['language'];
   $author = $_POST['author'];
   $ttl = $_POST['ttl'];




   if ($msg == ''){
		if ($action == "create2"){
      	$query = "insert into feed (title, description, siteUrl, feedUrl, language, author, ttl) values ('$title', '$description', '$siteUrl', '$feedUrl', '$language', '$author', '$ttl')";
     		mysql_query($query) or die("Invalid query: " . mysql_error());
   	}

		if ($action == "modify2") {
     		$query = "update feed set title='$title', description='$description', siteUrl='$siteUrl', feedUrl='$feedUrl', language='$language', author='$author', ttl='$ttl' where id=$id";
   	   mysql_query($query) or die("Invalid query: " . mysql_error());
		}

 	  if ($action == "erase2") {
   	   foreach ($id as $idx) {
            $query = "select * from repository where feedId='$idx'";
            $result = mysql_query($query) or die("Invalid query: " . mysql_error());
            $num = mysql_num_rows($result);

            if ($num > 0) {
               $msg .= "Não foi possível apagar a entidade do tipo feed $row[0] devido a ter entidades do tipo repository associadas a ela.<br>";
            }


            if ($msg == '') {
	            $query = "delete from feed where id=$idx";
         	   mysql_query($query) or die("Invalid query: " . mysql_error());
				}
     		}
   	}

	} else {
	   $_SESSION["msg"] = $msg;
	}

   if ($page){
		header ("Location: feed.php?page=$page");
	} else {
		header ("Location: feed.php");
	}
   exit;
?>
