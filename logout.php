<?php
session_start();
session_destroy();

echo '<script language="javascript">alert("Sampai Jumpa Lagi!"); document.location="index.html";</script>';
?>