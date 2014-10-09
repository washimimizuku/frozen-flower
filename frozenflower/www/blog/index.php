<?php

require_once('../../lib/SmartySetup.php');
require_once('../../lib/Planet.php');
require_once('../../lib/Blog.php');

$smarty = new SmartySetup();

$page = 0;
if ($_GET['page']) {
   $page = $_GET['page'];
}

$tag = '';
if ($_GET['tag']) {
   $tag = $_GET['tag'];
}

$planet = new Planet;
$blog = new Blog;

$smarty->assign('feeds', $planet->getFeeds());
$smarty->assign('posts', $blog->getPosts(20, $page, $tag));
#$smarty->assign('comments', $blog->getCommentsNumber( $page, $tag));

$more = $blog->getPosts(20, $page+1, $tag);
if ($more) {
   $smarty->assign('more', 1);
} else {
   $smarty->assign('more', 0);
}

$smarty->assign('page', $page);

$smarty->display('blog/index.tpl', "blog_index_$page"."_$tag");

?>
