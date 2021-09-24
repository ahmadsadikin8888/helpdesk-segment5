<?php echo _css('datatables') ?>
<meta http-equiv="refresh" content="300">
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Monitoring Realtime
        </h1>
    </div>
    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['duty_num'] != 0) {
                        if ($cache_monev_realtime['duty_num'] < $duty_num) {
                    ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['duty_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['duty_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $duty_num; ?></div>
                    <div class="text-muted mb-4">ON DUTY</div>
                </div>
            </div>
        </div>
            
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['aval_num'] != 0) {
                        if ($cache_monev_realtime['aval_num'] < $aval_num) {
                    ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['aval_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['aval_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $aval_num; ?></div>
                    <div class="text-muted mb-4">READY ON CALL</div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['aux_num'] != 0) {
                        if ($cache_monev_realtime['aux_num'] < $aux_num) {
                    ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['aux_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['aux_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $aux_num; ?></div>
                    <div class="text-muted mb-4">AUX/BREAK</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['idle_num'] != 0) {
                        if ($cache_monev_realtime['idle_num'] < $idle_num) {
                    ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['idle_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['idle_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $idle_num; ?></div>
                    <div class="text-muted mb-4">IDLE</div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['logout_num'] != 0) {
                        if ($cache_monev_realtime['logout_num'] < $logout_num) {
                    ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['logout_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['logout_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $logout_num; ?></div>
                    <div class="text-muted mb-4">OFFLINE</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['ppa_num'] != 0) {
                        if ($cache_monev_realtime['ppa_num'] < $ppa_num) {
                    ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['ppa_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['ppa_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['ppa_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $ppa_num; ?></div>
                    <div class="text-muted mb-4">PPA</div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">AGENT STATUS</h3>
                </div>
                <div class="card-body">
                    <div class='box-body table-responsive' id='box-table'>
                        <small>
                        *<i>Dalam Satuan Menit</i>
                            <table class='timecard' id="report_table_reg" style="width: 100%;">
                                <thead>
                                   
                                    <tr>
                                        <th>AGENTID</th>
                                        <th>Nama</th>
                                        <th>TL</th>
                                        <th>Status</th>
                                        <th>Order Call</th>
                                        <th>Agree</th>
                                        <th>Idle</th>
                                        <th>Launch</th>
                                        <th>Pray</th>
                                        <th>Toilet</th>
                                        <th>Koordinasi</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($agent['num']) > 0) {
                                        foreach ($agent['results'] as $ag) {
                                            $agent_peformance = $agent_status[$ag->agentid];
                                            $sub_total_contacted = $agent_status[$ag->agentid]['Agree'] + $agent_status[$ag->agentid]['Follow Up'] +  $agent_status[$ag->agentid]['Decline'];
                                            $sub_total_uncontacted = $agent_status[$ag->agentid]['Not Contacted'];

                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $ag->agentid; ?>
                                                </td>
                                                <td>
                                                    <?php echo $ag->nama; ?>
                                                </td>
                                                <td>
                                                    <?php echo $ag->tl; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $offline = false;
                                                    $aux = false;
                                                    $idle = false;
                                                    $other_status = false;
                                                    if (in_array($ag->agentid, $logout_data)) {
                                                        echo '<span class="status-icon bg-primary"></span> OFFLINE';
                                                        $offline = true;
                                                    }
                                                    if (in_array($ag->agentid, $offline_data)) {
                                                        echo '<span class="status-icon bg-primary"></span> OFFLINE';
                                                        $offline = true;
                                                    }
                                                    if (in_array($ag->agentid, $aux_data) && $offline == false) {
                                                        $dtl=$aux_detail[$ag->agentid]['ket'];
                                                        echo '<span class="status-icon bg-warning"></span> '.$dtl;
                                                        $aux = true;
                                                    }
                                                    // if(count($aux_all_status[$ag->agentid]) > 0){
                                                    //     foreach($aux_all_status[$ag->agentid] as $stat=>$data_other){
                                                    //         echo '<span class="status-icon bg-warning"></span> '.$stat;
                                                    //     }
                                                        
                                                    //     $other_status = true;
                                                    // }
                                                    if (in_array($ag->agentid, $idle_data) && $aux == false && $offline == false) {
                                                        echo '<span class="status-icon bg-danger"></span> IDLE';
                                                        $idle = true;
                                                    }
                                                    if ($idle == false && $aux == false && $offline == false) {
                                                        if (!in_array($ag->agentid, $offline_data)) {
                                                            echo '<span class="status-icon bg-success"></span> ONLINE';
                                                        } else {
                                                            echo '<span class="status-icon bg-primary"></span> OFFLINE';
                                                        }
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <?php echo $sub_total_contacted + $sub_total_uncontacted; ?>
                                                </td>
                                                <td>
                                                    <?php echo $agent_peformance['Agree']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (in_array($ag->agentid, $idle_data)) {
                                                        echo number_format($agent_status[$ag->agentid]['idle'] / 60);
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo number_format($aux_all_status[$ag->agentid]['Break'] / 60);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo number_format($aux_all_status[$ag->agentid]['ibadah'] / 60);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo number_format($aux_all_status[$ag->agentid]['toilet'] / 60);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo number_format($aux_all_status[$ag->agentid]['koordinasi'] / 60);
                                                    ?>
                                                </td>
                                               
                                                <!-- <td class="text-right">
                                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                            </div>
                                        </td> -->
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </small>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#report_table_reg').DataTable();
                    });
                </script>
            </div>
        </div>
    </div>
</div>

</div>
<?php echo _js('datatables') ?>