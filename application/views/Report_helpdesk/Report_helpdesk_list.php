<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->

<?php echo _css('datatables,icheck,selectize,multiselect') ?>
<div class='col-md-12 col-xl-12'>
    <div class="card">
        <div class="card-status bg-green"></div>
        <div class="card-header">
            <h3 class="card-title">FILTER
            </h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class='box-body' id='box-table'>

                <form id='form-a' methode="GET">

                    <div class='col-md-6 col-xl-6'>
                        <div class='form-group'>
                            <label class='form-label'>Mulai Dari</label>
                            <input type='date' min="" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
                        </div>
                    </div>
                    <div class='col-md-6 col-xl-6'>
                        <div class='form-group'>
                            <label class='form-label'>Sampai </label>
                            <input type='date' min="<?php echo date("Y-m-d", strtotime("-" . (date('d') + 15) . " days")); ?>" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
                        </div>
                    </div>



                    <div class='col-md-12 col-xl-12'>

                        <div class='form-group'>
                            <button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?php

if (isset($_GET['start']) && isset($_GET['end'])) {


?>
    <div class='col-md-12 col-xl-12'>
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">Rekap Pengerjaan Team HD Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

                </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        <table class='table' id="report_table_reg" width="100%">
                            <thead>
                                <tr>
                                    <td>
                                        Pertugas
                                    </td>
                                    <td>ERROR</td>
                                    <td>TAM</td>
                                    <td>MY IH</td>
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
                                    <td>Total</td>
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
                                                $all_channel["ERROR"]["status_" . $r2->STATUS] = $r2->numna + $all_channel["ERROR"]["status_" . $r2->STATUS];

                                                $petugas_channel[$r2->agentid]["ERROR"]['status_' . $r2->STATUS] = $r2->numna + $petugas_channel[$r2->agentid]["ERROR"]['status_' . $r2->STATUS];
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
                                            $tl = 0;
                                            if (isset($petugas_channel[$pt->agentid]['total'])) {
                                                $tl = $petugas_channel[$pt->agentid]['total'];
                                            }
                                            echo "<td>" . $tl . "</td>";
                                            ?>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <?php
                                    foreach ($channel as $chd) {
                                        $ps = 0;
                                        if (isset($all_channel[$chd]["status_3"])) {
                                            $ps = $all_channel[$chd]["status_3"];
                                        }
                                        echo "<td>" . $ps . "</td>";
                                    }
                                    echo "<td>" . $all_channel["total"] . "</td>";
                                    ?>
                                </tr>
                            </tfoot>
                        </table>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-6 col-xl-6'>
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">HVC Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

                </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        <table  width="100%">
                            <thead>
                                <tr>
                                    <td>
                                        NAMA
                                    </td>
                                    <td>VA</td>
                                    <td>PI</td>
                                    <td>CA</td>
                                    <td>PS</td>
                                    <td>JML</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $hvc["status_1"] = 0;
                                $hvc["status_2"] = 0;
                                $hvc["status_3"] = 0;
                                $hvc["status_4"] = 0;
                                $hvc["total"] = 0;
                                if (count($chanel_hvc_petugas) > 0) {
                                    foreach ($chanel_hvc_petugas as $r2) {
                                        $hvc["status_" . $r2->STATUS] = $r2->numna + $hvc["status_" . $r2->STATUS];
                                        $hvc["total"] = $r2->numna + $hvc["total"];
                                    }
                                }
                                ?>
                                <tr>
                                    <td>HVC</td>
                                    <td><?php echo $hvc['status_1']; ?></td>
                                    <td><?php echo $hvc['status_2']; ?></td>
                                    <td><?php echo $hvc['status_4']; ?></td>
                                    <td><?php echo $hvc['status_3']; ?></td>
                                    <td><?php echo $hvc['total']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-6 col-xl-6'>
        <div class="card">
            <div class="card-status bg-orange"></div>
            <div class="card-header">
                <h3 class="card-title">BY STATUS Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

                </h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class='box-body table-responsive' id='box-table'>
                    <small>
                        <table class='table' id="report_table_status" width="100%">
                            <thead>
                                <tr>
                                    <td>
                                        PETUGAS
                                    </td>
                                    <td>VA</td>
                                    <td>PI</td>
                                    <td>CA</td>
                                    <td>PS</td>
                                    <td>JML</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if (count($status_petugas) > 0) {
                                    foreach ($status_petugas as $r2) {
                                        $status[$r2->agentid]["status_" . $r2->STATUS] = $r2->numna + $status[$r2->agentid]["status_" . $r2->STATUS];
                                        $status[$r2->agentid]["total"] = $r2->numna + $status[$r2->agentid]["total"];
                                    }
                                }
                                if ($agent['num'] > 0) {
                                    foreach ($agent['results'] as $pt) {
                                ?>
                                        <tr>
                                            <td><?php echo $pt->agentid?></td>
                                            <td><?php echo number_format($status[$pt->agentid]['status_1']); ?></td>
                                            <td><?php echo number_format($status[$pt->agentid]['status_2']); ?></td>
                                            <td><?php echo number_format($status[$pt->agentid]['status_4']); ?></td>
                                            <td><?php echo number_format($status[$pt->agentid]['status_3']); ?></td>
                                            <td><?php echo number_format($status[$pt->agentid]['total']); ?></td>
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
        </div>
    </div>
<?php
}

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->

<?php echo _js('ybs,selectize,datatables,icheck,multiselect') ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#agentid').selectize({});
        $("#report_table_reg").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
        $("#report_table_status").DataTable({
        });
    });
</script>