{include file="header.tpl" title="FrozenFlower - Blog"}
		<div id="center">
{section name=post loop=$posts}
         <div class="article">
            <div class="title"><a href="/blog/article.php?id={$posts[post].id}">{$posts[post].title}</a></div>
            <div class="subtitle">{$posts[post].creationDate}</div>
            <div class="post">{$posts[post].text}</div>
            <div class="bottom">{if $posts[post].tags}<span class="tags">tags [ {foreach item=tag from=$posts[post].tags}<a href="/blog/?tag={$tag}">{$tag}</a> {/foreach}]</span> | {/if}<a href="/blog/article.php?id={$posts[post].id}">link</a> | <a href="/blog/article.php?id={$posts[post].id}#comment">comments ({$posts[post].commentsNumber})</a></div>
         </div>
{/section}
         <div class="pagination">
			   <span class="previousPage">{if $page>0}<a href="index.php?page={$page-1}">&lt;&lt; Previous Page</a>{else}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{/if}</span>
				<span class="nextPage">{if $more>0}<a href="index.php?page={$page+1}">Next Page &gt;&gt;</a>{/if}</span>
			</div>
      </div>
{include file="right.tpl" feeds=$feeds}
{include file="blog/footer.tpl"}
