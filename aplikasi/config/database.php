<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// type is => local or live.
// ini merupakan konfigurasi database
$type	= 'local';
$active_group = $type;
$query_builder = TRUE;
if ($type === "local") {
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "";
}else{
	// ini kondisi ketika website sudah dihosting
	// maka diatas isi dengan live atau bukan local
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database =	"";
}

$db[$type] = array(
	'dsn'	=> '',
	'hostname' => $hostname,
	'username' => $username,
	'password' => $password,
	'database' => $database,
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
