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
<title>ระบบจัดการประเภทหนังสือ</title>
<link href="https://fonts.googleapis.com/css?family=Mitr:400,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/png" href="assets/images/headericonlogo.png" />
</head>
<body>
<?php
include "t_header.php";
if(isset($_GET['cob_cateid'])){
	$cob_cateid=$_GET['cob_cateid'];
	include("r_cob_select.php");
	$action="r_cob_update.php";
}else{
	$cob_cateofbook="";
	$action="r_cob_insert.php";
}
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
<form action="<?php echo($action);?>" method="post" enctype="multipart/form-data" name="cobform" target="_self" onSubmit="return checkform();">
        <div class="searchtool">
    <p>
    <label style="color:#000;font-size:25px;">เพิ่ม/แก้ไข ประเภทหนังสือหนังสือ</label><br />
    </p>
        </div><br />
  <table border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td align="right" valign="top" style="color:#999;font-size:15px;">ประเภทหนังสือ :&nbsp; </td>
      <td align="left" valign="top"><input name="txt_cobcateid" type="hidden" id="txt_cobcateid" value="<?php echo($cob_cateid)?>">
        <input name="txt_cobcateofbook" type="text" id="txt_cobcateofbook" value="<?php echo($cob_cateofbook)?>" size="50">
        <label style="color:red;font-size:15px;"> *</label>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top">
        <input type="submit" class="btnconfirm" name="btn_save" id="btn_save" style="font-family:Mitr; font-size:13px; cursor:pointer;" value="บันทึก">
        <a class="btncancel" href="p_cob_list.php " title="หน้าจัดการประเภทหนังสือ">ยกเลิก</a>
      </td>
    </tr>
  </table>
</form>
<script language="javascript">
function checkform(){
	var v1 = document.getElementById('txt_cobcateofbook').value;
	if(v1.length<1){
		alert("กรอกประเภทหนังสือ");
		document.getElementById('txt_cobcateofbook').focus();
		return false;
	}else{
		return true;
	}
}
</script>
		</div>
	</div>
</div>
</body>
</html>
