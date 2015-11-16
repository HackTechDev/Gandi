#!/usr/bin/python3

import pprint
import xmlrpc.client
import sys

pp = pprint.PrettyPrinter(indent=4)

api = xmlrpc.client.ServerProxy('https://rpc.gandi.net/xmlrpc/')
apikey = '<API_KEY>'


print("*****************************************************")
print("Create an empty zone / Active zone")
print("Version 1 / Active zone")
zoneName = "mytestzone"
newZoneActive = api.domain.zone.create(apikey, {'name': zoneName})
pp.pprint(newZoneActive)

zoneid = newZoneActive['id']

print("*****************************************************")
print("Create a new zone version for modification")
print("Version: 2")
newZoneVersion = api.domain.zone.version.new(apikey, zoneid)
pp.pprint(newZoneVersion)

print("*****************************************************")
print("Record list of the new version: Before")
records = api.domain.zone.record.list(apikey, zoneid, newZoneVersion)
pp.pprint(records)


print("*****************************************************")
print("Create new record #1 for the zone #2 (not active zone)")
newRecord = api.domain.zone.record.add(apikey, zoneid, newZoneVersion, {"type" : "A", "name": "@", "value": "192.168.1.10" })
pp.pprint(newRecord)

print("*****************************************************")
print("Create new record #2 for the zone #2 (not active zone)")
newRecord = api.domain.zone.record.add(apikey, zoneid, newZoneVersion, { "type" : "CNAME", "name": "www","value": "www.monsiteamoi.net.", "ttl": 3600})
pp.pprint(newRecord)

print("*****************************************************")
print("Record list of the new version: After")
records = api.domain.zone.record.list(apikey, zoneid, newZoneVersion)
pp.pprint(records)


print("*****************************************************")
print("Create records")

records = [ { 'name': '@', 'ttl': 10800, 'type': 'A', 'value': '192.168.66.66' },
    	    { 'name': 'www', 'ttl': 3600, 'type': 'CNAME', 'value': 'www.website.com.' } ]

pp.pprint(records)

print("*****************************************************")
print("Set record for the zone #2 (not active zone)")

newRecord = api.domain.zone.record.set(apikey, zoneid, newZoneVersion, records)
pp.pprint(newRecord)

print("*****************************************************")
print("Record list of the new version: After")
records = api.domain.zone.record.list(apikey, zoneid, newZoneVersion)
pp.pprint(records)

print("*****************************************************")
sys.exit(0)
