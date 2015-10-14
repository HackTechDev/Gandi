<?php
require_once 'XML/RPC2/Client.php';

$apikey = '<api_key>';

// Image available list
$api_hosting = XML_RPC2_Client::create(
    'https://rpc.gandi.net/xmlrpc/',
    array( 'prefix' => 'hosting.image.', 'sslverify' => False )
);

$result = $api_hosting->list($apikey);
print_r($result);

?>
