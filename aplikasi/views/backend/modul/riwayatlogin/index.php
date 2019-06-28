<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Riwayat Login</h5>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="tableRiwayatLogin" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Lengkap</th>
                                            <th>OS</th>
                                            <th>Browser</th>
                                            <th>IP Address</th>
                                            <th>Versi</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Lengkap</th>
                                            <th>OS</th>
                                            <th>Browser</th>
                                            <th>IP Address</th>
                                            <th>Versi</th>
                                            <th>Tanggal</th>
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
    var tableRiwayatLogin, url, safe;
    $(document).ready(function() {
        url = "<?php safeURL(site_url('backend/getRiwayatLogin')) ?>";
        safe = readURL(url);
        tableRiwayatLogin = $("#tableRiwayatLogin").DataTable({
            'ajax' : {
                'type': 'POST',
                'url': safe
             },
            'language': { "zeroRecords": "<center>Tidak ada data</center>" },
            'responsive': 'true' 
        });     
    });
</script>