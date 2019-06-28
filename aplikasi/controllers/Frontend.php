<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/SQL.php';
// SQL.php merupakan Controllers yang saya buat 
// Untuk Manipulasi data, digunakan dengan menggunakan command : "$this->function_name (buka core/SQL.php)"

class Frontend extends SQL {

	function __construct(){
		parent::__construct();
		// setheader() merupakan helper yang terletak pada helpers/cici_helper.php
		// fungsinya sbg security pada header server
		setheader();
		// ini merupakan validasi, is_logged_in sama seperti setheader(), merupakan helper.
		// jika sudah login, redirect ke dashboard
		if (is_logged_in())
			redirect('dashboard');
	}
	function index(){
		$this->load->view('frontend/index');
	}
	function next(){
		$this->load->view('frontend/next');
	}
	function proccessLogin(){
		// isajax merupakan, filterisasi Request
		// jika request datangnya berasal dari ajax, maka di izinkan,
		// jika tidak, maka akan ditolak.
		// FYI, seluruh process baik simpan, update, delete, show, menggunakan ajax.
		isajax();
		$username = post('username');
		$password = post('password');
		// jika username tidak terdapat kata-kata selain huruf dan angka,
		// maka akan masuk ke proses selanjutnya
		if(preg_match("/^[a-z A-Z0-9]*$/", $username)){
			$checkUsername = query("SELECT username, email, nama FROM user WHERE username='$username' or email='$username' or nama='$username' AND is_deleted IS NULL");
			$dataUsername = $checkUsername->row();
				// jika username ditemukan, dan tidak aktif atau belum ada yang login.
				$usernameAvailable = $checkUsername->num_rows();
				if ($usernameAvailable) {
					// maka check password
					$validatePassword = query("SELECT  k.*, d.id as id_departement, d.departement, j.id as id_jabatan, j.jabatan FROM user k  INNER JOIN departement d ON k.id_departement = d.id INNER JOIN jabatan j ON k.id_jabatan = j.id WHERE k.username='$username' or k.email='$username' or k.nama='$username' AND k.katasandi='$password'");
					$dataFinal = $validatePassword->row();
					// verifikasi password dengan function dari codeigniter. (password_verify) 
					$verifyPasswordDefault = password_verify($password, $dataFinal->katasandi);
					if ($verifyPasswordDefault) {
						// detect devices
						$this->load->library('user_agent');
						if($this->agent->is_browser()){ 
							$agent = $this->agent->browser();
							$version = $this->agent->version();
						}elseif ($this->agent->is_robot()){ 
							$agent = $this->agent->robot();
							$version = 'is robot';
						}elseif ($this->agent->is_mobile()){ 
							$agent = $this->agent->mobile();
							$version = 'is mobile';
						}else{ 
							$agent = 'Tidak Teridentifikasi User Agent'; 
							$version ='unknown';
						}
						// buat session atau sessi dalam array
						$session = [ 
		      				'status' => true,
		      				'last_visited' => time(),
		      				'siapa' => $dataFinal->nama,
		      				'email' => $dataFinal->email,
		      				'telepon' => $dataFinal->telepon,
		      				'file' => $dataFinal->file,
		      				'id_departement' => $dataFinal->id_departement,
		      				'departement' => $dataFinal->departement,
		      				'id_jabatan' => $dataFinal->id_jabatan,
		      				'jabatan' => $dataFinal->jabatan,
		      				'user_id' => $dataFinal->id
		      			];
			      		$this->session->set_userdata($session);	
			      		
			      		$information = 'login ke dalam aplikasi dengan browser '.$agent. ', IP Address : '.$this->input->ip_address(). ' dan Operating System '.$this->agent->platform();
			      		// simpan informasi pengguna kedalam database ($this->save_activity - SQL.php)
						$this->save_activity($information, '', 'login');
							$data = [
								'last_login' => date('d-M-y H:i:s'),
								'os' => $this->agent->platform(),
								'ip_address' => $this->input->ip_address(),
								'browser' => $agent,
								'version' => $version,
								'id_user' => $dataFinal->id
							];
							$this->writehistory($data);
						JSON($response);
					}else{
						$response = $this->responses(false, 500, 'Kata sandi yang anda masukan salah');
						JSON($response);
					}
				}else{
					$response = $this->responses(false, 500, 'username yang anda masukan salah');
				}
			
			JSON($response);
		}else{
			$response = $this->responses(false, 500, 'Karakter yang anda masukan dilarang!');
		}
		JSON($response);
	}
	function writehistory($data){
		$simpan = $this->db->insert('riwayatlogin', $data);
		if ($simpan) {
			$response = $this->responses(true, 200, 'History 1');
			JSON($response);
		}
	}
	function proccessDaftar(){
	}

