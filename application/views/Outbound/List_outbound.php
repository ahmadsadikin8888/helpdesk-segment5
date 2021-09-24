<?php echo _css('datatables') ?>
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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/tab_sistem/css/tab-view.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/tab_sistem/js/ajax.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/tab_sistem/js/tab-view.js">
    /************************************************************************************************************
	(C) www.dhtmlgoodies.com, October 2005
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Updated:
		
		March, 14th, 2006 - Create new tabs dynamically
	
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/
</script>

<div id="dhtmlgoodies_tabView2">
    <div class="dhtmlgoodies_aTab">

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
            <a href="<?php echo base_url() ?>Outbound/Outbound"><button id="submitbutton" class="btn btn-primary pull-left" style="margin-top: -40px;margin-bottom: 20px;margin-left:5px;"><span class="fa fa-refresh"></span></button></a>

            <div class='box-body ' id='box-table'>
                <small>

                    <table class='responsive display nowrap' id="example" style="width: 100%;">
                        <thead>
                            <tr>
                                <th><b>Action</b></th>
                                <th><b>ORDER ID</b></th>
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
                                        $dif_menit = intval((($dteDiff->h) * 60) + $dteDiff->i);
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
                                    $uri = base_url() . "Outbound/Outbound/edit?order_id=" . $datana->EXTERNAL_ORDER_ID . "&id=" . $datana->id;
                                    $uri_dell = base_url() . "Outbound/Outbound/delete_tab?id=" . $datana->id;
                                    $cek_handle = $controller->T_handle_time_model->get_count(array("id_proses" => $datana->id));
                            ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" value="<?php echo $uri_dell; ?>" id="url_del_<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>">
                                            <?php
                                            if ($cek_handle > 0) {

                                            ?>
                                                <a href="javascript:void(0)" id="diclick_<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>" onclick="open_tab('<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>')"><span class="btn btn-sm btn-<?php echo $stl; ?>"><i class="fe fe-edit"></i></span></a>

                                            <?php
                                            } else {
                                            ?>
                                                <a href="javascript:void(0)" id="diclick_<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>" onclick="diclick('<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>','<?php echo $uri; ?>')"><span class="btn btn-sm btn-<?php echo $stl; ?>"><i class="fe fe-edit"></i></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>

                                        <td>

                                            <?php echo $datana->EXTERNAL_ORDER_ID; ?>

                                        </td>
                                        <td>
                                            <center><?php echo $datana->umur; ?> Days</center>
                                        </td>
                                        <td>
                                            <center><?php echo $last_update; ?></center>
                                        </td>
                                        <td><?php echo $datana->ADDON; ?></td>
                                        <td><?php echo $datana->sumber; ?></td>
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
                                // echo "<td colspan='10'>Tidak ada data</td>";
                            }
                            ?>

                        </tbody>
                    </table>
                </small>
            </div>
            <a onclick="createNewTab('dhtmlgoodies_tabView2','ADD WORK ORDER','','<?php echo base_url() ?>Outbound/Outbound/add',true);" href="javascript:void()"><button class="btn btn-primary pull-left"><span class="fa fa-plus-circle"></span> Add Data Work Order</button></a>

        </div>

        <?php echo card_close() ?>

    </div>
    <div class="dhtmlgoodies_aTab">
        <?php echo card_open('Data Pending', 'bg-teal', true) ?>
        <div class='row'>
            <!-- <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_create, $title->general->button_create_desc, 'text-green', 'btn-success', 'fe fe-list', 'bg-green', 'btn-create', $link_create) ?>
    </div>
    <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_delete, $title->general->button_delete_desc, 'text-red', 'btn-danger', 'fe fe-trash', 'bg-red', 'btn-delete') ?>
    </div> -->
        </div>

        <div class="card-body">
            <div class='box-body ' id='box-table'>
                <small>

                    <table class='responsive display nowrap' id="example2" style="width: 100%;">
                        <thead>
                            <tr>
                                <th><b>Action</b></th>
                                <th><b>ORDER ID</b></th>
                                <th><b>PETUGAS</b></th>
                                <th><b>AGES</b></th>
                                <th><b>Last Update</b></th>
                                <th><b>ADDON</b></th>
                                <th><b>SUMBER</b></th>
                                <th><b>STATUS</b></th>
                                <th><b>REG</b></th>
                                <th><b>CHANEL</b></th>
                                <th><b>TGL_VA</b></th>
                                <th><b>ITEM</b></th>
                                <!-- <th><b>CPACK</b></th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;

                            if (count($list_pending) > 0) {
                                foreach ($list_pending as $datana) {
                                    $dif_menit = 0;
                                    $last_update = "";
                                    if (!is_null($datana->lup)) {
                                        $dteStart = new DateTime($datana->lup);
                                        $dteEnd   = new DateTime(DATE('Y-m-d H:i:s'));
                                        $dteDiff  = $dteStart->diff($dteEnd);
                                        $dif_menit = intval((($dteDiff->h) * 60) + $dteDiff->i);
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
                                    $uri = base_url() . "Outbound/Outbound/edit?order_id=" . $datana->EXTERNAL_ORDER_ID . "&id=" . $datana->id;
                                    $uri_dell = base_url() . "Outbound/Outbound/delete_tab?id=" . $datana->id;
                                    $cek_handle = $controller->T_handle_time_model->get_count(array("id_proses" => $datana->id));
                            ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" value="<?php echo $uri_dell; ?>" id="url_del_<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>">
                                            <?php
                                            if ($cek_handle > 0) {

                                            ?>
                                                <a href="javascript:void(0)" id="diclick_<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>" onclick="open_tab('<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>')"><span class="btn btn-sm btn-<?php echo $stl; ?>"><i class="fe fe-edit"></i></span></a>

                                            <?php
                                            } else {
                                            ?>
                                                <a href="javascript:void(0)" id="diclick_<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>" onclick="diclick('<?php echo $datana->id . '_' . $datana->EXTERNAL_ORDER_ID; ?>','<?php echo $uri; ?>')"><span class="btn btn-sm btn-<?php echo $stl; ?>"><i class="fe fe-edit"></i></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>

                                            <?php echo $datana->EXTERNAL_ORDER_ID; ?>

                                        </td>
                                        <td><?php echo $datana->petugas; ?></td>
                                        <td>
                                            <center><?php echo $datana->umur; ?> Days</center>
                                        </td>
                                        <td>
                                            <center><?php echo $last_update; ?></center>
                                        </td>

                                        <td><?php echo $datana->ADDON; ?></td>
                                        <td><?php echo $datana->sumber; ?></td>
                                        <td><?php echo $datana->STATUS_SC; ?></td>
                                        <td><?php echo $datana->KAWASAN; ?></td>
                                        <td><?php echo $datana->CHANEL; ?></td>
                                        <td><?php echo $datana->TGL_VA; ?></td>
                                        <td><?php echo $datana->ITEM; ?></td>
                                        <!-- <td><?php echo $datana->CPACK; ?></td> -->


                                    </tr>
                            <?php
                                    $nomor++;
                                }
                            } else {
                                // echo "<td colspan='10'>Tidak ada data</td>";
                            }
                            ?>

                        </tbody>
                    </table>
                </small>
            </div>

        </div>

        <?php echo card_close() ?>
    </div>
</div>

<script type="text/javascript">
    initTabs('dhtmlgoodies_tabView2', Array('LIST WORK ORDER', 'DATA PENDING'), 0, '100%', '100%', Array(false));
</script>


<?php echo _js('datatables') ?>
<script>
    var page_version = "1.0.8"
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "order": [
                [1, "DESC"]
            ],
            responsive: true
        });
        $('#example2').DataTable({
            "order": [
                [1, "DESC"]
            ],
            responsive: true
        });
        // $('#example_filter input').on('keyup', function() {

        // });
    });

    function vericall(idna) {
        var veri_callna = $("#veri_call_" + idna).val();
        if (veri_callna != 'PS') {
            $("#reason_form_" + idna).show();
        } else {
            $("#reason_va_" + idna).val("");
            $("#reason_form_" + idna).hide();
        }
    }

    function deleteItem() {
        if (confirm("anda ingin hapus data ini?")) {
            // your deletion code
        }
        return false;
    }

    function open_tab(idna) {
        var indexna = getTabIndexByTitle(idna);
        $("#diclick_" + idna).attr("class", indexna);
        var datana = $("#diclick_" + idna).attr("class");
        var splitna = datana.split(",");
        showTab('dhtmlgoodies_tabView2', splitna[1]);
    }

    function diclick(titlena, urlna) {
        document.getElementById("diclick_" + titlena).setAttribute("onClick", "open_tab('" + titlena + "');");
        createNewTab('dhtmlgoodies_tabView2', titlena, '', urlna, true);
    }

    function deleteclick(titlena, urlna) {
        // $('#example').DataTable({
        //     destroy: true,
        // });
        var table1 = $('#example').DataTable();
        var res = titlena.split("_");
        table1.search(res[1]).draw();
        
        document.getElementById("diclick_" + titlena).setAttribute("onClick", "diclick('" + titlena + "','" + urlna + "');");
        deleteTab(titlena);
        table1.search("").draw();
        var table1 = $('#example').DataTable();
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#inputfile').change(function() {
            prepare_picture();
        });
        $('.profile-user-img').val('default.png');
        // $(".act_tab").on("click", function() {
        //     var id = $(this).attr("id");
        //     var urina = $(this).attr("data-urina");
        //     addAjaxContentToTab(id, urina);
        // });

    });



    $('#btn-apply').click(function() {
        apply();
    });

    $('#btn-close').click(function() {
        play_sound_apply();
    });

    $('#btn-cancel').click(function() {
        cancel();
        play_sound_apply();
    });

    $('#btn-save').click(function() {
        simpan();
    })

    function apply(idna) {
        $('#btn-apply-' + idna).attr('disabled', true);
        $('#btn-cancel-' + idna).attr('disabled', false);
        $('#btn-save-' + idna).attr('disabled', false);
        $('#btn-save-' + idna).focus();

    }

    function cancel(idna) {
        $('#btn-cancel-' + idna).attr('disabled', true);
        $('#btn-save-' + idna).attr('disabled', true);
        $('#btn-apply-' + idna).attr('disabled', false);



    }

    function simpan(idna) {
        send_data = ybs_dataSending(get_dataSending('form-a-' + idna));
        var urina = $("#urina-" + idna).val();
        var update_urina = $("#update_urina-" + idna).val();
        var a = new ybsRequest();
        a.process(urina, send_data, 'POST');
        a.onAfterSuccess = function() {
            cancel();
            addAjaxContentToTab(idna, update_urina);
        }
        a.onFailed = function(data) {
            cancel();
            $(data.elementid).focus();
            show_error_message(data.message);
        }
    }
    <?php
    if ($list_handle['num'] > 0) {
        foreach ($list_handle['results'] as $row) {
            $uri = base_url() . "Outbound/Outbound/edit?order_id=" . $row->EXTERNAL_ORDER_ID . "&id=" . $row->id_proses . "&userid=" . $userdata->agentid;
    ?>
            createNewTab('dhtmlgoodies_tabView2', '<?php echo $row->id_proses . '_' . $row->EXTERNAL_ORDER_ID; ?>', '', '<?php echo $uri; ?>', true);
    <?php
        }
    }
    ?>
</script>