<?php

require_once('../../lib/Blog.php');
require_once('../../lib/SmartySetup.php');

$smarty = new SmartySetup();

$id = 0;
if ($_REQUEST['id']) {
   $id = $_REQUEST['id'];
}

$blog = new Blog;

$name = $_POST["name"];
$email = $_POST["email"];
$link = $_POST["link"];
if ((substr($link,0,7) != 'http://') && ($link != '')) {
  $link = 'http://'.$link;
}
$text = $_POST["text"];
$text = preg_replace('/\n/',"<br />", $text);
$submit_comment = $_POST["submit_comment"];
$status = $_POST["status"];
$msg = "";

if (($submit_comment) && ($status > 2) && ($id)) {
  $blog->setComment($id, '', $text, $name, $email, $link);
} else {
  $msg = "A mensagem est&aacute; pequenina...";
}
  
$smarty->clear_cache('blog/article.tpl', "article_$id");

if ($msg) {
  $text = preg_replace('/<br \/>/',"\n", $text);
  $text = base64_encode ($text);
  $msg = base64_encode ($msg);
  header ("Location: article.php?id=$id&name=$name&email=$email&link=$link&text=$text&status=$status&msg=$msg");
  exit;
} else {
  header ("Location: article.php?id=$id");
  exit;
}



?>
