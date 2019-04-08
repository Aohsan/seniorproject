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
if(isset($_GET['mb_code'])){
	$mb_code=$_GET['mb_code'];
	include("r_member_select.php");
	$action="r_member_update.php";
  $ocbox="readonly";
  $colorbox="#ebebe4";
}else{
	$mb_code="";
	$mb_tname="นาย";
	$mb_fname="";
	$mb_lname="";
	$mb_job="นักเรียน นักศึกษา";
  $mb_numr="3";
	$mb_addr="";
	$mb_tel="";
	$mb_pict="photos of member/null.jpg";
	$action="r_member_insert.php";
  $ocbox="";
  $colorbox="#fff";
}
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
<form action="<?php echo($action);?>" method="post" enctype="multipart/form-data" name="mbform" target="_self" onSubmit="return checkform();">
        <div class="searchtool">
    <p>
    <label style="color:#000;font-size:25px;">เพิ่ม/แก้ไข ข้อมูลสมาชิก</label><br />
    </p>
        </div>
          <div class="contentview">
            <div class="pict"><img src="<?php echo($mb_pict);?>" width="300"><br />
              <input name="txt_mbocode" type="hidden" id="txt_mbocode" value="<?php echo($mb_code);?>">
              <input name="txt_mbregsta" type="hidden" id="txt_mbregsta" value="<?php echo($mb_regsta);?>">
              <input type="file" name="pict_mbpict" id="pict_mbpict" accept="image/*"><label style="color:red;font-size:15px;"></label>
            </div>

            <div class="bookdetail">
  <table width="690" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="145" align="left" style="color:#999;font-size:15px;">รหัสสมาชิก :&nbsp; </td>
<td width="545" align="left" style="color:#000;font-size:15px;color:red;"><input name="txt_mbcode" type="text" id="txt_mbcode" size="25" maxlength="13" placeholder="รหัสประจำตัวประชาชน (13 หลัก)" style="background-color:<?php echo $colorbox; ?>" value="<?php echo($mb_code)?>" onKeyUp="IsNumeric(this.value,this)" <?php echo($ocbox)?>> *</td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">คำนำหน้า :&nbsp; </td>
<td align="left" style="font-size:15px;">
  <select name="txt_mbtname" id="txt_mbtname">
    <option value="นาย">นาย</option>
    <option value="นางสาว">นางสาว</option>
    <option value="นาง">นาง</option>
  </select>
</td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">ชื่อ - สกุล :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;">
  <input name="txt_mbfname" type="text" id="txt_mbfname" placeholder="ชื่อ" value="<?php echo($mb_fname)?>"> *
  <input name="txt_mblname" type="text" id="txt_mblname" placeholder="นามสกุล" value="<?php echo($mb_lname)?>"> *
</td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">สถานภาพ :&nbsp; </td>
<td align="left" style="font-size:15px;">
  <select name="txt_mbjob" id="txt_mbjob">
    <option value="นักเรียน นักศึกษา">นักเรียน นักศึกษา</option>
    <option value="ข้าราชการครู">ข้าราชการครู</option>
    <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>
  </select>
</td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">จำนวนสิทธิ์การยืม :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;"><input name="txt_mbnumr" type="number" id="txt_mbnumr" value="<?php echo($mb_numr)?>"> *</td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" valign="top" style="color:#999;font-size:15px;">ที่อยู่ :&nbsp; </td>
<td align="left" style="font-size:15px;"><textarea name="txt_mbaddr" id="txt_mbaddr" cols="52" rows="5" placeholder="บ้านเลขที่ ถนน ตำบล อำเภอ จังหวัด                                  ตัวอย่าง (2 ถ.รอบกำแพงเมืองทิศตะวันตก ต.ในเวียง อ.เมือง จ.น่าน)"><?php echo($mb_addr)?></textarea></td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">เบอร์โทรศัพท์ :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;"><input name="txt_mbtel" type="text" id="txt_mbtel" maxlength="10" placeholder="0XXXXXXXXX (10 หลัก)" value="<?php echo($mb_tel)?>" onKeyUp="IsNumeric(this.value,this)"> *</td>
</tr>
<tr><td height="10" colspan="2" align="center" valign="top"></td></tr>
<tr>
  <td colspan="2" align="center" valign="top" style="color:#999;font-size:13px;">
    <input type="submit" class="btnconfirm" name="btn_save" id="btn_save" style="font-family:Mitr; font-size:13px; cursor:pointer;" value="บันทึก">
    <a class="btncancel" href="p_member_list.php " title="หน้าจัดการสมาชิก">ยกเลิก</a>
  </td>
</tr>
  </table>
        </div>
</form>
<script language="javascript">
document.getElementById('txt_mbtname').value="<?php echo($mb_tname);?>";
document.getElementById('txt_mbjob').value="<?php echo($mb_job);?>";

function checkform(){
	var v1 = document.getElementById('txt_mbcode').value;
  var v2 = document.getElementById('txt_mbfname').value;
  var v3 = document.getElementById('txt_mblname').value;
  var v4 = document.getElementById('txt_mbnumr').value;
  var v5 = document.getElementById('txt_mbtel').value;
	if(v1.length<13){
		alert("กรอกรหัสสมาชิกให้ครบถ้วน");
		document.getElementById('txt_mbcode').focus();
		return false;
	}else if(v2.length<1){
		alert("กรอกชื่อ");
		document.getElementById('txt_mbfname').focus();
		return false;
	}else if(v3.length<1){
		alert("กรอกนามสกุล");
		document.getElementById('txt_mblname').focus();
		return false;
	}else if(v4.length<1){
		alert("กรอกจำนวนสิทธิ์การยืม");
		document.getElementById('txt_mbnumr').focus();
		return false;
  }else if(v5.length<1){
		alert("กรอกเบอร์โทรศัพท์");
		document.getElementById('txt_mbtel').focus();
		return false;
	}else{
		return true;
	}
}

function IsNumeric(sText,obj)
{
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++)
      {
      Char = sText.charAt(i);
      if (ValidChars.indexOf(Char) == -1)
         {
         IsNumber = false;
         }
      }
        if(IsNumber==false){
            alert("กรอกเฉพาะตัวเลขเท่านั้น");
            obj.value=sText.substr(0,sText.length-1);
      }
}
</script>
        </div>
	</div>
</div>
</body>
</html>
