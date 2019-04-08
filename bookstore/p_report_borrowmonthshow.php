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
<title>รายงานการยืมประจำเดือน</title>
<link href="https://fonts.googleapis.com/css?family=Mitr:400,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/png" href="assets/images/headericonlogo.png" />
</head>
<body>
  <?php
	$search=$_POST['cateofsearch_year']."-".$_POST['cateofsearch_month'];
  $month = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
  $i=0;
	$j=0;
	$k=0;
    $search_month = strtotime($search);
    if ($search_month) {
      $smonth = $month[date('m', $search_month)]." ".(date('Y', $search_month)+543);
    } else {
      $notsmonth = date('M Y', $search);
      echo 'ไม่พบรายการยืมประจำเดือน : ' . $notsmonth;
    }

      $sql="SELECT * FROM `borrow`";
	    $sql.=" INNER JOIN `borrowdetail` ON borrow.br_id = borrowdetail.br_id";
      $sql.=" INNER JOIN `members` ON borrow.mb_code = members.mb_code";
	    $sql.=" WHERE borrow.br_bdate BETWEEN '".$search."-1' AND '".$search."-31'";


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
    <td align="center" valign="middle" width="620" size="20" style="font-size: 18px;">รายงานการยืม</td>
  </tr>
  <tr style="color:#000;" bgcolor="#fff" height="40" >
    <td align="center" valign="middle" size="20" style="font-size: 18px;">ประจำเดือน <?php echo $smonth;?></td>
  </tr>
</table>
<br />
<table border="0" bordercolor="#ddd" align="center" cellpadding="5" cellspacing="0">
<thead>
  <tr style="color:#fff;" bgcolor="#FF5722" height="40">
    <td align="left" valign="middle" width="20">ลำดับ</td>
    <td align="left" valign="middle" width="100">วันที่ยืม</td>
    <td align="left" valign="middle" width="100">วันทีกำหนดคืน</td>
    <td align="left" valign="middle" width="250">ชื่อผู้ยืม</td>
    <td align="left" valign="middle" width="120">จำนวนที่ยืม (เล่ม)</td>
  </tr>
</thead>
<tbody>
  <?php
  	while($record=mysqli_fetch_array($result)){
	$k++;
	$bdate = new DateTime($record['br_bdate']);
	$fdate = new DateTime($record['br_fdate']);
	$sql2="SELECT * FROM `borrow`";
	$sql2.=" INNER JOIN `borrowdetail` ON borrow.br_id = borrowdetail.br_id";
	$sql2.=" WHERE borrowdetail.br_id='".$record['br_id']."' and borrow.br_bdate BETWEEN '".$search."-1' AND '".$search."-31'";
	$result2=mysqli_query($connect, $sql2);
	$num=mysqli_num_rows($result2);
	$i++;
  ?>
<?php
	if($i==1){
	$j++;
?>
  <tr bgcolor="#f2f2f2">
    <td align="left" valign="top"><?php echo($j);?></td>
    <td align="left" valign="top"><?php echo date('d/m/',strtotime($record['br_bdate'])).(date('Y',strtotime($record['br_bdate']))+543);?></td>
    <td align="left" valign="top"><?php echo date('d/m/',strtotime($record['br_fdate'])).(date('Y',strtotime($record['br_fdate']))+543);?></td>
    <td align="left" valign="top"><?php echo $record['mb_tname'],$record['mb_fname'];?> <?php echo $record['mb_lname'];?></td>
    <td align="right" valign="top"><?php echo $num;?></td>
  </tr>
<?php
	}
	if($i==$num){$i=0;}}
?>
  <tr bgcolor="#E6E6E6" style="color:#0023FF;">
	<td align="right" valign="top" colspan="4">รวม</td>
    <td align="right" valign="top" colspan="1"><?php echo $k; ?></td>
  </tr>
  <tr>
	<td align="right" valign="top" colspan="5" height="10px"></td>
  </tr>
</tbody>
<tfoot>
    <td align="center" valign="top" colspan="5" style="color:#0023FF;">รวมหนังสือที่ถูกยืมในเดือน <?php echo $smonth;?> ทั้งหมด จำนวน <?php echo $k; ?> เล่ม</td>
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
<?php } ?>
</body>
</html>
