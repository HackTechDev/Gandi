#!/usr/bin/python3

import xmlrpc.client
api = xmlrpc.client.ServerProxy('https://rpc.gandi.net/xmlrpc/')

apikey = '<api_key>'

images = api.hosting.image.list(apikey, {'datacenter_id': 1})
debian_images = [x for x in images if x['label'].lower().startswith('debian')]

print(debian_images)
