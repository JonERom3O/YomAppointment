    <script src="../../vendor/components/jquery/jquery.min.js"></script>
    <script src="../../vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/morris/morris.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/select2/select2.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
	  <script src="../../vendor/almasaeed2010/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/flot/jquery.flot.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/flot/jquery.flot.resize.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/flot/jquery.flot.pie.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/flot/jquery.flot.categories.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/knob/jquery.knob.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/iCheck/icheck.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/plugins/fastclick/fastclick.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/dist/js/app.min.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/dist/js/pages/dashboard.js"></script>
    <script src="../../vendor/almasaeed2010/adminlte/dist/js/demo.js"></script>
    

    <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
      });
    });
  </script>
   <script>
      $(function () {
      /* jQueryKnob */

      $(".knob").knob({
        /*change : function (value) {
         //console.log("change : " + value);
         },
         release : function (value) {
         console.log("release : " + value);
         },
         cancel : function () {
         console.log("cancel : " + this.value);
         },*/
        draw: function () {

          // "tron" case
          if (this.$.data('skin') == 'tron') {

            var a = this.angle(this.cv)  // Angle
                , sa = this.startAngle          // Previous start angle
                , sat = this.startAngle         // Start angle
                , ea                            // Previous end angle
                , eat = sat + a                 // End angle
                , r = true;

            this.g.lineWidth = this.lineWidth;

            this.o.cursor
            && (sat = eat - 0.3)
            && (eat = eat + 0.3);

            if (this.o.displayPrevious) {
              ea = this.startAngle + this.angle(this.value);
              this.o.cursor
              && (sa = ea - 0.3)
              && (ea = ea + 0.3);
              this.g.beginPath();
              this.g.strokeStyle = this.previousColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
              this.g.stroke();
            }

            this.g.beginPath();
            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
            this.g.stroke();

            this.g.lineWidth = 2;
            this.g.beginPath();
            this.g.strokeStyle = this.o.fgColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
            this.g.stroke();

            return false;
          }
        }
      });
      </script>
      <script>
        $(function () {
          //Initialize Select2 Elements
          $(".select2").select2();

          //Datemask dd/mm/yyyy
          $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
          //Datemask2 mm/dd/yyyy
          $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
          //Money Euro
          $("[data-mask]").inputmask();

          //Date range picker
          $('#reservation').daterangepicker();
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
          //Date range as a button
          $('#daterange-btn').daterangepicker(
              {
                ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
              },
              function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
              }
          );

          //Date picker
          $('#datepicker').datepicker({
            autoclose: true
          });

          //iCheck for checkbox and radio inputs
          $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
          });
          //Red color scheme for iCheck
          $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
          });
          //Flat red color scheme for iCheck
          $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
          });

          //Colorpicker
          $(".my-colorpicker1").colorpicker();
          //color picker with addon
          $(".my-colorpicker2").colorpicker();

          //Timepicker
          $(".timepicker").timepicker({
            showInputs: false
          });
        });
    </script>
    <script>
        $(function () {
          $("#example1").DataTable();
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
          });
        });
    </script>
    <script type="text/javascript">
      $( document ).ready(function() {
        /*$("#replace").html('แทนที่');
        $("#prepend").prepend('แทรกข้างหน้า');
        $("#append").append('ต่อท้าย');*/
        //$("#appendTo").appendTo('xxx');

        $( "#event-more" ).on( "click", function() {
          //ajax
          //console.log($(this).data('cid'));
          $.post( "process.php", {
            'page' : $(this).data('page'),
            'q' : Math.random(),
            'cid' : $(this).data('cid'),
            'hn' : $(this).data('hn'),
            'vn' : $(this).data('vn'),
          }
          ,function(response){
            var html = response.split("#######");
            $( html[0] ).appendTo( $( "#placement" ) );
            $('#event-more').data('page', html[1].trim());

          });
        });
      });
    </script>

   </body>
</html>