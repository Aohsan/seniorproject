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
	$i=0;
	$sql="SELECT cob_cateid,cob_cateofbook FROM cob";
	include("mysql/conn.php");
	$result=mysqli_query($connect, $sql);
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
        <div class="desandbtnadd">
          <div class="descripicon">
            <p align="center">
              <label style="color:red;">* หมายเหตุ หน้าที่ของสัญลักษณ์</label>&nbsp;
              <img src="assets/images/iconedit.png" alt="" height="13"><label style="color:#ff7e00;"> แก้ไข</label>&nbsp;
              <img src="assets/images/icondelete.png" alt="" height="13"><label style="color:red;"> ลบ</label>
            </p>
          </div>
        	<div class="buttonadd">
            <p><a href="p_cob_form.php" title="เพิ่มประเภทหนังสือ"><img src="assets/images/btnadd1.png" alt="เพิ่ม"></br><label for="btnadd">เพิ่มประเภทหนังสือ</label></a></p>
        	</div>
        </div>
            <div class="clearfix"></div></br>
<table border="0" align="center" cellpadding="5" cellspacing="0">
  <caption style="padding-top:10px;padding-bottom:10px;margin-bottom:2px;font-size:15px;color:#fff;background-color:#FF5722;">
    ระบบจัดการประเภทหนังสือ
  </caption>
  <tr style="color:#fff;" bgcolor="#FF5722" height="40">
	<td align="left" valign="middle" width="40">ลำดับ</td>
    <td align="left" valign="middle" width="150">ประเภทหนังสือ</td>
    <td align="left" valign="middle" width="50">จัดการ</td>
  </tr>
  <?php
  	while($record=mysqli_fetch_array($result)){
	$i++;
	$cob_cateid=$record[0];
	$cob_cateofbook=$record[1];
  ?>
  <tr bgcolor="#f2f2f2">
    <td align="left" valign="top"><?php echo($i);?></td>
    <td align="left" valign="top"><?php echo($cob_cateofbook);?></td>
    <td align="left" valign="top">
     <a href="p_cob_form.php?cob_cateid=<?php echo $cob_cateid; ?>" title="แก้ไขประเภทหนังสือ"><img src="assets/images/iconedit.png" alt="" height="13"></a>&nbsp;&nbsp;
     <a href="javascript:deletedata('<?php echo $cob_cateid; ?>')" title="ลบประเภทหนังสือ"><img src="assets/images/icondelete.png" alt="" height="13"></a>
    </td>
  </tr>
  <?php }?>
</table>
<?php include("mysql/unconn.php");?>
<script language="javascript">
function deletedata(cob_cateid){
	if(confirm("ต้องการที่จะลบข้อมูลใช่หรือไม่ ?")==true){
		window.location.href="r_cob_delete.php?cob_cateid="+cob_cateid;
	}
}
</script>
		</div>
	</div>
</div>
</body>
</html>
