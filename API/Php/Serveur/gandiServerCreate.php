<?php
require_once 'XML/RPC2/Client.php';

function generateRandomName($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


$hosting_api = XML_RPC2_Client::create(
    'https://rpc.gandi.net/xmlrpc/',
    array( 'prefix' => 'hosting.', 'sslverify' => False  )
);

define('API_KEY', '<API KEY>');

// Gandi credit

$result = $hosting_api->__call('account.info', array(API_KEY));
print_r($result['rating_enabled']);


// Datacenter

$result = $hosting_api->__call('datacenter.list', array(API_KEY));
//print_r($result);

$dc_id = $result[0]['id'];
echo $dc_id;


// Operating system image

$datacenter_spec = [
	'datacenter_id'=> 1,
];

$result = $hosting_api->__call('image.list', array(API_KEY, $datacenter_spec));
print_r($result);

// 19 = Debian 8 64 bits (HVM)
// 20 = Ubuntu 14.04 64 bits LTS (HVM)

$distribution_id = 19;

$src_disk_id = $result[$distribution_id]['disk_id'];
echo $src_disk_id;


// VM creation



$vmName = generateRandomName();
$cpu = 1;
$ram = 2;
$login = 'adminvm';
$password = "pa55wOrd";

//$run = 'touch /fakefile.txt ';
$run = 'touch /home/' . $login . '/fakefile.txt';


$disc_spec = [
   'datacenter_id' => $dc_id,
   'name' => $vmName, 
];


$vm_spec = [
   'datacenter_id' => $dc_id,
   'cores' => $cpu,
   'memory' => $ram * 1024,
   'hostname' => $vmName,
   'login' => $login,
   'password' => $password,
   'run' => $run,
];


$result = $hosting_api->__call('vm.create_from', array(API_KEY, $vm_spec, $disc_spec, $src_disk_id ));
print_r($result);

// VM info

// Get this info from the previous command
$vm_id = $result[2]['vm_id'];

$result = $hosting_api->__call('vm.info', array(API_KEY, $vm_id ));
print_r($result);

// Log in the new system
// Get ip v4 address from the previous result

$ip = $result['ifaces'][0]['ips'][0]['ip'];
echo "ssh adminvm@" . $ip;


?>
