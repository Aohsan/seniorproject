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
<title>รายงานข้อมูลหนังสือ</title>
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
<form action="p_report_bookshow.php" method="post" name="searchform" target="_blank" id="searchform">
  <p align="	center">
    <label>รายงานข้อมูลหนังสือ</label>
    <select name="cateofsearch" style="width: 170px; font-family: Mitr; font-size:13px;">
      <option value="rpall">ทั้งหมด</option>
      <?php include('r_book_select2.php');?>
    </select>
    <input type="submit" name="btn_search" id="btn_search" value="ดูรายงาน" style="font-family: Mitr; font-size:13px;">
    </br>
  </p>
</form>
          </div></br>
</body>
</html>
