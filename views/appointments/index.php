<?php 
	include('../site/function.php');
 	include('../site/header.php');
 	include('../../config/db.php');
 	
?>
<?php $page = basename($_SERVER['SCRIPT_NAME']); ?>
<?php
		$infoPatient = "select pt.cid,pt.hn,concat(pt.pname,pt.fname,' ',pt.lname) as patientname
			,type.name as pttype,(year(CURDATE())-year(birthday)) as 'age_y'
			,timestampdiff(year,pt.birthday,curdate()) as cnt_year,
			timestampdiff(month,pt.birthday,curdate())-(timestampdiff(year,pt.birthday,curdate())*12) as cnt_month,
			timestampdiff(day,date_add(pt.birthday,interval (timestampdiff(month,pt.birthday,curdate())) month),curdate()) as cnt_day
			from patient pt
			join pttype type on pt.pttype = type.pttype
			where pt.cid = '".$_POST["inputCID"]."' and pt.hn like '".$_POST["inputHN"]."'	
			limit 1";
			$info= mysqli_query($mysqli,$infoPatient) or die ("Error Query [".$infoPatient."]");

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
				where pt.cid = '".$_POST["inputCID"]."' and pt.hn = '".$_POST["inputHN"]."'
				group by oa.oapp_id
				order by oa.nextdate desc,oa.nexttime DESC
				limit 5
				";
 			$detail= mysqli_query($mysqli,$sql_hosName) or die ("Error Query [".$sql_hosName."]");
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
				<div class="box box-warning">
			        <div class="box-header with-border">
			            <h3 class="box-title" align="left"> 
			              	<i class="fa fa-list-alt" aria-hidden="true"></i> ข้อมูลผู้มารับบริการ 
			            </h3>
						<div class="box-tools pull-right">
			                <button type="button" class="btn btn-box-tool" data-widget="collapse">
			                	<i class="fa fa-minus"></i>
			                </button>
			            </div>
			        </div>
					<div class="box-body">
						<div class="row">
			            	<div class="col-md-12 col-xs-12">
				            	<div class="headreport">
									<i class="fa fa-user-circle" aria-hidden="true"></i>
									รายชื่อผู้มารับบริการ : &nbsp;
								</div>
								<div class="patientname">	
									<?php
										foreach($info as $infoPatient){
											echo $infoPatient["patientname"];
											}
										?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="headinfo">
									เลขประจำตัวประชาชน  (CID)   &nbsp; 
								</div>
								<div class="subinfo">
									<i class="fa fa-address-card-o" aria-hidden="true"></i>	
									<?php 	foreach ($info as $infoPatient) {
								 		echo $infoPatient["cid"];
								 	    }
								  	?>
								</div>
							</div>
						</div>
						<div class="row">	
							<div class="col-md-12 col-xs-12">
								<div class="headinfo">	เลขประจำตัวผู้มารับบริการ (HN)  &nbsp; </div>
								<div class="subinfo">
									<i class="fa fa-h-square" aria-hidden="true"></i>
									<?php 	foreach ($info as $infoPatient) {
								 		echo $infoPatient["hn"];
								 	    }
								  	?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="headinfo">	อายุ : &nbsp; </div>
								<div class="subinfo">
								 	<?php 	foreach ($info as $infoPatient) {
								 		echo $infoPatient["cnt_year"]." ปี " .$infoPatient["cnt_month"]." เดือน "
								 		.$infoPatient["cnt_day"]." วัน ";
								 	    }
								  	?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="headinfo">	สิทธิ์การรักษา : &nbsp; </div>
								<div class="subinfo">
								 	<?php 	foreach ($info as $infoPatient) {
								 		echo $infoPatient["pttype"] ;
								 	    }
								  	?>
								</div>
							</div>
						</div>
			        </div>
			    </div>
			</div>
		</div>
		<div class="container" style="margin-top: 10px;>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="box box-warning">
						<div class="box-header with-border">
				            <h3 class="box-title" align="left"> 
				              	<i class="fa fa-list-alt" aria-hidden="true"></i> ประวัติการนัดหมาย 
				            </h3>
							<div class="box-tools pull-right">
				                <button type="button" class="btn btn-box-tool" data-widget="collapse">
				                	<i class="fa fa-minus"></i>
				                </button>
				            </div>
				        </div>
				       	<div class="box-body">
							<div class="col-md-12 col-xs-12">
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<div class="headtitle">รายละเอียดตารางนัดหมาย</div>
									</div>
								</div>
								<div class="row">
									<div id = "placement" class="col-md-12 col-xs-12">
									<?php $num = 0;	
										while($detailappoint = mysqli_fetch_array($detail)){
											require_once 'vendor/autoload.php';
												$renderer = new \BaconQrCode\Renderer\Image\Png();
												$renderer->setHeight(256);
												$renderer->setWidth(256);
												$writer = new \BaconQrCode\Writer($renderer);
												$writer->writeFile('https://yrh.moph.go.th/yomappoint/views/appointments/patientqr.php?vn='.$detailappoint["vn"],'../../images/qrcode-'.$detailappoint["vn"].'.png');
												
											?>
										<div class="box box-info">
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<div class="box-header with-border">
										            	<h5 class="text-left">
										            		<i class="fa fa-folder-open-o" aria-hidden="true"></i>
										            		 	รายการที่ <?php $num=$num+1; echo $num;?>
										            	</h5>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<div class="row">
														<div class="col-md-1 col-xs-12"></div>
														<div class="col-md-10 col-xs-12">
															<div class="box-body">
																<div class="row">
																	<div class="col-md-6 col-xs-12">
																		<div class="text-left">
																			<div class="headreport">
																			<i class="fa fa-home" aria-hidden="true"></i>
																				คลินิก : &nbsp;
																			</div>
																			<div class="patientname">	
																				<?php echo $detailappoint["clinic"];?>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-6 col-xs-12">
																		<div class="text-right">
																			<p>
																			สถานะการนัดหมาย  &nbsp; 
																			<?php 
																		    if($detailappoint["visit_count"] >= '1') {
																		    	echo"<span data-toggle='tooltip' title='มาตามนัด' 
																		    		class='badge bg-light-green'><i class = 'icon icon ion-checkmark'></i>
																					</span>";
																		    }elseif ($detailappoint["visit_count"] == '0' && $detailappoint["datediff"] >= '0'){
																		    	echo "<span data-toggle='tooltip' title='ไม่มาตามนัด' 
																		    		class='badge bg-red'><i class = 'icon icon ion-close'></i>
																					</span>";	
																		    }elseif ($detailappoint["datediff"] <= 0) {
																		    	echo "<span data-toggle='tooltip' title='รอนัด' 
																		    			class='badge bg-blue'>รอวันนัดหมาย... </span>";
																		   	}else{
																		    	echo "No-DATA";
																		    }?>	
																			</p>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-8 col-xs-12">
																		<div class="text-left">
																		<p><i class="fa fa-calendar" aria-hidden="true"></i>
																			วันที่มารับบริการ :
																			<?php echo DateThai($detailappoint["vstdate"]);?>
																		</p>
																		</div>
																	</div>
																	<div class="col-md-4 col-xs-12">
																		<div class="text-right">
																		<button type="button" class="btn btn-warning btn-flat" data-toggle="modal" data-target="#myModal<?php echo $detailappoint["vn"];?>"><i class="fa fa-th-list" aria-hidden="true"></i> รายละเอียด
																		</button>
																		
																		<button type="button" class="btn btn-danger btn-flat"
																		data-toggle="modal" data-target="#myModal2<?php echo $detailappoint["vn"];?>">
																			<i class="fa fa-qrcode" aria-hidden="true"></i> QR Scan
																		</button>
																		</div>
																		
																			<div id="myModal2<?php echo $detailappoint["vn"];?>" class="modal fade" role="dialog">
																		  <div class="modal-dialog">

																		    <!-- Modal content-->
																		    <div class="modal-content">
																		      <div class="modal-header">
																		        <button type="button" class="close" data-dismiss="modal">&times;</button>
																		        <h3 class="modal-title"> <i class="fa fa-search" aria-hidden="true"></i>  Scan QR Code</h3>
																		        <p>รายละเอียด VN : <?php echo $detailappoint["vn"];?></p>
																		      </div>
																		      <div class="modal-body">
																		        <img src="../../images/qrcode-<?php echo $detailappoint["vn"];?>.png">
																		      </div>
																		      <div class="modal-footer">
																		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		      </div>
																		    </div>

																		  </div>
																		</div>
																		<div class="modal fade" id="myModal<?php echo $detailappoint["vn"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																	<button type="button" class="btn btn-primary btn-sm pull-right btn-flat" data-dismiss="modal" aria-hidden="true"><i class="fa fa-desktop" aria-hidden="true"></i>  ปิดหน้าจอ</button>
																	<h4 class="modal-title" id="myModalLabel"> รายละเอียดการนัดหมาย </h4>
																	</div>
																	<div class="modal-body">
																		<div class="row">
																			<div class="col-md-12 col-xs-12">
																				<div class="text-center">
																				<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i>	นัดครั้งต่อไป :	
																				<?php echo DateThai($detailappoint["nextdate"]);?>
																				</p>
																				</div>
																			</div>
																		</div>
																	<div class="row">
																		<div id="col-md-12 col-xs-12">
																			<div class="text-center">
																			สถานะการนัดหมาย : 
																				<?php 
																				if($detailappoint["visit_count"] >= '1') {
																					echo"<span data-toggle='tooltip' title='มาตามนัด' 
																						class='badge bg-light-green'><i class = 'icon icon ion-checkmark'></i>
																						</span>";
																				}elseif ($detailappoint["visit_count"] == '0' && $detailappoint["datediff"] >= '0'){
																					echo "<span data-toggle='tooltip' title='ไม่มาตามนัด' class='badge bg-red'><i class = 'icon icon ion-close'></i>
																						</span>";	
																				}elseif ($detailappoint["datediff"] <= 0) {
																					echo "<span data-toggle='tooltip' title='รอนัด' class='badge bg-blue'>รอวันนัดหมาย... </span>";
																				}else{
																					echo "No-DATA";
																				}
																				?>
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
																<div class="modal-footer">
																	
																	<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
																</div>
															</div>
															</div>
															</div>
																	</div>
																</div>
															</div>
															
														</div>
														<div class="col-md-1 col-xs-12"></div>
													</div>
												</div>
											</div>
										</div>
									<?php
										}
									?>
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<button type="button" id="event-more" class="btn btn-default btn-flat" value="1" data-page="1"
							data-cid="<?php echo $_POST["inputCID"]; ?>" data-hn="<?php echo $_POST["inputHN"] ?>">
								<i class="fa fa-chevron-circle-down" aria-hidden="true"></i> แสดงรายการ เพิ่มเติม... 
							</button>
						</div>
					</div>		
				</div>
			</div>
		</div>	
	</div>
	
<?php include('../site/footer.php');?>