	function resetPassword(){
		isajax();
		// check internet
		if (check_internet_connection()) {
			$email = post('email');
			$checkMail = query("SELECT id, nama, email FROM user WHERE email='$email'");
			if ($checkMail->num_rows() > 0) {
				$dataUser = $checkMail->row();
				$title = '';
				$subject = 'Instruksi Untuk Mereset Kata Sandi';
				$email = $dataUser->email;
				$token = base64_encode($dataUser->id);
				$stringURL = site_url('newpassword/'.$token);
				$buttonReset = '<center>
	                                <a href="'.$stringURL.'" style="text-decoration: none; color: #fff !important; text-align: center;-webkit-transition:.2s ease-out; transition:.2s ease-out; cursor: pointer;font-size:1rem;outline:0; border: none; border-radius: 2px; display: inline-block;height:36px;line-height:36px;padding:0 2rem;-webkit-tap-highlight-color:transparent;background-color:#2196F3 !important;font-weight:bold;">Reset Kata Sandi</a>
	                            </center>';
				$masterMessage = '<!DOCTYPE html>
									<html lang="id-ID">
										<head>
										  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
										  <meta name="HandheldFriendly" content="true"/>
										  <meta name="MobileOptimized" content="320"/>
										  <meta content="yes" name="apple-mobile-web-app-capable"/>
										  <meta content="#263544" name="theme-color"/>
										  <meta content="#263544" name="apple-mobile-web-app-status-bar-style"/>
										  <meta content="true" name="MSSmartTagsPreventParsing"/>
										  <!--[if lt IE 9]>
										    <link href="https://oss.maxcdn.com" rel="dns-prefetch"/>
										    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
										    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
										  <![endif]-->
										</head>
										<body>
											<div style="margin: auto; width: auto; padding: 10px;">
												<b><h2>Security File Manager</h2></b><hr>
												<p style="font-size: 18px; padding: 0; margin: 10px 0 10px 0; color: #565a5c;">
													Hai, '.$dataUser->nama.',<br><br> 
													Kami mendapat permintaan untuk mereset kata sandi akun File Manager Anda. <br><br>'.$buttonReset.'
													<br> <br>
												</p>
												<div style="color: #abadae; font-size: 12px; margin: 0 auto 5px auto;"></br>
													<small>@ Filemanager. Jl. BDN II No.22, RT.2/RW.11, Cilandak Bar., Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12430. Pesan ini ditujukan ke '.$dataUser->email.'</small>
												</div>
											</div>
										</body>
									</html>';
				$this->sendmail($title, $subject, $email, $masterMessage);
			}else{
				$response = [
					'success' => false,
					'code'    => 500,
					'msg'     => 'Email anda tidak terdaftar pada database kami'
				];
				JSON($response);
			}	
		}else{
			$response = [
				'success' => false,
				'msg'	  => 'No internet connection.'
			];
			JSON($response);
		}
	}
	function sendmail($title, $subject, $email, $message, $attach = ''){
		$config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'hfzrmd@gmail.com',
            'smtp_pass' => PASSWORD_GMAIL,
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE
        ];
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('security@filemanager.net.id', $title);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($attach !== '') {
			$this->email->attach($attach);
        }
        $send = $this->email->send();
        if ($send) {
            $response = [
                'success' => true
            ];
        }else{
            $response = [
                'success' => false
            ];
            echo $this->email->print_debugger(); 
        }
        JSON($response);
	}
	function newpassword($token){
		$tokenDecrypt = base64_decode($token);
		$id = $tokenDecrypt;
		$checkID	= where("id", $id);
		$checkID 	= minta('user');
		if ($checkID->num_rows() > 0) {
			$this->load->view('frontend/newpassword');
		}else{
			redirect(site_url());
		}
	}
	function resetKataSandiById(){
		isajax();
		$id = post('id');
		$katasandi = post('confirmnewpassword');
		$convertKatasandi = password_hash($katasandi, PASSWORD_BCRYPT);
		$data = [
			'katasandi' => $convertKatasandi
		];
		$update = where('id', $id);
		$update = update('user', $data);
		if ($update) {
			$response = [
				'status' => true,
				'code'   => 200
			];
			$this->sendNotif($id);
		}else{
			$response = [
				'status' => false,
				'code'   => 500
			];
			JSON($response);
		}
	}
	function sendNotif($id){
		$getEmail = where("id", $id);
		$getEmail = minta("user");
		$data = $getEmail->row();
		$message = 'Sandi untuk akun File Manager dengan alamat email '.$data->email.' telah diubah';
		$this->sendmail('Pemberitahuan', 'Pemberitahuan Keamanan Penting', $data->email, $message);
	}
}