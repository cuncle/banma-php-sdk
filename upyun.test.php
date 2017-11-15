<?php
require_once('./upyun.class.php');
// 初始化 UpYun
$upyun = new UpYun ('client_key', 'client_secret','/image/url/check');//操作员的帐号密码

// 设置请求任务
$data = array(
    'url' => 'http://xxxx.b0.upaiyun.com/aaa.png',        // 鉴黄的URL
    'notify_url' => 'http://notify.http.com/post',      //回调通知地址
);

// 调用拉取函数
try {
    //返回对应的任务ids
    $ids = $upyun->request($data);
    print $ids;
} catch(Exception $e) {
    echo $e->getCode();     // 错误代码
    echo $e->getMessage();  // 具体错误信息
}
