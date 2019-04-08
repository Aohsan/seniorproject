<meta charset="utf-8">
<?php
session_start();
session_destroy();
die('<script type="text/javascript">alert("ออกจากระบบเรียบร้อยแล้ว !");location.replace("h_index.php")</script>');
?>
