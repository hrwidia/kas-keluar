<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Divisi 
                            <button href="#modaldivisi" data-toggle="modal" class="btn waves-effect waves-light btn-grd-primary" onclick="ClearFormData('#formdivisi')">Tambah Data</button></h5>
                        </div>
                        <div class="card-block">
                            <table id="tableDivisi" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Divisi</th>
                                        <th>Departement</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Divisi</th>
                                        <th>Departement</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade  modal-flex" id="modaldivisi" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Divisi</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body model-container">
                                        <form id="formdivisi" method="post">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Divisi*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="divisi" id="divisi" class="form-control form-control-round" placeholder="Masukan data divisi" autocomplete="off" autosave="off" required="on" pattern="[a-zA-Z\s]{0,20}" title="Hanya diperbolehkan huruf" maxlength="20" minlength="3">
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Departement*</label>
                                                <div class="col-sm-10"> 
                                                    <select id="data-departement" name="departement" required="on" class="form-control">
                                                        <option id="defaultvalueDataDepartement"></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <p><i>* Field Wajib diisi</i></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btn-simpan-divisi" class="btn waves-effect waves-dark btn-primary btn-outline-primary"> Simpan</button>
                                        <button type="button" class="btn waves-effect waves-dark btn-default btn-outline-danger" data-dismiss="modal" onclick="ClearFormData('#formdivisi')">Batal</button>
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
    var tableDivisi, url, safe;
    $(document).ready(function() {
        getDepartementData();
        url = "<?php safeURL(site_url('backend/getDivisi')) ?>";
        safe = readURL(url);
        tableDivisi = $("#tableDivisi").DataTable({
            'ajax' : {
                'type': 'POST',
                'url': safe
             },
            'language': { "zeroRecords": "<center>Tidak ada data</center>" },
            'responsive': 'true' 
        });     
    }); 
    $("#formdivisi").submit(function(event) {
        event.preventDefault();
        var data, url, safe, id = $("#id").val();
        url = "<?php safeURL(site_url('backend/simpanDivisi')) ?>";
        if (id !== "") {
            url = "<?php safeURL(site_url('backend/updateDivisi')) ?>";
        }
        safe = readURL(url);
        data = $(this).serialize();
        disabled("#btn-simpan-divisi");
        $.post(safe, data).done(function(data){
            ClearFormData("#formdivisi");
            if (data.status == true) {
                ClearFormData("#formdivisi");
                notif('Pemberitahuan', 'success', data.msg);
                ReloadTable(tableDivisi);
                undisabled("#btn-simpan-divisi");
            }else{
                ClearFormData("#formdivisi");
                notif('Pemberitahuan', 'error', data.msg);
                undisabled("#btn-simpan-divisi");
            }
        }).fail(function(xhr, status, error) {
            ClearFormData("#formdivisi");
            console.log('500 | Error save Divisi');
            undisabled("#btn-simpan-divisi");
        });
    });
    $("#tableDivisi").on('click', '#edit-divisi', function(event) {
        event.preventDefault();
        $("#modaldivisi").modal("show");
        var url, safe, id, form = $("#formdivisi input");
            url = "<?php safeURL(site_url('backend/getDivisiById')) ?>";
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
                        $("#divisi").val(data.divisi);
                        form.prop('disabled', false);
                    }else{
                        console.log("500 | getDivisiById false")
                        form.prop('disabled', false);
                    }
                },
                error: function(){
                    notif("Informasi", 'error', 'Ajax getDivisiById error');
                    console.log("Ajax getDivisiById error");
                    form.prop('disabled', false);
                }
            });
    });
    $("#tableDivisi").on('click', '#hapus-divisi', function(event) {
            event.preventDefault();
            var id = $(this).data('id'),
                url = "<?php safeURL(site_url('backend/hapusdivisi')); ?>",
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
                                ReloadTable(tableDivisi);
                            }else{
                                notif("Informasi",'info','Data gagal dihapus');
                            }
                        },
                        error: function(){
                            notif("Informasi", 'error', 'Ajax hapus divisi error');
                            console.log("Ajax hapus divisi error");
                        }
                });
            });
        });
    function getDepartementData(){
        var url, safe;
            url = "<?php safeURL(site_url('backend/getDepartementData')) ?>";
            safe = readURL(url);
            $("#defaultvalueDataDepartement").text("Sedang mengambil data...");
            setTimeout(function(){
                $.ajax({
                    url:safe,
                    dataType:'json',
                    type:'post',
                    crossDomain: true,
                    success:function(data){
                        if (data) {
                            $("#defaultvalueDataDepartement").text("Untuk Departement").prop('disabled', true);
                            $.each(data, function(z, data) {
                                $("#data-departement").append("<option value="+data.id+">"+data.departement+"</option>");
                            });
                        }else{
                            $("#defaultvalueDataDepartement").text("Pilih Data");
                        }
                    },
                    error:function(){
                        $("#defaultvalueDataDepartement").text("").text("Gagal Mengambil data");
                    }
                });
            }, 600);
        }
</script>