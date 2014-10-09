{% include 'header.tpl' %}
      <div id="center">
         <div class="article">
            <div class="title">{$post.title}</div>
            <div class="subtitle">{$post.creationDate}</div>
            <div class="post">{$post.text}</div>
            <div class="bottom">{if $post.tags}<span class="tags">tags [ {foreach item=tag from=$post.tags}<a href="/blog/?tag={$tag}">{$tag}</a> {/foreach}]</span> | {/if}<a href="/blog/artigo.php?id={$post.id}">link</a></div>
         </div>
         <div id="comments">
{if $comments}
            <a name="comment"><div class="title">Comments:</div></a>
{/if}
{section name=comment loop=$comments}
            <div class="comment">
               <div class="author">{if $comments[comment].link}<a href="{$comments[comment].link}">{/if}{if $comments[comment].name}{$comments[comment].name}{else}Anonymous{/if}{if $comments[comment].link}</a>{/if}</div>
               <div class="date">{$comments[comment].date}</div>
               <div class="text">{$comments[comment].text}</div>
            </div>
{/section}
            <div class="title"><br />Leave your comment:</div>
            <div class="error">{$msg}</div>
            <div id="comment_form">
               <br />
               <form method="post" action="sendComment.php">
                  <p><input type="text" name="name" value="{$name}" /> Name</p>
                  <p><input type="text" name="email" value="{$email}" /> Email (won't be shown)</p>
                  <p><input type="text" name="link" value="{$link}" /> Link</p>
                  <p><textarea name="text" cols="40" rows="10" onkeypress="form.status.value++;">{$text}</textarea> Text (Mandatory)</p>
                  <p><input type="submit" name="submit_comment" value="     Send Comment     " ></p>
                  <input type="hidden" name="status" value="{$status}" />
                  <input type="hidden" name="id" value="{$post.id}" />
               </form>
            </div>
         </div>
      </div>
{% include 'right.tpl' %}
{% include 'blog/footer.tpl' %}
