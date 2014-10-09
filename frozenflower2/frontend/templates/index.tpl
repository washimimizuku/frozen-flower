{% include 'header.tpl' %}
      <div id="center">
{% for item in item_list.object_list %}
         <div class="article">
            <div class="title"><a href="{{item.url}}">{{item.title}}</a></div>
            <div class="subtitle">{{item.publishDate}}{% if item.author %} by {{ item.author }}{% endif %} in <a href="{{item.feed.siteUrl}}">{{item.feed.title}}</a></div>
{% autoescape off %}
            <div class="post">{{item.description}}</div>
{% endautoescape %}
            <div class="bottom">{%if item.tag.all %}<span class="tags">tags [{% for tag in item.tag.all %}<a href="/tag/{{ tag.name }}{% if month %}/history/{{year}}/{{month}}{% endif %}">{{tag.name}}</a> {% endfor %}]</span> | {% endif %}<a href="http://del.icio.us/post?url={{item.url}}&title={{item.title}}" target="_blank" title="post to del.icio.us"><img src="/static/images/delicious.gif" height="10" alt="del.icio.us" /> del.icio.us</a> | <a href="http://fotodigg.com/submit.php?url={{item.url}}" target="_blank" title="post to fotodigg"><img src="/static/images/digg.png" height="10" alt="fotodigg" /> fotodigg</a> | <a href="javascript:bookmarksite('{{item.title}}', '{{item.url}}')" title="Bookmark this">bookmark</a> | <a href="{{item.url}}">link</a></div>
         </div>
{% endfor %}
         <div class="pagination">
	    <span class="previousPage">{% if item_list.has_previous %}<a href="/page/{{ item_list.previous_page_number }}{% if month %}/history/{{year}}/{{month}}{% endif %}">&lt;&lt; Previous Page</a>{% else %}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{% endif %}</span>
	    <span class="nextPage">{% if item_list.has_next %}<a href="/page/{{ item_list.next_page_number }}{% if month %}/history/{{year}}/{{month}}{% endif %}">Next Page &gt;&gt;</a>{% endif %}</span>
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
{% include 'right.tpl' %}
{% include 'footer.tpl' %}
