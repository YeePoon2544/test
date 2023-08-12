<!-- <link href="assets/plugins/custom/jstree/jstree.bundle.css" rel="stylesheet" type="text/css" /> -->
<?php

if ($_SESSION['empid'] != "56360") {
	header("location:login_admin.php");
}
?>
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
$emp_empid = $_SESSION["empid"];
?>
<div class="card card-custom">
	<div class="card-body">
		<div class="card-title">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label font-weight-bolder text-dark">อนุมัติสวัสดิการด้านสุขภาพ (6,000 บาท)</span><br>
				<span class="text-muted mt-1 font-weight-bold font-size-sm">หอสมุดแห่งมหาวิทยาลัยธรรมศาสตร์</span>
			</h3>
		</div>
		<!--begin: Datatable-->


		<table class="table table-bordered table-hover table-checkable" id="kt_datatable_AppHealth" style="margin-top: 8px !important">
			<thead>
				<tr>
					<!-- <th style="text-align:center;">ลำดับ</th> -->
					<th style="text-align:center;">ปีงบประมาณ</th>
					<th style="text-align:center;">ชื่อ - นามสกุล</th>
					<th style="text-align:center;">วันที่ยืนเบิก</th>
					<!-- <th style="text-align:center;">ยอดรวม</th> -->
					<th style="text-align:center;">สถานะ</th>
					<th style='text-align:center;'>อนุมัติรายการ</th>
					<th style="text-align:center;">รายละเอียดรายการเบิก</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include './condb.php';

				$ContractQuery = "select * from mst_welfare where welfare_type = health and status IN ( 'in send') ORDER BY mst_welfare.welfare_date ASC";
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
					$Sql_SelLog = "select * from log_transection where type = health and id = '" . $rowContract['welfare_id'] . "' ORDER BY no asc ";
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
						} else if ($RowLog['status'] == "approve") {
							$icon = "flaticon2-writing";
							$status_item = "success";
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
							} else if ($rowContract['status'] == 'unapprove') {
								$alert = "danger";
							} else if ($rowContract['status'] == 'approve') {
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

						<?php if ($emp_empid == "56360") { ?>
							<td style="text-align:center; width:10%;">
								<?php
								if (($emp_empid == "56360" || $rowContract['status'] == 'in send' || $rowContract['status'] == 'approve' || $rowContract['status'] == 'unapprove')) {
								?>
									<!-- <td class="pr-0 text-right"> -->
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<form method="post">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">อนุมัติรายการ</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<i aria-hidden="true" class="ki ki-close"></i>
														</button>
													</div>
													<div class="modal-body">
														<input type="hidden" name="STno" id="STno">

														<!-- <input type="date" name="DateApp" id="DateApp" placeholder="Select date"/> -->
														<div class="col-lg-8 col-md-4 col-sm-4">
															<div class="input-group date">
																<input type="date" class="form-control mr-5" value="<?php echo date('Y-m-d'); ?>" name="DateApp" id="DateApp" />
																<select class="custom-select col-lg-4 " name="ST2" id="ST2">
																	<option value="in send">in send</option>
																	<?php if ($emp_empid == "56360") { ?>
																		<option value="approve">approve</option>
																		<option value="unapprove">unapprove</option>
																	<?php } ?>
																</select>
															</div>
														</div><br>
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

								<?php } else {
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
	$DateApp = $_POST['DateApp'];
	$DateApp = date("Y-m-d", strtotime($DateApp));
	$Remark = $_POST['remark'];
	$Time = date("H:i:s");
	$NowDate = $DateApp . " " . $Time;

	$SQLUpdate = "UPDATE `mst_welfare` SET `status` = '" . $_POST['ST2'] . "',`remark` = '" . $Remark . "' WHERE `welfare_id` = " . $STno;
	if ($conn->query($SQLUpdate) === TRUE) {
		$SQLPer = "select * from `mst_welfare` where `welfare_id` = '" . $STno . "' ";
		$PerRecords = mysqli_query($conn, $SQLPer);
		if (mysqli_num_rows($PerRecords) > 0) {
			$rowPer = mysqli_fetch_assoc($PerRecords);
			$Thai_Name = $rowPer["thai_name"];
			$log_emp_empid = $rowPer["emp_empid"];
		}

		//Send Line
		if ($ST2 == "approve" || $ST2 == "unapprove") {

			$SQLToken = "select * from `person` where `emp_empid` = '" . $log_emp_empid . "' ";
			$TokenRecords = mysqli_query($conn, $SQLToken);
			while ($rowToken = mysqli_fetch_assoc($TokenRecords)) {
				$Token = $rowToken["Token"];
				//$Thai_Name = $rowToken["thai_name"];      
				if ($Token != "") {
					if ($ST2 == "approve") {
						$STName = "อนุมัติแล้ว ยอดเงินจะโอนเข้าบัญชีประมาณ 7-10 วันค่ะ";
					} else if ($ST2 == "unapprove") {
						$STName = "ไม่อนุมัติค่ะ";
					}

					$lineapi = array($Token, "1eDaUnzR0cHT8tMY1heODtOAbVpvkTkCNLWg9ASktHx");
				}
				$mms = "แจ้งผลการอนุมัติสวัสดิการด้านสุขภาพ (6,000 บาท) \n คุณ" . $Thai_Name . "\n " . $STName;
				$x = 0;
				while ($x <= 1) {
					$chOne = curl_init();
					curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
					// SSL USE 
					curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
					//POST 
					curl_setopt($chOne, CURLOPT_POST, 1);
					// Message 
					curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");
					// follow redirects 
					curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
					// $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
					$headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi[$x] . '',);
					curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($chOne);
					if (curl_error($chOne)) {
						echo 'error:' . curl_error($chOne);
					} else {
						$result_ = json_decode($result, true);
					}
					curl_close($chOne);

					$x++;
				}
			}
		}

		$Sql_Log = "INSERT INTO `log_transection` (`type`, `id`, `emp_empid`, `description`, `tran_date`, `status`, `name`, `remark`) 
			        VALUES ('health','" . $STno . "','" . $log_emp_empid . "','" . 'อนุมัติรายการ' . "','" . $NowDate . "','" . $ST2 . "','" . $_SESSION["name"] . "','" . $Remark . "') ";
		$Result_Log = mysqli_query($conn, $Sql_Log);

		echo  '<script>$(document).ready(function(e) { Swal.fire({ title: "ทำรายการเรียบร้อย", icon: "success", showConfirmButton: false, confirmButtonText: " ตกลง ",timer: 1500 }).then(function() {KTUtil.scrollTop(); window.location = "index.php?menu=อนุมัติสวัสดิการด้านสุขภาพ"}); }); </script>';
	} else {
		echo '<script type="text/javascript">
							     swal("ไม่สามารถแก้ไขายการได้", "", "warning");
							     setTimeout("window.history.go(-1)",2500);
							     </script>';
		exit();
	}
}

?>