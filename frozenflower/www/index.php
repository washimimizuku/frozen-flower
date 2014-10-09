<?php

require_once('../lib/SmartySetup.php');
require_once('../lib/Planet.php');

$smarty = new SmartySetup();

if ($_GET['page']) {
   $page = $_GET['page'];
} else {
   $page = 0;
}

$month = $_GET['month'];
$year = $_GET['year'];
$tag = $_GET['tag'];

$planet = new Planet;

$smarty->assign('history', $planet->getHistory());
$smarty->assign('feeds', $planet->getFeeds());
$smarty->assign('feedsByID', $planet->getFeedsByID());
$smarty->assign('posts', $planet->getPosts(20, $page, $month, $year, $tag));

$more = $planet->getPosts(20, $page+1, $month, $year, $tag);
if ($more) {
   $smarty->assign('more', 1);
} else {
   $smarty->assign('more', 0);
}

$smarty->assign('page', $page);
$smarty->assign('month', $month);
$smarty->assign('year', $year);
$smarty->assign('tag', $tag);

$smarty->display('index.tpl', "index_$page"."_$month"."_$year"."_$tag");

?>
