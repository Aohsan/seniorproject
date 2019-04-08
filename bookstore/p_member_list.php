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
<title>ระบบจัดการสมาชิก</title>
<link href="https://fonts.googleapis.com/css?family=Mitr:400,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/png" href="assets/images/headericonlogo.png" />
</head>
<body>
<?php
include "t_header.php";
	$i=0;
  if(isset($_POST['txtsearch'])){
		$txtsearch=$_POST['txtsearch'];
		$cateofsearch=$_POST['cateofsearch'];
		$sql="SELECT mb_code,mb_tname,mb_fname,mb_lname,mb_job,mb_status,mb_numr,mb_addr,mb_tel,mb_regsta FROM members";
			if($cateofsearch=='mbcode'){
				$sql.= " WHERE mb_code LIKE '%$txtsearch%' and mb_regsta= 'a'";}
			elseif($cateofsearch=='mbfname'){
				$sql.= " WHERE mb_fname LIKE '%$txtsearch%' and mb_regsta= 'a'";}
      elseif($cateofsearch=='mblname'){
  			$sql.= " WHERE mb_lname LIKE '%$txtsearch%' and mb_regsta= 'a'";}
	}else{
		$sql="SELECT mb_code,mb_tname,mb_fname,mb_lname,mb_job,mb_status,mb_numr,mb_addr,mb_tel,mb_regsta FROM members";
    $sql.= " WHERE mb_regsta = 'a'";
		$txtsearch="";
	}
	include("mysql/conn.php");
	$result=mysqli_query($connect, $sql);
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
          <div class="searchtool">
<form action="p_member_list.php" method="post" name="searchform" target="_self" id="searchform">
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
                <label style="color:red;">* หมายเหตุ หน้าที่ของสัญลักษณ์</label>&nbsp;
                <img src="assets/images/iconprint.png" alt="" height="13"><label style="color:#000;"> พิมพ์บัตรสมาชิก</label>&nbsp;
                <img src="assets/images/iconview.png" alt="" height="13"><label style="color:#00da39;"> ดูข้อมูล</label>&nbsp;
                <img src="assets/images/iconedit.png" alt="" height="13"><label style="color:#ff7e00;"> แก้ไข</label>&nbsp;
                <img src="assets/images/icondelete.png" alt="" height="13"><label style="color:red;"> ลบ</label>
              </p>
            </div>
            <div class="buttonadd">
              <p><a href="p_member_form.php" title="เพิ่มสมาชิก"><img src="assets/images/btnadd1.png" alt="เพิ่ม"></br><label for="btnadd">เพิ่มสมาชิก</label></a></p>
            </div>
          </div>
              <div class="clearfix"></div></br>
<table border="0" bordercolor="#ddd" align="center" cellpadding="5" cellspacing="0">
  <caption style="padding-top:10px;padding-bottom:10px;margin-bottom:2px;font-size:15px;color:#fff;background-color:#FF5722;">
    ระบบจัดการสมาชิก
  </caption>
  <tr style="color:#fff;" bgcolor="#FF5722" height="40">
    <td align="left" valign="middle" width="130">รหัสสมาชิก</td>
    <td align="left" valign="middle" width="250">ชื่อ - สกุล</td>
    <td align="left" valign="middle" width="120">สถานภาพ</td>
    <td align="left" valign="middle" width="120">สถานะสมัครสมาชิก</td>
    <td align="left" valign="middle" width="80">สถานะการยืม</td>
    <td align="left" valign="middle" width="100">จำนวนสิทธิ์การยืม</td>
    <td align="left" valign="middle" width="100">จัดการ</td>
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
  <tr bgcolor="#f2f2f2">
    <td align="left" valign="top"><?php echo($mb_code);?></td>
    <td align="left" valign="top"><?php echo($mb_tname),($mb_fname);?> <?php echo($mb_lname);?></td>
    <td align="left" valign="top"><?php echo($mb_job);?></td>
    <td style='color:<?php echo $regstacolor;?>' align="left" valign="top"><?php echo $regsta;?></td>
    <td style='color:<?php echo $stacolor;?>' align="left" valign="top"><?php echo $status;?></td>
    <td style='color:<?php echo $numrcolor;?>' align="left" valign="top"><?php echo($mb_numr);?></td>
    <td align="left" valign="top">
    <a href="p_member_printcard.php?mb_code=<?php echo $mb_code; ?>" title="พิมพ์บัตรสมาชิก"><img src="assets/images/iconprint.png" alt="" height="13"></a>&nbsp;&nbsp;
    <a href="p_member_detail.php?mb_code=<?php echo $mb_code; ?>" title="ดูข้อมูลสมาชิก"><img src="assets/images/iconview.png" alt="" height="13"></a>&nbsp;&nbsp;
    <a href="p_member_form.php?mb_code=<?php echo $mb_code; ?>" title="แก้ไขข้อมูลสมาชิก"><img src="assets/images/iconedit.png" alt="" height="13"></a>&nbsp;&nbsp;
    <a href="javascript:deletedata('<?php echo $mb_code; ?>')" title="ลบข้อมูลสมาชิก"><img src="assets/images/icondelete.png" alt="" height="13"></a>
    </td>
  </tr>
  <?php }?>
</table>
<?php include("mysql/unconn.php");?>
<script language="javascript">
function deletedata(mb_code){
	if(confirm("ต้องการที่จะลบข้อมูลใช่หรือไม่ ?")==true){
		window.location.href="r_member_delete.php?mb_code="+mb_code;
	}
}
</script>
        </div>
	</div>
</div>
</body>
</html>
