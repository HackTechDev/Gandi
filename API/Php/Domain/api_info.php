<?php
require_once 'XML/RPC2/Client.php';

$version_api = XML_RPC2_Client::create(
    'https://rpc.gandi.net/xmlrpc/',
    array( 'prefix' => 'version.', 'sslverify' => False )
);

$apikey = '<api_key>';

$result = $version_api->info($apikey);

print_r($result);
?>
