<?php
class UpYun {
    //请求URI
    private $_apiUri;

    //密钥 ClientKey
    private $_client_key;

    //密钥 ClientSecret
    private $_client_secret;

     /**
     * 初始化 UpYun 人工智能接口
     * @param $client_key 请求的key
     * @param $client_secret 请求的密钥
     * @param $apiUri 请求接口的uri 
     */
    public function __construct($_client_key, $_client_secret,$_apiUri)
    {
        $this->_client_key= $_client_key;
        $this->_client_secret= $_client_secret;
        $this->_apiUri = $_apiUri;
    }

    //请求时间GMT 
    public function GMTdate($data)
    {
        $GMTdate = gmdate('D, d M Y H:i:s') . ' GMT'; 
        return $GMTdate;
    }

    //签名计算
    public function createSign($data)
    {   $signstr = array();
        $signstr['method'] = 'POST';
        $signstr['uri'] =  $this->_apiUri;
        $signstr['date'] = $this->GMTdate($data);
        $signature = base64_encode(hash_hmac('sha1', implode('&', $signstr), $this->_client_secret, true));
        return $signature;
    } 
    // curl 用例
    protected function curl($data, $url, $method = 'GET')
    {
        $sign = $this->createSign($data);
        $headers[] = "Authorization: UPYUN ".$this->_client_key.":".$sign;
        $headers[] = "Date: ".gmdate("D, d M Y H:i:s \G\M\T");
        $ch = curl_init();
        $options = array();
               switch(strtoupper($method)) {
                   case 'GET':
                       $url .= '?' . $data;
                       $options = array(
                           CURLOPT_URL => $url,
                           CURLOPT_HTTPHEADER => $headers,
                           CURLOPT_RETURNTRANSFER => true,
                           CURLOPT_HEADER => true,
                       );
                       break;
                   case 'POST':
                       $options = array(
                           CURLOPT_URL => $url,
                           CURLOPT_POST => true,
                           CURLOPT_POSTFIELDS => $data,
                           CURLOPT_HTTPHEADER => $headers,
                           CURLOPT_RETURNTRANSFER => false,
                           CURLOPT_HEADER => true,
                       );
                       break;
                     }
                      curl_setopt_array($ch, $options);
                      $result = curl_exec($ch);
                      curl_close($ch);
       }
       //请求data
       public function request($data)
       {
         $data=json_encode($data,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
         $this->curl($data, 'http://banma.api.upyun.com'.$this->_apiUri, 'POST');
       }
    }
 ?>
