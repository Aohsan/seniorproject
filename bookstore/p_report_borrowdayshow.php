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
  $search=$_POST['cateofsearch_year']."-".$_POST['cateofsearch_month']."-".$_POST['cateofsearch_day'];
  $month = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
  	$i=0;
	  $j=0;
    $search_day = strtotime($search);
    if ($search_day) {
      $sday = date('d', $search_day)." ".$month[date('m', $search_day)]." ".(date('Y', $search_day)+543);
    } else {
      $notsday = date('d M Y', $cateofsearch_day);
      echo 'ไม่พบรายการยืมประจำวันที่ : ' . $notsday;
    }

      $sql="SELECT * FROM `borrow`";
	    $sql.=" INNER JOIN `borrowdetail` ON borrow.br_id = borrowdetail.br_id";
      $sql.=" INNER JOIN `books` ON borrowdetail.bk_code = books.bk_code";
      $sql.=" INNER JOIN `members` ON borrow.mb_code = members.mb_code";
	    $sql.=" WHERE borrow.br_bdate='".$search."'";

  	include("mysql/conn.php");
  	$result=mysqli_query($connect, $sql);

	   $check=mysqli_num_rows($result);

	    if($check==0){ ?>
		      <center><img src="assets/images/noresult.png"></center>
          <?php
	    }else{
      ?>
<div class="contentreport">
	<div class="container">
    	<div class="contentreportarea">
<table border="0" bordercolor="#ddd" align="center" cellpadding="5" cellspacing="0">
  <tr style="color:#000;" bgcolor="#fff" height="40" >
    <td align="center" valign="middle" width="680" size="20" style="font-size: 18px;">รายงานการยืม</td>
  </tr>
  <tr style="color:#000;" bgcolor="#fff" height="40" >
    <td align="center" valign="middle" size="20" style="font-size: 18px;">ประจำวันที่ <?php echo $sday;?></td>
  </tr>
</table>
<br />
  <?php
  	while($record=mysqli_fetch_array($result)){
	$j++;
	$bdate = new DateTime($record['br_bdate']);
	$fdate = new DateTime($record['br_fdate']);
	$sql2="SELECT * FROM `borrow`";
	$sql2.=" INNER JOIN `borrowdetail` ON borrow.br_id = borrowdetail.br_id";
	$sql2.=" WHERE borrowdetail.br_id='".$record['br_id']."' and borrow.br_bdate='".$search."'";
	$result2=mysqli_query($connect, $sql2);
	$num=mysqli_num_rows($result2);
	$i++;
  ?>
<?php
	if($i==1){
?>
  <table border="0" bordercolor="#ddd" align="center" cellpadding="5" cellspacing="0">
    <tr style="color:#000;" bgcolor="#fff">
      <td align="left" valign="middle" width="1000" colspan="5">รหัสสมาชิก <?php echo $record['mb_code']?>&nbsp;&nbsp; ชื่อ - สกุล <?php echo $record['mb_tname'],$record['mb_fname'];?> <?php echo $record['mb_lname'];?></td>
    </tr>
    <tr style="color:#000;" bgcolor="#fff">
      <td align="left" valign="middle" colspan="5">&nbsp;&nbsp;รายการหนังสือที่ยืม</td>
    </tr>
    <tr style="color:#fff;" bgcolor="#FF5722" height="40">
      <td align="left" valign="middle" width="20">ลำดับ</td>
      <td align="left" valign="middle" width="380">ชื่อหนังสือ</td>
      <td align="left" valign="middle" width="200">ชื่อผู้แต่ง</td>
      <td align="left" valign="middle" width="280">สำนักพิมพ์</td>
    </tr>
<?php
	}
?>
<?php
	if($i<=$num){
?>
  <tr bgcolor="#f2f2f2">
    <td align="left" valign="top"><?php echo($i);?></td>
    <td align="left" valign="top"><?php echo $record['bk_title'];?></td>
    <td align="left" valign="top"><?php echo $record['bk_author'];?></td>
    <td align="left" valign="top"><?php echo $record['bk_publisher'];?></td>
  </tr>
<?php
	}
	if($i==$num){
?>
  <tr bgcolor="#E6E6E6" style="color:#0023FF;">
	   <td align="center" valign="top" colspan="4">จำนวนหนังสือทั้งหมด <?php echo $i; ?> เล่ม</td>
  </tr>
  <tr>
	<td align="right" valign="top" colspan="5" height="10px"></td>
  </tr>
<?php
	$i=0;}}
?>
    <td align="center" valign="top" colspan="5" style="color:#0023FF;">รวมหนังสือที่ถูกยืมในวันที่ <?php echo $sday;?> ทั้งหมด จำนวน <?php echo $j; ?> เล่ม</td>
</table>
<?php include("mysql/unconn.php");?>
<br />
<div class ="printbutton no-print">
<table width="1000" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td colspan="2" align="center" valign="top" style="color:#999;font-size:13px;">
      <a href="javascript:printreport()" title="พิมพ์รายงาน"><img src="assets/images/iconprint.png" alt="" height="13"></a>
    </td>
</tr>
</table>
</div>
        </div>
<br />
<script language="javascript">
function printreport(){
  if(confirm("ต้องการที่พิมพ์รายงานใช่หรือไม่ ?")==true){
    window.print();
  }
}
</script>
<style type="text/css" media="print">
@media print{
.no-print{ display:none;}
}
</style>
	</div>
</div>
<?php } ?>
</body>
</html>
