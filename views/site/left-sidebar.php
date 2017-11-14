<?php $page = $_SERVER['PHP_SELF']; ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/avatar3.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Clinic</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <ul class="sidebar-menu">
        <li><a href="#"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="header">ข้อมูลพัฒนาการเด็ก & ทารกแรกเกิด</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-child" aria-hidden="true"></i>
 <span>รายการนัดหมาย</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/clinicnewborn/views/newborn/index.php"><i class="fa fa-circle-o"></i> คลินิกกระตุ้นพัฒนาการ</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Thalassemia Screening</a></li>
          </ul>
        </li>

        <li class="header">แบบเก็บข้อมูล</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text"></i> <span>Report</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">12</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active">
              <a href="index.html"><i class="fa fa-circle-o"></i> ปกติ
                <span class="pull-right-container">
                  <span class="label label-success pull-right">6</span>
                </span>
              </a>
            </li>
            <li>
              <a href="index2.html"><i class="fa fa-circle-o"></i> ผิดปกติ
                <span class="pull-right-container">
                  <span class="label label-success pull-right">6</span>
                </span>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="header">VERSION</li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>V.20160707</span></a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>