
				<div class="container">

					<div class='row' id="content-body">
						<table width="100%">

							<tr>
								<td width="15%"></td>
								<td colspan="2" width="70%">
									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">
												<div class="card">
													<div class="card-status bg-green"></div>
													<div class="card-header">
														<h3 class="card-title"><?php echo ucwords(strtolower($title_page_big)) ?></h3>

													</div>
													<div class="card-body">
														<form id='form-a'>
															<div class="row">
																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_NCLI ?></label>
																		<input type='text' <?php echo (isset($data) ? 'readonly' : ''); ?> class='form-control data-sending focus-color' id='NCLI' name='NCLI' value='<?php if (isset($data)) echo $data->ncli ?>'>
																	</div>
																</div>


																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_NO_PSTN ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='NO_PSTN' name='NO_PSTN' value='<?php if (isset($data)) echo $data->no_pstn ?>'>
																	</div>
																</div>


																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_NO_SPEEDY ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='NO_SPEEDY' name='NO_SPEEDY' value='<?php if (isset($data)) echo $data->no_speedy ?>'>
																	</div>
																</div>


																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_NAMA_PELANGGAN ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='NAMA_PELANGGAN' name='NAMA_PELANGGAN' value='<?php if (isset($data)) echo $data->nama_pelanggan ?>'>
																	</div>
																</div>


																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_RELASI ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='NAMA_PELANGGAN' name='NAMA_PELANGGAN' value='<?php if (isset($data)) echo $data->relasi ?>'>

																	</div>
																</div>


																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_NO_HP ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='NO_HP' name='NO_HP' value='<?php if (isset($data)) echo $data->no_handpone ?>'>
																	</div>
																</div>

																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_EMAIL ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='EMAIL' name='EMAIL' value='<?php if (isset($data)) echo $data->email ?>'>
																	</div>
																</div>


																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_NAMA_PEMILIK ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='NAMA_PEMILIK' name='NAMA_PEMILIK' value='<?php if (isset($data)) echo $data->nama_pastel ?>'>
																	</div>
																</div>


																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_ALAMAT ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='ALAMAT' name='ALAMAT' value='<?php if (isset($data)) echo $data->alamat ?>'>
																	</div>
																</div>


																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_KOTA ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='KOTA' name='KOTA' value='<?php if (isset($data)) echo $data->kota ?>'>
																	</div>
																</div>


																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_REGIONAL ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='REGIONAL' name='REGIONAL' value='<?php if (isset($data)) echo $data->regional ?>'>
																	</div>
																</div>
																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_TGL_VERIFIKASI ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='TGL_VERIFIKASI' name='TGL_VERIFIKASI' value='<?php echo (isset($data) ? $data->lup : date('Y-m-d h:i:s')); ?>'>
																	</div>
																</div>
																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'><?php echo $title->dbprofile_verified_SUMBER ?></label>
																		<input type='text' readonly class='form-control data-sending focus-color' id='SUMBER' name='SUMBER' value='<?php echo 'infomedia'; ?>'>
																	</div>
																</div>
																<div class='col-md-6 col-xl-6'>
																	<div class='form-group'>
																		<label class='form-label'>PAYMENT</label>
																		<table class="table">
																			<tr>
																				<td>Jumlah Tagihan</td>
																				<td><?php echo $payment['jumlah_tagihan']?></td>
																			</tr>
																			<tr>
																				<td>Tanggal Terakhir Bayar</td>
																				<td><?php echo $payment['terakhir_bayar']?></td>
																			</tr>
																		</table>
																	</div>
																</div>

																<div class='col-md-12 col-xl-12'>

																	<div class='form-group'>
																		<a href='<?php echo $link_back ?>' id='btn-close' class='btn btn-primary btn-block'>BACK</a>
																	</div>

																</div>
															</div>
														</form>

													</div>
												</div>
											</div>


										</div>
									</div>
								</td>
								<td width="15%"></td>
							</tr>
						</table>
					</div>


				</div>
			