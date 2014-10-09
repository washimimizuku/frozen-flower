{% include 'header.tpl' %}
		<div id="center">
         <div class="article">
            <div class="title">Photographers</div>
            <div class="text">
{% for feed in feed_list %}
				   <h2><a href="{{feed.siteUrl}}">{{feed.title}}</a> <a href="{{feed.feedUrl}}"><img src="/static/images/feed.gif" border="0" alt="Syndicate feed" /></a></h2>
				   <p>{{feed.description}}</p>
{% endfor %}
            </div>
            <div class="title">Map</div>
            <div class="text">
<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;hl=en&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=http:%2F%2Ftoomanylights.com%2Fplaces.kml&amp;ie=UTF8&amp;om=1&amp;ll=46.223459,-32.482235&amp;spn=14.935975,93.806329&amp;output=embed&amp;s=AARTsJoi9IGSdgG8VCDRkNIj299F6DtxcA"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;hl=en&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=http:%2F%2Ftoomanylights.com%2Fplaces.kml&amp;ie=UTF8&amp;om=1&amp;ll=46.223459,-32.482235&amp;spn=14.935975,93.806329&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>
            </div>
         </div>
      </div>
{% include 'right.tpl' %}
{% include 'footer.tpl' %}
