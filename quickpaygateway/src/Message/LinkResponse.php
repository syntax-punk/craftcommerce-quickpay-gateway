<?php


namespace Omnipay\Quickpay\Message;


use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class LinkResponse extends Response implements RedirectResponseInterface
{
    protected $reference;

    public function __construct(RequestInterface $request, $data, $reference = null)
    {
        parent::__construct($request, $data);
        $this->reference = $reference;
    }

    public function isSuccessful()
    {
        $body = $this->getResponseBody();
        $body = json_decode($body);
        if (isset($body->url)) {
            return true;
        }
        return false;
    }

    public function getTransactionReference()
    {
        return $this->reference;
    }

    /**
     * @return bool
     * @codeCoverageIgnore
     */
    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        $data = json_decode($this->getResponseBody());
        return $data->url;
    }

    public function getResponseCode()
    {
        $body = json_decode($this->getResponseBody());
        if (isset($body->error_code)) {
            return $body->error_code;
        }
        if (isset($body->statusCode)) {
            return $body->statusCode;
        }
        return "999";
    }

    public function getResponseMsg()
    {
        $body = json_decode($this->getResponseBody());
        if (isset($body->message)) {
            return $body->message;
        }
        return "none";
    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function getRedirectData()
    {
        return [];
    }
}
