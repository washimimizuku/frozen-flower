<?php

require_once('../../lib/SmartySetup.php');
require_once('../../lib/Planet.php');
require_once('../../lib/Blog.php');

$smarty = new SmartySetup();

$id = 0;
if ($_GET['id']) {
   $id = $_GET['id'];
}

$name = $_GET['name'];
$email = $_GET['email'];
$link = $_GET['link'];
$text = $_GET['text'];
$status = $_GET['status'];
$msg = $_GET['msg'];

$smarty->assign('name', $name);
$smarty->assign('email', $email);
$smarty->assign('link', $link);
$smarty->assign('text', base64_decode($text));
$smarty->assign('status', $status);
$smarty->assign('msg', base64_decode($msg));

$planet = new Planet;
$blog = new Blog;

$smarty->assign('feeds', $planet->getFeeds());
$smarty->assign('post', $blog->getArticle($id));
$smarty->assign('comments', $blog->getComments($id));

$smarty->display('blog/article.tpl', "article_$id");

?>
