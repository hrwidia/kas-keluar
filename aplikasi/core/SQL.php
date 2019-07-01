<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SQL extends CI_Controller{
 	
 	public function __construct(){ 
 		parent::__construct(); 
 		date_default_timezone_set('Asia/Jakarta');
 	}

 	public function responses($status = null, $code = 200, $msg = "Message is null."){
 		// set_status_header($code);
 		$data = [
 			'status' => $status,
 			'code'   => $code,
 			'msg'    => $msg
 		];
 		return $data;
 	}

 	public function save_activity($aksi, $detail = null, $kategori){
 		$siapa = session('siapa');
 		$date = date('Y-m-d H:i:s');
 		if ($siapa) {
	 		$data  = [
	 			'nama' => $siapa,
	 			// 'departement' => session('departement'),
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
	 		$fieldname = key($data);
	 		foreach ($data as $key => $value){
			    if (is_array($value)){
			      $data[$key] = $this->array_values_recursive($value);
			    }
			  }
			  $check = query("SELECT $fieldname FROM $tablename WHERE $fieldname='$data[$key]' and is_deleted IS NULL");
	 		if ($check->num_rows() > 0 || $check->num_rows() == 1) {
	 			$responses = $this->responses(false, 500, 'Data sudah tersedia.');
	 		}else{
	 			$simpan = simpan($tablename, $data);
	 			$insert_id = $this->db->insert_id();
		 		if ($simpan) {
		 			$responses = $this->responses(true, 200, $insert_id);
		 			// $this->save_activity('menyimpan', $tablename);
		 		}else{
		 			$responses = $this->responses(false, 500, 'Gagal menyimpan data '.$tablename);
		 		}	
	 		}
	 	JSON($responses);
 	}

 	public function update($id, $data = [], $tablename){
 		isajax();
 		$update = where('id', $id);
 		$update = update($tablename, $data);
 		if ($update) {
 			$responses = $this->responses(true, 200, 'Berhasil memperbarui data '.$tablename);
 			// $this->save_activity('memperbarui', ''.$tablename.' dengan ID : '.$id);
 		}else{
 			$responses = $this->responses(false, 500, 'Gagal memperbarui data '.$tablename);
 		}
 		JSON($responses);
 	}
 	public function soft_delete($id, $tablename){
 		isajax();
 		$soft = where('id', $id);
 		$data = [
 			'is_deleted' => 1
 		];
 		$soft = update($tablename, $data);
 		if ($soft) {
 			$responses = $this->responses(true, 200, 'Berhasil menghapus data '.$tablename);
 			// $this->save_activity('menghapus', ''.$tablename.' dengan ID : '.$id);
 		}else{
 			$responses = $this->responses(false, 500, 'Gagal menghapus data '.$tablename);
 		}
 		JSON($responses);
 	}
	public function get_by_id($id, $tablename){
		// notget();
		isajax();
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
	}
	public function unggah($id, $path, $tablename){
		notget();
		isajax();
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		$config = [
			'upload_path'     => './'.$path,
			'allowed_types'   => "gif|jpeg|jpg|png",
			'encrypt_name' 	  => TRUE
		];
		$this->load->library('upload', $config);
		if ($this->upload->do_upload(('file'))) {
			 $result = $this->upload->data();
			 $file = $result['file_name'];
			 $field = [
				'file' => $file
			];
			$update = where('id', $id);
 			$update = update($tablename, $field);
 			if ($update) {
 					$responses = $this->responses(true, 200, 'Berhasil upload file');
				}else{
					$responses = $this->responses(false, 500, 'Gagal upload file');
				}
				JSON($responses);
		}else{
			$error = $this->upload->display_errors();
			print_r($error); die();
		}
	}
 } 
