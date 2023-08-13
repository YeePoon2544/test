<!-- <link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" /> -->
<script type="text/javascript" src="assets/js/hr/site.js"></script>
<style>
	ul,
	#myUL {
		list-style-type: none;
	}

	#myUL {
		margin: 0;
		padding: 0;
	}

	.caret {
		cursor: pointer;
		-webkit-user-select: none;
		/* Safari 3.1+ */
		-moz-user-select: none;
		/* Firefox 2+ */
		-ms-user-select: none;
		/* IE 10+ */
		user-select: none;
	}

	.caret::before {
		/*content: "\002B";*/
		color: black;
		display: inline-block;
		margin-right: 6px;
	}

	.caret-down::before {
		/*content: "\002D"; */
		color: black;
		display: inline-block;
		margin-right: 6px;
	}

	.nested {
		display: none;
	}

	.active {
		display: block;
	}
</style>
<?php

if ($_SESSION['login'] != "TUlibrary") {
	header("location:login.php");
}

$emp_empid = $_SESSION["empid"];
?>
<div class="card card-custom">
	<div class="card-body">
		<div class="card-title">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label font-weight-bolder text-dark">สวัสดิการด้านสุขภาพ (6,000 บาท)</span><br>
				<span class="text-muted mt-1 font-weight-bold font-size-sm">หอสมุดแห่งมหาวิทยาลัยธรรมศาสตร์</span>
			</h3>
			<a href="?menu=แบบฟอร์มขอเบิกเงินสวัสดิการด้านสุขภาพ" class="btn btn-primary font-weight-bolder">
				<span class="svg-icon svg-icon-md">
					<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<rect x="0" y="0" width="24" height="24" />
							<circle fill="#000000" cx="9" cy="15" r="6" />
							<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
						</g>
					</svg>
				</span>ยื่นแบบฟอร์มขอเบิกเงินสวัสดิการด้านสุขภาพ</a>
		</div>
		<!--begin: Datatable-->


		<table class="table table-bordered table-hover table-checkable" id="kt_datatable_health" style="margin-top: 8px !important">
			<thead>
				<tr>
					<!-- <th style="text-align:center;">ลำดับ</th> -->
					<th style="text-align:center;">ปีงบประมาณ</th>
					<th style="text-align:center;">ชื่อ - นามสกุล</th>
					<th style="text-align:center;">วันที่ยืนเบิก</th>
					<!-- <th style="text-align:center;">ยอดรวม</th> -->
					<th style="text-align:center;">สถานะ</th>
					<?php if ($emp_empid == "58037" || $emp_empid == "55146") {
						echo "<th style='text-align:center;'>แก้ไขรายการ</th>";
					} ?>
					<th style="text-align:center;">รายละเอียดรายการเบิก</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include './condb.php';
				// $emp_empid = $_SESSION["empid"];


				if ($emp_empid == "58037") {
					$ContractQuery = "select * from mst_welfare ORDER BY mst_welfare.welfare_date DESC";
				} else if ($emp_empid == "55146" || $emp_empid == "57883" || $emp_empid == "80003") {
					$ContractQuery = "select * from mst_welfare where status IN ( 'in process ','in send') union all select * from mst_welfare where emp_empid = '" . $emp_empid . "'";
				} else {
					$ContractQuery = "select * from mst_welfare where emp_empid = '" . $emp_empid . "' ORDER BY mst_welfare.welfare_date DESC";
				}


				$ContractRecords = mysqli_query($conn, $ContractQuery);
				//$data = array();
				$i = 1;
				$y = date("Y");
				$y = $y + 543;

				while ($rowContract = mysqli_fetch_assoc($ContractRecords)) {

					$desc_head = "<div class='timeline timeline-5'><div class='timeline-items'>";
					$desc_end = "</div></div>";
					$desc_log2 = "";
					$sel_emp_empid = $rowContract['emp_empid'];
					$Sql_SelLog = "select * from log_transection where type = health and id = '" . $rowContract['welfare_id'] . "' ORDER BY no DESC ";
					$LogRecords = mysqli_query($conn, $Sql_SelLog);
					while ($RowLog = mysqli_fetch_assoc($LogRecords)) {

						if ($RowLog['status'] == "wait") {
							$icon = "flaticon2-pen";
							$status_item = "primary";
						} else if ($RowLog['status'] == "in process") {
							$icon = "flaticon2-hourglass-1";
							$status_item = "warning";
						} else if ($RowLog['status'] == "in send") {
							$icon = "flaticon2-layers";
							$status_item = "info";
						}


						if ($RowLog['remark'] != '') {
							$Rmark = "<a class='text-danger font-weight-bolder'>" . $RowLog['remark'] . "</a><br />โดย " . $RowLog['name'] . "</p></div></div>";
						} else {
							$Rmark = "โดย " . $RowLog['name'] . "</p></div></div>";
						}

						$desc_log = "<div class='timeline-item'><div class='timeline-media bg-light-" . $status_item . "'><i class='" . $icon . " text-" . $status_item . " icon-md'></i></div><div class='timeline-desc timeline-desc-light-" . $status_item . "'><span class='font-weight-bolder text-" . $status_item . "'>" . thai_date($RowLog['tran_date']) . date(" H:i:s", strtotime($RowLog['tran_date'])) . " น.</span><p class='font-weight-normal text-dark-50 pb-2'>" . $RowLog['description'] . "<br />สถานะ <a class='text-" . $status_item . " font-weight-bolder'>" . $RowLog['status'] . "</a><br />" . $Rmark;


						$desc_log2 = $desc_log2 . $desc_log;
					}

					$desc_log2 = $desc_head . $desc_log2 . $desc_end;
				?>

					<tr>
						<!-- <td style="text-align:center; width:1%;"><?= $i ?></td>  -->
						<td style="text-align:center; width:3%;">
							<span class="label label-lg font-weight-bold label-light-<?php if ($rowContract['bug_year'] == $y) {
																							echo "success";
																						} else {
																							echo "primary";
																						} ?> label-inline p-6"><?= $rowContract['bug_year'] ?></span>
						</td>

						<td style="width:15%;">
							<div class="d-flex align-items-center">
								<div class="ml-4">
									<div class="text-dark-75 font-weight-bolder font-size-lg mb-0"> <?= $rowContract['thai_name'] ?> </div>
									<!-- <div class="text-muted font-weight-bold"><?= $rowContract['suborgname'] ?></div> -->
									<div class="text-muted font-weight-bold font-size-lg">ยอดรวม ฿<?= number_format($rowContract['total'], 2) ?></div>
								</div>
							</div>
						</td>

						<td style="text-align:center; width:9%;"><?= thai_date($rowContract['welfare_date']); ?></td>
						<td style="text-align:center; width:7%;">
							<?php if ($rowContract['status'] == 'wait') {
								$alert = "primary";
							} else if ($rowContract['status'] == 'unapproved') {
								$alert = "danger";
							} else if ($rowContract['status'] == 'approved') {
								$alert = "success";
							} else if ($rowContract['status'] == 'in process') {
								$alert = "warning";
							} else if ($rowContract['status'] == 'in send') {
								$alert = "info";
							} ?>
							<span class="font-weight-bold text-<?= $alert; ?>"><?= $rowContract['status'] ?></span>
							<a tabindex="0" class="btn-icon btn-light-success pulse pulse-warning p-1" role="button" data-toggle="popover" data-trigger="click" title="การอัพเดทข้อมูล" data-content="<?= $desc_log2; ?>" data-html="true">
								<i class="flaticon2-tag text-<?= $alert; ?>"></i>
							</a>
						</td>

						<?php if ($emp_empid == "58037" || $emp_empid == "55146" || $emp_empid == "57883" || $emp_empid == "80003") { ?>
							<td style="text-align:center; width:10%;">
								<?php
								if (($emp_empid == "58037" && $rowContract['status'] == 'wait') || (($emp_empid == "55146" || $emp_empid == "57883" || $emp_empid == "80003") && ($rowContract['status'] == 'in process' || $rowContract['status'] == 'in send'))) {
								?>
									<!-- <td class="pr-0 text-right"> -->
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<form method="post">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">เปลี่ยนสถานะ</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<i aria-hidden="true" class="ki ki-close"></i>
														</button>
													</div>
													<div class="modal-body">
														<input type="hidden" name="STno" id="STno">
														<select class="custom-select col-lg-4 " name="ST2" id="ST2">
															<option value="wait">wait</option>
															<option value="in process">in process</option>
															<?php if ($emp_empid == "55146" || $emp_empid == "57883" || $emp_empid == "80003") { ?>
																<option value="in send">in send</option>
															<?php } ?>
														</select><br><br>

														<label for="exampleTextarea">หมายเหตุ</label>
														<textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">ปิด</button>
														<button type="submit" class="btn btn-primary font-weight-bold">บันทึก</button>
													</div>
												</div>
											</form>
										</div>
									</div>

									<button type="button" class="edit-status btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-no="<?= $rowContract['welfare_id']; ?>" data-st="<?= $rowContract['status']; ?>" data-remark="<?= $rowContract['remark']; ?>" title="สถานะ">
										<span class="svg-icon svg-icon-md svg-icon-primary">
											<!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
													<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</button>

									<script type="text/javascript">
										$(document).ready(function() {
											$('.edit-status').click(function() {

												var STno = $(this).attr('data-no');
												var ST = $(this).attr('data-st');
												var Remark = $(this).attr('data-remark');

												$('#STno').val(STno);
												document.getElementById("remark").value = Remark;
												document.getElementById("ST2").value = ST;

												//$('#formStatus').modal('show');
											});
										});
										// check ซ้ำ กด refresh
										if (window.history.replaceState) {
											window.history.replaceState(null, null, window.location.href);
										}
									</script>


									<?php if ($emp_empid == "58037") { ?>
										<a href="?menu=แก้ไขเบิกเงินสวัสดิการด้านสุขภาพ&id=<?= $rowContract['welfare_id'] ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm " title="แก้ไข">
											<span class="svg-icon svg-icon-md svg-icon-primary">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"></rect>
														<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
														<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</a>

										<!-- 																				<a href="?menu=PrintHealth&id=<?= $rowContract['welfare_id'] ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm " title="ปริ้น">
																					<span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																					    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					        <rect x="0" y="0" width="24" height="24"/>
																					        <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/>
																					        <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>
																					    </g>
																					</svg></span>
																				</a> -->

										<button type="button" class="DeleteHealth btn btn-icon btn-light btn-hover-primary btn-sm" data-del-no="<?= $rowContract['welfare_id']; ?>" data-id="<?= $rowContract['emp_empid']; ?>" title="ลบ">
											<span class="svg-icon svg-icon-md svg-icon-primary">
												<!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"></rect>
														<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
														<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span></button>

										<script type="text/javascript">
											$(document).ready(function() {
												$('.DeleteHealth').click(function() {
													var id_del_no = $(this).attr('data-del-no');
													var id = $(this).attr('data-id');

													Swal.fire({
														title: 'ยืนยันการลบข้อมูล',
														icon: 'warning',
														showCancelButton: true,
														cancelButtonText: 'ยกเลิก',
														confirmButtonText: 'ลบข้อมูล'
													}).then(function(result) {
														if (result.value) {
															window.location.href = "index.php?menu=DelHealth&id_del_no=" + id_del_no + "&id=" + id;
															Swal.fire(
																'Deleted!',
																'Your file has been deleted.',
																'success'
															)
														}
													});
												});
											});
										</script>
								<?php }
								} else {
									echo "<button type='button' class='btn btn-light'>ไม่อนุญาติ</button>";
								} ?>
							</td>
						<?php	}	?>

						<?php if ($emp_empid == "58037") {
							echo "<td style='width:28%;'>";
						} else {
							echo  "<td style='width:39%;'>";
						} ?>
						<div class="accordion  accordion-toggle-arrow" id="accordionExample4">
							<div class="card">
								<div class="card-header" id="headingOne<?= $i; ?>">
									<div class="card-title collapsed text-hover-primary" data-toggle="collapse" data-target="#collapseOne<?= $i; ?>">
										<i class="flaticon2-layers-1"></i> รายละเอียดรายการเบิก
									</div>
								</div>
								<div id="collapseOne<?= $i; ?>" class="collapse" data-parent="#accordionExample4">
									<div class="card-body">

										<div class="card card-custom gutter-b card-stretch">
											<!--begin::Body-->
											<div class="card-body pt-1">
												<!--begin::Info-->
												<div class="mb-0">
													<?php
													$SQLWelfare = "select * from detail_welfare where welfare_id = '" . $rowContract['welfare_id'] . "' ORDER BY welfare_line ASC";
													$WelfareRecords = mysqli_query($conn, $SQLWelfare);

													while ($RowWelfare = mysqli_fetch_assoc($WelfareRecords)) {

													?>
														<div class="d-flex align-items-left">
															<div class="ml-1">
																<div class="d-flex justify-content-between align-items-left flex-column">

																</div>
															</div>
															<div class="ml-4">
																<div class="d-flex justify-content-between align-items-left flex-column mb-7">
																	<span class="text-dark-75 font-weight-bolder"><?= $RowWelfare['welfare_line'] ?>. เบิกค่ารักษาของ <?= $RowWelfare['type_name'] ?> ชื่อ <?= $RowWelfare['name'] ?> เลขบัตรประชาชน <?= $RowWelfare['id_card'] ?></span>
																	<span class="text-muted font-weight-bolder">ป่วยเป็นโรค <?= $RowWelfare['sick'] ?> รักษาพยาบาลจาก <?= $RowWelfare['host'] ?> ซึ่งเป็นสถานพยาบาลของ <?= $RowWelfare['host_type'] ?></span>
																	<span class="text-muted font-weight-bolder">ตั้งแต่วันที่ <?= thai_date($RowWelfare['start_date']); ?> ถึงวันที่ <?= thai_date($RowWelfare['end_date']); ?></span>
																	<span class="text-muted font-weight-bolder font-size-sm">เป็นเงินทั้งสิ้น <span class="text-primary font-weight-bold font-size-lg">฿<?= number_format($RowWelfare['money'], 2) ?>

																			<?php if ($emp_empid == "58037") {  ?>
																				<a href="?menu=PrintHealth&id=<?= $rowContract['welfare_id'] ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm " title="ปริ้น">
																					<span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																								<rect x="0" y="0" width="24" height="24" />
																								<path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000" />
																								<rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1" />
																							</g>
																						</svg></span>
																				</a>
																			<?php } ?>
																		</span></span>

																	<?php
																	if ($RowWelfare['welfare_file1'] != "") {
																	?>
																		<ul id="myUL">
																			<li><span class="caret"><i class="flaticon-attachment text-warning"></i> เอกสารแนบ</span>
																				<ul class="nested">
																					<form action="WelfareView.php" method="post" target="_blank">
																						<input type="hidden" id="FileWelfare" name="FileWelfare" value="<?= $RowWelfare['welfare_file1'] ?>">
																						<li>&#9679;<button type="submit" class="btn"><i class="far fa-file-pdf text-danger"></i>File 1</button></li>
																					</form>
																					<?php if ($RowWelfare['welfare_file2'] != "") { ?>
																						<form action="WelfareView.php" method="post" target="_blank">
																							<input type="hidden" id="FileWelfare" name="FileWelfare" value="<?= $RowWelfare['welfare_file2'] ?>">
																							<li>&#9679;<button type="submit" class="btn"><i class="far fa-file-pdf text-danger"></i>File 2</button></li>
																						</form>
																					<?php } ?>
																					<?php if ($RowWelfare['welfare_file3'] != "") { ?>
																						<form action="WelfareView.php" method="post" target="_blank">
																							<input type="hidden" id="FileWelfare" name="FileWelfare" value="<?= $RowWelfare['welfare_file3'] ?>">
																							<li>&#9679;<button type="submit" class="btn"><i class="far fa-file-pdf text-danger"></i>File 3</button></li>
																						</form>
																					<?php } ?>
																			</li>
																		</ul>
																	<?php } ?>


																</div>
															</div>
														</div>




													<?php } ?>
												</div>
												<!--end::Info-->
											</div>
											<!--end::Body-->
										</div>


									</div>
								</div>
							</div>
						</div>
						</td>
					</tr>
				<?php $i++;
				} ?>
			</tbody>
		</table>
		<!--end: Datatable-->

	</div>
