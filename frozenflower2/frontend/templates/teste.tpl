{include file="header2.tpl" title="FrozenFlower - Homepage"}
		<div id="center">
{section name=post loop=$posts}
{assign var=feedID value=$posts[post].feed}
         <div class="article">
            <div class="title"><a href="{$posts[post].url}">{$posts[post].title}</a></div>
            <div class="subtitle">{$posts[post].publishDate}{if $posts[post].author} by {$posts[post].author}{/if} in <a href="{$feedsByID[$feedID].siteUrl}">{$feedsByID[$feedID].title}</a></div>
            <div class="post">{$posts[post].description}</div>
            <div class="bottom">{if $posts[post].category}<span class="tags">tags [{$posts[post].category}]</span> | {/if}<a href="http://del.icio.us/post?url={$posts[post].url}&title={$posts[post].title}" target="_blank" title="post to del.icio.us"><img src="images/delicious.gif" height="10" alt="del.icio.us" /> del.icio.us</a> | <a href="http://digg.com/submit?phase=2&url={$posts[post].url}&title={$posts[post].title}" target="_blank" title="post to digg"><img src="images/digg.png" height="10" alt="digg" /> digg</a> | <a href="javascript:bookmarksite('{$posts[post].title}', '{$posts[post].url}')" title="Bookmark this">bookmark</a> | <a href="{$posts[post].url}">link</a></div>
         </div>
{/section}
         <div class="pagination">
			   <span class="previousPage">{if $page>0}<a href="index.php?page={$page-1}">&lt;&lt; Previous Page</a>{else}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{/if}</span>
				<span class="nextPage">{if $more>0}<a href="index.php?page={$page+1}">Next Page &gt;&gt;</a>{/if}</span>
			</div>
      </div>
{include file="right.tpl" feeds=$feeds}
{include file="footer.tpl"}
