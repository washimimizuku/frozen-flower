<?php
	header('Content-type: text/html; charset=UTF-8');
	include("session.php");
   
	// Action
   $action = $_REQUEST['action'];
   $search = $_REQUEST['search'];
   $order  = $_REQUEST['order'];

	$msg = $_SESSION['msg'];
	$_SESSION['msg'] = '';

   $id = $_REQUEST['id'];
   if (!isset($id)) {
      if ($action == "modify") {
         $msg = "Tem de seleccionar uma das linhas!";
         $action = "";
      } else if ($action == "erase") {
         $msg = "Tem de seleccionar pelo menos uma das linha!";
         $action = "";
      }
   }
      
   include("header.php");
   include("menu.php");   
?>
<?php
   if (($action == "") || ($action == "search")) {

	if ($order == "") {
      $order = "id";
   }
   $direction  = $_REQUEST['direction'];
   if ($direction == "") {
      $direction = "desc";
   }

   // List Pages
	$page = $_REQUEST['page'];
   if (!$page) {
      $page = 0;
   }
	$pageSize = 20;
   $begin = $page * $pageSize;
   $end = $inicio + $pageSize;

?>
   <form name="form" method="post" action="feed.php">
      <div id="content">
         <h2>Feed</h2>
<?php
	if ($msg) {
?>
         <p class="message_left"><?php echo($msg) ?></p>
<?php
	}
?>
         <div id="action_menu">
            <div id="search">
               <input type="text" name="search" /><input class="image_button" type="image" src="images/procurar.png" value="Procurar" onclick="javascript: form.action.value='search'; form.submit;" />
               <script type="text/javascript">document.form.search.focus()</script>
            </div>
            <input class="image_button" type="image" src="images/criar.png" value="Criar" onclick="javascript: form.action.value='create'; form.submit;" /><input class="image_button" type="image" src="images/alterar.png" value="Alterar" onclick="javascript: form.action.value='modify'; form.submit;" /><input class="image_button" type="image" src="images/apagar.png" value="Apagar" onclick="javascript: form.action.value='erase'; form.submit;" /><input type="hidden" name="action" value="" />
         </div>
         <div class="tabela">
            <table border="0" cellspacing="0">
               <tr class="title">
                  <td class="checkbox"><input type="checkbox" name="all" onclick="setAllCheckBoxes('form', 'id[]');" /></td>
                  <td>Título</td>
                  <td>Descrição</td>
                  <td>URL do site</td>
                  <td>URL do feed</td>

                  <td></td>
                  <td></td>
               </tr>
<?php
   $query = "select id, title, description, siteUrl, feedUrl from feed order by $order $direction limit $begin, ".($pageSize + 1);
   if (!ereg('[^A-Za-z0-9]', $search)) {
      $query = "select id, title, description, siteUrl, feedUrl from feed where title like '%$search%' or description like '%$search%' order by $order $direction limit $begin, ".($pageSize + 1);
   }
   $result = mysql_query($query) or die("Invalid query: " . mysql_error());
   $num = mysql_num_rows($result);
   if ($num < $pageSize) {
      $end = $num;
   }
   for ($i = 0; $i < $end; $i++) {
      $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
      if ($i % 2) {
?>
               <tr class="dark">
<?php
      } else {
?>
               <tr class="light">
<?php
      }
?>
                  <td class="checkbox"><input type="checkbox" name="id[]" value="<?php echo($row[0]); ?>" /></td>
                  <td><?php echo($row[1]); ?></td>
                  <td><?php echo($row[2]); ?></td>
                  <td><?php echo($row[3]); ?></td>
                  <td><?php echo($row[4]); ?></td>

                  <td><a href="feed.php?action=modify&id%5B%5D=<?php echo($row[0]); ?>&page=<?php echo($page); ?>"><img class="small_button" src="images/refresh.png" /></a></td>
                  <td><a href="feed.php?action=erase&id%5B%5D=<?php echo($row[0]); ?>&page=<?php echo($page); ?>"><img class="small_button" src="images/delete.png" /></a></td>
               </tr>
<?php
   }
?>
               <tr class="title">
                  <td id="paging_row" colspan="7">
                     <div id="paging">
                        <ul>
                           <li class="left">
<?php
      $query = "select count(*) from feed";
      $result = mysql_query($query) or die("Invalid query: " . mysql_error());
      $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
      $num = $row[0] / $pageSize;

      if (($num > 5) && ($page > 0)) {
?>
                              <a href="feed.php?page=0"><img class="small_button" src="images/previous2.png" /></a>
<?php
      }
      if ($page > 0) {
?>
                              <a href="feed.php?page=<? echo($page - 1); ?>&order=<? echo($order); ?>&direction=<? echo($direction); ?>&search=<?
echo($search); ?>"><img class="small_button" src="images/previous.png" /></a>
<?php
      } else {
?>
                              &nbsp;
<?php
      }
?>
                           </li>
                           <li class="center">
<?php
      if ($num > 1) {
         $ini = $page - 2;
         if ($ini > intval($num-0.01) - 4) { $ini = intval($num-0.01) - 4;}
         if ($ini < 0) { $ini = 0;}

         $j = 0;
         for ($i = $ini; ($i < $num) && ($j < 5); $i++) {
            $j++;
            if ($i == $page) {
?>
                              <? echo($i + 1); ?>
<?php
            } else {
?>
                              <a href="feed.php?page=<? echo($i); ?>&order=<? echo($order); ?>&direction=<? echo($direction); ?>&search=<?
echo($search); ?>"><? echo($i + 1); ?></a>
<?php
            }
         }
      } else {
?>
                              &nbsp;
<?php
      }
?>
                           </li>
                           <li class="right">
<?php
      if ($page < $num - 1) {
?>
                              <a href="feed.php?page=<? echo($page + 1); ?>&order=<? echo($order); ?>&direction=<? echo($direction); ?>&search=<?
echo($search); ?>"><img class="small_button" src="images/next.png" /></a>
<?php
      } else {
?>
                              &nbsp;
<?php
      }
      if (($num > 5) && ($page < $num - 1)) {
?>
                              <a href="feed.php?page=<? echo(intval($num-0.01)); ?>&order=<? echo($order); ?>&direction=<? echo($direction); ?>&search=<?
echo($search); ?>"><img class="small_button" src="images/next2.png" /></a>
<?php
      }
?>
                           </li>
                        </ul>
                     </div>
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </form>
<?php
   }
