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
	$i=0;
  if(isset($_POST['txtsearch'])){
		$txtsearch=$_POST['txtsearch'];
		$cateofsearch=$_POST['cateofsearch'];
		$sql="SELECT books.bk_code,books.cob_cateid,books.bk_title,books.bk_detail,books.bk_author,books.bk_publisher,books.bk_price,books.bk_numstock,books.bk_pict,cob.cob_cateofbook FROM books INNER JOIN cob ON books.cob_cateid=cob.cob_cateid";
			if($cateofsearch=='bktitle'){
				$sql.= " WHERE books.bk_title LIKE '%$txtsearch%'";}
			elseif($cateofsearch=='cobcateofbook'){
				$sql.= " WHERE cob.cob_cateofbook LIKE '%$txtsearch%'";}
			elseif($cateofsearch=='bkcode'){
				$sql.= " WHERE books.bk_code LIKE '%$txtsearch%'";}
	}else{
		$sql="SELECT books.bk_code,books.cob_cateid,books.bk_title,books.bk_detail,books.bk_author,books.bk_publisher,books.bk_price,books.bk_numstock,books.bk_pict,cob.cob_cateofbook FROM books INNER JOIN cob ON books.cob_cateid=cob.cob_cateid";
		$txtsearch="";
	}
	include("mysql/conn.php");
	$result=mysqli_query($connect, $sql);
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
        <div class="searchtool">
<form action="p_book_list.php" method="post" name="searchform" target="_self" id="searchform">
<p align="	center">
  <label>ค้นหาหนังสือ</label>
  <input name="txtsearch" type="text" id="txtsearch" style="font-family: Mitr; font-size:13px;" value="<?php echo($txtsearch)?>" placeholder="ชื่อหนังสือ, ประเภทหนังสือ, เลข ISBN/ISSN">
  <select name="cateofsearch" style="font-family: Mitr; font-size:13px;">
    <option value="bktitle" <?php if(isset($cateofsearch)){if($cateofsearch=="bktitle"){echo"selected";}} ?>>ชื่อหนังสือ</option>
    <option value="cobcateofbook" <?php if(isset($cateofsearch)){if($cateofsearch=="cobcateofbook"){echo"selected";}} ?>>ประเภทหนังสือ</option>
    <option value="bkcode" <?php if(isset($cateofsearch)){if($cateofsearch=="bkcode"){echo"selected";}} ?>>เลข ISBN/ISSN</option>
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
              <img src="assets/images/iconview.png" alt="" height="13"><label style="color:#00da39;"> ดูข้อมูล</label>&nbsp;
              <img src="assets/images/iconedit.png" alt="" height="13"><label style="color:#ff7e00;"> แก้ไข</label>&nbsp;
              <img src="assets/images/icondelete.png" alt="" height="13"><label style="color:red;"> ลบ</label>
            </p>
          </div>
          <div class="buttonadd">
            <p><a href="p_book_form.php" title="เพิ่มหนังสือ"><img src="assets/images/btnadd1.png" alt="เพิ่ม"></br><label for="btnadd">เพิ่มหนังสือ</label></a></p>
          </div>
        </div>
            <div class="clearfix"></div></br>
<table border="0" align="center" cellpadding="5" cellspacing="0">
  <caption style="padding-top:10px;padding-bottom:10px;margin-bottom:2px;font-size:15px;color:#fff;background-color:#FF5722;">
    ระบบจัดการหนังสือ
  </caption>
  <tr style="color:#fff;" bgcolor="#FF5722" height="40">
    <td align="left" valign="middle" width="150">เลข ISBN/ISSN</td>
    <td align="left" valign="middle" width="150">ประเภทหนังสือ</td>
    <td align="left" valign="middle" width="400">ชื่อหนังสือ</td>
    <td align="left" valign="middle" width="70">คงเหลือ</td>
    <td align="left" valign="middle" width="70">จัดการ</td>
  </tr>
  <?php
  	while($record=mysqli_fetch_array($result)){
      if($record['bk_numstock']>0){
    		  $numbcolor="green";
    		}else{
    		  $numbcolor="red";
    	  	}
	$i++;
  ?>
  <tr bgcolor="#f2f2f2">
    <td align="left" valign="top"><?php echo $record['bk_code'];?></td>
    <td align="left" valign="top"><?php echo $record['cob_cateofbook'];?></td>
    <td align="left" valign="top"><?php echo $record['bk_title'];?></td>
    <td align="left" valign="top" style="color:<?php echo $numbcolor;?>;"><?php echo $record['bk_numstock'];?></td>
    <td align="left" valign="top">
    <a href="p_book_detail.php?bk_code=<?php echo $record['bk_code']; ?>" title="ดูข้อมูลหนังสือ"><img src="assets/images/iconview.png" alt="" height="13"></a>&nbsp;&nbsp;
    <a href="p_book_form.php?bk_code=<?php echo $record['bk_code']; ?>" title="แก้ไขข้อมูลหนังสือ"><img src="assets/images/iconedit.png" alt="" height="13"></a>&nbsp;&nbsp;
     <a href="javascript:deletedata('<?php echo $record['bk_code']; ?>')" title="ลบข้อมูลหนังสือ"><img src="assets/images/icondelete.png" alt="" height="13"></a>
    </td>
  </tr>
  <?php }?>
</table>
<?php include("mysql/unconn.php");?>
<script language="javascript">
function deletedata(bk_code){
	if(confirm("ต้องการที่จะลบข้อมูลใช่หรือไม่ ?")==true){
		window.location.href="r_book_delete.php?bk_code="+bk_code;
	}
}
</script>
        </div>
	</div>
</div>
</body>
</html>
