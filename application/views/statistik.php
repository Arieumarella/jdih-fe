<?php
$this->load->view("include/header");
echo "<br><br><br><br>";
//$this->load->view("widget/pencarian_cepat");
?>
<script src="<?php echo base_url(); ?>internal/assets/plugins/chart_js/dist/Chart.js"></script>
<script src="<?php echo base_url(); ?>internal/assets/plugins/chart_js/utils.js"></script>

<div class="main-content-wrapper section-padding-20">
    <div class="container">
        <div class="row mt-3">
            <!-- ============= Post Content Area Start ============= -->

            <div class="col-12 col-lg-8" style="margin-bottom:10px;">
                <table>
                    <tr>
                        <td>
                            <div class="input-group">
                                <select name="opsi" id="opsi" class="form-control select2" style="width:100%;">
                                    <option value="0">Total Semua</option>
                                    <option value="1">Inventarisasi 5 Tahun</option>
                                    <option value="2">Berlaku dan Tidak Berlaku</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group tahun-select">
                                <input type="hidden" name="" id="tahun_sekarang" value="<?= date('Y'); ?>">
                                <select name="tahun" id="tahun" class="form-control select2 tahun" style="width:100%; margin-left:20px;">
                                    <?php for ($i = 1970; $i <= date('Y'); $i++) { ?>
                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table><br>
                <label id='lbl_tahun'></label>
                <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                    <div id="div_prod" class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
                        <label style="color: #fff;margin-top:10px;margin-left:10px;">Total jenis produk hukum</label>
                    </div>
                    <div class="panel-body chart-jenis-peraturan" style="background-color:#fff;">
                        <canvas id="ChartJenisPeraturan" height="600"></canvas>
                    </div>
                </div>
                <table id="tabel_aturan" class="table-stripped table-bordered mt-3" style="width:100%;text-align:center;">
                    <thead>
                        <th class="align-middle">Peraturan</th>
                        <th class="align-middle">Total</th>
                    </thead>
                    <tbody id="var_tabel_aturan">

                    </tbody>
                </table>
                <div class="row legend_aturan_berlaku mt-3">
                    <div class="col-md-1" style="background-color:rgb(0, 0, 255);margin-left:30px;"></div>
                    <div class="col-md-3">Aturan Berlaku</div>
                    <div class="col-md-1" style="background-color:rgb(254, 2, 2);margin-left:30px;"></div>
                    <div class="col-md-3">Aturan Tidak Berlaku</div>
                </div>
                <table id="tabel_aturan_berlaku" class="table-stripped table-bordered mt-3" style="width:100%;text-align:center;">
                    <thead>
                        <th class="align-middle">Peraturan</th>
                        <th class="align-middle">Total Aturan Berlaku</th>
                        <th class="align-middle">Total Aturan Tidak Berlaku</th>
                    </thead>
                    <tbody id="var_tabel_aturan_berlaku">

                    </tbody>
                </table>
                <br />
                <table>
                    <tr>
                        <td>
                            <div class="input-group">
                                <select name="status" id="status" class="form-control select2" style="width:100%;">
                                    <option value="">Pilih Status</option>
                                    <option value="0">Berlaku</option>
                                    <option value="1">Tidak Berlaku</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                    <div id="div_prod" class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
                        <label style="color: #fff;margin-top:10px;margin-left:10px;">Total produk Perundangan dari Unit Organisasi</label>
                    </div>
                    <div class="panel-body my-chart-satu" style="background-color:#fff;">
                        <canvas id="myChart" height="600"></canvas>
                    </div>
                </div>
                <br />
                <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                    <div id="div_prod" class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
                        <label style="color: #fff;margin-top:10px;margin-left:10px;">Total Unduhan</label>
                    </div>
                    <div class="panel-body" style="background-color:#fff;">
                        <canvas id="ChartUnduhan" height="1000"></canvas>
                    </div>
                </div>
                <br />
                <div class="panel panel-default" style="border: 2px solid #D2D6DE;border-radius:5px;background-color:#fff;width:100%">
                    <div id="div_prod" class="panel-heading" style="background-color: #45678d;height:50px;border-bottom:3px solid #fcfcfc;">
                        <label style="color: #fff;margin-top:10px;margin-left:10px;">Total produk perundangan yang dilihat</label>
                    </div>
                    <div class="panel-body" style="background-color:#fff;">
                        <canvas id="Chartviewer" height="1000"></canvas>
                    </div>
                </div>

                <div> <?php $this->load->view("widget/subscribe"); ?></div>


            </div>
            <!-- ========== Sidebar Area ========== -->
            <div class="col-12  col-lg-4" style="width:100%">
                <div style="width:100%">
                    <!-- Widget Area -->
                    <?php $this->load->view("widget/list_jenis_produk_hukum"); ?>
                    <?php $this->load->view("widget/list_produk_hukum_populer"); ?>
                    <?php $this->load->view("widget/list_unit_kerja"); ?>

                    <?php $this->load->view("widget/list_link_terkait"); ?>
                    <?php $this->load->view("widget/list_statistik_pengunjung"); ?>

                    <!-- ============= 08122020 kuesioner ============= -->
                    <a target="_blank" href="https://forms.gle/tE4yg1AdTdgRaVXU8"><img border="0" alt="kuesioner" src="<?php echo base_url() ?>assets/img/kuesioner.png"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#lbl_tahun").hide();

    })
    $('#opsi').on('change', function() {
        $('#tabel_aturan').hide();
        $('#tabel_aturan_berlaku').hide();
        $('#tabel_aturan tbody').empty();
        $('#tabel_aturan_berlaku tbody').empty();
        $('.legend_aturan_berlaku').hide();

        var opsi = $(this).val();
        if (opsi == '0') {
            $('.tahun-select').hide();
            $("#lbl_tahun").hide();
        } else {
            $('.tahun-select').show();
            $("#lbl_tahun").show();
            var tahun_sekarang = $('#tahun_sekarang').val();
            $('.tahun').val(tahun_sekarang);
            var awal = $("#tahun").val();
            var akhir = eval(awal) - 4;
            $("#lbl_tahun").html('Periode ' + awal + ' s/d ' + akhir + '');
        }
        var tahun = $('.tahun option:selected').val();
        var tahun_old = tahun - 4;

        var a = 1;
        // function
        createChart(opsi, tahun, tahun_old);
    }).trigger('change');

    $('.tahun').on('change', function() {
        $("#lbl_tahun").show();
        $('#tabel_aturan').hide();
        $('#tabel_aturan_berlaku').hide();
        $('#tabel_aturan tbody').empty();
        $('#tabel_aturan_berlaku tbody').empty();
        $('.legend_aturan_berlaku').hide();
        var tahun = $(this).val();
        var tahun_old = tahun - 4;
        var opsi = $('#opsi option:selected').val();
        var awal = $("#tahun").val();
        var akhir = eval(awal) - 4;
        $("#lbl_tahun").html('Periode ' + awal + ' s/d ' + akhir + '');
        // function
        createChart(opsi, tahun, tahun_old);

    }).trigger('change');

    function createChart(opsi, tahun, tahun_old) {
        //$('#tabel_aturan tbody').empty();


        $('#ChartJenisPeraturan').remove(); // this is my <canvas> element
        $('.chart-jenis-peraturan').append('<canvas id="ChartJenisPeraturan" height="1000"><canvas>');
        if (opsi != '2') {
            var ctxb = document.getElementById('ChartJenisPeraturan');
            var ChartJenisPeraturan = new Chart(ctxb, {
                type: 'horizontalBar',
                data: {
                    labels: [],
                    datasets: [{
                        labels: "Total",
                        backgroundColor: [],
                        borderColor: [],
                        data: [],
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    showAllTooltips: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        yAlign: 'right',
                        backgroundColor: '#797A7C'
                    }
                },
                plugins: [{
                    beforeRender: function(chart) {
                        if (chart.config.options.showAllTooltips) {
                            // create an array of tooltips
                            // we can't use the chart tooltip because there is only one tooltip per chart
                            chart.pluginTooltips = [];
                            chart.config.data.datasets.forEach(function(dataset, i) {
                                chart.getDatasetMeta(i).data.forEach(function(sector, j) {
                                    chart.pluginTooltips.push(new Chart.Tooltip({
                                        _chart: chart.chart,
                                        _chartInstance: chart,
                                        _data: chart.data,
                                        _options: chart.options.tooltips,
                                        _active: [sector]
                                    }, chart));
                                });
                            });
                            // turn off normal tooltips
                            chart.options.tooltips.enabled = false;
                        }
                    },
                    afterDraw: function(chart, easing) {
                        if (chart.config.options.showAllTooltips) {
                            // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                            if (!chart.allTooltipsOnce) {
                                if (easing !== 1)
                                    return;
                                chart.allTooltipsOnce = true;
                            }

                            // turn on tooltips
                            chart.options.tooltips.enabled = true;
                            Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
                                tooltip.initialize();
                                tooltip.update();
                                // we don't actually need this since we are not animating tooltips
                                tooltip.pivot();
                                tooltip.transition(easing).draw();
                            });
                            chart.options.tooltips.enabled = false;
                        }
                    }
                }]
            });
            // if (ChartJenisPeraturan != undefined || ChartJenisPeraturan !=null) {
            //     ChartJenisPeraturan.destroy();
            // }

            $.ajax({
                url: "<?php echo base_url(); ?>statistik/get_peraturan",
                dataType: "JSON",
                type: "POST",
                data: {
                    opsi: opsi,
                    tahun: tahun,
                    tahun_old: tahun_old
                },
                success: function(result) {
                    $('#tabel_aturan').show();
                    $('#var_tabel_aturan').empty();
                    $.each(result, function(key, value) {
                        //console.log('<tr> <td class="align-middle">' + value.kategori+ '</td>  <td class="align-middle">' + value.peraturan + '</td> </tr>')
                        $('#var_tabel_aturan').append('<tr> <td class="align-middle">' + value.kategori + '</td>  <td class="align-middle">' + value.peraturan + '</td> </tr>');
                    });

                    var peraturan = [];
                    var kategori = [];
                    var background_color = [];
                    for (let i = 0; i < result.length; i++) {
                        if (i % 2 != 0) {
                            background_color.push('rgb(153, 102, 255)')
                        } else {
                            background_color.push('rgb(255, 206, 86)')
                        }
                        kategori.push(result[i]["kategori"]);
                        peraturan.push(result[i]["peraturan"]);
                    }
                    console.log(peraturan);
                    ChartJenisPeraturan.data.labels = kategori;
                    ChartJenisPeraturan.data.datasets[0].data = peraturan;
                    ChartJenisPeraturan.data.datasets[0].backgroundColor = background_color;
                    console.log(ChartJenisPeraturan.data);

                    // re-render the chart
                    ChartJenisPeraturan.update();
                }
            });
        } else if (opsi == '2') {
            $('#ChartJenisPeraturan').remove(); // this is my <canvas> element
            $('.chart-jenis-peraturan').append('<canvas id="ChartJenisPeraturan" height="1000"><canvas>');
            var ctxb = document.getElementById('ChartJenisPeraturan');
            var ChartJenisPeraturan = new Chart(ctxb, {
                type: 'horizontalBar',
                data: {
                    labels: [],
                    datasets: [{
                            labels: "Berlaku",
                            backgroundColor: 'rgb(0, 0, 255)',
                            borderColor: 'rgb(0, 0, 255)',
                            data: [],
                        },
                        {
                            labels: "Tidak Berlaku",
                            backgroundColor: 'rgb(254, 2, 2)',
                            borderColor: 'rgb(254, 2, 2)',
                            data: [],
                        }
                    ]
                    // datasets: [{
                    //     labels: "Tidak Berlaku",
                    //     backgroundColor: 'rgb(100, 99, 132)',
                    //     borderColor: 'rgb(100, 99, 132)',
                    //     data: [],
                    // }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    showAllTooltips: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                        title: {
                            display: true,
                            text: ['Berlaku', 'Tidak Berlaku']
                        },
                    },
                    tooltips: {
                        yAlign: 'right',
                        backgroundColor: '#797A7C'
                    }
                },
                plugins: [{
                    beforeRender: function(chart) {
                        if (chart.config.options.showAllTooltips) {
                            // create an array of tooltips
                            // we can't use the chart tooltip because there is only one tooltip per chart
                            chart.pluginTooltips = [];
                            chart.config.data.datasets.forEach(function(dataset, i) {
                                chart.getDatasetMeta(i).data.forEach(function(sector, j) {
                                    chart.pluginTooltips.push(new Chart.Tooltip({
                                        _chart: chart.chart,
                                        _chartInstance: chart,
                                        _data: chart.data,
                                        _options: chart.options.tooltips,
                                        _active: [sector]
                                    }, chart));
                                });
                            });
                            // turn off normal tooltips
                            chart.options.tooltips.enabled = false;
                        }
                    },
                    afterDraw: function(chart, easing) {
                        if (chart.config.options.showAllTooltips) {
                            // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                            if (!chart.allTooltipsOnce) {
                                if (easing !== 1)
                                    return;
                                chart.allTooltipsOnce = true;
                            }

                            // turn on tooltips
                            chart.options.tooltips.enabled = true;
                            Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
                                tooltip.initialize();
                                tooltip.update();
                                // we don't actually need this since we are not animating tooltips
                                tooltip.pivot();
                                tooltip.transition(easing).draw();
                            });
                            chart.options.tooltips.enabled = false;
                        }
                    }
                }]
            });

            $.ajax({
                url: "<?php echo base_url(); ?>statistik/get_peraturan_by_status",
                dataType: "JSON",
                type: "POST",
                data: {
                    opsi: opsi,
                    tahun: tahun,
                    tahun_old: tahun_old
                },
                success: function(result) {
                    $('#tabel_aturan_berlaku').show();
                    $('.legend_aturan_berlaku').show();
                    $.each(result, function(key, value) {
                        $('#var_tabel_aturan_berlaku').append('<tr> <td class="align-middle">' + value.kategori + '</td>  <td class="align-middle">' + value.peraturan_berlaku + '</td> <td class="align-middle">' + value.peraturan_tidak_berlaku + '</td> </tr>');
                    });
                    var peraturan_berlaku = [];
                    var peraturan_tidak_berlaku = [];
                    var kategori = [];
                    for (let i = 0; i < result.length; i++) {
                        kategori.push(result[i]["kategori"]);
                        peraturan_berlaku.push(result[i]["peraturan_berlaku"]);
                        peraturan_tidak_berlaku.push(result[i]["peraturan_tidak_berlaku"]);
                    }
                    ChartJenisPeraturan.data.labels = kategori;
                    ChartJenisPeraturan.data.datasets[0].data = peraturan_berlaku;
                    ChartJenisPeraturan.data.datasets[1].data = peraturan_tidak_berlaku;
                    console.log(ChartJenisPeraturan.data);

                    // re-render the chart
                    ChartJenisPeraturan.update();
                }
            });
        }
    }
    $('#status').on('change', function() {
        var value = this.value;
        $.ajax({
            url: "<?php echo base_url(); ?>statistik/kirim_value",
            dataType: "JSON",
            type: "POST",
            data: {
                value: value
            },
            success: function(data) {
                var array = [];
                var jumlah_data = [];
                var background_color = [];
                for (let index = 0; index < data.length; index++) {
                    array.push(data[index].deptcode)
                    if (index % 2 != 0) {
                        background_color.push('rgba(153, 102, 255, 1)')
                    } else {
                        background_color.push('rgba(255, 206, 86, 1)')
                    }
                }
                if (data.length > 0) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>statistik/jumlah_peraturan",
                        dataType: "JSON",
                        type: "POST",
                        data: {
                            data: data
                        },
                        success: function(result) {
                            for (let index = 0; index < result.length; index++) {
                                jumlah_data.push(result[index])
                            }
                            chart1(array, jumlah_data, background_color)
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError);
                        }
                    })
                } else {
                    $('#myChart').remove(); // this is my <canvas> element
                    $('.my-chart-satu').append('<div id="myChart" height="600">Kosong</div>');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        }); // <--- RIGHT HERE;

        function chart1(array, jumlah_data, background_color) {
            $('#myChart').remove(); // this is my <canvas> element
            $('.my-chart-satu').append('<canvas id="myChart" height="600"></canvas>');
            var ctx = document.getElementById('myChart');

            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: array,
                    datasets: [{
                        label: 'Total ',
                        data: jumlah_data,
                        backgroundColor: background_color,
                        borderColor: background_color,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    showAllTooltips: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        yAlign: 'right',
                        backgroundColor: '#797A7C'
                    }
                },
                plugins: [{
                    beforeRender: function(chart) {
                        if (chart.config.options.showAllTooltips) {
                            // create an array of tooltips
                            // we can't use the chart tooltip because there is only one tooltip per chart
                            chart.pluginTooltips = [];
                            chart.config.data.datasets.forEach(function(dataset, i) {
                                chart.getDatasetMeta(i).data.forEach(function(sector, j) {
                                    chart.pluginTooltips.push(new Chart.Tooltip({
                                        _chart: chart.chart,
                                        _chartInstance: chart,
                                        _data: chart.data,
                                        _options: chart.options.tooltips,
                                        _active: [sector]
                                    }, chart));
                                });
                            });
                            // turn off normal tooltips
                            chart.options.tooltips.enabled = false;
                        }
                    },
                    afterDraw: function(chart, easing) {
                        if (chart.config.options.showAllTooltips) {
                            // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                            if (!chart.allTooltipsOnce) {
                                if (easing !== 1)
                                    return;
                                chart.allTooltipsOnce = true;
                            }

                            // turn on tooltips
                            chart.options.tooltips.enabled = true;
                            Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
                                tooltip.initialize();
                                tooltip.update();
                                // we don't actually need this since we are not animating tooltips
                                tooltip.pivot();
                                tooltip.transition(easing).draw();
                            });
                            chart.options.tooltips.enabled = false;
                        }
                    }
                }]
            });
        }
        var ctxc = document.getElementById('ChartUnduhan');
        var ChartUnduhan = new Chart(ctxc, {
            type: 'horizontalBar',
            data: {
                labels: [
                    <?php
                    $data_peraturan_dua = $this->Mdl_statistik->ambil_peraturan();
                    foreach ($data_peraturan_dua as $dp_dua) {
                        echo "'" . $dp_dua['percategorycode'] . "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Total Unduhan',
                    data: [
                        <?php
                        foreach ($data_peraturan_dua as $dpc) {
                            $data_unduhan = $this->Mdl_statistik->ambil_unduhan($dpc['peraturan_category_id']);
                            $jumlah_unduhan = 0;
                            foreach ($data_unduhan as $du) {
                                $unduhan = $du['download_count'];
                                $jumlah_unduhan = $jumlah_unduhan + $unduhan;
                            }
                            echo $jumlah_unduhan . ",";
                        }
                        ?>
                    ],
                    backgroundColor: [
                        <?php
                        $e = 0;
                        foreach ($data_peraturan_dua as $dp_dua_c) {

                            $e++;
                            if ($e % 2 == 0) {
                                echo "'rgba(153, 102, 255, 1)',";
                            } else {
                                echo "'rgba(255, 206, 86, 1)',";
                            }
                        }
                        ?>

                    ],
                    borderColor: [
                        <?php
                        $f = 0;
                        foreach ($data_peraturan_dua as $dp_dua_d) {

                            $f++;
                            if ($f % 2 == 0) {
                                echo "'rgba(153, 102, 255, 1)',";
                            } else {
                                echo "'rgba(255, 206, 86, 1)',";
                            }
                        }
                        ?>
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                showAllTooltips: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    yAlign: 'right',
                    backgroundColor: '#797A7C'
                }
            },
            plugins: [{
                beforeRender: function(chart) {
                    if (chart.config.options.showAllTooltips) {
                        // create an array of tooltips
                        // we can't use the chart tooltip because there is only one tooltip per chart
                        chart.pluginTooltips = [];
                        chart.config.data.datasets.forEach(function(dataset, i) {
                            chart.getDatasetMeta(i).data.forEach(function(sector, j) {
                                chart.pluginTooltips.push(new Chart.Tooltip({
                                    _chart: chart.chart,
                                    _chartInstance: chart,
                                    _data: chart.data,
                                    _options: chart.options.tooltips,
                                    _active: [sector]
                                }, chart));
                            });
                        });
                        // turn off normal tooltips
                        chart.options.tooltips.enabled = false;
                    }
                },
                afterDraw: function(chart, easing) {
                    if (chart.config.options.showAllTooltips) {
                        // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                        if (!chart.allTooltipsOnce) {
                            if (easing !== 1)
                                return;
                            chart.allTooltipsOnce = true;
                        }

                        // turn on tooltips
                        chart.options.tooltips.enabled = true;
                        Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
                            tooltip.initialize();
                            tooltip.update();
                            // we don't actually need this since we are not animating tooltips
                            tooltip.pivot();
                            tooltip.transition(easing).draw();
                        });
                        chart.options.tooltips.enabled = false;
                    }
                }
            }]
        });
        var ctxc = document.getElementById('Chartviewer');
        var Chartviewer = new Chart(ctxc, {
            type: 'horizontalBar',
            data: {
                labels: [
                    <?php
                    foreach ($data_peraturan_dua as $dp_tiga) {
                        echo "'" . $dp_tiga['percategorycode'] . "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Total',
                    data: [
                        <?php
                        foreach ($data_peraturan_dua as $dpd) {
                            $data_viewer = $this->Mdl_statistik->ambil_viewer($dpd['peraturan_category_id']);
                            $jumlah_viewer = 0;
                            foreach ($data_viewer as $dv) {
                                $viewer = $dv['view_count'];
                                $jumlah_viewer = $jumlah_viewer + $viewer;
                            }
                            echo $jumlah_viewer . ",";
                        }
                        ?>
                    ],
                    backgroundColor: [
                        <?php
                        $g = 0;
                        foreach ($data_peraturan_dua as $dp_tiga_c) {
                            $g++;
                            if ($g % 2 == 0) {
                                echo "'rgba(153, 102, 255, 1)',";
                            } else {
                                echo "'rgba(255, 206, 86, 1)',";
                            }
                        }
                        ?>

                    ],
                    borderColor: [
                        <?php
                        $h = 0;
                        foreach ($data_peraturan_dua as $dp_tiga_d) {
                            $h++;
                            if ($h % 2 == 0) {
                                echo "'rgba(153, 102, 255, 1)',";
                            } else {
                                echo "'rgba(255, 206, 86, 1)',";
                            }
                        }
                        ?>
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                showAllTooltips: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    yAlign: 'right',
                    backgroundColor: '#797A7C'
                }
            },
            plugins: [{
                beforeRender: function(chart) {
                    if (chart.config.options.showAllTooltips) {
                        // create an array of tooltips
                        // we can't use the chart tooltip because there is only one tooltip per chart
                        chart.pluginTooltips = [];
                        chart.config.data.datasets.forEach(function(dataset, i) {
                            chart.getDatasetMeta(i).data.forEach(function(sector, j) {
                                chart.pluginTooltips.push(new Chart.Tooltip({
                                    _chart: chart.chart,
                                    _chartInstance: chart,
                                    _data: chart.data,
                                    _options: chart.options.tooltips,
                                    _active: [sector]
                                }, chart));
                            });
                        });
                        // turn off normal tooltips
                        chart.options.tooltips.enabled = false;
                    }
                },
                afterDraw: function(chart, easing) {
                    if (chart.config.options.showAllTooltips) {
                        // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
                        if (!chart.allTooltipsOnce) {
                            if (easing !== 1)
                                return;
                            chart.allTooltipsOnce = true;
                        }

                        // turn on tooltips
                        chart.options.tooltips.enabled = true;
                        Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
                            tooltip.initialize();
                            tooltip.update();
                            // we don't actually need this since we are not animating tooltips
                            tooltip.pivot();
                            tooltip.transition(easing).draw();
                        });
                        chart.options.tooltips.enabled = false;
                    }
                }
            }]
        });
    }).trigger('change');
</script>
<?php
$this->load->view("include/footer") ?>