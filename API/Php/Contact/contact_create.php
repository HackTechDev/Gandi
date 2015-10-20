<?php
require_once 'XML/RPC2/Client.php';

$contact_api = XML_RPC2_Client::create(
    'https://rpc.gandi.net/xmlrpc/',
    array( 'prefix' => 'contact.', 'sslverify' => False  )
);

$apikey = '<ma clé api>';

$contact_spec = [
        'given'=> '<prenom>',
        'family'=> '<nom>',
        'email'=> '<adresse électronique>',
        'streetaddr'=> '<ville>',
        'zip'=> '<code postal>',
        'city'=> '<ville>',
        'country'=> 'FR',
        'phone'=> '<numéro de téléphone>',
        'type'=> 0,
        'password'=> '<mot de passe>'
];

$result = $contact_api->__call('create', array($apikey, $contact_spec));
print_r($result);
print_r($result['handle']);
?>
