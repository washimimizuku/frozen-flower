<?php
   include("session.php");
	include("database.php");

	$page = $_POST['page'];
   $action = $_POST['action'];
   $id = $_POST['id'];
	$msg = '';

   $creationDate = $_POST['creationDate'];
   $title = $_POST['title'];
   $text = $_POST['text'];
   $active = $_POST['active'];

   $tags = $_POST['tags'];

   $allTags = array();
   if ($tags) {
      $allTags = split(",", $tags);
   }

   $text = preg_replace('/\n/',"<br />", $text);


   if ($msg == ''){
		if ($action == "create2"){
      	$query = "insert into article (title, text, creationDate, active) values ('$title', '$text', NOW(), '$active')";
     		mysql_query($query) or die("Invalid query: " . mysql_error());

$query = "select id from article where title='$title' order by id desc";
      $result = mysql_query($query) or die("Invalid query: " . mysql_error());
      $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
      $id = $row[0];

      # Tags
      if ($tags) {
         foreach ($allTags as $tag) {
            $tag = rtrim($tag);
            $tag = ltrim($tag);
            if ($tag != '') {
               $query = "select * from tag where name='$tag'";
               $result = mysql_query($query) or die("Invalid query: " . mysql_error());
               if (mysql_num_rows($result)) {
                  $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
               } else {
                  $query = "insert into tag values ('', '$tag');";
                  mysql_query($query) or die("Invalid query: " . mysql_error());
            
                  $query = "select * from tag where name='$tag'";
                  $result = mysql_query($query) or die("Invalid query: " . mysql_error());
                  $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
               }
               
               $query = "insert into rel_tag_article values ($row[0], $id);";
               mysql_query($query) or die("Invalid query: " . mysql_error());               
            }
         }
      }


   	}

		if ($action == "modify2") {
     		$query = "update article set title='$title', text='$text', active='$active', creationDate='$creationDate' where id=$id";
   	   mysql_query($query) or die("Invalid query: " . mysql_error());

      if ($tags) {
         foreach ($allTags as $tag) {
            $tag = rtrim($tag);
            $tag = ltrim($tag);
            if ($tag != '') {
               $query = "select * from tag where name='$tag'";
               $result = mysql_query($query) or die("Invalid query: " . mysql_error());
               if (mysql_num_rows($result)) {
                  $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
               } else {
                  $query = "insert into tag values ('', '$tag');";
                  mysql_query($query) or die("Invalid query: " . mysql_error());
            
                  $query = "select * from tag where name='$tag'";
                  $result = mysql_query($query) or die("Invalid query: " . mysql_error());
                  $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
               }
               
               $query = "insert into rel_tag_article values ($row[0], $id);";
               mysql_query($query) or die("Invalid query: " . mysql_error());               
            }
         }
      }

		}

 	  if ($action == "erase2") {
   	   foreach ($id as $idx) {
            $query = "select * from comment where articleId='$idx'";
            $result = mysql_query($query) or die("Invalid query: " . mysql_error());
            $num = mysql_num_rows($result);

            if ($num > 0) {
               $msg .= "Não foi possível apagar a entidade do tipo article $row[0] devido a ter entidades do tipo comment associadas a ela.<br>";
            }


            if ($msg == '') {
	            $query = "delete from article where id=$idx";
         	   mysql_query($query) or die("Invalid query: " . mysql_error());
				}
     		}
   	}

	} else {
	   $_SESSION["msg"] = $msg;
	}

   if ($page){
		header ("Location: article.php?page=$page");
	} else {
		header ("Location: article.php");
	}
   exit;
?>
