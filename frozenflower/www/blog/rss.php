<?php
require_once('../../lib/SmartySetup.php');
require_once('../../lib/Blog.php');

$smarty = new SmartySetup();
$blog = new Blog;

$smarty->assign('posts', $blog->getPosts(20));

$smarty->display('blog/rss.tpl');

?>
