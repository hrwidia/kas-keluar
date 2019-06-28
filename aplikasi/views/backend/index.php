<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="id-ID"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="id-ID"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="id-ID"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="id-ID"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="id-ID">
 <!--<![endif]-->
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sistem Pencatatan Pengeluaran Kas atas Pengadaan Proyek</title>
  <meta name='HandheldFriendly' content='true'/>
  <meta name="MobileOptimized" content="320"/>
  <meta name="UI/UX" content="PT. Windu Expotindo"/>
  <meta name="Author" content="PT. Windu Expotindo"/>
  <meta content='yes' name='apple-mobile-web-app-capable'/>
  <meta content='#263544' name='theme-color'/>
  <meta content='#263544' name='apple-mobile-web-app-status-bar-style'/>
  <meta content='true' name='MSSmartTagsPreventParsing'/>
  <meta content='#263544' name='msapplication-navbutton-color'/>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
  <link href="<?php echo site_url(); ?>" rel="dns-prefetch"/>
  <link href="https://www.google.com" rel="dns-prefetch"/>
  <link href="https://www.google.co.id" rel="dns-prefetch"/>
  <link href="https://mail.google.com" rel="dns-prefetch"/>
  <link rel="icon" href="<?php echo base_url('static/assets/images/index.png') ?>" type="image/x-icon">
  <link rel="shortcut icon" href="<?php echo base_url('static/assets/images/index.png') ?>" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
  <link rel="stylesheet" href="static/bower_components/bootstrap/css/bootstrap.min.css" type="text/css" media="all">
  <link rel="stylesheet" href="static/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
  <link rel="stylesheet" type="text/css" href="static/assets/icon/feather/css/feather.css" media="all">
  <link rel="stylesheet" type="text/css" href="static/assets/css/font-awesome-n.min.css" media="all">
  <link rel="stylesheet" type="text/css" href="static/bower_components/chartist/css/chartist.css" media="all">
  <link rel="stylesheet" type="text/css" href="static/assets/css/style.css" media="all">
  <link rel="stylesheet" type="text/css" href="static/assets/css/widget.css" media="all">
  <link rel="stylesheet" type="text/css" href="static/assets/css/notif.min.css" media="all">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" media="all">
  <link rel="stylesheet" type="text/css" href="static/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="static/assets/pages/data-table/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="static/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
  <script type="text/javascript" src="static/bower_components/jquery/js/jquery.min.js"></script>
  <!-- <script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>  -->
  <script src="static/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="static/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="static/assets/pages/data-table/js/jszip.min.js"></script>
  <script src="static/assets/pages/data-table/js/pdfmake.min.js"></script>
  <script src="static/assets/pages/data-table/js/vfs_fonts.js"></script>
  <script src="static/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="static/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="static/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="static/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="static/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
  <script src="static/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <link href="https://oss.maxcdn.com" rel="dns-prefetch"/>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <noscript> "<meta http-equiv="refresh" content="0 URL=<?php echo site_url('noscript'); ?>" />"</noscript>
  <style type="text/css" media="all">
    /* width */
    ::-webkit-scrollbar {
      width: 11.3px;
      height: 10.5px;
      background-color: #F5F5F5;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px #263544 !important; 
      border-radius: 10px;
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #263544 !important; 
      border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #b30000; 
      cursor: pointer;
    }
    .live { animation: blinker 1.5s cubic-bezier(.5, 0, 1, 1) infinite alternate; }
      @keyframes blinker {  
        from { opacity: 5; }
        to { opacity: 0; }
      }
      .btn-file {
          position: relative;
          overflow: hidden;
      }
      .btn-file input[type=file] {
          position: absolute;
          top: 0;
          right: 0;
          min-width: 100%;
          min-height: 100%;
          font-size: 100px;
          text-align: right;
          filter: alpha(opacity=0);
          opacity: 0;
          outline: none;
          background: white;
          cursor: inherit;
          display: block;
      }
      .transition {
          cursor: zoom-in;
          -webkit-transform: scale(1.5); 
          -moz-transform: scale(1.5);
          -o-transform: scale(1.5);
          transform: scale(1.5);
      }
      .noresize{
        resize: none;
      }
      /*.select2 {
        width:100% !important;
      }*/
      /*.select2-choices {
        min-height: 150px;
        max-height: 150px;
        overflow-y: auto;
      }
      .select2-container .select2-selection--single {
          height: 34px;
      }*/
      /*.select2-selection__rendered{
        line-height: 10px;
      }
      .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: -28px;
      }
      .select2-container--default .select2-selection--single {
        height: auto;
      }*/
      @media only screen and (max-width: 767px) {
        .dt-buttons{
          visibility: hidden;
        }
      }
      a.hapus:hover{
        color: red !important;
      }
      a.edit:hover{
        color: #33d359 !important;
      }
      a.email:hover{
        color: yellow !important;
      }
  </style> 

  <script type="text/javascript">
          var url, safe, timer, style = "color: #e81d17;" + "font-size: 40px;" + "font-weight: bold;" + "text-shadow: 1px 1px 5px black;" + "filter: dropshadow(color=rgb(249, 162, 34), offx=1, offy=1);"; console.log("%cJangan Menempelkan apapun disini!", style); 
    $(document).ready(function() {
        $("[data-toggle='tooltip']").tooltip();  
    });
    function notif(_title_, _type_, _pesan_){ 
      sweetAlert({ 
        title: _title_, 
        type: _type_, 
        text: _pesan_, 
        timer: 1500, 
        showConfirmButton: false 
      }); 
    }
    function encrypt(str) {
        if (!str) str = "";
        str = (str === "undefined" || str === "null") ? "" : str;
        try {
            var key = 512, pos = 0;
            ostr = '';
            while (pos < str.length) {
                ostr = ostr + String.fromCharCode(str.charCodeAt(pos) ^ key);
                pos += 1;
            }
            return ostr;
        } catch (ex) {
            return '';
        }
    }
    function decrypt(str) {
        if (!str) str = "";
        str = (str === "undefined" || str === "null") ? "" : str;
        try {
            var key = 512, pos = 0;
            ostr = '';
            while (pos < str.length) {
                ostr = ostr + String.fromCharCode(key ^ str.charCodeAt(pos));
                pos += 1;
            }
            return ostr;
        } catch (ex) {
            return '';
        }
    }
    function safeURL(url){
      var safeURL = window.btoa(url);
      return safeURL;
    }
    function readURL(url){
      var readURL = window.atob(url);
      return readURL; 
    }
    function check_is_email(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( email );
    }
    function ClearFormData(id){
      $(id)[0].reset();
      $("#id").val('');
    }
    function ReloadTable(id){
        id.ajax.reload();
    }
    function activaTab(tab){
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    }
    function disabled(id){
        $(id).prop('disabled', true);
    }
    function undisabled(id){
        $(id).prop('disabled', false);
    }
    function readIMG(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            $('#imgpreview').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
    }
    function editTitleModal(modalName, textEdited){
        $("#"+modalName).find('.modal-title').text(textEdited);
    }
  </script>
