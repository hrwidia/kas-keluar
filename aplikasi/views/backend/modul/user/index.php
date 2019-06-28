<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data User 
                            <button href="#modalUser" data-toggle="modal" class="btn waves-effect waves-light btn-grd-primary" onclick="ClearFormData('#formUser')">Tambah Data</button></h5>
                        </div>
                        <div class="card-block">
                            <table id="tableUser" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Departement</th>
                                        <th>Jabatan</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Departement</th>
                                        <th>Jabatan</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade  modal-flex" id="modalUser" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah User</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body model-container">
                                        <form id="formUser" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" id="id">
                                            <!-- <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> NIK*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="number" name="nik" id="nik" class="form-control form-control-round" placeholder="Masukan data nik" autocomplete="off" autosave="off" required="on" pattern="[0-9]{0,16}" maxlength="16" minlength="16">
                                                </div>
                                            </div> -->
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Nama*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="nama" id="nama" class="form-control form-control-round" placeholder="Masukan data nama" autocomplete="off" autosave="off" required="on" pattern="[a-zA-Z\s]{0,20}" title="Hanya diperbolehkan huruf" maxlength="20" minlength="3">
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Departement* </label>
                                                <div class="col-sm-10"> 
                                                  <select id="data-departement" name="departement" required="on" class="form-control form-control-round">
                                                      <option value="">--Pilih Departmenent--</option>
                                                      <option value="">Bagian Keuangan</option>
                                                      <option value="">Bagian Administrasi</option>
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Jabatan* </label>
                                                <div class="col-sm-10"> 
                                                    <textarea id="data-jabatan" name="jabatan" class="form-control form-control-round" required="on" placeholder="Enter your position"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Foto*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="file" name="file" id="file" required="on" accept="image/*" />
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Email*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="email" name="email" id="email" class="form-control form-control-round" placeholder="Masukan email aktif" required="on" autocomplete="off" autosave="off" maxlength="35" minlength="4">
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Username*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="username" id="username" class="form-control form-control-round" placeholder="Masukan username" required="on" autocomplete="off" autosave="off" pattern="[a-zA-Z\s]{0,15}" title="Hanya diperbolehkan huruf" maxlength="15" minlength="4">
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Password*</label>
                                                <div class="col-sm-10"> 
                                                    <input type="password" name="password" id="password" class="form-control form-control-round" placeholder="Masukan password" required="on" autocomplete="off" autosave="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" maxlength="20" minlength="8">
                                                </div>
                                            </div>
                                            <br>
                                            <p><i>* Field Wajib diisi</i></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btn-simpan-user" class="btn waves-effect waves-dark btn-primary btn-outline-primary">Simpan</button>
                                        <button type="button" class="btn waves-effect waves-dark btn-default btn-outline-danger" data-dismiss="modal" onclick="ClearFormData('#formUser')">Batal</button>
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
    var tableUser, url, safe;
    $(document).ready(function() {
        // getDepartementData(); 

        // getJabatan();
        url = "<?php safeURL(site_url('backend/getUser')) ?>";
        safe = readURL(url);
        tableUser = $("#tableUser").DataTable({
            'ajax' : {
                'type': 'POST',
                'url': safe
             },
            'language': { "zeroRecords": "<center>Tidak ada data</center>" },
            'responsive': 'true' 
        });     
    }); 

    $("#formUser").submit(function(event) {
        event.preventDefault();
        var data, url, safe, id = $("#id").val();
        url = "<?php safeURL(site_url('backend/simpanUser')) ?>";
        if (id !== "") {
            url = "<?php safeURL(site_url('backend/updateUser')) ?>";
        }
        safe = readURL(url);
        data = new FormData(this);
        disabled("#btn-simpan-user");
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
                    notif('Pemberitahuan', 'success', data.msg);
                    ClearFormData("#formUser");
                    ReloadTable(tableUser);
                    undisabled("#btn-simpan-user");
                }else{
                    notif('Pemberitahuan', 'error', data.msg);
                    ClearFormData("#formUser");
                    ReloadTable(tableUser);
                    undisabled("#btn-simpan-user");
                }
            },
            error: function(){
                console.log('500 | Error save user');
                undisabled("#btn-simpan-user");
            }
        })
    });
    $("#tableUser").on('click', '#edit-user', function(event) {
        event.preventDefault();
        $("#modalUser").modal("show");
        var url, safe, id, attrRequiredIsRemove = $("#formUser input");
            url = "<?php safeURL(site_url('backend/getUserById')) ?>";
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
                        $("#nik").val(data.nik);
                        $("#nama").val(data.nama);
                        $("#departement").val(data.departement);
                        $("#jabatan").val(data.jabatan);
                        $("#email").val(data.email);
                        $("#username").val(data.username);

                        var password = data.katasandi;
                        // set to localstroge;
                        localStorage.setItem('password', password);
                        localStorage.setItem('file', data.file);
                        attrRequiredIsRemove.prop('disabled', false);
                        // getting password and convert
                    }else{
                        console.log("500 | getUserById false");
                        attrRequiredIsRemove.prop('disabled', false);
                    }
                },
                error: function(){
                    notif("Informasi", 'error', 'Ajax getUserById error');
                    console.log("Ajax getUserById error");
                    attrRequiredIsRemove.prop('disabled', false);
                }
            });
    });
    $("#tableUser").on('click', '#hapus-user', function(event) {
            event.preventDefault();
            var id = $(this).data('id'),
                url = "<?php safeURL(site_url('backend/hapusUser')); ?>",
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
                                    ReloadTable(tableUser);
                                },200);
                            }else{
                                notif("Informasi",'info','Data gagal dihapus');
                            }
                        },
                        error: function(){
                            notif("Informasi", 'error', 'Ajax hapus user error');
                            console.log("Ajax hapus user error");
                        }
                });
            });
        });
  
</script>