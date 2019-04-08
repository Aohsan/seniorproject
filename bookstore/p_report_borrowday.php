<?php include("mysql/config.php");
 if(isset($_SESSION['adm_id'])=="")
{
	echo "<script type='text/javascript'>alert('สำหรับผู้ดูแลระบบ ล็อคอินเพื่อใช้งาน !');window.location.replace('h_index.php');</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานการยืมประจำวัน</title>
<link href="https://fonts.googleapis.com/css?family=Mitr:400,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/png" href="assets/images/headericonlogo.png" />
</head>
<body>
<?php
include "t_header.php";
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
          <div class="searchtool">
<form action="p_report_borrowdayshow.php" method="post" name="searchform" target="_blank" id="searchform">
  <p align="	center">
    <label>รายงานการยืมประจำวัน</label>
    <select type="text" name="cateofsearch_day" id="cateofsearch_day" style="width:60px;  font-family: Mitr; font-size:13px;" >
    <script language="javascript" type="text/javascript">
    for(var d=1;d<=31;d++)
      {
        document.write("<option>"+d+"</option>");
      }
    </script>
    </select>
    <select type="text" name="cateofsearch_month" id="cateofsearch_month" style="width:100px;  font-family: Mitr; font-size:13px;" >
    	  <option value="1">มกราคม</option>
      	<option value="2">กุมภาพันธ์</option>
      	<option value="3">มีนาคม</option>
        <option value="4">เมษายน</option>
      	<option value="5">พฤษภาคม</option>
      	<option value="6">มิถุนายน</option>
        <option value="7">กรกฎาคม</option>
      	<option value="8">สิงหาคม</option>
      	<option value="9">กันยายน</option>
        <option value="10">ตุลาคม</option>
      	<option value="11">พฤศจิกายน</option>
      	<option value="12">ธันวาคม</option>
    </select>
	<select type="text" name="cateofsearch_year" id="cateofsearch_year" style="width:70px;  font-family: Mitr; font-size:13px;" >
	<?php
		echo"<option value='". $year=date("Y") ."' selected='selected'>" . $year=(date("Y")+543) . "</option>";
		echo"<option value='". $year=date("Y")-1 ."'>" . $year=(date("Y")+543)-1 . "</option>";
		echo"<option value='". $year=date("Y")-2 ."'>" . $year=(date("Y")+543)-2 . "</option>";
		echo"<option value='". $year=date("Y")-3 ."'>" . $year=(date("Y")+543)-3 . "</option>";
		echo"<option value='". $year=date("Y")-4 ."'>" . $year=(date("Y")+543)-4 . "</option>";
	?>
	</select>

    <input type="submit" name="btn_search" id="btn_search" value="ดูรายงาน" style="font-family: Mitr; font-size:13px;">
    </br>
  </p>
</form>
          </div></br>
</body>
</html>
