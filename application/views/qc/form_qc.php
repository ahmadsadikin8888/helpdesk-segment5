<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form Quality control ', 'bg-green', true) ?>

<form id='form-a'>
    <div class="row">
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>Nama Agent </label>
                <input type='text' readonly class='form-control data-sending focus-color' id='nama_agent' name='nama_agent' placeholder='Nama Agent' value='<?php if (isset($agent)) echo $agent->nama ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Nama Pelanggan</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='nama' name='nama' placeholder='nama' value='<?php if (isset($data)) echo $data->nama ?>'>
            </div>

            <div class='form-group'>
                <label class='form-label'>Alamat Lengkap</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='alamat' name='alamat' placeholder='alamat' value='<?php if (isset($data)) echo $data->alamat ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Kecepatan</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='kec_speedy' name='kec_speedy' placeholder='kec_speedy' value='<?php if (isset($data)) echo $data->kec_speedy ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Tagihan</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='billing' name='billing' placeholder='billing' value='<?php if (isset($data)) echo $data->billing ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Tahun pemasangan Produk Telkom</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='waktu_psb' name='waktu_psb' placeholder='waktu_psb' value='<?php if (isset($data)) echo $data->waktu_psb ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Tempat Pembayaran</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='payment' name='payment' placeholder='payment' value='<?php if (isset($data)) echo $data->payment ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Kode Verivikasi</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='veri_system' name='veri_system' placeholder='veri_system' value='<?php if (isset($data)) echo $data->veri_system ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>NCLI</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='ncli' name='ncli' placeholder='ncli' value='<?php if (isset($data)) echo $data->ncli ?>'>
            </div>

            <div class='form-group'>
                <label class='form-label'>No.PSTN</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='pstn1' name='pstn1' placeholder='pstn1' value='<?php if (isset($data)) echo $data->pstn1 ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Dial To</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='handphone' name='handphone' placeholder='handphone' value='<?php if (isset($data)) echo $data->handphone ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>No Handphone</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='handphone' name='handphone' placeholder='handphone' value='<?php if (isset($data)) echo $data->handphone ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Email</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='email' name='email' placeholder='email' value='<?php if (isset($data)) echo $data->email ?>'>
            </div>

            <div class='form-group'>
                <label class='form-label'>Opsi Channel (Hp, Email, dsb)</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='opsi_call' name='opsi_call' placeholder='opsi_call' value='<?php if (isset($data)) echo $data->opsi_call ?>'>
            </div>
            <div class='form-group'>
                <label class='form-label'>Recording</label>
                <?php
                if ($recording) {
                    $recording=str_replace("/mount/recording", "", $recording);
                ?>
                    <audio controls>
                        <source src="<?php echo "https://10.194.176.161:9443/apprecording/recording" . $recording; ?>" type="audio/wav">
                        Your browser does not support the audio element.
                    </audio>
                <?php
                } else {
                    echo "File Recording Tidak Tersedia";
                }
                ?>

            </div>

        </div>
        <div class='col-md-6 col-xl-6' style="background-color:yellow;">
            <table width="100%">
                
                <tr>
                    <td colspan=2>Nama Pelanggan</td>
                </tr>
                <tr>
                    <td width="1%"><input type="checkbox" value='0' class='form-control data-sending' id="status_validate_1" name="status_validate_1"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='validate_1' name='validate_1' placeholder='Nama Pelanggan' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Alamat</td>
                </tr>
                <tr>
                    <td width="1%"><input type="checkbox" value='0' class='form-control data-sending' name="status_validate_2" id="status_validate_2"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='validate_2' name='validate_2' placeholder='Alamat' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Kecepatan</td>
                </tr>
                <tr>
                    <td width="1%"><input type="checkbox" value='0' class='form-control data-sending' name="status_validate_3" id="status_validate_3"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='validate_3' name='validate_3' placeholder='Kecepatan' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Tagihan</td>
                </tr>
                <tr>
                    <td width="1%"><input type="checkbox" value='0' class='form-control data-sending' name="status_validate_4" id="status_validate_4"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='validate_4' name='validate_4' placeholder='Tagihan' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Tahun pemasangan Produk Telkom</td>
                </tr>
                <tr>
                    <td width="1%"><input type="checkbox" value='0' class='form-control data-sending' id="status_validate_5" name="status_validate_5"></td>
                    <td> <input type='year' class='form-control data-sending focus-color' id='validate_5' name='validate_5' placeholder='Tahun pemasangan Produk Telkom' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Tempat Pembayaran</td>
                </tr>
                <tr>
                    <td width="1%"><input type="checkbox" value='0' class='form-control data-sending' name="status_validate_6" id="status_validate_6"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='validate_6' name='validate_6' placeholder='Tempat Pembayaran' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Kode Verifikasi</td>
                </tr>
                <tr>
                    <td width="1%"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='veri_system_qc' name='veri_system_qc' placeholder='Kode Verivikasi' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Keterangan</td>
                </tr>
                <tr>
                    <td width="1%"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='keterangan_qc' name='keterangan_qc' placeholder='Keterangan' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Durasi</td>
                </tr>
                <tr>
                    <td width="1%"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='durasi_qc' name='durasi_qc' placeholder='Durasi' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>AHT > 3menit</td>
                </tr>
                <tr>
                    <td width="1%"></td>
                    <td> <!--<input type='text' class='form-control data-sending focus-color' id='aht_qc' name='aht_qc' placeholder='AHT > 3menit' value=''> -->
                    <select class="form-control data-sending focus-color" id='aht_qc' name='aht_qc' >
                        <option value="Agent Melakukan Carring">Agent Melakukan Carring</option>
                        <option value="Pelanggan Ragu - Ragu">Pelanggan Ragu - Ragu</option>
                        <option value="Pelanggan Meminta Menunggu">Pelanggan Meminta Menunggu</option>
                        <option value="Pertanyaan Agent berbelit - belit">Pertanyaan Agent berbelit - belit</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>Note</td>
                </tr>
                <tr>
                    <td width="1%"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='note_qc' name='note_qc' placeholder='Note' value=''>
                    </td>
                </tr>

                <tr>
                    <td colspan='2'>
                        <br>
                        <div class='form-group'>
                            <button id='btn-approve' type='button' class='btn btn-success btn-block'><i class='fe fe-check'></i> APPROVE</button>
                        </div>

                    </td>

                </tr>
                <tr class="elem_not_approve" style="display:none;">
                    <td colspan=2>Reason QA</td>
                </tr>
                <tr class="elem_not_approve" style="display:none;">
                    <td width="1%"></td>
                    <td> <input type='text' class='form-control data-sending focus-color' id='reason_qa' name='reason_qa' placeholder='Reason QA' value=''>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <div class='form-group'>
                            <button id='btn-not-approve' type='button' class='btn btn-danger btn-block'><i class='fe fe-x'></i> NOT APPROVE</button>
                        </div>

                    </td>

                </tr>
                <tr>
                    <td colspan='2'>
                        <div class='form-group'>
                            <input type='hidden' id="status_approve" name="status_approve" class="data-sending">
                            <input type='hidden' id="agentid" name="agentid" class="data-sending" value="<?php echo $_GET['agentid'] ?>">
                            <input type='hidden' id="lup" name="lup" class="data-sending" value="<?php echo $data->lup ?>">
                            <button disabled='' id='btn-save' type='button' class='btn btn-primary btn-block'><i class="fe fe-save"></i> <?php echo $title->general->button_save ?></button>
                        </div>

                    </td>

                </tr>
                <tr>

                    <td colspan='2'>
                        <div class='form-group'>
                            <a href='<?php echo base_url() . 'Qc/Qc/check_verified?start=' . $_GET['start'] . '&end=' . $_GET['end'] . '&agentid=' . $_GET['agentid'] ?>' id='btn-close' class='btn btn-warning btn-block'> Back</a>
                        </div>

                    </td>
                </tr>
            </table>

        </div>
    </div>

