<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->
<?php echo _css("selectize,multiselect") ?>
<link href="<?php echo base_url(); ?>assets/progress_bar/css/static.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/progress_bar/js/jquery.progresstimer.js"></script>

<script src="<?php echo base_url(); ?>assets/progress_bar/js/static.min.js"></script>

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
					<div class="row">
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Mulai Dari</label>
								<input type='date' class='form-control data-sending focus-color' id='start' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Sampai </label>
								<input type='date' class='form-control data-sending focus-color' id='end' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Agent </label>
								<select name='agentid' id="agentid" class="form-control custom-select" >

									<?php

									echo "<option value='" . $_GET['agentid'] . "' selected>" . $_GET['agentid'] . "</option>";
									?>

								</select>
							</div>
						</div>

						<div class='col-md-12 col-xl-12'>

							<div class='form-group'>
								<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>

							</div>

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

	<div class='col-md-12 col-xl-12' id="list_area">
		<div class="loading-progress" style="width:100%;"></div>
	</div>
	<script type="text/javascript">
		var progress = $(".loading-progress").progressTimer({
			timeLimit: 90,
			onFinish: function() {
				// alert('completed!');
			}
		});



		function update_base_list_area() {
			var start = $("#start").val();
			var end = $("#end").val();
			var agentid = $("#agentid").val();
			$.ajax({
				url: "<?php echo base_url() . "Qc/Qc/get_data_verified" ?>",
				data: {
					start: start,
					end: end,
					agentid: agentid
				},
				methode: "get",
				success: function(response) {
					$("#list_area").html(response);
					progress.progressTimer('complete');
				},
				error: function() {
					progress.progressTimer('error', {
						errorText: 'ERROR!',
						onFinish: function() {
							alert('There was an error processing your information!');
						}
					});
				}
			});
		}

		$(document).ready(function() {
			update_base_list_area();
			// update_base_num_hp_email_area();
			// update_base_num_area();
		});
	</script>
<?php
}

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->
<?php echo _js("ybs,selectize,multiselect") ?>
<script type="text/javascript">
	$('#agentid').selectize({});
	// $('#agentid').multiselect();

	var page_version = "1.0.8"
</script>