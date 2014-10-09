from datetime import *
from time import *

from django.template.loader import get_template
from django.template import Context
from django.http import HttpResponse
from django.core.paginator import Paginator

from frozenflower.frontend.models import *

def hello(request):
   return HttpResponse("Hello world")

def home(request, page=1, year=0, month=0, tag=''):
   monthNames = [""]
   for i in range(1,13):
      monthNames.append(datetime.date(datetime(2008, i, 1)).strftime('%B'))
      
   t = get_template('index.tpl')

   if tag != '':
      tagObject = Tag.objects.get(name=tag)
      repositoryList = tagObject.repository_set.all()
   else:   
      if month > 0:
         repositoryList = Repository.objects.filter(publishDate__year = year).filter(publishDate__month = month).order_by('-publishDate')
      else:
         repositoryList = Repository.objects.order_by('-publishDate')
         
   p = Paginator(repositoryList, 20)
   itemList = p.page(page)
   
   feedList = Feed.objects.order_by('title')
   
   datesList = Repository.objects.dates('publishDate','month', order='DESC')
   
   historyList = []
   for date in datesList:
      historyList.append({'month': date.month,
                           'year': date.year,
                           'text': monthNames[date.month] + " " + str(date.year)})
   
   html = t.render(Context({'title': 'FrozenFlower - Homepage',
                            'item_list': itemList,
                            'feed_list': feedList,
                            'history_list': historyList,
                            'month': month,
                            'year': year}))
   return HttpResponse(html)

def photographers(request):
   t = get_template('photographers.tpl')
   
   feedList = Feed.objects.order_by('title')
   
   html = t.render(Context({'title': 'FrozenFlower - Photographers',
                            'feed_list': feedList}))
   return HttpResponse(html)

def widgets(request):
   t = get_template('widget.tpl')
   html = t.render(Context({'title': 'FrozenFlower - Widgets'}))
   return HttpResponse(html)

def jswidget(request):
   t = get_template('javascript/widget.tpl')
   
   repositoryList = Repository.objects.order_by('-publishDate')[0:10]
   
   html = t.render(Context({'item_list': repositoryList}))
   return HttpResponse(html)

def about(request):
   t = get_template('about.tpl')
   html = t.render(Context({'title': 'FrozenFlower - About Us'}))
   return HttpResponse(html)

def homeRSS(request):
   t = get_template('rss.tpl')
   
   repositoryList = Repository.objects.order_by('-publishDate')[0:20]
   
   html = t.render(Context({'item_list': repositoryList}))
   return HttpResponse(html)














