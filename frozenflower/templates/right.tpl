      <div id="right">
         <div class="title">
            FrozenFlower
         </div>
         <div class="content">
            <p>FrozenFlower is a photoblog aggregator. All content is taken from several photoblogs belonging to its members. For more information, or if you want to join,  please visit the <a href="/about.php">About</a> page.</p>
         </div>
         <div class="content">
            <script type="text/javascript"><!--
               google_ad_client = "pub-3786919398545380";
               google_ad_width = 200;
               google_ad_height = 200;
               google_ad_format = "200x200_as";
               google_ad_type = "text";
               //2007-10-05: frozenflower_square
               google_ad_channel = "9952904314";
               google_color_border = "444444";
               google_color_bg = "222222";
               google_color_link = "FFFFFF";
               google_color_text = "CCCCCC";
               google_color_url = "999999";
               //-->
            </script>
            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
         </div>
         <div class="title">
            Photographers
         </div>
         <div class="content">
            <ul>
{section name=feed loop=$feeds}
               <li><a href="{$feeds[feed].feedUrl}"><img src="/images/feed.gif" border="0" alt="Syndicate feed" /></a><a href="{$feeds[feed].siteUrl}">{$feeds[feed].title}</a></li>
{/section}
            </ul>
         </div>
{if $history}
         <div class="title">
            History
         </div>
         <div class="content">
            <ul>
{section name=index loop=$history}
               <li><a href="/?month={$history[index].month}&year={$history[index].year}">{$history[index].text}</a></li>
{/section}
            </ul>
         </div>
{/if}
         <div class="content">
            <script type="text/javascript"><!--
               google_ad_client = "pub-3786919398545380";
               google_ad_width = 160;
               google_ad_height = 600;
               google_ad_format = "160x600_as";
               google_ad_type = "text_image";
               //2007-08-03: fotoplanet_lateral
               google_ad_channel = "0468254023";
               google_color_border = "222222";
               google_color_bg = "222222";
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
