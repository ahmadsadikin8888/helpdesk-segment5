<div class="card ">
    <div class="card-status bg-green"></div>
    <div class="card-header">
        <h3 class="card-title">Form Work Order</h3>

    </div>

    <div class="card-body">
        <form id="form-a-<?php if (isset($datanya)) echo $datanya->id . "_" . $datanya->EXTERNAL_ORDER_ID ?>">
            <input hidden id="sumber" class="data-sending" name="sumber" value="<?php if (isset($datanya)) echo $datanya->sumber ?>">
            <input hidden id="id" class="data-sending" name="id" value="<?php if (isset($datanya)) echo $datanya->id ?>">
            <input hidden id="click_time" class="data-sending" name="click_time" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <div class="row">
                <div class="col-6">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-primary">DETAIL</div>
                        <div class="panel-body row">

                            <div class="col-md border-left">
                                <table width="100%">
                                    <tr>
                                        <td>ORDER ID</td>
                                        <td colspan="2">
                                            <input type="text" readonly class="form-control data-sending" value="<?php echo $datanya->EXTERNAL_ORDER_ID; ?>" id="EXTERNAL_ORDER_ID" name="EXTERNAL_ORDER_ID">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NO.INTERNET</td>
                                        <td colspan="2">
                                            <input type="text" class="form-control data-sending" value="<?php echo $datanya->ND_SPEEDY; ?>" id="ND_SPEEDY" name="ND_SPEEDY">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NDEM</td>
                                        <td colspan="2">
                                            <input type="text" class="form-control data-sending" value="<?php echo $datanya->NDEM; ?>" id="NDEM" name="NDEM">
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
                                            <input type="text" class="form-control data-sending" value="<?php echo $datanya->CHANEL; ?>" id="CHANEL" name="CHANEL">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TGL_VA</td>
                                        <td colspan="2">
                                            <input type="text" class="form-control data-sending" value="<?php echo $datanya->TGL_VA; ?>" id="TGL_VA" name="TGL_VA">

                                        </td>
                                    </tr>
                                    <!-- <tr>
                                <td>umur</td>
                                <td colspan="2">
                                    <input type="text" class="form-control data-sending" value="<?php echo $datanya->umur; ?>" id="umur" name="umur">

                                </td>
                            </tr> -->
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
                                            <input type="text" class="form-control data-sending" value="<?php echo $datanya->STATUS_SC; ?>" id="STATUS_SC" name="STATUS_SC">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>UPDATE STATUS</td>
                                        <td colspan="2">
                                            <select class="form-control data-sending" id="veri_call_<?php if (isset($datanya)) echo $datanya->EXTERNAL_ORDER_ID ?>" name="veri_call" onchange="vericall('<?php if (isset($datanya)) echo $datanya->EXTERNAL_ORDER_ID ?>');">
                                                <?php
                                                $data_status = array(1 => "VA", 2 => "PI", 3 => "PS", 4 => "CA", 5 => "CLEANSING", 6 => "BACK TO INPUTER", 7 => "PENDING");
                                                if (count($data_status) > 0) {
                                                    foreach ($data_status as $hs => $Val_hs) {
                                                        $selected = "";
                                                        if ($datanya->veri_call == $hs) {
                                                            $selected = "selected";
                                                        } else {
                                                            if ($datanya->STATUS_SC == $Val_hs) {
                                                                $selected = "selected";
                                                            }
                                                        }
                                                        echo "<option value='" . $Val_hs . "' " . $selected . ">" . $Val_hs . "</option>";
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </td>
                                    </tr>
                                    <?php
                                    $hiden = "display:none;";
                                    if ($datanya->veri_call != 3) {
                                        $hiden = "";
                                    } else {
                                        if ($datanya->STATUS_SC == "PS") {
                                            $hiden = "";
                                        }
                                    }
                                    ?>
                                    <tr id="reason_form_<?php if (isset($datanya)) echo $datanya->EXTERNAL_ORDER_ID ?>" style="<?php echo $hiden; ?>">
                                        <td>REASON</td>
                                        <td colspan="2">
                                            <input type="text" class="form-control data-sending" value="<?php echo $datanya->reason_va; ?>" id="reason_va_<?php if (isset($datanya)) echo $datanya->EXTERNAL_ORDER_ID ?>" name="reason_va">
                                        </td>
                                    </tr>

                                </table>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $id_unixna = $datanya->id . "_" . $datanya->EXTERNAL_ORDER_ID;
                                    $uri = base_url() . "Outbound/Outbound/edit?order_id=" . $datanya->EXTERNAL_ORDER_ID . "&id=" . $datanya->id;
                                    ?>
                                    <input type="hidden" id="urina-<?php if (isset($datanya)) echo $datanya->id . "_" . $datanya->EXTERNAL_ORDER_ID; ?>" value="<?php echo base_url() . "Outbound/Outbound/insertdata"; ?>">
                                    <input type="hidden" id="update_urina-<?php if (isset($datanya)) echo $datanya->id . "_" . $datanya->EXTERNAL_ORDER_ID; ?>" value="<?php echo base_url() . "Outbound/Outbound/edit?nd=" . $datanya->EXTERNAL_ORDER_ID . "&id=" . $datanya->id; ?>">
                                    <button id="btn-apply-<?php if (isset($datanya)) echo $datanya->id . "_" . $datanya->EXTERNAL_ORDER_ID; ?>" onclick="apply('<?php if (isset($datanya)) echo $id_unixna ?>')" type="button" class="btn btn-primary"><i class="fe fe-check"></i> Apply</button>
                                    <button disabled id="btn-save-<?php if (isset($datanya)) echo $datanya->id . "_" . $datanya->EXTERNAL_ORDER_ID; ?>" onclick="simpan('<?php if (isset($datanya)) echo $id_unixna ?>')" type="button" class="btn btn-primary"><i class="fe fe-save"></i> Submit</button>
                                    <button id="btn-closena" onclick="deleteclick('<?php if (isset($datanya)) echo $id_unixna; ?>','<?php echo $uri; ?>')" type="button" class="btn btn-danger">Close</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="col-6">
                    <div class="panel panel-lte">
                        <div class="panel-heading lte-heading-primary">History Status</div>
                        <div class="panel-body row">
                            <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <td>Datetime</td>
                                        <td>Status</td>
                                        <td>Reason</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data_status = array(1 => "VA", 2 => "PI", 3 => "PS", 4 => "CA", 5 => "CLEANSING", 6 => "BACK TO INPUTER", 7 => "PENDING");
                                    if (count($history) > 0) {
                                        foreach ($history as $hs) {
                                    ?>
                                            <tr>
                                                <td><?php echo $hs->lup; ?></td>
                                                <td><?php echo $data_status[$hs->veri_call]; ?></td>
                                                <td><?php echo $hs->reason_va; ?></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan='3' style="text-align:center;">--Tidak Ada History Status--</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
<?php echo card_close() ?> <button class="submit btn btn-warning pull-right" id="toTop" style="position: sticky; bottom:0;
    right:0;"><span class="fe fe-arrow-up"></span></button>

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