<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
$route = [
	'default_controller' => 'Frontend',
	'login' => 'Frontend/login',
	'newpassword/(:any)' => 'Frontend/newpassword/$1',
	'404_override' => '',
	'dashboard' => 'Backend',
	'departement' => 'Backend/departement',
	'divisi' => 'Backend/divisi',
	'jabatan' => 'Backend/jabatan',
	'user' => 'Backend/user',
	'karyawan' => 'Backend/karyawan',
	'akun' => 'Backend/akun',
	'kas_keluar' => 'Backend/kaskeluar',
	'jurnal' => 'Backend/jurnal',
	'perbulan' => 'Backend/perbulan',
	'periode' => 'Backend/periode',
	'riwayatlogin' => 'Backend/riwayatlogin',
	'logaktivitas' => 'Backend/logaktivitas',
	'logout' => 'Backend/logout',
	'backupdatabase' => 'Backend/backupdatabase',
	'backupaplikasi' => 'Backend/backupaplikasi',
];
