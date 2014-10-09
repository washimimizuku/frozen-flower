{include file="header.tpl" title="FrozenFlower - Homepage"}
		<div id="center">
{section name=post loop=$posts}
{assign var=feedID value=$posts[post].feed}
         <div class="article">
            <div class="title"><a href="{$posts[post].url}">{$posts[post].title}</a></div>
            <div class="subtitle">{$posts[post].publishDate}{if $posts[post].author} by {$posts[post].author}{/if} in <a href="{$feedsByID[$feedID].siteUrl}">{$feedsByID[$feedID].title}</a></div>
            <div class="post">{$posts[post].description}</div>
            <div class="bottom">{if $posts[post].category}<span class="tags">tags [{$posts[post].category}]</span> | {/if}<a href="http://del.icio.us/post?url={$posts[post].url}&title={$posts[post].title}" target="_blank" title="post to del.icio.us"><img src="images/delicious.gif" height="10" alt="del.icio.us" /> del.icio.us</a> | <a href="http://fotodigg.com/submit.php?url={$posts[post].url}" target="_blank" title="post to fotodigg"><img src="images/digg.png" height="10" alt="fotodigg" /> fotodigg</a> | <a href="javascript:bookmarksite('{$posts[post].title}', '{$posts[post].url}')" title="Bookmark this">bookmark</a> | <a href="{$posts[post].url}">link</a></div>
         </div>
{/section}
         <div class="pagination">
			   <span class="previousPage">{if $page>0}<a href="index.php?page={$page-1}{if $tag}&tag={$tag}{/if}{if $month}&month={$month}{/if}{if $year}&year={$year}{/if}">&lt;&lt; Previous Page</a>{else}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{/if}</span>
				<span class="nextPage">{if $more>0}<a href="index.php?page={$page+1}{if $tag}&tag={$tag}{/if}{if $month}&month={$month}{/if}{if $year}&year={$year}{/if}">Next Page &gt;&gt;</a>{/if}</span>
			</div>
        <div>
<br />
<br />
<script type="text/javascript"><!--
google_ad_client = "pub-3786919398545380";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "text_image";
//2007-08-28: frozenflower_bottom
google_ad_channel = "2912215581";
               google_color_border = "111111";
               google_color_bg = "111111";
               google_color_link = "FFFFFF";
               google_color_text = "CCCCCC";
               google_color_url = "999999";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
        </div>
      </div>
{include file="right.tpl" feeds=$feeds history=$history}
{include file="footer.tpl"}
