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
<title>พิมพ์บัตรสมาชิก</title>
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
        <div class="searchtool no-print">
    <p>
    <label style="color:#000;font-size:25px;">พิมพ์บัตรสมาชิก <?php echo ($mb_tname);?><?php echo ($mb_fname);?> <?php echo ($mb_lname);?></label><br />
    </p>
        </div><br />

        <div class="card">
          <div class="container">
            <div class="headcard">
              <div class="logoofhead"><img src="assets/images/bannerlogo1.png" height="65"></div>
              <div class="membercardofhead"><label style="color:#FF5722;font-size:45px;">MEMBER CARD</label></div>
            </div>
            <div = class"clearfix"></div>
            <div class="detailcard">
              <div class="pictofmem"><img src="<?php echo ($mb_pict);?>" width="180" height="180"></div>
              <div class="detailofmem">
                <table width="340" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="90" align="right" style="color:#000;font-size:15px;">รหัสสมาชิก :&nbsp; </td>
                    <td width="250" align="left" style="color:#333;font-size:15px;"><?php echo ($mb_code);?></td>
                  </tr>
                  <tr>
                    <td width="80" align="right" style="color:#999;font-size:10px;">&nbsp; </td>
                  </tr>
                  <tr>
                    <td align="right" style="color:#000;font-size:15px;">ชื่อ - สกุล :&nbsp; </td>
                    <td align="left" style="color:#333;font-size:15px;"><?php echo ($mb_tname);?><?php echo ($mb_fname);?> <?php echo ($mb_lname);?></td>
                  </tr>
                  <tr>
                    <td width="80" align="right" style="color:#999;font-size:10px;">&nbsp; </td>
                  </tr>
                  <tr>
                    <td align="right" style="color:#000;font-size:15px;">เบอร์ติดต่อ :&nbsp; </td>
                    <td align="left" style="color:#333;font-size:15px;"><?php echo ($mb_tel);?></td>
                  </tr>
                </table>
              </div>
            </div>
            <div = class"clearfix"></div>
            <div class="footcard">
              <p align="right" style="color:#fff;font-size:12px;">สงวนสิทธิ์เฉพาะ : สมาชิก</p>
              <p align="right" style="color:#fff;font-size:10px;">คลังหนังสือแผนกวิชาคอมพิวเตอร์ธุรกิจ วิทยาลัยเทคนิคน่าน</p><br />
            </div>
          </div>
        </div><br />
<div class ="printbutton no-print">
<table width="550" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td colspan="2" align="center" valign="top" style="color:#999;font-size:13px;">
    <a href="javascript:printcard()" title="พิมพ์บัตรสมาชิก"><img src="assets/images/iconprint.png" alt="" height="13"></a>&nbsp;
    <a href="javascript:history.back()" title="ย้อนกลับ"><img src="assets/images/iconback.png" alt="" height="15"></a>
  </td>
</tr>
</table>
</div>
            </div>
<script language="javascript">
function printcard(){
	if(confirm("ต้องการที่พิมพ์บัตรสมาชิกใช่หรือไม่ ?")==true){
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
</div>
</body>
</html>