</head>
<!-- oncontextmenu="return false;" onload="set();" onmousemove="reset()" onclick="reset()" onkeypress="reset();" onkeyup="reset();" onscroll="reset();" onkeydown="reset();" onmouseenter="reset();" onredo="reset();" onundo="reset();" ondrag="reset();" onfocus="reset();" onblur="reset();" -->
<body>
  <!-- modal tentang -->
    <div class="modal" id="reportmodal">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
              <h4 class="modal-title"><i class="fa fa-bug" aria-hidden="true"></i> Beritahu kami apa yang terjadi</h4>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form role="form" id="formreport" name="formreport" method="POST" enctype="multipart/form-data">
                  <textarea class="form-control noresize" style="height: 15rem;" required="true" autocomplete="off" autofocus></textarea> <br>
                  <p>info tambahan (opsional)</p>
                  <input type="text" class="form-control" name="url" autocomplete="off" maxlength="35" value="<?php echo current_url(); ?>" />
                  <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group" style="margin-top: 1rem;">
                            <div class="input-group input-file" name="file" id="screenshot">
                              <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button"><i class="fa fa-folder-open"></i> Choose</button>
                                </span>
                                <input type="text" class="form-control" placeholder='Choose' />
                                <span class="input-group-btn">
                                     <button class="btn btn-warning btn-reset" type="button" id="btnreset_screenshot">Reset</button>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <img src="" id="imgpreview" alt="preview" style="margin-top: 1rem;" class="img-thumbnail pull-right" disabled="true" />
                      </div>
                  </div><br>
                  <p>* File akan dikirim ke Administrator IT untuk pengecekan proses debug</p>
                  <!-- <div class="divider"></div> --> <hr/>
                  <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 2rem; margin-top: 2rem; width: 10rem;" id="button_kirim_report">Kirim</button>
                  <button type="reset" class="btn btn-default pull-right" style="margin-bottom: 2rem; margin-top: 2rem; width: 10rem; margin-right: 1rem;" id="button_batal_report" data-dismiss="modal">Batal</button>
                </form>
                <script type="text/javascript">
                  file();
                  function file() {
                      $(".input-file").before(
                        function() {
                          if ( ! $(this).prev().hasClass('input-ghost') ) {
                            var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>"),
                              value;
                            element.attr("name", $(this).attr("name"));
                            element.attr("id", $(this).attr("id"));
                            element.change(function(){
                              element.next(element).find('input').val((element.val()).split('\\').pop());
                              readIMG(this);
                              $("#btnreset_screenshot, #imgpreview").prop('disabled', false);
                              $("#button_kirim_report").prop('disabled', false).prop('title', 'Klik untuk mengirim data bug');
                               $("#imgpreview").hover(function() {
                                    $("#imgpreview").addClass('transition');
                                }, function() {
                                    $("#imgpreview").removeClass('transition');
                                });
                            });
                            $(this).find("button.btn-choose").click(function(){
                              element.click();
                            });
                            $(this).find("button.btn-reset").click(function(){
                              element.val(null);
                              $(this).parents(".input-file").find('input').val('');
                              $("#imgpreview").removeAttr('src');
                            });
                            $(this).find('input').css("cursor","pointer");
                            $(this).find('input').mousedown(function() {
                              $(this).parents('.input-file').prev().click();
                              return false;
                            });
                            return element;
                          }
                        }
                      );
                    }
                </script>
              </div>
            </div>
          </div>
        </div>
    </div>
     <div class="modal fade  modal-flex" id="modalBeriMasukan" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Beri Kami Masukan</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
                  <div class="modal-body model-container">
                      <form id="formBeriKamiMasukan" method="post">
                          <div class="form-group row"> 
                              <label class="col-sm-2 col-form-label"> Judul*</label>
                              <div class="col-sm-10"> 
                                  <input type="text" name="judul" class="form-control form-control-round"  autocomplete="off" autosave="off" required="on" placeholder="Masukan judul masukan">
                              </div>
                          </div>
                           <div class="form-group row"> 
                              <label class="col-sm-2 col-form-label"> Keterangan</label>
                              <div class="col-sm-10"> 
                                <textarea name="keterangan" cols="5" rows="5" class="form-control" placeholder="Masukan Keterangan"></textarea>
                              </div>
                          </div>
                          <br>
                          <div class="container">
                            <p>* File akan dikirim ke Administrator IT untuk pengecekan </p>
                          </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn waves-effect waves-light btn-primary btn-outline-primary"><i class="fa fa envelope" aria-hidden="true"></i> Kirim</button>
                      <button type="button" class="btn waves-effect waves-light btn-primary btn-outline-default" data-dismiss="modal" onclick="ClearFormData('#formBeriKamiMasukan')">Tutup</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
  <!-- end modal tentang -->

    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a href="<?php echo site_url('dashboard') ?>">
                            <strong><!-- PT. Windu Expotindo --></strong>
                        </a>
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu icon-toggle-right"></i>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close">
                                          <i class="feather icon-x input-group-text"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn">
                                          <i class="feather icon-search input-group-text"></i>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="full-screen feather icon-maximize"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <!-- <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-bell"></i>
                                        <span class="badge bg-c-red" id="jumlahNotificationHeader"></span>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger" id="jumlahNotificationContent"></label>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="img-radius" src="static/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user"><?php echo $this->session->userdata('siapa'); ?></h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li><center><a href="<?php echo site_url('semuapesan'); ?>">Lihat semua notifikasi </a></center></li>
                                    </ul>
                                </div>
                            </li> -->
                            <!-- <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-message-square"></i>
                                        <span class="badge bg-c-green">3</span>
                                    </div>
                                </div>
                            </li> -->
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo base_url('static/file/user/'.$this->session->userdata('file')); ?>" class="img-radius" alt="User-Profile-Image">
                                        <span><?php echo $this->session->userdata('siapa'); ?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="<?php echo site_url('logout') ?>">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="p-fixed users-main">
                        <div class="user-box">
                            <div class="chat-search-box">
                                <a class="back_friendlist">
                                    <i class="feather icon-x"></i>
                                </a>
                            </div>
                            <div class="main-friend-list">
                                <div class="media userlist-box waves-effect waves-light" data-id="1" data-status="online" data-username="Josephin Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius img-radius" src="static/assets/images/avatar-3.jpg" alt="Generic placeholder image ">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="chat-header">Josephin Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box waves-effect waves-light" data-id="2" data-status="online" data-username="Lary Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="static/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Lary Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box waves-effect waves-light" data-id="3" data-status="online" data-username="Alice">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="static/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alice</div>
                                    </div>
                                </div>
                                <div class="media userlist-box waves-effect waves-light" data-id="4" data-status="offline" data-username="Alia">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="static/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-default"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alia<small class="d-block text-muted">10 min ago</small></div>
                                    </div>
                                </div>
                                <div class="media userlist-box waves-effect waves-light" data-id="5" data-status="offline" data-username="Suzen">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="static/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-default"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Suzen<small class="d-block text-muted">15 min ago</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-x"></i> nama orang ketika dipilih kita ingin chattingan dengan siapa
                        <!-- nama orang ketika dipilih kita ingin chattingan dengan siapa -->
                    </a>
                </div>
                <div class="main-friend-chat">
                    <div class="media chat-messages">
                        <a class="media-left photo-table" href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="static/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                        </a>
                        <div class="media-body chat-menu-content">
                            <div class="">
                                <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            </div>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="media chat-messages">
                        <div class="media-body chat-menu-reply">
                            <div class="">
                                <p class="chat-cont">Ohh! very nice</p>
                            </div>
                            <p class="chat-time">8:22 a.m.</p>
                        </div>
                    </div>
                    <div class="media chat-messages">
                        <a class="media-left photo-table" href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="static/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                        </a>
                        <div class="media-body chat-menu-content">
                            <div class="">
                                <p class="chat-cont">can you come with me?</p>
                            </div>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="chat-reply-box">
                    <div class="right-icon-control">
                        <div class="input-group input-group-button">
                            <input type="text" class="form-control" placeholder="Write hear . . ">
                            <div class="input-group-append">
                                <button class="btn btn-primary waves-effect waves-light" type="button"><i class="feather icon-message-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="nav-list">
                            <div class="pcoded-inner-navbar main-menu">
                                <div class="pcoded-navigation-label">Navigation</div>
                                <!-- Menu Navigation -->
                                <ul class="pcoded-item pcoded-left-item" id="menu">
                                    <!-- class="active" -->
                                      <li>
                                          <a href="<?php echo site_url('dashboard') ?>" class="waves-effect waves-dark">
                                              <span class="pcoded-micon">
                                                <i class="feather icon-menu" aria-hidden="true"></i>
                                              </span>
                                              <span class="pcoded-mtext">Dashboard</span>
                                          </a>
                                      </li>
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fas fa-folder" aria-hidden="true"></i></span>
                                            <span class="pcoded-mtext">Master Data</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                          <!-- <li class="pcoded-hasmenu ">
                                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Data Internal</span>
                                                </a>
                                                <ul class="pcoded-submenu">
                                                    <li>
                                                        <a href="<?php echo site_url('departement') ?>" class="waves-effect waves-dark">
                                                            <span class="pcoded-mtext">Data Departement</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo site_url('divisi') ?>" class="waves-effect waves-dark">
                                                            <span class="pcoded-mtext">Data Divisi</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo site_url('jabatan') ?>" class="waves-effect waves-dark">
                                                            <span class="pcoded-mtext">Data Jabatan</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo site_url('user') ?>" class="waves-effect waves-dark">
                                                            <span class="pcoded-mtext">Data User</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo site_url('akun') ?>" class="waves-effect waves-dark">
                                                            <span class="pcoded-mtext">Data Master Akun</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                          </li> 
                                          <li>
                                              <a href="<?php echo site_url('departement') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Data Departement</span>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="<?php echo site_url('divisi') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Data Divisi</span>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="<?php echo site_url('jabatan') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Data Jabatan</span>
                                              </a>
                                          </li> -->
                                          <li>
                                              <a href="<?php echo site_url('user') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Data User</span>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="<?php echo site_url('karyawan') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Data Karyawan</span>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="<?php echo site_url('akun') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Data Master Akun</span>
                                              </a>
                                          </li>                                      
                                        </ul>
                                    </li>
                                    <li class="pcoded-hasmenu">
                                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fas fa-folder" aria-hidden="true"></i></span>
                                        <span class="pcoded-mtext">Data Traksaksi</span>
                                      </a>
                                      <ul class="pcoded-submenu">
                                          <li>
                                              <a href="<?php echo site_url('kas_keluar') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Data Kas Keluar</span>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="<?php echo site_url('jurnal') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Data Jurnal Umum</span>
                                              </a>
                                          </li>
                                      </ul>
                                    </li>
                                    <!-- <li>
                                        <a href="<?php echo site_url('kas_keluar') ?>" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                              <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
                                            </span>
                                            <span class="pcoded-mtext">Kas Keluar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('jurnal') ?>" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                              <i class="fas fa-newspaper" aria-hidden="true"></i>
                                            </span>
                                            <span class="pcoded-mtext">Jurnal Umum</span>
                                        </a>
                                    </li> -->
                                    <!-- <li>
                                        <a href="<?php echo site_url('laporan') ?>" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                              <i class="fas fa-chart-bar" aria-hidden="true"></i>
                                            </span>
                                            <span class="pcoded-mtext">Laporan</span>
                                        </a>
                                    </li> -->
                                    <li class="pcoded-hasmenu">
                                      <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="fas fa-chart-bar" aria-hidden="true"></i></span>
                                        <span class="pcoded-mtext">Data Laporan</span>
                                      </a>
                                      <ul class="pcoded-submenu">
                                          <li>
                                              <a href="<?php echo site_url('perbulan') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Perbulan</span>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="<?php echo site_url('periode') ?>" class="waves-effect waves-dark">
                                                  <span class="pcoded-mtext">Periode</span>
                                              </a>
                                          </li>
                                      </ul>
                                    </li>
                                    <!-- <li>
                                        <a href="<?php echo site_url('riwayatlogin') ?>" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                              <i class="fas fa-history" aria-hidden="true"></i>
                                            </span>
                                            <span class="pcoded-mtext">Riwayat Login</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('logaktivitas') ?>" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                              <i class="fas fa-tasks" aria-hidden="true"></i>
                                            </span>
                                            <span class="pcoded-mtext">Log Aktivitas</span>
                                        </a>
                                    </li> -->
                                  </ul>
                                  <div class="pcoded-navigation-label">Ekstra Navigation</div>
                                   <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="fas fa-wrench"></i></span>
                                            <span class="pcoded-mtext">Pemeliharaan</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li>
                                              <!-- target="_blank" rel="noopener noreferrer" -->
                                                <a href="<?php $date = date('d-m-Y h:i:s'); echo site_url('backupdatabase') ?>"  class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Backup Database</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('backupaplikasi') ?>"  target="_blank" rel="noopener noreferrer" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Backup Aplikasi</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- <li> -->
                                      <!-- modalBeriMasukan or reportmodal -->
                                    <!--     <a href="#modalBeriMasukan" data-toggle="modal" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                              <i class="fas fa-comment" aria-hidden="true"></i>
                                            </span>
                                            <span class="pcoded-mtext">Beri Masukan</span>
                                        </a>
                                    </li> -->
                                    <li>
                                        <a href="<?php echo site_url('logout') ?>" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                              <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                            </span>
                                            <span class="pcoded-mtext">Keluar</span>
                                        </a>
                                    </li>
                                  </ul>
                                <!-- Menu Navigation -->
                            </div>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                          <?php $file .= ".php"; include $file;?>
                        </div>
                        
                    </div>

                    <div id="styleSelector">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--[if lt IE 10]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade
            <br/>to any of the following web browsers to access this website.
        </p>
        <div class="iew-container">
            <ul class="iew-download">
                <li>
                    <a href="http://www.google.com/chrome/">
                        <img src="static/assets/images/browser/chrome.png" alt="Chrome">
                        <div>Chrome</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.mozilla.org/en-US/firefox/new/">
                        <img src="static/assets/images/browser/firefox.png" alt="Firefox">
                        <div>Firefox</div>
                    </a>
                </li>
                <li>
                    <a href="http://www.opera.com">
                        <img src="static/assets/images/browser/opera.png" alt="Opera">
                        <div>Opera</div>
                    </a>
                </li>
                <li>
                    <a href="https://www.apple.com/safari/">
                        <img src="static/assets/images/browser/safari.png" alt="Safari">
                        <div>Safari</div>
                    </a>
                </li>
                <li>
                    <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                        <img src="static/assets/images/browser/ie.png" alt="">
                        <div>IE (9 & above)</div>
                    </a>
                </li>
            </ul>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
