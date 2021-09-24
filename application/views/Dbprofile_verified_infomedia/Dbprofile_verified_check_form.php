
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

														<form method="POST" action="<?php echo $link_save; ?>">
															<div class='col-md-12 col-xl-12'>
																<div class='form-group'>
																	<label class='form-label'>PENCARIAN BERDASARKAN</label>
																	<select id="berdasarkan" name="berdasarkan" class="form-control">
																		<option value="ncli" selected>NCLI</option>
																		<option value="no_pstn">NO PSTN</option>
																		<option value="no_speedy">NO INTERNET</option>
																		<option value="no_handpone">NO HANDPHONE</option>
																	</select>
																</div>
															</div>
															<div class='col-md-12 col-xl-12'>
																<div class='form-group'>
																	<label class='form-label'>NCLI/NO PSTN/NO INTERNET/NO HANDPHONE</label>
																	<input type='text' class='form-control data-sending focus-color' id='ncli' name='ncli' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->ncli ?>'>
																</div>
															</div>



															<div class='col-md-12 col-xl-12'>

																<div class='form-group'>
																	<button type='submit' class='btn btn-primary btn-block'><i class="fe fe-save"></i> Check</button>
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
			