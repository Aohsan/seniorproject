<?php
include("mysql/config.php");
include("mysql/conn.php");
error_reporting(0);
 if(isset($_SESSION['adm_id'])=="")
{
	echo "<script type='text/javascript'>alert('สำหรับผู้ดูแลระบบ ล็อคอินเพื่อใช้งาน !');window.location.replace('h_index.php');</script>";
}
  if(count($_SESSION['borrow'])==0){
    echo "<script type='text/javascript'>alert('กรุณาเลือกหนังสือที่ต้องการยืม !');window.location.replace('p_borrow_select_member.php');</script>";
  }else{

    $br_bdate=date("Y-m-d");
    $br_fdate=date("Y-m-d", strtotime("+7 day"));

    $sql="INSERT INTO `borrow`(`mb_code`, `br_bdate`, `br_fdate`, `br_status`)
    VALUES ('".$_SESSION['mb_code']."','$br_bdate','$br_fdate','1')";
    $result=mysqli_query($connect, $sql);

    $id = mysqli_insert_id($connect);

    foreach($_SESSION["borrow"] as $key => $value){
      $sql="INSERT INTO `borrowdetail`(`br_id`, `bk_code`, `brd_numbr`) VALUES ('$id','".$value['bk_code']."','1')";
      $result=mysqli_query($connect, $sql);
      $sql="UPDATE `books` SET `bk_numstock`=`bk_numstock`-1 WHERE `bk_code`='".$value['bk_code']."'";
      $result=mysqli_query($connect, $sql);
    }

    if($_SESSION['mb_numr']=="0"){
      $sql="UPDATE `members` SET `mb_numr`='".$_SESSION['mb_numr']."',`mb_status`='n' WHERE `mb_code`='".$_SESSION['mb_code']."'";
      $result=mysqli_query($connect, $sql);
    }else{
      $sql="UPDATE `members` SET `mb_numr`='".$_SESSION['mb_numr']."' WHERE `mb_code`='".$_SESSION['mb_code']."'";
      $result=mysqli_query($connect, $sql);
    }

    unset($_SESSION['mb_code']);
    unset($_SESSION["borrow"]);
    unset($_SESSION["mb_numr"]);
    unset($_SESSION['name']);
    unset($_SESSION['mb_job']);

    echo "<script type='text/javascript'>alert('ทำรายการเสร็จสิ้น !');window.location.replace('p_borrow_select_member.php');</script>";
  }
?>
