document.write('<div id="FrozenFlowerWidget">');
document.write('<h3><a href="http://www.frozenflower.net" title="FrozenFlower.net">FrozenFlower</a></h3>');
document.write('<ul>');
{% for item in item_list %}
document.write('<li><a href="{{item.url}}">{{item.title}}</a></li>');
{% endfor %}
document.write('</ul>');
document.write('<p class="more"><a href="http://www.frozenflower.net" title="FrozenFlower.net">More in FrozenFlower</a></p></div>');