?>
<?php
   if ($action == "create")  {
?>
   <div id="content">
      <h2><a href="feed.php">Feed</a> > Criar Feed</h2>
<?php
	if ($msg) {
?>
      <p class="message"><?php echo($msg) ?></p>
<?php
	}
?>
      <div class="tabela">
         <form name="form" method="post" action="feed_submit.php">
            <input type="hidden" name="action" value="create2" />
            <input type="hidden" name="id" value="<?php echo($id) ?>" />
            <table>
               <tr>
                  <td class="title">Título</td>
                  <td class="dark">
                     <input type="text" size="40" name="title" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Descrição</td>
                  <td class="dark">
                     <input type="text" size="40" name="description" />
                  </td>
               </tr>
               <tr>
                  <td class="title">URL do site</td>
                  <td class="dark">
                     <input type="text" size="40" name="siteUrl" />
                  </td>
               </tr>
               <tr>
                  <td class="title">URL do feed</td>
                  <td class="dark">
                     <input type="text" size="40" name="feedUrl" />
                  </td>
               </tr>
               <tr>
                  <td class="title">língua</td>
                  <td class="dark">
                     <input type="text" size="40" name="language" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Autor</td>
                  <td class="dark">
                     <input type="text" size="40" name="author" />
                  </td>
               </tr>
               <tr>
                  <td class="title">TTL</td>
                  <td class="dark">
                     <input type="text" size="40" name="ttl" />
                  </td>
               </tr>

               <tr><td class="buttons" colspan="2"><input class="image_button" type="image" src="images/criar.png" value="Criar" onclick="javascript: form.submit;" /><input class="image_button" type="image" src="images/cancelar.png" value="Cancelar" onclick="javascript:document.location='feed.php';return false;" /></td></tr>
            </table>
         </form>
      </div>
   </div>
<?php
   }
