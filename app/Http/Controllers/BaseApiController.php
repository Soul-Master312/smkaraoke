<?php
/**
 * Created by Soul Master.
 * User: anh.voht
 * Date: 2/22/2019
 * Time: 4:38 PM
 */

namespace App\Http\Controllers;

class BaseApiController extends Controller
{
    protected $statusCode = 200;
    protected $headers = [];
    protected $data;
    protected $errorStatus = false;
    protected $message;

    /**
     * @return int
     */
    protected function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    protected function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    protected function getErrorStatus(): bool
    {
        return $this->errorStatus;
    }

    /**
     * @return mixed
     */
    protected function getMessage()
    {
        return $this->message;
    }

    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    protected function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    protected function setHeader(Array $header)
    {
        $this->headers = $header;
        return $this;
    }

    protected function setErrorStatus(bool $errorStatus)
    {
        $this->errorStatus = $errorStatus;
        return $this;
    }

    protected function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    protected function response($data = null, $message = null, $errorStatus = null, Array $headers = [], $statusCode = null)
    {
        $response = [
            'error' => $errorStatus ?? $this->getErrorStatus(),
            'status_code' => $statusCode ?? $this->getStatusCode(),
            'message' => $message ?? $this->getMessage(),
            'data' => $data ?? $this->getData()
        ];
        return response()->json($response, $statusCode ?? $this->getStatusCode(), is_array($headers) ? $headers : $this->getHeaders());
    }

    protected function WithError($message = '', $statusCode = '')
    {
        if ($statusCode)
            $this->setStatusCode($statusCode);
        if ($message)
            $this->setMessage($message);
        $this->setErrorStatus(true);
        return $this;
    }
}