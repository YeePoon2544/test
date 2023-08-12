<?php
include 'header.php';

function thai($bbb)
{
	$y3 = substr($bbb, 0, 4);
	$m2 = substr($bbb, 5, 2);
	$d2 = substr($bbb, 8, 2);
	$h2 = substr($bbb, 10, 6);
	$y4 = $y3 + "543";

	if ($m2 == "01") {
		$m2 = "มกราคม";
	}
	if ($m2 == "02") {
		$m2 = "กุมภาพันธ์";
	}
	if ($m2 == "03") {
		$m2 = "มีนาคม";
	}
	if ($m2 == "04") {
		$m2 = "เมษายน";
	}
	if ($m2 == "05") {
		$m2 = "พฤษภาคม";
	}
	if ($m2 == "06") {
		$m2 = "มิถุนายน";
	}
	if ($m2 == "07") {
		$m2 = "กรกฎาคม";
	}
	if ($m2 == "08") {
		$m2 = "สิงหาคม";
	}
	if ($m2 == "09") {
		$m2 = "กันยายน";
	}
	if ($m2 == "10") {
		$m2 = "ตุลาคม";
	}
	if ($m2 == "11") {
		$m2 = "พฤศจิกายน";
	}
	if ($m2 == "12") {
		$m2 = "ธันวาคม";
	}

	if ($d2 == "01") {
		$d2 = "1";
	}
	if ($d2 == "02") {
		$d2 = "2";
	}
	if ($d2 == "03") {
		$d2 = "3";
	}
	if ($d2 == "04") {
		$d2 = "4";
	}
	if ($d2 == "05") {
		$d2 = "5";
	}
	if ($d2 == "06") {
		$d2 = "6";
	}
	if ($d2 == "07") {
		$d2 = "7";
	}
	if ($d2 == "08") {
		$d2 = "8";
	}
	if ($d2 == "09") {
		$d2 = "9";
	}
	if ($bbb == "") {
		return "";
	} else {
		//return $y1 . "-" . $m1 . "-" . $d1. "" . $h1;
		return $d2 . "&nbsp;" . $m2 . "&nbsp;" . $y4 . "&nbsp" . $h2;
	}
}
?>
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed page-loading">
	<!--begin::Main-->
	<!--begin::Header Mobile-->
	<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
		<!--begin::Logo-->
		<a href="index.php">
			<h2 class="text-white font-size-h2 font-weight-bold">TULIB HR</h2>
		</a>
		<!--end::Logo-->
		<!--begin::Toolbar-->
		<div class="d-flex align-items-center">
			<!--begin::Aside Mobile Toggle-->
			<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
				<span></span>
			</button>
			<!--end::Aside Mobile Toggle-->
			<!--begin::Header Menu Mobile Toggle-->
			<!-- 				<button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button> -->
			<!--end::Header Menu Mobile Toggle-->
			<!--begin::Topbar Mobile Toggle-->
			<!-- 				<button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
					</span>
				</button> -->
			<!--end::Topbar Mobile Toggle-->
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header Mobile-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<!--begin::Aside-->
			<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside" style="background-color:#266dbf;">
				<!--begin::Brand-->
				<div class="brand flex-column-auto" id="kt_brand" style="background-color:#266dbf;">
					<!--begin::Logo-->
					<!-- 						<a href="index.php" class="brand-logo">
							<img alt="Logo" class="w-70px" src="assets/media/logos/TULIB.png" />
						</a> -->
					<div id="kt_header_menu" class="header-menu align-items-center header-menu-mobile header-menu-layout-default header-menu-root-arrow">
						<h2 class="text-white font-size-h2 font-weight-bold">TULIB HR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
					</div>

					<!--end::Logo-->
				</div>
				<!--end::Brand-->
				<?php if ($_SESSION['menu'] == "admin-TUlibrary") { ?>
					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
						<!--begin::Menu Container-->
						<div id="kt_aside_menu" class="aside-menu my-4 aside-menu-dropdown" style="background-color:#266dbf;" data-menu-vertical="1" data-menu-dropdown="1" data-menu-scroll="0" data-menu-dropdown-timeout="500">
							<!--begin::Menu Nav-->
							<ul class="menu-nav">
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="index.php" class="menu-link">
										<i class="fas fa-home text-white icon-xl"></i>
										<span class="menu-text text-white">Home</span>
									</a>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon fas fa-book text-white icon-xl"></i>
										<span class="menu-text text-white">บุคลากร</span>
										<i class="menu-arrow text-white"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<!-- 											<li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text text-white">บุคลากร</span>
												</span>
											</li> -->
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=รายชื่อบุคลากร" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">รายชื่อบุคลากร</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=ประวัติการรับเครื่องราชอิสริยาภรณ์" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">ประวัติการรับเครื่องราชอิสริยาภรณ์</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=ประวัติสัญญาการจ้างงาน" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">ประวัติสัญญาการจ้างงาน</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<i class="menu-icon fas fa-file-alt text-white icon-xl"></i>
										<span class="menu-text text-white">สวัสดิการ</span>
										<i class="menu-arrow text-white"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<!-- 											<li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text text-white">รายงาน</span>
												</span>
											</li> -->
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=สวัสดิการด้านสุขภาพ" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">สวัสดิการด้านสุขภาพ (6,000 บาท)</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=แบบฟอร์มขอเบิกเงินสวัสดิการค่าแว่นสายตา" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">สวัสดิการค่าแว่นสายตา</span>
												</a>
											</li>
										</ul>
									</div>
								</li>

								<?php if ($_SESSION["empid"] == "56360") { ?>
									<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
										<a href="javascript:;" class="menu-link menu-toggle">
											<i class="menu-icon fas fa-file-alt text-white icon-xl"></i>
											<span class="menu-text text-white">&nbsp;&nbsp;&nbsp;อนุมัติสวัสดิการ</span>
											<i class="menu-arrow text-white"></i>
										</a>
										<div class="menu-submenu">
											<i class="menu-arrow"></i>
											<ul class="menu-subnav">
												<li class="menu-item" aria-haspopup="true">
													<a href="?menu=อนุมัติสวัสดิการด้านสุขภาพ" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">สวัสดิการด้านสุขภาพ (6,000 บาท)</span>
													</a>
												</li>

											</ul>
										</div>
									</li><br>
								<?php } ?>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;">
										<span class="menu-text text-white"><i class="flaticon-stopwatch text-white icon-xl"></i>&nbsp;&nbsp;ลงเวลางาน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><i class="fas fa-chevron-right text-white"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=รายการลงเวลาเข้างาน" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">เข้าออกงาน</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=รายการลงชื่อในหน่วยงาน" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">ลงชื่อในหน่วย</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=รายการวันWFH" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">วัน WFH คนในหน่วย</span>
												</a>
											</li>
										</ul>
									</div>
								</li><br>

								<?php if ($_SESSION["empid"] == "80002" || $_SESSION["empid"] == "64753") { ?>
									<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
										<a href="javascript:;">
											<span class="menu-text text-white"><i class="flaticon-presentation-1 text-white icon-xl"></i>&nbsp;&nbsp;ชั่วโมงอบรม&nbsp;&nbsp;&nbsp;&nbsp;</span><i class="fas fa-chevron-right text-white"></i>
										</a>
										<div class="menu-submenu">
											<i class="menu-arrow"></i>
											<ul class="menu-subnav">
												<li class="menu-item" aria-haspopup="true">
													<a href="?menu=Training" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">แผนอบรมประจำปี</span>
													</a>
												</li>
												<li class="menu-item" aria-haspopup="true">
													<a href="?menu=TrainingOut" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">รายการชั่วโมงอบรม</span>
													</a>
												</li>
												<!--  											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=รายการวันWFH" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">วัน WFH คนในหน่วย</span>
												</a>
											</li> -->
											</ul>
										</div>
									</li>
								<?php } ?>




							</ul>
							<!--end::Menu Nav-->
						</div>
						<!--end::Menu Container-->
					</div><br>


				<?php } else { ?>
					<!--begin::Aside Menu User-->
					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
						<!--begin::Menu Container-->
						<div id="kt_aside_menu" class="aside-menu my-4 aside-menu-dropdown" style="background-color:#266dbf;" data-menu-vertical="1" data-menu-dropdown="1" data-menu-scroll="0" data-menu-dropdown-timeout="500">
							<!--begin::Menu Nav-->
							<ul class="menu-nav">
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="?menu=home">
										&nbsp;&nbsp;<i class="fas fa-home text-white icon-xl"></i>
										<span class="menu-text text-white">&nbsp;หน้าหลัก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									</a>
								</li><br>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="?menu=ประวัติส่วนตัว">
										<i class="fas fa-book text-white icon-xl"></i><span class="menu-text text-white">&nbsp;&nbsp;ประวัติส่วนตัว&nbsp;&nbsp;&nbsp;</span>
									</a>
								</li><br>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="?menu=สัญญาจ้าง">
										<i class="flaticon2-contract text-white icon-xl"></i>
										<span class="menu-text text-white">สัญญาจ้าง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									</a>
								</li><br>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;">
										<span class="menu-text text-white"><i class="menu-icon fas fa-file-alt text-white icon-xl"></i>&nbsp;&nbsp;&nbsp;สวัสดิการ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><i class="fas fa-chevron-right text-white"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=สวัสดิการด้านสุขภาพ" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">สวัสดิการด้านสุขภาพ (6,000 บาท)</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=สวัสดิการค่าแว่นสายตา" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">สวัสดิการค่าแว่นสายตา</span>
												</a>
											</li>
										</ul>
									</div>
								</li><br>


								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;">
										<span class="menu-text text-white"><i class="flaticon-stopwatch text-white icon-xl"></i>&nbsp;&nbsp;ลงเวลางาน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><i class="fas fa-chevron-right text-white"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=รายการลงเวลาเข้างาน" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">เข้าออกงาน</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=รายการลงชื่อในหน่วยงาน" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">ลงชื่อในหน่วย</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=รายการวันWFH" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">วัน WFH คนในหน่วย</span>
												</a>
											</li>
										</ul>
									</div>
								</li><br>

								<?php if ($_SESSION["empid"] == "80002" || $_SESSION["empid"] == "64753") { ?>
									<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
										<a href="javascript:;">
											<span class="menu-text text-white"><i class="flaticon-presentation-1 text-white icon-xl"></i>&nbsp;&nbsp;ชั่วโมงอบรม&nbsp;&nbsp;&nbsp;&nbsp;</span><i class="fas fa-chevron-right text-white"></i>
										</a>
										<div class="menu-submenu">
											<i class="menu-arrow"></i>
											<ul class="menu-subnav">
												<li class="menu-item" aria-haspopup="true">
													<a href="?menu=Training" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">แผนอบรมประจำปี</span>
													</a>
												</li>
												<li class="menu-item" aria-haspopup="true">
													<a href="?menu=TrainingOut" class="menu-link">
														<i class="menu-bullet menu-bullet-dot">
															<span></span>
														</i>
														<span class="menu-text">รายการชั่วโมงอบรม</span>
													</a>
												</li>
												<!--  											<li class="menu-item" aria-haspopup="true">
												<a href="?menu=รายการวันWFH" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">วัน WFH คนในหน่วย</span>
												</a>
											</li> -->
											</ul>
										</div>
									</li>
								<?php } ?>




								<!-- 								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="?menu=รายการลงเวลาเข้างาน">
										<i class="flaticon-stopwatch text-white icon-xl"></i>
										<span class="menu-text text-white">&nbsp;&nbsp;เข้าออกงาน</span>
									</a>
								</li>	

								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="?menu=รายการลงชื่อในหน่วยงาน">
										<i class="flaticon-stopwatch text-white icon-xl"></i>
										<span class="menu-text text-white">&nbsp;&nbsp;ลงชื่อในหน่วย</span>
									</a>
								</li>


								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="?menu=รายการวันWFH">
										<i class="flaticon-stopwatch text-white icon-xl"></i>
										<span class="menu-text text-white">&nbsp;&nbsp;วัน WFH คนในหน่วย</span>
									</a>
								</li> -->
							</ul>
							<!--end::Menu Nav-->
						</div>
						<!--end::Menu Container-->
					</div>
				<?php } ?>
				<!--end::Aside Menu-->
			</div>
			<!--end::Aside-->
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header header-fixed">
					<!--begin::Container-->
					<div class="container-fluid d-flex align-items-stretch justify-content-between" style="background-color:#266dbf;">
						<!--begin::Header Menu Wrapper-->
						<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
							<!--begin::Header Menu-->

							<!--end::Header Menu-->
						</div>
						<!--end::Header Menu Wrapper-->
						<!--begin::Topbar-->
						<div class="topbar">
							<!--end::Languages-->
							<!--begin::User-->
							<div class="topbar-item">
								<span class="text-white font-weight-bold font-size-base d-none d-md-inline mr-1">Hello,</span>
								<span class="text-white font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= $_SESSION["name"]; ?></span>
								<div class="symbol symbol-30 symbol-lg-40 symbol-circle mr-3">
									<img src="picture/<?= $_SESSION['pic'] . '.jpg' ?>" alt="Pic">
								</div>

								<?php if ($_SESSION['menu'] == "admin-TUlibrary") { ?>
									<a href="login_admin.php"> <?php } else { ?> <a href="login.php"> <?php } ?>
										<span class="text-white font-weight-bold font-size-base d-none d-md-inline"> Logout</span>
										</a>
							</div>
							<!--end::User-->
						</div>
						<!--end::Topbar-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Header-->
				<!--begin::Entry-->

				<div class="container-fluid">
					<?php
					include $src_page;
					?>
				</div>


				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		<!--begin::Footer-->
		<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
			<!--begin::Container-->
			<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
				<!--begin::Copyright-->

				<span class="text-muted font-weight-bold mr-2"></span>
				<span class="text-muted">2021 © Thammasat University Library</span>

			</div>
			<!--end::Container-->
		</div>
		<!--end::Footer-->
	</div>
	<script>
		var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
	</script>
	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1400
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#3699FF",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#E4E6EF",
						"dark": "#181C32"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#E1F0FF",
						"secondary": "#EBEDF3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#3F4254",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#EBEDF3",
					"gray-300": "#E4E6EF",
					"gray-400": "#D1D3E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#7E8299",
					"gray-700": "#5E6278",
					"gray-800": "#3F4254",
					"gray-900": "#181C32"
				}
			},
			"font-family": "Poppins"
		};
	</script>
	<!--end::Global Config-->
	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--end::Global Theme Bundle-->

	<!--begin::Page Vendors(used by this page)-->
	<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<script src="assets/js/pages/crud/file-upload/image-input.js"></script>

	<!--begin::Page Vendors(used by this page)-->
	<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
	<!--end::Page Vendors-->
	<!--begin::Page Scripts(used by this page)-->
	<script src="assets/js/pages/widgets.js"></script>
	<!-- <script src="assets/js/hr/person.js"></script> -->
	<!-- <script src="assets/js/hr/contract.js"></script> -->
	<!--end::Page Scripts-->

	<!--end::Page Vendors-->
	<!--begin::Page Scripts(used by this page)-->
	<script src="assets/js/hr/insignia.js"></script>
	<script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
	<script src="assets/js/pages/features/miscellaneous/sweetalert2.js"></script>
	<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js"></script>
	<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js"></script>
	<script src="assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js"></script>
	<!-- <script src="assets/js/pages/crud/ktdatatable/base/reg-table.js"></script> -->
</body>
<!--end::Body-->

</html>