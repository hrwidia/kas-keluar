<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
 	
 	public function __construct(){ 
 		parent::__construct(); 
 		date_default_timezone_set('Asia/Jakarta');
 	}

 	public function responses($status = null, $code = 200, $msg = "Message is null."){
 		$data = [
 			'status' => $status,
 			'code'   => $code,
 			'msg'    => $msg
 		];
 		return $data;
 	}

 	function save_activity($aksi, $detail = null, $kategori){
 		$siapa = session('siapa');
 		$date = date('Y-m-d H:i:s');
 		if ($siapa) {
	 		$data  = [
	 			'nama' => $siapa,
	 			// 'departement' => session('departement'),
	 			'divisi' => session('divisi'),
	 			'jabatan' => session('jabatan'),
	 			'tanggal' => $date,
	 			'kategori' => $kategori,
	 			'log' => 'Berhasil '.$aksi.' '.$detail
	 		];
	 		$simpan = simpan('log', $data);
 		}else{
 			$responses = $this->responses(false, 500, 'Session belum terdeteksi');
 			JSON($responses);
 		}
 	}
 	public function simpan($data = [], $tablename){
 		isajax();
 		$session_jabatan = session('jabatan');
 		if ($session_jabatan === "Admin") {
 			$fieldname = key($data);
	 		foreach ($data as $key => $value){
			    if (is_array($value)){
			      $data[$key] = $this->array_values_recursive($value);
			    }
			  }
			  $check = query("SELECT $fieldname FROM $tablename WHERE $fieldname='$data[$key]' and is_deleted IS NULL");
	 		if ($check->num_rows() > 0) {
	 			$responses = $this->responses(false, 500, 'Data sudah tersedia.');
	 		}else{
	 			$simpan = simpan($tablename, $data);
		 		if ($simpan) {
		 			$responses = $this->responses(true, 200, 'Berhasil menyimpan data '.$tablename);
		 			$this->save_activity('menyimpan data', $tablename, 'menyimpan');
		 		}else{
		 			$responses = $this->responses(false, 500, 'Gagal menyimpan data '.$tablename);
		 		}	
	 		}
 		}else{
 			$responses = $this->responses(false, 500, 'Anda tidak di izinkan menyimpan data');
 		}
	 	JSON($responses);
 	}

 	public function update($id, $data = [], $tablename){
 		isajax();
 		$session_jabatan = session('jabatan');
 		if ($session_jabatan === "Admin") {
	 		$update = where('id', $id);
	 		$update = update($tablename, $data);
	 		if ($update) {
	 			$responses = $this->responses(true, 200, 'Berhasil memperbarui data '.$tablename);
	 			$this->save_activity('memperbarui data', ''.$tablename.' dengan ID : '.$id, 'memperbarui');
	 		}else{
	 			$responses = $this->responses(false, 500, 'Gagal memperbarui data '.$tablename);
	 		}
 		}else{
 			$responses = $this->responses(false, 500, 'Anda tidak di izinkan mengubah data');
 		}
 		JSON($responses);
 	}
 	public function soft_delete($id, $tablename){
 		isajax();
 		$session_jabatan = session('jabatan');
 		if ($session_jabatan === "Admin") {
 			$soft = where('id', $id);
	 		$data = [
	 			'is_deleted' => 1
	 		];
	 		$soft = update($tablename, $data);
	 		if ($soft) {
	 			$responses = $this->responses(true, 200, 'Berhasil menghapus data '.$tablename);
	 			$this->save_activity('menghapus data', ''.$tablename.' dengan ID : '.$id, 'menghapus');
	 		}else{
	 			$responses = $this->responses(false, 500, 'Gagal menghapus data '.$tablename);
	 		}
 		}else{
 			$responses = $this->responses(false, 500, 'Anda tidak di izinkan menghapus data');
 		}
 		JSON($responses);
 	}
	public function get_by_id($id, $tablename){
		notget();
		isajax();
		$session_jabatan = session('jabatan');
		if ($session_jabatan === "Admin") {
			if ($id === "") {
				$responses = $this->responses(false, 500, 'ID masih kosong');
				JSON($responses);
			}else if ($tablename === "") {
				$responses = $this->responses(false, 500, 'Table name masih kosong');
				JSON($responses);
			}else{
				$minta_data_by_id = where('id', $id);
				$minta_data_by_id = minta($tablename);
				if ($minta_data_by_id) {
					JSON($minta_data_by_id->row());
				}			
			}
		}else{
 			$responses = $this->responses(false, 500, 'Anda tidak di izinkan mengambil data');
 			JSON($responses);
 		}
	}
	public function unggah($id, $path, $tablename){
		notget();
		isajax();
		$session_jabatan = session('jabatan');
		if ($session_jabatan === "Admin") {
			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}else{
				$config = [
					'upload_path'     => './'.$path,
					'allowed_types'   => "gif|jpg|jpeg|png|pdf|xls|xlsx|doc|docx|ppt|pptx|ppsx|zip",
					'encrypt_name' 	  => TRUE,
					'remove_spaces'   => TRUE,
					'detect_mime'     => TRUE,
					'mod_mime_fix'    => TRUE,
					'file_ext_tolower' => TRUE,
					'max_filename_increment' => 1000
				];
				$this->load->library('upload', $config);
				if ($this->upload->do_upload(('file'))) {
					 $result = $this->upload->data();
					 $file = $result['file_name'];
					 $size = $result['file_size'];
					 $is_image = $result['is_image'];
					 $ext = $result['file_ext'];
					 $field = [
						'file' => $file,
						'size' => $size,
						'ext' => $ext
					];
					if ($result) {
						// check file is avail ? 
						$check = query("SELECT * FROM $tablename WHERE is_deleted IS NULL");
						if ($check->num_rows() > 0) {
							$update = where('id', $id);
				 			$update = update($tablename, $field);
				 			if ($update) {
				 					$responses = $this->responses(true, 200, 'Terima kasih, file berhasil diupload :)');
				 						$this->save_activity('mengupload data', ''.$tablename.' dengan ID : '.$id, 'mengupload');
								}else{
									$responses = $this->responses(false, 500, 'Maaf, File gagal diupload');
								}
								JSON($responses);	
						}else{
							// this is for tanda terima surat - relation 
							$field['id_surat'] = $id;
							$simpan = $this->simpan($field, $tablename);
							if ($simpan) {
								$responses = $this->responses(true, 200, 'Berhasil menyimpan data :)');
							}else{
								$responses = $this->responses(false, 500, 'Gagal menyimpan data :(');
							}
							JSON($responses);
						}
					}
				}else{
					$error = $this->upload->display_errors();
					if ($error === "<p>The file you are attempting to upload is larger than the permitted size.</p>") {
						$msg = 'File terlalu besar';
						$responses = ['status' => false, 'code'   => 500, 'msg'    => $msg, 'id'	 => $id ]; 
						JSON($responses);
					}else if ($error === "<p>The filetype you are attempting to upload is not allowed.</p>") {
						$msg = 'Jenis file tidak mendukung';
						$responses = ['status' => false, 'code'   => 500, 'msg'    => $msg, 'id'     => $id ]; 
						JSON($responses);
					}else{
						print_r($error); die();
					}
				}
			}
		}else{
			$responses = $this->responses(false, 500, 'Anda tidak di izinkan menggunggah data');
 			JSON($responses);
		}
		
	}
	public function sendmail($title, $subject, $email, $message, $attach = ''){
		$config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'hfzrmd@gmail.com',
            'smtp_pass' => PASSWORD_GMAIL,
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'priority'  => '1',
            'wordwrap'  => TRUE
        ];
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('noreply@filemanager.net.id', $title);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($attach !== '') {
			$this->email->attach($attach);
        }
        $send = $this->email->send();
        if ($send) {
        	$responses = $this->responses(true, 200, 'Berhasil mengirim email');
			$this->save_activity('mengirim email',' kepada '.$email.'. Dengan subject : '.$subject, 'kirim email');
        	JSON($responses);
        }else{
        	$responses = $this->responses(false, 500, $this->email->print_debugger());
        	JSON($responses);
        }
	}
 } 
