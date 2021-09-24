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
										<div class='box-body table-responsive' id='box-table'>
											<small>
												<table id='table-detail' class='table' style='width:150%'>
													<thead>

														<tr>
															<th>No</th>
															<th>NCLI</th>
															<th>PSTN</th>
															<th>NO.INTERNET</th>
															<th nowrap>NAMA PELANGGAN</th>
															<th>NO_HP</th>
															<th>EMAIL</th>
															<th>NAMA_PEMILIK</th>
															<!-- <th>ALAMAT</th> -->
															<th>KOTA</th>
															<th>TGL VERI</th>
															<th>ACTION</th>
														</tr>

														</tdead>
													<tbody>
														<?php
														$n = 1;
														if ($data['num'] > 0) {
															foreach ($data['results'] as $dt) {
														?>
																<tr>
																	<td><?php echo $n; ?></td>
																	<td><a href="<?php echo $link_detail . "?berdasarkan=" . $berdasarkan . "&ncli=" . $ncli . "&tgl_veri=" . $dt['lup']; ?>" class="btn btn-default text-blue btn-block "><?php echo $dt['ncli']; ?></a></td>
																	<td><?php echo $dt['no_pstn']; ?></td>
																	<td><?php echo $dt['no_speedy']; ?></td>
																	<td><?php echo $dt['nama_pelanggan']; ?></td>
																	<td><?php echo $dt['no_handpone']; ?></td>
																	<td><?php echo $dt['email']; ?></td>
																	<td><?php echo $dt['nama_pastel']; ?></td>
																	<!-- <td><?php echo $dt['alamat']; ?></td> -->
																	<td><?php echo $dt['kota']; ?></td>
																	<td><?php echo $dt['lup']; ?></td>
																	<td>
																		<a href="<?php echo $link_detail . "?berdasarkan=" . $berdasarkan . "&ncli=" . $ncli . "&tgl_veri=" . $dt['lup']; ?>" class="btn btn-default text-red btn-sm " title="DETAIL"><i class="fa fa-edit"></i></a>
																	</td>
																</tr>

														<?php
																$n++;
															}
														}

														?>
													</tbody>
												</table>
											</small>
										</div>

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
