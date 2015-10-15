<?php
// Library installed from PEAR
require_once 'XML/RPC2/Client.php';

$domain_api = XML_RPC2_Client::create(
    'https://rpc.gandi.net/xmlrpc/',
    array( 'prefix' => 'domain.host.', 'sslverify' => False  )
);

$apikey = '<api_key>';

$result = $domain_api->list($apikey, 'espace-bidouilleur.fr');
print_r($result);
$result = $domain_api->count($apikey, 'espace-bidouilleur.fr');
print_r($result);
$result = $domain_api->info($apikey, 'espace-bidouilleur.fr');
print_r($result);

?>
