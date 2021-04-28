#! /usr/bin/python
# -*- coding: utf-8 -*-

#import sys
#sys.setdefaultencoding('utf-8')

import feedparser
import MySQLdb
import re

db = MySQLdb.connect(host='localhost', user='frozenflower', passwd='frozenflower', db='frozenflower')
entryCursor = db.cursor()
feedCursor = db.cursor()
feedCursor.execute('SELECT id, feedUrl, title, author FROM feed where active=1')

result = feedCursor.fetchall()

for record in result:
   feedID = record[0]
   feedUrl = record[1]
   print record[2]
   feedAuthor = record[3]

   feedparser.USER_AGENT = "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6 +http://frozenflower.net"
   feed = feedparser.parse(feedUrl)

   length = len(feed.entries)

   if length:
      time = feed.entries[length-1].updated_parsed
      time = MySQLdb.Timestamp(time[0], time[1], time[2], time[3], time[4], time[5])
      entryCursor.execute("delete from repository where feedID = %s and publishDate >= subtime(%s, '00:00:00')",
                           [feedID, time])

      time = feed.entries[0].updated_parsed
      time = MySQLdb.Timestamp(time[0], time[1], time[2], time[3], time[4], time[5])
      entryCursor.execute("delete from repository where feedID = %s and publishDate >= subtime(%s, '00:00:00')",
                        [feedID, time])

      for entry in feed.entries:
         if (entry.title == ''):
            entry.title = '[no title]'
         print '  '+str(entry.title)

         time = ""
         if hasattr(entry, 'published_parsed'):
            time = entry.published_parsed
         else:
            time = entry.updated_parsed
         time = MySQLdb.Timestamp(time[0], time[1], time[2], time[3], time[4], time[5])

         category = ''
         if hasattr(entry, 'tags'):
            category = ', '.join([str(tag.term) for tag in entry.tags])

         author = ''
         if hasattr(entry, 'author'):
            author = entry.author
         else:
            author = feedAuthor

         description = ''
         if hasattr(entry, 'content'):
            description = entry.content[0].value
         else:
            description = entry.description
         #print str(description)

         guid = ''
         if hasattr(entry, 'guid'):
            guid = entry.guid
         else:
            guid = entry.link

         if description.find('<img') >= 0:
            description = re.sub('height="\d+"', '', description)
            description = re.sub('width="\d+"', '', description)
            
            description = re.sub('<table', '<!--table', description)
            description = re.sub('</table>', '<table-->', description)
            description = re.sub('<img.*</img>', '', description)
            description = re.sub('<img src="http://feeds.feedburner.com.* />', '', description)

            description = re.sub('<div.*>', '', description)
            description = re.sub('</div>', '', description)
            #description = re.sub('<br.*>', '', description)
            
            description = re.sub('.flickr.*}\n', '', description)

            if hasattr(entry, 'enclosures'):
               description = re.sub('<img.*/>', '', description)
               description = '<img src="'+entry.enclosures[0].href+'" /><br />'+description

            try:
               entryCursor.execute("insert into repository (feedID, title, url, description, publishDate, author, category, guid) values (%s,%s,%s,%s,%s,%s,%s,%s)",
                                   [feedID, str(entry.title), str(entry.link), str(description), str(time), str(author), str(category), str(guid)])
            except UnicodeEncodeError:
               print '    UnicodeEncodeError'
            except MySQLdb.IntegrityError, err:
               print '    IntegrityError: '+str(err)



entryCursor.close
feedCursor.close
db.close
