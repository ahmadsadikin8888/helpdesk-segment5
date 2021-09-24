<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <?php
    if (isset($_GET['start'])) {
    } else {
    ?>
        <!-- <meta http-equiv="refresh" content="300"> -->
    <?php
    }
    ?>

    <meta charset="UTF-8">
    <title>HELPDESK - DASHBOARD</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <link href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />

    <!-- END: Page CSS-->


    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script> -->
    <!-- END: Page CSS-->
    <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bundle.js"></script>
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default horizontal-menu">

    <!-- START: Pre Loader-->
    <div class="se-pre-con">
        <div class="loader"></div>
    </div>
    <!-- END: Pre Loader-->

    <!-- START: Header-->
    <div id="header-fix" class="header fixed-top">
        <div class="site-width">
            <nav class="navbar navbar-expand-lg  p-0">
                <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                    <a href="index.html" class="horizontal-logo text-left">
                        <span class="h6 font-weight-bold align-self-center mb-0 ml-auto"><?php echo  date("h:i A", strtotime($last_update->lup)); ?></span>
                    </a>
                </div>
                <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                    <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                </div>
                <div class="navbar-right ml-auto h-100">

                    <div class="media">
                        <img src="<?php echo base_url(); ?>assets/new_theme/dist/images/logo2.png" alt="" class="d-flex img-fluid mt-1" width="150">
                    </div>

                </div>

            </nav>
        </div>
    </div>
    <!-- END: Header-->



    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">Dashboard</h4>
                            <p>Welcome to Dashboard</p>
                        </div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->
            <div class="row">
                <div class="col-12">
                    <?php

                    if ($userdata->opt_level == 8) {
                    ?>
                        <form method="GET" action="#">
                            <input type="hidden" name="start" id="start" value="<?php echo $start; ?>"><input type="hidden" name="end" id="end" value="<?php echo $end; ?>">
                        </form>
                        <br>
                    <?php
                    } else {
                    ?>
                        <form method="GET" action="#">
                            From <input type="date" name="start" id="start" value="<?php echo $start; ?>"><input type="date" name="end" id="end" value="<?php echo $end; ?>"><button type="submit" id="filter">Filter</button><br>
                        </form>
                        <br>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($dapros + $wo); ?></h2>
                                <h6 class="card-liner-subtitle">DATA WAITLIST</h6>
                            </div>

                        </div>
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($wo); ?></h2>
                                <h6 class="card-liner-subtitle">DATA DISTRIBUTION</h6>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class='p-4 align-self-center'>
                                <h2><?php echo number_format($oc); ?></h2>
                                <h6 class="card-liner-subtitle">DATA CONSUME</h6>
                            </div>
                            <div class="barfiller" data-color="#1ee0ac">
                                <div class="tipWrap">
                                    <span class="tip rounded success">
                                        <span class="tip-arrow"></span>
                                    </span>
                                </div>
                                <span class="fill" data-percentage="<?php echo number_format(($oc / ($wo + $oc)) * 100, 2); ?>"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">By Status </h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-0">
                                <div style="height:255px;">
                                    <canvas id="chartjs-other-pie"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title">By AGES </h6>
                            </div>
                            <div class="card-body">
                                <div id="apex_analytic_arpu"></div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="d-flex mt-4">
                                    <div class="border-0 outline-badge-danger w-100 p-3 rounded text-center"><span class="h5 mb-0"><?php echo count($pending); ?></span><br />
                                        Data Pending
                                    </div>
                                </div>
                                <div class="d-flex mt-4">
                                    <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"><?php echo $all_agent; ?></span><br />
                                        TOTAL PETUGAS
                                    </div>
                                    <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">
                                            <?php echo $all_agent; ?>
                                        </span><br />
                                        ONLINE
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div style="font-size:25px;text-align:center;position:absolute;margin-left:100px;">Response time</div>
                    <div id="break_chart" style="min-width: 250px; width: 100%;margin-top:10px;color:#a0bc2e;"></div>
                    <div style="color:#ff8e35;font-size:40px;text-align:center;margin-top:-50px;position:absolute;margin-left:144px;" id='break'><?php echo $aht; ?></div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">TOP 3 PS Petugas</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled">
                                    <?php
                                    if (count($byna) > 0) {
                                        foreach ($byna as $key => $val) {
                                            $clr = "#1ee0ac";
                                            $stl = "success";
                                    ?>
                                            <li class="p-4 border-bottom">
                                                <div class="w-100">
                                                    <span><?php echo $key; ?></span>
                                                    <div class="barfiller h-7 rounded" data-color="<?php echo $clr; ?>">
                                                        <span class="fill" data-percentage="<?php echo number_format(($val / $wona[$key]) * 100); ?>"></span><?php echo number_format(($val / $wona[$key]) * 100); ?>%
                                                    </div>
                                                </div>
                                            </li>
                                    <?php
                                        }
                                    }

                                    ?>



                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">

                <div class="col-12 col-md-8  col-lg-12   mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Status VA,PI AND PS By Channel</h5>

                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="apex_analytic_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- START: Card Data-->
            <div class="row">

                <div class="col-12 col-lg-12  mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">PS By Channel and Petugas</h5>

                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <table class="table dataTable table-striped table-bordered" id="byagent">
                                    <thead>
                                        <tr>
                                            <td>
                                                Pertugas
                                            </td>
                                            <td>ERROR</td>
                                            <td>TAM</td>
                                            <td>MYIH</td>
                                            <td>MOSS</td>
                                            <td>147</td>
                                            <td>PLASA</td>
                                            <td>NOSSA</td>
                                            <td>SOSMED</td>
                                            <td>TREG</td>
                                            <td>WITEL</td>
                                            <td>C4</td>
                                            <td>TEKNISI</td>
                                            <td>OTHERS</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $channel = array("ERROR", "TAM", "MY IH", "MOSS", "147", "PLASA", "Nossa", "SOSMED", "TREG", "WITEL", "c4", "TEKNISI", "OTHERS");
                                        $petugas_channel = array();
                                        $all_channel = array();
                                        foreach ($channel as $chd) {
                                            $all_channel[$chd]["status_1"] = 0;
                                            $all_channel[$chd]["status_2"] = 0;
                                            $all_channel[$chd]["status_3"] = 0;
                                            if ($chd == "ERROR") {

                                                if (count($chanel_error_petugas) > 0) {


                                                    foreach ($chanel_error_petugas as $r2) {

                                                        $all_channel[$chd]["status_" . $r2->STATUS] = $r2->numna + $all_channel[$chd]["status_" . $r2->STATUS];
                                                        $petugas_channel[$r2->agentid][$chd]['status_' . $r2->STATUS] = $r2->numna + $petugas_channel[$r2->agentid][$chd]['status_' . $r2->STATUS];
                                                        if ($r2->STATUS == 3) {
                                                            $all_channel["total"] = $r2->numna + $all_channel["total"];
                                                            $petugas_channel[$r2->agentid]['total'] = $r2->numna + $petugas_channel[$r2->agentid]['total'];
                                                        }
                                                    }
                                                }
                                            }
                                            if (count($chanel_petugas) > 0) {

                                                foreach ($chanel_petugas as $r) {

                                                    // $petugas_channel[$r->agentid][$chd] = 0;
                                                    if ($chd == $r->channelna) {
                                                        $all_channel[$chd]["status_" . $r->STATUS] = $r->numna + $all_channel[$chd]["status_" . $r->STATUS];
                                                        $petugas_channel[$r->agentid][$chd]['status_' . $r->STATUS] = $r->numna + $petugas_channel[$r->agentid][$chd]['status_' . $r->STATUS];
                                                        if ($r->STATUS == 3) {
                                                            $all_channel["total"] = $r->numna + $all_channel["total"];
                                                            $petugas_channel[$r->agentid]['total'] = $r->numna + $petugas_channel[$r->agentid]['total'];
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        if ($agent['num'] > 0) {
                                            foreach ($agent['results'] as $pt) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $pt->nama ?></td>
                                                    <?php
                                                    foreach ($channel as $chd) {
                                                        $ps = 0;

                                                        if (isset($petugas_channel[$pt->agentid][$chd]['status_3'])) {
                                                            $ps = $petugas_channel[$pt->agentid][$chd]['status_3'];
                                                        }
                                                        echo "<td>" . $ps . "</td>";
                                                    }
                                                    ?>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>





        </div>
    </main>
    <!-- END: Content-->
    <!-- START: Footer-->
    <footer class="site-footer">
        2020 © Sy-ANIDA
    </footer>
    <!-- END: Footer-->



    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>


    <!-- START: Template JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- END: Template JS-->

    <!-- START: APP JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.js"></script>
    <!-- END: APP JS-->



    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.barfiller.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->

    <!---- START page datatable--->
    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page Script JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/datatable.script.js"></script>
    <!-- END: Page Script JS-->


    <!---- END page datatable--->

    <!-- END: Back to top-->
    <script type="text/javascript">
        if ($('.barfiller').length > 0) {
            $(".barfiller").each(function() {
                $(this).barfiller({
                    barColor: $(this).data('color')
                });
            });
        }
        $('#byagent').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [
                [0, "asc"]
            ],
            responsive: true
        });
        /////////////////////////////////// Analytic Chart /////////////////////
        /////////////////////////////////// Analytic Chart /////////////////////
        if ($("#apex_analytic_chart").length > 0) {
            options = {
                theme: {
                    mode: 'light'
                },
                chart: {
                    height: 350,
                    type: 'bar',
                },
                responsive: [{
                    breakpoint: 767,
                    options: {
                        chart: {
                            height: 220
                        }
                    }
                }],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                colors: ['#1e3d73','#17a2b8' ,'#6c757d', '#1ee0ac'],
                series: [
                    {
                        name: 'VA',
                        data: [
                            <?php
                            foreach ($channel as $ch) {
                                echo intval($all_channel[$ch]['status_1']) . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        name: 'PI',
                        data: [
                            <?php
                            foreach ($channel as $ch) {
                                echo intval($all_channel[$ch]['status_2']) . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        name: 'CA',
                        data: [
                            <?php
                            foreach ($channel as $ch) {
                                echo intval($all_channel[$ch]['status_4']) . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        name: 'PS',
                        data: [
                            <?php
                            foreach ($channel as $ch) {
                                echo intval($all_channel[$ch]['status_3']) . ",";
                            }
                            ?>
                        ]
                    },

                ],
                xaxis: {
                    categories: [
                        <?php
                        foreach ($channel as $ch) {
                            echo "'" . $ch . "',";
                        }

                        ?>
                    ],
                },
                yaxis: {
                    title: {
                        text: ''
                    }
                },
                fill: {
                    opacity: 1

                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " "
                        }
                    }
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#apex_analytic_chart"),
                options
            );
            chart.render();
        }

        ////////////////////////////////// status Stats Chart /////////////////////////////


        ////pie chart break///
        var chart;
        var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
        var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
        var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');
        var config_break = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        <?php
                        if (count($master_status) > 0) {
                            foreach ($master_status as $textna => $numna) {
                                echo intval($numna) . ",";
                            }
                        }
                        ?>
                    ],
                    backgroundColor: [
                        '#8FBC8F',
                        '#90EE90',
                        '#00FF7F',
                        '#3CB371',
                        '#2E8B57',
                        '#556B2F',
                        '#6B8E23',
                        '#000080'
                    ],
                    label: 'ADDON'
                }],
                labels: [
                    <?php
                    if (count($master_status) > 0) {
                        foreach ($master_status as $textna => $numna) {
                            echo "'" . $textna . "',";
                        }
                    }
                    ?>
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'left',
                    labels: {
                        fontColor: bodycolor
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
            }
        };
        var chartjs_other_pie = document.getElementById("chartjs-other-pie");
        if (chartjs_other_pie) {
            var ctx_break = document.getElementById('chartjs-other-pie').getContext('2d');
            window.myDoughnut = new Chart(ctx_break, config_break);
        }
        if ($("#apex_analytic_arpu").length > 0) {
            options_arpu = {
                grid: {
                    yaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                chart: {
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: true
                },
                // colors: [
                //     '#00FF7F',
                //     '#90EE90',
                //     '#8FBC8F',
                //     '#3CB371',
                //     '#2E8B57',
                //     '#556B2F',
                //     '#6B8E23',
                //     '#000080'
                // ],
                series: [{
                    data: [
                        <?php
                        if (count($master_ages) > 0) {
                            foreach ($master_ages as $textna => $numna) {
                                echo intval($numna) . ",";
                            }
                        }
                        ?>
                    ],
                    backgroundColor: [
                        '#00FF7F',
                        '#90EE90',
                        '#8FBC8F',
                        '#3CB371',
                        '#2E8B57',
                        '#556B2F',
                        '#6B8E23',
                        '#000080'
                    ],
                }],
                xaxis: {
                    categories: [
                        <?php
                        if (count($master_ages) > 0) {
                            foreach ($master_ages as $textna => $numna) {
                                echo "'" . $textna . "',";
                            }
                        }
                        ?>
                    ]

                }
            }

            var chart_arpu = new ApexCharts(
                document.querySelector("#apex_analytic_arpu"),
                options_arpu
            );
            chart_arpu.render();
        }
        $(document).ready(function() {
            $("#break_chart").html("");
            let element5 = document.querySelector('#break_chart');
            var break_num = <?php echo $aht_persen; ?>;
            var break_label = <?php echo $aht_persen; ?>;
            // var break_num = 10;
            // var break_label = 10;
            var break_length = "lightgray";
            switch (true) {
                case (parseInt(break_num) > 24):
                    var break_num = 99.99;
                    var bar_color = "#ce2f4f";
                    var break_length = "#ce2f4f";
                    break;
                case (parseInt(break_num) > 24):
                    var bar_color = "#ce2f4f";
                    break;
                default:
                    var bar_color = "#a0bc2e";
                    break;

            }
            let gaugeOptions5 = {
                hasNeedle: true,
                needleColor: bar_color,
                needleUpdateSpeed: 1000,
                arcColors: [bar_color, break_length],
                arcDelimiters: [break_num],
                rangeLabel: ['0', '<?php echo number_format(1 * 60); ?>'],
                centralLabel: "",
            };
            GaugeChart
                .gaugeChart(element5, 400, gaugeOptions5)
                .updateNeedle(break_num);




        });
    </script>
</body>
<!-- END: Body-->

</html>