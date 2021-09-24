<?php echo _css('selectize,datepicker') ?>

<?php echo card_open('Form', 'bg-green', true) ?>

<form id="form_filter" method="POST" action="<?php echo $link_submit; ?>">
    <div class='row'>
        <div class='col-md-12 col-xl-12'>
            <div class='form-group'>
                <label class='form-label'>SUMBER</label>
                <select id="sumber" name="sumber" class="form-control">
                    <option value="semua" <?php echo ($filter['sumber'] == "semua") ? "selected" : ""; ?>>Semua Sumber</option>
                    <option value="VA" <?php echo ($filter['sumber'] == "VA") ? "selected" : ""; ?>>VA</option>
                    <option value="ERROR" <?php echo ($filter['sumber'] == "ERROR") ? "selected" : ""; ?>>ERROR</option>
                    <option value="HVC" <?php echo ($filter['sumber'] == "HVC") ? "selected" : ""; ?>>HVC</option>
                    <option value="NOSSA" <?php echo ($filter['sumber'] == "NOSSA") ? "selected" : ""; ?>>NOSSA</option>
                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>ERROR (Untuk Sumber ERROR)</label>
                <select id="error" name="error" class="form-control">
                    <option value="semua" <?php echo ($filter['error'] == "semua") ? "selected" : ""; ?>>Semua</option>
                    <option value="1038" <?php echo ($filter['error'] == "1038") ? "selected" : ""; ?>>ERROR 1038</option>
                    <option value="1049" <?php echo ($filter['error'] == "1049") ? "selected" : ""; ?>>ERROR 1049</option>
                    <option value="1048" <?php echo ($filter['error'] == "1048") ? "selected" : ""; ?>>ERROR 1048</option>
                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>ADDON (Untuk Sumber VA)</label>
                <select id="addon" name="addon" class="form-control">
                    <option value="semua" <?php echo ($filter['addon'] == "semua") ? "selected" : ""; ?>>Semua Sumber</option>
                    <option value="MINIPACK" <?php echo ($filter['addon'] == "MINIPACK") ? "selected" : ""; ?>>MINIPACK</option>
                    <option value="UPSPEED" <?php echo ($filter['addon'] == "UPSPEED") ? "selected" : ""; ?>>UPGRADE</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xs-12 blink_me_veri">
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="verified"><?php echo number_format($jumlah_data); ?></h3>
                <p>Jumlah Data</p>
            </div>
            <div class="icon-counter">
                <i class="fa fa-check-square-o"></i>
            </div>
        </div>
    </div>
    <?php echo card_open('Pembagian DAPROS', 'bg-green', true) ?>


    <!-- <div class='row'>

        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>DUPLICATE</label>
                <input type='text' class='form-control data-sending focus-color' id='no_speedy' name='no_speedy' placeholder='<?php echo $title->general->desc_required ?>' value='<?php echo $filter['no_speedy'] ?>'>
            </div>
        </div>
    </div> -->
    <div class='row'>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>PETUGAS</label>
                <select name='agentid[]' id="select-agent" onchange="kalkulate()" class="form-control custom-select" multiple="multiple">
                    <option value="0">--Semua Petugas--</option>
                    <?php
                    if ($list_agent_d['num'] > 0) {
                        foreach ($list_agent_d['results'] as $d_agent) {
                            $selected = "";
                            echo "<option value='" . $d_agent->agentid . "' " . $selected . ">" . $d_agent->agentid . "-" . $d_agent->nama . "</option>";
                        }
                    }
                    ?>

                </select>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>LIMIT</label>
                <input type="hidden" name="jumlah_data" id="jumlah_data" value="<?php echo $jumlah_data; ?>">
                <input type="hidden" name="jumlah_agent" id="jumlah_agent" value="<?php echo $list_agent_d['num']; ?>">
                <input type='number' maxlength="<?php echo $jumlah_data; ?>" class='form-control data-sending focus-color' id='limit' name='limit' placeholder='<?php echo $title->general->desc_required ?>' value='0' onkeyup="kalkulate()" required>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>JUMLAH</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='dibagi' name='dibagi' placeholder='<?php echo $title->general->desc_required ?>' value='0'>
            </div>
        </div>
        <div class='col-md-6 col-xl-6'>
            <div class='form-group'>
                <label class='form-label'>SISA</label>
                <input type='text' readonly class='form-control data-sending focus-color' id='sisa' name='sisa' placeholder='<?php echo $title->general->desc_required ?>' value='<?php echo $jumlah_data ?>'>
            </div>
        </div>

        <div class='col-md-12 col-xl-12'>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'><i class="fe fe-save"></i> BAGIKAN</button>
                <a href='<?php echo $link_back ?>' id='btn-close' class='btn btn-danger'> <?php echo $title->general->button_close ?></a>
                <!-- <button type='button' id="filter_again" class='btn btn-success'><i class="fe fe-search"></i> FILTER</button> -->

            </div>

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

    function kalkulate() {
        var jumlah_data = parseInt($("#jumlah_data").val());
        var limit = parseInt($("#limit").val());
        var agentid = $("#select-agent").val();
        var jumlah_agent = parseInt($("#jumlah_agent").val());
        if (agentid[0] == "0") {
            $("#dibagi").val(limit * jumlah_agent);
            $("#sisa").val(jumlah_data - (limit * jumlah_agent));
        } else {
            var jumlah_selected = $("#select-agent :selected").length;
            if (jumlah_selected > 1) {
                jumlah_agent = jumlah_selected;
            } else {
                jumlah_agent = 1;
            }
            $("#dibagi").val(limit * jumlah_agent);
            $("#sisa").val(jumlah_data - (limit * jumlah_agent));
        }


    }
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
    $("#filter_again").click(function() {
        $("#form_filter").attr("action", "<?php echo $link_filter; ?>");
        $("#form_filter").submit();
    });
</script>