from django.conf.urls.defaults import *

from frozenflower.frontend.views import *

from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
   # Example:
   # (r'^frozenflower/', include('frozenflower.foo.urls')),
   ('^hello/$', hello),

   ('^$', home),
   ('^page/(?P<page>\d+)/$', home),
   ('^page/(?P<page>\d+)/history/(?P<year>\d+)/(?P<month>\d+)$', home),
   ('^page/(?P<page>\d+)/tag/(?P<tag>.+)/$', home),
   ('^history/(?P<year>\d+)/(?P<month>\d+)/$', home),
   ('^tag/(?P<tag>.+)/$', home),
   ('^rss/$', homeRSS),

   ('^photographers/$', photographers),
   ('^about/$', about),
   ('^widgets/$', widgets),
   ('^javascript/ffwidget.js$', jswidget),

   #('^blog/$', blogHome),
   #('^blog/article/(\w+)/$', blogArticle),
   #('^blog/tag/(\w+)/$', blogTag),
   #('^blog/rss/$', blogRSS),

   # Admin
   (r'^admin/doc/', include('django.contrib.admindocs.urls')),
   (r'^admin/(.*)', admin.site.root),

   # Media Files
   #(r'^static/(?P<path>.*)$', 'django.views.static.serve', {'document_root': '/var/local/django/frozenflower/frontend/static'}),
   (r'^static/(?P<path>.*)$', 'django.views.static.serve', {'document_root': '/Users/nbarr/Sites/djcode/frozenflower/frontend/static'}),
)
