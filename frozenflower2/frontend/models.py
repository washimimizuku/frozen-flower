from django.db import models

# Create your models here.
class Tag (models.Model):
   name = models.CharField(max_length=255)

   def __unicode__(self):
      return self.name
   
   class Meta:
      ordering = ['name']

class Article (models.Model):
   title = models.CharField(max_length=255)
   text = models.TextField()
   creationDate = models.DateTimeField(auto_now_add=True, blank=True, null=True)
   active = models.BooleanField()
   tag = models.ManyToManyField(Tag)

   def __unicode__(self):
      return self.title
   
   class Meta:
      ordering = ['creationDate']

class Comment (models.Model):
   title = models.CharField(max_length=255)
   text = models.TextField()
   name = models.CharField(max_length=255, blank=True, null=True)
   email = models.EmailField()
   link = models.CharField(max_length=255, blank=True, null=True)
   creationDate = models.DateTimeField(auto_now_add=True)
   active = models.BooleanField()
   article = models.ForeignKey(Article)

   def __unicode__(self):
      return self.title
   
   class Meta:
      ordering = ['creationDate']

class Feed (models.Model):
   title = models.CharField(max_length=255)
   description = models.TextField()
   siteUrl = models.CharField(max_length=255)
   feedUrl = models.CharField(max_length=255)
   language = models.CharField(max_length=255, blank=True, null=True)
   publishDate = models.DateTimeField(blank=True, null=True)
   lastBuildDate = models.DateTimeField(blank=True, null=True)
   author = models.CharField(max_length=255, blank=True, null=True)
   ttl = models.IntegerField(blank=True, null=True)
   active = models.BooleanField()
   approved = models.BooleanField()

   def __unicode__(self):
      return self.title
   
   class Meta:
      ordering = ['title']

class Repository (models.Model):
   title = models.CharField(max_length=255)
   description = models.TextField()
   url = models.CharField(max_length=255)
   publishDate = models.DateTimeField(blank=True, null=True)
   author = models.CharField(max_length=255, blank=True, null=True)
   guid = models.CharField(max_length=255, blank=True, null=True)
   tag = models.ManyToManyField(Tag)
   feed = models.ForeignKey(Feed)

   def __unicode__(self):
      return self.title
   
   class Meta:
      ordering = ['-publishDate']
