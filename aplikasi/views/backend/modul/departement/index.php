<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Departement 
                            <button href="#modalDepartement" data-toggle="modal" class="btn waves-effect waves-light btn-grd-primary" onclick="ClearFormData('#formDepartement')">Tambah Data</button></h5>
                        </div>
                        <div class="card-block">
                            <table id="tableDepartement" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Departement</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Departement</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade  modal-flex" id="modalDepartement" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Departement</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body model-container">
                                        <form id="formDepartement" method="post">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Departement* </label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="departement" id="departement" class="form-control form-control-round" placeholder="Masukan data departement" autocomplete="off" autosave="off" required="on" pattern="[a-zA-Z\s]{0,20}" title="Hanya diperbolehkan huruf" maxlength="20" minlength="3"/>
                                                </div>
                                            </div>
                                            <br>
                                            <p><i>* Field Wajib diisi</i></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btn-simpan-departement" class="btn waves-effect waves-dark btn-primary btn-outline-primary">Simpan</button>
                                        <button type="button" class="btn waves-effect waves-dark btn-default btn-outline-danger" data-dismiss="modal" onclick="ClearFormData('#formDepartement')">Batal</button>
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
    var tableDepartement, url, safe;
    $(document).ready(function() {
        url = "<?php safeURL(site_url('backend/getDepartement')) ?>";
        safe = readURL(url);
        tableDepartement = $("#tableDepartement").DataTable({
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            // ],
            ajax : {
                'type': 'POST',
                'url': safe
             },
            language: { "zeroRecords": "<center>Tidak ada data</center>" },
            responsive: 'true' 
        });     
    }); 
    $("#formDepartement").submit(function(event) {
        event.preventDefault();
        var data, url, safe, id = $("#id").val();
        url = "<?php safeURL(site_url('backend/simpanDepartement')) ?>";
        if (id !== "") {
            url = "<?php safeURL(site_url('backend/updateDepartement')) ?>";
        }
        safe = readURL(url);
        data = $(this).serialize();
        disabled("#btn-simpan-departement");
        $.post(safe, data).done(function(data){
            if (data.status == true) {
                notif('Pemberitahuan', 'success', data.msg);
                ReloadTable(tableDepartement);
                ClearFormData("#formDepartement");
                undisabled("#btn-simpan-departement");
            }else{
                ClearFormData("#formDepartement");
                notif('Pemberitahuan', 'error', data.msg);
                undisabled("#btn-simpan-departement");
            }
        }).fail(function(xhr, status, error) {
            ClearFormData("#formDepartement");
            console.log('500 | Error save Departement');
            undisabled("#btn-simpan-departement");
        });
    });
    $("#tableDepartement").on('click', '#edit-departement', function(event) {
        event.preventDefault();
        $("#modalDepartement").modal("show");
        var url, safe, id, form = $("#formDepartement input");
            url = "<?php safeURL(site_url('backend/getDepartementById')) ?>";
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
                        $("#departement").val(data.departement);
                        form.prop('disabled', false);
                    }else{
                        console.log("500 | getDepartementById false")
                        form.prop('disabled', false);
                    }
                },
                error: function(){
                    notif("Informasi", 'error', 'Ajax getDepartementById error');
                    console.log("Ajax getDepartementById error");
                    form.prop('disabled', false);
                }
            });
    });
    $("#tableDepartement").on('click', '#hapus-departement', function(event) {
            event.preventDefault();
            var id = $(this).data('id'),
                url = "<?php safeURL(site_url('backend/hapusDepartement')); ?>",
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
                                    ReloadTable(tableDepartement);
                                },200);
                            }else{
                                notif("Informasi",'info','Data gagal dihapus');
                            }
                        },
                        error: function(){
                            notif("Informasi", 'error', 'Ajax hapus Departement error');
                            console.log("Ajax hapus Departement error");
                        }
                });
            });
    });
</script>