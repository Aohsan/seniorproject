<?php include("mysql/config.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลหนังสือ</title>
<link href="https://fonts.googleapis.com/css?family=Mitr:400,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/png" href="assets/images/headericonlogo.png" />
</head>
<body>
<?php
	include "t_header.php";
	$bk_code=$_GET['bk_code'];
	$sql="SELECT books.bk_code,books.cob_cateid,books.bk_title,books.bk_detail,books.bk_author,books.bk_publisher,books.bk_price,books.bk_numstock,books.bk_pict,cob.cob_cateofbook FROM books INNER JOIN cob ON books.cob_cateid=cob.cob_cateid WHERE bk_code='$bk_code'";
	include('mysql/conn.php');
	$result=mysqli_query($connect, $sql);
	$record=mysqli_fetch_array($result);
	if($record['bk_numstock']>0){
		  $numbcolor="green";
		}else{
		  $numbcolor="red";
	  	}
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
        	<div class="searchtool">
		  <p>
			<label style="color:#000;font-size:25px;">ข้อมูลหนังสือ <?php echo $record['bk_title'];?></label><br />
		  </p>
        	</div>
            <div class="contentview">
            	<div class="pict"><img src="<?php echo $record['bk_pict'];?>" width="300"></div>
              <div class="bookdetail">
                <label style="color:#000;font-size:25px;"><?php echo $record['bk_title'];?><br />
                <label style="color:#000;font-size:15px;"><?php echo $record['bk_author'];?> - </label>
                <label style="color:#999;font-style:italic;font-size:15px;">สำนักพิมพ์ <?php echo $record['bk_publisher'];?></label><br />
                <label style="color:#000;font-size:12px;margin-left:20px;"><?php echo $record['bk_detail'];?></label>
                <table width="690" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>&nbsp;</td>
</tr>
  <tr>
    <td width="345" align="right" style="color:#999;font-size:13px;">ประเภทหนังสือ :&nbsp; </td>
    <td width="345" align="left" style="color:#00F;font-size:13px;"><?php echo $record['cob_cateofbook'];?></td>
  </tr>
  <tr>
    <td align="right" style="color:#999;font-size:13px;">เลข ISBN/ISSN :&nbsp; </td>
    <td align="left" style="font-size:13px;"><?php echo $record['bk_code'];?></td>
  </tr>
  <tr>
    <td align="right" style="color:#999;font-size:13px;">ราคา/เล่ม :&nbsp; </td>
    <td align="left" style="font-size:13px;"><?php echo $record['bk_price'];?></td>
  </tr>
  <tr>
    <td align="right" style="color:#999;font-size:13px;">คงเหลือ :&nbsp; </td>
    <td align="left" style="color:<?php echo $numbcolor;?>;font-size:13px;"><?php echo $record['bk_numstock'];?></td>
  </tr>
</table>
              </div>
            </div>
            <div class="clearfix"></div>
        </div>
	</div>
</div>
<?php include("mysql/unconn.php");?>
</body>
</html>
