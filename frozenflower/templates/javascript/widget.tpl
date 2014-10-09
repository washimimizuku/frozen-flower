document.write('<div id="FrozenFlowerWidget">');
document.write('<h3><a href="http://www.frozenflower.net" title="FrozenFlower.net">FrozenFlower</a></h3>');
document.write('<ul>');
{section name=post loop=$posts}
document.write('<li><a href="{$posts[post].url}">{$posts[post].title}</a></li>');
{/section}
document.write('</ul>');
document.write('<p class="more"><a href="http://www.frozenflower.net" title="FrozenFlower.net">More in FrozenFlower</a></p></div>');
