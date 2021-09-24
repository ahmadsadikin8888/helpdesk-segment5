<?php echo _css('datatables,icheck') ?>
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
								<label class='form-label'>FILTER BY</label>
								<select id="filter" name="filter" class="form-control data-sending ">
									<option value="periode" <?php echo ($post['filter'] == 'periode' ? 'selected' : '')?>>PERIODE</option>
									<option value="keyword" <?php echo ($post['filter'] == 'keyword' ? 'selected' : '')?>>ND/NO.INTERNET/ORDER ID</option>
								</select>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>ND/NO.INTERNET/ORDER ID </label>
								<input type='input' class='form-control data-sending focus-color' id='id_reason' name='keyword' value='<?php if (isset($post['keyword'])) echo $post['keyword'] ?>'>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Mulai Dari</label>
								<input type='date' min="" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='start' value='<?php if (isset($post['start'])) echo $post['start'] ?>'>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Sampai </label>
								<input type='date' max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='end' value='<?php if (isset($post['end'])) echo $post['end'] ?>'>
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
<?php echo card_open('Daftar', 'bg-teal', true) ?>


<div class='box-body table-responsive' id='box-table'>
	<small>
		<table class='display nowrap' id="example2" style="width: 100%;">
			<thead>
				<tr>
					<th><b>No</b></th>
					<th nowrap><b>ORDER ID</b></th>
					<th><b>STATUS</b></th>
					<th nowrap><b>TGL VA</b></th>
					<th nowrap><b>LAST UPDATE</b></th>
					<th><b>PETUGAS</b></th>
					<th><b>ADDON</b></th>
					<th><b>SUMBER</b></th>
					<th><b>REG</b></th>
					<th><b>CHANEL</b></th>
					<th><b>ITEM</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$nomor = 1;
				$data_status = array(1 => "VA", 2 => "PI", 3 => "PS", 4 => "CA", 5 => "CLEANSING", 6 => "BACK TO INPUTER", 7 => "PENDING");
                 

				foreach ($data['list_outbound'] as $datana) {
				                              
				?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td>

							<?php echo $datana->EXTERNAL_ORDER_ID; ?>

						</td>

						<td><?php echo $data_status[$datana->v_status]; ?></td>
						<td><?php echo $datana->TGL_VA; ?></td>
						<td>
							<center><?php echo $datana->lup; ?></center>
						</td>
						<td><?php echo $datana->petugas; ?></td>
						<td><?php echo $datana->ADDON; ?></td>
						<td><?php echo $datana->sumber; ?></td>
						<td><?php echo $datana->KAWASAN; ?></td>
						<td><?php echo $datana->CHANEL; ?></td>
						<td><?php echo $datana->ITEM; ?></td>
					</tr>
				<?php
					$nomor++;
				}
				?>
			</tbody>
		</table>

	</small>
</div>





<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>

<script>
	var page_version = "1.0.8"
</script>
<script>
	$(document).ready(function() {
		$('#example2').DataTable();
	});

</script>