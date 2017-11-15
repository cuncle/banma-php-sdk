# 又拍云 人工智能 banma-php-sdk    
内容识别(无存储)是直接把内容提交给平台，提交方式可以是内容本身或 URL，平台处理完成后返回结果，不保留数据。    
基于又拍云[内容识别(无存储)](http://docs.upyun.com/ai/audit_nostorage/) 实现内容识别。    
#使用方法 
```
// 初始化 UpYun
$upyun = new UpYun ('client_key', 'client_secret','uri');//设置key secret 已经请求接口的uri 

// 设置请求任务
$data = array(
    'url' => 'http://XXXX.b0.upaiyun.com/aaa.png',        // 鉴黄的URL
    'notify_url' => 'http://www.http.com/post',      //回调通知地址
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
```
#处理返回的响应头和处理结果，结果的详细解释可以[参考文档](http://docs.upyun.com/ai/audit_nostorage/#_2)
```
HTTP/1.1 200 OK
Server: marco/1.9
Content-Type: application/json
Connection: keep-alive
X-Request-Id: eadfe3ec9b1f5e292630fc7b3dc3ba21
Content-Length: 148
Date: Wed, 15 Nov 2017 06:30:30 GMT
X-Request-Path: poc-hgh-a-18, 403-zj-fud-206

{"porn":{"scores":[0.8640857338905334,0.013749056495726109,0.122165247797966],"rate":0.8640857338905334,"label":0,"review":true},"status_code":200}
``` 

