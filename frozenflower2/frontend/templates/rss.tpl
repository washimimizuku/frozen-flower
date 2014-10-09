<?xml version="1.0"  encoding="UTF-8"?>
<rss version="2.0">
  <channel>
    <title>FrozenFlower</title>
    <link>http://www.frozenflower.net</link>
    <description>Photo Feed Agregator</description>
    <ttl>30</ttl>
{% for item in item_list %}
    <item>
{% autoescape off %}
      <title><![CDATA[{{ item.title }}]]></title>
      <link><![CDATA[{{item.url}}]]></link>
      <description><![CDATA[{{item.description}}]]></description>
      <pubDate>{{item.publishDate}}</pubDate>
      <guid isPermaLink="true">{{item.url}}</guid>
      <author><![CDATA[{{item.author}}]]></author>
{% endautoescape %}
    </item>
{% endfor %}
  </channel>
</rss>
