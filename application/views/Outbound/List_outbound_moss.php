<?php echo _css('datatables,icheck') ?>

<div class="card ">
    <div class="card-status bg-teal"></div>
    <div class="card-header">
        <h3 class="card-title">List MOS &nbsp; &nbsp; &nbsp;</h3>
        <span class="label btn btn-success" id="lblatas">MOSS : 0</span>

        <div class="card-options">
            <span class="label btn btn-success" id="indinum">INDIBOX : <?php echo $data_list_indibox['num']; ?></span>
            <a href="javascript:void(0)" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a></div>
    </div>
    <div class="card-body">
        <div class='row'>
            <!-- <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_create, $title->general->button_create_desc, 'text-green', 'btn-success', 'fe fe-list', 'bg-green', 'btn-create', $link_create) ?>
        
    </div>
    <div class='col-md-6 col-lg-4'>
        <?php echo button_card($title->general->button_delete, $title->general->button_delete_desc, 'text-red', 'btn-danger', 'fe fe-trash', 'bg-red', 'btn-delete') ?>
    </div> -->

        </div>

        <div class="card-body">
            <div class='box-body table-responsive' id='box-table'>
                <small>

                    <table class='display nowrap' id="example" style="width: 100%;">
                        <thead>
                            <tr>
                                <th><b>No</b></th>
                                <th><b>NCLI</b></th>
                                <th><b>No PSTN</b></th>
                                <th><b>No Indihome</b></th>
                                <th><b>Nama Pastel</b></th>
                                <th><b>Handphone</b></th>
                                <th><b>Email</b></th>
                                <th><b>Layanan</b></th>
                                <th><b>Lup</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;


                            foreach ($data_list as $datana) {
                            ?>
                                <tr>
                                    <td><?php echo $nomor; ?>
                                        <input type="hidden" id="link_<?php echo $datana['idx'] ?>" value="<?php echo base_url() ?>Outbound/Outbound/edit?idx=<?php echo $datana['idx'] ?>&phone=<?php echo $datana['no_pstn']; ?>&ncli=<?php echo $datana['ncli']; ?>&hp=<?php echo $datana['no_handpone']; ?>">

                                    </td>
                                    <td id="idx<?php echo $datana['idx'] ?>">
                                        <a target="_blank" href="<?php echo base_url() ?>Outbound/Outbound/edit?idx=<?php echo $datana['idx'] ?>&phone=<?php echo $datana['no_pstn']; ?>&ncli=<?php echo $datana['ncli']; ?>&hp=<?php echo $datana['no_handpone']; ?>"><span class="btn btn-sm btn-primary"><?php echo $datana['ncli']; ?></span></a>
                                    </td>
                                    <td><?php echo $datana['no_pstn']; ?></td>
                                    <td><?php echo $datana['no_speedy']; ?></td>
                                    <td><?php echo $datana['nama_pastel']; ?></td>
                                    <td><?php echo $datana['no_handpone']; ?></td>
                                    <td><?php echo $datana['email']; ?></td>
                                    <td><?php echo $datana['layanan']; ?></td>
                                    <td><?php echo $datana['lup']; ?></td>
                                </tr>
                            <?php
                                $nomor++;
                            }
                            // } else {
                            //     echo "<td colspan='10'>Tidak ada data</td>";

                            ?>
                            <?php


                            foreach ($data_list_indibox['results'] as $datana) {
                            ?>
                                <tr>
                                    <td><?php echo $nomor; ?>
                                        <input type="hidden" id="indibox_link_<?php echo $datana['id'] ?>" value="<?php echo base_url(); ?>Indibox/Indibox/create/<?php echo $datana['id'] ?>">

                                    </td>
                                    <td id="idx_indibox<?php echo $datana['id'] ?>">
                                        <a target="_blank" href="<?php echo base_url(); ?>Indibox/Indibox/create/<?php echo $datana['id'] ?>"><span class="btn btn-sm btn-primary">PROSES</span></a>
                                    </td>
                                    <td><?php echo $datana['no_pstn']; ?></td>
                                    <td><?php echo $datana['no_indihome']; ?></td>
                                    <td><?php echo $datana['nama_pastel']; ?></td>
                                    <td><?php echo $datana['phone']; ?></td>
                                    <td><?php echo $datana['email']; ?></td>
                                    <td><?php echo $datana['sumber']; ?></td>
                                    <td><?php echo $datana['add_date']; ?></td>
                                </tr>
                            <?php
                                $nomor++;
                            }
                            // } else {
                            //     echo "<td colspan='10'>Tidak ada data</td>";

                            ?>

                        </tbody>
                    </table>
                </small>
            </div>
        </div>

        <?php echo card_close() ?>
        <?php echo _js('datatables,icheck') ?>
        <script>
            var page_version = "1.0.8"
        </script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();

                function refresh_div() {
                    var text_title = $("#title_app").text();
                    $.ajax({
                        url: '<?php echo base_url() ?>Outbound/Outbound/get_list_mos',
                        type: 'POST',
                        dataType: 'JSON',
                        success: function(response) {

                            $.each(response.data, function(key, val) {
                                // alert(key);
                                if (key == 'waiting') {
                                    $("#lblatas").html("MOSS : " + val);
                                    if (parseInt(val) > 0) {
                                        $("#lblatas").attr("class", "label btn btn-danger icon-shake-jump");
                                        // $("#lblatas").show();
                                        $("#title_app").text("( " + val + " ) NEW DATA MOSS | Sy-ANIDA");

                                    } else {
                                        // $("#lblatas").hide();
                                        $("#lblatas").attr("class", "label btn btn-success");
                                        $("#lblatas").html("MOSS : " + val);
                                        $("#title_app").html('Sy-ANIDA | Profiling');
                                    }

                                    $("#lblbawah").html(val);
                                }
                                if (key == 'oncall') {
                                    $.each(val, function(keyna, valna) {
                                        var urlna = $("#link_" + valna.idx).val();
                                        $("#idx" + valna.idx).html('<a target="_blank" href="' + urlna + '"><span class="btn btn-sm btn-success">On Call : ' + valna.agentid + '</span></a>');
                                    });
                                }
                                if (key == 'oncall_indibox') {
                                    $.each(val, function(keyna, valna) {
                                        var urlna = $("#indibox_link_" + valna.idx).val();
                                        $("#idx_indibox" + valna.idx).html('<a target="_blank" href="' + urlna + '"><span class="btn btn-sm btn-success">On Call : ' + valna.agentid + '</span></a>');
                                    });
                                }
                                if (key == 'indibox') {
                                    $("#indinum").html("INDIBOX : " + val);
                                    if (parseInt(val) > 0) {
                                        $("#indinum").attr("class", "label btn btn-danger icon-shake-jump");

                                    } else {
                                        // $("#lblatas").hide();
                                        $("#indinum").attr("class", "label btn btn-success");
                                        $("#indinum").html("INDIBOX : " + val);
                                    }

                                    $("#lblbawah").html(val);
                                }


                            });


                            refresh_div();
                        }
                    });
                }
                // t = setInterval(refresh_div, 1000);
                refresh_div();
            });



            function deleteItem() {
                if (confirm("anda ingin hapus data ini?")) {
                    // your deletion code
                }
                return false;
            }
        </script>
        <script>
            var resp_table = true;
            var table_detail;
            $(document).ready(function() {

                $('#hscroll-table').prop('checked', true);
                set_scroll_table();

                $('#hscroll-table').change(function() {
                    set_scroll_table();
                });

            });

            function set_scroll_table() {
                resp_table = !$('#hscroll-table').prop('checked');
                refresh_table();
            }

            <?php //MEMBUAT INPUT SEARCH  
            ?>
            $('#table-detail thead tr').clone(true).appendTo('#table-detail thead');
            $('#table-detail thead tr:eq(1) th').each(function(i) {
                if ($(this).hasClass('nst')) {
                    $(this).html('');
                } else {
                    var bb = '<input hidden  type="text" placeholder=" filter by.." class="column-search" data_index="' +
                        i + '"/>';
                    $(this).html(bb);
                }
            });


            $('#btn-delete').click(function() {
                ybsDeleteTableChecked('<?php echo $link_delete ?>', '#table-detail');
            });
        </script>