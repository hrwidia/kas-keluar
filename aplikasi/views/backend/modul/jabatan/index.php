<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Jabatan 
                            <button href="#modalJabatan" data-toggle="modal" class="btn waves-effect waves-light btn-grd-primary" onclick="ClearFormData('#formJabatan')">Tambah Data</button></h5>
                        </div>
                        <div class="card-block">
                            <table id="tableJabatan" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jabatan</th>
                                        <th>Kode Jabatan</th>
                                        <th>Keterangan Posisi Jabatan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Jabatan</th>
                                        <th>Kode Jabatan</th>
                                        <th>Keterangan Posisi Jabatan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade  modal-flex" id="modalJabatan" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Jabatan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body model-container">
                                        <form id="formJabatan" method="post">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Jabatan*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="jabatan" id="jabatan" class="form-control form-control-round"  autocomplete="off" autosave="off" required="on" placeholder="Masukan jabatan">
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Kode*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="kode" id="kode" class="form-control form-control-round" autocomplete="off" autosave="off" required="on" placeholder="Masukan kode jabatan">
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Posisi</label>
                                                <div class="col-sm-10"> 
                                                    <textarea id="posisi" name="posisi" class="form-control" placeholder="Masukan Posisi Jabatan (Opsional)" cols="5" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <p><i>* Field Wajib diisi</i></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btn-simpan-jabatan" class="btn waves-effect waves-dark btn-primary btn-outline-primary">Simpan</button>
                                        <button type="button" class="btn waves-effect waves-dark btn-default btn-outline-danger" data-dismiss="modal" onclick="ClearFormData('#formJabatan')">Batal</button>
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
    var tableJabatan, url, safe;
    $(document).ready(function() {
        url = "<?php safeURL(site_url('backend/getJabatan')) ?>";
        safe = readURL(url);
        tableJabatan = $("#tableJabatan").DataTable({
            'ajax' : {
                'type': 'POST',
                'url': safe
             },
            'language': { "zeroRecords": "<center>Tidak ada data</center>" },
            'responsive': 'true' 
        });     
    }); 
    $("#formJabatan").submit(function(event) {
        event.preventDefault();
        var data, url, safe, id = $("#id").val();
        url = "<?php safeURL(site_url('backend/simpanJabatan')) ?>";
        if (id !== "") {
            url = "<?php safeURL(site_url('backend/updateJabatan')) ?>";
        }
        safe = readURL(url);
        data = $(this).serialize();
        disabled("#btn-simpan-jabatan");
        $.post(safe, data).done(function(data){
            if (data.status == true) {
                notif('Pemberitahuan', 'success', data.msg);
                ReloadTable(tableJabatan);
                ClearFormData("#formJabatan");
                undisabled("#btn-simpan-jabatan");
            }else{
                ClearFormData("#formJabatan");
                notif('Pemberitahuan', 'error', data.msg);
                undisabled("#btn-simpan-jabatan");
            }
        }).fail(function(xhr, status, error) {
            ClearFormData("#formJabatan");
            console.log('500 | Error save Jabatan');
            undisabled("#btn-simpan-jabatan");
        });
    });
    $("#tableJabatan").on('click', '#edit-jabatan', function(event) {
        event.preventDefault();
        $("#modalJabatan").modal("show");
        var url, safe, id, form = $("#formJabatan input");
            url = "<?php safeURL(site_url('backend/getJabatanById')) ?>";
            safe = readURL(url);
            id = $(this).data('id');
            form.prop('disabled', true);
            $.ajax({
                url:safe,
                data:{ id: id },
                dataType:'json',
                type:'post',
                success: function(data){
                    if (data) {
                        $("#id").val(data.id);
                        $("#jabatan").val(data.jabatan);
                        $("#kode").val(data.kode);
                        $("#posisi").text(data.posisi);
                        form.prop('disabled', false);
                    }else{
                        console.log("500 | getJabatanById false");
                        form.prop('disabled', false);
                    }
                },
                error: function(){
                    notif("Informasi", 'error', 'Ajax getJabatanById error');
                    console.log("Ajax getJabatanById error");
                    form.prop('disabled', false);
                }
            });
    });
    $("#tableJabatan").on('click', '#hapus-jabatan', function(event) {
            event.preventDefault();
            var id = $(this).data('id'),
                url = "<?php safeURL(site_url('backend/hapusJabatan')); ?>",
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
                                    ReloadTable(tableJabatan);
                                },200);
                            }else{
                                notif("Informasi",'info','Data gagal dihapus');
                            }
                        },
                        error: function(){
                            notif("Informasi", 'error', 'Ajax hapus Jabatan error');
                            console.log("Ajax hapus Jabatan error");
                        }
                });
            });
    });
</script>