</div>

<script>
	var toggler = document.getElementsByClassName("caret");
	var i;

	for (i = 0; i < toggler.length; i++) {
		toggler[i].addEventListener("click", function() {
			this.parentElement.querySelector(".nested").classList.toggle("active");
			this.classList.toggle("caret-down");
		});
	}
</script>
<?php
$STno = NULL;

if (isset($_POST['STno'])) {
	$STno = $_POST['STno'];
	$ST2 = $_POST['ST2'];
	$Remark = $_POST['remark'];
	$NowDate = date("Ymdhis");

	$SQLUpdate = "UPDATE mst_welfare SET status = '" . $_POST['ST2'] . "',`remark` = '" . $Remark . "' WHERE welfare_id = " . $STno;
	if ($conn->query($SQLUpdate) === TRUE) {

		$Sql_Log = "INSERT INTO log_transection (`type`, `id`, `emp_empid`, `description`, `tran_date`, `status`, `name`, `remark`) 
			        VALUES ('health','" . $STno . "','" . $sel_emp_empid . "','" . 'เปลี่ยนสถานะ' . "','" . $NowDate . "','" . $ST2 . "','" . $_SESSION["name"] . "','" . $Remark . "') ";
		$Result_Log = mysqli_query($conn, $Sql_Log);

		echo  '<script>$(document).ready(function(e) { Swal.fire({ title: "บันทึกสถานะเรียบร้อย", icon: "success", showConfirmButton: false, confirmButtonText: " ตกลง ",timer: 1500 }).then(function() {KTUtil.scrollTop(); window.location = "index.php?menu=สวัสดิการด้านสุขภาพ"}); }); </script>';
	} else {
		echo '<script type="text/javascript">
							     swal("ไม่สามารถแก้ไขายการได้", "", "warning");
							     setTimeout("window.history.go(-1)",2500);
							     </script>';
		exit();
	}
}

?>