<![endif]-->
<script type="text/javascript">
    var H=H||{};
    setInterval(function() {
    var time = H.RealtimeDate();
    $("a.current-time").html(time)
    }, 1e3), H.RealtimeDate = function() {
    var a = new Date,
        b = [];
        b[0] = "Januari", 
        b[1] = "Februari", 
        b[2] = "Maret", 
        b[3] = "April", 
        b[4] = "Mei", 
        b[5] = "Juni", 
        b[6] = "Juli", 
        b[7] = "Agustus", 
        b[8] = "September", 
        b[9] = "Oktober", 
        b[10] = "November", 
        b[11] = "Desember";
        var currentMonth = b[a.getMonth()],
            currentYear = a.getFullYear(),
            currentDate = a.getDate(),
            c = [];
            c[0] = "Minggu", 
            c[1] = "Senin", 
            c[2] = "Selasa", 
            c[3] = "Rabu", 
            c[4] = "Kamis", 
            c[5] = "Jum'at", 
            c[6] = "Sabtu";
            var currentDay = c[a.getDay()],
                d = a.getHours(),
                e = a.getMinutes(),
                f = a.getSeconds();
                return currentDay + ", " + currentDate + " " + currentMonth + " " + currentYear + " &sdot; " + (d = (d < 10 ? "0" : "") + d) + " : " + (e = (e < 10 ? "0" : "") + e) + " : " + (f = (f < 10 ? "0" : "") + f)
    }
