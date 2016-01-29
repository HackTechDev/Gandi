#!/usr/bin/python3

import sys
import pprint
import xmlrpc.client

pp = pprint.PrettyPrinter(indent=4)

# Production env
api = xmlrpc.client.ServerProxy('https://rpc.gandi.net/xmlrpc/')
apikey = 'API_KEY'

'''
datacenterid 
1 = Paris (France)
2 = Baltimore (USA)
3 = Bissen (Datacenter
'''

print("************************************")
print("Create PaaS ")

paas_spec = {
    'datacenter_id': 1,
    'duration': '1m',
    'name': 'HebergementPhpMysql',
    'password': 'mot2passe',
    'size': 's',
    'type': 'phpmysql',
    }

ops = api.paas.create(apikey, paas_spec)

print("operation #1")
pp.pprint(ops[0]['type'])

print("operation #2")
pp.pprint(ops[1]['type'])

print("operation #3")
pp.pprint(ops[2]['type'])

sys.exit(0)
