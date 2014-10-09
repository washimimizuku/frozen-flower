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
   <form name="form" method="post" action="comment.php">
      <div id="content">
         <h2>Comentário</h2>
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
                  <td>Artigo</td>
                  <td>Título <a href="comment.php?order=title&direction=asc<?php if ($search) { echo "&search=$search";} ?>"><img class="small_button" src="images/up.png" /></a><a href="comment.php?order=title&direction=desc<?php if ($search) { echo "&search=$search";} ?>"><img class="small_button" src="images/down.png" /></a></td>                  <td>Nome <a href="comment.php?order=name&direction=asc<?php if ($search) { echo "&search=$search";} ?>"><img class="small_button" src="images/up.png" /></a><a href="comment.php?order=name&direction=desc<?php if ($search) { echo "&search=$search";} ?>"><img class="small_button" src="images/down.png" /></a></td>                  <td>Email</td>
                  <td>Link</td>
                  <td>Activo</td>

                  <td></td>
                  <td></td>
               </tr>
<?php
   $query = "select id, articleID, title, name, email, link, active from comment order by $order $direction limit $begin, ".($pageSize + 1);
   if (!ereg('[^A-Za-z0-9]', $search)) {
      $query = "select id, articleID, title, name, email, link, active from comment where title like '%$search%' or name like '%$search%' order by $order $direction limit $begin, ".($pageSize + 1);
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
<?php
      $query_article = "select title from article where id=$row[1]";
      $result_article = mysql_query($query_article) or die("Invalid query: " . mysql_error());
      $article="[Nada]";
      if (mysql_num_rows($result_article) > 0) {
         $article = "";
         while ($row_article = mysql_fetch_row($result_article)) {
            $article .= $row_article[0].", ";
         }
         $article = substr($article,0,strlen($article)-2);
      }
?>
                  <td><?php echo($article); ?></td>
                  <td><?php echo($row[2]); ?></td>
                  <td><?php echo($row[3]); ?></td>
                  <td><?php echo($row[4]); ?></td>
                  <td><?php echo($row[5]); ?></td>
                  <td><?php if ($row[6] == 1) { echo('Sim'); } else { echo('Não'); } ?></td>
                  <td><a href="comment.php?action=modify&id%5B%5D=<?php echo($row[0]); ?>&page=<?php echo($page); ?>"><img class="small_button" src="images/refresh.png" /></a></td>
                  <td><a href="comment.php?action=erase&id%5B%5D=<?php echo($row[0]); ?>&page=<?php echo($page); ?>"><img class="small_button" src="images/delete.png" /></a></td>
               </tr>
<?php
   }
?>
               <tr class="title">
                  <td id="paging_row" colspan="9">
                     <div id="paging">
                        <ul>
                           <li class="left">
<?php
      $query = "select count(*) from comment";
      $result = mysql_query($query) or die("Invalid query: " . mysql_error());
      $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
      $num = $row[0] / $pageSize;

      if (($num > 5) && ($page > 0)) {
?>
                              <a href="comment.php?page=0"><img class="small_button" src="images/previous2.png" /></a>
<?php
      }
      if ($page > 0) {
?>
                              <a href="comment.php?page=<? echo($page - 1); ?>&order=<? echo($order); ?>&direction=<? echo($direction); ?>&search=<?
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
                              <a href="comment.php?page=<? echo($i); ?>&order=<? echo($order); ?>&direction=<? echo($direction); ?>&search=<?
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
                              <a href="comment.php?page=<? echo($page + 1); ?>&order=<? echo($order); ?>&direction=<? echo($direction); ?>&search=<?
echo($search); ?>"><img class="small_button" src="images/next.png" /></a>
<?php
      } else {
?>
                              &nbsp;
<?php
      }
      if (($num > 5) && ($page < $num - 1)) {
?>
                              <a href="comment.php?page=<? echo(intval($num-0.01)); ?>&order=<? echo($order); ?>&direction=<? echo($direction); ?>&search=<?
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
      <h2><a href="comment.php">Comentário</a> > Criar Comentário</h2>
<?php
	if ($msg) {
?>
      <p class="message"><?php echo($msg) ?></p>
<?php
	}
?>
      <div class="tabela">
         <form name="form" method="post" action="comment_submit.php">
            <input type="hidden" name="action" value="create2" />
            <input type="hidden" name="id" value="<?php echo($id) ?>" />
            <table>
               <tr>
                  <td class="title">Artigo</td>
                  <td class="dark">
                     <select name="articleID">
                        <option value="0">[Nada]</option>
<?php
      $query_article = "select id, title from article order by id desc";
      $result_article = mysql_query($query_article) or die("Invalid query: " . mysql_error());
      for ($i = 0; $i < mysql_num_rows($result_article); $i++) {
         $row_article = mysql_fetch_row($result_article) or die("Could not retrieve row: " . mysql_error());
?>
                        <option value="<?php echo($row_article[0]); ?>"><?php echo($row_article[1]); ?></option>
<?php
      }
?>
                     </select>
                  </td>
               </tr>
               <tr>
                  <td class="title">Título</td>
                  <td class="dark">
                     <input type="text" size="40" name="title" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Texto</td>
                  <td class="dark">
                     <textarea  cols="50" rows="20" name="text"></textarea>
                  </td>
               </tr>
               <tr>
                  <td class="title">Nome</td>
                  <td class="dark">
                     <input type="text" size="40" name="name" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Email</td>
                  <td class="dark">
                     <input type="text" size="40" name="email" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Link</td>
                  <td class="dark">
                     <input type="text" size="40" name="link" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Activo</td>
                  <td class="dark">
                     <input type="radio" name="active" value="1" checked /> Sim <input type="radio" name="active" value="0" /> Não
                  </td>
               </tr>

               <tr><td class="buttons" colspan="2"><input class="image_button" type="image" src="images/criar.png" value="Criar" onclick="javascript: form.submit;" /><input class="image_button" type="image" src="images/cancelar.png" value="Cancelar" onclick="javascript:document.location='comment.php';return false;" /></td></tr>
            </table>
         </form>
      </div>
   </div>
<?php
   }
