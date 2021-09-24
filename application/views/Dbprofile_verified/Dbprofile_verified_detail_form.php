<!doctype html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Language" content="en" />
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="theme-color" content="#4188c9">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">

	<title><?php echo $this->_appinfo['template_title_bar'] ?></title>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
	-->

	<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script>
		var data_token = "<?php echo  $this->_token ?>";
		var sec_val = "<?php echo $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() ?>&";
		var xax = "<?php echo $fparent ?>"
	</script>
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/fw/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/tabler/bower_components/Ionicons/css/ionicons.min.css" />

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dashboard.css" />
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/toastr-master/toastr.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.css">

	<script src="<?php echo base_url() ?>assets/js/vendors/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/vendors/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/dashboard.js"></script>
	<script src="<?php echo base_url() ?>assets/js/core.js"></script>
	<script src="<?php echo base_url() ?>assets/toastr-master/toastr.js"></script>


	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/EnlighterJS/Build/EnlighterJS.min.css" />
	<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/EnlighterJS/Resources/MooTools-Core-1.6.0.js"></script>


	<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/EnlighterJS/Build/EnlighterJS.min.js"></script>
	<meta name="EnlighterJS" content="Advanced javascript based syntax highlighting" data-language="javascript" data-indent="2" data-selector-block="pre" data-selector-inline="code" />
	<style type="text/css">
		/* custom hover effect using specific css class */
		.EnlighterJS.myHoverClass li:hover {
			background-color: #c0c0c0;
		}
	</style>



</head>

<body class="">
	<div class="page">
		<div class="page-main">
			<div class="header py-4">
				<div class="container">
					<div class="d-flex">

						<a class="header-brand" href="javascript:void(0)">
							<img src="<?php echo base_url("api/Public_Access/get_logo_template") ?>" class="header-brand-img h-<?php echo $this->_appinfo['template_logo_size'] ?>" alt="ybs logo">
						</a>

						<div class="d-flex order-lg-2 ml-auto">



						</div>

					</div>
				</div>
			</div>
			<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-3 ml-auto">

						</div>
						<div class="col-lg order-lg-first">
							<ul class="nav nav-tabs border-0 flex-column flex-lg-row">



							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="my-3 my-md-5">
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
				<option value="NCLI" selected>NCLI</option>
				<option value="NO_PSTN">NO PSTN</option>
				<option value="NO_SPEEDY">NO INTERNET</option>
				<option value="NO_HP">NO HANDPHONE</option>
			</select>
		</div>
	</div>
	<div class='col-md-12 col-xl-12'>
		<div class='form-group'>
			<label class='form-label'>NCLI/NO PSTN/NO INTERNET/NO HANDPHONE</label>
			<input type='text' class='form-control data-sending focus-color' id='NCLI' name='NCLI' placeholder='<?php echo $title->general->desc_required ?>' value='<?php if (isset($data)) echo $data->NCLI ?>'>
		</div>
	</div>



	<div class='col-md-12 col-xl-12'>

		<div class='form-group'>
			<button type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Check</button>
			<a href='<?php echo $link_back ?>' id='btn-close' class='btn btn-primary'> <?php echo $title->general->button_close ?></a>
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
			</div>
		</div>
	</div>
	<section id="section_script">

		<script id="src_ybs" src="<?php echo base_url() ?>assets/ybs.js"></script>
		<script src="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.js"></script>
		<script src="<?php echo base_url() ?>assets/plugins/input-mask/js/jquery.mask.min.js"></script>
	</section>
</body>

</html>