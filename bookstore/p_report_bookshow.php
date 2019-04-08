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
<title>รายงานข้อมูลสมาชิก</title>
<link href="https://fonts.googleapis.com/css?family=Mitr:400,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/png" href="assets/images/headericonlogo.png" />
</head>
<body>
  <?php
  $month = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
  	$i=0;
  	$cateofsearch=$_POST['cateofsearch'];

  	if($cateofsearch=='rpall'){
      $sql="SELECT * FROM books INNER JOIN cob ON books.cob_cateid=cob.cob_cateid";
  		}
    else {
      $sql="SELECT * FROM books INNER JOIN cob ON books.cob_cateid=cob.cob_cateid";
      $sql.=" WHERE cob.cob_cateid='".$_POST['cateofsearch']."'";
    }

  	include("mysql/conn.php");
  	$result=mysqli_query($connect, $sql);
  ?>
<div class="contentreport">
	<div class="container">
    	<div class="contentreportarea">
<table border="0" bordercolor="#ddd" align="center" cellpadding="5" cellspacing="0">
  <tr style="color:#000;" bgcolor="#fff" height="40" >
    <td align="center" valign="middle" width="1000" size="20" style="font-size: 18px;">รายงานข้อมูลหนังสือ</td>
  </tr>
  <tr style="color:#000;" bgcolor="#fff">
    <td align="right" valign="middle">วันที่รายงาน : <?php echo date("d")." ".$month[date("m")]." ".(date("Y")+543); ?></td>
  </tr>
</table>

<table border="0" bordercolor="#ddd" align="center" cellpadding="5" cellspacing="0">
<thead>
  <tr style="color:#fff;" bgcolor="#FF5722" height="40">
    <td align="left" valign="middle" width="20">ลำดับ</td>
    <td align="left" valign="middle" width="130">ประเภทหนังสือ</td>
    <td align="left" valign="middle" width="320">ชื่อหนังสือ</td>
    <td align="left" valign="middle" width="170">ผู้แต่ง</td>
    <td align="center" valign="middle" width="60">ทั้งหมด (เล่ม)</td>
    <td align="center" valign="middle" width="60">ถูกยืม (เล่ม)</td>
    <td align="center" valign="middle" width="60">ชำรุด (เล่ม)</td>
    <td align="center" valign="middle" width="60">สูญหาย (เล่ม)</td>
    <td align="center" valign="middle" width="60">คงเหลือ (เล่ม)</td>
  </tr>
</thead>
<tbody>
  <?php
  	while($record=mysqli_fetch_array($result)){
      $i++;
      $sql2="SELECT bk_numstock as total FROM books";
      $sql2.=" WHERE bk_code='".$record['bk_code']."'";
      $result2=mysqli_query($connect, $sql2);
      	while($record2=mysqli_fetch_array($result2)){
          $sql3="SELECT *,COUNT(brd_numbr) as brd_numbr  FROM `borrow`";
          $sql3.=" INNER JOIN `borrowdetail` ON borrow.br_id = borrowdetail.br_id";
          $sql3.=" WHERE borrowdetail.brd_numbr='1' and borrowdetail.bk_code='".$record['bk_code']."'";
          $result3=mysqli_query($connect, $sql3);
          	while($record3=mysqli_fetch_array($result3)){
              $sql4="SELECT *,COUNT(brd_numbr) as brd_numbr  FROM `borrow`";
              $sql4.=" INNER JOIN `borrowdetail` ON borrow.br_id = borrowdetail.br_id";
              $sql4.=" WHERE borrowdetail.brd_numbr='4' and borrowdetail.bk_code='".$record['bk_code']."'";
              $result4=mysqli_query($connect, $sql4);
                while($record4=mysqli_fetch_array($result4)){
                  $sql5="SELECT *,COUNT(brd_numbr) as brd_numbr  FROM `borrow`";
                  $sql5.=" INNER JOIN `borrowdetail` ON borrow.br_id = borrowdetail.br_id";
                  $sql5.=" WHERE borrowdetail.brd_numbr='3' and borrowdetail.bk_code='".$record['bk_code']."'";
                  $result5=mysqli_query($connect, $sql5);
                    while($record5=mysqli_fetch_array($result5)){
  ?>
  <tr bgcolor="#f2f2f2">
    <td align="left" valign="top"><?php echo($i);?></td>
    <td align="left" valign="top"><?php echo $record['cob_cateofbook'];?></td>
    <td align="left" valign="top"><?php echo $record['bk_title'];?></td>
    <td align="left" valign="top"><?php echo $record['bk_author'];?></td>
    <td align="center" valign="top" style="color:#00D4DC;"><?php echo $sumbook=$record2['total']+$record3['brd_numbr']+$record5['brd_numbr'];?></td>
    <td align="center" valign="top" style="color:green;"><?php echo $record3['brd_numbr'];?></td>
    <td align="center" valign="top" style="color:#FF5722;"><?php echo $record4['brd_numbr'];?></td>
    <td align="center" valign="top" style="color:red;"><?php echo $record5['brd_numbr'];?></td>
    <td align="center" valign="top" style="color:#0023FF;"><?php echo $record2['total'];?></td>
  </tr>
<?php }}}}}?>
  <tr>
    <td align="right" valign="top" colspan="9" height="10px"></td>
  </tr>
</tbody>
<tfoot>
    <td align="center" valign="top" colspan="9" style="color:#0023FF;">รวมรายการหนังสือทั้งหมด จำนวน <?php echo $i; ?> รายการ</td>
</tfoot>
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
</body>
</html>
