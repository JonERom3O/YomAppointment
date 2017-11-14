<?php
  $thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
    $thai_month_arr=array(
      "0"=>"",
      "1"=>"มกราคม",
      "2"=>"กุมภาพันธ์",
      "3"=>"มีนาคม",
      "4"=>"เมษายน",
      "5"=>"พฤษภาคม",
      "6"=>"มิถุนายน",  
      "7"=>"กรกฎาคม",
      "8"=>"สิงหาคม",
      "9"=>"กันยายน",
      "10"=>"ตุลาคม",
      "11"=>"พฤศจิกายน",
      "12"=>"ธันวาคม"         
    );
    function thai_date($time){
      global $thai_day_arr,$thai_month_arr;
      $thai_date_return=$thai_day_arr[date("w",$time)];
      $thai_date_return.=""."ที่";
      $thai_date_return.= " ".date("j",$time);
      $thai_date_return.=" ".$thai_month_arr[date("n",$time)];
      $thai_date_return.= " ".(date("Y",$time)+543);
      
      return $thai_date_return;

    
  }
?>

<?php
   function DateDiff($strDate1,$strDate2)
   {
        return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
   }
   function TimeDiff($strTime1,$strTime2)
   {
        return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 ); // 1 Hour =  60*60
   }
   function DateTimeDiff($strDateTime1,$strDateTime2)
   {
        return (strtotime($strDateTime2) - strtotime($strDateTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
   }           
?>

<?php
    function DateThai($str){
      $strYears =substr($str,0,4)+543;
      $strMonth=substr($str,5,2); 
      $strDate =substr($str,8,2); 
      $strYear=$strDate."-".$strMonth."-".$strYears;
      return $strYear;
    }
?>