</form>


<?php echo card_close() ?>

<?php echo _js('selectize,datepicker') ?>

<script>
    var page_version = "1.0.8"
</script>

<script>
    var custom_select = $('.custom-select').selectize({});
    var custom_select_link = $('.custom-select-link');

    $(document).ready(function() {
        <?php
        /*
	|--------------------------------------------------------------
	| CARA MEMBUAT COMBOBOX LINK
	|--------------------------------------------------------------
	| COMBOBOX LINK adalah proses membuat sebuah combobox menjadi 
	| referensi combobox lainnya dalam menampilkan data.
	| misal :
	|  combobox grup menjadi referensi combobox subgrup.
	|  perubahan/pemilihan data combobox grup menyebabkan 
	|  perubahan data combobox subgrup. 
	|--------------------------------------------------------------
	| cara :
	|  - isi "field_link" pada combobox target 
	| 	 'field_link'	=>'nama_field_join_database'.
	|  - gunakan class "custom-select-link" pada kedua combobox ,
	|	 referensi dan target.
	|  - tambahkan script :
	|     linkToSelectize('id_cmb_referensi','id_cmb_target');
	|--------------------------------------------------------------
	| note :
	|   - struktur database harus menggunakan field id sebagai primary key
	|   - combobox harus di buat dengan php code
	|	-  "create_cmb_database" untuk row < 1000
	|	-  dan linkToSelectize untuk row < 1000
	|
	|	-  "create_cmb_database_bigdata" untuk row > 1000
	|	-  dan linkToSelectize_Big untuk row > 1000
	|   - 
	|   - class harus menggunakan "custom-select-link"
	|
	*/
        ?>
    })


    $('.data-sending').keydown(function(e) {
        remove_message();
        switch (e.which) {
            case 13:
                apply();
                return false;
        }
    });
