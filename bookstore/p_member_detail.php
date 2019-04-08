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
	$mb_code=$_GET['mb_code'];
	include("r_member_select.php");
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
        <div class="searchtool">
    <p>
    <label style="color:#000;font-size:25px;">ข้อมูลสมาชิก <?php echo ($mb_tname);?><?php echo ($mb_fname);?> <?php echo ($mb_lname);?></label><br />
    </p>
        </div>
          <div class="contentview">
            <div class="pict"><img src="<?php echo ($mb_pict);?>" width="300"></div>
            <div class="bookdetail">
              <label style="color:#000;font-size:25px;"><?php echo ($mb_tname);?><?php echo ($mb_fname);?> <?php echo ($mb_lname);?></label><br />
              <label style="color:#000;font-size:15px;"><?php echo ($mb_job);?></label><br />

              <table width="690" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td width="145" align="left" style="color:#999;font-size:15px;">รหัสสมาชิก :&nbsp; </td>
  <td width="545" align="left" style="color:#000;font-size:15px;"><?php echo ($mb_code);?></td>
</tr>
<tr>
  <td align="left" style="color:#999;font-size:15px;">สถานะสมัครสมาชิก :&nbsp; </td>
  <td align="left" style="color:<?php echo $regstacolor;?>;font-size:15px;"><?php echo $regsta;?></td>
</tr>
<tr>
  <td align="left" style="color:#999;font-size:15px;">สถานะการยืม :&nbsp; </td>
  <td align="left" style="color:<?php echo $stacolor;?>;font-size:15px;"><?php echo $status;?></td>
</tr>
<tr>
  <td align="left" style="color:#999;font-size:15px;">จำนวนสิทธิ์การยืม :&nbsp; </td>
  <td align="left" style="color:<?php echo $numrcolor;?>;font-size:15px;"><?php echo ($mb_numr);?></td>
</tr>
<tr>
  <td align="left" style="color:#999;font-size:15px;">ที่อยู่ :&nbsp; </td>
  <td align="left" style="font-size:15px;"><?php echo ($mb_addr);?></td>
</tr>
<tr>
  <td align="left" style="color:#999;font-size:15px;">เบอร์โทรศัพท์ :&nbsp; </td>
  <td align="left" style="font-size:15px;"><?php echo ($mb_tel);?></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2" align="center" valign="top" style="color:#999;font-size:13px;">
    <a href="p_member_form.php?mb_code=<?php echo ($mb_code);?>" title="แก้ไขข้อมูลสมาชิก"><img src="assets/images/iconedit.png" alt="" height="13"></a>&nbsp;
    <a href="javascript:deletedata()" title="ลบข้อมูลสมาชิก"><img src="assets/images/icondelete.png" alt="" height="13"></a>&nbsp;
    <a href="p_member_list.php" title="ย้อนกลับ"><img src="assets/images/iconback.png" alt="" height="15"></a>
  </td>
</tr>
</table>
            </div>
<script language="javascript">
function deletedata(){
	if(confirm("ต้องการที่จะลบข้อมูลใช่หรือไม่ ?")==true){
		window.location.href="r_member_delete.php?mb_code=<?php echo ($mb_code);?>";
	}
}
</script>
        </div>
	</div>
</div>
</body>
</html>
