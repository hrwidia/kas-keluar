<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js'></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.1.1/jspdf.plugin.autotable.min.js"></script>
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Laporan Perbulan</h5>
                        </div>
                        <div class="card-block">
                            <!-- <iframe src="http://docs.google.com/gview?url=http://localhost/windu/perbulan&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe> -->
                            <div id="form-area">
                                <form id="form-bulan" name="form-bulan" method="POST">
                                    <input type="hidden" id="type" name="type" value="bulan"/>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <select id="bulan" name="bulan" required="on" class="form-control form-control-round">
                                                <option value="">Pilih bulan</option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
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
                                <a id="exportToPDF" hidden="true" href="javascript:HTML2Canvas()" class="btn btn-flat btn-sm btn-danger">Export to PDF</a>
                                <div id="link-download-laporan"></div>
                                <canvas id="canvas"></canvas>
                                <div class="target" id="target" hidden="true">
                                    <div class='container'>
                                        <center>
                                            <img id="images" src='<?php echo base_url('static/assets/images/windu.jpeg'); ?>' alt='header-img-report'/> <br/>
                                            <h4 id="text-header">Laporan Pengeluaran Per Bulan : </h4> <hr>
                                            <div id='rata-kiri' style='float: left;'>
                                                <div class='container'>
                                                    <div id="info-bulan">Bulan : </div> <br/>
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
                                <div id="bypassme"></div>
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
        form = $("#form-bulan");
        download = $("#link-download-laporan");
        $(form).submit(function(event) {
            event.preventDefault();
            var type, bulan, textBulan, tahun, textTahun;
                type = $("#type").val();
                bulan = $("#bulan :selected").val();
                textBulan = $("#bulan :selected").text();
                tahun = $("#tahun :selected").val();
                textTahun = $("#tahun :selected").text();
                // $("#target-result").html('').empty('');
                $.ajax({
                    url: secure,
                    data: {
                        type: type,
                        bulan: bulan,
                        text: textBulan,
                        tahun: tahun,
                        textTahun: textTahun
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                         if (data) { 
                            $("#target, #exportToPDF").prop('hidden', false);
                            $("#text-header").append(textBulan);
                            $("#info-bulan").append(textBulan);
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
                            var tr="<tr>";
                            $.each(data, function(index, values) {
                                   $.each(values, function(i,v){
                                       tr = tr+ "<td>"+v+"</td>";
                                   });
                                     tr= tr+"<tr><td colspan='2'>Jumlah:</td><td>"+kredit+"</td><td>"+debet+"</td></tr>";
                                    $("tbody").append(tr);
                              });
                            ExportToPDF();
                        }else{
                            console.log('ajax success, but proccess is failed.');
                        }
                    },
                    error: function(){
                        console.log('ajax error.');
                    } 
                });
        });
        function HTML2Canvas(){
            html2canvas($("#canvas"), {
            onrendered: function(canvas) { 
                var imgData = canvas.toDataURL('image/png');              
                ExportToPDF();        
                // var doc = new jsPDF('p', 'mm');
                // doc.addImage(imgData, 'PNG', 10, 10);
                // doc.save('sample-file.pdf');
            }
        });
        }
        function ExportToPDF() {
            var pdf = new jsPDF('p', 'pt', 'a4');
            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            source = $('.target')[0];

            // we support special element handlers. Register them with jQuery-style 
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors 
            // (class, of compound) at this time.
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#ignoreme': function (element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 50,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML(
                source, // HTML string or DOM elem ref.
                margins.left, // x coord
                margins.top, { // y coord
                    'width': margins.width, // max width of content on PDF
                    'elementHandlers': specialElementHandlers
                },

                function (dispose) {
                    // dispose: object with X, Y of the last line add to the PDF 
                    //          this allow the insertion of new lines after html
                    pdf.output('datauristring');
                    pdf.save('Laporan Perbulan - Sistem Pencatatan Pengeluaran Kas.pdf');
                }, margins
            );
            // var pdfOutput = pdf.output();
        }
</script>