</script>

<script>
    $('.input-simple-date').datepicker({
        autoclose: true,
        format: 'dd.mm.yyyy',
    })

    $('#btn-apply').click(function() {
        apply();
        play_sound_apply();
    });
    $('#btn-approve').click(function() {
        apply();
        play_sound_apply();
        $("#status_approve").val(1);
        $('#btn-not-approve').attr('disabled', true);
        $("#reason_qa").val("");
        $("#elem_not_approve").hide();
    });
    $('#btn-not-approve').click(function() {
        apply();
        play_sound_apply();
        $("#status_approve").val(0);
        $('#btn-approve').attr('disabled', true);
        $("#elem_not_approve").show();
    });
    $("#status_validate_1").change(function() {
        if ($('#status_validate_1').is(":checked")) {
            $("#status_validate_1").val(1);
        } else {
            $("#status_validate_1").val(0);
        }
    });
    $("#status_validate_2").change(function() {
        if ($('#status_validate_2').is(":checked")) {
            $("#status_validate_2").val(1);
        } else {
            $("#status_validate_2").val(0);
        }
    });
    $("#status_validate_3").change(function() {
        if ($('#status_validate_3').is(":checked")) {
            $("#status_validate_3").val(1);
        } else {
            $("#status_validate_3").val(0);
        }
    });
    $("#status_validate_4").change(function() {
        if ($('#status_validate_4').is(":checked")) {
            $("#status_validate_4").val(1);
        } else {
            $("#status_validate_4").val(0);
        }
    });
    $("#status_validate_5").change(function() {
        if ($('#status_validate_5').is(":checked")) {
            $("#status_validate_5").val(1);
        } else {
            $("#status_validate_5").val(0);
        }
    });
    $("#status_validate_6").change(function() {
        if ($('#status_validate_6').is(":checked")) {
            $("#status_validate_6").val(1);
        } else {
            $("#status_validate_6").val(0);
        }
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

    function apply() {
        $.each(custom_select, function(key, val) {
            val.selectize.disable();
        });

        <?php
        // NOTE : FOR DISABLE CUSTOM-SELECT-LINK 
        ?>
        // $.each(custom_select_link,function(key,val){
        // 		val.selectize.disable();
        // });

        $('.form-control').attr('disabled', true);
        $('#btn-apply').attr('disabled', true);
        $('#btn-cancel').attr('disabled', false);
        $('#btn-save').attr('disabled', false);
        $('#btn-save').focus();
    }

    function cancel() {
        $.each(custom_select, function(key, val) {
            val.selectize.enable();
        });
        <?php
        // NOTE : FOR ENABLE CUSTOM-SELECT-LINK  
        ?>
        // $.each(custom_select_link,function(key,val){
        // 		val.selectize.enable();
        // });

        $('.form-control').attr('disabled', false);
        $('#btn-cancel').attr('disabled', true);
        $('#btn-save').attr('disabled', true);
        $('#btn-apply').attr('disabled', false);

    }


    function simpan() {
        <?php
        /* mengambil data yang akan di kirim dari form-a */
        /* dalam bentuk array json tanpa penutup.. */
        /* memungkinkan penambahan data dengan cara push */
        /* ex. data.push */
        ?>
        var data = get_dataSending('form-a');

        <?php
        /* complite json format */
        /* ybs_dataSending(array); */
        ?>
        send_data = ybs_dataSending(data);

        var a = new ybsRequest();
        a.process('<?php echo $link_save ?>', send_data, 'POST');
        a.onAfterSuccess = function() {
            // cancel();
            window.location.href = '<?php echo base_url() . "Qc/Qc/check_verified?agentid=" . $_GET['agentid'] . "&start=" . $_GET['start'] . "&end=" . $_GET['end'] ?>';
        }
        a.onBeforeFailed = function() {
            cancel();
        }
    }
</script>