?>
<?php
   if ($action == "modify"){
      $query = "select articleID, date, title, text, name, email, link, active from comment where id='$id[0]'";
      $result = mysql_query($query) or die("Invalid query: " . mysql_error());
      $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
?>
   <div id="content">
      <h2><a href="comment.php">Comentário</a> > Alterar Comentário</h2>
      <div class="tabela">
         <form name="form" method="post" action="comment_submit.php">
            <input type="hidden" name="creation_date" value="<?php echo($creation_date) ?>" />
            <input type="hidden" name="page" value="<?php echo($page) ?>" />
            <input type="hidden" name="action" value="modify2" />
            <input type="hidden" name="id" value="<?php echo($id[0]) ?>" />
            <table>
               <tr>
                  <td class="title">Artigo</td>
                  <td class="dark">
                     <select name="articleID">
                        <option value="0">[Nada]</option>
<?php
      $query_article = "select id, title from article order by id desc";
      $result_article = mysql_query($query_article) or die("Invalid query: " . mysql_error());
      $selected = "";
      for ($i = 0; $i < mysql_num_rows($result_article); $i++) {
         $row_article = mysql_fetch_row($result_article) or die("Could not retrieve row: " . mysql_error());
         if ($row_article[0] == $row[0]) {
            $selected = " selected";
         } else {
            $selected = "";
         }
?>
                        <option value="<?php echo($row_article[0]); ?>"<?php echo($selected); ?>><?php echo($row_article[1]); ?></option>
<?php
      }
?>
                     </select>
                  </td>
               </tr>
               <tr>
                  <td class="title">Título</td>
                  <td class="dark">
                     <input type="text" size="40" name="title" value="<?php echo($row[2]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Texto</td>
                  <td class="dark">
                     <textarea  cols="50" rows="20" name="text"><?php echo($row[3]); ?></textarea>
                  </td>
               </tr>
               <tr>
                  <td class="title">Nome</td>
                  <td class="dark">
                     <input type="text" size="40" name="name" value="<?php echo($row[4]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Email</td>
                  <td class="dark">
                     <input type="text" size="40" name="email" value="<?php echo($row[5]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Link</td>
                  <td class="dark">
                     <input type="text" size="40" name="link" value="<?php echo($row[6]); ?>" />
                  </td>
               </tr>
               <tr>
                  <td class="title">Activo</td>
                  <td class="dark">
                     <input type="radio" name="active" value="1"<?php if ($row[7] == 1) { echo(' checked'); } ?> /> Sim <input type="radio" name="active" value="0"<?php if ($row[7] == 0) { echo(' checked'); } ?> /> Não
                  </td>
               </tr>

               <tr><td class="buttons" colspan="2"><input class="image_button" type="image" src="images/alterar.png" value="Alterar" onclick="javascript: form.submit;" /><input class="image_button" type="image" src="images/cancelar.png" value="Cancelar" onclick="javascript:document.location='comment.php';return false;" /></td></tr>
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
      <h2><a href="comment.php">Comentário</a> > Apagar Comentário</h2>
      <div class="tabela">
         <form method="post" action="comment_submit.php">
            <input type="hidden" name="page" value="<?php echo($page) ?>" />
            <input type="hidden" name="action" value="erase2" />
            <table>
               <tr class="title">
                  <td>Artigo</td>
                  <td>Data de Criação</td>
                  <td>Título</td>
                  <td>Texto</td>
                  <td>Nome</td>
                  <td>Email</td>
                  <td>Link</td>
                  <td>Activo</td>

               </tr>
<?php
      foreach ($id as $idx) {
         $query = "select articleID, date, title, text, name, email, link, active from comment where id='$idx'";
         $result = mysql_query($query) or die("Invalid query: " . mysql_error());
         $row = mysql_fetch_row($result) or die("Could not retrieve row: " . mysql_error());
?>
               <tr class="dark">
<?php
         if ($row[0] == 0) {
           $article = 'Nenhum';
         } else {
           $query_article = "select title from article where id=$row[0]";
           $result_article = mysql_query($query_article) or die("Invalid query: " . mysql_error());
           $row_article = mysql_fetch_row($result_article) or die("Could not retrieve row: " . mysql_error());
           $article = $row_article[0];
         }?>
                  <td><?php echo($article); ?></td>
                  <td><?php echo($row[1]); ?></td>
                  <td><?php echo($row[2]); ?></td>
                  <td><?php echo($row[3]); ?></td>
                  <td><?php echo($row[4]); ?></td>
                  <td><?php echo($row[5]); ?></td>
                  <td><?php echo($row[6]); ?></td>
                  <td><?php if ($row[7] == 1) { echo('Sim'); } else { echo('Não');} ?></td>

               </tr>
					<input type="hidden" name="id[]" value="<?php echo($idx); ?>" />
<?php
      }
?>
               <tr><td class="buttons" colspan="11"><input class="image_button" type="image" src="images/apagar.png" value="Apagar" onclick="javascript: form.submit;" /><input class="image_button" type="image" src="images/cancelar.png" value="Cancelar" onclick="javascript:document.location='comment.php';return false;" /></td></tr>
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
