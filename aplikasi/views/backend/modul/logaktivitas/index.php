<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Aktivitas Pengguna</h5>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="tableLogAktivitas" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Lengkap</th>
                                            <th>Departement</th>
                                            <th>Divisi</th>
                                            <th>Jabatan</th>
                                            <th>Tanggal</th>
                                            <th>Aktivitas</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Lengkap</th>
                                            <th>Departement</th>
                                            <th>Divisi</th>
                                            <th>Jabatan</th>
                                            <th>Tanggal</th>
                                            <th>Aktivitas</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var tableLogAktivitas, url, safe;
    $(document).ready(function() {
        url = "<?php safeURL(site_url('backend/getLogAktivitas')) ?>";
        safe = readURL(url);
        tableLogAktivitas = $("#tableLogAktivitas").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            'ajax' : {
                'type': 'POST',
                'url': safe
             },
            'language': { "zeroRecords": "<center>Tidak ada data</center>" },
            'responsive': 'true' 
        });     
    });
</script>