<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('rupiah')){
    function rupiah($number){
        $code = 'Rp '.number_format($number,2,',','.');
        return $code;
  }
}
if ( ! function_exists('getlog')) {
  function getlog(){
    $now = date('d-m-Y');
    $get = file_get_contents(realpath(__DIR__.'../../../debug/log-'.$now.'.txt'));
    var_dump($get); die();
  }
}
if ( ! function_exists('safeURL')) {
  function safeURL($url){
    echo $safe = base64_encode($url);
    return $safe;
  }
}
if ( ! function_exists('readURL')) {
  function readURL($url){
    $read = base64_decode($url);
    return $read;
  }
}
if ( ! function_exists('setheader')) {
  function setheader(){
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header('X-Author: Hafiz ramadhan');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');
    header("X-Content-Type-Options: nosniff");
    header("Strict-Transport-Security: max-age=31536000");
    header("Access-Control-Allow-Origin: ".site_url());
    header("Origin:".site_url());
    header("Access-Control-Allow-Methods: POST");
    header("Timing-Allow-Origin: ".site_url());
    header("Access-Control-Allow-Credentials: true");
    header("ETag: 33a64df551425fcc55e4d42a148795d9f25f89d4");
    header("If-Match: 33a64df551425fcc55e4d42a148795d9f25f89d4");
    header("X-DNS-Prefetch-Control: ON");
    header("DNT: 1");
    header("Accept-Ranges: bytes");
    header("Vary: Origin");
  }
}
if ( ! function_exists('BulanToRomawi')) {
  function BulanToRomawi($bulanAngka){
    if ($bulanAngka == '01') {
        $bulan = 'I';
    }elseif ($bulanAngka == '02') {
        $bulan = 'II';
    }elseif ($bulanAngka == '03') {
        $bulan = 'III';
    }elseif ($bulanAngka == '04') {
        $bulan = 'IV';
    }elseif ($bulanAngka == '05') {
        $bulan = 'V';
    }elseif ($bulanAngka == '06') {
        $bulan = 'VI';
    }elseif ($bulanAngka == '07') {
        $bulan = 'VII';
    }elseif ($bulanAngka == '08') {
        $bulan = 'VIII';
    }elseif ($bulanAngka == '09') {
        $bulan = 'IX';
    }elseif ($bulanAngka == '10') {
        $bulan = 'X';
    }elseif ($bulanAngka == '11') {
        $bulan = 'XI';
    }elseif ($bulanAngka == '12') {
        $bulan = 'XII';
    }else{
      $bulan = 'Bulan Salah';
    }
    return $bulan;
  }
}
if ( ! function_exists('change_format_date')) {
  function change_format_date($date){
      $code = date('d-m-Y H:i:s', strtotime(str_replace('-', '/', $date)));
      return $code;
  }
}
if ( ! function_exists('formatBytes')) {
  function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'Kb', 'Mb', 'Gb', 'Tb'); 
    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 
    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 
    return round($bytes, $precision) . ' ' . $units[$pow]; 
  }
}
if ( ! function_exists('isajax')) {
  function isajax(){
    $CI =& get_instance();
    if (notget()) {
      if (!$CI->input->is_ajax_request()) { 
        http_response_code(403);  
      }
    }
  }
}
function notget(){
    $RequestMethod = $_SERVER['REQUEST_METHOD'];
    if ($RequestMethod === "GET") {
      http_response_code(400); 
      exit(JSON(['error' => 'Your Request Method is Not Allowed.']));
    }
    return 1;
}
function generateCsrf(){
  $CI =& get_instance();
  $response = [
    'hash' => $CI->security->get_csrf_hash()
  ];
  JSON($response);
}
if ( ! function_exists('action')) {
  function action($function){
    $code = base_url('backend/'.$function.'');
    return $code;
  }
}
if ( ! function_exists('is_logged_in')){
  function is_logged_in() {
        $CI =& get_instance(); 
        return $CI->session->userdata('is_logged_in');
  }
}
if ( ! function_exists('clear_expired_session')) {
  function clear_expired_session() {
    $CI =& get_instance(); 
    $CI->db->query("DELETE FROM `_sessions` WHERE DATE_FORMAT(FROM_UNIXTIME(timestamp), '%Y-%m-%d') < CURRENT_DATE");
  }
}
if ( ! function_exists('JSON')) {
  function JSON($data=''){
    $CI =& get_instance();
    $CI->output->set_content_type('application/json', 'utf-8')->set_output(JSON_encode($data, JSON_PRETTY_PRINT))->_display();
    exit;
  }
}
if ( ! function_exists('cek') ) {
  function cek(){
    $CI =& get_instance();
    $code = $CI->session->userdata('sudah');
    return $code;
  }
}
if ( ! function_exists('verifikasi')) {
  function verifikasi(){
    $CI =& get_instance();
    if ( ! $CI->session->userdata('nama', 'status')) {
      redirect(base_url());
    }
  }
}
if ( ! function_exists('interpreter')) {
    function interpreter($folder_and_mysql){ 
      $CI =& get_instance();
      $code = $CI->load->view('backend/index', $folder_and_mysql);
      return $code;
  }
}
if ( ! function_exists('query')) {
    function query($sql){
      $CI =& get_instance();
      $code = $CI->db->query($sql);
      return $code;
    }
  }
  if ( ! function_exists('post')) {
    function post($data){
      $CI =& get_instance();
      $code = $CI->security->xss_clean(stripcslashes(htmlspecialchars(htmlentities($CI->input->post($data, TRUE)))));
      return $code;
    }
  }
  if ( ! function_exists('where')) {
    function where($data, $where = ''){
      $CI =& get_instance();
      $code = $CI->db->where($data, $where);
      return $code;
    }
  }
  if ( ! function_exists('minta')) {
    function minta($table){
      $CI =& get_instance();
      $code = $CI->db->get($table);
      return $code;
    }
  }
  if ( ! function_exists('simpan')) {
    function simpan($table, $object=''){
      $CI =& get_instance();
      $code = $CI->db->insert($table, $object);
      return $code;
    }
  }
  if ( ! function_exists('lastquery')) {
    function lastquery(){
      $CI =& get_instance();
      $code = $CI->db->last_query();
      return $code;
    }
  }
  if ( ! function_exists('update')) {
    function update($table, $object=''){
      $CI =& get_instance();
      $code = $CI->db->update($table, $object);
      return $code;
    }
  }
  if ( ! function_exists('hapus')) {
    function hapus($table){
      $CI =& get_instance();
      $code = $CI->db->delete($table);
      return $code;
    }
  }
