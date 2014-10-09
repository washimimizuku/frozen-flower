<?xml version="1.0"  encoding="UTF-8"?>
<rss version="2.0">
  <channel>
    <title>FrozenFlower Blog</title>
    <link>http://www.frozenflower.net</link>
    <description>FrozenFlower oficial blog</description>
    <ttl>30</ttl>

{section name=post loop=$posts}
    <item>
      <title><![CDATA[{$posts[post].title}]]></title>
      <link>http://frozenflower.net/blog/article.php?id={$posts[post].id}</link>
      <description><![CDATA[{$posts[post].text}]]></description>
      <pubDate>{$posts[post].creationDate}</pubDate>
      <guid isPermaLink="true">http://frozenflower.net/blog/article.php?id={$posts[post].id}</guid>
      <!--author></author-->
      <!--category></category-->
    </item>
{/section}
  </channel>
</rss>
