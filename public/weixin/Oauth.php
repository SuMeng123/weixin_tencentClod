<?php
//微信网页开发，用户访问，输出code
//目的是只要用户访问网页，就可以获取用户的个人信息
//微信网页开发-微信网页授权
if (isset($_GET['code'])){
    echo $_GET['code'];
}else{
    echo "NO CODE";
}

?>