<?php 
	include('../../config/db.php');
	include('../site/header.php');
	include('../site/function.php');
	#echo $_GET["vn"];
	
	$sql_hosName ="select pt.cid,pt.hn,concat(pt.pname,pt.fname,' ',pt.lname) as Name
			,type.name as pttype,vs.vstdate,vs.vn
			,concat(vs.age_y,' ปี ',vs.age_m,' เดือน ',vs.age_d,' วัน') as age 
			,oa.nextdate,oa.nexttime,doc.name as doctor,ksk.department,cli.name as 'clinic',count(v2.vn) as visit_count
			,DATEDIFF(date(NOW()),oa.nextdate) as 'datediff',oa.app_cause,oa.note,oa.note1,oa.note2
			from oapp oa
			join vn_stat vs on oa.vn = vs.vn
			join patient pt on pt.hn = oa.hn
			left outer join ovst v2 on v2.vstdate = oa.nextdate and v2.hn = oa.hn
			join doctor doc on doc.code = oa.doctor
			join clinic cli on cli.clinic = oa.clinic
			join kskdepartment ksk on ksk.depcode = oa.depcode
			join pttype type on vs.pttype = type.pttype
			where vs.vn = '".$_GET["vn"]."'
			group by oa.oapp_id
			order by oa.nextdate desc,oa.nexttime DESC
			";
		$selectType= mysqli_query($mysqli,$sql_hosName) or die ("Error Query [".$sql_hosName."]");

	$detailappoint = mysqli_fetch_array($selectType);
		
?>
<div class="container">
		<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">	 
			<div class="container">
				<div class="row">
					<div id="navbar-left" class="col-lg-5 col-xs-12">
						<img src="../../img/ico/logo_yom.png" height="15">
						<span>โรงพยาบาลเจ้าพระยายมราช</span>
					</div>
					<div class="navbar-sub-header" class="col-lg-2 col-xs-2">
					<a class="image-div pointer" href="../../index.php">
						ค้นหานัดหมาย 
						<div>YomAppointment</div>
					</a>	
					</div>
					<div id="navbar-right" class="col-lg-5 col-xs-8">
						
						<b>Your ip : <?php 
			               	echo $_SERVER['REMOTE_ADDR'];
							#echo get_IP_address();
							?>
						</b>
					</div>
				</div>	
			</div>
		</nav>
	</div>
<div class="container" style="margin-top: 80px;>
	<div class="row">	
	<div class="col-md-12 col-xs-12">
		<div class="headtitle">รายละเอียดตารางนัดหมาย</div>
	</div>	
<hr>
	<div class="row">
			            	<div class="col-md-12 col-xs-12">
				            	<div class="headreport">
									<i class="fa fa-user-circle" aria-hidden="true"></i>
									รายชื่อผู้มารับบริการ : &nbsp;
								</div>
								<div class="patientname">	
									<?php echo $detailappoint["Name"];?>
								</div>
							</div>
						</div>
	<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="text-left">
			<p><i class="fa fa-tags" aria-hidden="true"></i> สถานะการนัดหมาย  &nbsp; 
				<?php 
					if($detailappoint["visit_count"] >= '1') {
						echo"<span data-toggle='tooltip' title='มาตามนัด'	class='badge bg-light-green'>
							<i class = 'icon icon ion-checkmark'></i>
							</span>";
					}elseif ($detailappoint["visit_count"] == '0' && $detailappoint["datediff"] >= '0'){
						echo "<span data-toggle='tooltip' title='ไม่มาตามนัด' class='badge bg-red'>
								<i class = 'icon icon ion-close'></i>
							</span>";	
					}elseif ($detailappoint["datediff"] <= 0) {
						echo "<span data-toggle='tooltip' title='รอนัด' class='badge bg-blue'>รอวันนัดหมาย... </span>";
					}else{
						echo "No-DATA";
				}?>	
			</p>
		</div>
	</div>
	</div>
	
	<div class="row">		
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left">
																			<p><i class="fa fa-id-card-o" aria-hidden="true"></i>
																				VN : <?php echo $detailappoint["vn"];?>
																			</p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left">
																				<p>	วันที่มารับบริการครั้งล่าสุด :	
																				<?php echo DateThai($detailappoint["vstdate"]);?>
																				</p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left">
																				<p><i class="fa fa-tags" aria-hidden="true"></i>  	สิทธิ์การรักษาในครั้งนี้ :
																				<?php echo $detailappoint["pttype"];?>
																				</p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left">
																				<p><i class="fa fa-home" aria-hidden="true"></i> คลินิก : <?php echo $detailappoint["clinic"];?>
																				</p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left">
																			<p><i class="fa fa-map-marker" aria-hidden="true"></i>   สถานที่นัดหมาย : 
																				<?php echo $detailappoint["department"];?></p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left">
																			<p><i class="fa fa-user-md" aria-hidden="true"></i>  แพทย์ผู้นัดหมาย : 
																			<?php echo $detailappoint["doctor"];?>
																			</p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left">
																			<p><i class="fa fa-caret-right" aria-hidden="true"></i>  เหตุผลการนัด : 
																				<?php echo $detailappoint["app_cause"];?>
																			</p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left">
																			<p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>  สิ่งที่ต้องปฏิบัติก่อนพบแพทย์ : 
																			<?php echo $detailappoint["note"].$detailappoint["note1"].$detailappoint["note2"];?>
																			</p>
																			</div>
																		</div>
																	</div>

		
	</div>
</div>																		