?>
<?php
   if ($action == "modify"){
      $query = "select title, description, siteUrl, feedUrl, language, author, ttl from feed where id='$id[0]'";
      $result = mysql_query($query) or die("Invalid query: " . mysql_error());
      $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
?>
   <div id="content">
      <h2><a href="feed.php">Feed</a> > Alterar Feed</h2>
      <div class="tabela">
         <form name="form" method="post" action="feed_submit.php">
            <input type="hidden" name="creation_date" value="<?php echo($creation_date) ?>" />
            <input type="hidden" name="page" value="<?php echo($page) ?>" />
            <input type="hidden" name="action" value="modify2" />
            <input type="hidden" name="id" value="<?php echo($id[0]) ?>" />
            <table>
               <tr>
                  <td class="title">Título</td>
                  <td class="dark">
                     <input type="text" size="40" name="title" value="<?php echo($row[0]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Descrição</td>
                  <td class="dark">
                     <input type="text" size="40" name="description" value="<?php echo($row[1]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">URL do site</td>
                  <td class="dark">
                     <input type="text" size="40" name="siteUrl" value="<?php echo($row[2]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">URL do feed</td>
                  <td class="dark">
                     <input type="text" size="40" name="feedUrl" value="<?php echo($row[3]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">língua</td>
                  <td class="dark">
                     <input type="text" size="40" name="language" value="<?php echo($row[4]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Autor</td>
                  <td class="dark">
                     <input type="text" size="40" name="author" value="<?php echo($row[5]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">TTL</td>
                  <td class="dark">
                     <input type="text" size="40" name="ttl" value="<?php echo($row[6]); ?>" />
                  </td>
               </tr>

               <tr><td class="buttons" colspan="2"><input class="image_button" type="image" src="images/alterar.png" value="Alterar" onclick="javascript: form.submit;" /><input class="image_button" type="image" src="images/cancelar.png" value="Cancelar" onclick="javascript:document.location='feed.php';return false;" /></td></tr>
            </table>
         </form>
      </div>
   </div>
<?php
   }
?>
<?php
   if ($action == "erase") {
?>
   <div id="content">
      <h2><a href="feed.php">Feed</a> > Apagar Feed</h2>
      <div class="tabela">
         <form method="post" action="feed_submit.php">
            <input type="hidden" name="page" value="<?php echo($page) ?>" />
            <input type="hidden" name="action" value="erase2" />
            <table>
               <tr class="title">
                  <td>Título</td>
                  <td>Descrição</td>
                  <td>URL do site</td>
                  <td>URL do feed</td>
                  <td>língua</td>
                  <td>Autor</td>
                  <td>TTL</td>

               </tr>
<?php
      foreach ($id as $idx) {
         $query = "select title, description, siteUrl, feedUrl, language, author, ttl from feed where id='$idx'";
         $result = mysql_query($query) or die("Invalid query: " . mysql_error());
         $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
?>
               <tr class="dark">
                  <td><?php echo($row[0]); ?></td>
                  <td><?php echo($row[1]); ?></td>
                  <td><?php echo($row[2]); ?></td>
                  <td><?php echo($row[3]); ?></td>
                  <td><?php echo($row[4]); ?></td>
                  <td><?php echo($row[5]); ?></td>
                  <td><?php echo($row[6]); ?></td>

               </tr>
					<input type="hidden" name="id[]" value="<?php echo($idx); ?>" />
<?php
      }
?>
               <tr><td class="buttons" colspan="10"><input class="image_button" type="image" src="images/apagar.png" value="Apagar" onclick="javascript: form.submit;" /><input class="image_button" type="image" src="images/cancelar.png" value="Cancelar" onclick="javascript:document.location='feed.php';return false;" /></td></tr>
            </table>
         </form>
      </div>
   </div>
<?php
   } 
?>
<?php
   include ("footer.php");
?>
