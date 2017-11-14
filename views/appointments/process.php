<?php 

include('../site/function.php');
include('../../config/db.php');

$start 	= ($_POST['page'] * 5 ) +1 ;
$end 	= $start + 5 ;
$cid	= $_POST['cid'];
$hn		= $_POST['hn'];
?>

<?php  
	$sql_hosName="select pt.cid,pt.hn,concat(pt.pname,pt.fname,' ',pt.lname) as Name
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
				where pt.cid = '".$cid."' or pt.hn like '".$hn."'
				group by oa.oapp_id
				order by oa.nextdate desc,oa.nexttime DESC
				limit $start , 5 ";

	$detail= mysqli_query($mysqli,$sql_hosName) or die ("Error Query [".$sql_hosName."]");
?>
<?php $num = $start-1;	
	while($detailappoint = mysqli_fetch_array($detail)){?>

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
									    	echo "<span data-toggle='tooltip' title='รอมาตามนัด' 
									    			class='badge bg-blue'>wait... </span>";
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
												echo "<span data-toggle='tooltip' title='รอมาตามนัด' class='badge bg-blue'>wait... </span>";
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
#######
<?php echo ($_POST['page'] + 1); ?>
