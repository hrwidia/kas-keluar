<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Laporan Periode</h5>
                        </div>
                        <div class="card-block">
                            <div id="form-area">
                                <form id="form-periode" name="form-periode" method="POST">
                                    <input type="hidden" id="type" name="type" value="periode"/>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <select id="tahun" name="tahun" class="form-control form-control-round" required="on">
                                                <option id="default" value="">Pilih tahun</option>
                                                <?php 
                                                    $firstYear = (int)date('Y') - 24;
                                                    $lastYear = date('Y');
                                                    for($i=$firstYear;$i<=$lastYear;$i++){
                                                        echo '<option value='.$i.'>'.$i.'</option>';
                                                    }
                                                 ?>
                                            </select>
                                        </div> 
                                        <div class="col-sm-4">
                                            <button type="submit" name="search-by-bulan" id="search-by-bulan" class="btn btn-flat btn-sm btn-primary btn-flat btn-round">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="container">
                                <div id="link-download-laporan"></div>
                                <div id="target" hidden="true">
                                    <div class='container'>
                                        <center>
                                            <img id="images" src='<?php echo base_url('static/assets/images/windu.jpeg'); ?>' alt='header-img-report'/> <br/>
                                            <h4 id="text-header">Laporan Pengeluaran Periode : </h4> <hr>
                                            <div id='rata-kiri' style='float: left;'>
                                                <div class='container'>
                                                    <div id="info-tahun">Tahun : </div> <br/>
                                                    <div id="target-result">
                                                        <center>
                                                            <table align="center" class='table' id='tableReport'>
                                                                <thead>
                                                                    <tr>
                                                                        <th>Kode Jurnal</th>
                                                                        <th>Akun</th>
                                                                        <th>Debit</th>
                                                                        <th>Kredit</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr></tr>
                                                                </tbody>
                                                            </table>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </center>       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var url, secure, form, download;
        url = "<?php safeURL(site_url('backend/getLaporan')) ?>";
        secure = readURL(url);
        form = $("#form-periode");
        download = $("#link-download-laporan");
        $(form).submit(function(event) {
            event.preventDefault();
            var type, bulan, textBulan, tahun, textTahun;
                type = $("#type").val();
                tahun = $("#tahun :selected").val();
                textTahun = $("#tahun :selected").text();
                $.ajax({
                    url: secure,
                    data: {
                        type: type,
                        tahun: tahun,
                        textTahun: textTahun
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data){
                         if (data) { 
                            $("#target").prop('hidden', false);
                            $("#info-tahun").append(textTahun);
                            var target = $("#target-result"), tableHTML, i = 0;
                            for(var i = 0; data.length > i; i++){
                                if (data.length > 1) {
                                    console.log('data ada dua');
                                    var kredit = Number(data[i].kredit),
                                        debet  = Number(data[i].debet);  
                                }else{
                                    console.log('data cuman satu');
                                    var kredit = data[i].kredit,
                                        debet  = data[i].debet;
                                }
                            }
                            $.each(data, function(index, values) {
                                  var tr="<tr>";
                                   $.each(values, function(i,v){
                                       tr = tr+ "<td>"+v+"</td>";
                                   });
                                    tr= tr+"<tr><td colspan='2'>Jumlah:</td><td>"+kredit+"</td><td>"+debet+"</td></tr></tr>";
                                    $("tbody").append(tr);
                              });
                        }else{
                            console.log('ajax success, but proccess is failed.');
                        }
                    },
                    error: function(){
                        console.log('ajax error.');
                    } 
                });
        });
</script>