<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Karyawan 
                            <button href="#modalKaryawan" data-toggle="modal" class="btn waves-effect waves-light btn-grd-primary" onclick="ClearFormData('#formKaryawan'), createNikAutomaticly();">Tambah Data</button></h5>
                        </div>
                        <div class="card-block">
                            <table id="tableKaryawan" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade  modal-flex" id="modalKaryawan" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Karyawan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body model-container">
                                        <form id="formKaryawan" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> NIK*</label>
                                                <div class="col-sm-8"> 
                                                    <input type="text" name="nik" id="nik" class="form-control form-control-round" readonly="on" required="true"/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button id="refreshNik" onclick="createNikAutomaticly()" class="btn btn-sm btn-flat btn-primary" role="button"><i class="fas fa-sync" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Nama*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="nama" id="nama" class="form-control form-control-round" placeholder="Masukan data nama" autocomplete="off" autosave="off" required="on" pattern="[a-zA-Z\s]{0,20}" title="Hanya diperbolehkan huruf" maxlength="20" minlength="3">
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Telepon*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="number" name="telepon" id="telepon" class="form-control form-control-round" placeholder="Masukan data telepon" autocomplete="off" autosave="off" required="on" pattern="[0-9]{0,16}" maxlength="16" minlength="16">
                                                </div>
                                            </div>
                                            <br>
                                            <p><i>* Field Wajib diisi</i></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btn-simpan-karyawan" class="btn waves-effect waves-dark btn-primary btn-outline-primary">Simpan</button>
                                        <button type="button" class="btn waves-effect waves-dark btn-default btn-outline-danger" data-dismiss="modal" onclick="ClearFormData('#formKaryawan')">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var tableKaryawan, url, safe;
    $(document).ready(function() {
        // getDepartementData(); 

    createNikAutomaticly();
        // getJabatan();
        url = "<?php safeURL(site_url('backend/getKaryawan')) ?>";
        safe = readURL(url);
        tableKaryawan = $("#tableKaryawan").DataTable({
            'ajax' : {
                'type': 'POST',
                'url': safe
             },
            'language': { "zeroRecords": "<center>Tidak ada data</center>" },
            'responsive': 'true' 
        });     
    }); 

    $("#formKaryawan").submit(function(event) {
        event.preventDefault();
        var data, url, safe, id = $("#id").val();
        url = "<?php safeURL(site_url('backend/simpanKaryawan')) ?>";
        if (id !== "") {
            url = "<?php safeURL(site_url('backend/updateKaryawan')) ?>";
        }
        safe = readURL(url);
        data = new FormData(this);
        disabled("#btn-simpan-karyawan");
        $.ajax({
            url:safe,
            data: data,
            method: 'post',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                if (data) {
                    createNikAutomaticly();
                    notif('Pemberitahuan', 'success', data.msg);
                    ClearFormData("#formKaryawan");
                    ReloadTable(tableKaryawan);
                    undisabled("#btn-simpan-karyawan");
                }else{
                    notif('Pemberitahuan', 'error', data.msg);
                    ClearFormData("#formKaryawan");
                    ReloadTable(tableKaryawan);
                    undisabled("#btn-simpan-karyawan");
                }
            },
            error: function(){
                console.log('500 | Error save karyawan');
                undisabled("#btn-simpan-karyawan");
            }
        })
    });
    $("#tableKaryawan").on('click', '#edit-karyawan', function(event) {
        event.preventDefault();
        $("#modalKaryawan").modal("show");
        var url, safe, id, attrRequiredIsRemove = $("#formKaryawan input");
            url = "<?php safeURL(site_url('backend/getKaryawanById')) ?>";
            safe = readURL(url);
            id = $(this).data('id');
            attrRequiredIsRemove.prop('required', false);
            attrRequiredIsRemove.prop('disabled', true)
        $.ajax({
                url:safe,
                data:{ id: id },
                dataType:'json',
                type:'post',
                success: function(data){
                    if (data) {
                        $("#id").val(data.id);
                        $("#nama").val(data.nama);
                        $("#telepon").val(data.telepon);
                        $("#email").val(data.email);
                    }else{
                        console.log("500 | getKaryawanById false");
                        attrRequiredIsRemove.prop('disabled', false);
                    }
                },
                error: function(){
                    notif("Informasi", 'error', 'Ajax getKaryawanById error');
                    console.log("Ajax getKaryawanById error");
                    attrRequiredIsRemove.prop('disabled', false);
                }
            });
    });
    $("#tableKaryawan").on('click', '#hapus-karyawan', function(event) {
            event.preventDefault();
            var id = $(this).data('id'),
                url = "<?php safeURL(site_url('backend/hapusKaryawan')); ?>",
                safe = readURL(url);
                sweetAlert({
                  title: "Konfirmasi",
                  text: "Apakah anda yakin ingin menghapus data ini ?",
                  type: "info",
                  showCancelButton: true,
                  cancelButtonText: "Batal",
                  cancelButtonColor: "#E8EAF6",
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Hapus",
                  closeOnConfirm: true
                },
                function(){
                    $.ajax({
                        url:safe,
                        data:{ id: id },
                        dataType:'json',
                        type:'post',
                        success: function(data){
                            if (data.status === true && data.code == 200) {
                                notif('Informasi', "success", data.msg);
                                setTimeout(function(){
                                    ReloadTable(tableKaryawan);
                                },200);
                            }else{
                                notif("Informasi",'info','Data gagal dihapus');
                            }
                        },
                        error: function(){
                            notif("Informasi", 'error', 'Ajax hapus karyawan error');
                            console.log("Ajax hapus karyawan error");
                        }
                });
            });
        });
    function createNikAutomaticly(){
        $.post(' <?php echo site_url('backend/createNikAutomaticly') ?> ', function(data, textStatus, xhr) {
            $("#nik").val(data.msg);
        });
    }
</script>