<?php include('header.php');?>
<div class="content">
<div class="container">
	<div class="row">  
		<div id="headnavbar" class="col-md-12 col-xs-12">
			ค้นหานัดหมาย
		</div>
		<div id="second-title-th" class="col-md-12 col-xs-12">
			<img src="img/ico/logo_yom.png" height="50">
			YomAppointment
		</div>
		<div id="second-title-en" class="col-md-12 col-xs-12">
			Chaophrayayommarat Hospital Suphanburi					
		</div>
	</div> 
</div>
<div class="report">

</div>
<br>
<div class="container">	
	<div class="row">	
		<div class="col-md-12 col-xs-12">
			<div class="box box-info">
		        <div class="box-header with-border">
		            <h3 class="box-title"></h3>
		        </div>
		        <form class="form-horizontal" method="post" action="views/appointments/index.php">
		            <div class="box-body">
		                <div class="form-group">
		                  <label for="inputPassword3" class="col-sm-2 control-label">รหัสบัตรประชาชน *</label>

		                  <div class="col-sm-10">
		                    <input type="text" class="form-control" id="inputCID" name="inputCID" 
		                    		placeholder="เลข 13 หลัก (x-xxxx-xxxxx-xx-x)" required >
		                  </div>
		                </div>
		               <br>
		                <div class="form-group">
		                  <label for="inputPassword3" class="col-sm-2 control-label">รหัสประจำตัวผู้มารับบริการ : HN *</label>

		                  <div class="col-sm-10">
		                    <input type="text" class="form-control" id="inputHN" name="inputHN" 
		                    	 placeholder="xxxxxxxxx" required >
		                  </div>
		                </div>
		            </div>
		            <div class="box-footer">
		                <button type="submit" class="btn btn-info btn-flat">ค้นหาวันนัดหมาย</button>
		            </div>
		        </form>
		    </div>
		</div>
	</div>
</div>

</div>

<?php include('views/site/footer.php');?>