--TEST--
XMLRPCext Backend XML-RPC client against userland.com getCurrentTime XMLRPC server
--SKIPIF--
<?php
if (!function_exists('xmlrpc_server_create')) {
    print "Skip XMLRPC extension unavailable";
}
if (!function_exists('curl_init')) {
    print "Skip CURL extension unavailable";
}
?>
--FILE--
<?php
set_include_path(realpath(dirname(__FILE__) . '/../../../../') . PATH_SEPARATOR . get_include_path());
require_once 'XML/RPC2/Client.php';
$options = array(
	'debug' => false,
	'backend' => 'Xmlrpcext',
	'prefix' => 'currentTime.'
);
$client = XML_RPC2_Client::create('http://time.xmlrpc.com/RPC2', $options);
$result = $client->getCurrentTime();
if (!(is_object($result))) {
	die('result is not an object !');
}
$timestamp = $result->timestamp;
if (is_numeric($timestamp)) {
	print "1\n";	
}
?>
--EXPECT--
1
