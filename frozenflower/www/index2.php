<?php

require_once('../lib/SmartySetup.php');
require_once('../lib/Planet.php');

$smarty = new SmartySetup();

if ($_GET['page']) {
   $page = $_GET['page'];
} else {
   $page = 0;
}

$planet = new Planet;

$smarty->assign('feeds', $planet->getFeeds());
$smarty->assign('feedsByID', $planet->getFeedsByID());
$smarty->assign('posts', $planet->getPosts(20, $page));

$more = $planet->getPosts(20, $page+1);
if ($more) {
   $smarty->assign('more', 1);
} else {
   $smarty->assign('more', 0);
}

$smarty->assign('page', $page);

$smarty->display('index.tpl', 'index_'.$page);

?>
