<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// ini merupakan file konfigurasi 
// apasaja libraries, helper yang ingin di load otomatis
// jika tidak di deklarasikan disini, maka harus load manual setiap ingin digunakan, ex : $this->load->security();
$autoload = [
	'packages' => [],
	'libraries' => ['session','database'],
	'helper' => ['url', 'security', 'cici'],
	'drivers' => [],
	'config' => [],
	'language' => [],
	'model' => []
];