if ( ! function_exists('load')) {
    function load($folder, $data=''){
      $CI = & get_instance();
      $code = $CI->load->view($folder, $data);
      return $code;
  }
}
if ( ! function_exists('model')) {
  function model($function_name, $data1='', $data2='', $data3=''){
    $CI =& get_instance();
    $CI->load->model('model');
    $code = $CI->model->$function_name($data1, $data2, $data3);
    return $code;
  }
}
if ( ! function_exists('security')) {
  function security($function){
    $CI =& get_instance();
    $code = $CI->security->$function;
    return $code;
  }
}
if ( ! function_exists('get_ip_address')) {
  function get_ip_address() {
    $code = getenv('HTTP_X_FORWARDED_FOR') ? getenv('HTTP_X_FORWARDED_FOR') : getenv('REMOTE_ADDR');
    return $code;
  }
}
if ( ! function_exists('check_internet_connection')) {
  function check_internet_connection() {
    $code = checkdnsrr('google.co.id');
    return $code;
  }
}
if ( ! function_exists('Tampil')) {
  function Tampil($table, $where){
    $CI =& get_instance();
    $code = $CI->db->where($where);
    $code = $CI->db->select($table);
    return $code;
  }
}
if ( ! function_exists('Simpan')) {
  function Simpan($table, $field){
    $CI =& get_instance();
    $code = $CI->db->insert($table, $field);
    return $code;
  }
}
if ( ! function_exists('Update')) {
  function Update($table, $field){
    $CI =& get_instance();
    $code = $CI->db->update($table, $field);
    return $code;
  }
}
if ( ! function_exists('Hapus')) {
  function Hapus($id, $table, $value){
    $CI =& get_instance();
    $code = $CI->db->where($id, $value);
    $code = $CI->db->delete($table);
    return $code;
  }
}
if ( ! function_exists('session')) {
    function session($session){
      $CI =& get_instance();
      $code = $CI->session->userdata($session);
      return $code;
    }
}
if ( ! function_exists('allowed_type')) {
    function allowed_type($data){
      $fileNameParts = explode(".", $data);
      $fileExtension = end($fileNameParts);
      $fileExtension = strtolower($fileExtension);
      return $fileExtension;
    }
}
if ( ! function_exists('query')) {
    function query($sql){
      $CI =& get_instance();
      $code = $CI->db->query($sql);
      return $code;
    }
}