</script>
<!-- Script JS -->
    <!-- <script type="text/javascript" src="static/bower_components/jquery-ui/js/jquery-ui.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="static/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="static/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="static/assets/pages/waves/js/waves.min.js"></script>
    <script type="text/javascript" src="static/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <script src="static/assets/pages/chart/float/jquery.flot.js"></script>
    <script src="static/assets/pages/chart/float/jquery.flot.categories.js"></script>
    <script src="static/assets/pages/chart/float/curvedLines.js"></script>
    <script src="static/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>
    <script src="static/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="static/assets/pages/widget/amchart/serial.js"></script>
    <script src="static/assets/pages/widget/amchart/light.js"></script>
    <script src="static/assets/pages/data-table/js/data-table-custom.js"></script>
    <script src="static/assets/js/pcoded.min.js"></script>
    <script src="static/assets/js/vertical/vertical-layout.min.js"></script>
    <!-- <script type="text/javascript" src="static/assets/pages/dashboard/crm-dashboard.min.js"></script> -->
    <script type="text/javascript" src="static/assets/js/script.min.js"></script>
    <script type="text/javascript" src="static/assets/js/notif.min.js"></script>
    <script type="text/javascript">
       $("#formBeriKamiMasukan").submit(function(event) {
          event.preventDefault();
          var url, data, safe;
              url = "<?php safeURL(site_url('backend/masukan')) ?>";
              safe = readURL(url);
              data = $(this).serialize();
              $.post(safe, data).done(function(data){
                 if (data) {
                    notif('Pemberitahuan', 'success', 'Masukan kamu sudah kami terima, terima kasih sudah memberi masukan :)');
                    ClearFormData("#formBeriKamiMasukan");
                }
              }).fail(function(xhr, status, error) {
                  notif('Pemberitahuan', 'error', 'System kami sedang error, kamu belum bisa memberi masukan');
                  ClearFormData("#formBeriKamiMasukan");
                  console.log("500 | Beri masukan error");
                  location.reload();
              });
        });
    </script>
</body>
</html>