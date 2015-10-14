<?php
require_once 'XML/RPC2/Client.php';

$apikey = '<api_key>';

// Mailbox

$apiMailbox = XML_RPC2_Client::create(
    'https://rpc.gandi.net/xmlrpc/',
    array( 'prefix' => 'domain.mailbox.', 'sslverify' => False )
);

$result = $apiMailbox->count($apikey, '<domain_name>');
print_r($result);


?>
