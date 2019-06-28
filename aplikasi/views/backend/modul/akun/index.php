<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Akun 
                            <button href="#modalAkun" data-toggle="modal" class="btn waves-effect waves-light btn-grd-primary" onclick="ClearFormData('#formAkun')">Tambah Data</button></h5>
                        </div>
                        <div class="card-block">
                            <table id="tableAkun" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Nama Akun</th>
                                        <th>Jenis Akun</th>
                                        <th>Saldo Nominal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Nama Akun</th>
                                        <th>Jenis Akun</th>
                                        <th>Saldo Nominal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade  modal-flex" id="modalAkun" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Akun</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body model-container">
                                        <form id="formAkun" method="post">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Kode* </label>
                                                <div class="col-sm-10"> 
                                                    <input type="number" name="kode" id="kode" class="form-control form-control-round" readonly="true" autocomplete="off" autosave="off" required="on" placeholder="(otomatis)" />
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Nama Akun* </label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="nama" id="nama" class="form-control form-control-round" placeholder="Masukan kode akun" autocomplete="off" autosave="off" required="on" pattern="[a-zA-Z\s]{0,35}" maxlength="35" minlength="3" title="Hanya diperbolehkan angka" />
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Jenis Akun* </label>
                                                <div class="col-sm-10"> 
                                                  <select id="data-jenis-akun" name="jenis" onchange="getKodeMasterAkunByJenisAkun(this.value);" required="on" class="form-control form-control-round">
                                                      <option value="">--Pilih Jenis Akun--</option>
                                                      <option value="Kas/Bank">Kas/Bank</option>
                                                      <option value="Aktiva Lancar">Aktiva Lancar</option>
                                                      <option value="Aktiva Tetap">Aktiva Tetap</option>
                                                      <option value="Kewajiban">Kewajiban</option>
                                                      <option value="Modal">Modal</option>
                                                      <option value="Pendapatan">Pendapatan</option>
                                                      <option value="Beban">Beban</option>
                                                  </select>
                                                </div>
                                            </div>
                                             <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Saldo Nominal* </label>
                                                <div class="col-sm-10"> 
                                                  <select id="data-saldo-nominal" name="saldo" required="on" class="form-control form-control-round">
                                                      <option value="">--Pilih Saldo Nominal--</option>
                                                      <option value="Debet">Debet</option>
                                                      <option value="Kredit">Kredit</option>
                                                  </select>
                                                </div>
                                            </div>
                                            <br>
                                            <p><i>* Field Wajib diisi</i></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btn-simpan-akun" class="btn waves-effect waves-dark btn-primary btn-outline-primary">Simpan</button>
                                        <button type="button" class="btn waves-effect waves-dark btn-default btn-outline-danger" data-dismiss="modal" onclick="ClearFormData('#formAkun')">Batal</button>
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
    var tableAkun, url, safe;
    $(document).ready(function() {
        url = "<?php safeURL(site_url('backend/getAkun')) ?>";
        safe = readURL(url);
        tableAkun = $("#tableAkun").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax : {
                'type': 'POST',
                'url': safe
             },
            language: { "zeroRecords": "<center>Tidak ada data</center>" },
            responsive: 'true' 
        });     
    }); 
    $("#formAkun").submit(function(event) {
        event.preventDefault();
        var data, url, safe, id = $("#id").val();
                url = "<?php safeURL(site_url('backend/simpanAkun')) ?>";
                if (id !== "") {
                    url = "<?php safeURL(site_url('backend/updateAkun')) ?>";
                }
                safe = readURL(url);
                data = $(this).serialize();
                disabled("#btn-simpan-akun");
                $.post(safe, data).done(function(data){
                    if (data.status == true) {
                        notif('Pemberitahuan', 'success', data.msg);
                        ReloadTable(tableAkun);
                        ClearFormData("#formAkun");
                        undisabled("#btn-simpan-akun");
                    }else{
                        ClearFormData("#formAkun");
                        notif('Pemberitahuan', 'error', data.msg);
                        undisabled("#btn-simpan-akun");
                    }
                }).fail(function(xhr, status, error) {
                    ClearFormData("#formAkun");
                    console.log('500 | Error save Akun');
                    undisabled("#btn-simpan-akun");
                }); 
    });
    $("#tableAkun").on('click', '#edit-akun', function(event) {
        event.preventDefault();
        $("#modalAkun").modal("show");
        var url, safe, id, form = $("#formAkun input");
            url = "<?php safeURL(site_url('backend/getAkunById')) ?>";
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
                        $("#kode").val(data.kode);
                        $("#nama").val(data.nama);
                        $("#data-jenis-akun").val(data.jenis);
                        $("#data-saldo-nominal").val(data.saldo);
                        form.prop('disabled', false);
                    }else{
                        console.log("500 | getAkunById false")
                        form.prop('disabled', false);
                    }
                },
                error: function(){
                    notif("Informasi", 'error', 'Ajax getAkunById error');
                    console.log("Ajax getAkunById error");
                    form.prop('disabled', false);
                }
            });
    });
    $("#tableAkun").on('click', '#hapus-akun', function(event) {
            event.preventDefault();
            var id = $(this).data('id'),
                url = "<?php safeURL(site_url('backend/hapusAkun')); ?>",
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
                                    ReloadTable(tableAkun);
                                },200);
                            }else{
                                notif("Informasi",'info','Data gagal dihapus');
                            }
                        },
                        error: function(){
                            notif("Informasi", 'error', 'Ajax hapus Akun error');
                            console.log("Ajax hapus Akun error");
                        }
                });
            });
    });
    function getKodeMasterAkunByJenisAkun(value){
        if (value === "") {
            alert('Value masih kosong');
        }else{
            var url, secure, html;
                url = "<?php safeURL(site_url('backend/getKodeMasterAkunByJenisAkun')) ?>";
                secure = readURL(url);
                html = $("#kode");
                $.post(secure, {jenis: value}, function(data, textStatus, xhr) {
                    if (xhr.status == 200) {
                        console.log('success get kode by jenis');
                        html.val(data);
                    }else{
                        alert('Query/ajax error');
                    }
                });
        }
    }
</script>