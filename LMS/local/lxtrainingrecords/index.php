<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_lxtrainingrecords
 * @copyright   2024 LX <komkrit@learningx.co>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
global $CFG, $DB, $USER;

require_once($CFG->libdir . '/adminlib.php');

/** custom lib */
// require_once('lib.php');

require_login();

/** config page */
$title = get_string('title', 'local_lxtrainingrecords');
$heading = get_string('pluginname', 'local_lxtrainingrecords');

$url = new moodle_url('/local/lxtrainingrecords/index.php', []);
$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('trainingrecord');
$PAGE->set_title($title);
$PAGE->set_heading($title);



/** permission */
if (!has_capability('local/lxtrainingrecords:role', context_system::instance())) {
	echo $OUTPUT->header();
	echo html_writer::tag('h3', get_string('capability', 'local_lxtrainingrecords'), null);
	echo $OUTPUT->footer();
	exit;
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>

<?php echo $OUTPUT->header(); ?>


<!-- script 2 -->
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/jquery.dataTables.min.js"></script>
<!-- <script src="./assets/js/dataTables.bootstrap.min.js"></script> -->
<!-- <script src="./assets/js/tabledit.min.js"> </script> -->
<!-- <script src="./assets/js/lc_switch.js"></script> -->

<!-- <script src="./js/bootstrap-select.min.js"></script> -->
<!-- <script src="./js/dataTables.checkboxes.min.js"></script> -->

<script src="./assets/js/pdfmake.min.js"></script>
<script src="./assets/pdfmaker/vfs_fonts.js"></script>
<script src="./assets/js/dataTables.buttons.min.js"></script>
<script src="./assets/js/buttons.flash.min.js"></script>
<script src="./assets/js/jszip.min.js"></script>
<script src="./assets/js/buttons.html5.min.js"></script>
<script src="./assets/js/buttons.print.min.js"></script>

<!-- <script src="./js/sweetalert2@8.js"></script> -->
<script src="./assets/js/sweetalert2@11.js"></script>

<link rel="stylesheet" type="text/css" href="./assets/css/font-awesome.min.css" />
<!--  ใช้กับ moodle3.1 -->
<link rel="stylesheet" type="text/css" href="./asseTs/js/bootstrap.min.css" /> 
<!-- ไม่ใช้ -->
<!-- <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="./assets/css/dataTables.checkboxes.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap-select.min.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="./assets/js/dataTables.bootstrap.min.css" /> -->
<link rel="stylesheet" type="text/css" href="./assets/css/jquery.dataTables.min.css" />
<!-- <link rel="stylesheet" type="text/css" href="./assets/css/dataTables.dateTime.min.css" /> -->
<link rel="stylesheet" type="text/css" href="./assets/css/buttons.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="./assets/css/jquery.dm-uploader.css" />
<link rel="stylesheet" type="text/css" href="./assets/css/styles.css" />

<style>
	.ajax-loader {
		visibility: hidden;
		/* background-color: rgba(255, 255, 255, 0.7); */
		position: absolute;
		z-index: +100 !important;

		width: 100%;
		height: 100%;

	}

	.ajax-loader img {
		position: relative;
		top: 0;
		left: 36%;
		width: 30%;
	}

	/* .navbar-fixed-top,
        .navbar-fixed-bottom {
            position: fixed !important;
            padding-top: 5em !important;
        }
 */

	.btn:hover,
	.btn:focus {
		/* color: #000 !important; */
		outline: none;
	}

	.bs-actionsbox,
	.bs-donebutton,
	.bs-searchbox {
		width: 98% !important;
	}

	.dropdown-menu>li>a {

		color: #000 !important;

	}

	a {
		color: #000000;
		text-decoration: none !important;
	}

	a:focus,
	a:hover {
		color: #a70608;
		text-decoration: underline;
	}

	/* link header no line */
	.topnav a:hover {
		background-color: #87898b;
		color: black;
		text-decoration: none;
	}

	/* html,
	body {
		font-family: 'Sarabun', sans-serif;
		font-size: 14px;
	} */

	.modal {
		position: fixed;
		top: 10%;
		left: 50%;
		z-index: 1050;
		/* width: 560px; */
		/* margin-left: -280px; */
		/* background-color: #fff; */
		/* border: 1px solid #999; */
		/* border: 1px solid rgba(0,0,0,0.3); */
		width: 650px;
		background: none;
		box-shadow: none;
		border: 0px;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		border-radius: 6px;
		outline: none;
	}

	.font_size {
		font-size: 14px;
	}


	table thead {
		/* background: linear-gradient(to right, #e8ad2a, #8a4ec1); */
		background: linear-gradient(to right, #109a94, #785ad4);
		color: white;
	}


	.table>thead>tr>th:first-child {
		border-top-left-radius: 5px;
	}

	.table>thead>tr>th:last-child {
		border-top-right-radius: 5px;
	}

	.input_ {
		border: 1px solid #aaa !important;
		height: 40px !important;
		border-radius: 3px !important;
		padding: 5px !important;
		background-color: transparent !important;
		margin-left: 3px;
	}

	.my-swal {
		z-index: 9999999999;
	}

	/* Tooltip container */
	.tooltip {
		position: relative;
		display: inline-block;
		font-size: 14px;
		cursor: pointer;
		opacity: 1 !important;
	}

	.collapse {
		display: block;
	}

	.box {
		max-width: 600px;
		width: 100%;
		margin: 0 auto;
		;
	}

	table thead {
		/* background: linear-gradient(to right, #e8ad2a, #8a4ec1);  */
		background: linear-gradient(to right, #109a94, #785ad4);
		color: white;
	}

	/*----------------------- Preloader -----------------------*/
	body.preloader-site {
		overflow: hidden;
	}

	.preloader-wrapper {
		height: 100%;
		width: 100%;
		background: #FFF;
		position: fixed;
		top: 0;
		left: 0;
		z-index: 9999999;
		opacity: 0.9;
	}

	.preloader-wrapper .preloader {
		position: absolute;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
		/* width: 120px; */
	}

	/*  end preloader */

	.logout2 a {
		color: #000;
	}

	.logout2 a:hover {
		color: #686868;
		text-decoration: none;
	}

	.dt-buttons {
		padding-left: 10px !important;
		padding-bottom: 15px !important;
	}

	.card-header {
		box-shadow: none;
		background: none;
		border-radius: 0px;
		border-bottom: 0px;
	}

	.card {
		box-shadow: none;
		background: none;
		border-radius: 0px;
	}


</style>

<body <?php echo $OUTPUT->body_attributes(); ?>>

	<div class="preloader-wrapper">
		<div class="preloader">
			<img src="<?php echo $CFG->wwwroot ?>/local/lxtrainingrecords/assets/images/preloader.gif" alt="NILA">
		</div>
	</div>


	<!-- 	<div id="page-content" class="row-fluid">-->
	<div id="page-content" class="row-fluid" style="margin-top: 80px;"> 

		<div class="row-fluid">
			<!-- <section id="region-main" class="span8 pull-right"> -->
			<section id="region-main">

				<!-- แสดงเนื้อหา -->
				<main>

					 <div class="txt">
            <h3 align="center">Training records</h3>
          </div> 

					<div>
						<div class="btn-group" role="group" aria-label="Import data">
							<button type="button" class="btn btn-warning" onclick="javascript:window.location='<?php echo $CFG->wwwroot . "/local/lxtrainingrecords/"; ?>';">Import data</button>
							<button type="button" class="btn btn-light" onclick="javascript:window.location='<?php echo $CFG->wwwroot . "/local/lxtrainingrecords/report.php"; ?>';">Report</button>
						</div>

						<div style="float:right;">
							<button type="button" class="btn btn-link" onclick="javascript:window.location='<?php echo $CFG->wwwroot . "/local/lxtrainingrecords/example.csv"; ?>';"> <i class='fa fa-cloud-download'></i>&nbsp; Example csv file</button>
						</div>

					</div>
					<br />

					<!-- From button -->

					<!-- <p style="padding-top:15px"><i class='fa fa-refresh'></i> เชื่อมต่อ Compu : <input type="checkbox" name="check" value="1" class="lcs_check" autocomplete="off" /></p> -->

					<!-- Our markup, the important part here! -->
					<div id="drag-and-drop-zone" class="dm-uploader p-5" style="padding:30px;">
						<h3 class="mb-5 text-muted">Drag &amp; Drop CSV file here</h3>

						<button class="btn btn-success">
							<i class='fa fa-cloud-upload'></i>&nbsp; Upload CSV file
							<input type="file" title='Click to add Files' />
						</button>
						<br />
					</div>

					<!-- /uploader -->

					<div class="col-md-6 col-sm-8">
						<div class="card h-100">

							<div class="card-header">
								<!-- File List -->
							</div>

							<ul class="list-unstyled p-2 d-flex flex-column col" id="files">
								<li class="text-muted text-center empty">
									<!-- No files uploaded. -->
								</li>
							</ul>
						</div>
					</div>

					<!-- File item template -->
					<script type="text/html" id="files-template">
						<li class="media">
							<div class="media-body mb-1">
								<p class="mb-2">
									<strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
								</p>
								<div class="progress mb-2">
									<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;background-color:#8BC34A;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
									</div>
								</div>
							</div>
						</li>
					</script>

					<script src="./assets/js/jquery.dm-uploader.js"></script>
					<script src="./upload_ui.js"></script>
					<script src="./upload_config.js"></script>

					<?php
					if ($DB->count_records("local_lxtrainingrecords_temp") > 0) {
					?>
					<br/>
						<p style="float:right;"><button class="btn btn-primary" id="save"><i class='fa fa-save'></i>&nbsp; Save data to training records</button></p>
					<br/>
					<br/>
					<?php
					}
					?>

					<br />

					<br />

					<div class="table-responsive" style="width:100%;">
						<table class="table table-striped table-bordered" id="data-table">
							<thead>
								<tr>
									<th>#</th>
									<th>Company Code</th>
									<th>EmployeeID</th>
									<th>Prefix</th>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Position</th>
									<th>Section/Branch</th>
									<th>Department/Area</th>
									<th>Region</th>
									<th>Division</th>
									<th>Group</th>
									<th>Business Unit</th>
									<th>Email</th>
									<th>Level</th>
									<th>Cost Center</th>
									<th>Dep Code</th>
									<th>Methodology</th>
									<th>Channel</th>
									<th>Category Code</th>
									<th>Course Code</th>
									<th>Class No</th>
									<th>Description (Local)</th>
									<th>Description (Global)</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Training Hour</th>
									<th>Training Cost</th>
									<th>Evaluate Result</th>
									<th>Training Institute</th>
									<th>Training Location</th>
									<th>Timecreated</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>


					<main>

						<script>
							$(document).ready(function() {

								var dataTable = $('#data-table').DataTable({
										"processing": false,
										"serverSide": true,
										"order": [],
										"ajax": {
											url: "fetch_temp.php",
											type: "POST",
											// success: function(jsonData) {
											// 	console.log(jsonData);
											// }

											// complete: function() {
											//   // clear loading
											//   $('.preloader-wrapper').fadeOut();
											//   $('body').removeClass('preloader-site');pad
											// }
										},
										// dom: 'lBfrtip',

										// buttons: [{
										//   extend: 'excel',
										//   text: 'Export Excel <i class="fa fa-floppy-o" aria-hidden="true"></i>',
										//  title: 'Public training export'
										// }, ]
									}

								);


								// บันทึกข้อมูล
								$('#save').on('click', function() {

									// console.log('save');
									// console.log(token);

									$('.preloader-wrapper').fadeIn();
									$('body').addClass('preloader-site');

									// let courselmsid = $('#ddlViewBy').val();
									// let empid = $('#view-rows').text();
									// let companyid = $('#companyid').val();
									// // let empid = $('#view-rows').val();
									// let coursetypeid = $('#coursetypeid').val();
									// let courseid = $('#courseid').val();
									// let trainingno = $('#trainingno').val();

									$.ajax({
										// url: "post_data.php",
										url: "save_data.php",
										method: "POST",
										async: false,
										// dataType: 'json',
										// data: {
										//   token: token
										// },
										success: function(jsonData) {

											//console.log('data: ' + jsonData);

											$('.preloader-wrapper').fadeOut();
											$('body').removeClass('preloader-site');

											let val = JSON.parse(jsonData); // convert string to object
											// console.log('isValid: ' + val.isValid);
											//  console.log('ErrorMessage: ' + val.ErrorMessage);

											if (val.isValid == true) {
												const Toast = Swal.mixin({
													toast: true,
													position: 'top-end',
													showConfirmButton: false,
													timer: 1500,
													timerProgressBar: true,
													didOpen: (toast) => {
														toast.addEventListener('mouseenter', Swal.stopTimer)
														toast.addEventListener('mouseleave', Swal.resumeTimer)
													}
												})

												Toast.fire({
													icon: 'success',
													title: val.ErrorMessage,
													customClass: {
														container: 'my-swal'
													}
												}).then(() => {
													location.reload();
												});

											} else {

												$('.preloader-wrapper').fadeOut();
												$('body').removeClass('preloader-site');

												const Toast = Swal.mixin({
													toast: true,
													position: 'top-end',
													showConfirmButton: false,
													timer: 1500,
													timerProgressBar: true,
													didOpen: (toast) => {
														toast.addEventListener('mouseenter', Swal.stopTimer)
														toast.addEventListener('mouseleave', Swal.resumeTimer)
													}
												})

												Toast.fire({
													icon: 'error',
													title: val.ErrorMessage,
													customClass: {
														container: 'my-swal'
													}
												}).then(() => {
													location.reload();
												});

											}
										}

									}).fail(function(jqXHR, textStatus, error) {

										$('.preloader-wrapper').fadeOut();
										$('body').removeClass('preloader-site');

										//  console.log(error);

										const Toast = Swal.mixin({
											toast: true,
											position: 'top-end',
											showConfirmButton: false,
											timer: 1500,
											timerProgressBar: true,
											didOpen: (toast) => {
												toast.addEventListener('mouseenter', Swal.stopTimer)
												toast.addEventListener('mouseleave', Swal.resumeTimer)
											}
										})

										Toast.fire({
											icon: 'error',
											title: jqXHR.responseJSON.error,
											customClass: {
												container: 'my-swal'
											}
										}).then(() => {
											location.reload();
										});

									});
								});

							});
						</script>


						<script>
							/// preloading ///
							$(document).ready(function($) {
								var Body = $('body');
								Body.addClass('preloader-site');
							});
							$(window).load(function() {
								$('.preloader-wrapper').fadeOut();
								$('body').removeClass('preloader-site');
							});
						</script>

						<?php echo $OUTPUT->footer() ?>
			</section>

		</div>
	</div>

	</div>

</body>
