<?php

// 防止恶意调用
if (! defined('IN_TG')) {
    exit("Accsee Defined");
}
// 防止非HTML页面调用
if (! defined('SCRIPT')) {
    exit('Script Error');
}

?>

<link rel="shortcut icon" href="images/book.ico">
<link rel="stylesheet" type="text/css" href="css/basic.css">
<link rel="stylesheet" type="text/css" href="fonts/iconfont.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"
	href="css/<?php echo SCRIPT?>.css">
