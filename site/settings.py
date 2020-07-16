import django_heroku

DEBUG = True
ALLOWED_HOSTS = []

django_heroku.settings(locals())