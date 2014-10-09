<?php
   include("session.php");
	include("database.php");

	$page = $_POST['page'];
   $action = $_POST['action'];
   $id = $_POST['id'];
	$msg = '';

   $repositoryID = $_POST['repositoryID'];
   $mimeType = $_POST['mimeType'];
   $length = $_POST['length'];
   $url = $_POST['url'];




   if ($msg == ''){
		if ($action == "create2"){
      	$query = "insert into enclosure (repositoryID, mimeType, length, url) values ('$repositoryID', '$mimeType', '$length', '$url')";
     		mysql_query($query) or die("Invalid query: " . mysql_error());
   	}

		if ($action == "modify2") {
     		$query = "update enclosure set repositoryID='$repositoryID', mimeType='$mimeType', length='$length', url='$url' where id=$id";
   	   mysql_query($query) or die("Invalid query: " . mysql_error());
		}

 	  if ($action == "erase2") {
   	   foreach ($id as $idx) {

            if ($msg == '') {
	            $query = "delete from enclosure where id=$idx";
         	   mysql_query($query) or die("Invalid query: " . mysql_error());
				}
     		}
   	}

	} else {
	   $_SESSION["msg"] = $msg;
	}

   if ($page){
		header ("Location: enclosure.php?page=$page");
	} else {
		header ("Location: enclosure.php");
	}
   exit;
?>
