<?php
		include("mysql/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>คลังหนังสือ | แผนกคอมฯ</title>
<link href="https://fonts.googleapis.com/css?family=Mitr:400,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/png" href="assets/images/headericonlogo.png" />
</head>
<body>
<?php
include "t_header.php";

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
		$sql="SELECT books.bk_code,books.cob_cateid,books.bk_title,books.bk_detail,books.bk_author,books.bk_publisher,books.bk_price,books.bk_numstock,books.bk_pict,cob.cob_cateofbook FROM books INNER JOIN cob ON books.cob_cateid=cob.cob_cateid LIMIT 10";
		$txtsearch="";
	}

	include("mysql/conn.php");
	$result=mysqli_query($connect, $sql);
	$numrows=mysqli_num_rows($result);
	/* Check Rows*/
	$sqlcheck="SELECT bk_code,cob_cateid,bk_title,bk_detail,bk_author,bk_publisher,bk_price,bk_numstock,bk_pict FROM books";
	$resultcheck=mysqli_query($connect, $sqlcheck);
	$j=mysqli_num_rows($resultcheck);
	/* Check Rows*/
?>
<div class="content">
	<div class="container">
    	<div class="contentarea">
        	<div class="searchtool">
<form method="post" name="searchform" target="_self">
		  <p align="center">
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
        	</div><br />

					<?php if($numrows>0){ ?>
						<label style="color:#000;font-size:20px; padding:0px 0px 0px 30px;">พบ <?php echo $numrows; ?> รายการ จากทั้งหมด <?php echo $j; ?> รายการ</label><br />
					<?php }else{ ?>
						<img src="assets/images/noresult.png"><br />
					<?php } ?>

  <?php
  	while($record=mysqli_fetch_array($result)){
		if($record['bk_numstock']>0){
		  $numbcolor="green";
		}else{
		  $numbcolor="red";
	  	}
  ?>
            <a target="_blank" href="h_viewbook.php?bk_code=<?php echo $record['bk_code']; ?>" style='text-decoration:none;'>
            <div class="bklistshow">
            	<img src="<?php echo $record['bk_pict'];?>" width="180" height="220"><br />
                <label style="color:#000;font-size:13px;"><?php if(mb_strlen($record['bk_title'])>22){echo mb_substr($record['bk_title'],0,22)."...";}else{echo $record['bk_title'];} ?></label><br />
                <label style="color:#00F;font-size:10px;">ประเภทหนังสือ : <?php echo $record['cob_cateofbook'];?></label><br />
                <label style="color:#999;font-style:italic;font-size:12px;"><?php echo $record['bk_author'];?></label><br />
                <label style="color:<?php echo $numbcolor;?>;font-size:12px;">คงเหลือ <?php echo $record['bk_numstock'];?></label><br /><br />
								<?php if(isset($_SESSION['mb_code']) and $record['bk_numstock']>0 and $_SESSION['mb_numr']>0 )
								{echo "<center><a href='p_check_status.php?bk_code=".$record["bk_code"]."&cob_cateofbook=".$record['cob_cateofbook']."&bk_title=".$record['bk_title']."&status=borrow' class='choosebook'>เลือกหนังสือ</a></center>";} ?>
            </div>
  <?php }?>
  			</a>
  			<div class="clearfix"></div>
    </div>
  </div>
</div>
<div class="bsearchtool">
	<form method="post" name="form">
			<input name="txtsearch" type="hidden" value="" />
			<input name="cateofsearch" type="hidden" value="" />
				<?php if(!isset($_POST['txtsearch'])){?>
					<center><button name="button" style="font-family: Mitr; font-size:13px;">แสดงหนังสือทั้งหมด</button></center>
				<?php } ?>
			</form>
</div>
<div class="footer">
	<p align="center">
		<img src="assets/images/iconcopyright.png" alt="" height="10">
		<label style="color:#333;font-size:13px;">2019</label>
		<label style="color:#333;font-size:13px;"> All right reserved.</label>
		<label style="color:#FFF;font-size:13px;"> Create by Mr. Patipat Khuanphet and Mr. Nareubet Kaoaon.</label>
	</p>
	<p align="center">
		<label style="color:#FFF;font-size:13px;">Advisor is Mr. Sarawut ChamChoi.</label>
	</p>
	<p align="center">
		<label style="color:#FFF;font-size:13px;">Business Computer</label>
	</p>
	<p align="center">
		<label style="color:#FFF;font-size:13px;">Nan Technical College. Institute of Vocational Education : Northern Region 2</label>
	</p>
</div>
</body>
</html>
