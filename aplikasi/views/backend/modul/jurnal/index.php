<style type="text/css">
   @media print{
        html, body { 
            height: auto; 
        }
        .dt-print-table, 
        .dt-print-table thead, 
        .dt-print-table th, 
        .dt-print-table tr {
            border: 0 none !important;
        }
    }
</style>
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Jurnal 
                            <button href="#modalJurnal" data-toggle="modal" class="btn waves-effect waves-light btn-grd-primary" onclick="ClearFormData('#formJurnal'), getNomorJurnal(), getDataTransaksi()">Tambah Data</button></h5>
                        </div>
                        <div class="card-block">
                            <table id="tableJurnal" class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jurnal</th>
                                        <th>Kas</th>
                                        <th>User</th>
                                        <th>Akun</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Total</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Jurnal</th>
                                        <th>Kas</th>
                                        <th>User</th>
                                        <th>Akun</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Total</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade  modal-flex" id="modalJurnal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah jurnal</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                    <div class="modal-body model-container">
                                        <form id="formJurnal" method="post">
                                            <input type="hidden" name="id" id="id"/>
                                            <input type="hidden" name="id_kas_keluar" id="id_kas_keluar"/>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> No. Referensi* </label>
                                                <div class="col-sm-10"> 
                                                    <input type="text" name="nomor" id="nomor" class="form-control form-control-round" autocomplete="off" autosave="off" readonly="true" />
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Transaksi* </label>
                                                <div class="col-sm-10"> 
                                                    <select id="data-transaksi" name="transaksi" required="true" class="form-control form-control-round">
                                                        <option id="dataDefaultValueTransaksi" value="">Pilih Transaksi</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Tanggal* </label>
                                                <div class="col-sm-10"> 
                                                    <input type="date" name="tanggal" id="tanggal" required="on" class="form-control form-control-round" />
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-sm-2 col-form-label"> Keterangan* </label>
                                                <div class="col-sm-10"> 
                                                  <textarea id="keterangan" name="keterangan" class="form-control form-control-round" required="true" placeholder="Masukan keterangan transaksi"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <p><i>* Field Wajib diisi</i></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btn-simpan-jurnal" class="btn waves-effect waves-dark btn-primary btn-outline-primary">Simpan</button>
                                        <button type="button" class="btn waves-effect waves-dark btn-default btn-outline-danger" data-dismiss="modal" onclick="ClearFormData('#formJurnal')">Batal</button>
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
    var tableJurnal, url, safe;
    $(document).ready(function() {
        url = "<?php safeURL(site_url('backend/getJurnal')) ?>";
        safe = readURL(url);
        getNomorJurnal();
        tableJurnal = $("#tableJurnal").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            repeatingHead: {
                logo: 'https://www.google.co.in/logos/doodles/2018/world-cup-2018-day-22-5384495837478912-s.png',
                logoPosition: 'right',
                logoStyle: '',
                title: '<h3>Sample Heading</h3>'
            },
            ajax : {
                'type': 'POST',
                'url': safe
             },
            language: { "zeroRecords": "<center>Tidak ada data</center>" },
            responsive: true
        });     
    });
    function getNomorJurnal(){
        var url, secure;
            url = "<?php safeURL(site_url('backend/getNomorJurnal')) ?>";
            secure = readURL(url);
            $("#nomor").empty('');
            $.post(secure, function(data, textStatus, xhr) {
                if (data) {
                    $("#nomor").val(data);
                }else{
                    $("#nomor").val("ajax getNomorJurnal error");
                }
            });
    } 
    function getDataTransaksi(){
        var url, secure;
            url = "<?php safeURL(site_url('backend/getDataTransaksi')) ?>";
            secure = readURL(url);
            $("#data-transaksi").empty('');
            $.post(secure, function(data, textStatus, xhr) {
                if (data) {
                    $.each(data, function(z, data) {
                        $("#data-transaksi").append("<option value="+data.id+">"+data.nomor+" - "+data.nama_user+"</option>");
                    });
                }else{
                    alert('gagal mengambil data transaksi.');
                }
            });
    }
    $("#formJurnal").submit(function(event) {
        event.preventDefault();
        var data, url, safe, id = $("#id").val();
                url = "<?php safeURL(site_url('backend/simpanJurnal')) ?>";
                if (id !== "") {
                    url = "<?php safeURL(site_url('backend/updateJurnal')) ?>";
                }
                safe = readURL(url);
                data = $(this).serialize();
                disabled("#btn-simpan-jurnal");
                $.post(safe, data).done(function(data){
                    if (data.status == true) {
                        editTitleModal("modalJurnal", "Tambah Jurnal");
                        getNomorJurnal(), getDataTransaksi()
                        notif('Pemberitahuan', 'success', data.msg);
                        ReloadTable(tableJurnal);
                        ClearFormData("#formJurnal");
                        undisabled("#btn-simpan-jurnal");
                    }else{
                        ClearFormData("#formJurnal");
                        notif('Pemberitahuan', 'error', data.msg);
                        undisabled("#btn-simpan-jurnal");
                    }
                }).fail(function(xhr, status, error) {
                    ClearFormData("#formJurnal");
                    console.log('500 | Error save jurnal');
                    undisabled("#btn-simpan-jurnal");
                }); 
    });
    $("#tableJurnal").on('click', '#edit-jurnal', function(event) {
        event.preventDefault();
        $("#modalJurnal").modal("show");
        var url, safe, id, form = $("#formJurnal input");
            url = "<?php safeURL(site_url('backend/getJurnalById')) ?>";
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
                        editTitleModal("modalJurnal", "Edit Jurnal");
                        $("#id").val(data.id);
                        $("#kode").val(data.kode);
                        $("#nama").val(data.nama);
                        $("#data-jenis-jurnal").val(data.jenis);
                        $("#data-saldo-nominal").val(data.saldo);
                        form.prop('disabled', false);
                    }else{
                        console.log("500 | getjurnalById false")
                        form.prop('disabled', false);
                    }
                },
                error: function(){
                    notif("Informasi", 'error', 'Ajax getjurnalById error');
                    console.log("Ajax getjurnalById error");
                    form.prop('disabled', false);
                }
            });
    });
    $("#tableJurnal").on('click', '#hapus-jurnal', function(event) {
            event.preventDefault();
            var id = $(this).data('id'),
                url = "<?php safeURL(site_url('backend/hapusJurnal')); ?>",
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
                                    ReloadTable(tableJurnal);
                                },200);
                            }else{
                                notif("Informasi",'info','Data gagal dihapus');
                            }
                        },
                        error: function(){
                            notif("Informasi", 'error', 'Ajax hapus jurnal error');
                            console.log("Ajax hapus jurnal error");
                        }
                });
            });
    });
    // $("#formCariData").submit(function(event) {
    //     event.preventDefault();
    //     var url, secure, id, data;
    //         url = "<?php safeURL(site_url('backend/cariData')) ?>";
    //         secure = readURL(url);
    //         id = $("#id").val();
    //         data = $(this).serialize();
    //         $.post(secure, data, function(data, textStatus, xhr) {
    //             if (data) {
    //                 alet("success");
    //             }
    //         });
    // });
</script>
<!-- detail page -->
<!-- <div class="main-body" id="detail-page" hidden="true">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 id="title-detail-page"></h5>
                        </div>
                        <div class="card-block">
                            <table id="tableJurnal" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Akun</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Akun</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- detail page -->