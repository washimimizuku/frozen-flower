<?xml version="1.0"  encoding="UTF-8"?>
<rss version="2.0">
  <channel>
    <title>FrozenFlower</title>
    <link>http://www.frozenflower.net</link>
    <description>Photo Feed Agregator</description>
    <ttl>30</ttl>

{section name=post loop=$posts}
    <item>
      <title><![CDATA[{$posts[post].title}]]></title>
      <link><![CDATA[{$posts[post].url}]]></link>
      <description><![CDATA[{$posts[post].description}]]></description>
      <pubDate>{$posts[post].publishDate}</pubDate>
      <guid isPermaLink="true">{$posts[post].url}</guid>
      <author><![CDATA[{$posts[post].author}]]></author>
    </item>
{/section}
  </channel>
</rss>
