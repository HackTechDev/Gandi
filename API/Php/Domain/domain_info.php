<?php
require_once 'XML/RPC2/Client.php';

$domain_api = XML_RPC2_Client::create(
    'https://rpc.gandi.net/xmlrpc/',
    array( 'prefix' => 'domain.', 'sslverify' => False  )
);

$apikey = '<api_key>';

$domain_name = "espace-bidouilleur.fr";

$result = $domain_api->info($apikey, $domain_name);
print_r($result);
?>
