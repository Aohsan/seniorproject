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
<title>ระบบจัดการหนังสือ</title>
<link href="https://fonts.googleapis.com/css?family=Mitr:400,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/png" href="assets/images/headericonlogo.png" />
</head>
<body>
<?php
include "t_header.php";
if(isset($_GET['bk_code'])){
	$bk_code=$_GET['bk_code'];
	include("r_book_select.php");
	$action="r_book_update.php";
  $ocbox="readonly";
  $colorbox="#ebebe4";
}else{
	$bk_code="";
	$bk_title="";
	$bk_detail="";
	$bk_author="";
	$bk_publisher="";
	$bk_price="";
	$bk_numstock="0";
	$bk_pict="photos of book/null.jpg";
	$action="r_book_insert.php";
  $ocbox="";
  $colorbox="#fff";
}
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
<form action="<?php echo($action);?>" method="post" enctype="multipart/form-data" name="bkform" target="_self" onSubmit="return checkform();">
        <div class="searchtool">
    <p>
    <label style="color:#000;font-size:25px;">เพิ่ม/แก้ไข ข้อมูลหนังสือ</label><br />
    </p>
        </div>
        <div class="contentview">
          <div class="pict"><img src="<?php echo($bk_pict);?>" width="300"><br />
            <input name="txt_bkocode" type="hidden" id="txt_bkocode" value="<?php echo($bk_code);?>">
            <input type="file" name="pict_bkpict" id="pict_bkpict" accept="image/*"><label style="color:red;font-size:15px;"></label>
          </div>
          <div class="bookdetail">
  <table width="690" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="170" align="left" style="color:#999;font-size:15px;">รหัสหนังสือ :&nbsp; </td>
<td width="520" align="left" style="color:#000;font-size:15px;color:red;"><input size="25" maxlength="13" name="txt_bkcode" type="text" id="txt_bkcode" placeholder="เลข ISBN/ISSN (10, 13 หลัก)" style="background-color:<?php echo $colorbox; ?>" value="<?php echo($bk_code)?>" onKeyUp="IsNumeric(this.value,this)" <?php echo($ocbox)?>> *</td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">ประเภทหนังสือ :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;">
  <select name="txt_cobcateid" id="txt_cobcateid">
    <?php include('r_book_select2.php');?>
  </select>
</td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">ชื่อหนังสือ :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;"><input name="txt_bktitle" size="48" type="text" id="txt_bktitle" value="<?php echo($bk_title)?>"> *</td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" valign="top" style="color:#999;font-size:15px;">รายละเอียดของหนังสือ :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;"><textarea name="txt_bkdetail" id="txt_bkdetail" cols="52" rows="5"><?php echo($bk_detail)?></textarea></td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">ชื่อผู้แต่ง :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;"><input name="txt_bkauthor" size="48" type="text" id="txt_bkauthor" value="<?php echo($bk_author)?>"></td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">สำนักพิมพ์ :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;"><input name="txt_bkpublisher" size="48" type="text" id="txt_bkpublisher" value="<?php echo($bk_publisher)?>"></td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">ราคา/เล่ม :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;"><input name="txt_bkprice" type="number" id="txt_bkprice" value="<?php echo($bk_price)?>"> *</td>
</tr>
<tr><td height="5" colspan="2" align="center" valign="top"></td></tr>
<tr>
<td align="left" style="color:#999;font-size:15px;">จำนวน (เล่ม) :&nbsp; </td>
<td align="left" style="font-size:15px;color:red;"><input name="txt_bknumstock" type="number" id="txt_bknumstock" value="<?php echo($bk_numstock)?>"> *</td>
</tr>
<tr><td height="10" colspan="2" align="center" valign="top"></td></tr>
<tr>
  <td colspan="2" align="center" valign="top" style="color:#999;font-size:13px;">
    <input type="submit" class="btnconfirm" name="btn_save" id="btn_save" style="font-family:Mitr; font-size:13px; cursor:pointer;" value="บันทึก">
    <a class="btncancel" href="p_book_list.php " title="หน้าจัดการหนังสือ">ยกเลิก</a>
  </td>
</tr>
  </table>
        </div>
</form>
<script language="javascript">

function checkform(){
	var v1 = document.getElementById('txt_bkcode').value;
  var v2 = document.getElementById('txt_bktitle').value;
  var v3 = document.getElementById('txt_bkprice').value;
  var v4 = document.getElementById('txt_bknumstock').value;
  if(v1.length<10){
		alert("กรอกรหัสหนังสือให้ครบถ้วน");
		document.getElementById('txt_bkcode').focus();
		return false;
	}else if(v2.length<1){
		alert("กรอกชื่อหนังสือ");
		document.getElementById('txt_bktitle').focus();
		return false;
  }else if(v3.length<1){
		alert("กรอกราคาหนังสือ");
		document.getElementById('txt_bkprice').focus();
		return false;
	}else if(v4.length<1){
		alert("กรอกจำนวนหนังสือคงเหลือ");
		document.getElementById('txt_bknumstock').focus();
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
