<?php
/**
 * CToken Class Library
 *
 * @package  CToken Class Library
 * @version  1.0.0
 * @author   Developer CloudXData <dev@cloudxdata.com>
 */

/**
 * We need use the class JWT
 *
 */
use Firebase\JWT\JWT;

class CTOKEN{

    /**
     * The key to encode and decode
     *
     * @var string
     */
    private $key;

    public function __construct($key){
        $this->key   = $key;
    }

    public function __destruct(){
        unset(
            $this->key
        );
    }

    /**
     * Encode array in JWT
     *
     * @param array $params
     * @return string
     */
    public function encode($params = null){

        $return = 0;
        $end_date = time();
        $end_time = date('h:i', $end_date);
        $end_time = strtotime('+5 minute', $end_date);
        $end_time = date('H:i', $end_time);
        $end_date = date('d.m.y', $end_date);

        if (!empty($this->key) && $params !== null) {

            $token = [
                'data'  => [
                    'name'              => $params['name'],
                    'pass'              => $params['pass'],
                    'nri'               => $params['nri'],
                    'end_date'          => $end_date,
                    'end_time'          => $end_time
                ]
            ];

            $return = JWT::encode($token, $this->key);
            $return = explode('.', $return);
            $endToken = $return[2];
            array_pop($return);
            foreach ($return as $param){

                $returnEncrypt[]= base64_encode($param);

            }

            $return = implode('.', $returnEncrypt);
            $return .= chr(126).$endToken;
            unset($returnEncrypt, $param);

        }

        unset($token);
        return $return;

    }

    /**
     * Decode JWT in array
     *
     * @param string $tokenIn
     * @return array
     */
    public function decode($tokenIn){

        $return = 0;

        if (!empty($tokenIn) && !empty($this->key)) {

            try{

                $tokenEncrypt = explode('.', $tokenIn);
                $endToken = explode(chr(126), $tokenEncrypt[1]);
                array_pop($tokenEncrypt);
                array_push($tokenEncrypt, $endToken[0]);
                $endToken = $endToken[1];
                foreach ($tokenEncrypt as $param) {

                    $token[] = base64_decode($param);

                }

                $token = implode('.', $token);
                $token .= '.'.$endToken;
                unset($tokenEncrypt, $param, $endToken);
                $return = JWT::decode($token, $this->key, array('HS256'));

            }catch (\Exception $e) {

                $return = 'Error: '.$e->getMessage();

            }

        }

       return $return;

    }

}
