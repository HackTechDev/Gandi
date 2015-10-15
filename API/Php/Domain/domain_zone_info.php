<?php
require_once 'XML/RPC2/Client.php';

$domain_api = XML_RPC2_Client::create(
    'https://rpc.gandi.net/xmlrpc/',
    array( 'prefix' => 'domain.zone.', 'sslverify' => False  )
);

$apikey = '<api_key>';

$zone_id = 1696666;

$result = $domain_api->info($apikey, $zone_id);
print_r($result);
?>
