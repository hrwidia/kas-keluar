<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Kas Keluar
                            <button href="#modalAkun" data-toggle="modal" class="btn waves-effect waves-light btn-grd-primary" onclick="ClearFormData('#formKasKeluar'), getNomorKas(), getDataAkunKas(), getDataUser(), getDataAkunDebet()">Tambah Data</button></h5>
                        </div>
                        <div class="card-block">
                            <table id="tableKasKeluar" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. Kas</th>
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Memo</th>
                                        <th>Akun</th>
                                        <th>Nominal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>No. Kas</th>
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Memo</th>
                                        <th>Akun</th>
                                        <th>Nominal</th>
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
                                    <h4 class="modal-title">Tambah Kas Keluar</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body model-container">
                                        <form id="formKasKeluar" method="post">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Akun Kas* </label>
                                                <div class="col-sm-10"> 
                                                    <select id="data-akun-kas" name="akun" required="on" class="form-control form-control-round">
                                                        <option id="defaultDataValueAkun" value="">Pilih Akun Kas</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Nomor Kas* </label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="nomor" id="nomor" class="form-control form-control-round" readonly="true" />
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> User* </label>
                                                <div class="col-sm-10"> 
                                                  <select id="data-user" name="user" required="on" class="form-control form-control-round">
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Memo* </label>
                                                <div class="col-sm-10"> 
                                                    <textarea id="memo" name="memo" class="form-control form-control-round" required="on"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Akun Debet* </label>
                                                <div class="col-sm-10"> 
                                                  <select id="data-debet" name="debet" required="on" class="form-control form-control-round">
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Nominal* </label>
                                                <div class="col-sm-10"> 
                                                    <input type="number" name="nominal" id="nominal" class="form-control form-control-round" required="on" />
                                                     <!-- onkeyup="checkNominal(this.value);" -->
                                                    <p id="info-nominal"></p>
                                                </div>
                                            </div>
                                            <br>
                                            <p><i>* Field Wajib diisi</i></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btn-simpan-kas-keluar" class="btn waves-effect waves-dark btn-primary btn-outline-primary">Simpan</button>
                                        <button type="button" class="btn waves-effect waves-dark btn-default btn-outline-danger" data-dismiss="modal" onclick="ClearFormData('#formKasKeluar')">Batal</button>
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
    var tableKasKeluar, url, safe;
    // var itu adalah deklarasi variable pada javascript;
    // table menggunakan datatable by ajax server side
    // # merupakan simbol untuk ID pada setiap element HTML
    $(document).ready(function() {
        url = "<?php safeURL(site_url('backend/getKasKeluar')) ?>";
        safe = readURL(url);
        tableKasKeluar = $("#tableKasKeluar").DataTable({
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
    function getDataAkunKas(){
        var url, secure;
            url = "<?php safeURL(site_url('backend/getDataAkunKas')) ?>";
            secure  = readURL(url);
            $("#data-akun-kas").empty('');
            $.ajax({
                url: secure,
                type: 'POST',
                dataType: 'JSON',
                success: function(data){
                    if (data) {
                        $.each(data, function(z, data) {
                            $("#data-akun-kas").append("<option value="+data.id+">"+data.kode+" - "+data.nama+"</option>");
                        });
                    }
                }
            });
    }
    function getNomorKas(){
        var url, secure;
            url = "<?php safeURL(site_url('backend/getNomorKas')) ?>";
            secure = readURL(url);
        $.post(secure, function(data, textStatus, xhr) {
            if (data) {
                $("#nomor").val(data);
            }else{
                $("#nomor").val("Ajax getNomorKas error.");
            }
        });
    }
    function getDataUser(){
        var url, secure;
            url = "<?php safeURL(site_url('backend/getDataUser')) ?>";
            secure  = readURL(url);
            $("#data-user").empty('');
            $.ajax({
                url: secure,
                type: 'POST',
                dataType: 'JSON',
                success: function(data){
                    if (data) {
                        $.each(data, function(z, data) {
                            $("#data-user").append("<option value="+data.id+">"+data.nama+"</option>");
                        });
                    }
                }
            });
    }
    function getDataAkunDebet(){
        var url, secure;
            url = "<?php safeURL(site_url('backend/getDataAkunDebet')) ?>";
            secure  = readURL(url);
            $("#data-debet").empty('');
            $.ajax({
                url: secure,
                type: 'POST',
                dataType: 'JSON',
                success: function(data){
                    if (data) {
                        $.each(data, function(z, data) {
                            $("#data-debet").append("<option value="+data.id+">"+data.kode+" - "+data.nama+"</option>");
                        });
                    }
                }
            });
    }
    $("#formKasKeluar").submit(function(event) {
        event.preventDefault();
        var data, url, safe, id = $("#id").val();
                url = "<?php safeURL(site_url('backend/simpanKasKeluar')) ?>";
                if (id !== "") {
                    url = "<?php safeURL(site_url('backend/updateKasKeluar')) ?>";
                }
                safe = readURL(url);
                data = $(this).serialize();
                disabled("#btn-simpan-kas-keluar");
                $.post(safe, data).done(function(data){
                    if (data.status == true) {
                        editTitleModal("modalJurnal", "Tambah Kas");
                        getNomorKas(), getDataAkunKas(), getDataUser(), getDataAkunDebet();
                        notif('Pemberitahuan', 'success', data.msg);
                        ReloadTable(tableKasKeluar);
                        ClearFormData("#formKasKeluar");
                        undisabled("#btn-simpan-kas-keluar");
                    }else{
                        ClearFormData("#formKasKeluar");
                        notif('Pemberitahuan', 'error', data.msg);
                        undisabled("#btn-simpan-kas-keluar");
                    }
                }).fail(function(xhr, status, error) {
                    ClearFormData("#formKasKeluar");
                    console.log('500 | Error save Akun');
                    undisabled("#btn-simpan-kas-keluar");
                }); 
    });
    $("#tableKasKeluar").on('click', '#edit-kas-keluar', function(event) {
        event.preventDefault();
        $("#modalAkun").modal("show");
        var url, safe, id, form = $("#formKasKeluar input");
            url = "<?php safeURL(site_url('backend/getKasKeluarById')) ?>";
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
                        editTitleModal("modalJurnal", "Edit Kas");
                        $("#id").val(data.id);
                        $("#data-akun-kas").val(data.Akunn);
                        $("#nomor").val(data.nomor);
                        $("#data-user").val(data.user);
                        $("#memo").text(data.memo);
                        $("#nominal").val(data.nominal);
                        getDataUser();
                        getDataAkunDebet();
                        getDataAkunKas();
                        form.prop('disabled', false);
                    }else{
                        console.log("500 | getKasKeluarById false")
                        form.prop('disabled', false);
                    }
                },
                error: function(){
                    notif("Informasi", 'error', 'Ajax getKasKeluarById error');
                    console.log("Ajax getKasKeluarById error");
                    form.prop('disabled', false);
                }
            });
    });
    $("#tableKasKeluar").on('click', '#hapus-kas-keluar', function(event) {
            event.preventDefault();
            var id = $(this).data('id'),
                url = "<?php safeURL(site_url('backend/hapusKasKeluar')); ?>",
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
                                    ReloadTable(tableKasKeluar);
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
    function checkNominal(nominal){
        if (nominal !== "") {
            var url, secure, id;
                url = "<?php safeURL(site_url('backend/checkNominal')) ?>";
                secure = readURL(url);
                id = $("#data-debet :selected").val();
                // variable
                // -------------------------------------------------------------------------
                $.post(secure, {nominal: nominal, id: id}, function(data, textStatus, xhr) {
                    if (data.code == 500) {
                        // saldo tidak mencukupi
                        $("#info-nominal").text('saldo tidak mencukupi');
                        disabled("#btn-simpan-kas-keluar");
                    }else{
                        // saldo mencukupi
                        $("#info-nominal").text('saldo mencukupi');
                        undisabled("#btn-simpan-kas-keluar");
                    }                    
                });
        }else{
            // alert('Nominal tidak boleh kosong');
            // Kredit sama Debit sama apa engga sih ?
            console.log('Nominal tidak boleh kosong');
        }
    }
</script>