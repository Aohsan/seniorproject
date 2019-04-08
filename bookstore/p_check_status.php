<?php include("mysql/config.php");
error_reporting(0);
 if(isset($_SESSION['adm_id'])=="")
{
	echo "<script type='text/javascript'>alert('สำหรับผู้ดูแลระบบ ล็อคอินเพื่อใช้งาน !');window.location.replace('h_index.php');</script>";
}
if(isset($_GET['status']) and isset($_GET['bk_code']) and $_GET['status']=="borrow"){
  $key = array_search($_GET['bk_code'], array_column($_SESSION['borrow'], 'bk_code'));
  if (in_array($_GET['bk_code'], $_SESSION['borrow'][$key]))
  {
    echo "<script type='text/javascript'>alert('ไม่สามารถยืมหนังสือซ้ำได้ !');window.location.replace('p_borrow_select_member.php');</script>";
  }
  else
  {
    $_SESSION['borrow'][]=["bk_code"=>$_GET['bk_code'],"cob_cateofbook"=>$_GET['cob_cateofbook'],"bk_title"=>$_GET['bk_title']];
    $_SESSION['mb_numr']=$_SESSION['mb_numr']-1;
    echo "<script type='text/javascript'>window.location.replace('p_borrow_select_member.php');</script>";
  }
  //echo "<pre>";
  //print_r($_SESSION['borrow']);
  //echo "</pre>";
}
if(isset($_GET['status']) and isset($_GET['bk_code']) and $_GET['status']=="clear"){
  unset($_SESSION['borrow'][$_GET['i']]);
  $_SESSION['mb_numr']=$_SESSION['mb_numr']+1;
  echo "<script type='text/javascript'>window.location.replace('p_borrow_select_member.php');</script>";
}
?>
