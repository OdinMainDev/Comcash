<?php

namespace App\Merchants\Garantex;

class Jwt {	

    public function encode($payload, $key){
        $algo = 'RS256';
        $header = array('typ' => 'JWT', 'alg' => $algo);

        $segments = array();
        $segments[] = $this->urlsafeB64Encode($this->jsonEncode($header));
        $segments[] = $this->urlsafeB64Encode($this->jsonEncode($payload));
        $signing_input = implode('.', $segments);

        $signature = $this->sign($signing_input, $key);
        $segments[] = $this->urlsafeB64Encode($signature);
        return implode('.', $segments);
    }

    public function sign($payload, $key){
        $passphrase = '';
        
        $algo = OPENSSL_ALGO_SHA256;
        $key_type = OPENSSL_KEYTYPE_RSA;
        
        $privateKey = openssl_pkey_get_private($key);
        
        if (is_bool($privateKey)) {
            $error = openssl_error_string();
            info("ERROR JWT GARANTEX: ". $error);
            return false;
        }

        $details = openssl_pkey_get_details($privateKey);
        
        if (!array_key_exists('key', $details) || $details['type'] !== $key_type) {
            info("ERROR JWT GARANTEX: ". "Invalid key provided");
            return false;
        }
        
        $signature = '';

        if (!openssl_sign($payload, $signature, $privateKey, $algo)) {
            $error = openssl_error_string();
            info("ERROR JWT GARANTEX: ", $error);
            return false;
        }

        return $signature;
    }

    public function jsonDecode($input){
        $obj = json_decode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            $this->_handleJsonError($errno);
            return [];
        } 
        if ($obj === null && $input !== 'null') {
            info("ERROR JWT GARANTEX: ". "Null result with non-null input");
            return false;
        }
        return $obj;
    }

    public function jsonEncode($input){
        $json = json_encode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            $this->_handleJsonError($errno);
        } else if ($json === 'null' && $input !== null) {
            info("ERROR JWT GARANTEX: "."Null result with non-null input");
            return false;
        }
        return $json;
    }

    public function urlsafeB64Decode($input){
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    public function urlsafeB64Encode($input){
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    public function _handleJsonError($errno){
        $messages = array(
            JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
            JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
            JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON'
        );
        info("ERROR JWT GARANTEX: ". isset($messages[$errno])
        ? $messages[$errno]
        : 'Unknown JSON error: ' . $errno);
        return false;
    }
}