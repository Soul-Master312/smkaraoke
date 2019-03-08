<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/27/2019
 * Time: 2:09 PM
 */

namespace App\Traits;


trait ResponseTrait
{
    private $_code = 1;
    private $_message = '';
    private $_data = [];

    private function _setCode($code)
    {
        $this->_code = $code;

        return $this;
    }

    private function _setMessage($message)
    {
        $this->_message = $message;

        return $this;
    }

    private function _setData($data)
    {
        $this->_data = $data;

        return $this;
    }

    private function _response($code = null, $data = null, $message = null)
    {
        $response = new \stdClass();
        $response->code = $code ?? $this->_code;
        $response->message = $message ?? $this->_message;
        $response->data = $data ?? $this->_data;

        return $response;
    }
}