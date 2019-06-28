<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ip_address = getHostByName(getHostName());
if ($ip_address == '127.0.0.1') { $domain = 'http://localhost/api.ujikom.com/'; }
else{ $domain = 'http://'.$ip_address.'/api.ujikom.com/'; }
$config['base_api'] = $domain;
$config['facebook'] = 'https://www.facebook.com/Zigniter-ID-149520969048631/';
$config['email'] = 'hfzrmdhn17@gmail.com';
$config['author'] = 'Zigniter ID';
$config['version'] = '0.3';