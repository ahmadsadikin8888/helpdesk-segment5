<?php echo _css('datatables,icheck') ?>
<div class="card">
    <div class="card-status bg-orange"></div>
    <div class="card-header">
        <h3 class="card-title">Verified Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

        </h3>
        <div class="card-options">
            <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class='box-body table-responsive' id='box-table'>
            <small>
                <table class='timecard' id="report_table_reg" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><b>No</b></th>
                            <th nowrap><b>Aksi</b></th>
                            <th nowrap><b>Waktu Dan Tanggal</b></th>
                            <th nowrap><b>NCLI</b></th>
                            <th><b>NO.PSTN</b></th>
                            <th><b>NO.Internet</b></th>
                            <th><b>Kepemilikan</b></th>
                            <th><b>Email</b></th>
                            <th><b>Handphone</b></th>
                            <th><b>Status Approve</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        $data_profiling = $query_trans_profiling->result_array();
                        // $data_profiling_verifikasi=$query_trans_profiling_verifikasi->result_array();

                        if (count($data_profiling) > 0) {
                            foreach ($data_profiling as $ag) {
                                $check_approve = $controller->qc->get_row(array("ncli" => $ag['ncli'], "lup" => $ag['lup'], "agentid" => $ag['veri_upd']));
                                $bg_color = "";
                                $status_approve = "";
                                if ($check_approve) {
                                    if ($check_approve->status_approve == 1) {
                                        $bg_color = "background-color:green !important;color:#ffffff;";
                                        $status_approve="Approve";
                                    } else {
                                        $bg_color = "background-color:red !important;color:#ffffff;";
                                        $status_approve="Not Approve";
                                    }
                                    $link_="Qc/Qc/edit_form_approve?id=" . $check_approve->id;
                                }else{
                                    $status_approve="Belum Dicheck";
                                    $link_="Qc/Qc/form_approve?agentid=" . $ag['veri_upd'] . "&ncli=" . $ag['ncli'] . "&handphone=" . $ag['handphone'] . "&start=" . $_GET['start'] . "&end=" . $_GET['end'];
                                }
                        ?>

                                <tr style="<?php echo $bg_color; ?>">
                                    <td><?php echo $no; ?></td>
                                    <td style="text-align:left;">
                                        <a href="<?php echo base_url().$link_; ?>" class="btn btn-default text-red btn-sm " title="update"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td style="text-align:left;"><?php echo $ag['lup']; ?></td>
                                    <td style="text-align:left;"><?php echo $ag['ncli']; ?></td>
                                    <td style="text-align:left;"><?php echo $ag['pstn1']; ?></td>
                                    <td style="text-align:left;"><?php echo $ag['no_speedy']; ?></td>
                                    <td style="text-align:left;"><?php echo $ag['kepemilikan']; ?></td>
                                    <td style="text-align:left;"><?php echo $ag['email']; ?></td>
                                    <td style="text-align:left;"><?php echo $ag['handphone']; ?></td>
                                    <td style="text-align:left;"><?php echo $status_approve; ?></td>


                                </tr>

                        <?php

                                $no++;
                            }
                        }

                        ?>

                    </tbody>
                </table>
            </small>
        </div>
    </div>
</div>
<?php echo _js('datatables,icheck') ?>

<script type="text/javascript">
    $(document).ready(function() {

        $("#report_table_reg").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
    });
</script>

<?php

?>