<?php
// Library installed from PEAR
require_once 'XML/RPC2/Client.php';

$domain_api = XML_RPC2_Client::create(
    'https://rpc.gandi.net/xmlrpc/',
    array( 'prefix' => 'domain.zone.', 'sslverify' => False  )
);

$apikey = '<api_key>';

$result = $domain_api->list($apikey);
print_r($result);
?>
