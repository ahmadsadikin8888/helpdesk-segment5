<?php echo _css('selectize,datepicker') ?>

<div class="card ">
    <div class="card-status bg-green"></div>
    <div class="card-header">
        <h3 class="card-title">Form Add Work Order</h3>
    </div>
    <div class="card-body">
        </style>
        <form action="<?php echo base_url() ?>Outbound/Outbound/insertdata" method="post" enctype="multipart/form-data">
            <div class="panel panel-lte">
                <div class="panel-heading lte-heading-primary">DETAIL</div>
                <div class="panel-body row">

                    <div class="col-md border-left">
                        <table width="100%">
                            <tr>
                                <td colspan=3 align="right">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>ND</td>
                                <td colspan="2">
                                    <input type="text" class="form-control data-sending" value="" id="NDEM" name="NDEM">
                                </td>
                            </tr>
                            <tr>
                                <td>ADDON</td>
                                <td colspan="2">
                                    <input type="text" class="form-control data-sending" value="<?php echo $datanya->ADDON; ?>" id="ADDON" name="ADDON">
                                </td>
                            </tr>
                            <tr>
                                <td>KAWASAN</td>
                                <td colspan="2">
                                    <input type="text" class="form-control data-sending" value="<?php echo $datanya->KAWASAN; ?>" id="KAWASAN" name="KAWASAN">

                                </td>
                            </tr>
                            <tr>
                                <td>WITEL</td>
                                <td colspan="2">
                                    <input type="text" class="form-control data-sending" value="<?php echo $datanya->WITEL; ?>" id="WITEL" name="WITEL">

                                </td>
                            </tr>
                            <tr>
                                <td>CHANEL</td>
                                <td colspan="2">
                                    <select class="form-control data-sending" id="CHANEL" name="CHANEL">
                                        <option value="TAM">TAM</option>
                                        <option value="MY IH">MY IH</option>
                                        <option value="MOSS">MOSS</option>
                                        <option value="147">147</option>
                                        <option value="PLASA">PLASA</option>
                                        <option value="Nossa">Nossa</option>
                                        <option value="SOSMED">SOSMED</option>
                                        <option value="TREG">TREG</option>
                                        <option value="WITEL">WITEL</option>
                                        <option value="C4">C4</option>
                                        <option value="MINIPACK">MINIPACK</option>
                                        <option value="TEKNISI" selected>TEKNISI</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>ITEM</td>
                                <td colspan="2">
                                    <input type="text" class="form-control data-sending" value="<?php echo $datanya->ITEM; ?>" id="ITEM" name="ITEM">
                                </td>
                            </tr>
                            <tr>
                                <td>CPACK</td>
                                <td colspan="2">
                                    <input type="text" class="form-control data-sending" value="<?php echo $datanya->CPACK; ?>" id="CPACK" name="CPACK">
                                </td>
                            </tr>
                            <tr>
                                <td>STATUS</td>
                                <td colspan="2">
                                    <select class="form-control data-sending" id="veri_call" name="veri_call">
                                        <?php
                                        $data_status = array(1 => "VA", 2 => "PI", 3 => "PS", 4 => "CA", 5 => "CLEANSING", 6 => "BACK TO INPUTER", 7 => "PENDING");
                                        if (count($data_status) > 0) {
                                            foreach ($data_status as $hs => $Val_hs) {
                                                $selected = "";
                                                echo "<option value='" . $Val_hs . "' " . $selected . ">" . $Val_hs . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>SUMBER</td>
                                <td colspan="2">
                                    <select class="form-control data-sending" id="sumber" name="sumber">
                                        <option value="VA">VA</option>
                                        <option value="ERROR">ERROR</option>
                                        <option value="whatsapp">Whatsapp</option>
                                        <option value="telegram">Telegram</option>
                                        <option value="Nossa">Nossa</option>
                                        <option value="Poin">Poin</option>
                                        <option value="c4">C4</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo base_url() ?>Outbound/Outbound">
                            <div class="btn btn-default pull-left"> cancel</div>
                        </a>
                    </div>
                    <div class="col-md">
                        <button type="submit" id="submits" class="submit btn btn-primary pull-right"><span class="fe fe-save"></span> Submit</button>
                    </div>


                </div>

            </div>


    </div>
</div>
</form>


<?php echo card_close() ?>

<button class="submit btn btn-warning pull-right" id="toTop" style="position: sticky; bottom:0;
    right:0;"><span class="fe fe-arrow-up"></span></button>

<?php echo _js('selectize,datepicker') ?>


<script src="<?php echo base_url() ?>assets/js/mailcheck.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.stopwatch.js"></script>
<script>
    $(document).ready(function() {



    });
</script>
<script>
    $("#toTop").click(function() {
        //1 second of animation time
        //html works for FFX but not Chrome
        //body works for Chrome but not FFX
        //This strange selector seems to work universally
        $("html, body").animate({
            scrollTop: 0
        }, 1000);
    });
</script>

<script>
    var page_version = "1.0.8"
</script>

<script>
    $(document).ready(function() {

        $('.text_validation').hide();
        // $("input").prop('readonly', true);
        // $("#ADDON").prop('readonly', false);
        // $("#KAWASAN").prop('readonly', false);
        // $("#CHANEL").prop('readonly', false);
        // $("#TGL_VA").prop('readonly', false);
        // $("#umur").prop('readonly', false);
        // $("#ITEM").prop('readonly', false);
        // $("#STATUS_SC").prop('readonly', false);

    });
</script>


<script>
    $(document).ready(function() {

        $('form').submit(function() {


            var agentid = "<?php echo $_GET['userid']; ?>";




            jQuery.fn.preventDoubleSubmission = function() {
                $(this).on('submit', function(e) {
                    var $form = $(this);

                    if ($form.data('submitted') === true) {
                        // Previously submitted - don't submit again
                        e.preventDefault();
                    } else {
                        // Mark it so that the next submit can be ignored
                        $form.data('submitted', true);

                    }
                });

                // Keep chainability
                return this;
            };



        });




    });
</script>
<script>

</script>
<script>
    // jQuery plugin to prevent double submission of forms
    jQuery.fn.preventDoubleSubmission = function() {
        $(this).on('submit', function(e) {
            var $form = $(this);

            if ($form.data('submitted') === true) {
                // Previously submitted - don't submit again
                e.preventDefault();
            } else {
                // Mark it so that the next submit can be ignored
                $form.data('submitted', true);

            }
        });

        // Keep chainability
        return this;
    };

    // $('form').preventDoubleSubmission();
    function copypaste() {
        /* Get the text field */
        var copyText = document.getElementById("no_handpone");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        // alert("Copied the text: " + copyText.value);
    }

    function copypaste2() {
        /* Get the text field */
        var copyText = document.getElementById("no_speedy");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        // alert("Copied the text: " + copyText.value);
    }
    $(document).ready(function() {


        $('.veri_statusopt_v').hide();
        $('.veri_statusopt_dk').hide();
        $('.veri_statusopt_nv').hide();

        $("#add").click(function() {
            var lastField = $("#buildyourform div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $(
                "<td width=\"100%\"><input type=\"text\" id=\"hptambahan" + intId +
                "\" name=\"hptambahan" + intId +
                "\" class=\"fieldname form-control data-sending\" /></td>"
            );
            var fType = $(
                ""
            );
            var removeButton = $(
                "<td><input type=\"button\" class=\"remove btn btn-danger\" value=\"-\" /></td>"
            );
            removeButton.click(function() {
                $(this).parent().remove();
            });
            fieldWrapper.append(fName);
            fieldWrapper.append(fType);
            fieldWrapper.append(removeButton);
            $("#buildyourform").append(fieldWrapper);
        });
        $("#add2").click(function() {
            var lastField = $("#buildyourformemail div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $(
                "<td width=\"100%\"><input type=\"email\" id=\"emailtambahan" + intId +
                "\" name=\"emailtambahan" + intId +
                "\" class=\"fieldname form-control data-sending\" /></td>"
            );
            var fType = $(
                ""
            );
            var removeButton = $(
                "<td><input type=\"button\" class=\"remove btn btn-danger\" value=\"-\" /></td>"
            );
            removeButton.click(function() {
                $(this).parent().remove();
            });
            fieldWrapper.append(fName);
            fieldWrapper.append(fType);
            fieldWrapper.append(removeButton);
            $("#buildyourformemail").append(fieldWrapper);
        });
        $("#billing").change(function() {
            var valna = $(this).val();
            var comma = valna.replace(",", "");
            var titik = comma.replace(".", "");
            var res = titik.replace("e", "");
            $(this).val(res);
        });
    });
    $('.opsicontacted').hide();
    $('.opsinc').hide();
    $("#labelvalidated").show();
    $("#labelvalidate").hide();
    var Privileges = jQuery('#kategori_call');
    var select = this.value;
    Privileges.change(function() {
        if ($(this).val() == '1') {
            $('.opsicontacted').show();
            $('.opsinc').hide();
            $('.veri_statusopt_p').show();
            $('.veri_statusopt_v').show();
            $('.veri_statusopt_dk').show();
            $('.veri_statusopt_nv').show();
        } else if ($(this).val() == '0') {
            $('.opsinc').show();
            $('.opsicontacted').hide();
            $('[name=veri_status]').val(2);
            $('[name=veri_call]').val(0);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
        } else if ($(this).val() == 'x') {
            $('.opsinc').hide();
            $('.opsicontacted').hide();
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
            $('.veri_statusopt_nv').hide();
        }
        //     $('.opsicontacted').hide(); // hide div if value is not "custom"
        //     $('.opsinc').show(); // hide div if value is not "custom"
    });

    var Privileges = jQuery('#veri_call');
    var select = this.value;
    Privileges.change(function() {
        if ($(this).val() == '13') {
            $('[name=veri_status]').val(1);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').show();
            $('.veri_statusopt_dk').hide();
            $('.veri_statusopt_nv').hide();
        } else if ($(this).val() == '12') {
            $('[name=veri_status]').val(3);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').show();
            $('.veri_statusopt_nv').hide();
        } else if ($(this).val() == '11') {
            $('[name=veri_status]').val(2);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
            $('.veri_statusopt_nv').show();
        } else if ($(this).val() != '11' || $(this).val() != '12' || $(this).val() != '13' || $(this).val() != '0') {
            $('[name=veri_status]').val(2);
            $('[name=kategori_call]').val(0);
            $('.veri_statusopt_p').hide();
            $('.veri_statusopt_v').hide();
            $('.veri_statusopt_dk').hide();
            $('.veri_statusopt_nv').show();
        }
        //     $('.opsicontacted').hide(); // hide div if value is not "custom"
        //     $('.opsinc').show(); // hide div if value is not "custom"
    });




    var countChecked = function() {
        var n = $("input.validate:checked").length;
        var valid =
            '<option selected="selected" value=""> --Pilih-- </option><option value="1">Verified</option><option value="3">Ditelepon kembali</option>';
        var notvalid =
            '<option value="Pilih"> --Pilih-- </option><option value="2" selected="selected">Not Verified</option><option value="3" >Ditelepon kembali</option>';

        if (n > 3) {
            // $("#labelvalidate").show();
            //$("#veri_status").children("option[value=1]").show());
            $("#labelvalidated").val("valid");
            $('#labelvalidated').css({
                'background-color': '#28a745'
            });
            // $('[name=status_validate]').val("valid");
        } else {
            // $("#labelvalidate").hide();
            //$("#veri_status").children("option[value=1]").show());
            $("#labelvalidated").val("not valid");
            $('#labelvalidated').css({
                'background-color': '#ff0100'
            });
        }
    };
    countChecked();
    $("input[type=checkbox]").on("click", countChecked);
</script>
<script type="text/javascript">
    $('#produk_moss').selectize({});
    // $('#agentid').multiselect();

    var page_version = "1.0.8"
</script>
<script>
    var domains = ['hotmail.com', 'gmail.com', 'aol.com'];
    var topLevelDomains = ["com", "net", "org"];
</script>