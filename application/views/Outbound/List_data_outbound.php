<?php

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = (array) $now->diff($ago);

    $diff['w'] = floor($diff['d'] / 7);
    $diff['d'] -= $diff['w'] * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff[$k]) {
            $v = $diff[$k] . ' ' . $v . ($diff[$k] > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>

<?php echo card_open('List Work Order', 'bg-teal', true) ?>
<div class='row'>
    <!-- <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_create, $title->general->button_create_desc, 'text-green', 'btn-success', 'fe fe-list', 'bg-green', 'btn-create', $link_create) ?>
    </div>
    <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_delete, $title->general->button_delete_desc, 'text-red', 'btn-danger', 'fe fe-trash', 'bg-red', 'btn-delete') ?>
    </div> -->
</div>

<div class="card-body">
    <a href="<?php echo base_url() ?>Outbound/Outbound/get"><button id="submitbutton" onclick="document.getElementById('submitbutton').disabled = true;document.getElementById('submitbutton').style.opacity='0.5';" class="btn btn-success pull-left" style="margin-top: -40px;margin-bottom: 20px;"><span class="fa fa-plus-circle"></span> Get Data Work Order</button></a>
    <a href="<?php echo base_url() ?>Outbound/Outbound/get"><button id="submitbutton" onclick="document.getElementById('submitbutton').disabled = true;document.getElementById('submitbutton').style.opacity='0.5';" class="btn btn-primary pull-left" style="margin-top: -40px;margin-bottom: 20px;margin-left:5px;"><span class="fa fa-refresh"></span></button></a>

    <div class='box-body ' id='box-table'>
        <small>

            <table class='responsive display nowrap' id="example" style="width: 100%;">
                <thead>
                    <tr>
                        <th><b>ND</b></th>
                        <th><b>AGES</b></th>
                        <th><b>Last Update</b></th>
                        <th><b>ADDON</b></th>
                        <th><b>SUMBER</b></th>
                        <th><b>STATUS</b></th>
                        <th><b>REG</b></th>
                        <th><b>CHANEL</b></th>
                        <th><b>TGL_VA</b></th>
                        <th><b>ITEM</b></th>
                        <th><b>CPACK</b></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;

                    if ($list_count->hitung > 0) {
                        foreach ($list_outbound as $datana) {
                            $dif_menit = 0;
                            $last_update = "";
                            if (!is_null($datana->lup)) {
                                $dteStart = new DateTime($datana->lup);
                                $dteEnd   = new DateTime(DATE('Y-m-d H:i:s'));
                                $dteDiff  = $dteStart->diff($dteEnd);
                                $dif_menit = intval($dteDiff->i);
                                $last_update = time_elapsed_string($datana->lup);
                            }
                            // echo $dif_menit;
                            switch (true) {
                                default:
                                    $stl = "primary";
                                    break;
                                case ($dif_menit > 60):
                                    $stl = "danger";
                                    break;
                                case ($dif_menit > 30):
                                    $stl = "warning";
                                    break;
                            }
                            $uri = base_url() . "Outbound/Outbound/edit?nd=" . $datana->NDEM . "&id=" . $datana->id . "&userid=" . $userdata->agentid;
                    ?>
                            <tr>
                                <td>
                                    <a onclick="createNewTab('dhtmlgoodies_tabView2','<?php echo $datana->NDEM; ?>','','<?php echo $uri; ?>',true);return false" href="javascript:void()"><span class="btn btn-sm btn-<?php echo $stl; ?>"><?php echo $datana->NDEM; ?></span></a>
                                </td>
                                <td>
                                    <center><?php echo $datana->umur; ?> Days</center>
                                </td>
                                <td>
                                    <center><?php echo $last_update; ?></center>
                                </td>
                                <td><?php echo $datana->ADDON; ?></td>
                                <td><?php echo $datana->SUMBER; ?></td>
                                <td><?php echo $datana->STATUS_SC; ?></td>
                                <td><?php echo $datana->KAWASAN; ?></td>
                                <td><?php echo $datana->CHANEL; ?></td>
                                <td><?php echo $datana->TGL_VA; ?></td>
                                <td><?php echo $datana->ITEM; ?></td>
                                <td><?php echo $datana->CPACK; ?></td>


                            </tr>
                    <?php
                            $nomor++;
                        }
                    } else {
                        echo "<td colspan='10'>Tidak ada data</td>";
                    }
                    ?>

                </tbody>
            </table>
        </small>
    </div>
    <a onclick="createNewTab('dhtmlgoodies_tabView2','ADD WORK ORDER','','<?php echo base_url() ?>Outbound/Outbound/add',true);return false" href="javascript:void()"><button class="btn btn-primary pull-left"><span class="fa fa-plus-circle"></span> Add Data Work Order</button></a>

</div>

<?php echo card_close() ?>