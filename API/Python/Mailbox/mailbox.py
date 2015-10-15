#!/usr/bin/python3

import xmlrpc.client

api = xmlrpc.client.ServerProxy('https://rpc.gandi.net/xmlrpc/')
apikey = '<api_key>'
domainname = 'espace-bidouilleur.fr'

print("************************************")
print("Api version")

version = api.version.info(apikey)
print(version)

print("************************************")
print("Domain info")

domain = api.domain.info(apikey, domainname)
print(domain)

print("************************************")
print("Mailbox info")
nbEmail = api.domain.mailbox.count(apikey, domainname)

print(nbEmail)

print("Mailbox create")

userEmail = '<mon_nom>'
userEmailPassword = '<mon_mot_de_passe>'

createEmail = api.domain.mailbox.create(apikey, domainname, userEmail, {'password': userEmailPassword})

print("Mailbox alias create")

userEmailAlias = '<email_alias>'
createEmail = api.domain.mailbox.alias.set(apikey, domainname, userEmail, [userEmailAlias])

print("Mailbox alias create")

userOtherEmail = '<forwarding_email>'
createEmailForward = api.domain.forward.create(apikey, domainname, userEmail, {'destinations' : [userOtherEmail,] })

