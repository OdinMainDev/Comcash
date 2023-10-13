<?php

namespace App\Merchants\Garantex;

use App\Http\Traits\Models\HasLogs;

class Garantex {

    use HasLogs;

    /*
        ERC20 :: usdt
        OMNI :: usdt-omni
        TRON :: usdt-tron 
    */
    private $token = "";
    public $private_key = '';
    public $uid = '';
    public $hosts = '';
    public $host_type = 0;
    public $exchange_id = 0;
    public $merchant_id = 0;
    
    function __construct($merchant_id, $exchange_id, $private_key, $uid, $host_type = 0){
        $this->hosts = [
            [
                'auth' => 'dauth.garantex.org',
                'api' => 'garantex.org',
            ],
            [
                'auth' => 'dauth.garantex.net',
                'api' => 'api.garantex.net',
            ],
        ];
        $this->merchant_id = intval($merchant_id);			
        $this->exchange_id = intval($exchange_id);			
        $this->host_type = intval($host_type);			
        $this->private_key = trim($private_key);
        $this->uid = trim($uid);
        $this->set_token();
    }
    
    function set_token(){
        $token = trim($this->token);
        if($token){
            return;
        }

        $request = [
            "exp" => time() + 3600, // возможно стоит изменить на 1 мин
            "jti" => bin2hex(random_bytes(12))
        ];
        $jwt = new JWT();
        $payload = $jwt->encode($request, base64_decode($this->private_key, true));
        $post_data = [
            "kid" => $this->uid, 
            "jwt_token" => $payload
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0');
        curl_setopt($ch, CURLOPT_URL, "https://".$this->hosts[$this->host_type]['auth']."/api/v1/sessions/generate_jwt");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        
        $res = @json_decode($result, true);
        if(isset($res['token'])){
            $this->token = $res['token'];
        }

        $this->createMerchantLog(
            $this->merchant_id, 
            $this->exchange_id, 
            "generate jwt", 
            "https://".$this->hosts[$this->host_type]['auth']."/api/v1/sessions/generate_jwt",
            $post_data, 
            $result
        );
    }		
    
    function create_address($currency){
        $currency = trim(mb_strtoupper($currency));

        switch($currency){
            case "USDTERC20":
                $currency = "USDT";
            break;
            case "USDTTRC20":
                $currency = "USDT-TRON";
            break;
        }
        
        $post_data = [
            'currency' => trim(mb_strtolower($currency))
        ];
        $res = $this->request('create address', '/api/v2/deposit_address', $post_data);
        if(isset($res['address'])){
            return $res['address'];
        }
        
        for($i = 0; $i < 10; $i++){
            sleep(5);
            if(isset($res['id'])){
                $id = intval($res['id']);
                if($id){
                    $res2 = $this->request('get address details', '/api/v2/deposit_address/details?id=' . $id, []);
                    if(isset($res2['address'])){
                        $data['address'] = $res2['address'];
                    }
                }
            }else{
                $res = $this->request('create address', '/api/v2/deposit_address', $post_data);
                if(isset($res['address'])){
                    return $res['address'];
                }
            }
        }

        info("ОШИБКА ПРИ GARANTEX");
        info($res);
        info($post_data);
        return false;
    }

    function get_history_deposits($limit){
        $limit = intval($limit);
        $res = $this->request('/api/v2/deposits?limit=' . $limit, array());
        $trans = array();
        if(is_array($res) and !isset($res['error'])){
            $trans = $res;
        }
        return $trans;
    }		
    
    function request($action, $method, $post_data = []){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0');
        curl_setopt($ch, CURLOPT_URL, 'https://' . $this->hosts[$this->host_type]['api'] . $method);
        if(is_array($post_data)){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        }else{
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer {$this->token}"
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);   
        $result = curl_exec($ch); 
        curl_close($ch);
    
        $this->createMerchantLog(
            $this->merchant_id, 
            $this->exchange_id, 
            $action, 
            "https://" . $this->hosts[$this->host_type]['api'] . $method,
            $post_data, 
            $result
        );
        return @json_decode($result, true);
    }		
}