<?php include("mysql/config.php");
 if(isset($_SESSION['adm_id'])=="")
{
	echo "<script type='text/javascript'>alert('สำหรับผู้ดูแลระบบ ล็อคอินเพื่อใช้งาน !');window.location.replace('h_index.php');</script>";
}
if(isset($_GET['clear'])){unset($_SESSION['mb_code']);unset($_SESSION["borrow"]);unset($_SESSION["mb_numr"]);unset($_SESSION['name']);unset($_SESSION['mb_job']);}
if(isset($_GET['mb_code'])){$_SESSION['mb_code']=$_GET['mb_code'];$_SESSION['name']=$_GET['name'];$_SESSION['mb_job']=$_GET['mb_job'];$_SESSION['mb_numr']=$_GET['mb_numr'];echo "<script type='text/javascript'>window.location.replace('p_borrow_select_member.php');</script>";}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบจัดการสมาชิก</title>
<link href="https://fonts.googleapis.com/css?family=Mitr:400,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/png" href="assets/images/headericonlogo.png" />
</head>
<body>
<?php
include "t_header.php";
$month = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
	$i=0;
  if(isset($_POST['txtsearch'])){
		$txtsearch=$_POST['txtsearch'];
		$cateofsearch=$_POST['cateofsearch'];
		$sql="SELECT mb_code,mb_tname,mb_fname,mb_lname,mb_job,mb_status,mb_numr,mb_addr,mb_tel,mb_regsta FROM members";
			if($cateofsearch=='mbcode'){
				$sql.= " WHERE mb_code LIKE '%$txtsearch%' and mb_regsta= 'a' and mb_numr > '0'";}
			elseif($cateofsearch=='mbfname'){
				$sql.= " WHERE mb_fname LIKE '%$txtsearch%' and mb_regsta= 'a' and mb_numr > '0'";}
      elseif($cateofsearch=='mblname'){
  			$sql.= " WHERE mb_lname LIKE '%$txtsearch%' and mb_regsta= 'a' and mb_numr > '0'";}
	}else{
		$sql="SELECT mb_code,mb_tname,mb_fname,mb_lname,mb_job,mb_status,mb_numr,mb_addr,mb_tel,mb_regsta FROM members";
    $sql.= " WHERE mb_regsta = 'a' and mb_numr > '0'";
		$txtsearch="";
	}
	include("mysql/conn.php");
	$result=mysqli_query($connect, $sql);
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
<?php if(!isset($_SESSION['mb_code'])){ ?>

  <div class="searchtool">
    <form action="p_borrow_select_member.php" method="post" name="searchform" target="_self" id="searchform">
      <p align="	center">
        <label>ค้นหาสมาชิก</label>
        <input name="txtsearch" type="text" id="txtsearch" style="font-family: Mitr; font-size:13px;" value="<?php echo($txtsearch)?>" placeholder="รหัสสมาชิก, ชื่อ, สกุล">
        <select name="cateofsearch" style="font-family: Mitr; font-size:13px;">
          <option value="mbcode" <?php if(isset($cateofsearch)){if($cateofsearch=="mbcode"){echo"selected";}} ?>>รหัสสมาชิก</option>
          <option value="mbfname" <?php if(isset($cateofsearch)){if($cateofsearch=="mbfname"){echo"selected";}} ?>>ชื่อ</option>
          <option value="mblname" <?php if(isset($cateofsearch)){if($cateofsearch=="mblname"){echo"selected";}} ?>>สกุล</option>
        </select>
        <input type="submit" name="btn_search" id="btn_search" value="ค้นหา" style="font-family: Mitr; font-size:13px;">
      </br>
    </p>
  </form>
  </div></br>

  <div class="desandbtnadd">
    <div class="descripicon">
      <p align="center">
        <label style="color:red;">* หมายเหตุ คลิกที่แถวเพื่อเลือกสมาชิกที่ต้องการยืมหนังสือ</label>
      </p>
    </div>
  </div>
      <div class="clearfix"></div></br>

<table border="0" bordercolor="#ddd" align="center" cellpadding="5" cellspacing="0">
  <caption style="padding-top:10px;padding-bottom:10px;margin-bottom:2px;font-size:15px;color:#fff;background-color:#FF5722;">
    เลือกสมาชิกที่ต้องการยืมหนังสือ
  </caption>
  <tr style="color:#fff;" bgcolor="#FF5722" height="40">
    <td align="left" valign="middle" width="130">รหัสสมาชิก</td>
    <td align="left" valign="middle" width="250">ชื่อ - สกุล</td>
    <td align="left" valign="middle" width="120">สถานภาพ</td>
    <td align="left" valign="middle" width="120">สถานะสมัครสมาชิก</td>
    <td align="left" valign="middle" width="80">สถานะการยืม</td>
    <td align="left" valign="middle" width="100">จำนวนสิทธิ์การยืม</td>
  </tr>
  <?php
  	while($record=mysqli_fetch_array($result)){
	$i++;
  $mb_code=$record[0];
	$mb_tname=$record[1];
	$mb_fname=$record[2];
	$mb_lname=$record[3];
	$mb_job=$record[4];
	$mb_status=$record[5];
	$mb_numr=$record[6];
	$mb_addr=$record[7];
	$mb_tel=$record[8];
	$mb_pict="photos of member/".$mb_code.".jpg";
	$mb_regsta=$record[9];

  if($mb_regsta=="a"){
		  $regsta="สมาชิก";
		  $regstacolor="green";
		}else{
		  $regsta="รอดำเนินการ";
		  $regstacolor="red";
	  	}

	if($mb_status=="y"){
		  $status="มีสิทธิ์ยืม";
		  $stacolor="green";
		}else{
		  $status="ไม่มีสิทธิ์ยืม";
		  $stacolor="red";
	  	}

  if($mb_numr>0){
    	$numrcolor="green";
    }else{
    	$numrcolor="red";
    }
  ?>
  <tr bgcolor="#fff" onmouseover="this.style.background='#E5E7E9'" onmouseout="this.style.background='#fff'" style="cursor:pointer;" onclick="location.href='p_borrow_select_member.php?mb_code=<?php echo $mb_code; ?>&name=<?php echo($mb_tname),($mb_fname);?> <?php echo($mb_lname);?>&mb_job=<?php echo($mb_job);?>&mb_numr=<?php echo $mb_numr; ?>'">
    <td align="left" valign="top"><?php echo($mb_code);?></td>
    <td align="left" valign="top"><?php echo($mb_tname),($mb_fname);?> <?php echo($mb_lname);?></td>
    <td align="left" valign="top"><?php echo($mb_job);?></td>
    <td style='color:<?php echo $regstacolor;?>' align="left" valign="top"><?php echo $regsta;?></td>
    <td style='color:<?php echo $stacolor;?>' align="left" valign="top"><?php echo $status;?></td>
    <td style='color:<?php echo $numrcolor;?>' align="left" valign="top"><?php echo($mb_numr);?></td>
  </tr>
  <?php }?>
</table>

<?php }else{
  if(isset($_SESSION['mb_numr']) and $_SESSION['mb_numr']>0){
      $table_numrcolor="green";
    }else{
      $table_numrcolor="red";
    }
?>

  <div class="searchtool">
    <p>
    <label style="color:#000;font-size:25px;">บันทึกการยืม</label><br />
    </p>
  </div></br>

  <div class="desandbtnadd">
    <div class="descripicon">
      <p align="center">
        <label style="color:red;">* หมายเหตุ หน้าที่ของสัญลักษณ์</label>&nbsp;
        <img src="assets/images/iconchoosebook.png" alt="" height="13"><label style="color:#16ad0e;"> เลือกหนังสือที่ต้องการยืม</label>&nbsp;
        <img src="assets/images/icondelete.png" alt="" height="13"><label style="color:red;"> ยกเลิกรายการหนังสือที่เลือก</label>
      </p>
    </div>
  </div>
      <div class="clearfix"></div></br>



      <center>
      <div class="borrower">
        <div class="pictofborrower"><img src="photos of member/<?php echo $_SESSION['mb_code'];?>.jpg" width="110" height="110"></div>
        <div class="detailofborrower">
          <table width="708" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr>
              <td width="105" align="right" style="color:#000;font-size:13px;">รหัสสมาชิก :&nbsp; </td>
              <td width="205" align="left" style="color:#333;font-size:13px;"><?php echo $_SESSION['mb_code']; ?></td>
              <td width="105" align="right" style="color:#000;font-size:13px;">ชื่อ - สกุล :&nbsp; </td>
              <td width="205" align="left" style="color:#333;font-size:13px;"><?php echo $_SESSION['name']; ?></td>
            </tr>
            <tr>
              <td width="105" align="right" style="color:#999;font-size:10px;">&nbsp; </td>
            </tr>
            <tr>
              <td align="right" style="color:#000;font-size:13px;">สถานภาพ :&nbsp; </td>
              <td align="left" style="color:#333;font-size:13px;"><?php echo $_SESSION['mb_job']; ?></td>
              <td align="right" style="color:#000;font-size:13px;">จำนวนสิทธิ์การยืม :&nbsp; </td>
              <td align="left" style="color:<?php echo $table_numrcolor; ?>;font-size:13px;"><?php echo $_SESSION['mb_numr']; ?></td>
            </tr>
            <tr>
              <td width="105" align="right" style="color:#999;font-size:10px;">&nbsp; </td>
            </tr>
            <tr>
              <td align="right" style="color:#000;font-size:13px;">วันที่ยืม :&nbsp; </td>
              <td align="left" style="color:green;font-size:13px;"><?php echo date("d")." ".$month[date("m")]." ".(date("Y")+543); ?></td>
              <td align="right" style="color:#000;font-size:13px;">วันที่กำหนดคืน :&nbsp; </td>
              <td align="left" style="color:red;font-size:13px;"><?php echo date("d", strtotime("+7 day"))." ".$month[date("m")]." ".(date("Y")+543); ?></td>
            </tr>
          </table>
        </div>
      </div>
      </center>
      <div class="clearfix"></div></br>



    <table border="0" bordercolor="#ddd" align="center" cellpadding="5" cellspacing="0">
    <tr style="color:#fff;" bgcolor="#FF5722" height="40">
      <td align="left" valign="middle" width="40"></td>
      <td align="left" valign="middle" width="20">ลำดับ</td>
      <td align="left" valign="middle" width="150">เลข ISBN/ISSN</td>
      <td align="left" valign="middle" width="150">ประเภทหนังสือ</td>
      <td align="left" valign="middle" width="400">ชื่อหนังสือ</td>
    </tr>
  <?php
  if(isset($_SESSION["borrow"])){
    $i=0;
    foreach($_SESSION["borrow"] as $key => $value)
    {
      $i++;
  		echo "
      <tr bgcolor='#fbfbfb'>
        <td align='center'><a href='p_check_status.php?bk_code=".$value['bk_code']."&status=clear&i=".$key."'><img src='assets/images/icondelete.png' alt='' height='13' title='ยกเลิกรายการหนังสือที่เลือก'></a></td>
        <td>".$i."</td>
        <td>".$value['bk_code']."</td>
        <td>".$value['cob_cateofbook']."</td>
        <td>".$value['bk_title']."</td>
      </tr>";
  	}
  }
  ?>
  <tr bgcolor="#E6E6E6">
    <?php if(isset($_SESSION['mb_code']) and $_SESSION['mb_numr']>0 ){echo "
    <td align='center'><a href='h_index.php'><img src='assets/images/iconchoosebook.png' alt='' height='13' title='เลือกหนังสือที่ต้องการยืม'></a></td>"; }else{ ?>
    <td align="center"><a href="javascript:numr_check()"><img src="assets/images/iconchoosebook.png" alt="" height="13" title="เลือกหนังสือที่ต้องการยืม"></a></td>
    <?php } ?>
    <td align="center" style="color:#0023FF;" colspan="4">จำนวนหนังสือทั้งหมด <?php echo $i; ?> เล่ม</td>
  </tr>
  <tr>
    <td align="right" style="color:#999;font-size:2px;">&nbsp; </td>
  </tr>
  <tr>
    <td align="center" colspan="5">
      <a class="btnconfirm" href="p_borrow_submit.php">ยืนยันการยืม</a>

      <a class="btncancel" href="javascript:clear()">ยกเลิก</a>
    </td>
  </tr>
  </table>
<?php } ?>
<?php include("mysql/unconn.php");?>
<script language="javascript">
function clear(){
	if(confirm("ต้องการที่จะยกเลิกการยืมใช่หรือไม่ ?")==true){
		window.location.href="p_borrow_select_member.php?clear";
	}
}
function numr_check(){
  alert('จำนวนสิทธิ์การยืมไม่เพียงพอ !');
}
</script>
        </div>
	</div>
</div>
</body>
</html>
